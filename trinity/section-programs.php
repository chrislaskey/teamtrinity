<?php
/**
 * @package WordPress
 * @subpackage CELEST
 * @since 3.0.0
 */

$programs_navigation = get_navigation_list_from_children($children, 'programs');
$programs_content = get_content_list_from_children($children, 'programs');

?>

<section>
	<div class="twelve columns offset-by-two content">
		<h1><?php echo $post->post_title; ?></h1>
	</div>
	<div class="no-margins sixteen columns alpha omega section-navigation-container">
		<?php echo $programs_navigation; ?>
	</div>
	<div class="twelve columns offset-by-two content">
		<?php echo $programs_content; ?>
	</div>
	<div class="clearfix"></div>
</section>

<script>
$(function(){
	var navigation_elements = $('.section-navigation.programs').find('a');
		navigation_content = $('.section-content.programs').find('li');

	navigation_elements.on('click', function(e){
		e.preventDefault();
		var target = $(e.target),
			index = navigation_elements.index(target),
			item,
			i;

		navigation_elements.removeClass('selected');
		target.addClass('selected');

		for(i = 0; i < navigation_content.length; i++){
			item = navigation_content.eq(i);
			if( i == index ){ item.addClass('selected'); }
			else{ item.removeClass('selected'); }
		}
	});

	navigation_elements.eq(0).trigger('click');
});
</script>
