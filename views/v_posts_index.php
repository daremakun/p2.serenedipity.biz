<?php foreach($posts as $post): ?>

<article>

    <h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>

    <p><?=$post['content']?></p>

    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    </time>

	<br>
                
        <?php if($user->user_id == $post[post_user_id]): ?>
                        
         <a href=edit/<?=$post['post_id']?>>edit</a>
         |
         <a href=delete/<?=$post['post_id']?>>delete</a>        
         <br/>
        
        <?php endif; ?>                
        
    <br>
</article>

<?php endforeach; ?>


