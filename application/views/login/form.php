<?php if ($this->input->get('login_failed')): ?>
<p class="alert-message error">Your login attempt failed.</p>
<?php endif; ?>
<?php if ($this->input->get('logged_out')): ?>
<p class="alert-message info">You have been logged out.</p>
<?php endif; ?>

<?php echo form_open('login/post'); ?>

	<?php echo form_fieldset('Login'); ?>

		<div class="clearfix">
			<?php echo form_label('Username', 'username'); ?>
			<div class="input">
				<?php echo form_input('username', $this->input->cookie('username')); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo form_label('Password', 'password'); ?>
			<div class="input">
				<?php echo form_password('password'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<label></label>
			<div class="input">
				<ul class="inputs-list"
					<li>
					<label><?php echo form_checkbox('save'); ?>	<span>Remember this login.</span></label>
					</li>
				</ul>
			</div>
		</div>

		<?php echo form_hidden('redirect', $redirect); ?>

		<div class="actions">
			<?php echo form_submit('login', 'Login', 'class="btn primary large"'); ?>
		</div>
		
		<div class="row">
			<p style="text-align:center;">
				<a href="<?php echo site_url('payment'); ?>">Make a payment</a> without logging in.
			</p>
		</div>

	<?php echo form_fieldset_close(); ?>

<?php echo form_close(); ?>