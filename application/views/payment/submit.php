<script type="text/javascript">
$('document').ready(function() {
	document.forms['gateway_form'].submit();
});
</script>

<form method="POST" name="gateway_form" action="<?php echo ($gateway); ?>">

	<?php foreach ($fields as $name => $value): ?>
		<?php echo form_hidden($name, $value); ?>
	<?php endforeach; ?>

	<h2>Processing your payment. <small>Please wait.</small></h2>
	
	&nbsp;

	<div class="alert-message block-message information" style="text-align:center;">
		<p>
			If you are not automatically redirected to payment website within 5 seconds...
		</p>
	</div>
	
	<div class="row" style="text-align:center;">
		<input class="btn primary" type="submit" value="Click Here">
	</div>

</form>