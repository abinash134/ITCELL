<?php
session_start();
include_once 'db.php';

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve department name from form
    $name = $_POST['name'];

    // Insert department data into the database
    $query = "INSERT INTO departments (name) VALUES ('$name')";
    $result = mysqli_query($conn, $query);

    if($result) {
        // Redirect to dashboard with success message
        $_SESSION['success_message'] = "Department created successfully!";
        header('Location: dashboard.php');
        exit();
    } else {
        // Redirect to create department page with error message
        $_SESSION['error_message'] = "Error creating department. Please try again.";
        header('Location: create_department.php');
        exit();
    }
} else {
    // Redirect to create department page if form is not submitted
    header('Location: create_department.php');
    exit();
}
?>
