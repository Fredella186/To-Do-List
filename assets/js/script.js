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

function completed_score(){
    $.ajax({
        url: 'sv_task.php',
        method: 'POST',
        data: {
            act: 'completed_score',
        },
        success: function(result){
            $("#completed_score").html(result);
        }
    });
}

function total_score(){
    $.ajax({
        url: 'sv_task.php',
        method: 'POST',
        data: {
            act: 'total_score',
        },
        success: function(result){
            $("#total_score").html(result);
        }
    });
}

function edit_task(id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: id,
      act: "editTask",
    },
    success: function (result) {
      var data = result.split("|");
      var id = $("#id").val(data[1]);
      $("#title_task").html("Edit Task");
      $("#tambah").val("Edit");
      $("#id").val(data[1]);
      $("#edit_task_name").val(data[2]);
      $("#edit_task_date").val(data[3]);
      $("#edit_task_desc").val(data[4]);
      $("#edit_priority_id").val(data[5]);
      $("#edit_user_id").val(data[6]);
      $("#edit_category_id").val(data[7]);
      $("#edit_reminder_id").val(data[8]);
      $("#edit_status_id").val(data[9]);
      // id = $("#id").val(data[7]);

      $(".overlayUpdate").css("visibility", "visible");
      $(".overlayUpdate").css("opacity", 1);
      // $("#button_edit_task").unbind("click");
      // $("#button_edit_task").on("click", function () {
      //   update_task();
      // });

      $('#button_edit_task').unbind('click');
      $('#button_edit_task').on("click",function(){
        update_task();
      });
    },
  });
}

function update_task() {
  // console.log(document.getElementById("edit_task_time").value);
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      task_name: $("#edit_task_name").val(),
      task_desc: $("#edit_task_desc").val(),
      category_id: $("#edit_category_id").val(),
      priority_id: $("#edit_priority_id").val(),
      task_date: $("#edit_task_date").val(),
      task_time: $("#edit_task_time").val(),
      id: task_id,
      act: "updateTask",
    },
    success: function () {
      alert("Data berhasil diubah!");
      get_data();
      completed_task();
    },
  });
}



function save_task() {
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
      act: "saveTask",
    },
    success: function () {
      alert("Data berhasil disimpan!");
      get_data();
      completed_task();
      window.location = "#";
    },
  });
}
  
  

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


