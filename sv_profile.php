<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; // membedakan prosesnya
$id = $_POST['id'] ?? '';
$user_id = $_SESSION['id'];
$username = $_POST['username'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$old_password = md5($_POST['old_password']);
$new_password = $_POST['new_password'];

if ($act == "editProfile") {
    $sql = "select * from tb_user where id='$user_id'";
    $query = mysqli_query($conn,$sql);
    $result = mysqli_fetch_array($query);

    $user_id = $id;
    $username = $result['username'];
    $fullname = $result['fullname'];
    $email = $result['email'];

    echo "|" . $username . "|" . $fullname . "|" . $email . "|";
}
else if($act == "saveProfile"){

    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['size'] > 0) {
        // User mengunggah file baru
        $file = $_FILES['profile_img'];
        $file_name = md5($file['name']) . '_' . date('y-m-d') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_tmp = $file['tmp_name'];

        // Folder tujuan
        $folder = './assets/images/profile/';

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($file_tmp, $folder . $file_name)) {
            echo 'File berhasil diunggah ke folder tujuan.';

            // Atur profile_img = $file_name
            $profile_img = $file_name;
        } else {
            echo 'Gagal mengunggah file.';
        }
    } else {
        // User tidak mengunggah file baru, gunakan data yang ada di database
        $sqlProfile = "SELECT profile_img FROM tb_user WHERE id = '$user_id'";
        $queryProfile = mysqli_query($conn, $sqlProfile);
        $resultProfile = mysqli_fetch_array($queryProfile);
        $profile_img = $resultProfile['profile_img'];
    }


    $sqlcheckpass = "SELECT password, pet_id from tb_user WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sqlcheckpass);
    $result = mysqli_fetch_array($query);
    $pass = $result['password']; //bentuknya MD5
    $current_pet_id = $result['pet_id'];
    $profile_img = $result['profile_img']

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
        $sql = "update tb_user set fullname='$fullname', profile_img='$profile_img', email='$email' $addition_command where id='$user_id'";
        $query = mysqli_query($conn,$sql) or die($sql);

        $message = "Data Berhasil diubah";
    }

    echo "|" . $action_type . "|" . $message . "|";

}
?>
