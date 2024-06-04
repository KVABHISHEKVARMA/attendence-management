<?php
ob_start();
session_start();
if ($_SESSION['name'] != 'oasis') {
    header('location: ../login.php');
}
?>
<?php include('connect.php'); ?>
<?php 
try {
    if (isset($_POST['done'])) {
        if (empty($_POST['name'])) {
            throw new Exception("Name cannot be empty");
        }
        if (empty($_POST['dept'])) {
            throw new Exception("Department cannot be empty");
        }
        if (empty($_POST['batch'])) {
            throw new Exception("Batch cannot be empty");
        }
        if (empty($_POST['email'])) {
            throw new Exception("Email cannot be empty");
        }
        $sid = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $dept = mysqli_real_escape_string($conn, $_POST['dept']);
        $batch = mysqli_real_escape_string($conn, $_POST['batch']);
        $semester = mysqli_real_escape_string($conn, $_POST['semester']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $query = "UPDATE students SET st_name='$name', st_dept='$dept', st_batch='$batch', st_sem='$semester', st_email='$email' WHERE st_id='$sid'";
        if (mysqli_query($conn, $query)) {
            $success_msg = 'Updated successfully';
        } else {
            throw new Exception('Error updating record: ' . mysqli_error($conn));
        }
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
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<header>
    <h1>Online Attendance Management System </h1>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="students.php">Students</a>
        <a href="report.php">My Report</a>
        <a href="account.php">My Account</a>
        <a href="../logout.php">Logout</a>
    </div>
</header>
<center>
    <div class="row">
        <div class="content">
            <h3>Update Account</h3>
            <br>
            <p>
            <?php
                if (isset($success_msg)) {
                    echo $success_msg;
                }
                if (isset($error_msg)) {
                    echo $error_msg;
                }
            ?>
            </p>
            <br>
            <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="input1" class="col-sm-3 control-label">Registration No.</label>
                    <div class="col-sm-7">
                        <input type="text" name="sr_id" class="form-control" id="input1" placeholder="enter your reg. no. to continue" required />
                    </div>
                </div>
                <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn" />
            </form>
            <div class="content"></div>

            <?php
            if (isset($_POST['sr_btn'])) {
                $sr_id = mysqli_real_escape_string($conn, $_POST['sr_id']);
                $all_query = mysqli_query($conn, "SELECT * FROM students WHERE st_id='$sr_id'");
                while ($data = mysqli_fetch_array($all_query)) {
            ?>
            <form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">
                <table class="table table-striped">
                    <tr>
                        <td>Registration No.:</td>
                        <td><?php echo $data['st_id']; ?></td>
                    </tr>
                    <tr>
                        <td>Student's Name:</td>
                        <td><input type="text" name="name" value="<?php echo $data['st_name']; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Department:</td>
                        <td><input type="text" name="dept" value="<?php echo $data['st_dept']; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Batch:</td>
                        <td><input type="text" name="batch" value="<?php echo $data['st_batch']; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Semester:</td>
                        <td><input type="text" name="semester" value="<?php echo $data['st_sem']; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" value="<?php echo $data['st_email']; ?>" required></td>
                    </tr>
                    <input type="hidden" name="id" value="<?php echo $sr_id; ?>">
                    <tr>
                        <td></td>
                        <td><input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Update" name="done" /></td>
                    </tr>
                </table>
            </form>
            <?php 
                }
            }  
            ?>
        </div>
    </div>
</center>
</body>
</html>
