function edit_profile(id) {
  $.ajax({
    url: "sv_profile.php",
    method: "POST",
    data: {
      id: id,
      act: "editProfile",
    },
    success: function(result) {
      var data = JSON.parse(result);

      $("#username").val(data.username);
      $("#fullname").val(data.fullname);
      $("#email").val(data.email);
      $("#pet_id").val(data.pet_id);
    },
  });
}

function save_profile() {
  var form_data = new FormData();

  // Cek apakah ada file foto profil yang dipilih
  if ($("#profile_image").prop("files").length > 0) {
    var file_data = $("#profile_image").prop("files")[0];
    form_data.append("profile_img", file_data);
  }

  form_data.append("username", $("#username").val());
  form_data.append("fullname", $("#fullname").val());
  form_data.append("email", $("#email").val());
  form_data.append("pet_id", $("#pet_id").val());
  form_data.append("old_password", $("#old_password").val());
  form_data.append("new_password", $("#new_password").val());
  form_data.append("id", $("#user_id").val());
  form_data.append("act", "saveProfile");

  $.ajax({
    url: "sv_profile.php",
    method: "POST",
    contentType: false,
    processData: false,
    data: form_data,
    success: function(response) {
      try {
        var data = JSON.parse(response);
        if (data.success) {
          $('#current_profile_img').attr('src', data.file_path);
          alert('Foto profil berhasil diunggah!');
        } else {
          var actionType = data.action_type;
          alert(data.message);
          window.location = "edit_profile.php";

          if (actionType == "updateProfilePassword") {
            window.location = "logout.php";
          } else if (actionType == "wrongPassword") {
            $("#new_password").val("");
            $("#old_password").val("");
          }
        }
      } catch (error) {
        $('#err').html('Terjadi kesalahan pada server.').fadeIn();
      }
    },
    error: function() {
      $('#err').html('Terjadi kesalahan pada server.').fadeIn();
    },
  });
}
