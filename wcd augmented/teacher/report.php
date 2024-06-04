<?php

ob_start();
session_start();

if ($_SESSION['name'] != 'oasis') {
    header('location: login.php');
}
?>
<?php include('connect.php'); ?>

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
        <a href="teachers.php">Faculties</a>
        <a href="attendance.php">Attendance</a>
        <a href="report.php">Report</a>
        <a href="../logout.php">Logout</a>
    </div>
</header>

<center>
    <div class="row">
        <div class="content">
            <h3>Individual Report</h3>
            <form method="post" action="">
                <label>Select Subject</label>
                <select name="whichcourse">
                    <option value="algo">Analysis of Algorithms</option>
                    <option value="algolab">Analysis of Algorithms Lab</option>
                    <option value="dbms">Database Management System</option>
                    <option value="dbmslab">Database Management System Lab</option>
                    <option value="weblab">Web Programming Lab</option>
                    <option value="os">Operating System</option>
                    <option value="oslab">Operating System Lab</option>
                    <option value="obm">Object Based Modeling</option>
                    <option value="softcomp">Soft Computing</option>
                </select>
                <p></p>
                <label>Student Reg. No.</label>
                <input type="text" name="sr_id">
                <input type="submit" name="sr_btn" value="Go!">
            </form>

            <h3>Mass Report</h3>
            <form method="post" action="">
                <label>Select Subject</label>
                <select name="course">
                    <option value="algo">Analysis of Algorithms</option>
                    <option value="algolab">Analysis of Algorithms Lab</option>
                    <option value="dbms">Database Management System</option>
                    <option value="dbmslab">Database Management System Lab</option>
                    <option value="weblab">Web Programming Lab</option>
                    <option value="os">Operating System</option>
                    <option value="oslab">Operating System Lab</option>
                    <option value="obm">Object Based Modeling</option>
                    <option value="softcomp">Soft Computing</option>
                </select>
                <p></p>
                <label>Date (yyyy-mm-dd)</label>
                <input type="text" name="date">
                <input type="submit" name="sr_date" value="Go!">
            </form>
            <br><br>

            <?php
            if (isset($_POST['sr_btn'])) {
                $sr_id = $_POST['sr_id'];
                $course = $_POST['whichcourse'];

                $single = mysqli_query($conn, "SELECT stat_id, COUNT(*) as countP FROM attendance WHERE stat_id='$sr_id' AND course='$course' AND st_status='Present'");
                $singleT = mysqli_query($conn, "SELECT COUNT(*) as countT FROM attendance WHERE stat_id='$sr_id' AND course='$course'");

                if ($row = mysqli_fetch_assoc($singleT)) {
                    $count_tot = $row['countT'];
                }

                if ($data = mysqli_fetch_assoc($single)) {
                    ?>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td>Student Reg. No:</td>
                            <td><?php echo $data['stat_id']; ?></td>
                        </tr>
                        <tr>
                            <td>Total Class (Days):</td>
                            <td><?php echo $count_tot; ?></td>
                        </tr>
                        <tr>
                            <td>Present (Days):</td>
                            <td><?php echo $data['countP']; ?></td>
                        </tr>
                        <tr>
                            <td>Absent (Days):</td>
                            <td><?php echo $count_tot - $data['countP']; ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <?php
                }
            }

            if (isset($_POST['sr_date'])) {
                $sdate = $_POST['date'];
                $course = $_POST['course'];

                $all_query = mysqli_query($conn, "SELECT * FROM attendance WHERE stat_date='$sdate' AND course='$course'");
                ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Reg. No.</th>
                        <th scope="col">Course</th>
                        <th scope="col">Date</th>
                        <th scope="col">Attendance Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($all_query)) {
                        ?>
                        <tr>
                            <td><?php echo $data['stat_id']; ?></td>
                            <td><?php echo $data['course']; ?></td>
                            <td><?php echo $data['stat_date']; ?></td>
                            <td><?php echo $data['st_status']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            }
            ?>
        </div>
    </div>
</center>

</body>
</html>
