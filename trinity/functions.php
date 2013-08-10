<?php
/**
 * @package WordPress
 * @subpackage CELEST
 * @since 3.0.0
 */

//Definitions
	if( ! defined('WP_TEMPLATEPATH') ){ define('WP_TEMPLATEPATH', '/wp-content/themes/trinity'); }

//Wordpress Overrides and Content Registrations
	remove_filter('the_content', 'wptexturize');

	register_nav_menus(array(
		'main' => 'Main Menu',
	));

//The following functions three functions (cat_list, tag_list, and term_list) are from the Wordpress 3.0 default theme twentyten.
	if( !function_exists('cat_list') ){

		function cat_list() {
			return term_list('category', ', ', 'Categories: %s', 'Also posted in %s');
		}

	}

	if( !function_exists('tag_list') ){

		function tag_list() {
			return term_list( 'post_tag', ', ', 'Tags: %s', 'Also tagged %s');
		}

	}

	if( !function_exists('term_list') ){

		/**
		 * Updated v.1.0.1
		 * CL
		 */

		function term_list($taxonomy, $glue = ', ', $text = '', $also_text = '') {

			global $post, $wp_query;
			$current_term = $wp_query->get_queried_object();
			$terms = wp_get_object_terms($post->ID, $taxonomy);

			// If we're viewing a Taxonomy page..
			if ( isset( $current_term->taxonomy ) && $taxonomy == $current_term->taxonomy ) {

				// Remove the term from display.
				foreach ( $terms as $key => $term ) {
					if ( $term->term_id == $current_term->term_id ) {
						unset( $terms[$key] );
						break;
					}
				}

				// Change to Also text as we've now removed something from the terms list.
				$text = $also_text;

			}

			$tlist = array();
			$rel = 'category' == $taxonomy ? 'rel="category"' : 'rel="tag"';
			foreach ( (array) $terms as $term ) {
				$tlist[] = '<a href="' . get_term_link( $term, $taxonomy ) . '" title="' . esc_attr( sprintf('View all posts in %s', $term->name ) ) . '" ' . $rel . '>' . $term->name . '</a>';
			}

			if ( ! empty( $tlist ) )
				return sprintf( $text, join( $glue, $tlist ) );
			return '';
		}

	}

/* End of file functions.php */
