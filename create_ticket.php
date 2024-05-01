<?php
session_start();
include_once 'db.php';

// Fetch department names from the database
$query = "SELECT * FROM departments";
$result = mysqli_query($conn, $query);

// Initialize an array to store department names
$departments = array();
while ($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
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
                    <li class="list-group-item active"><a href="create_ticket.php">Create Ticket</a></li>
                    <li class="list-group-item"><a href="create_department.php">Create Department</a></li>
                    <!-- Add more options as needed -->
                </ul>
            </div>
            <!-- Main content -->
            <div class="col-md-9">
                <div class="container mt-5">
                    <h2>Create New Ticket</h2>
                    <form action="process_create_ticket.php" method="POST">
                        <div class="form-group">
                            <label for="department">Department:</label>
                            <select name="department_id" class="form-control" required>
                                <option value="">Select Department</option>
                                <?php foreach ($departments as $department): ?>
                                    <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
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
            </div>
        </div>
    </div>
</body>
</html>
