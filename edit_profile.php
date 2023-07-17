<?php
include "config/security.php";
include "config/connection.php";
$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$profile_img = $_SESSION['profile_img'];

$sql = "select * from tb_user where id = '$user_id'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="close_add white"><a href="home.php">&times;</a></div>
<input type="hidden" name="id" class="user_id" id="user_id" value="<?php echo $user_id ?>">
<div class="main_profile_content" id="main_profile_content" name="main_profile_content">
    <div class="title_profile" name="title_profile" id="title_profile">
        <p>Edit Profile</p>
    </div>
    <div class="change_profile_picture" id="change_profile_picture">
    <div class="profile_picture" id="profile_picture">
        <a href="profile.php"><img src="assets/picture/<?php echo $profile_img ?>" alt="Avatar" /></a>
    </div>
    <!--Untuk edit foto profile-->
    <form id="upload_form" enctype="multipart/form-data">
        <br>
        <input type="file" name="profile_image" id="profile_image">
    </form>
    </div>
    <div class="profile" id="profile">
        <p class="bold white margin">Username</p><br>
        <input type="text" name="username" id="username" value="<?php echo $result['username'] ?>" class="white" readonly>
    </div>
    <div class="profile" id="profile">
        <p class="bold white margin">Fullname</p>
        <input type="text" name="fullname" id="fullname" value="<?php echo $result['fullname'] ?>" class="white">
    </div>
    <div class="profile" id="profile">
        <p class="bold white">Email</p>
        <br>
        <input type="email" name="email" id="email" value="<?php echo $result['email'] ?>" class="white">
        <br>
    </div>
    <div class="profile" id="profile">
        <p class="bold white">Old Password</p>
        <input type="password" name="old_password" id="old_password" class="white">
    </div>
    <div class="profile" id="profile">
        <p class="bold white">New Password</p>
        <input type="password" name="new_password" id="new_password" class="white">
    </div>
    <div class="profile" id="profile">
        <p class="bold white">Your Pet</p>
        <select id="pet_id" name="pet_id">
            <option value="">Select Your Pet</option>
            <?php
            $query = "SELECT id, pet_name FROM tb_pet";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['id'] . '">' . $row['pet_name'] . '</option>';
            }
            ?>
        </select>
    </div>
    <button name="save_profile" id="save_profile" onclick="save_profile()">Save</button>
</div>
</body>
<script src="./assets/js/jquery-3.7.0.js"></script>
<script src="./assets/js/script-profile.js"></script>
<script src="https://kit.fontawesome.com/67a87c1aef.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
            edit_profile(<?php echo $user_id; ?>);
        });
</script>
</html>


