<div>
    <dialog class="task-dialog" open>
        <form action="/tasks/save" method='POST' class="task-form">
            <div class="form-group">
                <label class="form__field-label">
                    <span class="field-label__title">Task:</span>
                    <input value="<?= (empty($task->name) ? '' : $task->name); ?>" type="text" name="name" class="form__field-input" required autocomplete="off">
                </label>
            </div>

            <div class="form-group">
                <label class="form__field-label">
                    <span class="field-label__title">Type:</span>
                    <select name="type_id" class="form__field-select" require>
                        <?php foreach($task->get_types() as $index => $type): ?>
                            <option value="<?= $index; ?>" class="field-select__option" <?= (empty($task->type_id) ? '' : 'checked'); ?> >
                                <?= $type; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <div class="form-group">
                <label class="form__field-label">
                    <span class="field-label__title">Location:</span>
                    <input value="<?= (empty($task->location) ? '' : $task->location); ?>" type="text" name="location" class="form__field-input" autocomplete="off">
                </label>
            </div>

            <div class="form-group">
                <label class="form__field-label">
                    <span class="field-label__title">Date and time:</span>
                    <input value="<?= (empty($task->time) ? '' : $task->time); ?>" type="datetime-local" name="time" class="form__field-input" required autocomplete="off">
                </label>
            </div>

            <div class="form-group">
                <label class="form__field-label">
                    <span class="field-label__title">Duration:</span>
                    <input value="<?= (empty($task->duration) ? '' : $task->duration); ?>" type="time" name="duration" class="form__field-input" required autocomplete="off">
                </label>
            </div>

            <div class="form-group">
                <label class="form__field-label">
                    <span class="field-label__title">Comment:</span>
                    <textarea name="comment" class="form__field-comment" cols="30" rows="10" placeholder="Leave a comment"><?php
                            if (!empty($task->comment)) {
                                echo $task->comment;
                            }
                        ?></textarea>
                </label>
            </div>

            <div class="form-group">
                <button class="btn-submit">Add</button>
            </div>
        </form>
    </dialog>
</div>