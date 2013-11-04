<div id="main">
<?php if
	($error == "error_blank"): ?>
	<div class='error'>
		<p>Signup failed. Fields cannot be blank. Please try again.</p>
	</div>
	<br/>
<?php endif; ?>
<?php if
	($error == "error_email"): ?>
	<div class='error'>
		<p>Signup failed. Email is already in use. Please try again.</p>
	</div>
	<br/>
<?php endif; ?> 
	
<h2>Sign Up</h2>

		<form method='POST' action='/users/p_signup'>

			First Name <input type='text' name='first_name'><br>
			Last Name <input type='text' name='last_name'><br>
			Email <input type='text' name='email'><br>
			Password <input type='password' name='password'><br>
	
			<input type='submit' value='Sign Up'>
	
		</form>
</div>