jQuery('#subscription-options-button').live('click', function(event) {

	jQuery('#subscribe-form-widget-subscription-options').toggle();
	jQuery('#subscription-options-button').hide();
	jQuery('#rss-feeds').css('display', 'block');

});