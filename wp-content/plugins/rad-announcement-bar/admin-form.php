<div class="wrap">
	<h1>Rad Announcement Bar!!!</h1>
	<p>Thanks for using my plugin, buy me a coffee sometime</p>
	<form action="options.php" method="post">
		<?php 
		//connect this form to the settings group in the DB 
		//(we registered this group with register_setting() in the plugin )
		settings_fields( 'rad_ab_group' ); 
		$values = get_option('rad_bar');
		?>

		<label>Text for the bar:</label>
		<input type="text" name="rad_bar[bartext]" value="<?php echo $values['bartext']; ?>">

		<br>

		<label>URL of the button</label>
		<input type="url" name="rad_bar[url]" value="<?php echo $values['url']; ?>">

		<br>

		<?php submit_button( 'Save Settings' ); ?>
	</form>
</div>