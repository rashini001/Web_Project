<?php

$servername = "localhost";
$dBUsername = "user";
$dBPassword = "Ra1shi**";
$dBName = "restaurant";

$con = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$con){
    die("Connection failed:" .mysqli_connect_error());
}
// else {
//     echo "Connected successfully";
// }
?>