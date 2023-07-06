<?php
session_start();
include "config/connection.php";


$id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "DELETE FROM tb_task WHERE id = '$id'";
mysqli_query($conn, $sql);

$url = "home.php";
$pesan = "Data berhasil dihapus";

echo "<script> alert('$pesan'); location='$url'; </script>";
?>