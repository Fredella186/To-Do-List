<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "tdl";

$conn = mysqli_connect($server, $user, $pass, $db);

if (!$conn) {
    die("Database Error!");
}
?>