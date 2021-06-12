"use strict";


import {TimeRange} from './modules/task_list_module.js';
import {Task} from './modules/task_form_module.js';

(function() {

    const taskListForm = document.forms['ls-task-list'];
    const taskList = Array.from(taskListForm.children);
    const taskListFormHeader = taskList.shift();

    const taskDialog = document.querySelector('.fm-task-dialog');
    const taskDialogForm = document.forms['fm-task-form'];

    const taskDialogCloseBtn = taskDialog.querySelector('.fm-close-btn');

    const addTaskButton = document.querySelector('.ls-task-options > .add-btn');
    addTaskButton.onclick = event => showForm();

    const taskTypes = document.querySelector('.fr-statuses__select');
    const taskTime = document.querySelector('.fr-time__input');

    const simpleTimeOptions = document.querySelector('.fr-task--date__ul');
    const timeOptions = Array.from(simpleTimeOptions.children);

    const resetBtn = document.querySelector('.fr--reset-btn');

    const timeRange = new TimeRange();

    let taskNumberToDelete = 0;
    let allTasksSelected = false;



    window.onload = event => {
        filterTasks(taskTypes.value);
    };

    // close dialog
    window.onkeydown = event => {
        if (event.code === 'Escape') closeTaskForm();
    };
    taskDialogCloseBtn.onclick = event => {
        closeTaskForm();
    };
    // close dialog -----

    taskListForm.onclick = event => {
        if (event.target.classList.contains('select-checkbox')) {
            taskNumberToDelete += (event.target.checked) ? 1 : -1;

            styleBtn(taskListForm.elements['task-delete-btn']);
            allTasksSelected = taskNumberToDelete === (taskListForm.childElementCount - 1);        ;
        } else if (event.target.classList.contains('ls-task_name')) {
            const task = getTask(event.target.parentElement.parentElement);
            showForm(task, true);
        }
    };

    taskListFormHeader.querySelector('.ls-select-field').onclick = event => {
        let listToDelete = Array.from(taskListForm.children);
        listToDelete.shift();

        allTasksSelected = !allTasksSelected;
        if (allTasksSelected) {
            taskNumberToDelete = taskListForm.childElementCount - 1;
        } else {
            taskNumberToDelete = 0;
        }

        listToDelete.forEach(item => {
            item.querySelector('.select-checkbox').checked = allTasksSelected;
        });

        styleBtn(taskListForm.elements['task-delete-btn']);
    };

    taskTypes.onchange = event => {
        if (!taskTime.value) {
            filterTasks(taskTypes.value);
        } else {
            filterTasks(taskTypes.value, filterByPreciseDate);
        }

        timeOptions.forEach(option => {
            option.firstElementChild.classList.remove('selected-option');
        });
    }

    taskTime.onchange = event => {
        if (!taskTime.value) {
            filterTasks(taskTypes.value);
        } else {
            filterTasks(taskTypes.value, filterByPreciseDate);
        }

        timeOptions.forEach(option => {
            option.firstElementChild.classList.remove('selected-option');
        });
    };

    simpleTimeOptions.onclick = event => {
        if (event.target.localName === 'span') {
            timeOptions.forEach(option => {
                if (option === event.target.parentElement) {
                    timeRange.set(option.dataset.key);
                    filterTasks(taskTypes.value, time => {
                        return timeRange.contains(time);
                    });

                    event.target.classList.add('selected-option');
                } else {
                    option.firstElementChild.classList.remove('selected-option');
                }
            });

            taskTime.value = '';
        }
    };

    resetBtn.onclick = event => {
        filterTasks('all')
        taskTypes.value = 'All';
        taskTime.value = '';

        timeOptions.forEach(option => {
            option.firstElementChild.classList.remove('selected-option');
        });
    };


    // filterTime is a function which return boolean 
    // in case when date is what we are looking for
    function filterTasks(taskStatus, filterTime = time => { return true; }) {
        taskStatus = taskStatus.toLowerCase();

        clearTaskList();

        if (taskStatus !== 'all') {
            taskList.forEach(task => {
                if (task.firstElementChild.dataset.status_id === taskStatus &&
                    task.firstElementChild.dataset.deleted === '0' &&
                    filterTime(task.querySelector('.ls-time-field').innerText.trim())) {
                        taskListForm.appendChild(task);
                    }
            });
        } else if (taskStatus === 'all') {
            taskList.forEach(task => {
                if (filterTime(task.querySelector('.ls-time-field').innerText.trim())) {
                    taskListForm.appendChild(task);
                }
            });
        }
    }

    function filterByPreciseDate(date) {
        const timeFilter = new Date(taskTime.value);
        return timeFilter.toGMTString() === new Date(date).toGMTString();
    }

    function clearTaskList() {
        taskList.forEach(task => {
            if (taskListForm.contains(task)) {
                taskListForm.removeChild(task);
            }
        });
    }


    function styleBtn(btn) {
        if (taskNumberToDelete > 0) {
            btn.style.backgroundColor = '#ffbfbf';
            btn.disabled = false;
            btn.style.opacity = 1;
            btn.style.cursor = 'pointer';
        } else {
            btn.style.backgroundColor = '#ffe3e3';
            btn.disabled = true;
            btn.style.opacity = 0.75;
            btn.style.cursor = 'auto';
        }
    }



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

                const hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.name = 'id';
                hiddenField.value = task.id;

                taskDialogForm.insertBefore(hiddenField, taskDialogForm.firstElementChild);

            } else {
                // remove input for status
                status_div.style.display = 'none';
            }

            deleteErrorMsgs();

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

    function closeTaskForm() {
        if (window.location.href.match(/tasks\/save$/)) {
            window.location = window.location.hostname + '/tasks/list';
        }

        if (taskDialogForm.elements['id'])
            taskDialogForm.removeChild(taskDialogForm.elements['id']);
        taskDialog.close();
    }

    function deleteErrorMsgs() {
        let errorsMsgs = taskDialogForm.querySelectorAll('.fm-form-group > .fm-error-msg');

        errorsMsgs.forEach(errorItem => {
            taskDialogForm.removeChild(errorItem.parentElement);
        });
    }
})();