<?php
/**
 * The loop that displays posts
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * @package WordPress
 * @subpackage CELEST
 * @since 3.0.0
 */
?>

	<?php
// $args = array(
//         'order'                  => 'ASC',
//         'orderby'                => 'menu_order',
//         'post_type'              => 'nav_menu_item',
//         'post_status'            => 'publish',
//         'output'                 => ARRAY_A,
//         'output_key'             => 'menu_order',
//         'nopaging'               => true,
//         'update_post_term_cache' => false );
// $menu = get_wp_menu_id('main');
// $items = wp_get_nav_menu_items( $menu, $args );
// var_dump($menu, $args, $items);

# get sections by main menu
# use order to call create_section($parent);

// $menu_item_name = 'races'; // Load from menu items
// $look_for_custom_template = $menu_item_name . '-template.php';
// $default_template = dirname(__FILE__) . '/default-template.php';

// if( $custom_template = locate_template($look_for_custom_template) ){
// 	load_template($custom_template);
// }else{
// 	load_template($default_template);
// }

// get_template_part('section', $name);
// section.php
// section-races.php
// section-apply.php

// function get_template_file($subtype){
// 	$subtype = strtolower($subtype);

// 	$name = '/section-' . $subtype . '.php';
// 	if( $template = locate_template($name) ){
// 		return $template;
// 	}

// 	$name = '/section.php';
// 	if( $template = locate_template($name) ){
// 		return $template;
// 	}

// 	return '';
// }

$menu_id = get_wp_menu_id('main');
$menu_items = wp_get_nav_menu_items($menu_id);
foreach($menu_items as $section){
	if( $template = get_section_template_path($section->title) ){
		$id = get_root_id_from_page_title($section->title);
		$post = get_section_post($id);
		$children = get_section_children($id);
		include($template);
	}
}

/*
	<?php if( !have_posts() ): //If there are no posts to display, such as an empty archive page ?>

		<div class="post">
			<h1 class="entry-title">Not Found</h1>
			<div class="entry-content">
				<p>There are currently no posts that fit the requested criteria. From here you can return to the <a href="<?php echo home_url('/'); ?>">homepage</a> or try using the search form below.</p>
				<?php get_search_form(); ?>
			</div>
		</div>

	<?php else: ?>

		<ul class="posts">

			<?php $first = TRUE; ?>

			<?php while ( have_posts() ) : the_post(); //Start the Loop ?>

			<li <?php post_class( ($first === TRUE) ? 'first' : '' ); ?>>

				<h2 class="title post_title"><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

				<div class="post_header">

					<?php if( !is_author() ): ?>

						<!-- <span class="author">By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>&nbsp;|&nbsp;<span class="date"><?php echo get_the_date(); ?></span> -->
						<span class="date"><?php echo get_the_date(); ?></span><!--&nbsp;|&nbsp;<span class="author">By <?php the_author(); ?></span>-->

					<?php else : ?>

						<span class="date"><?php echo get_the_date(); ?></span>

					<?php endif; ?>

				</div>

				<?php if ( is_author() || is_search() ) : //Only display Excerpts for archives & search ?>

					<div class="post_summary">
						<?php the_excerpt('Read the rest of this entry &raquo;'); ?>
						<div class="clear_left"></div>
					</div>

				<?php else : ?>

					<div class="post_content">
						<?php the_content('Read the rest of this entry &raquo;'); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page_link">Pages:', 'after' => '</div>' ) ); ?>
						<div class="clear_left"></div>
					</div>

				<?php endif; ?>

			</li>

			<?php $first = FALSE; ?>

			<?php endwhile; ?>

		</ul>

	<?php endif; ?>
*/
?>
