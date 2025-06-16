<?php
require_once ("../include/initialize.php");

if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "index.php");
}

// Database connection configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dbattendance'; // Replace with your database name

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
}

function doInsert($conn) {
    if (isset($_POST['save'])) {
        if (empty($_POST['U_NAME']) || empty($_POST['U_USERNAME']) || empty($_POST['U_PASS'])) {
            message("All fields are required!", "error");
            redirect('index.php?view=add');
        } else {
            $username = $conn->real_escape_string($_POST['U_USERNAME']);
            $sql = "SELECT * FROM useraccounts WHERE ACCOUNT_USERNAME='$username'";
            $res = $conn->query($sql);

            if ($res->num_rows > 0) {
                message("Username is already taken.", "error");
                redirect('index.php?view=add');
            } else {
                $user = new User();
                $user->ACCOUNT_NAME = $conn->real_escape_string($_POST['U_NAME']);
                $user->ACCOUNT_USERNAME = $username;
                $user->ACCOUNT_PASSWORD = sha1($_POST['U_PASS']);
                $user->ACCOUNT_TYPE = $conn->real_escape_string($_POST['U_ROLE']);
                $user->create();

                message("New [" . $_POST['U_NAME'] . "] created successfully!", "success");
                redirect("index.php");
            }
        }
    }
}

function doEdit($conn) {
    if (isset($_POST['save'])) {
        $user = new User();
        $user->ACCOUNT_NAME = $conn->real_escape_string($_POST['U_NAME']);
        $user->ACCOUNT_USERNAME = $conn->real_escape_string($_POST['U_USERNAME']);
        $user->ACCOUNT_PASSWORD = sha1($_POST['U_PASS']);
        $user->ACCOUNT_TYPE = $conn->real_escape_string($_POST['U_ROLE']);
        $user->update($_POST['USERID']);

        message("[" . $_POST['U_NAME'] . "] has been updated!", "success");
        redirect("index.php");
    }
}

function doDelete($conn) {
    $id = $_GET['id'];

    $user = new User();
    $user->delete($id);

    message("User already Deleted!", "info");
    redirect('index.php');
}

function doupdateimage($conn) {
    $errorFile = $_FILES['photo']['error'];
    $type = $_FILES['photo']['type'];
    $temp = $_FILES['photo']['tmp_name'];
    $myFile = $_FILES['photo']['name'];
    $location = "photos/" . $myFile;

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
            // Uploading the file
            move_uploaded_file($temp, $location);

            $user = new User();
            $user->USERIMAGE = $location;
            $user->update($_SESSION['ACCOUNT_ID']);
            redirect("index.php?view=view&id=" . $_SESSION['ACCOUNT_ID']);
        }
    }
}

// Close the database connection when done
$conn->close();
?>
