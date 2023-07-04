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
                <img src="assets\picture\profile.png">
            </div>
            <div class="profile_name">
                <p class="text1 white">Code Blaze</p>
                <p class="text3 white">codeblaze@gmail.com</p>
            </div>
        </div>
        <div class="score">
            <div class="pet_picture">
                <img src="assets\picture\pet.png">
            </div>
            <div class="score_bar">
                <p class="text5 white bold">Rocky</p>
                <div class="score_persen">
                <p class="text4 white bold">30 Task Completed</p>
                <p class="text4 white bold">30%</p>
                </div>
            </div>
        </div>
    </div>
    <div class="right">
        <div class="task_top">
            <p class="text4 white bold">Your task</p>
            <a href="#task_add"><img src="assets\picture\task.png"></a>
        </div>
        <div class="task_main">
            <div class="task_picture">
                <img src="assets\picture\study.png">
            </div>
            <div class="task_desc">
                <p class="text1 white bold">Membuat To Do List</p>
                <div class="task_time">
                    <img src="assets\picture\time.png">
                    <p class="text6 white regular">Jul 5</p>
                </div>
                <p class="text2 white regular">Penugasan code blaze yang mana...</p>
            </div>
            <div class="task_check">
                <input type="checkbox" id="check" name="check">
            </div>
        </div>
        <div class="task_main">
            <div class="task_picture">
                <img src="assets\picture\study.png">
            </div>
            <div class="task_desc">
                <p class="text1 white bold">Membuat To Do List</p>
                <div class="task_time">
                    <img src="assets\picture\time.png">
                    <p class="text6 white regular">Jul 5</p>
                </div>
                <p class="text2 white regular">Penugasan code blaze yang mana...</p>
            </div>
            <div class="task_check">
                <input type="checkbox" id="check" name="check">
            </div>
        </div>
        <div class="task_main">
            <div class="task_picture">
                <img src="assets\picture\study.png">
            </div>
            <div class="task_desc">
                <p class="text1 white bold">Membuat To Do List</p>
                <div class="task_time">
                    <img src="assets\picture\time.png">
                    <p class="text6 white regular">Jul 5</p>
                </div>
                <p class="text2 white regular">Penugasan code blaze yang mana...</p>
            </div>
            <div class="task_check">
                <input type="checkbox" id="check" name="check">
            </div>
        </div>
        <div class="task_bottom">
            <p class="text4 white bold">Completed Task</p>
            <div class="task_more">
                <p class="text4 regular white">See more</p>
            <img src="assets\picture\arrow.png">
            </div>
        </div>
        <div class="task_main">
            <div class="task_picture">
                <img src="assets\picture\study.png">
            </div>
            <div class="task_desc">
                <p class="text1 white bold">Membuat To Do List</p>
                <div class="task_time">
                    <img src="assets\picture\time.png">
                    <p class="text6 white regular">Jul 5</p>
                </div>
                <p class="text2 white regular">Penugasan code blaze yang mana...</p>
            </div>
            <div class="task_check">
                <input type="checkbox" id="check" name="check" checked>
            </div>
        </div>
        <div class="task_main">
            <div class="task_picture">
                <img src="assets\picture\study.png">
            </div>
            <div class="task_desc">
                <p class="text1 white bold">Membuat To Do List</p>
                <div class="task_time">
                    <img src="assets\picture\time.png">
                    <p class="text6 white regular">Jul 5</p>
                </div>
                <p class="text2 white regular">Penugasan code blaze yang mana...</p>
            </div>
            <div class="task_check">
                <input type="checkbox" id="check" name="check" checked>
            </div>
        </div>
        <div id="task_add">
        <div class="close_popup">
                    <a href="#pricing" class="popup_close">&times;</a>
                </div>
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
                            <option value="meeting">Meeting</option>
                            <option value="study">Study</option>
                            <option value="medic">Medic</option>
                            <option value="sport">Sport</option>
                        </select>
                    </div>
                    <div class="task_insert">
                        <p class="text4 white bold">Priority</p>
                        <select name="priority" id="priority">
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                </div>
            <div class="rigth">
                <div class="task_reminder">
                    <div class="date_time">
                        <p class="text4 white bold">Due Date</p>
                        <select name="dates" id="dates">
                            <option value="today">Today, 10:00 PM</option>
                        </select>
                    </div>
                    <div class="date_time">
                        <p class="text4 white bold">Remainder</p>
                        <select name="reminder" id="reminder">
                            <option value="15">15 Minutes</option>
                            <option value="30">30 Minutes</option>
                            <option value="45">45 Minutes</option>
                        </select>
                    </div>
                    <div class="date_time">
                        <p class="text4 white bold">Repeat</p>
                        <select name="repeat" id="repeat">
                            <option value="1">1 Times</option>
                            <option value="2">2 Times</option>
                            <option value="3">3 Times</option>
                            <option value="4">4 Times</option>
                            <option value="5">5 Times</option>
                        </select>
                    </div>
                    <button type="submit" class="text4 black">CREATE TASK</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>