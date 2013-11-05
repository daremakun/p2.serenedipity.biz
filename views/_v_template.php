<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	 <link rel="stylesheet" href="/css/styles.css">	
	 <link rel="stylesheet" href="/css/blueprint/screen.css">
	 				
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
<div id="header">
	<h1>Serenedipity</h1><br>
    Life is full of complexities and serendipitous events. Share them here!
</div>

<div id='menu'>

        <a href='/'>Home</a>

        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
            <li><a href='/posts/add'>Add Post</a></li>
            <li><a href='/posts/'>View Posts</a></li>
            <li><a href='/posts/users'>Follow Users</a></li>
            <li><a href='/users/logout'>Logout</a></li>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <li><a href='/users/signup'>Sign Up</a></li>
            <li><a href='/users/login'>Log In</a></li>
        <?php endif; ?>
</div>

		<?php if($user): ?>
                You are logged in as <?=$user->first_name?> <?=$user->last_name?><br>
        <?php endif; ?>
    <br>

    <?php if(isset($content)) echo $content; ?>

</body>

<div id="sidebar">
    <h2>Account</h2>
    <p class="summary">
        Welcome to my app! Please <a href='/users/signup'> Create an account </a>or <a href='/users/login'>Login</a>.
    </p>
    
</div>
<div id="footer">
    <h2>Plus one features</h2>
    <p>Delete post is +1 feature.</p>
    <p>Edit post</P>
</div>
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>