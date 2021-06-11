<?php
    $css_paths = [
        '/Static/css/task_list.css',
        '/Static/css/task_form.css',
    ];
    
    include ROOT . '/App/Views/partials/header.php'; 

    include ROOT . '/App/Views/partials/task_form.php';

?>

<div class="ls-task-list">
    <div class="ls-task-options">
        <button class="ls-option-btn add-btn">Add</button>
        <button class="ls-option-btn delete-btn" 
                type="submit"
                form="ls-task-list"
                formaction="/tasks/delete"
                name="task-delete-btn" disabled>Delete</button>
    </div>
    <div class="tasks-block">
        <div class="task-filter-bar">
            <span class="fr-task--precise">
                <span class="fr-task--statuses">
                    <select class="fr-statuses__select">
                        <?php foreach(App\Models\Task::get_statuses() as $index => $status): ?>
                            <option value="<?= $index; ?>" class="fr-select__option">
                                <?= $status; ?>
                            </option>
                        <?php endforeach; ?>
                        <option class="fr-select__option">All</option>
                    </select>
                </span>
                <span class="fr-task--precise-date">
                    <input type="datetime-local" name="time" class="fr-time__input" autocomplete="off">
                </span>
            </span>
            <span class="fr-task--date">
                <ul class="fr-task--date__ul">
                    <li class="fr--time-unit__li" data-key="today"><span>today</span></li>
                    <li class="fr--time-unit__li" data-key="tomorrow"><span>tomorrow</span></li>
                    <li class="fr--time-unit__li" data-key="current_week"><span>current week</span></li>
                    <li class="fr--time-unit__li" data-key="next_week"><span>next week</span></li>
                </ul>
                <button class="fr--reset-btn" name="reset-filters-btn">Reset</button>
            </span>
        </div>
        <form action="" name="ls-task-list" method='POST' class="ls-task-list-form" id="ls-task-list">
            <div class="ls-form-group ls-form-group--header">
                <ul class="ls-form-group--item">
                    <li class="ls-group--item-field ls-select-field">
                        Select
                    </li>
                    <li class="ls-group--item-field ls-type-field">
                        Type
                    </li>
                    <li class="ls-group--item-field ls-task_name-field">
                        Task
                    </li>
                    <li class="ls-group--item-field ls-location-field">
                        Location
                    </li>
                    <li class="ls-group--item-field ls-time-field">
                        Date and time
                    </li>
                </ul>
            </div>
            <?php foreach ($tasks as $task): ?>
                <div class="ls-form-group">
                    <ul class="ls-form-group--item"
                        data-type_id="<?= $task->type_id; ?>"
                        data-duration="<?= $task->duration; ?>"
                        data-comment="<?= $task->comment; ?>"
                        data-status_id="<?= $task->status_id; ?>"
                        data-deleted="<?= $task->deleted; ?>"
                        >
                        <li class="ls-group--item-field ls-select-field">
                            <input type="checkbox" class="select-checkbox" value="<?= $task->id; ?>" name="<?= $task->id; ?>" />
                        </li>
                        <li class="ls-group--item-field ls-type-field">
                            <?= $task->get_types()[$task->type_id]; ?>
                        </li>
                        <li class="ls-group--item-field ls-task_name-field">
                            <span class="ls-task_name">
                                <?= $task->name; ?>
                            </span>
                        </li>
                        <li class="ls-group--item-field ls-location-field">
                            <?= $task->location; ?>
                        </li>
                        <li class="ls-group--item-field ls-time-field">
                            <?= $task->time; ?>
                        </li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </form>
    </div>
</div>


<?php

    $script_paths = [
        '/Static/js/task_form.js',
        '/Static/js/task_list.js',
    ];

    include ROOT . '/App/Views/partials/footer.php'; 
?>