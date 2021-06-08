"use strict";

(function(){

    class Task {
        constructor() {
            this.id = '';
            this.name = '';
            this.type_id = '';
            this.location = '';
            this.time = '';
            this.duration = '';
            this.comment = '';
            this.status_id = '';
            this.deleted = '';
        }
    }

    const taskList = document.forms['ls-task-list'];

    const taskDialog = document.querySelector('.fm-task-dialog');
    const taskDialogForm = document.forms['fm-task-form'];

    const taskDialogCloseBtn = taskDialog.querySelector('.fm-close-btn');

    const addTaskButton = document.querySelector('.ls-task-options > .add-btn');
    addTaskButton.onclick = event => showForm();


    taskList.onclick = event => {
        // to check whether it is task name or not
        if (event.target.classList.contains('ls-task_name')) {
            const task = getTask(event.target.parentElement.parentElement);
            showForm(task, true);
        }
    };

    // close dialog
    taskDialog.onkeydown = event => {
        if (event.code === 'Escape') taskDialog.close();
    };
    taskDialogCloseBtn.onclick = event => {
        taskDialog.close();
    };
    // close dialog -----


    function showForm(task = new Task, updateMode = false) {
        taskDialog.close();

        if (task instanceof Task) {
            taskDialogForm.elements['name'].value = task.name;
            taskDialogForm.elements['type_id'].value = task.type_id;
            taskDialogForm.elements['location'].value = task.location;
            taskDialogForm.elements['time'].value = task.time;
            taskDialogForm.elements['duration'].value = task.duration;
            taskDialogForm.elements['comment'].value = task.comment;
            taskDialogForm.elements['status_id'].value = task.status_id;

            let status_div = taskDialogForm.elements['status_id'].parentElement.parentElement;

            if (updateMode) {
                // add input for status
                status_div.style.display = 'block';
            } else {
                // remove input for status
                status_div.style.display = 'none';
            }

            taskDialog.show();
        } else {
            console.log('Error in showForm: task is not an instance of Task');
        }
    }

    function getTask(taskHtml) {
        const task = new Task();

        task.type_id = taskHtml.dataset.type_id;
        task.duration = taskHtml.dataset.duration;
        task.comment = taskHtml.dataset.comment;
        task.status_id = taskHtml.dataset.status_id;
        task.deleted = taskHtml.dataset.deleted;

        task.id = taskHtml.querySelector('.select-checkbox').value;
        task.name = taskHtml.querySelector('.ls-task_name').innerText;
        task.location = taskHtml.querySelector('.ls-location-field').innerText;
        task.time = taskHtml.querySelector('.ls-time-field').innerText.split(' ');
        task.time = task.time[0] + 'T' + task.time[1].slice(0, -3);

        return task;
    }
})();