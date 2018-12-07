<?php

/**
 * @file
 * Defines the style plugin for the TM Masonry
 */
class tm_masonry_plugin_style_masonry extends views_plugin_style {
	/**
	 * Set default options.
	 */
	function option_definition() {
		$options = parent::option_definition();

		$options['tm_masonry']['grid_filter'] = array( 'default' => 0 );
		$options['tm_masonry']['grid_filter_vocabulary'] = array( 'default' => 0 );
		$options['tm_masonry']['grid_cols_lg'] = array( 'default' => 4 );
		$options['tm_masonry']['grid_cols_md'] = array( 'default' => 5 );
		$options['tm_masonry']['grid_cols_sm'] = array( 'default' => 4 );
		$options['tm_masonry']['grid_cols_xs'] = array( 'default' => 1 );
		$options['tm_masonry']['grid_margin'] = array( 'default' => 12 );
		$options['tm_masonry']['grid_ratio'] = array( 'default' => 1,5 );

		return $options;
	}

	/**
	 * Render the given style.
	 */

	function options_form( &$form, &$form_state ) {
		parent::options_form( $form, $form_state );

		$opts = array( '- Select -' );
		$opts_tmp = array();
		foreach ( taxonomy_vocabulary_get_names() as $vocab ) {
			$opts_tmp[ $vocab->vid ] = $vocab->name;
		}
		$opts += $opts_tmp;
		$grids = array(
			1 => '1',
			2 => '2',
			3 => '3',
			4 => '4',
			5 => '5',
			6 => '6',
			7 => '7',
			8 => '8',
			9 => '9',
			10 => '10',
			11 => '11',
			12 => '12'
		);
		
		// Add TM Masonry Grid options to views form
		$form['tm_masonry'] = array(
			'#type' => 'fieldset',
			'#title' => t('TM Masonry Grid'),
		);

		$form['tm_masonry']['grid_filter'] = array(
			'#type' => 'checkbox',
			'#title' => t( 'Use Filter' ),
			'#default_value' => $this->options['tm_masonry']['grid_filter']
		);
		
		$form['tm_masonry']['grid_filter_vocabulary'] = array(
			'#type' => 'select',
			'#title' => t( 'Filter Vocabulary' ),
			'#options' => $opts,
			'#description' => t( 'Which taxonomy vocabulary do you want to use for the filter' ),
			'#default_value' => $this->options['tm_masonry']['grid_filter_vocabulary'],
			'#states'			=> array(
				'invisible'		=> array(
					'input[id="edit-style-options-tm-masonry-grid-filter"]' => array(
						'checked'	=> FALSE
					),
				),
			),
		);
		$form['tm_masonry']['grid_cols_lg'] = array(
			'#type' => 'select',
			'#title' => t( 'Large Desktop Columns' ),
			'#options' => $grids,
			'#default_value' => $this->options['tm_masonry']['grid_cols_lg']
		);
		$form['tm_masonry']['grid_cols_md'] = array(
			'#type' => 'select',
			'#title' => t( 'Desktop Columns' ),
			'#options' => $grids,
			'#default_value' => $this->options['tm_masonry']['grid_cols_md']
		);
		$form['tm_masonry']['grid_cols_sm'] = array( 
			'#type' => 'select',
			'#title' => t( 'Tablet Columns' ),
			'#options' => $grids,
			'#default_value' => $this->options['tm_masonry']['grid_cols_sm']
		);
		$form['tm_masonry']['grid_cols_xs'] = array(
			'#type' => 'select',
			'#title' => t( 'Phone Columns' ),
			'#options' => $grids,
			'#default_value' => $this->options['tm_masonry']['grid_cols_xs']
		);
		$form['tm_masonry']['grid_margin'] = array(
			'#type' => 'textfield',
			'#title' => t( 'Grid item margin' ),
			'#default_value' => $this->options['tm_masonry']['grid_margin']
		);
		$form['tm_masonry']['grid_ratio'] = array(
			'#type' => 'textfield',
			'#title' => t( 'Aspect ratio' ),
			'#description' => t( 'The ratio of width to height' ),
			'#default_value' => $this->options['tm_masonry']['grid_ratio']
		);
	}
}