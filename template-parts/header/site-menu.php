<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */

if ( has_nav_menu( 'main_menu' ) ) :
	wp_nav_menu(
		array(
		  'theme_location' 	=> 'main_menu',
		  'menu_class'     	=> 'nav navbar-nav navbar-right',
		  'depth'          	=> 3,
		  'container'		=> false,
		  'fallback_cb'     => false,
		)
	);
else :
	wp_page_menu( [
		'before' => '<ul class="nav navbar-nav navbar-right">', 
		'after' => '</ul>',
		'show_home' => 1,
		'depth' => 0,
		'sort_column' => 'menu_order'
	]);
endif; 