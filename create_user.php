<?php
session_start();
include_once 'db.php';

// Fetch roles from the database
$query = "SELECT * FROM roles";
$result = mysqli_query($conn, $query);

// Initialize an array to store roles
$roles = array();
while ($row = mysqli_fetch_assoc($result)) {
    $roles[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Side panel -->
            <div class="col-md-3 bg-light">
                <h3>Side Panel</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="list-group-item"><a href="create_ticket.php">Create Ticket</a></li>
                    <li class="list-group-item active"><a href="create_user.php">Create User</a></li>
                    <!-- Add more options as needed -->
                </ul>
            </div>
            <!-- Main content -->
            <div class="col-md-9">
                <div class="container mt-5">
                    <h2>Create New User</h2>
                    <form action="process_create_user.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role" class="form-control" required>
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
