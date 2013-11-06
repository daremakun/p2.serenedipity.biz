<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	 <link rel="stylesheet" href="/css/styles.css">	

	 <link href="/menu_assets/styles.css" rel="stylesheet" type="text/css">
	 				
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body id="serene">	

<div id="header">
	<h2><a href='/'>Serenedipity</a></h2><br>
    Life is full of complexities and serendipitous events. Share them here!
</div>

<div id='cssmenu'>
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
        <ul>	
   			<li class='active '><a href='/'><span>Home</span></a></li>
   			<li><a href='/posts/add'><span>Add Posts</span></a></li>
   			<li><a href='/posts/'><span>View Posts</span></a></li>
   			<li><a href='/posts/users'><span>Follow Users</span></a></li>
   			<li><a href='/users/logout'><span>Log Out</span></a></li>
        <!-- Menu options for users who are not logged in -->
   			<li><a href='/users/signup'><span>Sign Up</span></a></li>
   			<li><a href='/users/login'><span>Log In</span></a></li>
   		</ul>
        <?php endif; ?>
</div>

		<?php if($user): ?>
                You are logged in as <?=$user->first_name?> <?=$user->last_name?><br>
        <?php endif; ?>
    <br>

    <?php if(isset($content)) echo $content; ?>

</body>

<div id="sidebar"> 
    
</div>
<div id="footer">
    <h4>Plus one features</h4>
    <p>Delete post is +1 feature.</p>
    <p>Edit post</P>
</div>
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>