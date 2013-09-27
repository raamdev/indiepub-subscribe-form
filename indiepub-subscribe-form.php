<?php
/* 
Plugin Name: IndiePub Subscribe Form
Plugin URI: http://independentpublisher.me/plugins/indiepub-subscribe-form/
Description: Plugin for displaying subscription options.
Author: Raam Dev
Version: 1.0 
Author URI: http://raamdev.com/
*/

/**
 * Register stylesheet
 */
function indiepub_subscribe_form_stylesheet() {
	wp_register_style( 'indiepub-subscribe-form-css', get_template_directory_uri() . '/indiepub-subscribe-form.css', array(), '1.0' );
	wp_enqueue_style( 'indiepub-subscribe-form-css' );
}

add_action( 'wp_enqueue_scripts', 'indiepub_subscribe_form_stylesheet' );

/**
 * MailChimp Subscribe Form
 */
function indiepub_subscribe_form_mailchimp()
{

	$post_categories = wp_get_post_categories(get_the_ID());
	$cats            = array();

	foreach($post_categories as $c)
	{
		$cat    = get_category($c);
		$cats[] = array('name' => $cat->name, 'slug' => $cat->slug);
	}
	$cats[0]['name'] != "Personal Reflections" ? $extra_subscribe_text = " essays" : $extra_subscribe_text = "";

	?>
	<div id="indiepub-subscribe-form">
		<section>
			<p class="subscribe-message"><strong>Subscribe</strong> to receive new <em><?php echo $cats[0]['name']; ?></em><?php echo $extra_subscribe_text; ?></p>
			<form action="http://raamdev.us1.list-manage.com/subscribe/post?u=5daf0f6609de2506882857a28&id=dc1b1538af" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
				<?php if(is_single() && !in_category('journal')) : ?>
					<?php $reflections = "";
					$technology        = "";
					$writing           = ""; ?>
					<?php if(in_category('20'))
					{
						$reflections = "checked";
					} ?>
					<?php if(in_category('5'))
					{
						$technology = "checked";
					} ?>
					<?php if(in_category('859'))
					{
						$writing = "checked";
					} ?>
				<?php else : ?>
					<?php $reflections = "checked";
					$technology        = "checked";
					$writing           = "checked"; ?>
				<?php endif; ?>
				<div style="display:none;"><input type="hidden" name="MERGE3" value="<?php echo 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>" id="MERGE3"></div>
				<input type="text" placeholder="First Name..." id="mce-FNAME" name="FNAME" tabindex="503">
				<input type="text" placeholder="Email Address..." id="mce-EMAIL" name="EMAIL" tabindex="504">
				<input type="submit" value="Subscribe »" tabindex="505">
				<div class="mc-field-group" id="subscribe-form-widget-subscription-options" style="display: none;">
					<label for="mce-group[1129]">When new essays are published, email me: </label>
					<select name="group[1129]" class="REQ_CSS" id="mce-group[1129]" tabindex="507">
						<option value="1" selected="selected">immediately</option>
						<option value="2">a weekly digest</option>
						<option value="4">a monthly digest</option>
					</select>
					<br />
					<label for="mce-group[1873]">When new thoughts are published, email me: </label>
					<select name="group[1873]" class="REQ_CSS" id="mce-group[1873]" tabindex="508">
						<option value="8">immediately</option>
						<option value="16">a weekly digest</option>
						<option value="32" selected="selected">a monthly digest</option>
					</select>
					<div class="subscribe-home-essay-topics">
						<p>Send me thoughts and essays on the following topics:</p>
						<div class="groups">
							<p><input tabindex="509" type="checkbox" id="group_64" name="group[1989][64]" value="1" <?php echo $reflections; ?>>&nbsp;<label for="group_64" style="font-style: italic;">Personal Reflections</label></p>
							<p><input tabindex="510" type="checkbox" id="group_128" name="group[1989][128]" value="1" <?php echo $technology; ?>>&nbsp;<label for="group_128" style="font-style: italic;">Technology</label></p>
							<p><input tabindex="511" type="checkbox" id="group_256" name="group[1989][256]" value="1" <?php echo $writing; ?>>&nbsp;<label for="group_256" style="font-style: italic;">Writing & Publishing</label></p>
						</div>
					</div>
				</div>
			</form>
			<div class="never-sell-your-email">
				<p>I promise to never sell or give away your email address. You can unsubscribe at any time.</p>
			</div>
			<div class="subscription-options-button"><span id="subscription-options-button" tabindex="506" onClick="_gaq.push(['_trackEvent', 'Sharing Buttons Text', 'Subscribe Options', 'View Subscription Options']);">Subscription Options</span></div>
			<div class="rss-feeds" id="rss-feeds">
				RSS Feeds:&nbsp;
				<a href="http://feeds.feedburner.com/RaamDevAllTopics">All Topics</a> ·
				<a href="http://feeds.feedburner.com/RaamDevsWeblog">Personal Reflections</a> ·
				<a href="http://feeds.feedburner.com/RaamDevWriting">Writing & Publishing</a> ·
				<a href="http://feeds.feedburner.com/RaamDevTechnology">Technology</a>
			</div>
		</section>
	</div>

<?php
}