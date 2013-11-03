<?php if($user): ?>
<div id="header">
    <h1>Serenedipity</h1><br>
    Life is full of complexities and serendipitous events. Share them here!
</div>
  
<div id="nav">
    <h2>Features</h2>
    <ul>
      <li><a href="/users/signup">Sign Up</a></li>
      <li><a href="/users/login">Log In</a></li>
      <li><a href="/posts/delete_one/-1">Delete a Post</a></li>
    </ul>
</div>
<div id="main">
    <h2>Welcome to Serenedipity</h2><br>
    <p>Hey, I know the spelling is a little off, have fun with it!!! This microblog is a fun space, share your thoughts and journeys.</p>
    <p>Hello <?=$user->first_name;?> welcome back. Click <a href="/posts">here</a> to see posts.</p>
</div>

<?php else: ?>
<div id="sidebar">
    <h2>Account</h2>
    <p class="summary">
        Welcome my app! Please <a href='/users/signup'> Create an account </a>or <a href='/users/login'>Login</a>.
    </p>
    <p><form method='POST' action='/users/p_login'>
                username <input type="text" name="email" /> <br/>
                password <input type="password" name="password" /> <br/>
                <input type="submit" value="login">
        </form>
    </p>
</div>
<div id="footer">
    <h2>Plus One feature</h2>
    <p>Delete post is +1 feature.</p>
</div>
<?php endif; ?>
 


