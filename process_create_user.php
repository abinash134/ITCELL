<?php
session_start();
include_once 'db.php';

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role'];

    // Hash the password for security
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Construct the SQL query to insert the user data
    $query = "INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES (NULL,'$username', '$password', '$role_id')";

    // Execute the SQL query
    $result = mysqli_query($conn, $query);

    if($result) {
        // Redirect to dashboard with success message
        $_SESSION['success_message'] = "User created successfully!";
        header('Location: dashboard.php');
        exit();
    } else {
        // Redirect to create user page with error message
        $_SESSION['error_message'] = "Error creating user. Please try again.";
        header('Location: create_user.php');
        exit();
    }
} else {
    // Redirect to create user page if form is not submitted
    header('Location: create_user.php');
    exit();
}
?>
