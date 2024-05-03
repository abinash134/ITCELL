<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Technician Login</title>
    <!-- Include any necessary stylesheets or scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Technician Login</div>
                    <div class="card-body">
                        <?php
                        session_start();
                        include_once 'db.php';

                        // Check if the user is already logged in
                        if(isset($_SESSION['user_id'])) {
                            header('Location: technician_dashboard.php');
                            exit();
                        }

                        // Check if the login form is submitted
                        if(isset($_POST['login'])){
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $role_id = 3; // Set role_id for technician

                            // Query to fetch user data based on username and role_id
                            $query = "SELECT * FROM users WHERE username = '$username' AND role_id = $role_id";
                            $result = mysqli_query($conn, $query);

                            // Check if query execution was successful
                            if(!$result) {
                                die('Error in SQL query: ' . mysqli_error($conn));
                            }

                            // Check if any rows are returned
                            if(mysqli_num_rows($result) == 1){
                                $row = mysqli_fetch_assoc($result);
                                if(password_verify($password, $row['password'])) {
                                    // Set session variables
                                    $_SESSION['user_id'] = $row['id'];
                                    $_SESSION['username'] = $row['username'];
                                    $_SESSION['role_id'] = $row['role_id'];

                                    // Redirect to technician dashboard
                                    header('Location: technician_dashboard.php');
                                    exit();
                                } else {
                                    $error = "Invalid password";
                                }
                            } else {
                                $error = "Invalid username or role";
                            }
                        }
                        ?>
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <!-- Technician login form -->
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
