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
    $.ajax({
        url: "sv_profile.php",
        method: "POST",
        data: {
            username: $("#username").val(),
            fullname: $("#fullname").val(),
            email: $("#email").val(),
            old_password: $("#old_password").val(),
            new_password: $("#new_password").val(),
            id: $("#user_id").val(),
            act: "saveProfile",
        },
        success: function (result) {
            var data = result.split("|");

            var actionType = data[1];
            alert(data[2]);
      
            if (actionType == "updateProfilePassword") {
              window.location = "logout.php";
            } else if (actionType == "wrongPassword") {
              $("#new_password").val("");
              $("#old_password").val("");
            }
          },
        });
      }