<?php

/**
 * @file
 * Provide an accordion style plugin for Views. This file is autoloaded by views.
 */

/**
 * Implementation of views_plugin_style().
 */
class tm_views_roundabout_style_plugin extends views_plugin_style {

	/**
	 * Set default options
	 */
	function option_definition() {
		$options = parent::option_definition();
		$options['bearing'] = array( 'default' => 0.0 );
		$options['tilt'] = array( 'default' => 0.0 );
		$options['minZ'] = array( 'default' => 10 );
		$options['maxZ'] = array( 'default' => 28 );
		$options['minOpacity'] = array( 'default' => 0.4 );
		$options['maxOpacity'] = array( 'default' => 1.0 );
		$options['minScale'] = array( 'default' => 0.4 );
		$options['maxScale'] = array( 'default' => 1.0 );
		$options['duration'] = array( 'default' => 600 );
		$options['btnNext'] = array( 'default' => '#roundabout-next' );
		$options['btnNextCallback'] = array( 'default' => NULL );
		$options['btnPrev'] = array( 'default' => '#roundabout-prev' );
		$options['btnPrevCallback'] = array( 'default' => NULL );
		$options['btnToggleAutoplay'] = array( 'default' => NULL );
		$options['btnStartAutoplay'] = array( 'default' => NULL );
		$options['btnStopAutoplay'] = array( 'default' => NULL );
		$options['easing'] = array( 'default' => 'swing' );
		$options['clickToFocus'] = array( 'default' => true );
		$options['clickToFocusCallback'] = array( 'default' => NULL );
		$options['focusBearing'] = array( 'default' => 0.0 );
		$options['shape'] = array( 'default' => 'figure8' );
		$options['debug'] = array( 'default' => 'false' );
		$options['childSelector'] = array( 'default' => 'div.views-row' );
		$options['startingChild'] = array( 'default' => 0 );
		$options['reflect'] = array( 'default' => FALSE );
		$options['floatComparisonThreshold'] = array( 'default' => 0.001 );
		$options['autoplay'] = array( 'default' => FALSE );
		$options['autoplayInitialDelay'] = array( 'default' => 0 );
		$options['autoplayDuration'] = array( 'default' => 1000 );
		$options['autoplayPauseOnHover'] = array( 'default' => FALSE );
		$options['enableDrag'] = array( 'default' => FALSE );
		$options['dropEasing'] = array( 'default' => 'swing' );
		$options['responsive'] = array( 'default' => TRUE );
		$options['css'] = array( 'default' => '1' );

		return $options;
	}

	function options_form( &$form, &$form_state ) {
		parent::options_form( $form, $form_state );

		$easingOptions = array(
			'none' => t( 'None' ),
			'slide' => t( 'Slide' ),
			'swing' => t( 'Swing' ),
			'linear' => t( 'Linear' ),
			'bounceslide' => t( 'Bounceslide' ),
			'easeInQuart' => t( 'easeInQuart' ),
			'easeOutQuart' => t( 'easeOutQuart' ),
			'easeInOutQuart' => t( 'easeInOutQuart' ),
			'easeInExpo' => t( 'easeInExpo' ),
			'easeOutExpo' => t( 'easeOutExpo' ),
			'easeInOutExpo' => t( 'easeInOutExpo' ),
			'easeInBack' => t( 'easeInBack' ),
			'easeOutBack' => t( 'easeOutBack' ),
			'easeInOutBack' => t( 'easeInOutBack' ),
			'easeInQuad' => t( 'easeInQuad' ),
			'easeOutQuad' => t( 'easeOutQuad' ),
			'easeInOutQuad' => t( 'easeInOutQuad' ),
			'easeInQuint' => t( 'easeInQuint' ),
			'easeOutQuint' => t( 'easeOutQuint' ),
			'easeInOutQuint' => t( 'easeInOutQuint' ),
			'easeInCirc' => t( 'easeInCirc' ),
			'easeOutCirc' => t( 'easeOutCirc' ),
			'easeInOutCirc' => t( 'easeInOutCirc' ),
			'easeInBounce' => t( 'easeInBounce' ),
			'easeOutBounce' => t( 'easeOutBounce' ),
			'easeInOutBounce' => t( 'easeInOutBounce' ),
			'easeInCubic' => t( 'easeInCubic' ),
			'easeOutCubic' => t( 'easeOutCubic' ),
			'easeInOutCubic' => t( 'easeInOutCubic' ),
			'easeInSine' => t( 'easeInSine' ),
			'easeOutSine' => t( 'easeOutSine' ),
			'easeInOutSine' => t( 'easeInOutSine' ),
			'easeInElastic' => t( 'easeInElastic' ),
			'easeOutElastic' => t( 'easeOutElastic' ),
			'easeInOutElastic' => t( 'easeInOutElastic' ),
		);
		
		$shapeOptions = array(
			'lazySusan' => t( 'lazySusan' ),
			'theJuggler' => t( 'theJuggler' ),
			'figure8' => t( 'figure8' ),
			'waterWheel' => t( 'waterWheel' ),
			'square' => t( 'square' ),
			'conveyorBeltLeft' => t( 'conveyorBeltLeft' ),
			'conveyorBeltRight' => t( 'conveyorBeltRight' ),
			'goodbyeCruelWorld' => t( 'goodbyeCruelWorld' ),
			'diagonalRingLeft' => t( 'diagonalRingLeft' ),
			'diagonalRingRight' => t( 'diagonalRingRight' ),
			'rollerCoaster' => t( 'rollerCoaster' ),
			'tearDrop' => t( 'tearDrop' ),
			'tickingClock' => t( 'tickingClock' ),
			'flurry' => t( 'flurry' ),
			'nowSlide' => t( 'nowSlide' ),
			'risingEssence' => t( 'risingEssence' ),
		);

		$form['minZ'] = array(
			'#type' => 'textfield',
			'#title' => t( 'The lowest z-index' ),
			'#default_value' => $this->options['minZ'],
			'#description' => t( 'The lowest z-index that will be assigned to a moving element. This occurs when the moving element is opposite of (that is, 180° away from) the focusBearing.' ),
		);
		$form['maxZ'] = array(
			'#type' => 'textfield',
			'#title' => t( 'The greatest z-index' ),
			'#default_value' => $this->options['maxZ'],
			'#description' => t( 'The greatest z-index that will be assigned to a moving element. This occurs when the moving element is at the same bearing as the focusBearing.' ),
		);
		$form['minOpacity'] = array(
			'#type' => 'textfield',
			'#title' => t( 'The lowest opacity' ),
			'#default_value' => floatval( $this->options['minOpacity'] ),
			'#description' => t( 'The lowest opacity that will be assigned to a moving element. This occurs when the moving element is opposite of (that is, 180° away from) the focusBearing.' ),
		);
		$form['maxOpacity'] = array(
			'#type' => 'textfield',
			'#title' => t( 'The greatest opacity' ),
			'#default_value' => floatval( $this->options['maxOpacity'] ),
			'#description' => t( 'The greatest opacity that will be assigned to a moving element. This occurs when the moving element is at the same bearing as the focusBearing.' ),
		);
		$form['minScale'] = array(
			'#type' => 'textfield',
			'#title' => t( 'The lowest size' ),
			'#default_value' => floatval( $this->options['minScale'] ),
			'#description' => t( 'The lowest size (relative to its starting size) that will be assigned to a moving element. This occurs when the moving element is opposite of (that is, 180° away from) the focusBearing.' ),
		);
		$form['maxScale'] = array(
			'#type' => 'textfield',
			'#title' => t( 'The greatest size' ),
			'#default_value' => floatval( $this->options['maxScale'] ),
			'#description' => t( 'The greatest size (relative to its starting size) that will be assigned to a moving element. This occurs when the moving element is at the same bearing as the focusBearing.' ),
		);
		$form['duration'] = array(
			'#type' => 'textfield',
			'#title' => t( 'Duration' ),
			'#default_value' => $this->options['duration'],
			'#description' => t( 'The length of time Roundabout will take to move '
							. 'from one child element being in focus to another (when an '
							. 'animation is triggered). This value acts as the default '
							. 'for Roundabout, but each animation action can be given a '
							. 'custom duration for that animation.' ),
		);
		$form['btnNext'] = array(
			'#type' => 'textfield',
			'#title' => t( 'Next Button' ),
			'#default_value' => $this->options['btnNext'],
			'#description' => t( 'A jQuery selector of page elements that, when '
							. 'clicked, will trigger the Roundabout to animate to the next'
							. ' moving element.' ),
		);
		$form['btnPrev'] = array(
			'#type' => 'textfield',
			'#title' => t( 'Prev Button' ),
			'#default_value' => $this->options['btnPrev'],
			'#description' => t( 'A jQuery selector of page elements that, when '
							. 'clicked, will trigger the Roundabout to animate to the '
							. 'previous moving element.' ),
		);
		$form['easing'] = array(
			'#type' => 'select',
			'#title' => t( 'Animation style' ),
			'#default_value' => $this->options['easing'],
			'#description' => t( "Select the animation to use for transitions." ),
			'#options' => $easingOptions,
		);
		$form['shape'] = array(
			'#type' => 'select',
			'#title' => t( 'Shape style' ),
			'#default_value' => $this->options['shape'],
			'#description' => t( "The path that moving elements follow." ),
			'#options' => $shapeOptions,
		);
		$form['childSelector'] = array(
			'#type' => 'textfield',
			'#title' => t( 'Child Selector' ),
			'#default_value' => $this->options['childSelector'],
			'#description' => t( 'A jQuery selector of child elements within the '
							. 'elements Roundabout is called upon that will become the '
							. 'moving elements within Roundabout. By default, Roundabout '
							. 'works on unordered lists, but it can be changed to work '
							. 'with any nested set of child elements.' ),
		);
		$form['reflect'] = array(
			'#type' => 'checkbox',
			'#title' => t( 'Reflect' ),
			'#default_value' => $this->options['reflect'],
			'#description' => t( 'When true, reverses the direction in which '
							. 'Roundabout will operate. By default, next animations will '
							. 'rotate moving elements in a clockwise direction and '
							. 'previous animations will be counterclockwise. Using reflect'
							. ' will flip the two.' ),
		);
		$form['autoplay'] = array(
			'#type' => 'checkbox',
			'#title' => t( 'Autoplay' ),
			'#default_value' => $this->options['autoplay'],
			'#description' => t( 'When true, Roundabout will automatically advance '
							. 'the moving elements to the next child at a regular interval '
							. '(settable as autoplayDuration).' ),
		);
		$form['autoplayInitialDelay'] = array(
			'#type' => 'textfield',
			'#title' => t( 'Autoplay Initial Delay' ),
			'#default_value' => $this->options['autoplayInitialDelay'],
			'#description' => t( 'The length of time (in milliseconds) to delay the' 
							. ' start of Roundabout’s configured autoplay option. This only'
							. ' works with setting autoplay to true, and only on the first '
							. 'start of autoplay. ' ),
			'#states'			=> array(
				'invisible'		=> array(
					'input[id="edit-style-options-autoplay"]' => array(
						'checked'	=> FALSE
					),
				),
			),
		);
		$form['autoplayDuration'] = array(
			'#type' => 'textfield',
			'#title' => t( 'Autoplay Duration' ),
			'#default_value' => $this->options['autoplayDuration'],
			'#description' => t( 'The length of time (in milliseconds) between animation triggers when a Roundabout’s autoplay is playing.' ),
			'#states'			=> array(
				'invisible'		=> array(
					'input[id="edit-style-options-autoplay"]' => array(
						'checked'	=> FALSE
					),
				),
			),
		);
		$form['autoplayPauseOnHover'] = array(
			'#type' => 'checkbox',
			'#title' => t( 'Autoplay Pause On Hover' ),
			'#default_value' => $this->options['autoplayPauseOnHover'],
			'#description' => t( 'When true, Roundabout will pause autoplay when the user moves the cursor over the Roundabout container.' ),
			'#states'			=> array(
				'invisible'		=> array(
					'input[id="edit-style-options-autoplay"]' => array(
						'checked'	=> FALSE
					),
				),
			),
		);
		$form['enableDrag'] = array(
			'#type' => 'checkbox',
			'#title' => t( 'Enable Drag' ),
			'#default_value' => $this->options['enableDrag'],
			'#description' => t( 'When true, Roundabout will allow user to rotate '
							. 'moving elements by dragging Roundabout area itself. '
							. 'Requires event.drag and event.drop plugins (by '
							. '<a href="http://threedubmedia.com">ThreeDubMedia</a>) and '
							. '<a href="http://drupal.org/project/jquery_update">jQuery '
							. 'Update</a> module. You need to place drag and drop plugins '
							. 'into your libraries folder.' ),
		);
		$form['dropEasing'] = array(
			'#type' => 'select',
			'#title' => t( 'Animation style on Drop' ),
			'#default_value' => $this->options['dropEasing'],
			'#description' => t( 'Select the animation to use for transitions after'
							. ' Roundabout has been "dropped".' ),
			'#options' => $easingOptions,
		);
		$form['responsive'] = array(
			'#type' => 'checkbox',
			'#title' => t( 'Responsive' ),
			'#default_value' => $this->options['responsive'],
			'#description' => t( "When true, attaches a resize event onto the window and will automatically relayout Roundabout's child elements as the holder element changes size. " ),
		);
		$form['css'] = array(
			'#type' => 'checkbox',
			'#title' => t( 'Use default css' ),
			'#default_value' => $this->options['css'],
			'#description' => t( "By default Views Roundabout defines a few styles to"
							. " make your view results look like a grid. You can disable "
							. "this behaviour here." ),
		);
		// TODO: implement remaining options for roundabout
	}

	/**
	 * Render the display in this style.
	 */
	function render() {
		$output = parent::render();

		// add js
		$path = drupal_get_path( 'module', 'tm_views_roundabout' );
		drupal_add_js( $path . '/js/jquery.roundabout.js' );
		if ( $this->options['enableDrag'] == true ) {
			drupal_add_js( $path . '/js/jquery.event.drag.js' );
			drupal_add_js( $path . '/js/jquery.event.drop.js' );
		}
		drupal_add_js( $path . '/js/jquery.roundabout-shapes.js' );
		drupal_add_js( $path . '/js/tm-views-roundabout.js' );

		// add css
		if ( $this->options['css'] == true ) {
			drupal_add_css( $path . '/css/tm-views-roundabout.css' );
		}

		// TODO: Preparing the js variables and adding the js to our display
		$view_settings['options']['minZ'] = $this->options['minZ'];
		$view_settings['options']['maxZ'] = $this->options['maxZ'];
		$view_settings['options']['minOpacity'] = floatval( $this->options['minOpacity'] );
		$view_settings['options']['maxOpacity'] = floatval( $this->options['maxOpacity'] ); 
		$view_settings['options']['minScale'] = floatval( $this->options['minScale'] );
		$view_settings['options']['maxScale'] = floatval( $this->options['maxScale'] );
		$view_settings['options']['duration'] = $this->options['duration'];
		$view_settings['options']['btnNext'] = $this->options['btnNext'];
		$view_settings['options']['btnPrev'] = $this->options['btnPrev'];
		$view_settings['options']['easing'] = $this->options['easing'];
		$view_settings['options']['shape'] = $this->options['shape'];
		$view_settings['options']['childSelector'] = $this->options['childSelector'];
		$view_settings['options']['reflect'] = $this->options['reflect'];
		$view_settings['options']['autoplay'] = $this->options['autoplay'];
		$view_settings['options']['autoplayInitialDelay'] = $this->options['autoplayInitialDelay'];
		$view_settings['options']['autoplayDuration'] = $this->options['autoplayDuration'];
		$view_settings['options']['autoplayPauseOnHover'] = $this->options['autoplayPauseOnHover'];
		$view_settings['options']['enableDrag'] = $this->options['enableDrag'];
		$view_settings['options']['dropEasing'] = $this->options['dropEasing'];
		$view_settings['options']['responsive'] = $this->options['responsive'];

		$view_settings['display'] = $this->view->current_display;
		$view_settings['viewname'] = $this->view->name;
		if ( isset( $this->view->dom_id ) ) {
			$view_settings['dom_id'] = $this->view->dom_id;
		}

		$view_settings['row_plugin'] = get_class( $this->row_plugin );

		$roundabout_id = 'views-roundabout-' . $this->view->name . '-' . $this->view->current_display;

		drupal_add_js( array( 'tm_views_roundabout' => array( $roundabout_id => $view_settings ) ), 'setting' );

		return $output;
	}
}