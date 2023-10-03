<?php 
$this->setLayout('auth');
$errors = $errors ?? [];
$old = $old ?? [];
?>
<div class="container padding-bottom-3x mb-2 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="forgot">
                <h2>Forgot your password?</h2>
                <p>Change your password in three easy steps. This will help you to secure your password!</p>
                <ol class="list-unstyled">
                    <li><span class="text-primary text-medium">1. </span>Enter your email address below.</li>
                    <li><span class="text-primary text-medium">2. </span>Our system will send you a temporary link</li>
                    <li><span class="text-primary text-medium">3. </span>Use the link to reset your password</li>
                </ol>
            </div>
            <?php 
            use core\Session;
            if(Session::exists('success')):?>
                <div class="alert alert-success">
                    <?=Session::flash('success')?>
                </div>
            <?php endif;?>
            <form class="card mt-4" action="/forget-password" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="email-for-pass">Enter your email address</label>
                        <input class="form-control <?= hasError('email',$errors) ? 'is-invalid': '' ?>" name="email" type="text" value="<?= old('email',$old)?>">
                        <div class="invalid-feedback">
                            <?=error('email',$errors)?>
                        </div>
                        <small class="form-text text-muted">Enter the email address you used during the registration on pms.com. Then we'll email a link to this address.</small>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-danger" href="/login">Back to Login</a>
                    <button class="btn btn-info" type="submit">Send Reset Link</button>
                </div>
            </form>
        </div>
    </div>
</div>
