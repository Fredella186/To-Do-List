function edit_profile(id) {
  $.ajax({
      url: "sv_profile.php",
      method: "POST",
      data: {
          id: id,
          act: "editProfile",
      },
      success: function (result) {
          var data = result.split("|");

          $("#username").val(data[1]);
          $("#fullname").val(data[2]);
          $("#email").val(data[3]);
      }
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
    success: function(result) {
      if (result.includes('File berhasil diunggah ke folder tujuan.')) {
        $('#current_profile_img').attr('src', result.file_path);
        alert('Foto profil berhasil diunggah!');
      } else {
        try {
          var data = JSON.parse(result);
          var actionType = data[1];
          alert(data[2]);
    
          if (actionType == "updateProfilePassword") {
            window.location = "logout.php";
          } else if (actionType == "wrongPassword") {
            $("#new_password").val("");
            $("#old_password").val("");
          }
        } catch (error) {
          console.error("Error parsing JSON:", error);
        }
      }
    },
    
    error: function() {
      $("#err").html("Terjadi kesalahan pada server.").fadeIn();
    },
  });
}


function uploadProfileImage(form_data) {
  $.ajax({
    url: "sv_profile.php",
    method: "POST",
    contentType: false,
    processData: false,
    data: form_data,
    success: function(response) {
      var data = JSON.parse(response);
      if (data.success) {
        $('#current_profile_img').attr('src', data.file_path);
        alert('Foto profil berhasil diunggah!');
      } else {
        $('#err').html('Terjadi kesalahan saat mengunggah foto profil.').fadeIn();
      }
    },
    error: function() {
      $('#err').html('Terjadi kesalahan pada server.').fadeIn();
    }
  });
}
