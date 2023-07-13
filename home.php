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
    <div class="left">
        <div class="profile">
            <div class="profile_picture">
                <img  class="profile_img" src=" ./assets/picture/<?php echo $profile_img; ?>" alt="">
            </div>
            <div class="profile_name">
                <p class="text1 white"><?php echo $username; ?></p>
                <p class="text3 white"><?php echo $email; ?></p>
            </div>
        </div>
        <div class="score">
            <div class="pet_picture">
                <img src="assets\picture\pet.png">
            </div>
            <div class="score_bar">
                <p class="text5 white bold">Rocky</p>
                <div class="score_persen" id="completed_score">
                    <p class="white">loading......</p>
                </div>
                <div class="score_persen" id="total_score">
                    <p class="white">loading......</p>
                </div>
            </div>
        </div>
    </div>
    <div class="right">
        <div>
        <div class="task_top">
            <p class="text4 white bold">Your task</p>
            <a id="button_add" href="#divAdd"><img src="assets\picture\task.png"></a>
        </div>
        <div class="task_active_list" id="active_tasks">
            <p class="white">loading......</p>
        </div>
        </div>
        <div class="task_bottom">
            <p class="text4 white bold">Completed Task</p>
            <div class="task_more">
                <p class="text4 regular white">See more</p>
            <img src="assets\picture\arrow.png">
            </div>
        </div>
        <div class="task_active_list" id="complete_tasks">
            <p class="white">loading......</p>
        </div>
        
        </div>


        <!-- add -->
    <div id="divAdd" class="overlayAdd" style="visibility:hidden;">
        <div id="wrapper_add_task">
            <div class="left">
            <div class="close_add white"><a href="home.php">&times;</a></div>
                <p class="text4 white black" id="title_task">Add New Task</p>
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

        <script>
        document.addEventListener("DOMContentLoaded", function() {
        var buttons = document.getElementById("button_add");
        var add_target = document.getElementById("divAdd");

        buttons.addEventListener("click", function() {
            add_target.style.visibility = "visible";
        });
        });
        </script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/jquery-3.7.0.js"></script>
    <script>
        $(document).ready(function(){
            get_data();
            completed_task();
            completed_score();
            total_score();
        });
    </script>

</body>
</html>

    

