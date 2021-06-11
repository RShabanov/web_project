"use strict";

(function() {

    class TimeRange {
        // lowerBound <= value < upperBound
        constructor(rangeKey, date) {
            this.set(rangeKey, date);
        }

        set(rangeKey, date) {
            if (date ?? true) {
                this.lowerBound = new Date();
                this.upperBound = new Date();
            } else {
                this.lowerBound = new Date(date);
                this.upperBound = new Date(date);
            }

            this.resetTime();

            switch (rangeKey ?? 'today') {
                case 'today':
                    this.setBounds('day');
                    break;
                case 'tomorrow':
                    this.setBounds('day');
                    this.shift(1);
                    break;
                case 'current_week':
                    this.setBounds('week');
                    break;
                case 'next_week':
                    this.setBounds('week');
                    this.shift(7);
                    break;
            }
        }

        resetTime() {
            this.lowerBound.setHours(0, 0, 0, 0);    
            this.upperBound.setHours(0, 0, 0, 0);    
        }

        setBounds(dateKey) {
            switch (dateKey) {
                case 'day':
                    this.upperBound.setDate(this.upperBound.getDate() + 1);
                    break;
                case 'week':
                    this.lowerBound.setDate(this.lowerBound.getDate() - this.lowerBound.getDay() + 1);
                    this.upperBound.setDate(this.upperBound.getDate() + 8 - this.upperBound.getDay());
                    break;
            }
        }

        shift(days) {
            this.lowerBound.setDate(this.lowerBound.getDate() + days);
            this.upperBound.setDate(this.upperBound.getDate() + days);
        }

        contains(date) {
            const tempDate = new Date(date);
            return this.lowerBound <= tempDate && tempDate < this.upperBound;
        }
    };

    const taskListForm = document.forms['ls-task-list'];
    const taskList = Array.from(taskListForm.children);
    const taskListFormHeader = taskList.shift();

    const taskTypes = document.querySelector('.fr-statuses__select');
    const taskTime = document.querySelector('.fr-time__input');

    const simpleTimeOptions = document.querySelector('.fr-task--date__ul');
    const timeOptions = Array.from(simpleTimeOptions.children);
    const timeRange = new TimeRange();

    const resetBtn = document.querySelector('.fr--reset-btn');

    let taskNumberToDelete = 0;



    window.onload = event => {
        filterTasks(taskTypes.value);
    };

    taskListForm.onclick = event => {
        if (event.target.classList.contains('select-checkbox')) {
            taskNumberToDelete += (event.target.checked) ? 1 : -1;

            const deleteBtn = taskListForm.elements['task-delete-btn'];

            if (taskNumberToDelete > 0) {
                deleteBtn.style.backgroundColor = '#ffbfbf';
                deleteBtn.disabled = false;
                deleteBtn.style.opacity = 1;
                deleteBtn.style.cursor = 'pointer';
            } else {
                deleteBtn.style.backgroundColor = '#ffe3e3';
                deleteBtn.disabled = true;
                deleteBtn.style.opacity = 0.75;
                deleteBtn.style.cursor = 'auto';
            }
        }
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

})();