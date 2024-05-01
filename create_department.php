<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Department</title>
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
                    <li class="list-group-item active"><a href="create_department.php">Create Department</a></li>
                    <!-- Add more options as needed -->
                </ul>
            </div>
            <!-- Main content -->
            <div class="col-md-9">
                <div class="container mt-5">
                    <h2>Create New Department</h2>
                    <form action="process_create_department.php" method="POST">
                        <div class="form-group">
                            <label for="name">Department Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
