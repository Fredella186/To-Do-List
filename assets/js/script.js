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

function save_task() {
    // Ubah judul modal menjadi "Add Task"
    $('#title_task').text('Add Task');
    
    var form = $('#task_add_content');
    var id = $("#id").val();
    
    // Mengumpulkan data formulir menggunakan serialize()
    var formData = form.serialize();
    
    // Menambahkan data "act" secara manual ke dalam data formulir
    formData += "&act=add";
    
    var act = 'add';
    if ($('#edit_task').is(':focus')) {
      act = 'edit';
    }
    
    $.ajax({
      url: 'sv_task.php',
      type: 'POST',
      data: {
        formData,
        id: id,
        act: act,
      },
      // Menggunakan formData yang telah diserialize
      success: function() {
        get_data();
        completed_task();
        completed_score();
        total_score();
    
        // Mengatur ulang form
        $("#task_add_content")[0].reset();
      }
    });
  }
  
  // Bind the handleSaveTaskClick function to the click event
  $('#save_task').on('click', save_task);
  
  
  function edit_task() {
    $('#title_task').text('Edit Task');
    
    var id = $("#id").val();
    
    $.ajax({
      url: 'sv_task.php',
      type: 'POST',
      data: {
        id: id,
        act: 'edit'
      },
      success: function(result) {
        var data = result.split("|");
    
        $("#id").val(data[1]);
        $("#task_name").val(data[2]);
        $("#task_desc").val(data[3]);
        $("#category_id").val(data[4]);
        $("#priority_id").val(data[5]);
        $("#task_date").val(data[6]);
        $("#task_time").val(data[7]);
        $("#reminder_id").val(data[8]);
        $("#status_id").val(data[9]);
    
        // Add code to display the modal
        var addTaskForm = document.getElementById("add_task_form_container");
        addTaskForm.style.display = "block";
        addTaskForm.style.visibility = "visible";
        addTaskForm.style.opacity = "1";
    
        // Rebind event handler for the submit button
        $("#submit-button").unbind("click");
        $("#submit-button").on("click", function() {
          update_task();
        });
      }
    });
  }
  
  function update_task() {
    var id = $("#id").val();
    var task_name = $("#task_name").val();
    var task_desc = $("#task_desc").val();
    var category_id = $("#category_id").val();
    var priority_id = $("#priority_id").val();
    var task_date = $("#task_date").val();
    var task_time = $("#task_time").val();
    var reminder_id = $("#reminder_id").val();
    var status_id = $("#status_id").val();
    
    $.ajax({
      url: "sv_task.php",
      method: "POST",
      data: {
        act: "update",
        id: id,
        task_name: task_name,
        task_desc: task_desc,
        category_id: category_id,
        priority_id: priority_id,
        task_date: task_date,
        task_time: task_time,
        reminder_id: reminder_id,
        status_id: status_id
      },
      success: function() {
        get_data();
        completed_task();
        completed_score();
        total_score();
      }
    });
  }
  
  // Bind the handleEditTaskClick function to the click event
  $('#edit_task').on('click', edit_task);
  
  

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


