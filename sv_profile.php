<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act'] ?? '';
$id = $_POST['id'] ?? '';
$username = $_POST['username'] ?? '';
$fullname = $_POST['fullname'] ?? '';
$email = $_POST['email'] ?? '';
$old_password = $_POST['old_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';

if ($act == "editProfile") {
    $sql = "SELECT * FROM tb_user WHERE id='$user_id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);

    $username = $result['username'];
    $fullname = $result['fullname'];
    $email = $result['email'];

    echo "|" . $username . "|" . $fullname . "|" . $email . "|";
} else if ($act == "saveProfile") {
    $profile_img = ''; // initialize variable with an empty value

    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['size'] > 0) {
        // User uploads a new file
        $file = $_FILES['profile_img'];
        $file_name = md5($file['name']) . '_' . date('y-m-d') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_tmp = $file['tmp_name'];

        // Destination folder
        $folder = './assets/picture/';

        // Move the file to the destination folder
        if (move_uploaded_file($file_tmp, $folder . $file_name)) {
            // File successfully uploaded to the destination folder
            $profile_img = $file_name;
        } else {
            echo 'Failed to upload the file.';
            exit; // Exit the script as file upload failed
        }
    } else {
        // User doesn't upload a new file, use the data from the database
        $sqlProfile = "SELECT profile_img FROM tb_user WHERE id='$user_id'";
        $queryProfile = mysqli_query($conn, $sqlProfile);
        $resultProfile = mysqli_fetch_array($queryProfile);
        $profile_img = $resultProfile['profile_img'];
    }

    $sqlcheckpass = "SELECT password, pet_id FROM tb_user WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sqlcheckpass);
    $result = mysqli_fetch_array($query);
    $pass = $result['password']; // MD5 hashed password
    $current_pet_id = $result['pet_id'];

    $action_type = "updateProfile";
    $addition_command = "";
    $exec = true;

    if (!empty($new_password)) {
        if (md5($old_password) == $pass) {
            $new_password = md5($new_password);
            $addition_command .= ", password = '$new_password'";
            $action_type = "updateProfilePassword";
        } else {
            $message = "Your old password is incorrect!";
            $action_type = "wrongPassword";
            $exec = false;
        }
    }

    if ($exec) {
        $sql = "UPDATE tb_user SET fullname='$fullname', profile_img='$profile_img', email='$email' $addition_command WHERE id='$user_id'";
        $query = mysqli_query($conn, $sql) or die($sql);

        $message = "Data has been successfully updated";
    }

    echo "|" . $action_type . "|" . $message . "|";
}
?>
