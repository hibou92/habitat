<?php
/**
 * @file
 * Default view template to display content in a TM Masonry Grid layout.
 */
?>

<?php if ( $options['tm_masonry']['grid_filter'] && isset( $categories ) ) : ?>
	<div class="portfolio-filters">
		<ul id="<?php echo $filter_id;?>" class="tm-masonry-filter clearfix" data-option-key="filter">
			<li>
				<a class="active" href="#" data-filter="*"><span><?php print t( 'Show All' ) ?></span></a>
			</li>
			<?php foreach ( $categories as $key => $category ) : ?>
				<li>
					<a href="#" class="<?php echo $key; ?>" data-filter="<?php echo $key; ?>"><span><?php echo $category; ?></span></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
<div class="tm-masonry" id="<?php echo $view_id; ?>">
	<?php foreach ( $rows as $id => $row ) :
		$size = tm_masonry_size( $view_id, $id ); ?>
		<div class="tm-masonry-item item-w<?php echo $size['width']; ?> item-h<?php echo $size['height']; if ( $classes_array[ $id ] ) { print ' ' . $classes_array[ $id ]; }?>" data-index="<?php echo $id ?>">
			<?php echo $row; ?>
		</div>
	<?php endforeach; ?>
	<div class="shuffle__sizer"></div>
</div>