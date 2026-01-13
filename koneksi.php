<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo "Failed connect to MySQL".mysqli_connect_error();
    exit();
}
?>