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
					<div class="no-margins sixteen column alpha omega banner-image">
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

	function get_navigation_list_from_children($children, $class){
		$li_tags = array();
		$length = count($children);
		$column_size = new ColumnClassCreator($length);
		foreach($children as $post){
			$li_tags[] = '<li class="no-margins '.$column_size->next().'"><a href="#">'.$post->post_title.'</a></li>';
		}
		$nav = '<ul class="section-navigation '.$class.'">'
					.implode($li_tags).
				'</ul>';
		return $nav;
	}

	function get_content_list_from_children($children, $class){
		$li_tags = array();
		$length = count($children);
		foreach($children as $post){
			setup_postdata($post);
			$content = get_the_content();
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			$li_tags[] = '<li>'.$content.'</li>';
		}
		$content = '<ul class="section-content '.$class.'">'
					.implode($li_tags).
				'</ul>';
		return $content;
	}

	class ColumnClassCreator{

		private $lookup = array(
			1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four',
			5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight',
			9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve',
			13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen', 16 => 'sixteen'
		);

		public function __construct($size, $pieces = 16){
			$this->size = $size;
			$this->pieces = $pieces;
			$this->remainder = $this->pieces % $this->size;
			$this->base = floor($this->pieces / $this->size);
			$this->current = 0;
		}

		public function next(){
			$this->current++;
			$base = $this->base;
			if( $this->remainder > 0 ){
				$base++;
				$this->remainder--;
			}

			if( $this->size == 3 ){
				$class = 'one-third column';
			}else{
				$class = $this->lookup[$base] . ' columns';
			}

			return $class . $this->get_extra_classes();
		}

		private function get_extra_classes(){
			if( $this->current == 1 ){ return ' alpha'; }
			if( $this->current == $this->size ){ return ' omega'; }
			return '';
		}

	}

/* End of file functions.php */
