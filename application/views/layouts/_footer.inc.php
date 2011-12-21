	<footer class="container">
		<p>
			Client Portal provied by <?php echo $this->config->item('application_credit'); ?>.
		</p>
	</footer>
	
	<div id="onready" style="display:none;">
		<?php if ($flash_message != ''): ?>
			<div><?php echo ($flash_message); ?></div>
		<?php endif; ?>
	</div>
	
</body>
</html>