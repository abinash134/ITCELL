<?php
session_start();
include_once 'db.php';

// Check if ticket ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the ticket ID
    $ticket_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Construct the SQL query to delete the ticket
    $query = "DELETE FROM tickets WHERE id = '$ticket_id'";

    // Execute the SQL query
    $result = mysqli_query($conn, $query);

    if($result) {
        // Redirect to dashboard with success message
        $_SESSION['success_message'] = "Ticket deleted successfully!";
        header('Location: dashboard.php');
        exit();
    } else {
        // Redirect to dashboard with error message
        $_SESSION['error_message'] = "Error deleting ticket. Please try again.";
        header('Location: dashboard.php');
        exit();
    }
} else {
    // Redirect to dashboard if ticket ID is not provided
    header('Location: dashboard.php');
    exit();
}
?>
