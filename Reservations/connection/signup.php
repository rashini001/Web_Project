<?php
function between($val, $x, $y)
{
    $val_len = strlen($val);
    return ($val_len >= $x && $val_len <= $y) ? TRUE : FALSE;
}

if (isset($_POST['signup-submit'])) {
    require 'db.con.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../index1.php?error=emptyfields");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../index1.php?error=invalidemailusername");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index1.php?error=invalidemail");
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) || !between($username, 4, 20)) {
        header("Location: ../index1.php?error=invalidusername");
        exit();
    } else if (!between($password, 6, 20)) {
        header("Location: ../index1.php?error=invalidpassword");
        exit();
    } else if ($password !== $passwordRepeat) {
        header("Location: ../index1.php?error=passworddontmatch");
        exit();
    } else {

        $sql = "SELECT uidUsers, emailUsers FROM users WHERE uidUsers=? OR emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=error1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);     //elenxos an uparxei email kai username idi
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck != 0) {
                header("Location: ../index1.php?error=usernameemailtaken");
                exit();
            } else {
                $sql = "INSERT INTO users(uidUsers, emailUsers, pwdUsers) VALUES(?, ?, ?)";
                $stmt = mysqli_stmt_init($con);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index1.php?error=error2");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);    //encrypting password

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    $result = mysqli_stmt_execute($stmt);

                    if ($result) {
                        header("Location: ../index1.php?signup=success");
                        exit();
                    } else {
                        // Check for the specific error
                        $error_message = mysqli_stmt_error($stmt);
                        header("Location: ../index1.php?error=" . urlencode($error_message));
                        exit();
                    }
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    header("Location: ../index1.php");
    exit();
}
