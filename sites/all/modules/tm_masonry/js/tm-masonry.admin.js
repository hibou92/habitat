jQuery(document).ready(function(jQuery) {
	jQuery('.tm-masonry').each(function() {
		var $grid = jQuery(this),
			options = Drupal.settings.tm_masonry[$grid.attr('id')];

		$grid.find('.tm-masonry-item').resizable({
			grid: [options.columnWidth + options.grid_margin, options.columnWidth * options.grid_ratio + options.grid_margin],
			autoHide: true,
			start: function() {
				$grid.data('resize', false);
			},
			resize: function() {
				$grid.shuffle('update');
			},
			stop: function(event, ui) {
				$grid.data('resize', true);
				var w = Math.floor(ui.size.width / options.columnWidth),
					h = Math.floor(ui.size.height / options.columnWidth * 2),
					item = jQuery(ui.element).data('index'),
					url = Drupal.settings.basePath + '?q=tm/tm_masonry/save/' + $grid.attr('id') + '/' + item + '/' + w + '/' + h;
				jQuery.ajax({
					url: url,
					success: function() {}
				});
			}
		});
	});
});