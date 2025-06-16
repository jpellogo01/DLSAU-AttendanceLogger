<?php
// Database connection details
define('DB_HOST', 'localhost'); // Replace with your database host
define('DB_USER', 'root');      // Replace with your database username
define('DB_PASS', '');          // Replace with your database password
define('DB_NAME', 'dbattendanceb'); // Replace with your database name

// Connect to the database
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check for connection errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $studentID = filter_input(INPUT_POST, 'StudentID', FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_input(INPUT_POST, 'Firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'Lastname', FILTER_SANITIZE_STRING);
    $middlename = filter_input(INPUT_POST, 'Middlename', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'Address', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'optionsRadios', FILTER_SANITIZE_STRING);
    $birthMonth = filter_input(INPUT_POST, 'month', FILTER_SANITIZE_NUMBER_INT);
    $birthDay = filter_input(INPUT_POST, 'day', FILTER_SANITIZE_NUMBER_INT);
    $birthYear = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
    $contactNo = filter_input(INPUT_POST, 'ContactNo', FILTER_SANITIZE_NUMBER_INT);
    $courseID = filter_input(INPUT_POST, 'CourseID', FILTER_SANITIZE_STRING);
    $yearLevel = filter_input(INPUT_POST, 'YearLevel', FILTER_SANITIZE_STRING);
    $age = date('Y') - $birthYear; // Calculate age from birth year

    // Handle file upload
    $photo = $_FILES['photo'];
    
    // Correct upload directory path
    $uploadDirectory = __DIR__ . '/'; // Using __DIR__ to refer to the current script directory
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $maxFileSize = 5 * 1024 * 1024; // 5MB

    // Prepare the SQL statement for update
    $stmt = $mysqli->prepare("UPDATE tblstudent SET Firstname = ?, Lastname = ?, Middlename = ?, Address = ?, Gender = ?, BirthDate = ?, Age = ?, ContactNo = ?, CourseID = ?, YearLevel = ? WHERE StudentID = ?");

    // Format birthdate as YYYY-MM-DD
    $birthdate = "$birthYear-$birthMonth-$birthDay";

    // Check if a new file has been uploaded
    if (!empty($photo['name']) && in_array($photo['type'], $allowedTypes) && $photo['size'] <= $maxFileSize) {
        $fileExtension = pathinfo($photo['name'], PATHINFO_EXTENSION);
        $photoName = uniqid('IMG_', true) . '.' . $fileExtension;
        $photoPath = $uploadDirectory . $photoName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($photo['tmp_name'], $photoPath)) {
            // Include the photo in the update statement
            $stmt = $mysqli->prepare("UPDATE tblstudent SET Firstname = ?, Lastname = ?, Middlename = ?, Address = ?, Gender = ?, BirthDate = ?, Age = ?, ContactNo = ?, CourseID = ?, YearLevel = ?, StudPhoto = ? WHERE StudentID = ?");
            $stmt->bind_param('sssssssssssi', $firstname, $lastname, $middlename, $address, $gender, $birthdate, $age, $contactNo, $courseID, $yearLevel, $photoName, $studentID);
        } else {
            echo "Failed to upload photo.";
            exit;
        }
    } else {
        // Bind parameters without photo
        $stmt->bind_param('ssssssssssi', $firstname, $lastname, $middlename, $address, $gender, $birthdate, $age, $contactNo, $courseID, $yearLevel, $studentID);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo "Student record updated successfully!";
        header("Location: http://localhost:8080/attendancemonitoring/student/");
        exit; // Make sure to call exit after header to stop further script execution
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$mysqli->close();
?>
