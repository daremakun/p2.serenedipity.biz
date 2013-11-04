<?php if($user): ?>

<a href="posts/">Post something here!</a>

<p>Hello <?=$user->first_name;?> welcome back. Click <a href="/posts">here</a> to see posts.</p>

<?php else: ?> 

<div id="main">
    <h2>Welcome to Serenedipity</h2><br>
    <p>Hey, I know the spelling is a little off, have fun with it!!! This microblog is a fun space, share your thoughts and journeys.</p>
    
</div>

<?php endif; ?>
 


