<?php
/**
 * @package WordPress
 * @subpackage CELEST
 * @since 3.0.0
 */

setup_postdata($post);

?>

<section>
	<div class="twelve columns offset-by-two content">
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>
	<div class="clearfix"></div>
</section>
