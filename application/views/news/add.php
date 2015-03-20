<h2>Add your news</h2><hr/>
<?php if($error){echo '<div style="color:red;">'.$error.'</div>'; }?>
    <?php echo form_open_multipart(base_url( 'news/add' ), array( 'method' => 'post' ));?>
    <div class="form_settings">
        <p><span>Title</span><input style="width:700px" required type="text" name="title" value="<?=set_value('title')?>" /></p>
        <p><span>Image</span><input type="file" required accept="image/*" name="userfile"></p>
        <p><span>Content</span><textarea style="width:700px" class="textarea"  required rows="15" cols="100" name="content"><?=set_value('content')?></textarea></p>
        <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="add" value="Publish" /></p>
    </div>
</form>