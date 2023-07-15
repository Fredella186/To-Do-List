<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "todolist";

$conn = mysqli_connect($server, $user, $pass, $db);

if (!$conn) {
    die("Database Error!");
}
?>