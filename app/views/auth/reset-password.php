<?php 
$this->setLayout('auth');
$email = $email ?? $old['email'];
$token = $token ?? $old['token'];
?>
<div class="container padding-bottom-3x mb-2 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="forgot">
                <h2>Reset your password</h2>
                <form class="card mt-4" action="/reset-password" method="post">
                    <div class="card-body">
                        <input type="hidden" name="email" value="<?=$email?>">
                        <input type="hidden" name="token" value="<?=$token?>">
                        <div class="form-group">
                            <label>New Password</label>
                            <input class="form-control <?= hasError('password',$errors) ? 'is-invalid': '' ?>" name="password" type="password">
                            <div class="invalid-feedback">
                                <?=error('password',$errors)?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input class="form-control <?= hasError('confirmPassword',$errors) ? 'is-invalid': '' ?>" name="confirmPassword" type="password">
                            <div class="invalid-feedback">
                                <?=error('confirmPassword',$errors)?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-danger" href="/login">Back to Login</a>
                        <button class="btn btn-info" type="submit">Reset</button>
                    </div>
                </form>
        </div>
    </div>
</div>