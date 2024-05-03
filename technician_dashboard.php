<?php
session_start();

// Check if user is logged in and has the technician role

// Include database connection
include_once 'db.php';

// Retrieve user's open tickets and tickets assigned to them
$user_id = $_SESSION['user_id'];

// Query for open tickets
$query_open_tickets = "SELECT * FROM tickets WHERE status = 'open'";
$result_open_tickets = mysqli_query($conn, $query_open_tickets);

// Query for technician's accepted tickets
$query_accepted_tickets = "SELECT * FROM tickets WHERE technician_id = '$user_id' AND status = 'accepted'";
$result_accepted_tickets = mysqli_query($conn, $query_accepted_tickets);
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
    <div class="container">
        <h2>Technician Dashboard</h2>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#open_tickets">Open Tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#my_tickets">My Tickets</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Open Tickets tab -->
            <div id="open_tickets" class="tab-pane fade show active mt-3">
                <?php
                // Display open tickets
                if(mysqli_num_rows($result_open_tickets) > 0) {
                    while($row = mysqli_fetch_assoc($result_open_tickets)) {
                        // Display open tickets
                        echo "<div class='container'>";
                        echo "<div class='card mt-3'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>Ticket ID: " . $row['id'] . "</h5>";
                        echo "<p class='card-text'>Issue Description: " . $row['issue_description'] . "</p>";
                        echo "<p class='card-text'>Contact Number: " . $row['contact_no'] . "</p>";
                        echo "<p class='card-text'>Status: " . $row['status'] . "</p>";
                        echo "<form action='process_accept_ticket.php' method='POST'>";
                        echo "<input type='hidden' name='ticket_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='btn btn-primary'>Accept</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No open tickets.";
                }
                ?>
            </div>

            <!-- My Tickets tab -->
            <div id="my_tickets" class="tab-pane fade mt-3">
                <?php
                // Display technician's accepted tickets
                if(mysqli_num_rows($result_accepted_tickets) > 0) {
                    while($row = mysqli_fetch_assoc($result_accepted_tickets)) {
                        // Display accepted tickets
                    }
                } else {
                    echo "You haven't accepted any tickets yet.";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
