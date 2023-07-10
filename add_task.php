<!-- Add Task -->
<div class="overlayAdd" id="divAdd">
  <div class="wrapper_add_task">
    <p class="title_add_task"><b>Add New Task</b></p>
    <div class="close">&times;</div>
    <div class="content_add_task">
      <div class="container_add_task">
        <h3>Title</h3>
        <div class="inputForm">
          <input class="textField" type="text" name="task_name" id="task_name" placeholder="Add Task Title..."
            required />
        </div>
        <h3>Description</h3>
        <div class="inputForm">
          <input class="textField" type="text" name="task_desc" id="task_desc" placeholder="Add Task Description..." />
        </div>
        <div class="inputForm">
          <h3>Category</h3>
          <div class="customSelect">
            <select name="category_id" id="category_id">
              <option value="" selected disabled>Select Category</option>
              <option value="1">Study</option>
              <option value="2">Sport</option>
              <option value="3">Meeting</option>
              <option value="4">Medic</option>
            </select>
            <span class="arrow"></span>
          </div>
        </div>
        <div class="inputForm">
          <h3>Priority</h3>
          <div class="customSelect">
            <select name="priority_id" id="priority_id">
              <option value="" selected disabled>Select Priority</option>
              <option value="1">Low</option>
              <option value="2">Medium</option>
              <option value="3">High</option>
            </select>
            <span class="arrow"></span>
          </div>
        </div>
        <div class="inputForm_date">
          <div class="inputForm">
            <h3>Due Date</h3>
            <div class="inputForm">
              <input class="textField" type="date" name="task_date" id="task_date" value="<?php echo date('Y-m-d'); ?>">
              <input class="textField" type="time" name="task_time" id="task_time">
            </div>
          </div>
        </div>
        <div class="button_add_tasks">
          <center>
            <td colspan="2"><input class="button_add_task" type="button" value="Add Task" name="submit"
                onclick="save_task()"></td>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Update Task -->
<div class="overlayUpdate" id="divUpdate">
  <div class="wrapper_update_task">
    <p class="title_update_task"><b>Edit Task</b></p>
    <input type="hidden" name="task_id" id="task_id">
    <div class="close">&times;</div>
    <div class="content_update_task">
      <div class="container_update_task">
        <!-- <input type="hidden" name="task_id"> -->
        <h3>Title</h3>
        <div class="inputForm">
          <input class="textField" type="text" name="edit_task_name" id="edit_task_name" placeholder="Add Task Title..."
            required />
        </div>
        <h3>Description</h3>
        <div class="inputForm">
          <input class="textField" type="text" name="edit_task_desc" id="edit_task_desc"
            placeholder="Add Task Description..." />
        </div>
        <div class="inputForm">
          <h3>Category</h3>
          <div class="customSelect">
            <select name="edit_category_id" id="edit_category_id">
              <option value="" selected disabled>Select Category</option>
              <option value="1">Study</option>
              <option value="2">Sport</option>
              <option value="3">Meeting</option>
              <option value="4">Medic</option>
            </select>
            <span class="arrow"></span>
          </div>
        </div>
        <div class="inputForm">
          <h3>Priority</h3>
          <div class="customSelect">
            <select name="edit_priority_id" id="edit_priority_id">
              <option value="" selected disabled>Select Priority</option>
              <option value="1">Low</option>
              <option value="2">Medium</option>
              <option value="3">High</option>
            </select>
            <span class="arrow"></span>
          </div>
        </div>
        <div class="inputForm_date">
          <div class="inputForm">
            <h3>Due Date</h3>
            <div class="inputForm">
              <input class="textField" type="date" name="task_date" id="edit_task_date">
              <input class="textField" type="time" name="task_time" id="edit_task_time">
            </div>
          </div>
        </div>
        <div class="button_update_tasks">
          <center>
            <td colspan="2"><input class="button_add_task" id="button_edit_task" type="button" value="Update Task"
                name="submit" onclick="update_task()"></td>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>