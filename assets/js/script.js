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
      $("#title_task").html("Edit Task");
      $("#tambah").val("Edit");
      var data = result.split("|");
      $("#id").val(data[1]);
      $("#task_name").val(data[2]);
      $("#task_desc").val(data[3]);
      $("#category_id").val(data[4]);
      $("#priority_id").val(data[5]);
      $("#task_date").val(data[6]);
      $("#task_time").val(data[7]);
      
      // id = $("#id").val(data[7]);

      
      $('#tambah').unbind('click');
      $('#tambah').on("click",function(){
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
    },
  });
}

function add_task(){
  modal.style.display = "block";
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
      reminder_id: $("#reminder_id").val(),
      act: "saveTask",
    },
    success: function () {
      alert("Data berhasil disimpan!");
      get_data();
      completed_task();
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


