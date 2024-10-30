<?php
/*
Plugin Name: Childs Play Donation
Plugin URI: http://www.youhavefouryears.com/plugins/donation/childs-play/
Description: Give your blog visitors the ability to make a donation to The Childs Play Charity. You Can Learn More About The Childs Play Charity At <a href="http://www.childsplaycharity.org/" target="_blank">http://www.childsplaycharity.org/</a>. This Plugin Is Based On The <a href="http://www.blogclout.com/blog/goodies/buy-me-a-beer-paypal-donation-plugin/" target="_blank">Buy Me A Beer</a> Plugin. Special Thanks To <a href="http://www.penny-arcade.com" target="_blank">Penny Arcade</a>. 
Author: PleX
Version: 1.0
Author URI: http://www.youhavefouryears.com/author/plex/
-----
- 05.08.08		Created Original Version Of Childs Play Donation Plugin

*/

load_plugin_textdomain('childsplaydonation');

class childsplaydonation {
	function do_widget() {
		if (function_exists('register_sidebar_widget')) {
			register_sidebar_widget('Childs Play Donation', array('childsplaydonation', 'display_widget'));
		}
	}
	
	function display_widget($args) {
		echo childsplaydonation::display($args);
	}
	
	function display($args = null) {
		if(!empty($args)) extract($args);
		$options = (array) get_settings('childsplaydonation-params');
		if ( !isset($args['before_widget']) ) {
			$args['before_widget'] = '';
		}
		if ( !isset($args['after_widget']) ) {
			$args['after_widget'] = '';
		}
		if ( !isset($args['before_title']) ) {
			$args['before_title'] = '<h2><strong>';
		}
		if ( !isset($args['after_title']) ) {
			$args['after_title'] = '</strong></h2>';
		}
		if ( !isset($args['title']) ) {
			if ( isset($options['title']) ) {
				$args['title'] = $options['title'];
			} else {
				$args['title'] = __('Childs Play Donation');
			}
		}
		echo $args['before_widget'] . $args['before_title'] . $args['title'] . $args['after_title'];
		$paypal_link = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&amp;business=childsplaycharity@penny-arcade.com&amp;currency_code=USD&amp;amount=&amp;return=http://www.childsplaycharity.org/?ref=Childs+Play+Donation+Plugin&amp;item_name=Donation+From+The+Childs+Play+Donation+Plugin";
		?>
		<form name="childsplaydonation" action="https://www.paypal.com/cgi-bin/webscr" target="paypal" method="post">
		<input type="hidden" name="cmd" value="_xclick" />
		<input type="hidden" name="business" value="childsplaycharity@penny-arcade.com" />
		<input type="hidden" name="return" value="http://www.childsplaycharity.org/?ref=Childs+Play+Donation+Plugin" />
		<input type="hidden" name="item_name" value="Donation From The Childs Play Donation Plugin" />
		<input type="hidden" name="currency_code" value="USD" />
		<input type="hidden" name="amount" value="" />
		<input type="image" src="<?php echo str_replace(ABSPATH, get_settings('siteurl').'/', dirname(__FILE__)) . "/childs_play.gif";?>" align="left" alt="<?php echo $options['alttext'];?>" title="<?php echo $options['alttext'];?>" />		
		<?php echo "<a href=\"$paypal_link\" target=\"paypal\">".$options['text']."</a>";?>
		</form>
		<div style="clear: both;"></div><br />
		<?php echo $args['after_widget']; ?>
		<?php
	}
	
	function add_childsplaydonation_to_content($content) {
		global $post;
		$show_button = false;
		$childsplaydonationpost = "no";
		
		$childsplaydonationpost = get_post_meta($post->ID, 'childsplaydonation-post', $single = true);
		$options = (array) get_settings('childsplaydonation-params');
		
		if($options['autocontent'] == "1" && $childsplaydonationpost <> "no") $show_button = true;
		if($childsplaydonationpost == "yes") $show_button = true;
		
		if($show_button) {
			if($options['contentname'] == '' || empty($options['contentname'])) $options['contentname'] = "Donate To Childs Play";
		
			$paypal_contentlink = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&amp;business=childsplaycharity@penny-arcade.com&amp;currency_code=USD&amp;amount=&amp;return=http://www.childsplaycharity.org/?ref=Childs+Play+Donation+Plugin&amp;item_name=Donation+From+The+Childs+Play+Donation+Plugin";
			
			$additional_content  = "<form action=\"https://www.paypal.com/cgi-bin/webscr\" target=\"paypal\" method=\"post\">";
			$additional_content .= "<input type=\"hidden\" name=\"cmd\" value=\"_xclick\" />";
			$additional_content .= "<input type=\"hidden\" name=\"business\" value=\"childsplaycharity@penny-arcade.com\" />";
			$additional_content .= "<input type=\"hidden\" name=\"return\" value=\"http://www.childsplaycharity.org/?ref=Childs+Play+Donation+Plugin\" />";
			$additional_content .= "<input type=\"hidden\" name=\"item_name\" value=\"Donation From The Childs Play Donation Plugin\" />";
			$additional_content .= "<input type=\"hidden\" name=\"currency_code\" value=\"USD\" />";
			$additional_content .= "<input type=\"hidden\" name=\"amount\" value=\"\" />";
			$additional_content .= "<input type=\"image\" src=\"".str_replace(ABSPATH, get_settings('siteurl').'/', dirname(__FILE__)) . "/icon_childs_play.gif\" align=\"left\" alt=\"".$options['contentalttext']."\" title=\"".$options['contentalttext']."\" hspace=\"3\" />";
			$additional_content .= "</form>";
			$additional_content .= "<a href=\"$paypal_contentlink\" target=\"paypal\">".$options['contenttext']."</a>";
			$content .= '<p class="childsplaydonation">'.$additional_content.'</p>';
		}
		return $content;
	}
	
	function content_display() {
		global $post;
		$options = (array) get_settings('childsplaydonation-params');
		if($options['contentname'] == '' || empty($options['contentname'])) $options['contentname'] = "Donate To Childs Play";
		
		$paypal_contentlink = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&amp;business=childsplaycharity@penny-arcade.com&amp;currency_code=USD&amp;amount=&amp;return=http://www.childsplaycharity.org/?ref=Childs+Play+Donation+Plugin&amp;item_name=Donation+From+The+Childs+Play+Donation+Plugin";
		$additional_content  = "<form action=\"https://www.paypal.com/cgi-bin/webscr\" target=\"paypal\" method=\"post\">";
		$additional_content .= "<input type=\"hidden\" name=\"cmd\" value=\"_xclick\" />";
		$additional_content .= "<input type=\"hidden\" name=\"business\" value=\"childsplaycharity@penny-arcade.com\" />";
		$additional_content .= "<input type=\"hidden\" name=\"return\" value=\"http://www.childsplaycharity.org/?ref=Childs+Play+Donation+Plugin\" />";
		$additional_content .= "<input type=\"hidden\" name=\"item_name\" value=\"Donation From The Childs Play Donation Plugin\" />";
		$additional_content .= "<input type=\"hidden\" name=\"currency_code\" value=\"USD\" />";
		$additional_content .= "<input type=\"hidden\" name=\"amount\" value=\"\" />";
		$additional_content .= "<input type=\"image\" src=\"".str_replace(ABSPATH, get_settings('siteurl').'/', dirname(__FILE__)) . "/icon_childs_play.gif\" align=\"left\" alt=\"".$options['contentalttext']."\" title=\"".$options['contentalttext']."\" hspace=\"3\" />";
		$additional_content .= "</form>";
		$additional_content .= "<a href=\"$paypal_contentlink\" target=\"paypal\">".$options['contenttext']."</a>";
		$childsplaydonation_content = "<p class=\"childsplaydonation\">".$additional_content."</p>";
		
		echo $childsplaydonation_content;
	}
}

add_action('the_content', array('childsplaydonation','add_childsplaydonation_to_content'));
add_action('plugins_loaded', array('childsplaydonation', 'do_widget'));

function childsplaydonation_sidebar() {
	echo childsplaydonation::display();
}

function childsplaydonation_content() {
	echo childsplaydonation::content_display();
}

if ( strpos($_SERVER['REQUEST_URI'], 'wp-admin') !== false ) {
	include_once dirname(__FILE__) . '/childs-play-donation-admin.php';
}
?>