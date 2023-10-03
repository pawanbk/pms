<?php
use core\Session;
$error = $error ?? '';
$errors = $errors ?? [];
$old = $old ?? [];
?>
<div class="container">
    <div class="col-md-5 mx-auto">
        <div class="myform form ">
                <div class="logo mb-3">
                    <div class="col-md-12 text-center">
                        <h1>Login</h1>
                    </div>
                </div>
                <?php if($error != ""):?>
                    <div class="alert alert-danger">
                        <?= $error?>
                    </div>
                <?php endif;?>
                <?php if(Session::exists('success')):?>
                    <div class="alert alert-success">
                        <?= Session::flash('success')?>
                    </div>
                <?php elseif(Session::exists('error')): ?>
                     <div class="alert alert-danger">
                        <?= Session::flash('error')?>
                    </div>
                <?php endif;?>
            <form action="/login" method="post" >
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" name="email"  class="form-control <?= hasError('email',$errors) ? 'is-invalid':''; ?>" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?=old('email',$old)?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" id="password"  class="form-control <?= hasError('password',$errors) ? 'is-invalid':'';?>" aria-describedby="emailHelp" placeholder="Enter Password">
                    <div class="invalid-feedback">
                        <?= error('password',$errors);?>
                    </div>
                </div>
                <a href="/forget-password">Forget Password?</a>
                <div class="form-group">
                    <p class="text-center">By signing up you accept our <a href="#">Terms Of Use</a></p>
                </div>
                <div class="col-md-12 text-center ">
                    <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                </div>
                <div class="form-group">
                    <p class="text-center">Don't have account? <a href="/register" id="signup">Sign up here</a></p>
                </div>
            </form>
            
        </div>
    </div>
</div>
<?php displayMsg()?>

