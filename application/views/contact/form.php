<script type="text/javascript">
$(document).ready(function () {
	$('form').validate({
		errorElement: 'span',
		messages: {
			name: {
				required: '<span class="label important" style="margin-left:10px;">Required</span>'
			},
			email: {
				required: '<span class="label important" style="margin-left:10px;">Required</span>',
				email: '<span class="label warning" style="margin-left:10px;">Invalid e-mail</span>'
			},
			subject: {
				required: '<span class="label important" style="margin-left:10px;">Required</span>'
			},
			message: {
				required: '<span class="label important" style="margin-left:10px;">Required</span>'
			}
		}
	});
});
</script>
<style type="text/css">
textarea.xxlarge { width: 400px; }
</style>

<?php if ($status == 'error'): ?>
<p class="alert-message error">There was an error processing your form submission.</p>
<?php elseif ($status == 'success'): ?>
<p class="alert-message success">Your message was sent successfully.</p>
<?php endif; ?>

<?php echo form_open('contact/send'); ?>

	<?php echo form_fieldset('Contact Us'); ?>

		<div class="clearfix">
			<?php echo form_label('Your Name', 'name'); ?>
			<div class="input">
				<?php echo form_input('name', $name, 'class="required" placeholder="John Doe"'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo form_label('Your E-mail', 'email'); ?>
			<div class="input">
				<?php echo form_input(array('name' => 'email', 'value' => $email, 'class' => 'required email', 'type' => 'email', 'placeholder' => 'user@example.com')); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo form_label('Subject', 'subject'); ?>
			<div class="input">
				<?php echo form_input('subject', $subject, 'class="required" placeholder="Your subject"'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo form_label('Message', 'message'); ?>
			<div class="input">
				<?php echo form_textarea('message', $message, 'class="xxlarge required" placeholder="Your message"'); ?>
			</div>
		</div>

		<div class="actions">
			<?php echo form_submit('send', 'Send Message', 'class="btn primary large"'); ?>
		</div>

	<?php echo form_fieldset_close(); ?>

<?php echo form_close(); ?>