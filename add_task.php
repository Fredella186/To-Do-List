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
<div id="divAdd" class="overlayAdd" style=" margin-left:50px; ">
        <div id="wrapper_add_task">
            <div class="left">
            
            <div class="close_add white"><a href="home.php">&times;</a></div>
                <p class="text4 white " id="title_task">Add New Task</p>
                <td><input type="hidden" name="task_id" class="id form-control" id="task_id" value=""></td>
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
                <div class="task_reminder" id="task_reminder">
                    <div class="date_time">
                        <p class="text4 white bold">Reminder</p>
                        <div class="reminder_number_form">
                            <audio id="reminderSound" src="assets/audio/ringtone.mp3" preload="auto" hidden></audio>
                            <input class="reminder_value" id="reminder_value" name="reminder_value" type="number">
                            <br><br>
                            <select name="reminder_unit" id="reminder_unit">
                                <option value="minutes" default selected="selected">Minute</option>
                                <option value="hours">Hour</option>
                                <option value="days">Day</option>
                            </select>
                        </div>
                    </div>
                    <div class="task_collabolator">
                        <p class="text4 white bold">Add Collabolator</p>
                        <div class="customSelect">
                        <select class="js-example-basic-multiple" name="collaborator[]" multiple="multiple" id="collaborator">
                        <option class="option" value="" selected disabled>Add collaborator</option>
                        <?php
                        $user_id = $_SESSION['id'];
                        $sqlCollab = "SELECT id, username FROM tb_user WHERE id != '$user_id'";
                        $queryCollab = mysqli_query($conn, $sqlCollab);
                        while ($resultCollab = mysqli_fetch_array($queryCollab)) {
                            ?>
                            <option value="<?php echo $resultCollab['id'] ?>"><?php echo $resultCollab['username'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

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
<script src="./assets/js/jquery-3.7.0.js"></script>
<script src="./assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script>
        $(document).ready(function(){
             $('.js-example-basic-multiple').select2();
        });
        </script>
</html>
