<?php
include "config/security.php"; //kalau ada session harus letakkan paling atas
include "config/connection.php";
?>

    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- add -->
    <div id="divAdd" class="overlayAdd" style="display:flex; flex_direction:row;">
        <div id="wrapper_add_task">
            <div class="left">
                <p class="text4 white black" id="title_task">Add New Task</p>
                <div class="task_insert">
                    <p class="text4 white bold">Title</p>
                    <input type="text" id="task_name" name="task_name" value="">
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Description</p>
                    <input type="text" id="task_desc" name="task_desc" value="">
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Date</p>
                    <input type="date" id="task_date" name="task_date" value="">
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Time</p>
                    <input type="time" id="task_time" name="task_time" value="">
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
                        <p class="text4 white bold">Due Date</p>
                        <input type="date" id="task_date" name="task_date" value="">
                    </div>
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
                    <input type="submit" class="text4 white" onclick="save_task()">Add 
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>


    <!-- Edit -->
    <div id="divUpdate" class="overLayUpdate">
        <div id="wrapper_update_task">
            <div class="left">
                <p class="text4 white black" id="edit_title_task">Edit Task</p>
                <div class="task_insert">
                    <p class="text4 white bold">Title</p>
                    <input type="text" id="edit_task_name" name="edit_task_name" value="">
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Description</p>
                    <input type="text" id="edit_task_desc" name="edit_task_desc" value="">
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Date</p>
                    <input type="date" id="edit_task_date" name="edit_task_date" value="">
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Time</p>
                    <input type="time" id="edit_task_time" name="edit_task_time" value="">
                </div>
                <div class="task_insert">
                    <p class="text4 white bold">Category</p>
                    <select name="edit_category_id" id="edit_category_id">
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
                    <select name="edit_priority_id" id="edit_priority_id">
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
                        <input type="date" id="edit_task_date" name="edit_task_date" value="">
                    </div>
                    <div class="date_time">
                        <p class="text4 white bold">Reminder</p>
                        <select name="edit_reminder_id" id="edit_reminder_id">
                            <?php
                            $query = "SELECT id, reminder_time FROM tb_reminder";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['id'] . '">' . $row['reminder_time'] . '</option>';
                            }
                            ?>   
                        </select>
                    </div>
                    <input type="submit" class="text4 white" id="button_edit_task" onclick="update_task()">Save
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.7.0.js"></script>
    <script src="assets/js/script.js"></script>


