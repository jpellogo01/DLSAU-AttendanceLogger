<?php
// delete_student.php

// Database configuration
$host = 'localhost';
$dbName = 'dbattendance'; // Replace with your database name
$username = 'root';
$password = '';

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the student ID is set in the query parameter
if (isset($_GET['id'])) {
    $studentID = $_GET['id'];

    // Prepare the query to delete the student
    $stmt = $pdo->prepare("DELETE FROM `tblstudent` WHERE `ID` = :studentID");

    // Bind the parameter and execute the query
    $stmt->bindParam(':studentID', $studentID, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect to the page with the student list after deletion
        header('Location: index.php');
        exit();
    } else {
        // Handle the error if the deletion fails
        echo "Error deleting student record.";
    }
} else {
    // If the ID is not set, redirect back to the main page
    header('Location: index.php');
    exit();
}
?>
