<link rel="stylesheet" type="text/css" href="/Static/css/auth.css">

<div class="auth-block__div">
    <form action="/create_account" method='POST' class="auth-form__form" name="auth-form">
        <h3 class="auth-form-title">Create an account</h3>
        <?php if (!empty($register) && $register->has_errors()):
            foreach ($register->get_errors() as $error): ?>
                <div class="auth-form-group">
                    <span class="auth-error-msg"><?= $error; ?></span>
                </div>
        <?php endforeach;
            endif; ?>
        <div class="auth-form-group">
            <label class="auth-form__field-label">
                <span class="auth-field-label__title">*Name:</span><br>
                <input value="<?= empty($register->name) ? '' : $register->name ;?>" type="text" name="name" class="auth-form__field-input" required autocomplete="off">
            </label>
        </div>

        <div class="auth-form-group">
            <label class="auth-form__field-label">
                <span class="auth-field-label__title">*Password:</span><br>
                <input value="<?= empty($register->password) ? '' : $register->password ;?>" type="password" name="password" class="auth-form__field-input" required autocomplete="off">
            </label>
        </div>

        <div class="auth-form-group">
            <label class="auth-form__field-label">
                <span class="auth-field-label__title">*Password confirm:</span><br>
                <input value="<?= empty($register->password) ? '' : $register->password_confirm ;?>" type="password" name="password_confirm" class="auth-form__field-input" required autocomplete="off">
            </label>
        </div>

        <div class="auth-form-group">
            <span class="auth-extra-info">* is a required field</span>
        </div>

        <div class="auth-form-group">
            <button class="btn-submit">Create account</button>
        </div>

        <div class="auth-form-group another-enter">
            <span>Already have an account?</span>
            <a href="/login" class="another-enter__a">Log in</a>
        </div>
    </form>
</div>