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