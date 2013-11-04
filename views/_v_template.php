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

<div id="nav">
    <h2>Features</h2>
    <ul>
      <li><a href="/users/signup">Sign Up</a></li>
      <li><a href="/users/login">Log In</a> <a href="users/logout">Log out</a></li>
      <li><a href="/posts/delete_one/-1">Delete a Post</a></li>
      <a href="posts/">Post something here!</a>
    </ul>
</div>
  
	<?php if(isset($content)) echo $content; ?>
<div id="sidebar">
    <h2>Account</h2>
    <p class="summary">
        Welcome to my app! Please <a href='/users/signup'> Create an account </a>or <a href='/users/login'>Login</a>.
    </p>
    
</div>
<div id="footer">
    <h2>Two feature</h2>
    <p>Delete post is +1 feature.</p>
    <p>Edit post</P>
</div>
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>