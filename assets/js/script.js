function check_task(task_id){
    $.ajax({
        url: 'sv_task.php',
        method: 'POST',
        data: {
            id: task_id,
            act: 'set_done'
        },
        success: function(result){
            get_data();
            completed_task();
            completed_score();
            total_score();
            pet_name();
            pet_picture();
        }
    });
}

function uncheck_task(task_id){
    $.ajax({
        url: 'sv_task.php',
        method: 'POST',
        data: {
            id: task_id,
            act: 'not_done'
        },
        success: function(result){
            get_data();
            completed_task();
            completed_score();
            total_score();

        }
    });
}

function get_data(){ //refresh active tasks 
    $.ajax({
        url: 'sv_task.php',
        method: 'POST',
        data: {
            act: 'loading'
        },
        success: function(result){
            $("#active_tasks").html(result);
        } 
    });
}

function completed_task(){ //refresh completed tasks
    $.ajax({
        url: 'sv_task.php',
        method: 'POST',
        data: {
            act: 'complete'
        },
        success: function(result){
            $("#complete_tasks").html(result);
        }
    });
}

function delete_task(id, type){
  var conf = confirm("Apakah ingin menghapus?");
    if(conf){
    $.ajax({
        url: 'sv_task.php',
        method: 'POST',
        data: {
            id: id,
            act: 'delete',
        },
        success: function( result ) {
            if( type == 1) { //1 untuk active
                get_data();
            }else{
                completed_task();
            }
        }
    });
    }
}


function edit_task(task_id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: task_id,
      act: "editTask",
    },
    success: function (result) {
      $("#divAdd").css("visibility", "visible");
      $("#divAdd").show();
      $("#title_task").html("Edit Task");
      $("#tambah").val("Edit");
      var data = result.split("|");
      $("#task_id").val(data[1]);
      $("#task_name").val(data[2]);
      $("#task_desc").val(data[3]);
      $("#category_id").val(data[4]);
      $("#priority_id").val(data[5]);
      $("#task_date").val(data[6]);
      $("#task_time").val(data[7]);

      //window.location.href = 'add_task.php?edit_task=' + task_id;
      
      // id = $("#id").val(data[7])s
      // $('#tambah').unbind('click');
      // $('#tambah').on("click",function(){
      //   update_task();
      // });     
    },
  });
}

function update_task() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      task_name: $("#task_name").val(),
      task_desc: $("#task_desc").val(),
      category_id: $("#category_id").val(),
      priority_id: $("#priority_id").val(),
      task_date: $("#task_date").val(),
      task_time: $("#task_time").val(),
      id: $("#task_id").val(),
      act: "updateTask",
    },
    success: function () {
      alert("Data berhasil diubah!");
      get_data();
      completed_task();

      $("#divAdd").css("visibility", "hidden");
      $("#divAdd").css("display", "block");
      window.scroll(0,0);
    },
  });
}

function add_task(){  
  $("#divAdd").css("visibility", "visible");
  $("#divAdd").show();
      $("#title_task").html("Edit Task");
      $("#title_task").html("Add Task");
      $("#id").val("");
      $("#task_name").val("");
      $("#task_date").val("");
      $("#task_desc").val("");
      $("#priority_id").val("title_priority");
      $("#category_id").val("title_category");
      $("#reminder_id").val("title_reminder");
      $("#status_id").val("");

}

function checkReminder() {
  $.ajax({
      url: "sv_task.php",
      method: "POST",
      data: {
          act: "checkReminder",
      },
      success: function (result) {
        // Check the actual response from the server
        $('#reminderResult').html(result);

      }
  });
}

    function save_task(act_button) {
      var reminder_value = $("#reminder_value").val();
      var reminder_unit = $("#reminder_unit").val();
    
      // Validate reminder value and unit
      if (reminder_value === "" || isNaN(reminder_value) || reminder_unit === "") {
        alert("Please enter a valid reminder value and unit.");
        return;
      }
    
      if (act_button == "tambah") {
        $.ajax({
          url: "sv_task.php",
          method: "POST",
          data: {
            task_name: $("#task_name").val(),
            task_desc: $("#task_desc").val(),
            category_id: $("#category_id").val(),
            priority_id: $("#priority_id").val(),
            task_date: $("#task_date").val(),
            task_time: $("#task_time").val(),
            reminder_id: $("#reminder_id").val(),
            task_id: $("#task_id").val(),
            reminder_value: reminder_value,
            reminder_unit: reminder_unit,
            collaborator: $(".js-example-basic-multiple").val(), // Menambahkan data kolaborator ke dalam AJAX request
            act: "saveTask",
          },
          success: function (response) {
            // Display success message for saving task
            alert("Data successfully saved!");
    
            // Check reminders after successfully saving the task
            checkReminder();
          },
          error: function (xhr, status, error) {
            console.error("Error saving task: " + error);
          },
        });
      } else {
        // Update task function (if needed)
        update_task();
      }
    }
    

    // Check reminders every 10 seconds (adjust the interval as needed)
   



  //filter

  function filter_task() {
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    var filter_status = $("#filter_status").val();
    $.ajax({
      url: "sv_task.php",
      method: "POST",
      data: { 
        act: "filters",
        start_date: start_date, 
        end_date: end_date, 
        filter_status: filter_status
    },
      success: function(result) {
        $('#filter_result').html(result);
      }
    });
  }



function pet_picture(){
  // console.log("tes");
  $.ajax({
    url: 'sv_task.php',
    method: 'POST',
    data: {
      act: 'pet_picture',
    },
    success: function(result){
      $("#pet_picture").html(result);

    }
  });
}

function pet_name(){
  // console.log("tes");
  $.ajax({
    url: 'sv_task.php',
    method: 'POST',
    data: {
      act: 'pet_name',
    },
    success: function(result){
      $("#pet_name").html(result);
    }
  });
}

function total_score(task_id){
  $.ajax({
      url: 'sv_task.php',
      method: 'POST',
      data: {
        task_id: task_id,
          act: 'total_score',
      },
      success: function(result){
          $("#total_score").html(result);
      }
  });
}

function completed_score(task_id){
  $.ajax({
      url: 'sv_task.php',
      method: 'POST',
      data: {
        task_id: task_id,
          act: 'completed_score',
      },
      success: function(result){
          $("#completed_score").html(result);
      }
  });
}



