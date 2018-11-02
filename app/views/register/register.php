<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="col-md-6 mx-auto card">
    <form class="form" action="<?=PROOT?>register/register" method="post">
        <div class="bg-danger"><?=$this->displayErrors ?></div>
        <h3 class="text-center">Register</h3>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_1">Password</label>
            <input type="password" name="password_1" id="password_1" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_2">Repeat password</label>
            <input type="password" name="password_2" id="password_2" class="form-control">
        </div>
        <div class="form-group">
            <label for="remember_me">Remember Me <input type="checkbox" id = "remember_me" name="remember_me" value="on"></label>
        </div>
        <div class="form-group">
            <input type="submit" value="Login" class="btn btn-large btn-primary">
        </div>
        
    </form>
</div>
<?php $this->end(); ?>
