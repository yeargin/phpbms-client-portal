<?php require_once('_header.inc.php'); ?>

	<div class="container">
		<div class="content">
			<div class="row">
				<div class="span10">{yield}</div>
				<div class="span4">
					<?php echo isset($sidebar_content) ? $sidebar_content : ''; ?>
				</div>
			</div>
		</div>
	</div>
	
<?php require_once('_footer.inc.php'); ?>