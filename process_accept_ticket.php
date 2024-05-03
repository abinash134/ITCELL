<?php
session_start();

// Check if user is logged in and has the technician role

// Include database connection
include_once 'db.php';

// Check if the form is submitted
if(isset($_POST['accept_ticket'])) {
    // Get the ticket ID from the form
    $ticket_id = $_POST['ticket_id'];
    
    // Get the user ID of the technician
    $user_id = $_SESSION['user_id'];
    
    // Update the ticket with the technician's ID and change status to 'in_progress'
    $update_query = "UPDATE `tickets` SET `technician_id` = '$user_id', `status` = 'in_progress' WHERE `tickets`.`id` = '$ticket_id' AND status = 'open'";
    $update_result = mysqli_query($conn, $update_query);
    // UPDATE `tickets` SET `status` = 'closed' WHERE `tickets`.`id` = 3; 
    if($update_result && mysqli_affected_rows($conn) > 0) {
        // Redirect to the technician dashboard with a success message
        $_SESSION['success_message'] = "Ticket accepted successfully.";
    } else {
        // Set error message
        $_SESSION['error_message'] = "Failed to accept ticket. The ticket may have been already accepted by another technician or it is not open.";
    }
} else {
    // Set error message if form is not submitted
    $_SESSION['error_message'] = "Form submission failed.";
}

// Redirect back to the technician dashboard
header('Location: technician_dashboard.php');
exit();
?>
