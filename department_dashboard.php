<?php
session_start();

// Check if user is logged in and has the department role
if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 3) {
    // Redirect to login page or unauthorized access page
    header('Location: login.php');
    exit();
}

// Include database connection
include_once 'db.php';

// Check if form is submitted to raise a ticket
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_SESSION['user_id'];
    $department_id = $_SESSION['department_id'];
    $issue_description = $_POST['issue_description'];
    $contact_no = $_POST['contact_no'];

    // Construct the SQL query to insert the ticket data
    $query = "INSERT INTO tickets (user_id, department_id, issue_description, contact_no, raise_time, accepted_time, technician_id, status) 
              VALUES ('$user_id', '$department_id', '$issue_description', '$contact_no', current_timestamp(), current_timestamp(), NULL, 'open')";

    // Execute the SQL query
    $result = mysqli_query($conn, $query);

    if($result) {
        // Redirect to department dashboard with success message
        $_SESSION['success_message'] = "Ticket raised successfully!";
        header('Location: department_dashboard.php');
        exit();
    } else {
        // Redirect to department dashboard with error message
        $_SESSION['error_message'] = "Error raising ticket. Please try again.";
        header('Location: department_dashboard.php');
        exit();
    }
}

// Retrieve user's raised tickets
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM tickets WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Check if tickets exist
if(mysqli_num_rows($result) > 0) {
    // Tickets exist, display them
    while($row = mysqli_fetch_assoc($result)) {
        echo "Ticket ID: " . $row['id'] . "<br>";
        echo "Issue Description: " . $row['issue_description'] . "<br>";
        echo "Contact Number: " . $row['contact_no'] . "<br>";
        echo "Status: " . $row['status'] . "<br>";
        echo "<hr>";
    }
} else {
    // No tickets found
    echo "No tickets raised yet.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <h2>Raise New Ticket</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="issue_description">Issue Description:</label>
                <textarea name="issue_description" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="contact_no">Contact Number:</label>
                <input type="text" name="contact_no" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
