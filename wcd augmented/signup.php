<?php
include('connect.php');

try {
    if (isset($_POST['signup'])) {
        if (empty($_POST['email'])) {
            throw new Exception("Email can't be empty.");
        }
        if (empty($_POST['uname'])) {
            throw new Exception("Username can't be empty.");
        }
        if (empty($_POST['pass'])) {
            throw new Exception("Password can't be empty.");
        }
        if (empty($_POST['fname'])) {
            throw new Exception("Full name can't be empty.");
        }
        if (empty($_POST['phone'])) {
            throw new Exception("Phone number can't be empty.");
        }
        if (empty($_POST['type'])) {
            throw new Exception("Role can't be empty.");
        }
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['uname']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $fullname = mysqli_real_escape_string($conn, $_POST['fname']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $query = "INSERT INTO admininfo (username, password, email, fname, phone, type) 
                  VALUES ('$username', '$password', '$email', '$fullname', '$phone', '$type')";

        if (!mysqli_query($conn, $query)) {
            throw new Exception("Failed to insert data: " . mysqli_error($conn));
        }

        $success_msg = "Signup Successfully!";
    }
} catch (Exception $e) {
    $error_msg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Attendance Management System </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<header>
    <h1>Online Attendance Management System </h1>
</header>
<center>
    <h1>Signup</h1>
    <div class="content">
        <div class="row">
            <?php
            if (isset($success_msg)) echo "<div class='alert alert-success'>$success_msg</div>";
            if (isset($error_msg)) echo "<div class='alert alert-danger'>$error_msg</div>";
            ?>
            <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-7">
                        <input type="email" name="email" class="form-control" id="input1" placeholder="your email" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-7">
                        <input type="text" name="uname" class="form-control" id="input1" placeholder="choose username" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-7">
                        <input type="password" name="pass" class="form-control" id="input1" placeholder="choose a strong password" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Full Name</label>
                    <div class="col-sm-7">
                        <input type="text" name="fname" class="form-control" id="input1" placeholder="your full name" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Phone Number</label>
                    <div class="col-sm-7">
                        <input type="text" name="phone" class="form-control" id="input1" placeholder="your phone number" required />
                    </div>
                </div>
                <div class="form-group" class="radio">
                    <label for="input1" class="col-sm-3 control-label">Role</label>
                    <div class="col-sm-7">
                        <label>
                            <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
                        </label>
                        <label>
                            <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
                        </label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Signup" name="signup" />
            </form>
        </div>
        <br>
        <p><strong>Already have an account? <a href="index.php">Login</a> here.</strong></p>
    </div>
</center>
</body>
</html>
