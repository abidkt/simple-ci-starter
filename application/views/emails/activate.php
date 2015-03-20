<h3>Dear <?=$user['username']?></h3>
<p>Please activate your account by clicking the below link<br/>
<a href="<?=base_url()?>users/activate/<?=$user['activation_code']?>"><?=base_url()?>users/activate/<?=$user['activation_code']?></a>
</p>