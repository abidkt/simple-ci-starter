<h2>Register as a new user</h2>
<hr/>
<?php if($error){echo '<div style="color:red;">'.$error.'</div><br>'; }?>
<?php if($message){echo '<div style="color:green;">'.$message.'</div><br>'; }?>

<?php echo form_open(base_url( 'users/register' ), array( 'method' => 'post' ));?>
    <div class="form_settings">
        <p><span>Username</span><input class="" type="text" required name="username" value="" /></p>
        <p><span>E-Mail</span><input class="" type="email" required name="email" value="" /></p>
        <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="add" value="Register" /></p>
    </div>
</form>