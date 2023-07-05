<?php   
include "config/security.php";
include "config/connection.php";
    $user_id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $profile_img = $_SESSION['profile_img']
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <form>
        <div id="task_add">
            <div id="task_add_content">
                <div class="left">
                    <p class="text4 white black">Add New Task</p>
                    <div class="task_insert">
                        <p class="text4 white bold">Title</p>
                        <input type="text" id="title" name="title">
                    </div>
                    <div class="task_insert">
                        <p class="text4 white bold">Description</p>
                        <input type="text" id="desc" name="desc">
                    </div>
                    <div class="task_insert">
                        <p class="text4 white bold">Category</p>
                        <select name="category" id="category">
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
                        <select name="priority" id="priority">
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
                        <p class="text4 white bold">Due Date</p>
                        <input type="date" id="dates" name="dates">
                    </div>
                    <div class="date_time">
                        <p class="text4 white bold">Remainder</p>
                        <select name="reminder" id="reminder">
                        <?php
                            $query = "SELECT id, reminder_time FROM tb_reminder";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['id'] . '">' . $row['reminder_time'] . '</option>';
                            }
                            ?>   
                        </select>
                    </div>
                    <input type="submit" class="text4 black">CREATE TASK</input>
                </div>
            </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>