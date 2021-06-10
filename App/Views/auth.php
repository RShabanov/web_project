<link rel="stylesheet" type="text/css" href="/Static/css/auth.css">

<div class="auth-block__div">
    <form action="/login" method='POST' class="auth-form__form" name="auth-form">
        <h3 class="auth-form-title">Sign in to the client</h3>
        <?php if (!empty($auth) && $auth->has_errors()):
            foreach ($auth->get_errors() as $error): ?>
                <div class="auth-form-group">
                    <span class="auth-error-msg"><?= $error; ?></span>
                </div>
        <?php endforeach;
            endif; ?>
        <div class="auth-form-group">
            <label class="auth-form__field-label">
                <span class="auth-field-label__title">*Name:</span><br>
                <input value="<?= empty($auth->name) ? '' : $auth->name ;?>" type="text" name="name" class="auth-form__field-input" required autocomplete="off">
            </label>
        </div>

        <div class="auth-form-group">
            <label class="auth-form__field-label">
                <span class="auth-field-label__title">*Password:</span><br>
                <input value="<?= empty($auth->password) ? '' : $auth->password ;?>" type="password" name="password" class="auth-form__field-input" required autocomplete="off">
            </label>
        </div>

        <div class="auth-form-group">
            <span class="auth-extra-info">* is a required field</span>
        </div>

        <div class="auth-form-group">
            <button class="btn-submit">Log in</button>
        </div>

        <div class="auth-form-group another-enter">
            <span>Don't have an account?</span>
            <a href="/create-account" class="another-enter__a">Create account</a>
        </div>
    </form>
</div>