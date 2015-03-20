<h2>
    <?=($this->uri->segment(2) == 'user')? 'My news' : 'All news'?> 
    <?php if($this->session->userdata('user_id')){ ?>
        <a style="color: green ; float:right" href="<?=  base_url('news/add')?>">Add news</a>
    <?php } ?>
</h2>
<hr/>
<?php if(count($news)) { 
    foreach($news as $n){ ?>
        <div class="news">
            <h3>
                <a style="color:red;" href="<?=  base_url('news/view/'.$n['id'])?>"><?=$n['title'];?></a>
            </h3>
            <p class="news-details">
                <span>by</span> <a><?=$n['username']?></a>
                &nbsp;&nbsp;
                <span>on</span> <a><?=date( 'F jS, Y g:i a' , strtotime($n['date_added']))?></a>
                &nbsp;&nbsp;
                <?php if($this->session->userdata('user_id') == $n['user_id']){ ?>
                <a href="<?= base_url('news/deletenews/'.$n['id'])?>"><img src="<?=base_url('public/images/delete.png')?>" title="Delete news"></a>
                <?php }?>
                <a href="<?= base_url('news/pdf/'.$n['id'])?>"><img src="<?=base_url('public/images/pdf.png')?>" title="Download news"></a>
            </p>

            <div class="news-content">
                <p><?=  substr(strip_tags($n['content']), 0, 200).'...';?></p>
            </div>
            <p><a href="<?=base_url()?>news/view/<?=$n['id']?>">Read More</a></p>
        </div>
    <?php 
    }
}
else{
    echo '<p style="text-align:center">No new news</p>';
} 
?>
<?=$pages?>
