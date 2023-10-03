<?php
$this->setLayout('auth');
$error = $error ?? '';
$errors = $errors ?? [];
$old = $old ?? [];
?>
<div class="container">
    <div class="col-md-5 mx-auto">
        <div class="myform form ">
                <div class="logo mb-3">
                    <div class="col-md-12 text-center">
                        <h1>Sign Up</h1>
                    </div>
                </div>
                <?php if($error != ""):?>
                <div class="alert alert-danger">
                    <?= $error?>
                </div>
                <?php endif;?>
            <form action="/register" method="post" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" name="firstName"  class="form-control <?= hasError('firstName',$errors) ? 'is-invalid':''; ?>" id="firstName" aria-describedby="firstNameHelp" placeholder="Enter firstName" value="<?=old('firstName',$old)?>">
                            <div class="invalid-feedback">
                                <?= error('firstName',$errors);?>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" name="lastName"  class="form-control <?= hasError('lastName',$errors) ? 'is-invalid':''; ?>" id="lastName" aria-describedby="lastNameHelp" placeholder="Enter lastName" value="<?=old('lastName',$old)?>">
                            <div class="invalid-feedback">
                                <?= error('lastName',$errors);?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" name="email"  class="form-control <?= hasError('email',$errors) ? 'is-invalid':''; ?>" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?=old('email',$old)?>">
                    <div class="invalid-feedback">
                        <?= error('email',$errors);?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" id="password"  class="form-control <?= hasError('password',$errors) ? 'is-invalid':'';?>" aria-describedby="emailHelp" placeholder="Enter Password">
                    <div class="invalid-feedback">
                        <?= error('password',$errors);?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="password" name="confirmPassword" id="password"  class="form-control <?= hasError('confirmPassword',$errors) ? 'is-invalid':'';?>" aria-describedby="emailHelp" placeholder="Enter Password">
                    <div class="invalid-feedback">
                        <?= error('confirmPassword',$errors);?>
                    </div>
                </div>
        
                <div class="form-group">
                    <p class="text-center">By signing up you accept our <a href="#">Terms Of Use</a></p>
                </div>
                <div class="col-md-12 text-center ">
                    <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Signup</button>
                </div>
                <div class="form-group">
                    <p class="text-center">Already have an account? <a href="/login" id="signup">Login Here</a></p>
                </div>
            </form>
            
        </div>
    </div>
</div>