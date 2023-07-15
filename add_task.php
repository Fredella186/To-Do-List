<?php   
include "config/security.php";
include "config/connection.php";
    $user_id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $profile_img = $_SESSION['profile_img'];
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div id="divAdd" class="overlayAdd" style="visibility:hidden;">
        <div id="wrapper_add_task">
            <div class="left">
            
            <div class="close_add white"><a href="home.php">&times;</a></div>
                <p class="text4 white " id="title_task">Add New Task</p>
                <td><input type="hidden" name="task_id" class="id form-control" id="task_   id" value=""></td>
                <div class="task_insert">
                    <p class="text4 white bold" id="title_task"></p>
                    <input type="text" id="task_name" name="task_name" class="white" value="">
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Description</p>
                    <input type="text" id="task_desc" name="task_desc" class="white" value="">
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Date</p>
                    <input type="date" id="task_date" name="task_date"  value="">
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Time</p>
                    <input type="time" id="task_time" name="task_time"  value="">
                </div>
                <div >
                <div class="task_insert">
                    <p class="text4 white bold">Category</p>
                    <select name="category_id" id="category_id">
                        <?php
                        $query = "SELECT id, category_name FROM tb_category";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['id'] . '">' . $row['category_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Priority</p>
                    <select name="priority_id" id="priority_id">
                        <?php
                        $query = "SELECT id, title FROM tb_priority";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                        }
                        ?>     
                    </select>
                </div>
            </div>
            <div class="rigth">
                <div class="task_reminder">
                    <div class="date_time">
                        <p class="text4 white bold">Reminder</p>
                        <select name="reminder_id" id="reminder_id">
                            <?php
                            $query = "SELECT id, reminder_time FROM tb_reminder";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['id'] . '">' . $row['reminder_time'] . '</option>';
                            }
                            ?>   
                        </select>
                    </div>
                    <br>
                    <input type="submit" class="text4 white" onclick="save_task(this.value)" id="tambah" name="tambah" value="tambah">Add 
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</body>
</html>
