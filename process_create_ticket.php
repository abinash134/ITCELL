<?php
session_start();
include_once 'db.php';

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $department_id = $_POST['department_id'];
    $issue_description = $_POST['issue_description'];
    $contact_no = $_POST['contact_no'];

    // Construct the SQL query to insert the ticket data
    $query = "INSERT INTO tickets (department_id, issue_description, contact_no, raise_time, accepted_time, technician_id, status) 
              VALUES ('$department_id', '$issue_description', '$contact_no', current_timestamp(), current_timestamp(), NULL, 'open')";

    // Execute the SQL query
    $result = mysqli_query($conn, $query);

    if($result) {
        // Redirect to dashboard with success message
        $_SESSION['success_message'] = "Ticket created successfully!";
        header('Location: dashboard.php');
        exit();
    } else {
        // Redirect to create ticket page with error message
        $_SESSION['error_message'] = "Error creating ticket. Please try again.";
        header('Location: create_ticket.php');
        exit();
    }
} else {
    // Redirect to create ticket page if form is not submitted
    header('Location: create_ticket.php');
    exit();
}
?>
