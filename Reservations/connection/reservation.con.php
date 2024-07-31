<?php
session_start();

function between($val, $x, $y)
{
    $val_len = strlen($val);
    return ($val_len >= $x && $val_len <= $y) ? TRUE : FALSE;
}

if (isset($_POST['reserv-submit'])) {
    require 'db.con.php';

    $user = $_SESSION['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['num_guests'];
    $tele = $_POST['tele'];
    $comments = $_POST['comments'];

    if ($guests == 1 || $guests == 2) {
        $tables = 1;
    } else {
        $tables = ceil(($guests - 2) / 2);
    }

    if (empty($fname) || empty($lname) || empty($date) || empty($time) || empty($guests) || empty($tele)) {
        header("Location: ../reservation.php?error3=emptyfields");
        exit();
    } else if (!preg_match("/^[a-zA-Z ]*$/", $fname) || !between($fname, 2, 20)) {
        header("Location: ../reservation.php?error3=invalidfname");
        exit();
    } else if (!preg_match("/^[a-zA-Z ]*$/", $lname) || !between($lname, 2, 40)) {
        header("Location: ../reservation.php?error3=invalidlname");
        exit();
    } else if (!preg_match("/^[0-9]*$/", $guests) || !between($guests, 1, 3)) {
        header("Location: ../reservation.php?error3=invalidguests");
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $tele) || !between($tele, 6, 20)) {
        header("Location: ../reservation.php?error3=invalidtele");
        exit();
    } else if (!preg_match("/^[a-zA-Z 0-9]*$/", $comments) || !between($comments, 0, 200)) {
        header("Location: ../reservation.php?error3=invalidcomment");
        exit();
    } else {
        $sql = "SELECT t_tables FROM tables WHERE t_date='$date'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $a_tables = $row["t_tables"];
            }
        } else {
            $a_tables = 20;
        }

        $sql = "SELECT SUM(num_tables) FROM reservations
         WHERE rdate='$date' AND time_zone='$time'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $current_tables = $row["SUM(num_tables)"];
            }
        }
        if ($current_tables + $tables > $a_tables) {
            header("Location: ../reservation.php?error3=full");
        } else {
            $sql = "INSERT INTO reservations(f_name, l_name, num_guests, num_tables, rdate, time_zone, telephone, comment, user_fk) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                // SQL query preparation error
                $error_message = mysqli_stmt_error($stmt);
                header("Location: ../reservation.php?error3=" . urlencode($error_message));
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "sssssssss", $fname, $lname, $guests, $tables, $date, $time, $tele, $comments, $user);

                if (mysqli_stmt_execute($stmt)) {
                    // Successful reservation
                    header("Location: ../reservation.php?reservations=success");
                    exit();
                } else {
                    // SQL query execution error
                    $error_message = mysqli_stmt_error($stmt);
                    header("Location: ../reservation.php?error3=" . urlencode($error_message));
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
