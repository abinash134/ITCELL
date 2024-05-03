<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Role Selection</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom CSS styles here */
        .tab {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        .tab:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Select Your Role</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-around">
                    <div class="tab" onclick="location.href='admin_login.php';">Admin</div>
                    <div class="tab" onclick="location.href='technician_login.php';">Technician</div>
                    <div class="tab" onclick="location.href='department_login.php';">Department</div>
                    <div class="tab" onclick="location.href='super_admin_login.php';">Super Admin</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
