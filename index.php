<?php
session_start();

// Check if the user is already logged in
if(isset($_SESSION['user_id'])) {
    // Redirect the user to the appropriate dashboard page based on their role
    $role_id = $_SESSION['role_id'];
    switch($role_id) {
        case 1: // Super Admin
            header('Location: dashboard.php');
            break;
        case 2: // Admin
            header('Location: admin_dashboard.php');
            break;
        case 3: // Department
            header('Location: department_dashboard.php');
            break;
        case 4: // Technician
            header('Location: technician_dashboard.php');
            break;
        default:
            // Redirect to login page if role is not recognized
            header('Location: login.php');
            break;
    }
    exit();
} else {
    // Redirect to login page if user is not logged in
    header('Location: login.php');
    exit();
}
?>
