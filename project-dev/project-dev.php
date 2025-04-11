<?php
/**
 * Plugin Name: Project DEV plugin
 * Description: Gets images from productstion site. For development environment only.
 * Version: 1.0
 * Author: Project
 * Author URI: Project
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package Project_Dev
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * Link uploads to production URLs.
 */

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	return;
}

ob_start();

add_action(
	'shutdown',
	function() {
		$output = '';

		// We'll need to get the number of ob levels we're in, so that we can iterate over each, collecting
		// that buffer's output into the final output.
		for ( $i = 0; $i < ob_get_level(); $i++ ) {
			$output .= ob_get_clean();
		}

		// Do the actual replacements for /uploads/ path.
		$replacements = array(
			'//project.test/wp-content/uploads/' => '//client.website.com/wp-content/uploads/',
			'\/\/project.test\/wp-content\/uploads\/' => '\/\/client.website.com\/wp-content\/uploads\/',
		);
		foreach ( $replacements as $replace => $with ) {
			$output = str_replace( $replace, $with, $output );
		}

		echo $output;
	},
	0
);
