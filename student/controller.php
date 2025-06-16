<!-- <?php
require_once("../include/initialize.php");

if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "index.php");
}

// Database connection configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dbattendanceb';

// Create a new mysqli connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        doInsert($conn);
        break;

    case 'edit':
        doEdit($conn);
        break;

    case 'delete':
        doDelete($conn);
        break;

    case 'photos':
        doupdateimage($conn);
        break;

    case 'checkid':
        Check_StudentID($conn);
        break;
}


function doInsert($conn) {
    // Check if the form is submitted
    if (isset($_POST['save'])) {
        // Validate required fields
        if (
            empty($_POST['StudentID']) || empty($_POST['Firstname']) || empty($_POST['Lastname'])
            || empty($_POST['Middlename']) || $_POST['CourseID'] == "none" || empty($_POST['Address'])
            || empty($_POST['ContactNo'])
        ) {
            message("All fields are required!", "error");
            redirect('index.php?view=add');
        } else {
            // Calculate the age
            $birthdate = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
            $age = date_diff(date_create($birthdate), date_create('today'))->y;

            // Validate age
            if ($age < 15) {
                message("Invalid age. 15 years old and above is allowed.", "error");
                redirect("index.php?view=add");
            } else {
                // Check for duplicate student ID using prepared statement
                $stmt = $conn->prepare("SELECT * FROM tblstudent WHERE StudentID = ?");
                $stmt->bind_param("s", $_POST['StudentID']);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if student ID already exists
                if ($result->num_rows > 0) {
                    message("Student ID already in use!", "error");
                    redirect("index.php?view=add");
                } else {
                    // Handle file upload
                    $uploadDir = "../uploadImage/Profile/"; // Directory to store uploaded photos
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                    $uploadOk = 1; // Variable to track upload status
                    $dir = "uploadImage/Profile/default.jpg"; // Default image path

                    // Check if a file is uploaded
                    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
                        $fileName = basename($_FILES["photo"]["name"]);
                        $targetFile = $uploadDir . $fileName;
                        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                        $tmpName = $_FILES['photo']['tmp_name'];

                        // Validate the uploaded file
                        $check = getimagesize($tmpName);
                        if ($check === false) {
                            message("File is not an image.", "error");
                            $uploadOk = 0;
                        }

                        // Check file size (limit to 500KB)
                        if ($_FILES["photo"]["size"] > 500000) {
                            message("Sorry, your file is too large.", "error");
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
                        if (!in_array($imageFileType, $allowedTypes)) {
                            message("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "error");
                            $uploadOk = 0;
                        }

                        // Ensure unique file name
                        $i = 1;
                        $newFileName = $fileName;
                        while (file_exists($uploadDir . $newFileName)) {
                            $newFileName = pathinfo($fileName, PATHINFO_FILENAME) . "_{$i}." . $imageFileType;
                            $i++;
                        }
                        $targetFile = $uploadDir . $newFileName;

                        // Attempt to upload the file if no errors
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                                $dir = "uploadImage/Profile/" . $newFileName; // Update directory with new image path
                            } else {
                                message("Sorry, there was an error uploading your file.", "error");
                            }
                        }
                    }

                    // Create a new student and set all properties
                    $stud = new Student();
                    $stud->StudPhoto = $dir; // Set the photo path
                    $stud->StudentID = $_POST['StudentID'];
                    $stud->Firstname = $_POST['Firstname'];
                    $stud->Lastname = $_POST['Lastname'];
                    $stud->Middlename = $_POST['Middlename'];
                    $stud->CourseID = $_POST['CourseID'];
                    $stud->Address = $_POST['Address'];
                    $stud->BirthDate = $birthdate;
                    $stud->Age = $age;
                    $stud->Gender = $_POST['optionsRadios'];
                    $stud->ContactNo = $_POST['ContactNo'];
                    $stud->YearLevel = $_POST['YearLevel'];
                    $stud->create();

                    message("New student created successfully!", "success");
                    redirect("index.php");
                }

                $stmt->close();
            }
        }
    }
}

function doEdit($conn) {
    if (isset($_POST['save'])) {
        // Validate required fields
        if (
            empty($_POST['StudentID']) || empty($_POST['Firstname']) || empty($_POST['Lastname'])
            || empty($_POST['Middlename']) || $_POST['CourseID'] == "none" || empty($_POST['Address'])
            || empty($_POST['ContactNo'])
        ) {
            message("All fields are required!", "error");
            redirect('index.php?view=view&id=' . $_POST['StudentID']);
        } else {
            // Calculate age
            $birthdate = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
            $age = date_diff(date_create($birthdate), date_create('today'))->y;
            if ($age < 15) {
                message("Invalid age. 15 years old and above is allowed.", "error");
                redirect("index.php?view=view&id=" . $_POST['StudentID']);
                return;
            }

            // Initialize photo path
            $photoName = null;

            // Handle file upload if a new photo is uploaded
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
                $photo = $_FILES['photo'];
                $uploadDirectory = __DIR__ . '/'; // Directory where edit.php is located
                $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                $maxFileSize = 5 * 1024 * 1024; // 5MB

                if (in_array($photo['type'], $allowedTypes) && $photo['size'] <= $maxFileSize) {
                    $fileExtension = pathinfo($photo['name'], PATHINFO_EXTENSION);
                    $photoName = uniqid('IMG_', true) . '.' . $fileExtension;
                    $photoPath = $uploadDirectory . $photoName;

                    if (!move_uploaded_file($photo['tmp_name'], $photoPath)) {
                        message("Failed to upload photo.", "error");
                        redirect("index.php?view=view&id=" . $_POST['StudentID']);
                        return;
                    }
                } else {
                    message("Invalid file type or size. Please upload a JPEG or PNG image under 5MB.", "error");
                    redirect("index.php?" . $_POST['StudentID']);
                    return;
                }
            }

            // Update the student record
            $stud = new Student();
            $stud->Firstname = $_POST['Firstname'];
            $stud->Lastname = $_POST['Lastname'];
            $stud->Middlename = $_POST['Middlename'];
            $stud->CourseID = $_POST['CourseID'];
            $stud->Address = $_POST['Address'];
            $stud->BirthDate = $birthdate;
            $stud->Age = $age;
            $stud->Gender = $_POST['optionsRadios'];
            $stud->ContactNo = $_POST['ContactNo'];
            $stud->YearLevel = $_POST['YearLevel'];

            // Update photo if a new one was uploaded
            if ($photoName !== null) {
                $stud->StudPhoto = $photoName;
            } else {
                // Optionally, you can handle the case where no new photo is provided
                // For example, keep the existing photo in the database or set a default value
            }

            $stud->studupdate($_POST['StudentID']);

            message("Student has been updated!", "success");
            header("Location: http://localhost:8080/attendancemonitoring/student/");
        }
    }
}


function doDelete($conn) {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        message("No record selected for deletion!", "error");
        redirect('index.php');
    } else {
        $id = $_POST['id'];

        // Ensure the Student class has a delete method that accepts an ID
        $stmt = $conn->prepare("DELETE FROM tblstudent WHERE ID = ?");
        if (!$stmt) {
            message("Error preparing statement: " . $conn->error, "error");
            redirect('index.php');
        }

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        if (!$result) {
            message("Error executing statement: " . $stmt->error, "error");
        } else {
            message("Student has been deleted!", "success");
        }

        $stmt->close();
        redirect('index.php');
    }
}




function doupdateimage($conn) {
    $errorFile = $_FILES['photo']['error'];
    $type = $_FILES['photo']['type'];
    $temp = $_FILES['photo']['tmp_name'];
    $myFile = $_FILES['photo']['name'];
    $location = "photo/" . $myFile;

    if ($errorFile > 0) {
        message("No Image Selected!", "error");
        redirect("index.php?view=view&id=" . $_GET['id']);
    } else {
        $file = $_FILES['photo']['tmp_name'];
        $image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
        $image_name = addslashes($_FILES['photo']['name']);
        $image_size = getimagesize($_FILES['photo']['tmp_name']);

        if ($image_size == FALSE) {
            message("Uploaded file is not an image!", "error");
            redirect("index.php?view=view&id=" . $_GET['id']);
        } else {
            //uploading the file
            move_uploaded_file($temp, $location);

            $stud = new Student();
            $stud->StudPhoto = $location;
            $stud->studupdate($_POST['StudentID']);
            redirect("index.php?view=view&id=" . $_POST['StudentID']);
        }
    }
}

function Check_StudentID($conn) {
    $sql = "SELECT * FROM tblstudent WHERE StudentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_POST['IDNO']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Student ID already in use!";
    }

    $stmt->close();
}

// Close the database connection when done
$conn->close();
?> -->
