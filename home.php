<?php   
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$profile_img = $_SESSION['profile_img'];

// Mendapatkan data foto profil yang sudah diupdate
$sql = "SELECT profile_img FROM tb_user WHERE id = '$user_id'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($query);
$updated_profile_img = $result['profile_img'];

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
                <img class="profile_img" src="./assets/picture/<?php echo $updated_profile_img; ?>" alt="">
            </div>
            <div class="profile_name">
                <p class="text1 white"><?php echo $username; ?></p>
                <p class="text3 white"><?php echo $email; ?></p>
            </div>
            <button name="edit_profile_button" id="edit_profile_button"><a href="edit_profile.php">Edit Profile</a></button>
        </div>
        <div class="score">
            <div class="pet_picture" id="pet_picture">
                <p class="white">loading......</p>
            </div>
            <div class="pet_name white bold text5" id="pet_name">
                <p class="white">loading......</p>
            </div>
            <div class="score_bar">
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
                <p class="text4 white bold your_task">Your task</p>
                <a href="add_task.php" ><button style="margin-right: 100px;">Add</button></a>
                <a href="report.php"><button>Filter</button></a>
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
    <script src="assets/js/script.js"></script>
    <script src="assets/js/jquery-3.7.0.js"></script>
    <script>
        $(document).ready(function(){
            get_data();
            completed_task();
            completed_score();
            total_score();
            pet_picture();
            pet_name();
        });
        setTimeout(function(){
        location.reload(true);
        }, 60000);
    </script>
</body>
</html>
