<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Team Trinity</title>
	<link rel="shortcut icon" href="<?php echo WP_TEMPLATEPATH; ?>/static/images/structure/favicon.gif" />
	<link rel="stylesheet" href="<?php echo WP_TEMPLATEPATH; ?>/static/css/skeleton.css">
	<?php if(defined('TRINITY_DEBUG') && TRINITY_DEBUG === TRUE): ?>
	<link rel="stylesheet/less" href="<?php echo WP_TEMPLATEPATH; ?>/static/css/main.less"><?php else: ?>
	<link rel="stylesheet" href="<?php echo WP_TEMPLATEPATH; ?>/static/css/main.css"><?php endif; ?>

	<script src="<?php echo WP_TEMPLATEPATH; ?>/static/js/libs/underscore-min.js"></script>
	<script src="<?php echo WP_TEMPLATEPATH; ?>/static/js/libs/jquery-2.0.0.min.js"></script>
	<script src="<?php echo WP_TEMPLATEPATH; ?>/static/js/libs/jquery-scrollto.min.js"></script>
	<script src="<?php echo WP_TEMPLATEPATH; ?>/static/js/libs/less-1.3.3.min.js"></script>
	<script src="<?php echo WP_TEMPLATEPATH; ?>/static/js/common.js"></script>
	<?php //wp_head(); ?>
</head>
<body>

	<div class="wrapper" id="wrapper-header">

		<div id="header">
			<a href="/" id="logo">Team Trinity</a>
		</div>

	</div>

	<div class="wrapper" id="wrapper-navigation">

		<?php
			$main_nav = wp_nav_menu( array('menu' => 'main_menu', 'echo' => FALSE, 'sort_column' => 'menu_order', 'menu_class' => 'navigation', 'container' => 'div', 'container_id' => 'navigation') );
			$main_nav = str_replace(' target="_self"', '', $main_nav);
			echo $main_nav;
		?>

	</div>

	<div class="wrapper" id="wrapper-main">

		<div class="container" id="main">

			<?php

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

			?>

		</div>

	</div>

</body>
</html>
