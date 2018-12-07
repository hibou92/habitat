<?php

/**
 * Preprocess function to build the tm views masonry
 * template_preprocess_views_tm_masonry
 */
function template_preprocess_views_tm_masonry( &$vars ) {
	template_preprocess_views_view_unformatted( $vars );
	
	$view = $vars['view'];
	$options = $view->style_plugin->options;
	$vars['options'] = $options;
	$vars['view_id'] = drupal_html_id( $view->name . '-' . $view->current_display );
	$vars['filter_id'] = null;

	if ( $options['tm_masonry']['grid_filter'] ) {
		$vars['filter_id'] = drupal_html_id( 'tm-masonry-filter' );
		$vocab = $options['tm_masonry']['grid_filter_vocabulary'];
		$categories = array();
		$taxonomies = taxonomy_get_tree( $vocab );
		foreach ( $taxonomies as $tax ) {
			if ( $tax->parents[0] == 0 ) {
				$key = drupal_html_class( $tax->name );
				$categories[$key] = $tax->name;
			}
		}
		$vars['categories'] = $categories;
	}

	$js = array(
		'tm_masonry' => array(
			$vars['view_id'] => array(
				'grid' => null,
				'filter_id' => $vars['filter_id'],
				'grid_cols_lg' => $options['tm_masonry']['grid_cols_lg'],
				'grid_cols_md' => $options['tm_masonry']['grid_cols_md'],
				'grid_cols_sm' => $options['tm_masonry']['grid_cols_sm'],
				'grid_cols_xs' => $options['tm_masonry']['grid_cols_xs'],
				'grid_margin' => (int) $options['tm_masonry']['grid_margin'],
				'grid_ratio' => (float) $options['tm_masonry']['grid_ratio']
			),
		),
	);

	drupal_add_js( $js, 'setting' );
	drupal_add_js( drupal_get_path( 'module', 'tm_masonry' ) . '/js/modernizr.js' );
	drupal_add_js( drupal_get_path( 'module', 'tm_masonry' ) . '/js/debounce.js' );
	drupal_add_js( drupal_get_path( 'module', 'tm_masonry' ) . '/js/jquery.shuffle.js' );
	drupal_add_js( drupal_get_path( 'module', 'tm_masonry' ) . '/js/tm-masonry.js' );

	if ( user_access( 'administer tm masonry' ) ) {
		drupal_add_library( 'system', 'ui.resizable' );
		drupal_add_js( drupal_get_path( 'module', 'tm_masonry' ) . '/js/tm-masonry.admin.js' );
	}

	drupal_add_css( drupal_get_path( 'module', 'tm_masonry' ) . '/css/tm-masonry.css' );
}