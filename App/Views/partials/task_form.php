<div>
    <dialog class="fm-task-dialog" <?= !empty($task) ? 'open' : 'close'; ?> >
        <header class="fm-dialog__header">
            <button class="fm-close-btn"></button>
        </header>
        <form action="/tasks/save" name="fm-task-form" method='POST' class="fm-task-form">
            <?php if (!empty($task) && $task->has_errors()):
                foreach ($task->get_errors() as $error): ?>
                    <div class="fm-form-group">
                        <span class="fm-error-msg"><?= $error; ?></span>
                    </div>
            <?php endforeach;
                endif; ?>
            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Task:</span>
                    <input value="<?= (empty($task) && empty($task->name)) ? '' : $task->name; ?>" type="text" name="name" class="fm-form__field-input fm-text__input" required autocomplete="off">
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Type:</span>
                    <select name="type_id" class="fm-form__field-select" require>
                        <?php foreach(App\Models\Task::get_types() as $index => $type): ?>
                            <option value="<?= $index; ?>" class="fm-field-select__option" <?= (!empty($task) && !empty($task->type_id) && $task->type_id === $index) ? 'checked' : ''; ?> >
                                <?= $type; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Location:</span>
                    <input value="<?= (empty($task) && empty($task->location)) ? '' : $task->location; ?>" type="text" name="location" class="fm-form__field-input fm-text__input" autocomplete="off">
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Date and time:</span>
                    <input value="<?= (empty($task) && empty($task->time)) ? '' : $task->time; ?>" type="datetime-local" name="time" class="fm-form__field-input" min="1970-01-01T00:00" max="2038-01-19T03:14" required autocomplete="off">
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Duration:</span>
                    <input value="<?= (empty($task) && empty($task->duration)) ? '01:00' : $task->duration; ?>" type="time" name="duration" class="fm-form__field-input" max="23:59" required autocomplete="off">
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title comment__title-block">Comment:</span>
                    <textarea name="comment" class="fm-form__field-comment fm-text__input" placeholder="Leave a comment"><?= (empty($task) && empty($task->comment)) ? '' : $task->comment; ?></textarea>
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Status:</span>
                    <select name="status_id" class="fm-form__field-select" require>
                        <?php foreach(App\Models\Task::get_statuses() as $index => $status): ?>
                            <option value="<?= $index; ?>" class="fm-field-select__option" <?= (!empty($task) && !empty($task->status_id) && $task->status_id === $index) ? 'checked' : ''; ?> >
                                <?= $status; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <div class="fm-form-group">
                <button class="fm-btn-submit">Save</button>
            </div>
        </form>
    </dialog>
</div>