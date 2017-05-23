<html>
<head><title>Admin</title></head>
<body>
<h1>Logged In as <?php echo $this->session->userdata('name'); ?></h1>
<div>
<ul>
	<li><a href="<?php echo site_url('Accounts/profile'); ?>">My Profile</a></li>
	<li><a href="<?php echo site_url('Accounts/others');?>">Other Users</a></li>

</ul>

</div>
</body>
</html>