<div id="site_content">
    <div id="content">
        <h2 style="color:red"><?=$news['title']?></h2>
        <p>
            <span style="color:#cdcdcd;">by</span> <a style="color:blue;"><?=$news['username']?></a>
            &nbsp;&nbsp;
            <span style="color:#cdcdcd">on</span> <a style="color:blue"><?=date( 'F jS, Y g:i a' , strtotime($news['date_added']))?></a>
        </p>
        <hr style="color:#666"/>
        <?php if($news['image']) { ?><img src="./public/uploads/<?=$news['image']?>"/><?php } ?>
        <p><?=$news['content']?></p>
    </div>
</div>