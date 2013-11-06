<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	 <link rel="stylesheet" href="/css/style.css">	
	 				
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<div id="container">

		<div id="header">
			<h2><a href='/'>Serenedipity</a></h2><br>	
		</div>

	<div id="navigation">
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
        <ul>	
   			<li class='active '><a href='/'><span>Home</span></a></li>
   			<li><a href='/posts/add'><span>Add Posts</span></a></li>
   			<li><a href='/posts/'><span>View Posts</span></a></li>
   			<li><a href='/posts/users'><span>Follow Users</span></a></li>
   			<li><a href='/users/logout'><span>Log Out</span></a></li>
        <!-- Menu options for users who are not logged in -->
        <?php else: ?>
        
        	<li><a href='/users/signup'><span>Sign Up</span></a></li>
   			<li><a href='/users/login'><span>Log In</span></a></li>		
   		</ul>
        <?php endif; ?>
	</div>
	<div id="content"> 
		<h3>  </h3>
			<p>Life is full of complexities and serendipitous events. Share them here!</p>
    <?php if(isset($content)) echo $content; ?>
	</div>
	
	<div id="footer">
    		<h4>Plus one features</h4>
    		<p>Delete post | Edit post</p>	
	</div>
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</div>
</html>