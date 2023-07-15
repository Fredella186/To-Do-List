
<html>
<input type="hidden" name="id" class="user_id" id="user_id" value="">
<div class="main_profile_content" id="main_profile_content" name="main_profile_content">
    <div class="title_profile" name="title_profile" id="title_profile">
        <p>Edit Profile</p>
    </div>
    <div class="img_profile_div" id="img_profile_div" name="img_profile_div">
        <img src="./assets/picture/" alt="" id="img_profile">
    </div>
    <div class="profile" id="profile">
        <p>Name</p>
        <input type="text" name="username" id="username" value="">
    </div>
    <div class="profile" id="profile">
        <p>Email</p>
        <input type="email" name="email" id="email" value="">
    </div>
    <div class="profile" id="profile">
        <p>Password</p>
        <input type="password" name="password" id="password" value="" autocomplete="on">
    </div>
    <div class="profile" id="profile">
        <p>Your Pet</p>
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
</html>