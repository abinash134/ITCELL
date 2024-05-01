<?php
session_start();
include_once 'db.php';

// Check if the user is logged in and is a super admin
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'super_admin') {
    header('Location: login.php');
    exit();
}

// Fetch all tickets from the database
$query = "SELECT * FROM tickets";
$result = mysqli_query($conn, $query);

// Fetch all users from the database
$user_query = "SELECT * FROM users";
$user_result = mysqli_query($conn, $user_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom CSS styles here */
        .side-panel {
            padding: 20px;
        }
        .ticket-table {
            margin-top: 20px;
        }
        .ticket-actions {
            display: flex;
        }
        .ticket-actions a {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Side panel -->
            <div class="col-md-3 bg-light side-panel">
                <h3>Side Panel</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="create_ticket.php">Create Ticket</a></li>
                    <li class="list-group-item"><a href="create_user.php">Create User</a></li>
                    <li class="list-group-item"><a href="create_department.php">Create Department</a></li>
                    <!-- Logout Button -->
                    <li class="list-group-item">
                        <form action="logout.php" method="post">
                            <button type="submit" class="btn btn-danger btn-block">Logout</button>
                        </form>
                    </li>
                    <!-- Add more options as needed -->
                </ul>
            </div>
            <!-- Ticket table -->
            <div class="col-md-6">
                <h3 class="mt-3">All Tickets</h3>
                <div class="table-responsive ticket-table">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Ticket Number</th>
                                <th>Raising Department</th>
                                <th>Status</th>
                                <th>Technician</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['department_id']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td><?php echo $row['technician_id'] ? 'Technician ' . $row['technician_id'] : 'None'; ?></td>
                                <td class="ticket-actions">
                                    <a href="view_ticket.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View</a>
                                    <a href="edit_ticket.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete_ticket.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- User list -->
            <div class="col-md-3">
                <h3 class="mt-3">All Users</h3>
                <ul class="list-group">
                    <?php while($user_row = mysqli_fetch_assoc($user_result)): ?>
                        <li class="list-group-item"><?php echo $user_row['username']; ?></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
