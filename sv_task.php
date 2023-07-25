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
    $task_id = $_POST['task_id'];
    $user_id = $_SESSION['id'];

    $sql = "SELECT COUNT(*) AS total_score FROM tb_task WHERE user_id='$user_id' AND status_id = 2";
    $query = mysqli_query($conn, $sql);
    $totalScore = mysqli_fetch_array($query);
    $total_score = $totalScore['total_score'];

    $sql_update = "UPDATE tb_user SET total_score = $total_score WHERE id='$user_id'";
    $query_update = mysqli_query($conn, $sql_update);

    if ($query_update) {
        ?>
        <div class="score_bar">
            <p class="text4 white bold"><?php echo $total_score; ?>Task Completed</p>
        </div>
        <?php
    } else {
        echo "Error updating total score: " . mysqli_error($conn);
    }
}

else if ($act == "total_score") {
    $task_id = $_POST['task_id'];
    $user_id = $_SESSION['id'];

    $sql = "SELECT COUNT(*) * 10 AS total_score FROM tb_task WHERE user_id='$user_id' AND status_id = 2";
    $query = mysqli_query($conn, $sql);
    $totalScore = mysqli_fetch_array($query);
    $xp = $totalScore['total_score'];

    $sql_update = "UPDATE tb_user SET xp = $xp WHERE tb_user.id='$user_id'";
    $query_update = mysqli_query($conn, $sql_update);

    if ($query_update) {
        ?>
        <div class="score_bar">
            <p class="text4 white bold"><?php echo $xp; ?>XP</p>
        </div>
        <?php
    } else {
        echo "Error updating XP: " . mysqli_error($conn);
    }
}
else if ($act == "pet_name") {
    $sql = "SELECT pet_id FROm tb_user WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);

    $pet_id = $result['pet_id'];
    $sql = "UPDATE tb_user
    SET current_pet_phase = (
        SELECT tb_phase.id
        FROM tb_phase
        LEFT JOIN tb_pet ON tb_phase.pet_id = tb_pet.id
        WHERE tb_user.xp >= tb_phase.min_xp AND tb_user.xp <= tb_phase.max_xp AND pet_id = $pet_id
        LIMIT 1    
    )
    WHERE id = '$user_id'";

    $query = mysqli_query($conn, $sql);

    $sql = "SELECT tb_phase.phase_name FROM tb_phase 
            JOIN tb_user ON tb_user.current_pet_phase = tb_phase.id 
            JOIN tb_pet ON tb_pet.id = tb_user.pet_id 
            WHERE tb_user.xp >= tb_phase.min_xp AND tb_user.xp <= tb_phase.max_xp AND tb_user.id = '$user_id'";

    $query = mysqli_query($conn, $sql);
    $update_pet = mysqli_fetch_array($query);
    $pet_name = $update_pet['phase_name'];

    ?>
    <div>
        <p><?php echo $pet_name ?></p>
    </div>
    <?php
}

else if ($act == "pet_picture") {
    $sql = "SELECT pet_id FROm tb_user WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    $pet_id = $result['pet_id'];

    $sql = "UPDATE tb_user
    SET current_pet_phase = (
        SELECT tb_phase.id
        FROM tb_phase
        LEFT JOIN tb_pet ON tb_phase.pet_id = tb_pet.id
        WHERE tb_user.xp >= tb_phase.min_xp AND tb_user.xp <= tb_phase.max_xp AND pet_id = $pet_id
        LIMIT 1     
    )
    WHERE id = '$user_id'";

    $query = mysqli_query($conn, $sql);

    $sql = "SELECT tb_phase.phase_img FROM tb_phase 
            JOIN tb_user ON tb_user.current_pet_phase = tb_phase.id 
            JOIN tb_pet ON tb_pet.id = tb_user.pet_id 
            WHERE tb_user.xp >= tb_phase.min_xp AND tb_user.xp <= tb_phase.max_xp AND tb_user.id = '$user_id'";

    $query = mysqli_query($conn, $sql);
    $update_pet = mysqli_fetch_array($query);
    $pet_image = $update_pet['phase_img'];

    ?>
    <div>
        <img class="pet_image" id="pet_image" src="assets/picture/<?php echo $pet_image; ?>" />
    </div>
    <?php
}


else if( $act == "delete" ){
    $sqlCollabolator = "delete from tb_collaborator where task_id='$id'";
    $queryCollabolator = mysqli_query($conn, $sqlCollabolator);
    $sqlReminder = "delete from tb_reminder where task_id='$id'";
    $queryReminder = mysqli_query($conn, $sqlReminder);
    $sql = "delete from tb_task where id='$id'";
    $query = mysqli_query($conn, $sql);
}
else if ($act == "saveTask") {
    $task_name = $_POST['task_name'];
    $task_date = $_POST['task_date'];
    $task_desc = $_POST['task_desc'];
    $task_time = $_POST['task_time'];
    $priority_id = $_POST['priority_id'];
    $user_id = $_SESSION['id'];
    $category_id = $_POST['category_id'];
    $reminder_id = $_POST['reminder_id'];
    $reminder_value = $_POST['reminder_value'];
    $reminder_unit = $_POST['reminder_unit'];
    $collaborator = $_POST['collaborator'];

    // Insert the task into the database
    $sql_insert = "INSERT INTO tb_task (task_name, task_date, task_desc, task_time, priority_id, category_id, user_id, status_id) 
                    VALUES ('$task_name','$task_date','$task_desc','$task_time','$priority_id','$category_id','$user_id','1')";

    $run_query_check = mysqli_query($conn, $sql_insert);

    if (!$run_query_check) {
        die('Query error: ' . mysqli_error($conn));
    } else {
        // Calculate the reminder time
        $timestamp = strtotime("$task_date $task_time");
        $reminder_time = 60; // Default reminder time is 1 minute (60 seconds)

        if ($reminder_unit === 'minutes') {
            $reminder_time *= $reminder_value;
        } elseif ($reminder_unit === 'hours') {
            $reminder_time *= $reminder_value * 60; // Convert hours to minutes
        } elseif ($reminder_unit === 'days') {
            $reminder_time *= $reminder_value * 60 * 24; // Convert days to minutes
        }

        $reminder_timestamp = $timestamp - $reminder_time;
        $reminder_date = date("Y-m-d", $reminder_timestamp);
        $reminder_time = date("H:i", $reminder_timestamp);

        // Get the task_id of the inserted task
        $sql_get_task_id = "SELECT id FROM tb_task WHERE task_name='$task_name' AND user_id='$user_id'";
        $result_get_task_id = mysqli_query($conn, $sql_get_task_id);

        if (!$result_get_task_id) {
            die('Query error: ' . mysqli_error($conn));
        }

        $row = mysqli_fetch_assoc($result_get_task_id);
        $task_id = $row['id'];

        // Save the reminder
        $sql_insert_reminder = "INSERT INTO tb_reminder (task_id, reminder_time, reminder_date) 
                               VALUES ('$task_id', '$reminder_time', '$reminder_date')";

        $run_query_reminder = mysqli_query($conn, $sql_insert_reminder);

        
    }
    if ($collaborator != "") {
        if (is_array($collaborator)) {
            // Hitung Array
            $arrayCollaboratorLength = count($collaborator);

            // Mengambil Id task terakhir
            $sqlGetTaskId = "SELECT id FROM tb_task ORDER BY id DESC LIMIT 1";
            $queryGetTaskId = mysqli_query($conn, $sqlGetTaskId);
            $resultGetTaskId = mysqli_fetch_array($queryGetTaskId);
            $task_id = $resultGetTaskId['id'];

            for ($i = 0; $i < $arrayCollaboratorLength; $i++) {

                $sqlCheckProfile = "SELECT id, username FROM tb_user WHERE id = '$collaborator[$i]'";
                $queryCheckProfile = mysqli_query($conn, $sqlCheckProfile);
                $resultCheckProfile = mysqli_fetch_array($queryCheckProfile);
                $username = $resultCheckProfile['username'];
                $collaborator_user_id = $resultCheckProfile['id'];

                // Menambahkan data ke tabel kolaborator berdasarkan id

                 $sqlCollaborator = "INSERT INTO tb_collaborator( task_id, collabolator_user_id,added_by ) VALUES('$task_id', '$collaborator_user_id','$user_id')";
                 mysqli_query($conn, $sqlCollaborator);

                 //menampilkan task kesetiap kolabolator

                 $sqlShowTask = "select task_id from tb_collaborator where collabolator_user_id = '$collaborator[$i]'";

            }
        }
    }
} else if ($act == "checkReminder") {
    // Menggunakan timezone Asia Jakarta
    date_default_timezone_set('Asia/Jakarta');

    // Mendapatkan tanggal dan waktu hari ini
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:00', time());

    // Mendapatkan seluruh task yang memiliki reminder hari ini
    $sqlGetReminder = "SELECT tb_reminder.*, tb_task.* FROM tb_reminder LEFT JOIN tb_task ON tb_reminder.task_id = tb_task.id WHERE reminder_date = '$currentDate' AND reminder_time = '$currentTime' AND tb_task.user_id = '$user_id' AND tb_task.status_id = 1";

    // Execute the query and check for errors
    $resultGetReminder = mysqli_query($conn, $sqlGetReminder);
    $queryGetReminder = mysqli_fetch_array($resultGetReminder);
    $task_reminder = $queryGetReminder['task_name'];
    $task_time_reminder = $queryGetReminder['task_time'];

    if (!$resultGetReminder) {
        die('Query error: ' . mysqli_error($conn));
        
    }

    // Check if there is a reminder that matches the current time
    if (mysqli_num_rows($resultGetReminder) > 0) {

        // There is a reminder that matches the current time
        ?>
        <div class="reminder_title">
            <a href="home.php">&times;</a>
            <center><p><?php echo $task_reminder?></p></center>
            <?php echo $task_time_reminder?> </p>
            <audio autoplay>
            <source src="assets/audio/ringtone.mp3" type="audio/mpeg">
            </audio>
        </div>  
        <?php
        exit;
    } 
}
 elseif ($act == "editTask") {
    $sql = "SELECT * FROM tb_task WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    $task_id = $result['id'];
    $task_name = $result['task_name'];
    $task_desc = $result['task_desc'];
    $task_date = $result['task_date'];
    $task_time = $result['task_time'];
    $priority_id = $result['priority_id'];
    $category_id = $result['category_id'];
    $reminder_id = $result['reminder_id'];
    echo "|" . $task_id ."|" . $task_name . "|" . $task_desc . "|" . $category_id . "|" . $priority_id . "|" . $task_date . "|" . $task_time . "|" . $task_id . "|" . $reminder_id;
} 
else if ($act == "updateTask") {
    $sql = "SELECT * FROM tb_task WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    $task_id = $result['id'];
    $task_name = $_POST['task_name'];
    $task_date = $_POST['task_date'];
    $task_desc = $_POST['task_desc'];
    $task_time = $_POST['task_time'];
    $priority_id = $_POST['priority_id'];
    $user_id = $_SESSION['id'];
    $category_id = $_POST['category_id'];
    $reminder_id = $_POST['reminder_id'];

    $sql_update = "update tb_task set task_name= '$task_name', task_date= '$task_date', task_desc='$task_desc', task_time= '$task_time', priority_id= '$priority_id', category_id= '$category_id' ,status_id=1, user_id = '$user_id' where tb_task.id='$task_id'";
    $run_query_check = mysqli_query($conn, $sql_update);
        if (!$run_query_check) {
            die('Query error: ' . mysqli_error($conn));
        } else {
            ?>
            <script>
                alert("Edit Task Succeed");
            </script>
            <?php
            header("Refresh:0.1; url=home.php");
        }
    //update reminder
    $timestamp = strtotime("$task_date $task_time");
        $reminder_time = 60; // Default reminder time is 1 minute (60 seconds)

        if ($reminder_unit === 'minutes') {
            $reminder_time *= $reminder_value;
        } elseif ($reminder_unit === 'hours') {
            $reminder_time *= $reminder_value * 60; // Convert hours to minutes
        } elseif ($reminder_unit === 'days') {
            $reminder_time *= $reminder_value * 60 * 24; // Convert days to minutes
        }

        $reminder_timestamp = $timestamp - $reminder_time;
        $reminder_date = date("Y-m-d", $reminder_timestamp);
        $reminder_time = date("H:i", $reminder_timestamp);

        // Get the task_id of the inserted task
        $sql_get_task_id = "SELECT id FROM tb_task WHERE task_name='$task_name' AND user_id='$user_id'";
        $result_get_task_id = mysqli_query($conn, $sql_get_task_id);

        if (!$result_get_task_id) {
            die('Query error: ' . mysqli_error($conn));
        }

        $row = mysqli_fetch_assoc($result_get_task_id);
        $task_id = $row['id'];

        // Save the reminder
        $sql_insert_reminder = "update tb_reminder set reminder_time = '$reminder_time' , reminder_date = '$reminder_date' where task_id = '$task_id'";

        $run_query_reminder = mysqli_query($conn, $sql_insert_reminder);
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
                <p class="text1 white    bold"><?php echo $task_title; ?></p>
                <div class="task_time">
                    <img src="assets/picture/time.png">
                    <p class="text6 white regular"><?php echo $task_deadline; ?></p>
                </div>
                <p class="text2 white regular"><?php echo $task_desc; ?></p>
            </div>
        </div>
        <?php
    }
}
else if($act == "loading"){
    // Load data from database dan juga menampilkan task yang di setiap kolaborator
    $sql = "SELECT t.*, c.category_name, c.category_img FROM tb_task t
    LEFT JOIN tb_category c ON t.category_id = c.id
    left join tb_collaborator a on t.id = a.task_id
    WHERE (user_id='$user_id' OR collabolator_user_id='$user_id') AND status_id=1";
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
                    <p class="text6 white regular"><?php echo $task_time; ?></p>
                    <p class="text6 white regular"><?php echo $task_deadline; ?></p>
                    <p class="text2 white regular"><?php echo $task_desc;?></p>
                    
            </div>
            <div class="task_check">
                <input type="checkbox" id="undone<?php echo $task_id; ?>" onclick="check_task(<?php echo $task_id; ?>)"/>
            </div>
            <button type="button" id="edit_undone<?php echo $task_id; ?>" onclick="delete_task(<?php echo $task_id; ?>, 1)" name="delete">Delete</button>
            <!-- <button type="button" id="edit_undone<?php echo $task_id; ?>" class="button_edit" value="Edit" onclick="edit_task(<?php echo $task_id; ?>)">Edit</button> -->
            <button type="button" class="button_edit" value="Edit" onclick="edit_task(<?php echo $task_id; ?>)">Edit</button>

            
        </div>
<?php
    }
}

else if($act == "complete"){
    $sql = "SELECT t.*, c.category_name, c.category_img FROM tb_task t
    LEFT JOIN tb_category c ON t.category_id = c.id
    left join tb_collaborator a on t.id = a.task_id
    WHERE (user_id='$user_id' OR collabolator_user_id='$user_id') AND status_id=2";
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
                    
                </div>
                <p class="text2 white regular"><?php echo $task_desc;?></p>
            </div>
            <div class="task_check">
                <input type="checkbox" id="done<?php echo $task_id; ?>" onclick="uncheck_task(<?php echo $task_id; ?>)" checked/>
            </div>
            <button type="button" onclick="delete_task(<?php echo $task_id; ?>)" name="delete">Delete</button>
        </div>
        <?php
    }
}
?>






       