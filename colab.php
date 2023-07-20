<?php
include "config/security.php";
include "config/connection.php";
    $user_id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $profile_img = $_SESSION['profile_img'];
    $sql = "select * from tb_task where id = '$task_id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder</title>
</head>
<body>
<!DOCTYPE html>
<html>
  <title>Task dengan Collaborator</title>
  <!-- Tambahkan link CSS dari CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
<input type="hidden" name="taskName" class="taskName" id="taskName" value="<?php echo $result['task_id'] ?>">
<input type="hidden" name="user_id" class="user_id" id="user_id" value="<?php echo $result['user_id']  ?>">
  <h1>Tambahkan Collaborator untuk Task</h1>
  <select class="js-example-basic-multiple" name="states[]" multiple="multiple" id="collab_select">
  <?php
    $query = "SELECT id, username FROM tb_user";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['username'] . '</option>';
    }
  ?>
</select>
<button id="collab_button">Save</button>
  <script>
    // Inisialisasi Select2 untuk elemen dengan ID collaboratorSelect
    $(document).ready(function() {
    $('.collab_select').select2({
        multiple:true
    });
});
  </script>
</body>
</html>
