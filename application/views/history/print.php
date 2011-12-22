<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title><?php echo isset($page_title) ? $page_title . ' | ' . $this->config->item('application_name') : $this->config->item('application_name'); ?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/bootstrap.css'); ?>" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/print.css'); ?>" media="all" />
	
	<?php echo (isset($head_content)) ? $head_content : ''; ?>

</head>
<body>

<?php require_once('detail.php'); ?>

</body>
</html>