<div class="wrap">
	<div id="icon-plugins" class="icon32"></div>
	<!-- <h2><?php _e( 'DX Plugin Base', 'dxbase' ); ?></h2> -->

	<div class="dx-help-page">
		<div class="content alignleft">
			<h2 class='page-welcome'>Welcome to <span>DX Plugin Base!</span></h2>

			<div id="dx-help-content">

					<h2><?php _e( "Base plugin page", 'dxbase' ); ?></h2>
						
					<p><?php _e( "Sample base plugin page", 'dxbase' ); ?></p>
					
					<form id="dx-plugin-base-form" action="options.php" method="POST">
						
							<?php settings_fields( 'dx_setting' ) ?>
							<?php do_settings_sections( 'dx-plugin-base' ) ?>
							
							<input type="submit" value="<?php _e( "Save", 'dxbase' ); ?>" />
					</form> <!-- end of #dxtemplate-form -->
				
			</div>

			<footer class='dx-footer'>
				<a href="http://devrix.com/sign-up/" target="_blank"><img class='footer-banner' src="http://devrix.com/media/help-banner.png" alt="WordPress help"></a>
			</footer>

		</div>
		<div class="sidebar alignright">
			<h2>About the plugin</h2>
			<p>This plugin is built by <a href="http://devrix.com/" target="_blank">DevriX</a>, a High-end WordPress Agency. We love WordPress and contribute back whenever possible!</p>
			<p>Find us on <a href="https://twitter.com/wpdevrix" target="_blank">Twitter</a> and <a href="https://www.facebook.com/DevriXLtd" target="_blank">Facebook</a></p>
		</div>
	</div>
	
</div>