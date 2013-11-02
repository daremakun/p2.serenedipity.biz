<?php if($user): ?>
        Hello <?=$user->first_name;?>
<?php else: ?>
        Welcome my app! Please <a href='/users/signup'>Sign up </a>or <a href='/users/login'>Login</a>.
<?php endif; ?>

