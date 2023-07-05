<?php
session_start();
include "config/connection.php";

if (isset($_POST['task_id']) && !empty($_POST['task_id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['task_id']);
    
    $sql = "DELETE FROM tb_task WHERE id = '$id'";
} else {
    echo "<script>alert('Invalid request'); window.history.back();</script>";
}
?>
