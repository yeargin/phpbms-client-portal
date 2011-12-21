<script type="text/javascript">
$('document').ready(function() {

	// Clear the field if the text is 0.00
	$("#payment_amount").focus(function() {
		if ( $("#payment_amount").val() == '0.00' ) {
			$("#payment_amount").val('');
		}
	});

	// Validate Payment Form
	$("#paymentForm").validate({
		errorElement: 'span',
		rules: {
			payment_amount: {
				required: true,
				min: 0.01
			},
			payment_ref: {
				required: true
			},
		},
		messages: {
			payment_amount: {
				required: '<span class="label important" style="margin-left:10px;">Required</span>',
				min: '<span class="label warning" style="margin-left:10px;">Must be greater than zero</span>'
			},
			payment_ref: {
				required: '<span class="label important" style="margin-left:10px;">Required</span>'
			}
		}
	});

	// Prevent dollar signs, etc. in payment amount
	$('#payment_amount').numeric({
		allow:"."
	});

});
</script>

<?php if ($message == 'processing'): ?><p class="alert-message info">Processing your request ...</a>.</p><?php endif; ?>
<?php if ($message == 'success'): ?><p class="alert-message success">Your payment has been received! If you have any questions, please <a href="<?php site_url('contact'); ?>" style="color:#ffffff;">contact us</a>.</p><?php endif; ?>
<?php if ($message == 'error' || $message == 'cancel'): ?><p class="alert-message error">Your transaction has been canceled. To arrange another payment method, please <a href="<?php site_url('contact'); ?>" style="color:#ffffff;">contact us</a>.</p><?php endif; ?>

<?php echo form_open('payment/submit', 'id="paymentForm"'); ?>
<?php echo form_fieldset('Submit a Payment'); ?>
	<div class="clearfix">
		<?php echo form_label('Amount (US$)', 'payment_amount'); ?>
		<div class="input">
			<?php echo form_input(array('name'=>'payment_amount','id'=>'payment_amount','value' => $payment_amount, 'class' => 'required', 'placeholder' => '0.00')); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo form_label('Invoice/Reference #', 'payment_ref'); ?>
		<div class="input">
			<?php echo form_input(array('name'=>'payment_ref','id'=>'payment_ref','value' => $payment_ref, 'class' => 'required', 'placeholder' => '12345')); ?>
		</div>
	</div>

	<div class="actions">
		<?php echo form_submit('sumbit', 'Process Payment', 'class="btn primary large"'); ?>
	</div>

<?php echo form_fieldset_close(); ?>
<?php echo form_close(); ?>