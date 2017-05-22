<html>
<head><title>Log In</title></head>
<body>
	<h1>Log In</h1>
	<?php
	echo form_open('LogIn/user_login_process');
	$data = array(
			'name' => 'username',
			'value' => '',
			'placeholder' => 'Username',
			'maxlength' => '100'
		);
	echo form_input($data);
	echo form_password('password','','placeholder="Password"');
	echo form_submit('submit', 'Log In');
	?>
</body>
</html>