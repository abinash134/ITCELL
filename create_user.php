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

// Initialize variables to store error messages
$username_error = $password_error = $role_error = '';

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if(empty(trim($_POST['username']))) {
        $username_error = "Please enter a username.";
    } else {
        $username = trim($_POST['username']);
    }

    // Validate password
    if(empty(trim($_POST['password']))) {
        $password_error = "Please enter a password.";
    } elseif(strlen(trim($_POST['password'])) < 6) {
        $password_error = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate role
    if(empty($_POST['role'])) {
        $role_error = "Please select a role.";
    } else {
        $role_id = $_POST['role'];
    }

    // If there are no errors, proceed to insert user into database
    if(empty($username_error) && empty($password_error) && empty($role_error)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Construct the SQL query to insert the user data
        $query = "INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES (NULL,'$username', '$hashed_password', '$role_id')";

        // Execute the SQL query
        $result = mysqli_query($conn, $query);

        if($result) {
            // Redirect to dashboard with success message
            $_SESSION['success_message'] = "User created successfully!";
            header('Location: dashboard.php');
            exit();
        } else {
            // Redirect to create user page with error message
            $_SESSION['error_message'] = "Error creating user. Please try again.";
            header('Location: create_user.php');
            exit();
        }
    }
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
                    <li class="list-group-item active"><a href="create_user.php">Create User</a></li>
                    <!-- Add more options as needed -->
                </ul>
            </div>
            <!-- Main content -->
            <div class="col-md-9">
                <div class="container mt-5">
                    <h2>Create New User</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" class="form-control" required>
                            <span class="text-danger"><?php echo $username_error; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" required>
                            <span class="text-danger"><?php echo $password_error; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role" class="form-control" required>
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-danger"><?php echo $role_error; ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
