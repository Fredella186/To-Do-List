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
    <title>Report</title>
</head>
<body>
    <div class="filter_body">
        <div class="profile">
                    <div class="profile_picture">
                        <img  class="profile_img" src=" ./assets/picture/<?php echo $profile_img; ?>" alt="">
                    </div>
                    <div class="profile_name">
                        <p class="text1 white"><?php echo $username; ?></p>
                        <p class="text3 white"><?php echo $email; ?></p>
                    </div>
        </div>
        <div class="filter_date_main">
            <p class="bold white text1">Date</p>
            <input type="date" id="start_date" name="start_date" value="">
            <p class="bold white text1">s/d<p>
            <input type="date" id="end_date" name="end_date"value="">
        </div>
        <div class="filter_status_main">
            <p class="bold white text1">Status</p>
            <select name="filter_status" id="filter_status">
                <option value="all">All</option>
                <option value="1">Active</option>
                <option value="2">Done</option>
            </select>
        </div>
        <br><br>
        <input type="button" id="filter_button" class="filter_button white bold" value="VIEW" onclick="filter_task()">
        <div id="filter_result" ></div>
    </div>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/jquery-3.7.0.js"></script>
</body>
</html>