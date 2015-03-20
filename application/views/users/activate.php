
<?php 
if($activation_error){
    echo '<div style="color:red;">Invalid activation link or activation link expired.</div>'; 
}
else{
    ?>
    <h2>Enter new password</h2>
    <hr/>
    <?php echo '<div style="color:green;">Your account is activated. Now, enter the password.</div><br>'; ?>
    <?php if($error){echo '<div style="color:red;">'.$error.'</div><br>'; }?>

        <?php echo form_open('', array( 'method' => 'post' ));?>
        <div class="form_settings">
            <p><span>Password</span><input class="" type="password" name="password" value="" /></p>
            <p><span>Retype Password</span><input class="" type="password" name="passconf" value="" /></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="add" value="Register" /></p>
        </div>
    </form>
<?php } ?>    