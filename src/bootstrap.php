<?php

use WP_Forge\UserLastModified;

if ( function_exists( 'add_action' ) && function_exists( 'did_action' ) ) {

	add_action(
		'init',
		function () {
			UserLastModified::init();
		}
	);

	if ( did_action( 'init' ) ) {
		add_action(
			'after_setup_theme',
			function () {
				UserLastModified::init();
			}
		);
	}
}
