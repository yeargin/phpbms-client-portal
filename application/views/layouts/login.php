<?php
	// User object needed globally
	$user = unserialize($this->session->userdata('user'));
	$flash_message = $this->session->flashdata('message');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title><?php echo isset($page_title) ? $page_title : $this->config->item('application_name'); ?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/bootstrap.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/jquery.meow/jquery.meow.css'); ?>" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
	<script src="<?php echo base_url('assets/css/bootstrap/js/bootstrap-modal.js'); ?>"> </script>
	<script src="<?php echo base_url('assets/css/bootstrap/js/bootstrap-dropdown.js'); ?>"> </script>
	<script src="<?php echo base_url('assets/css/bootstrap/js/bootstrap-twipsy.js'); ?>"> </script>
  <script src="<?php echo base_url('assets/css/bootstrap/js/bootstrap-scrollspy.js'); ?>"> </script>
	<script src="<?php echo base_url('assets/js/jquery.meow/jquery.meow.js'); ?>"> </script>
	<script src="<?php echo base_url('assets/js/global.js'); ?>"> </script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css'); ?>" />
	
	<?php echo (isset($head_content)) ? $head_content : ''; ?>

</head>
<body>

	<div class="container">
		<div class="content">
			<div class="row">
				<div class="offset4 span7">
					<a href="/" class="brand"><?php echo ($this->config->item('application_logo')) ? sprintf('<img src="%s" alt="%s" />', $this->config->item('application_logo'), $this->config->item('application_name')) : $this->config->item('application_name'); ?></a>
				</div>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="offset4 span7">{yield}</div>
			</div>
		</div>
	</div>
	
	<div id="onready" style="display:none;">
		<?php if ($flash_message != ''): ?>
			<div><?php echo ($flash_message); ?></div>
		<?php endif; ?>
	</div>
	
</body>
</html>