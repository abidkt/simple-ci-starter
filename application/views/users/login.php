<h2>Login</h2>
<hr/>
<?php
    if($error == 1)
    {
        echo '<div style="color:red" >Hmm, we don\'t recognize you. Please try again.</div><br>';
    }
    else if($error == 2)
    {
        echo '<div style="color:red" >Hmm, your account is not activated.</div><br>';
    }
?>
<?php echo form_open(base_url( 'users/login' ), array( 'method' => 'post' ));?>
<div class="form_settings">

    <p><span>Username</span><input class="" required type="text" name="username" value="" /></p>
    <p><span>Password</span><input class="" required type="password" name="password" value="" /></p>
    <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="add" value="Login" /></p>
</div>
</form>
