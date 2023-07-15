//profile
else if($act == "editProfile"){
$sql = "SELECT * FROM tb_user WHERE id = '$id'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);

// Retrieve the profile information
$user_id = $id;
$profile_img = $result['profile_img'];
$username = $result['username'];
$email = $result['email'];
$password = $result['password'];
$pet_id = $result['pet_id'];

// Return the profile information as a response
echo "|" . $user_id . "|" . $profile_img . "|" . $username . "|" . $email . "|" . $password . "|" . $pet_id. "|";
}
else if ($act == "pet_picture"){
    $sql = "select phase_img from tb_phase join tb_user on tb_user.current_pet_phase=tb_phase.id join tb_pet on tb_pet.id=tb_user.pet_id where xp<=min_xp and xp>=max_xp and tb_user.id='$user_id'";
    $query = mysqli_query($conn,$sql);

}
