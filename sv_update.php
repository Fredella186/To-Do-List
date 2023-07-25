<?php
session_start();
include "config/connection.php";

$task_name = $_POST['task_name'];
$task_date = $_POST['task_date'];
$task_desc = $_POST['task_desc'];
$task_time = $_POST['task_time'];
$priority_id = $_POST['priority_id'];
$user_id = $_SESSION['id'];
$category_id = $_POST['category_id'];


    $sql_update = "update tb_task set task_name= '$task_name', task_date= '$task_date', task_desc='$task_desc', task_time= '$task_time', priority_id= '$priority_id', category_id= '$category_id' , status_id=1 where id='$user_id'";
    $run_query_check = mysqli_query($conn, $sql_update)  ;
    
?>