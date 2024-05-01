<?php
session_start();

// Check if user is logged in and has the technician role
if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 4) {
    // Redirect to login page or unauthorized access page
    header('Location: login.php');
    exit();
}

// Include database connection
include_once 'db.php';

// Retrieve user's open tickets and tickets assigned to them
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM tickets WHERE status = 'open' OR technician_id = '$user_id'";
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
    echo "No open tickets or tickets assigned to you.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <h2>Open Tickets</h2>
        <!-- Open tickets are displayed above -->
    </div>
</body>
</html>
