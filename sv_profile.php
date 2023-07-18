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
$pet_id = $_POST['pet_id'];

if ($act == "editProfile") {
    $sql = "SELECT * FROM tb_user WHERE id='$user_id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);

    $username = $result['username'];
    $fullname = $result['fullname'];
    $email = $result['email'];
    $pet_id = $result['pet_id'];

    $response = [
        'action_type' => 'editProfile',
        'username' => $username,
        'fullname' => $fullname,
        'email' => $email,
        'pet_id' => $pet_id
    ];

    echo json_encode($response);
} else if ($act == "saveProfile") {
    $user_id = $_REQUEST['id'];
    $profile_img = ''; // inisialisasi variable dengan nilai default kosong

    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['size'] > 0) {
        // user mengunggah file baru
        $file = $_FILES['profile_img'];
        $file_name = md5($file['name']) . '_' . date('y-m-d') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_tmp = $file['tmp_name'];

        //folder tujuan
        $folder = './assets/picture/';

        //pindahkan file ke dalam folder tujuan
        if (move_uploaded_file($file_tmp, $folder . $file_name)) {
            // File berhasil diunggah ke folder tujuan.
            $profile_img = $file_name;
        } else {
            $response = [
                'action_type' => 'error',
                'message' => 'Gagal mengunggah file.'
            ];
            echo json_encode($response);
            exit; // Keluar dari script karena gagal mengunggah file.
        }
    } else {
        // User tidak mengunggah file baru, gunakan data yang ada di database
        $sqlProfile = "SELECT profile_img FROM tb_user WHERE id='$user_id'";
        $queryProfile = mysqli_query($conn, $sqlProfile);
        $resultProfile = mysqli_fetch_array($queryProfile);
        $profile_img = $resultProfile['profile_img'];
    }

    $sqlcheckpass = "SELECT password, pet_id FROM tb_user WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sqlcheckpass);
    $result = mysqli_fetch_array($query);
    $pass = $result['password']; // bentuknya MD5
    $current_pet_id = $result['pet_id'];

    $action_type = "updateProfile";
    $addition_command = "";
    $exec = true;

    if (empty($pet_id)) {
        $sqlpet = "SELECT pet_id FROM tb_user WHERE id = '$user_id'";
        $petquery = mysqli_query($conn, $sqlpet);
        $resultpet = mysqli_fetch_array($petquery);
        $pet_id = $resultpet['pet_id'];
    }

    if ($new_password != "") {
        if ($old_password == $pass) {
            $new_password = md5($new_password);
            $addition_command .= ", password = '$new_password'";
            $action_type = "updateProfilePassword";
        } else {
            $response = [
                'action_type' => 'error',
                'message' => 'Password lama Anda salah!'
            ];
            echo json_encode($response);
            exit;
        }
    }

    if ($exec) {
        $sql = "UPDATE tb_user SET fullname='$fullname', profile_img='$profile_img', email='$email', pet_id='$pet_id' $addition_command WHERE id='$user_id'";
        $query = mysqli_query($conn, $sql) or die($sql);

        $response = [
            'action_type' => $action_type,
            'message' => 'Data Berhasil diubah'
        ];

        echo json_encode($response);
    }
}
?>
