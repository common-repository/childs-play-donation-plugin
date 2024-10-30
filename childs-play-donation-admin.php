<?php
class childsplaydonation_admin {
	function do_widget() {
		if ( function_exists('register_sidebar_widget') ) {
			register_widget_control('Childs Play Donation', array('childsplaydonation_admin', 'widget_control'), 350, 650);
		}
	}
	
	
	function widget_control() {
		$options = get_settings('childsplaydonation-params');
		
		//Set The Childs Play Defaults
		$options['title'] = 'Donate To Childs Play';
		$options['text'] = 'Gamers Unite And Help A Sick Kid!';
		$options['alttext'] = 'Donate To Childs Play And Help A Sick Kid';
		$options['contentname'] = 'Dontate To Childs Play';
		$options['contentalttext'] = 'Donate To Childs Play And Help A Sick Kid';
		$options['contenttext'] = 'Gamers Unite And Help A Sick Kid!';		
		
		
		if ( $_POST['childsplaydonation-submit'] ) {
			
			$newoptions['title'] = strip_tags(stripslashes($_POST['childsplaydonation-title']));
			$newoptions['text'] = strip_tags(stripslashes($_POST['childsplaydonation-text']));
			$newoptions['alttext'] = strip_tags(stripslashes($_POST['childsplaydonation-alttext']));
			$newoptions['autocontent'] = $_POST['childsplaydonation-autocontent'];
			$newoptions['contentname'] = strip_tags(stripslashes($_POST['childsplaydonation-contentname']));
			$newoptions['contentalttext'] = strip_tags(stripslashes($_POST['childsplaydonation-contentalttext']));
			$newoptions['contenttext'] = strip_tags(stripslashes($_POST['childsplaydonation-contenttext']));
			
			if ( $options != $newoptions ) {
				$options = $newoptions;
				update_option('childsplaydonation-params', $options);
			}
		}
		
		?>
		<table class="editform" width="100%" cellspacing="2" cellpadding="5">
			<tr>
				<td colspan="2"><strong>Childs Play Donation Sidebar Options</strong></td>
			</tr>
			<tr>
				<th scope="row" valign="top"><label for="childsplaydonation-title"><?php _e('Title:', 'childsplaydonation'); ?></label></th>
				<td><input type="text" id="childsplaydonation-title" name="childsplaydonation-title" value="<?php echo wp_specialchars($options['title'], true); ?>" style="width: 95%" /></td>
			</tr>
			<tr>
				<th scope="row" valign="top"><label for="childsplaydonation-text"><?php _e('Text:', 'childsplaydonation'); ?></label></th>
				<td><textarea id="childsplaydonation-text" name="childsplaydonation-text" style="width: 95%""><?php echo $options['text']; ?></textarea></td>
			</tr>
			<tr>
				<th scope="row" valign="top"><label for="childsplaydonation-alttext"><?php _e('Alt Text:', 'childsplaydonation'); ?></label></th>
				<td><input type="text" id="childsplaydonation-alttext" name="childsplaydonation-alttext" value="<?php echo wp_specialchars($options['alttext'], true); ?>" style="width: 95%" /></td>
			</tr>
			<tr>
				<td colspan="2"><strong>Automatically Add The Childs Play Donation Link To All Posts</strong></td>
			</tr>
			<tr>
				<th scope="row" valign="top"><label for="childsplaydonation-autocontent"><?php _e('Auto Insert:', 'childsplaydonation'); ?></label></th>
				<td><input class="checkbox" type="checkbox" value="1" <?php checked('1',$options['autocontent']) ?> id="childsplaydonation-autocontent" name="childsplaydonation-autocontent" />&nbsp;(Automatically inserts a small icon and text under all the blog posts above comments.)</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><label for="childsplaydonation-contentname"><?php _e('Name:', 'childsplaydonation'); ?></label></th>
				<td><input type="text" id="childsplaydonation-contentname" name="childsplaydonation-contentname" value="<?php echo wp_specialchars($options['contentname'], true); ?>" style="width: 95%" /></td>
			</tr>
			<tr>
				<th scope="row" valign="top"><label for="childsplaydonation-contentalttext"><?php _e('Alt Text:', 'childsplaydonation'); ?></label></th>
				<td><input type="text" id="childsplaydonation-contentalttext" name="childsplaydonation-contentalttext" value="<?php echo wp_specialchars($options['contentalttext'], true); ?>" style="width: 95%" /></td>
			</tr>
			<tr>
				<th scope="row" valign="top"><label for="childsplaydonation-contenttext"><?php _e('Text:', 'childsplaydonation'); ?></label></th>
				<td><textarea id="childsplaydonation-contenttext" name="childsplaydonation-contenttext" style="width: 95%""><?php echo $options['contenttext']; ?></textarea></td>
			</tr>
		</table>
<div>
		<input type="hidden" name="childsplaydonation-submit" id="childsplaydonation-submit" value="1" />
		</div>
		<?php
	}
	
	function add2menu() {
		add_options_page(
			__('Childs&nbsp;Play&nbsp;Donation', 'childsplaydonation'),
			__('Childs&nbsp;Play&nbsp;Donation', 'childsplaydonation'),
			8,
			str_replace("\\", "/", __FILE__),
			array('childsplaydonation_admin', 'display')
		);
	}
	
	function display() {
		if ( !empty($_POST) ) {
			echo '<div class="updated">' . "\n"
				. '<p>'
					. '<strong>'
					. __('Options saved.', 'childsplaydonation')
					. '</strong>'
				. '</p>' . "\n"
				. '</div>' . "\n";
		}

		echo '<div class="wrap">' . "\n"
			. '<h2>' . __('Childs Play Donation Options', 'childsplaydonation') . '</h2>' . "\n"
			. '<form method="post" action="">' . "\n";

		childsplaydonation_admin::widget_control();

		echo "<p class=\"submit\">"
			. "<input type=\"submit\""
				. " value=\"" . __('Update Options', 'childsplaydonation') . "\""
				. " />"
			. "</p>\n";

		echo '</form>'
			. '<strong>Thank You</strong><br />'
			. 'You Are Doing A Great Thing Using This Plugin!<br />'
			. '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&amp;business=plexxonic@hotmail.com&amp;return=http://www.youhavefouryears.com/thank-you-for-the-donation/&amp;item_name=Donation+For+PleX+For+The+Childs+Play+Donation+Plugin" target="_blank">If You Like This Plugin Please Consider A Small Donation.</a> If You Dont Want To Donate To PleX, Please Donate To <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&amp;business=childsplaycharity@penny-arcade.com&amp;return=http://www.childsplaycharity.org/?ref=Childs+Play+Donation+Plugin&amp;item_name=Donation+For+Childs+Play+From+The+Childs+Play+Donation+Plugin" target="paypal">Childs Play</a><br /><br />'
			. 'Plugin bought to you by:<br />'
			. '<a href="http://www.youhavefouryears.com" target="_blank">YouHaveFourYears.com</a>'
			. '</div>';
	}
	
	function childsplaydonation_panel() {
		global $post;
    	$childsplaydonationpost = get_post_meta($post->ID, 'childsplaydonation-post', $single = true);
    	?>
    	<fieldset id="childsplaydonationdiv" class="dbx-box">
    	<h3 class="dbx-handle">Childs Play Donation</h3>
    	<div class="dbx-content">
    	<input type="hidden" name="childsplaydonation-validate" value="<?php echo $post->ID; ?>" />
    	<label for="childsplaydonation-post">Display <em>Childs Play Donation</em>:</label><br />
    	<select name="childsplaydonation-post">
    	<option value=""<?php if($childsplaydonationpost=="") echo " selected";?>>default</option>
    	<option value="yes"<?php if($childsplaydonationpost=="yes") echo " selected";?>>yes</option>
    	<option value="no"<?php if($childsplaydonationpost=="no") echo " selected";?>>no</option>
    	</select>
    	</fieldset>
   	<?php
	}
	
	function childsplaydonation_save($id) {
		$childsplaydonationpost = get_post_meta($id, 'childsplaydonation-post', $single = true);
		
		if(!empty($_POST['childsplaydonation-validate'])) {
			if(!empty($_POST['childsplaydonation-post'])) {
    	    	if(!empty($childsplaydonationpost)) update_post_meta($id, 'childsplaydonation-post', $_POST['childsplaydonation-post']);
    	    	else add_post_meta($id, 'childsplaydonation-post', $_POST['childsplaydonation-post']);
			} else {
				if(!empty($childsplaydonationpost)) delete_post_meta($id, 'childsplaydonation-post');
			}
		}
	}
}

/* insert the sidebar on the edit pages */
add_action('dbx_post_sidebar', array('childsplaydonation_admin','childsplaydonation_panel'));
add_action('dbx_page_sidebar', array('childsplaydonation_admin','childsplaydonation_panel'));

/* incorporate the saving routine */
add_action('publish_post', array('childsplaydonation_admin','childsplaydonation_save'), 5); /* prio must be set */
add_action('edit_post', array('childsplaydonation_admin','childsplaydonation_save'));
add_action('save_post', array('childsplaydonation_admin','childsplaydonation_save'));
add_action('wp_insert_post', array('childsplaydonation_admin','childsplaydonation_save'));

add_action('plugins_loaded', array('childsplaydonation_admin', 'do_widget'));
add_action('admin_menu', array('childsplaydonation_admin', 'add2menu'));
?>