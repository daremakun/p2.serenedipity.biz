<div id='article_container'>
        <article id='article_one'>
                <p id='article_content'>
                        <?=$post['content']?>
                </p>
                <p id='article_poster'>Created:
                        <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
                                <?=Time::display($post['created'])?>
                        </time>
                </p>
        </article>
</div>