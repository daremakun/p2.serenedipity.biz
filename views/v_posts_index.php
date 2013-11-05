<?php foreach($posts as $post): ?>

        <span class="username"><?=$post['first_name']?></span>
        <span class="postdate"><?=Time::display($post['created'])?></span>
        <br>
        <?=$post['content']?>
        <br>
        
                
        <?php if($user->user_id == $post[post_user_id]): ?>
                        
         <a href=edit/<?=$post['post_id']?>>edit</a>
         |
         <a href=delete/<?=$post['post_id']?>>delete</a>        
         <br/>
        
        <?php endif; ?>                
        
        <br>
        
<?php endforeach; ?>