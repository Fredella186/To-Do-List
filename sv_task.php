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
else if($act == "edit"){
    $sql = "update tb_task set task_name='$task_name', task_date='$task_date', task_desc='$task_desc', priority_id='$priority_id', user_id='$user_id', category_id='$category_id',reminder_id='$reminder_id'  WHERE id='$id' ";
    $query = mysqli_query($conn, $sql);
}
else if($act == "loading"){
    $sql = "select t.*, c.category_name, c.category_img from tb_task t left join tb_category c on t.category_id = c.id where user_id='$user_id' and status_id=1 ";
    $query = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_array($query)) {
        $task_id = $result['id'];
        $task_title = $result['task_name'];
        $task_deadline = $result['task_date'];
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
                    <img src="assets/picture/time.png">
                    <p class="text6 white regular"><?php echo $task_deadline; ?></p>

                    <button type="button" onclick="delete_task(<?php echo $task_id; ?>, 1)" name="delete">Delete</button>
                    
                    <button type="button" onclick="location.href='task_update.php?task_id=<?php echo $task_id; ?>'">Edit</button>
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
        $task_deadline = $result['task_date'];
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
                    <img src="assets/picture/time.png">
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






       