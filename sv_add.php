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
$reminder_id = $_POST['reminder_id'];


    $sql_insert = "INSERT INTO tb_task (task_name, task_date, task_desc, task_time, priority_id,  category_id, reminder_id, user_id, status_id) 
     VALUES ('$task_name','$task_date','$task_desc','$task_time','$priority_id','$category_id','$reminder_id','$user_id','1')";


$run_query_check = mysqli_query($conn, $sql_insert) or die($sql_insert) ;
    if (!$run_query_check) {
        die('Query error: ' . mysqli_error($conn));
    } else {
        ?>
        <script>
            alert("New Task Succeed");
        </script>
        <?php
        header("Refresh:0.1; url=home.php");
    }
    ?>
