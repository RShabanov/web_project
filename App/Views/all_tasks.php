<?php
    $css_paths = [
        ROOT . '/Static/css/task_list.css',
    ];
    
    include ROOT . '/App/Views/partials/header.php'; 

    // include ROOT . '/App/Views/partials/task_form.php';
?>

<div class="task-list">
    <form action="" class="ls-task-list-form">
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
                <ul class="ls-form-group--item">
                    <li class="ls-group--item-field ls-select-field">
                        <input type="checkbox" class="select-checkbox">
                    </li>
                    <li class="ls-group--item-field ls-type-field">
                        <?= $task->get_types()[$task->type_id]; ?>
                    </li>
                    <li class="ls-group--item-field ls-task_name-field">
                        <?= $task->name; ?>
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


<?php include ROOT . '/App/Views/partials/footer.php'; ?>