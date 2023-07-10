<?php
include "config/security.php"; //kalau ada session harus letakkan paling atas
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; //membedakan prosesnya
$id = $_POST['id'];

if($act == "set_done"){
    $sql = "update tb_task set status_id=2 where id='$id'";
    $query = mysqli_query($conn, $sql);
} 
else if($act == "not_done"){
    $sql = "update tb_task set status_id=1 where id='$id'";
    $query = mysqli_query($conn, $sql);
}
else if ($act == "completed_score") {
    $sql = "SELECT COUNT(*) AS completed_score FROM tb_task WHERE  user_id='$user_id' AND status_id = 2 ";
    $query = mysqli_query($conn, $sql);
    while ($completedTasks = mysqli_fetch_array($query)){
        ?>
        <div class="score_bar">
            <div class="score_persen">
                <p class="text4 white bold"><?php echo $completedTasks['completed_score']; ?> Task Completed</p>
            </div>
        </div>
        <?php
    }
}
else if ($act == "total_score") {
    $sql = "SELECT COUNT(*) * 10 AS total_score FROM tb_task WHERE user_id='$user_id' AND status_id = 2";
    $query = mysqli_query($conn, $sql);
    while ($totalScore = mysqli_fetch_array($query)){
        ?>
        <div class="score_bar">
                <p class="text4 white bold"><?php echo $totalScore['total_score']; ?>XP</p>
        </div>
        <?php
    }
}
else if( $act == "delete" ){
    $sql = "delete from tb_task where id='$id'";
    $query = mysqli_query($conn, $sql);
}
else if ($act === "saveTask"){
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
    
}
else if ($act == "editTask") {
    $sql = "SELECT * FROM tb_task WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    $task_id = $result['id'];
    $task_name = $result['task_name'];
    $task_desc = $result['task_desc'];
    $task_date = $result['task_date'];
    $task_time = $result['task_time'];
    // $priority_id = $result['priority_id'];
    $category_id = $result['category_id'];
    // $reminder_id = $result['reminder_id'];
    echo "|" . $task_name . "|" . $task_desc . "|" . $category_id . "|" . $priority_id . "|" . $task_date . "|" . $task_time . "|" . $task_id;

} else if ($act == "updateTask") {
    $task_id = $_POST['id'];
    $task_name = $_POST['task_name'];
    $task_desc = $_POST['task_desc'];
    $category_id = $_POST['category_id'];
    $priority_id = $_POST['priority_id'];
    $task_date = $_POST['task_date'];
    $task_time = $_POST['task_time'];
    // $reminder_id = $_POST['reminder_id'];
    // $status_id = $_POST['status_id'];
    $sql_update = "UPDATE tb_task SET task_name = '$task_name', task_date = '$task_date', task_time = '$task_time', task_desc = '$task_desc', priority_id = '$priority_id', user_id = '$user_id', category_id = '$category_id' WHERE id = '$task_id'";
    $run_query_check = mysqli_query($conn, $sql_update);
}
/*Filter*/
else if ($act == "filters") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $filter_status = $_POST['filter_status'];

    $sql = "select t.*, c.category_name, c.category_img from tb_task t left join tb_category c on t.category_id = c.id where user_id='$user_id'";

    if ($filter_status !== "all") {
        $sql .= " and status_id ='$filter_status'";
    }

    if ($start_date !== '' && $end_date !== '') {
        $sql .= " and (t.task_date between date('$start_date') and date('$end_date'))";
    } else if ($start_date == '' && $end_date !== '') {
        $sql .= " and (t.task_date between date('0000-00-00') and date('$end_date'))";
    } else if ($start_date !== '' && $end_date == '') {
        $sql .= " and (t.task_date between date('$start_date') and NULL)";
    }

    $sql .= " order by t.task_date asc";
    $query = mysqli_query($conn,$sql);
    while ($result = mysqli_fetch_array($query)) {
        $task_id = $result['id'];
        $task_title = $result['task_name'];
        $task_deadline = $result['task_date'];
        $task_desc = $result['task_desc'];
        $user_id = $result['user_id'];
        $category = $result['category_name'];
        $category_img = $result['category_img'];
        ?>
        <div class="task_main">
            <div class="task_picture">
                <img src="assets/picture/<?php echo $category_img; ?>">
            </div>
            <div class="task_desc">
                <p class="text1 black bold"><?php echo $task_title; ?></p>
                <div class="task_time">
                    <img src="assets/picture/time.png">
                    <p class="text6 black regular"><?php echo $task_deadline; ?></p>
                </div>
                <p class="text2 black regular"><?php echo $task_desc; ?></p>
            </div>
        </div>
        <?php
    }
}

else if($act == "loading"){
    $sql = "select t.*, c.category_name, c.category_img from tb_task t left join tb_category c on t.category_id = c.id where user_id='$user_id' and status_id=1 ";
    $query = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_array($query)) {
        $task_id = $result['id'];
        $task_title = $result['task_name'];
        $task_deadline = $result['task_date'] == date('Y-m-d') ? 'Today' : date('d-m-Y', strtotime($result['task_date']));
        $task_time = $result['task_time'] == "00:00:00" ? '' : date('H:i', strtotime($result['task_time']));
        $task_desc = $result['task_desc'];
        $category = $result['category_name'];
        $category_img = $result['category_img'];
        ?>
        <div class="task_main">
            <div class="task_picture">
                <img src="assets/picture/<?php echo $category_img; ?>">
            </div>
            <div class="task_desc">
                <p class="text1 white bold"><?php echo $task_title; ?></p>
                <div class="task_time">
                    <p class="text6 white regular"><?php echo $task_time; ?></p>
                    <p class="text6 white regular"><?php echo $task_deadline; ?></p>

                    <button type="button" id="edit_undone<?php echo $task_id; ?>" onclick="delete_task(<?php echo $task_id; ?>, 1)" name="delete">Delete</button>
                    
                    <button type="button" id="edit_undone<?php echo $task_id; ?>" onclick="editTask(<?php echo $task_id; ?>)">Edit</button>

                </div>
                <p class="text2 white regular"><?php echo $task_desc;?></p>
            </div>
            <div class="task_check">
                <input type="checkbox" id="undone<?php echo $task_id; ?>" onclick="check_task(<?php echo $task_id; ?>)"/>
            </div>
        </div>

        
<?php
    }
}

else if($act == "complete"){
    $sql = "select t.*, c.category_name, c.category_img from tb_task t left join tb_category c on t.category_id = c.id where user_id='$user_id' and status_id=2";
    $query = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_array($query)) {
        $task_id = $result['id'];
        $task_title = $result['task_name'];
        $task_deadline = $result['task_date'] == date('Y-m-d') ? 'Today' : date('d-m-Y', strtotime($result['task_date']));
        $task_time = $result['task_time'] == "00:00:00" ? '' : date('H:i', strtotime($result['task_time']));
        $task_desc = $result['task_desc'];
        $category = $result['category_name'];
        $category_img = $result['category_img'];
        ?>
        <div class="task_main">
            <div class="task_picture">
                <img src="assets/picture/<?php echo $category_img?>">
            </div>
            <div class="task_desc">
                <p class="text1 white bold"><?php echo $task_title;?></p>
                <div class="task_time">
                    <p class="text6 white regular"><?php echo $task_time; ?></p>
                    <p class="text6 white regular"><?php echo $task_deadline;?></p>
                    <button type="button" onclick="delete_task(<?php echo $task_id; ?>)" name="delete">Delete</button>
                </div>
                <p class="text2 white regular"><?php echo $task_desc;?></p>
            </div>
            <div class="task_check">
                <input type="checkbox" id="done<?php echo $task_id; ?>" onclick="uncheck_task(<?php echo $task_id; ?>)" checked/>
            </div>
        </div>
<?php
    }
}
?>






       