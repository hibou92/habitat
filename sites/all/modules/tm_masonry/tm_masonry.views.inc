<?php

/**
 * Implements hook_views_plugins
 */
function tm_masonry_views_plugins() {
	return array(
		'style' => array(
			'tm_masonry' => array(
				'title' => t( 'TM Masonry Grid' ),
				'theme' => 'views_tm_masonry',
				'theme path' => drupal_get_path( 'module', 'tm_masonry' ) . '/theme',
				'theme file' => 'tm_masonry.theme.inc',
				'help' => t( 'Display content in a masonry grid.' ),
				'handler' => 'tm_masonry_plugin_style_masonry',
				'uses options' => TRUE,
				'uses row plugin' => TRUE,
				'uses row class' => TRUE,
				'uses grouping' => FALSE,
				'type' => 'normal',
			),
		),
	);
}