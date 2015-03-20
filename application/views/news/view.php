<div class="news">
	<h2><?=$news['title']?></h2>
	<p class="news-details">
		<span>by</span> <a><?=$news['username']?></a>
		&nbsp;&nbsp;
		<span>on</span> <a><?=date( 'F jS, Y g:i a' , strtotime($news['date_added']))?></a>
		&nbsp;&nbsp;
		<?php if($this->session->userdata('user_id') == $news['user_id']){ ?>
        <a href="<?= base_url('news/deletenews/'.$news['id'])?>"><img src="<?=base_url('public/images/delete.png')?>" title="Delete news"></a>
        <?php }?>
        <a href="<?= base_url('news/pdf/'.$news['id'])?>"><img src="<?=base_url('public/images/pdf.png')?>" title="Download news"></a>
	</p>
	<div class="news-content">
		<?php if($news['image']) { ?><img src="<?=base_url('public/uploads/'.$news['image'])?>"/><?php } ?>
		<p><?=$news['content']?></p>
	</div>
</div>
