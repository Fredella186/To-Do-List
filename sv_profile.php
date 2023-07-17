<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; // membedakan prosesnya
$id = $_POST['id'] ?? '';
$username = $_POST['username'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$old_password = md5($_POST['old_password']);
$new_password = $_POST['new_password'];

if ($act == "editProfile") {
    $sql = "SELECT * FROM tb_user WHERE id='$user_id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);

    $username = $result['username'];
    $fullname = $result['fullname'];
    $email = $result['email'];

    echo "|" . $username . "|" . $fullname . "|" . $email . "|";
} else if ($act == "saveProfile") {
    $sqlcheckpass = "SELECT password, pet_id, profile_img FROM tb_user WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sqlcheckpass);
    $result = mysqli_fetch_array($query);
    $pass = $result['password']; // bentuknya MD5
    $current_pet_id = $result['pet_id'];
    $profile_img = $result['profile_img'];

    $action_type = "updateProfile";
    $addition_command = "";
    $exec = true;

    if ($new_password != "") {
        if ($old_password == $pass) {
            $new_password = md5($new_password);
            $addition_command .= ", password = '$new_password'";
            $action_type = "updateProfilePassword";
        } else {
            $message = "password lama Anda salah!";
            $action_type = "wrongPassword";
            $exec = false;
        }
    }

    if ($exec) {
        $sql = "UPDATE tb_user SET fullname='$fullname', email='$email' $addition_command WHERE id='$user_id'";
        $query = mysqli_query($conn, $sql) or die($sql);

        $message = "Data Berhasil diubah";
    }

    echo "|" . $action_type . "|" . $message . "|";
}
?>
