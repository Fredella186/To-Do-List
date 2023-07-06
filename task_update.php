<?php
include "config/security.php";
include "config/connection.php";
$id = isset($_GET['task_id']) ? $_GET['task_id'] : "";
$id = mysqli_real_escape_string($conn, $id);
$sql = "SELECT * FROM tb_task WHERE id='$id'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($query);

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
    <form method="POST" action="sv_update.php">
        <div id="task_add">
        <input type="hidden" name="id" value="<?= $task_id; ?>">
            <div id="task_add_content">
                <div class="left">
                    <p class="text4 white black">Edit New Task</p>
                    <div class="task_insert">
                        <p class="text4 white bold">Title</p>
                        <input type="text" id="task_name" name="task_name" value="<?= $data['task_name']; ?>">
                    </div>
                    <div class="task_insert">
                        <p class="text4 white bold">Description</p>
                        <input type="text" id="task_desc" name="task_desc" value="<?= $data['task_desc']; ?>">
                    </div>
                    <div class="task_insert">
                        <p class="text4 white bold">Time</p>
                        <input type="time" id="task_time" name="task_time" value="<?= $data['task_time']; ?>">
                    </div>
                    <div class="task_insert">
                        <p class="text4 white bold">Category</p>
                        <select name="category_id" id="category_id">
                            <?php
                            $query = "SELECT id, category_name FROM tb_category";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = ($row['id'] == $data['category_id']) ? 'selected' : '';
                                echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['category_name'] . '</option>';
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
                                $selected = ($row['id'] == $data['category_id']) ? 'selected' : '';
                                echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['title'] . '</option>';
                            }
                            ?>     

                        </select>
                    </div>
                </div>
            <div class="rigth">
                <div class="task_reminder">
                    <div class="date_time">
                        <p class="text4 white bold">Due Date</p>
                        <input type="date" id="task_date" name="task_date" value="<?= $data['dates']; ?>">
                    </div>
                    <div class="date_time">
                        <p class="text4 white bold">Remainder</p>
                        <select name="reminder_id" id="reminder_id">
                        <?php
                            $query = "SELECT id, reminder_time FROM tb_reminder";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = ($row['id'] == $data['category_id']) ? 'selected' : '';
                                echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['reminder_time'] . '</option>';
                            }
                            ?>   
                        </select>
                    </div>
                    <input type="submit" class="text4 black">Save</input>
                </div>
            </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>