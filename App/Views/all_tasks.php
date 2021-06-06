<?php
    $css_paths = [
        ROOT . '/Static/css/task_list.css',
    ];
    
    include ROOT . '/App/Views/partials/header.php'; 

    #include ROOT . '/App/Views/partials/task_form.php';
?>

<div class="task-list">
    <form action="" class="task-list-form">
        <div class="form-group form-group--header">
            <ul class="form-group--item">
                <li class="group--item-field select-field">
                    Select
                </li>
                <li class="group--item-field type-field">
                    Type
                </li>
                <li class="group--item-field task_name-field">
                    Task
                </li>
                <li class="group--item-field location-field">
                    Location
                </li>
                <li class="group--item-field time-field">
                    Date and time
                </li>
            </ul>
        </div>
        <?php foreach ($tasks as $task): ?>
            <div class="form-group">
                <ul class="form-group--item">
                    <li class="group--item-field select-field">
                        <input type="checkbox" class="select-checkbox">
                    </li>
                    <li class="group--item-field type-field">
                        <?= $task->get_types()[$task->type_id]; ?>
                    </li>
                    <li class="group--item-field task_name-field">
                        <?= $task->name; ?>
                    </li>
                    <li class="group--item-field location-field">
                        <?= $task->location; ?>
                    </li>
                    <li class="group--item-field time-field">
                        <?= $task->time; ?>
                    </li>
                </ul>
            </div>
        <?php endforeach; ?>
    </form>
</div>


<?php include ROOT . '/App/Views/partials/footer.php'; ?>