<?php if($user): ?>

<a href="/posts/add">Post something here!</a>

<p>Hello <?=$user->first_name;?> welcome back. Click <a href="/posts">here</a> to see posts.</p>

<?php else: ?> 

<div id='cssmenu'>
    <h3>Welcome to Serenedipity</h3><br>
    
    <p>Hey, I know the spelling is a little off, have fun with it!!! This microblog is a fun space, share your thoughts and journeys.</p>
   <ul> 
    <li><a href='/users/signup'><span>Sign Up</span></a></li>
   	<li><a href='/users/login'><span>Log In</span></a></li>
   </ul>
</div>

<?php endif; ?>
 