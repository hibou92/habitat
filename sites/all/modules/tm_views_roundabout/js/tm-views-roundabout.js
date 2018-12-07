Drupal.behaviors.tm_views_roundabout = {
	attach: function(context) {
		if(Drupal.settings.tm_views_roundabout){
			(function ($) {
				$.each(Drupal.settings.tm_views_roundabout, function(id) {
					var config = this;

					// build the view-selector from the view-settings 
					var displaySelector = '.view-id-' + config.viewname + '.view-display-id-' + config.display;
					// prepare JQuery objects for later use
					var $viewContainer = $(displaySelector);
					var $viewContent = $viewContainer.find('.view-content');

					// add prev next controls
					// todo: add settings form
					if (true /* config.controls */) {
						$viewContent.append('<div class="roundabout-controls"><a id="roundabout-prev">' + Drupal.t('prev') + '</a><a id="roundabout-next">' + Drupal.t('next') + '</a></div>');
					}

					$viewContent.once('tm-views-roundabout', function() {
						var roundabout = $(this).roundabout(config['options']);
					});
				});
			})(jQuery);
		}
	}
};
