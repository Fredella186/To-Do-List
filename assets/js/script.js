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


function edit_task(id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: id,
      act: "editTask",
    },
    success: function (result) {
      $("#divAdd").css("visibility", "visible");
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
      
      // id = $("#id").val(data[7]);

      
      // $('#tambah').unbind('click');
      // $('#tambah').on("click",function(){
      //   update_task();
      // });
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

      $("#divAdd").css("visibility", "hidden");
      window.scroll(0,0);
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

function save_task(act_button) {
  if(act_button == "tambah"){
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
      $("#divAdd").css("visibility", "hidden");
    },
  });
  }else{
    update_task();
  }
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
      pet_picture();
      pet_name();
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



