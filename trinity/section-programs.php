<?php
/**
 * @package WordPress
 * @subpackage CELEST
 * @since 3.0.0
 */

function get_navigation_list_from_children($children, $class){
	$li_tags = array();
	$length = count($children);
	$column_size = new ColumnClassCreator($length);
	foreach($children as $post){
		$li_tags[] = '<li class="'.$column_size->next().'"><a href="#">'.$post->post_title.'</a></li>';
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

Class ColumnClassCreator{

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

$programs_navigation = get_navigation_list_from_children($children, 'programs');
$programs_content = get_content_list_from_children($children, 'programs');

?>

<section>
	<div class="twelve columns alpha omega offset-by-two content">
		<h1><?php echo $post->post_title; ?></h1>
	</div>
	<div class="sixteen columns alpha omega section-navigation-container">
		<?php echo $programs_navigation; ?>
	</div>
	<div class="twelve columns alpha omega offset-by-two content">
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

		for(var i = 0; i < navigation_content.length; i++){
			item = navigation_content.eq(i);
			if( i == index ){ item.addClass('selected'); }
			else{ item.removeClass('selected'); }
		}
	});
	navigation_elements.eq(0).trigger('click');
});
</script>
