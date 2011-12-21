<?php
	// User object needed globally
	$user = unserialize($this->session->userdata('user'));
	$flash_message = $this->session->flashdata('message');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title><?php echo isset($page_title) ? $page_title . ' | ' . $this->config->item('application_name') : $this->config->item('application_name'); ?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/bootstrap.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/jquery.meow/jquery.meow.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>" />
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap-modal.js'); ?>"> </script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap-dropdown.js'); ?>"> </script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap-twipsy.js'); ?>"> </script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap-scrollspy.js'); ?>"> </script>
	<script src="<?php echo base_url('assets/js/jquery.meow/jquery.meow.js'); ?>"> </script>
  <script src="<?php echo base_url('assets/js/jquery.alphanumeric.js'); ?>"> </script>
  <script src="<?php echo base_url('assets/js/jquery.validate.js'); ?>"> </script>
	<script src="<?php echo base_url('assets/js/global.js'); ?>"> </script>
	
	<?php echo (isset($head_content)) ? $head_content : ''; ?>

</head>
<body>
	
	<div class="topbar" data-dropdown="dropdown">
	  <div class="fill">
			<div class="container">
				<a href="<?php echo site_url(); ?>" class="brand"><?php echo ($this->config->item('application_logo')) ? sprintf('<img src="%s" alt="%s" height="30" width="100" />', $this->config->item('application_logo'), $this->config->item('application_name')) : $this->config->item('application_name'); ?></a>
				<?php if ($this->session->userdata('user')): ?>
				<ul class="nav">
					<li><a href="<?php echo site_url('history'); ?>">Account History</a></li>
					<li><a href="<?php echo site_url('ledger'); ?>">A/R Ledger</a></li>
					<li><a href="<?php echo site_url('payment'); ?>">Make a Payment</a></li>
					<li><a href="<?php echo site_url('contact'); ?>">Contact Us</a></li>
				</ul>
				<div class="pull-right">
					<ul class="nav">
						<li><a href="<?php echo site_url('profile'); ?>">Welcome <?php echo $user->firstname; ?>!</a></li>
						<li><a href="<?php echo site_url('logout'); ?>">Logout</a></li>
					</ul>
				</div>
				<?php elseif ($this->router->class != 'login'): ?>
				<form method="post" action="<?php echo site_url('login/post'); ?>" class="pull-right">
				<?php echo form_input('username', '', 'class="input-small" placeholder="Username"'); ?>
				<?php echo form_password('password', '', 'class="input-small" placeholder="Password"'); ?>
				<?php echo form_button('login', 'Login', 'class="btn" onclick="this.form.submit();"'); ?>
				<?php echo form_hidden('redirect', (isset($redirect)) ? $redirect : ''); ?>
				</form>
				<?php endif; ?>
			</div>
		</div>
	</div>