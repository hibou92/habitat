<?php

/**
 * @file
 * Theme settings for the theme943
 */
function theme943_form_system_theme_settings_alter( &$form, &$form_state ) {
	if ( !isset( $form['theme943_settings'] ) ) {
		/**
		 * Vertical tabs layout borrowed from Sasson.
		 *
		 * @link http://drupal.org/project/sasson
		 */
		drupal_add_css( drupal_get_path( 'theme', 'theme943' ) . '/css/options/theme-settings.css', array(
			'group'				=> CSS_THEME,
			'every_page'		=> TRUE,
			'weight'			=> 99
		) );

		// Enable/disable options wich are depends on TM Block Background module
		if ( module_exists ( 'tm_block_bg' ) ) {
			$note = '';
			$disabled = FALSE;
		} else {
			$note = t( '<span style="color: #f00">You should enable TM Block Background Module to use this field!</span>' );
			$disabled = TRUE;
		}

		/* Submit function */
		$form['#submit'][] = 'theme943_form_system_theme_settings_submit';

		/* Add reset button */
		$form['actions']['reset'] = array(
			'#submit' => array( 'theme943_form_system_theme_settings_reset' ),
			'#type' => 'submit',
			'#value' => t( 'Reset to defaults' ),
		);

		/* Settings */
		$form['theme943_settings'] = array(
			'#type'				=> 'vertical_tabs',
			'#weight'			=> -10,
		);
		
		/**
		 * General settings.
		 */
		$form['theme943_settings']['theme943_general'] = array(
			'#title'			=> t( 'General Settings' ),
			'#type'				=> 'fieldset',
		);
		
		$form['theme943_settings']['theme943_general']['theme_settings'] = $form['theme_settings'];
		unset( $form['theme_settings'] );

		$form['theme943_settings']['theme943_general']['logo'] = $form['logo'];
		unset( $form['logo'] );

		$form['theme943_settings']['theme943_general']['favicon'] = $form['favicon'];
		unset( $form['favicon'] );
		
		$form['theme943_settings']['theme943_general']['theme943_sticky_menu'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_sticky_menu' ),
			'#title'			=> t( 'Stick up menu.' ),
			'#type'				=> 'checkbox',
		);

		/**
		 * Breadcrumb settings.
		 */
		$form['theme943_settings']['theme943_breadcrumb'] = array(
			'#title'			=> t( 'Breadcrumb Settings' ),
			'#type'				=> 'fieldset',
		);

		$form['theme943_settings']['theme943_breadcrumb']['theme943_breadcrumb_show'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_breadcrumb_show' ),
			'#title'			=> t( 'Show the breadcrumb.' ),
			'#type'				=> 'checkbox',
		);

		$form['theme943_settings']['theme943_breadcrumb']['theme943_breadcrumb_container'] = array(
			'#states'			=> array(
				'invisible'		=> array(
					'input[name="theme943_breadcrumb_show"]' => array(
						'checked'	=> FALSE
					),
				),
			),
			'#type'				=> 'container',
		);

		$form['theme943_settings']['theme943_breadcrumb']['theme943_breadcrumb_container']['theme943_breadcrumb_hideonlyfront'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_breadcrumb_hideonlyfront' ),
			'#title'			=> t( 'Hide the breadcrumb if the breadcrumb only contains a link to the front page.' ),
			'#type'				=> 'checkbox',
		);

		$form['theme943_settings']['theme943_breadcrumb']['theme943_breadcrumb_container']['theme943_breadcrumb_showtitle'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_breadcrumb_showtitle' ),
			'#description'		=> t( "Check this option to add the current page's title to the breadcrumb trail." ),
			'#title'			=> t( 'Show page title on breadcrumb.' ),
			'#type'				=> 'checkbox',
		);

		$form['theme943_settings']['theme943_breadcrumb']['theme943_breadcrumb_container']['theme943_breadcrumb_separator'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_breadcrumb_separator' ),
			'#description'		=> t( 'Text only. Dont forget to include spaces.' ),
			'#size'				=> 8,
			'#title'			=> t( 'Breadcrumb separator' ),
			'#type'				=> 'textfield',
		);

		/**
		 * Regions Settings
		 */
		$form['theme943_settings']['theme943_regions'] = array(
			'#title'			=> t( 'Regions Settings' ),
			'#type'				=> 'fieldset',
		);
		

		// Header bottom
		$form['theme943_settings']['theme943_regions']['theme943_header_bottom_opt'] = array(
			'#title'			=> t( 'Header bottom' ),
			'#type'				=> 'fieldset',
		);
		$form['theme943_settings']['theme943_regions']['theme943_header_bottom_opt']['theme943_header_bottom_bg_type'] = array(
			'#default_value' => theme_get_setting( 'theme943_header_bottom_bg_type' ),
			'#options' => array(
				'none' => 'None',
				'image' => 'Image',
				'video' => 'Video',
			),
			'#title' => t( 'Background type:' ),
			'#type' => 'select',
		);
		$form['theme943_settings']['theme943_regions']['theme943_header_bottom_opt']['theme943_header_bottom_bg_img'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_header_bottom_bg_img' ),
			'#description'		=> t( 'Choose block background image.' ),
			'#media_options' => array(
				'global' => array(
					'types' => array(
						'image' => 'image',
					),
					'schemes' => array(
						'public' => 'public',
					),
					'file_extensions' => 'png gif jpg jpeg',
					'max_filesize' => '1 MB',
					'uri_scheme' => 'public',
				),
			),
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_header_bottom_bg_type"]' => array(
						'value'	=> 'image'
					),
				),
			),
			'#title'			=> t( 'Background image URL' ),
			'#tree'				=> TRUE,
			'#type'				=> 'media',
		);
		$form['theme943_settings']['theme943_regions']['theme943_header_bottom_opt']['theme943_header_bottom_bg_parallax'] = array(
			'#default_value' =>  theme_get_setting( 'theme943_header_bottom_bg_parallax' ),
			'#description'		=> $note,
			'#disabled'			=> $disabled,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_header_bottom_bg_type"]' => array(
						'value'	=> 'image'
					),
				),
			),
			'#title' => t( 'Use parallax' ),
			'#type' => 'checkbox',
		);
		$form['theme943_settings']['theme943_regions']['theme943_header_bottom_opt']['theme943_header_bottom_bg_video'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_header_bottom_bg_video' ),
			'#description'		=> t( 'Enter video URL. Supports youtube video. ' ) . $note,
			'#disabled'			=> $disabled,
			'#size'				=> 60,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_header_bottom_bg_type"]' => array(
						'value'	=> 'video'
					),
				),
			),
			'#title'			=> t( 'Background Video URL' ),
			'#type'				=> 'textfield',
		);
		$form['theme943_settings']['theme943_regions']['theme943_header_bottom_opt']['theme943_header_bottom_bg_video_start'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_header_bottom_bg_video_start' ),
			'#description'		=> t( 'Enter time in seconds. ' ) . $note,
			'#disabled'			=> $disabled,
			'#size'				=> 8,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_header_bottom_bg_type"]' => array(
						'value'	=> 'video'
					),
				),
			),
			'#title'			=> t( 'Start video at' ),
			'#type'				=> 'textfield',
		);
		$form['theme943_settings']['theme943_regions']['theme943_header_bottom_opt']['theme943_header_bottom_fullwidth'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_header_bottom_fullwidth' ),
			'#description'		=> t( "Check this option to make this region fullwidth (e.g. remove grids)." ),
			'#title'			=> t( 'Fullwidth' ),
			'#type'				=> 'checkbox',
		);

		// Content top
		$form['theme943_settings']['theme943_regions']['theme943_content_top_opt'] = array(
			'#title'			=> t( 'Content top' ),
			'#type'				=> 'fieldset',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_top_opt']['theme943_content_top_bg_type'] = array(
			'#default_value' => theme_get_setting( 'theme943_content_top_bg_type' ),
			'#options' => array(
				'none' => 'None',
				'image' => 'Image',
				'video' => 'Video',
			),
			'#title' => t( 'Background type:' ),
			'#type' => 'select',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_top_opt']['theme943_content_top_bg_img'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_top_bg_img' ),
			'#description'		=> t( 'Choose block background image.' ),
			'#media_options' => array(
				'global' => array(
					'types' => array(
						'image' => 'image',
					),
					'schemes' => array(
						'public' => 'public',
					),
					'file_extensions' => 'png gif jpg jpeg',
					'max_filesize' => '1 MB',
					'uri_scheme' => 'public',
				),
			),
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_top_bg_type"]' => array(
						'value'	=> 'image'
					),
				),
			),
			'#title'			=> t( 'Background image URL' ),
			'#tree'				=> TRUE,
			'#type'				=> 'media',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_top_opt']['theme943_content_top_bg_parallax'] = array(
			'#default_value' =>  theme_get_setting( 'theme943_content_top_bg_parallax' ),
			'#description'		=> $note,
			'#disabled'			=> $disabled,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_top_bg_type"]' => array(
						'value'	=> 'image'
					),
				),
			),
			'#title' => t( 'Use parallax' ),
			'#type' => 'checkbox',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_top_opt']['theme943_content_top_bg_video'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_top_bg_video' ),
			'#description'		=> t( 'Enter video URL. Supports youtube video. ' ) . $note,
			'#disabled'			=> $disabled,
			'#size'				=> 60,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_top_bg_type"]' => array(
						'value'	=> 'video'
					),
				),
			),
			'#title'			=> t( 'Background Video URL' ),
			'#type'				=> 'textfield',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_top_opt']['theme943_content_top_bg_video_start'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_top_bg_video_start' ),
			'#description'		=> t( 'Enter time in seconds. ' ) . $note,
			'#disabled'			=> $disabled,
			'#size'				=> 8,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_top_bg_type"]' => array(
						'value'	=> 'video'
					),
				),
			),
			'#title'			=> t( 'Start video at' ),
			'#type'				=> 'textfield',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_top_opt']['theme943_content_top_fullwidth'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_top_fullwidth' ),
			'#description'		=> t( "Check this option to make this region fullwidth (e.g. remove grids)." ),
			'#title'			=> t( 'Fullwidth' ),
			'#type'				=> 'checkbox',
		);
		
		// Content two
		$form['theme943_settings']['theme943_regions']['theme943_content_two_opt'] = array(
			'#title'			=> t( 'Content two' ),
			'#type'				=> 'fieldset',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_two_opt']['theme943_content_two_bg_type'] = array(
			'#default_value' => theme_get_setting( 'theme943_content_two_bg_type' ),
			'#options' => array(
				'none' => 'None',
				'image' => 'Image',
				'video' => 'Video',
			),
			'#title' => t( 'Background type:' ),
			'#type' => 'select',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_two_opt']['theme943_content_two_bg_img'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_two_bg_img' ),
			'#description'		=> t( 'Choose block background image.' ),
			'#media_options' => array(
				'global' => array(
					'types' => array(
						'image' => 'image',
					),
					'schemes' => array(
						'public' => 'public',
					),
					'file_extensions' => 'png gif jpg jpeg',
					'max_filesize' => '1 MB',
					'uri_scheme' => 'public',
				),
			),
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_two_bg_type"]' => array(
						'value'	=> 'image'
					),
				),
			),
			'#title'			=> t( 'Background image URL' ),
			'#tree'				=> TRUE,
			'#type'				=> 'media',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_two_opt']['theme943_content_two_bg_parallax'] = array(
			'#default_value' =>  theme_get_setting( 'theme943_content_two_bg_parallax' ),
			'#description'		=> $note,
			'#disabled'			=> $disabled,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_two_bg_type"]' => array(
						'value'	=> 'image'
					),
				),
			),
			'#title' => t( 'Use parallax' ),
			'#type' => 'checkbox',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_two_opt']['theme943_content_two_bg_video'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_two_bg_video' ),
			'#description'		=> t( 'Enter video URL. Supports youtube video. ' ) . $note,
			'#disabled'			=> $disabled,
			'#size'				=> 60,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_two_bg_type"]' => array(
						'value'	=> 'video'
					),
				),
			),
			'#title'			=> t( 'Background Video URL' ),
			'#type'				=> 'textfield',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_two_opt']['theme943_content_two_bg_video_start'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_two_bg_video_start' ),
			'#description'		=> t( 'Enter time in seconds. ' ) . $note,
			'#disabled'			=> $disabled,
			'#size'				=> 8,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_two_bg_type"]' => array(
						'value'	=> 'video'
					),
				),
			),
			'#title'			=> t( 'Start video at' ),
			'#type'				=> 'textfield',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_two_opt']['theme943_content_two_fullwidth'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_two_fullwidth' ),
			'#description'		=> t( "Check this option to make this region fullwidth (e.g. remove grids)." ),
			'#title'			=> t( 'Fullwidth' ),
			'#type'				=> 'checkbox',
		);

		// Content bottom
		$form['theme943_settings']['theme943_regions']['theme943_content_bottom_opt'] = array(
			'#title'			=> t( 'Content bottom' ),
			'#type'				=> 'fieldset',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_bottom_opt']['theme943_content_bottom_bg_type'] = array(
			'#default_value' => theme_get_setting( 'theme943_content_bottom_bg_type' ),
			'#options' => array(
				'none' => 'None',
				'image' => 'Image',
				'video' => 'Video',
			),
			'#title' => t( 'Background type:' ),
			'#type' => 'select',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_bottom_opt']['theme943_content_bottom_bg_img'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_bottom_bg_img' ),
			'#description'		=> t( 'Choose block background image.' ),
			'#media_options' => array(
				'global' => array(
					'types' => array(
						'image' => 'image',
					),
					'schemes' => array(
						'public' => 'public',
					),
					'file_extensions' => 'png gif jpg jpeg',
					'max_filesize' => '1 MB',
					'uri_scheme' => 'public',
				),
			),
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_bottom_bg_type"]' => array(
						'value'	=> 'image'
					),
				),
			),
			'#title'			=> t( 'Background image URL' ),
			'#tree'				=> TRUE,
			'#type'				=> 'media',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_bottom_opt']['theme943_content_bottom_bg_parallax'] = array(
			'#default_value' =>  theme_get_setting( 'theme943_content_bottom_bg_parallax' ),
			'#description'		=> $note,
			'#disabled'			=> $disabled,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_bottom_bg_type"]' => array(
						'value'	=> 'image'
					),
				),
			),
			'#title' => t( 'Use parallax' ),
			'#type' => 'checkbox',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_bottom_opt']['theme943_content_bottom_bg_video'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_bottom_bg_video' ),
			'#description'		=> t( 'Enter video URL. Supports youtube video. ' ) . $note,
			'#disabled'			=> $disabled,
			'#size'				=> 60,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_bottom_bg_type"]' => array(
						'value'	=> 'video'
					),
				),
			),
			'#title'			=> t( 'Background Video URL' ),
			'#type'				=> 'textfield',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_bottom_opt']['theme943_content_bottom_bg_video_start'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_bottom_bg_video_start' ),
			'#description'		=> t( 'Enter time in seconds. ' ) . $note,
			'#disabled'			=> $disabled,
			'#size'				=> 8,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_content_bottom_bg_type"]' => array(
						'value'	=> 'video'
					),
				),
			),
			'#title'			=> t( 'Start video at' ),
			'#type'				=> 'textfield',
		);
		$form['theme943_settings']['theme943_regions']['theme943_content_bottom_opt']['theme943_content_bottom_fullwidth'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_content_bottom_fullwidth' ),
			'#description'		=> t( "Check this option to make this region fullwidth (e.g. remove grids)." ),
			'#title'			=> t( 'Fullwidth' ),
			'#type'				=> 'checkbox',
		);


		// Footer top
		$form['theme943_settings']['theme943_regions']['theme943_footer_top_opt'] = array(
			'#title'			=> t( 'Footer top' ),
			'#type'				=> 'fieldset',
		);
		$form['theme943_settings']['theme943_regions']['theme943_footer_top_opt']['theme943_footer_top_bg_type'] = array(
			'#default_value' => theme_get_setting( 'theme943_footer_top_bg_type' ),
			'#options' => array(
				'none' => 'None',
				'image' => 'Image',
				'video' => 'Video',
			),
			'#title' => t( 'Background type:' ),
			'#type' => 'select',
		);
		$form['theme943_settings']['theme943_regions']['theme943_footer_top_opt']['theme943_footer_top_bg_img'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_footer_top_bg_img' ),
			'#description'		=> t( 'Choose block background image.' ),
			'#media_options' => array(
				'global' => array(
					'types' => array(
						'image' => 'image',
					),
					'schemes' => array(
						'public' => 'public',
					),
					'file_extensions' => 'png gif jpg jpeg',
					'max_filesize' => '1 MB',
					'uri_scheme' => 'public',
				),
			),
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_footer_top_bg_type"]' => array(
						'value'	=> 'image'
					),
				),
			),
			'#title'			=> t( 'Background image URL' ),
			'#tree'				=> TRUE,
			'#type'				=> 'media',
		);
		$form['theme943_settings']['theme943_regions']['theme943_footer_top_opt']['theme943_footer_top_bg_parallax'] = array(
			'#default_value' =>  theme_get_setting( 'theme943_footer_top_bg_parallax' ),
			'#description'		=> $note,
			'#disabled'			=> $disabled,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_footer_top_bg_type"]' => array(
						'value'	=> 'image'
					),
				),
			),
			'#title' => t( 'Use parallax' ),
			'#type' => 'checkbox',
		);
		$form['theme943_settings']['theme943_regions']['theme943_footer_top_opt']['theme943_footer_top_bg_video'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_footer_top_bg_video' ),
			'#description'		=> t( 'Enter video URL. Supports youtube video. ' ) . $note,
			'#disabled'			=> $disabled,
			'#size'				=> 60,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_footer_top_bg_type"]' => array(
						'value'	=> 'video'
					),
				),
			),
			'#title'			=> t( 'Background Video URL' ),
			'#type'				=> 'textfield',
		);
		$form['theme943_settings']['theme943_regions']['theme943_footer_top_opt']['theme943_footer_top_bg_video_start'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_footer_top_bg_video_start' ),
			'#description'		=> t( 'Enter time in seconds. ' ) . $note,
			'#disabled'			=> $disabled,
			'#size'				=> 8,
			'#states'			=> array(
				'visible'		=> array(
					'select[name="theme943_footer_top_bg_type"]' => array(
						'value'	=> 'video'
					),
				),
			),
			'#title'			=> t( 'Start video at' ),
			'#type'				=> 'textfield',
		);
		$form['theme943_settings']['theme943_regions']['theme943_footer_top_opt']['theme943_footer_top_fullwidth'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_footer_top_fullwidth' ),
			'#description'		=> t( "Check this option to make this region fullwidth (e.g. remove grids)." ),
			'#title'			=> t( 'Fullwidth' ),
			'#type'				=> 'checkbox',
		);

		/**
		 * Blog settings
		 */
		$form['theme943_settings']['theme943_blog'] = array(
			'#title'			=> t( 'Blog Settings' ),
			'#type'				=> 'fieldset',
		);

		$form['theme943_settings']['theme943_blog']['theme943_blog_title'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_blog_title' ),
			'#description'		=> t( 'Text only. Leave empty to set Blog title the same as Blog menu link' ),
			'#size'				=> 60,
			'#title'			=> t( 'Blog title' ),
			'#type'				=> 'textfield',
		);
		
		/**
		 * Custom CSS
		 */
		$form['theme943_settings']['theme943_css'] = array(
			'#title'			=> t( 'Custom CSS' ),
			'#type'				=> 'fieldset',
		);

		$form['theme943_settings']['theme943_css']['theme943_custom_css'] = array(
			'#default_value'	=> theme_get_setting( 'theme943_custom_css' ),
			'#description'		=> t( 'Insert your CSS code here.' ),
			'#title'			=> t( 'Custom CSS' ),
			'#type'				=> 'textarea',
		);
	}
}


/* Custom CSS */
function theme943_form_system_theme_settings_submit( $form, &$form_state ) {
	$fp = fopen( drupal_get_path( 'theme', 'theme943' ) . '/css/custom.css', 'a' );
	ftruncate( $fp, 0 );
	fwrite( $fp, $form_state['values']['theme943_custom_css'] );
	fclose( $fp );
}

/* Reset options */
function theme943_form_system_theme_settings_reset( $form, &$form_state ) {
	form_state_values_clean( $form_state );

	variable_del( 'theme_theme943_settings' );
	
	$fp = fopen( drupal_get_path( 'theme', 'theme943' ) . '/css/custom.css', 'a' );
	ftruncate( $fp, 0 );
	fclose( $fp );

	drupal_set_message( t( 'The configuration options have been reset to their default values.' ) );
}