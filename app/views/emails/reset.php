
<p> Dear <?= $name?>
    We have recieved request for Password Reset. If it is not you ignore this email, however
    if request is made by you please <a href="<?=ROOT_URL.'/reset-password?email='.$email.'&&token='.$token?>">click here</a> to reset your password.
</p>
<a href="<?=ROOT_URL.'/reset-password/token/'.$token?>
