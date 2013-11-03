<div id='post_container'>
        <post id='post_one'>
                <p id='post_content'>
        <?php if ($msg==-1): ?>
                Sorry, you are not the author of this post and cannot delete this post.
        <?php else: ?>
                        <?=$post['content']?>
                        <br/>
        <?php endif; ?>
                </p>
                <p id='article_poster'>Created:
                        <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
                                <?=Time::display($post['created'])?>
                        </time>
                </p>
        </article>
                <form method='POST' action='/posts/p_delete_one'>
                        <input type="hidden" name='post_id' value='<?=$post['post_id']?>'>
                        <input type='submit' value='confirm deletion'>
                       
                </form>
</div>