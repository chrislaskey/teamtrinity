<?php
/**
 * @package WordPress
 * @subpackage CELEST
 * @since 3.0.0
 */

//Definitions

	if( ! defined('WP_TEMPLATEPATH') ){ define('WP_TEMPLATEPATH', '/wp-content/themes/trinity'); }

//Wordpress Overrides and Content Registrations

	add_filter('the_content', 'add_banner_images_to_content');

	register_nav_menus(array(
		'main' => 'Main Menu',
	));

//Filter functions

	function add_banner_images_to_content($content){
		$template = '</div>
					<div class="sixteen column alpha omega banner-image">
						<img src="${1}" alt="banner-image" width="100%"/>
					</div>
					<div class="twelve columns alpha omega offset-by-two content">';
		$content = preg_replace('/{{ banner-image:(.*) }}/', $template, $content);
		return $content;
	}

//Helper functions
	function get_wp_menu_id($slug){
		$locations = get_nav_menu_locations();
		return isset($locations[$slug]) ? $locations[$slug] : FALSE;
	}

	function get_section_template_path($subtype){
		$subtype = strtolower($subtype);

		$name = '/section-' . $subtype . '.php';
		if( $template = locate_template($name) ){
			return $template;
		}

		$name = '/section.php';
		if( $template = locate_template($name) ){
			return $template;
		}

		trigger_error(
			'Could not find required Team Trinity WP template file section.php',
			E_USER_WARNING
		);

		return '';
	}

	function get_root_id_from_page_title($title){
		/**
 		* Note: can not use $section->ID from the returned navigation object.
 		* The menu caches the current revision ID, not the root ID. The revision
 		* ID will not return children pages. So a second lookup is required to get
 		* the root ID.
 		*/
		$page = get_page_by_title($title);
		if( $page && isset($page->ID) ){
			return $page->ID;
		}
		return 0;
	}

	function get_section_post($id){
		return get_post($id);
	}

	function get_section_children($id){
		$args = array( 
    		'post_parent' => $id,
			'post_type' => 'any',
			'post_status' => 'publish',
		);
		return get_posts($args);
	}

/* End of file functions.php */
