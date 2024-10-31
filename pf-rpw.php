<?php
/*
Plugin Name: RPW - Related Posts Widget
Plugin URI: http://www.rpw.phpfirst.in
Description: Add related posts on your screen corners for impressions and conversion improvement.
Author: PHPFirst
Author URI: http://www.phpfirst.in
Version:1.0.2
*/

add_action( 'admin_init', 'pf_rpw_admin_init' );
add_action('admin_menu', 'pf_rpw_admin_actions');
add_action( "wp_footer", "pf_rpw_custom_content_after_post" );
add_action('add_meta_boxes', 'pf_rpw_meta_box');
add_action('save_post', 'pf_rpw_save_postdata');

/*
 * Register Style and jQuery for Admin
 */
function pf_rpw_admin_init() {
	# Register our stylesheet
	wp_register_style( 'pfRPWStyleMultiSelect', plugins_url('\vendor\multi-select\css\multi-select.css', __FILE__));
	wp_register_style( 'pfRPWStyleAdmin', plugins_url('\css\wppf-rpw-style-admin.css', __FILE__));
	
	# Register our jQuery
	wp_enqueue_script('pfRPWScriptMultiSelect',  plugins_url('\vendor\multi-select\js\jquery.multi-select.js', __FILE__),array('jquery'));
	wp_enqueue_script('pfRPWScriptQuickSearchSelect',  plugins_url('\vendor\quicksearch\jquery.quicksearch.js', __FILE__),array('jquery'));
	
	
	
}

/*
 * Setting Page Options and Menu Register
 */
function pf_rpw_admin_actions() {
	define('pfRPWSettingLabel',"Related Posts Widget - Settings");
	define('pfRPWSettingName',"RPW Settings");
	# Added admin page menu "RPW Settings"
    add_options_page(pfRPWSettingName, pfRPWSettingName, 1, "rpw_settings", "pf_rpw_settings_page");    
}

/*
 * Setting Page Display and Actions(Save and Update)
*/
function pf_rpw_settings_page(){
	# init color picker
	wp_enqueue_style('pfRPWStyleAdmin');
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'pfRPWScriptColorSelect', plugins_url('\js\color-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	
	wp_enqueue_media();
	wp_enqueue_script('media-upload');
	
	
	# create a nonce
	$nonce = wp_create_nonce( 'pf_rpw_setting_nonce' );
	$setting_update = 0;
	
	if($_POST)
	{
		$nonce_validate = $_REQUEST['_wpnonce'];
		# Nonce verification:
		if (wp_verify_nonce( $nonce_validate, 'pf_rpw_setting_nonce' ) ) {
			# Get the posted data
			if($_POST['submit'] == 'Save Changes')
			{
				$pf_rfw_setting['pf_rpw_default_dispaly'] = esc_attr($_POST["pf_rpw_default_dispaly"]);
				$pf_rfw_setting['pf_rpw_widget_displayed_top'] = esc_attr($_POST["pf_rpw_widget_displayed_top"]);
				$pf_rfw_setting['pf_rpw_widget_displayed_bottom'] = esc_attr($_POST["pf_rpw_widget_displayed_bottom"]);
				$pf_rfw_setting['pf_rpw_widget_displayed_left'] = esc_attr($_POST["pf_rpw_widget_displayed_left"]);
				$pf_rfw_setting['pf_rpw_widget_displayed_right'] = esc_attr($_POST["pf_rpw_widget_displayed_right"]);

				$pf_rfw_setting['pf_rpw_widget_colors_bg_box'] = esc_attr($_POST["pf_rpw_widget_colors_bg_box"]);
				$pf_rfw_setting['pf_rpw_widget_colors_bd_box'] = esc_attr($_POST["pf_rpw_widget_colors_bd_box"]);
				$pf_rfw_setting['pf_rpw_widget_colors_link_cl_box'] = esc_attr($_POST["pf_rpw_widget_colors_link_cl_box"]);
				$pf_rfw_setting['pf_rpw_widget_colors_main_arrow'] = esc_attr($_POST["pf_rpw_widget_colors_main_arrow"]);
				$pf_rfw_setting['pf_rpw_widget_link_text_fonts'] = esc_attr($_POST["pf_rpw_widget_link_text_fonts"]);
				$pf_rfw_setting['pf_rpw_widget_arrow_fonts'] = esc_attr($_POST["pf_rpw_widget_arrow_fonts"]);				
				
				$pf_rfw_setting['pf_rpw_widget_no_images_id'] = esc_attr($_POST["pf_rpw_widget_no_images_id"]);
				
				$pf_rfw_setting_ser = serialize($pf_rfw_setting);
				# update the posted data
				update_option("pf_rpw_settings", $pf_rfw_setting_ser);
				$setting_update = 1;
			}
		}
		else 
		{
			# WP nonce not verify.
			echo 'Sorry wordpress nonce not success';
			die();
		}
	}
	# Return updated or saved setting.
	$pf_rpw_settings = unserialize(get_option("pf_rpw_settings"));
	$pf_rpw_default_dispaly = $pf_rpw_settings['pf_rpw_default_dispaly'] != '' ? $pf_rpw_settings['pf_rpw_default_dispaly'] : '';
	$pf_rpw_widget_displayed_top = $pf_rpw_settings['pf_rpw_widget_displayed_top'] != '' ? $pf_rpw_settings['pf_rpw_widget_displayed_top'] : '';
	$pf_rpw_widget_displayed_bottom = $pf_rpw_settings['pf_rpw_widget_displayed_bottom'] != '' ? $pf_rpw_settings['pf_rpw_widget_displayed_bottom'] : '';
	$pf_rpw_widget_displayed_left = $pf_rpw_settings['pf_rpw_widget_displayed_left'] != '' ? $pf_rpw_settings['pf_rpw_widget_displayed_left'] : '';
	$pf_rpw_widget_displayed_right = $pf_rpw_settings['pf_rpw_widget_displayed_right'] != '' ? $pf_rpw_settings['pf_rpw_widget_displayed_right'] : '';
	
	$pf_rpw_widget_colors_bg_box = $pf_rpw_settings['pf_rpw_widget_colors_bg_box'] != '' ? $pf_rpw_settings['pf_rpw_widget_colors_bg_box'] : '';
	$pf_rpw_widget_colors_bd_box = $pf_rpw_settings['pf_rpw_widget_colors_bd_box'] != '' ? $pf_rpw_settings['pf_rpw_widget_colors_bd_box'] : '';
	$pf_rpw_widget_colors_link_cl_box = $pf_rpw_settings['pf_rpw_widget_colors_link_cl_box'] != '' ? $pf_rpw_settings['pf_rpw_widget_colors_link_cl_box'] : '';
	$pf_rpw_widget_colors_main_arrow = $pf_rpw_settings['pf_rpw_widget_colors_main_arrow'] != '' ? $pf_rpw_settings['pf_rpw_widget_colors_main_arrow'] : '';
	$pf_rpw_widget_link_text_fonts = $pf_rpw_settings['pf_rpw_widget_link_text_fonts'] != '' ? $pf_rpw_settings['pf_rpw_widget_link_text_fonts'] : '';
	$pf_rpw_widget_arrow_fonts = $pf_rpw_settings['pf_rpw_widget_arrow_fonts'] != '' ? $pf_rpw_settings['pf_rpw_widget_arrow_fonts'] : '';	
	
	$pf_rpw_widget_no_images_id = $pf_rpw_settings['pf_rpw_widget_no_images_id'] != '' ? $pf_rpw_settings['pf_rpw_widget_no_images_id'] : '';	
	
	include_once 'pf-rpw-settings.php';
}

/*
 * FrontSide Widget Box Display
 */
function pf_rpw_custom_content_after_post($content){
	if(is_single()){
		wp_register_style( 'pfRPWStyleDefault', plugins_url('css\wppf-rpw-style.css', __FILE__) );
		wp_register_style( 'pfRPWStyleBootstrap', plugins_url('css\custom.bootstrap.min.css', __FILE__) );
		wp_register_style( 'pfRPWStyleFontAwasome', plugins_url('vendor\font-awesome\css\font-awesome.min.css', __FILE__) );
		wp_enqueue_style( 'pfRPWStyleDefault' );
		wp_enqueue_style( 'pfRPWStyleBootstrap' );
		wp_enqueue_style( 'pfRPWStyleFontAwasome' );
		
		wp_enqueue_script('pfRPWScriptColorSelect',  plugins_url('\js\color-script.js', __FILE__),array('jquery'));
		
		global $post;
		$pf_rpw_posts = get_post_meta($post->ID, 'pf_rpw_posts', true);
		$pf_rpw_posts_arr = unserialize($pf_rpw_posts);
		$pf_rpw_posts_json = json_encode($pf_rpw_posts_arr);
		if(!empty($pf_rpw_posts_arr) && is_array($pf_rpw_posts_arr)){$selectedTotalNos = count(array_filter($pf_rpw_posts_arr));}else{$selectedTotalNos = 0;}
		if($selectedTotalNos == 3){$disabled = 'disabled';}else{$disabled = '';}
		
		$pf_rpw_settings = unserialize(get_option("pf_rpw_settings"));
		$pf_rpw_default_dispaly = $pf_rpw_settings['pf_rpw_default_dispaly'] != '' ? $pf_rpw_settings['pf_rpw_default_dispaly'] : '2';
		$pf_rpw_widget_no_images_id = $pf_rpw_settings['pf_rpw_widget_no_images_id'] != '' ? $pf_rpw_settings['pf_rpw_widget_no_images_id'] : '';
		if($pf_rpw_default_dispaly == 1)
		{
			$pf_rpw_style = 'small';
		}
		elseif($pf_rpw_default_dispaly == 2)
		{
			$pf_rpw_style = 'medium';
		}
		elseif ($pf_rpw_default_dispaly == 3)
		{
			$pf_rpw_style = 'large';
		}
		else 
		{
			$pf_rpw_style = 'medium';
		}
		//$pf_rpw_style = $pf_rpw_default_dispaly;
		$pf_rpw_style_id = 'rfpw_rpw_'.$pf_rpw_style;
		//$pf_rpw_style_id = 'rfpw_rpw_meduim';
		$pf_rpw_posts_display_arr = array();
		foreach ($pf_rpw_posts_arr as $key=>$val)
		{
			$PostDisplayArr = array();
			$postID = $val;
			$post_link = get_post_permalink($postID);
			$post_title = get_the_title($postID);
			$post_descriptions = get_the_content($postID);
			if(has_post_thumbnail($postID))
			{
				$post_thumbnail_id = get_post_thumbnail_id($postID);
				//thumbnail, medium,large,full
				if($pf_rpw_style == 'small')
				{
					$feat_image = get_the_post_thumbnail($postID,array(45, 40));
					//echo $feat_image =  the_post_thumbnail(array(50, 50));
					
				}
				elseif($pf_rpw_style == 'medium')
				{
					$feat_image = get_the_post_thumbnail($postID,'thumbnail');									
				}
				elseif($pf_rpw_style == 'large') 
				{
					$feat_image = get_the_post_thumbnail($postID,'medium');					
				}
				else 
				{
					$feat_image = get_the_post_thumbnail($postID,'thumbnail');
				}				
			}
			else 
			{
				if($pf_rpw_widget_no_images_id != '' && $pf_rpw_widget_no_images_id != '0')
				{
					if($pf_rpw_style == 'small')
					{
						$feat_image = wp_get_attachment_image($pf_rpw_widget_no_images_id,array(45, 40));
					}
					elseif($pf_rpw_style == 'medium')
					{
						$feat_image = wp_get_attachment_image($pf_rpw_widget_no_images_id,'thumbnail');
					}
					elseif($pf_rpw_style == 'large')
					{
						$feat_image = wp_get_attachment_image($pf_rpw_widget_no_images_id,'medium');
					}
					else
					{
						$feat_image = wp_get_attachment_image($pf_rpw_widget_no_images_id,'thumbnail');
					}
					echo wp_get_attachment_image($pf_rpw_widget_no_images_id,'medium');
				}
				else 
				{
					$feat_image = '<img width="150" height="150" alt="Ashley-Madison" class="attachment-thumbnail wp-post-image" src="'. plugins_url( '/images/no-image.png', __FILE__ ).'">';
				}
				
			}
			$post_img = $feat_image;
			//thumbnail, medium,large,full
			if($pf_rpw_style == 'small')
			{
				if (strlen($post_title) > 45) {
					// truncate string
					$stringCut = substr($post_title, 0, 40);
					// make sure it ends in a word so assassinate doesn't become ass...
					$post_title = substr($stringCut, 0, strrpos($stringCut,' ')).'...';
				}
			}
			elseif($pf_rpw_style == 'medium'){
				if (strlen($post_title) > 80) {
					// truncate string
					$stringCut = substr($post_title, 0, 80);
					// make sure it ends in a word so assassinate doesn't become ass...
					$post_title = substr($stringCut, 0, strrpos($stringCut,' ')).'...';
				}
			}
			elseif($pf_rpw_style == 'large'){
				if (strlen($post_title) > 80) {
					// truncate string
					$stringCut = substr($post_title, 0, 80);
					// make sure it ends in a word so assassinate doesn't become ass...
					$post_title = substr($stringCut, 0, strrpos($stringCut,' ')).'...';
				}
				if (strlen($post_descriptions) > 190) {
					// truncate string
					$stringCuts = substr($post_descriptions, 0, 188);
					// make sure it ends in a word so assassinate doesn't become ass...
					$post_descriptions = substr($stringCuts, 0, strrpos($stringCuts,' ')).'...';
				}
			}
			else
			{
				if (strlen($post_title) > 80) {
					// truncate string
					$stringCut = substr($post_title, 0, 80);
					// make sure it ends in a word so assassinate doesn't become ass...
					$post_title = substr($stringCut, 0, strrpos($stringCut,' ')).'...';
				}
			
			}
			$PostDisplayArr['link'] = $post_link;
			$PostDisplayArr['title'] =  strip_tags($post_title);
			$PostDisplayArr['descriptions'] = strip_tags($post_descriptions);
			$PostDisplayArr['image'] = $feat_image;
			$pf_rpw_posts_display_arr[] = $PostDisplayArr;
		}
		
		$pf_rpw_widget_displayed_top = $pf_rpw_settings['pf_rpw_widget_displayed_top'] != '' ? $pf_rpw_settings['pf_rpw_widget_displayed_top'] : '';
		$pf_rpw_widget_displayed_bottom = $pf_rpw_settings['pf_rpw_widget_displayed_bottom'] != '' ? $pf_rpw_settings['pf_rpw_widget_displayed_bottom'] : '';
		$pf_rpw_widget_displayed_left = $pf_rpw_settings['pf_rpw_widget_displayed_left'] != '' ? $pf_rpw_settings['pf_rpw_widget_displayed_left'] : '';
		$pf_rpw_widget_displayed_right = $pf_rpw_settings['pf_rpw_widget_displayed_right'] != '' ? $pf_rpw_settings['pf_rpw_widget_displayed_right'] : '';
		
		$pf_rpw_widget_colors_bg_box = $pf_rpw_settings['pf_rpw_widget_colors_bg_box'] != '' ? $pf_rpw_settings['pf_rpw_widget_colors_bg_box'] : '';
		$pf_rpw_widget_colors_bd_box = $pf_rpw_settings['pf_rpw_widget_colors_bd_box'] != '' ? $pf_rpw_settings['pf_rpw_widget_colors_bd_box'] : '';
		$pf_rpw_widget_colors_link_cl_box = $pf_rpw_settings['pf_rpw_widget_colors_link_cl_box'] != '' ? $pf_rpw_settings['pf_rpw_widget_colors_link_cl_box'] : '';
		$pf_rpw_widget_colors_main_arrow = $pf_rpw_settings['pf_rpw_widget_colors_main_arrow'] != '' ? $pf_rpw_settings['pf_rpw_widget_colors_main_arrow'] : '';
		$pf_rpw_widget_link_text_fonts = $pf_rpw_settings['pf_rpw_widget_link_text_fonts'] != '' ? $pf_rpw_settings['pf_rpw_widget_link_text_fonts'] : '';
		$pf_rpw_widget_arrow_fonts = $pf_rpw_settings['pf_rpw_widget_arrow_fonts'] != '' ? $pf_rpw_settings['pf_rpw_widget_arrow_fonts'] : '';
		include_once 'pf-rpw-css-generator.php';
		include_once 'pf-rpw-fronted.php';	
	}	
}



/*
 * Add a meta box to post and page.
 */
function pf_rpw_meta_box($post_type) {
	# Allowed post types to show meta box:
	$post_types = array('post', 'page');
	if (in_array($post_type, $post_types)) {
		# Add a meta box to the administrative interface:
		add_meta_box(
		'pf-rpw-meta-box', 			// HTML 'id' attribute of the edit screen section.
		'Related Posts',    		// Title of the edit screen section, visible to user.
		'pf_rpw_meta_box_setting', 	// Function that prints out the HTML for the edit screen section.
		$post_type, 		        // The type of Write screen on which to show the edit screen section.
		'advanced',         		// The part of the page where the edit screen section should be shown.
		'high' 		  	            // The priority within the context where the boxes should show.
		);
	}
}
/*
 * Display function for metabox
*/
function pf_rpw_meta_box_setting($post) {
	wp_enqueue_style( 'pfRPWScriptMultiSelect' );
	wp_enqueue_style( 'pfRPWStyleMultiSelect' );
	
	# Use `get_post_meta()` to retrieve an existing value from the database and use the value for the form:
	$pf_rpw_posts = get_post_meta($post->ID, 'pf_rpw_posts', true);
	$pf_rpw_posts_arr = unserialize($pf_rpw_posts);
	$pf_rpw_posts_json = json_encode($pf_rpw_posts_arr);
	if(!empty($pf_rpw_posts_arr) && is_array($pf_rpw_posts_arr)){$selectedTotalNos = count(array_filter($pf_rpw_posts_arr));}else{$selectedTotalNos = 0;}
	if($selectedTotalNos == 3){$disabled = 'disabled';}else{$disabled = '';}
	# Form field to display:
	$posts = get_posts(array('post_type'  => $post_type,'numberposts' => -1));
	if(!$posts){ return;}else{include_once 'pf-rpw-posts-box.php';}

    # Display the nonce hidden form field:
	wp_nonce_field(
	plugin_basename(__FILE__), // Action name.
	'pf_rpw_nonce'        // Nonce name.
    );
}
/*
 * Save function for metabox
*/
function pf_rpw_save_postdata($post_id) {

	# Is the current user is authorised to do this action?
    if ((($_POST['post_type'] === 'page') && current_user_can('edit_page', $post_id) || current_user_can('edit_post', $post_id))) { // If it's a page, OR, if it's a post, can the user edit it? 
        # Stop WP from clearing custom fields on autosave:
        if ((( ! defined('DOING_AUTOSAVE')) || ( ! DOING_AUTOSAVE)) && (( ! defined('DOING_AJAX')) || ( ! DOING_AJAX))) {
            # Nonce verification:
            if (wp_verify_nonce($_POST['pf_rpw_nonce'], plugin_basename(__FILE__))) {
                # Get the posted data:
                $post_data = sanitize_text_field(serialize($_POST['searchable']));
                # Add, update or delete?
                if ($post_data !== '') {
                    # Post exists, so add OR update it:
                    add_post_meta($post_id, 'pf_rpw_posts', $post_data, true) OR update_post_meta($post_id, 'pf_rpw_posts', $post_data);
                } else {
                    # Posts empty or removed:
                    delete_post_meta($post_id, 'pf_rpw_posts');
                }
            }
        }
    }
}
/*
 * Get the posts data function
 */
function pf_rpw_get_meta($post_id = FALSE) {
    $post_id = ($post_id) ? $post_id : get_the_ID();
    return apply_filters('pf_rpw_check_meta', get_post_meta($post_id, 'pf_rpw_posts', TRUE));
}
/*
 * Display Posts function
 */
function pf_rpw_check_meta() {
    echo pf_rpw_get_meta(get_the_ID());
}
?>