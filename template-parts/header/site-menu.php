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
		  'theme_location' => 'main_menu',
		  'menu_class'     => 'nav navbar-nav navbar-right',
		  'depth'          => 3,
		  'container' => false,
		)
	);
	
endif; 