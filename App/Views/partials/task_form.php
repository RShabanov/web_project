<div>
    <dialog class="fm-task-dialog">
        <form action="/tasks/save" name="fm-task-form" method='POST' class="fm-task-form">
            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Task:</span>
                    <input value="<?= (empty($task->name) ? '' : $task->name); ?>" type="text" name="name" class="fm-form__field-input fm-text__input" required autocomplete="off">
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Type:</span>
                    <select name="type_id" class="fm-form__field-select" require>
                        <?php foreach(App\Models\Task::get_types() as $index => $type): ?>
                            <option value="<?= $index; ?>" class="fm-field-select__option" <?= (empty($task->type_id) ? '' : 'checked'); ?> >
                                <?= $type; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Location:</span>
                    <input value="<?= (empty($task->location) ? '' : $task->location); ?>" type="text" name="location" class="fm-form__field-input fm-text__input" autocomplete="off">
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Date and time:</span>
                    <input value="<?= (empty($task->time) ? '' : $task->time); ?>" type="datetime-local" name="time" class="fm-form__field-input" required autocomplete="off">
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title">Duration:</span>
                    <input value="<?= (empty($task->duration) ? '' : $task->duration); ?>" type="time" name="duration" class="fm-form__field-input" required autocomplete="off">
                </label>
            </div>

            <div class="fm-form-group">
                <label class="fm-form__field-label">
                    <span class="fm-field-label__title comment__title-block">Comment:</span>
                    <textarea name="comment" class="fm-form__field-comment fm-text__input" placeholder="Leave a comment"><?php
                            if (!empty($task->comment)) {
                                echo $task->comment;
                            }
                        ?></textarea>
                </label>
            </div>

            <div class="fm-form-group">
                <button class="fm-btn-submit">Save</button>
            </div>
        </form>
    </dialog>
</div>