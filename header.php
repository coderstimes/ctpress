<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @version 1.1
 * @package Ctpress
 * @author coderstime
 */
defined( 'ABSPATH' ) || exit;

 $wp_is_mobile = wp_is_mobile();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
   <head>
      <?php get_template_part( 'template-parts/header/site', 'head' ); ?>
      <?php wp_head(); ?>
   </head>

   <body <?php body_class('home-page'); ?>>
      <?php do_action( 'wp_body_open' ); ?>

      <a class="skip-link screen-reader-text" href="#content_area"><?php esc_html_e( 'Skip to content', 'ctpress' ); ?></a>

      <?php do_action( 'ctpress_before_site' ); ?>

      <header>
         <div class="header-top">
            <div class="container">
               <div class="row">
                  <div class="col-sm-4">
                     <?php get_template_part( 'template-parts/header/site', 'social' ); ?>
                  </div>
                  <div class="col-sm-8">
                     <?php do_action( 'ctpress_top_right_section' ); ?>
                  </div>
               </div>
            </div>
         </div>

         <div class="header-mid d-none d-md-block">
            <div class="container">
               <div class="row">

                  <?php 

                  switch( ctpress_get_option('logo-position') ) {
                     case 1 :  
                        /*call left position logo */
                        get_template_part( 'template-parts/header/logo', 'left' ); 
                        break;
                     case 2 : 
                        /*call center position logo */
                        get_template_part( 'template-parts/header/logo', 'center' ); 
                        break;
                     case 3 :
                        /*call right position logo */
                        get_template_part( 'template-parts/header/logo', 'right' ); 
                        break;
                     case 4 :
                        /*call left position logo with left 8 column*/
                        get_template_part( 'template-parts/header/logo-left', 'column' ); 
                        break;
                     case 5 :
                        /*call left position logo with right 8 column*/
                        get_template_part( 'template-parts/header/logo-right', 'column' ); 
                        break;
                     default:
                     break;
                  }

                  ?>
               </div>
            </div>
         </div>

         <?php do_action( 'ctpress_before_menu' ); ?>

         <?php if( $wp_is_mobile ): ?>
            <nav class="navbar navbar-expand-lg navbar-sticky navbar-mobile bootsnav">
               <div class="container">

                  <div class="col-12 navbar-mobile-logo">
                     <?php 
                        if ( $wp_is_mobile ) {
                           get_template_part( 'template-parts/header/site', 'logo-mobile' ); 
                        }                     
                     ?>
                     <div class="float-end" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#6e7072" viewBox="0 0 16 16" style="width:60px;height: 100px;"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 01.5-.5h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z"></path></svg>
                     </div>
                  </div>

                  <div class="collapse navbar-collapse" id="navbar-menu">
                     <?php get_template_part( 'template-parts/header/site', 'menu' ); ?>
                  </div>

               </div>
            </nav>
         <?php else: ?>
            <nav class="navbar navbar-expand-lg navbar-sticky navbar-mobile bootsnav">
               <div class="container">
                  
                  <?php get_template_part( 'template-parts/header/site', 'menu' ); ?>
                  <div class="attr-nav hidden-sm hidden-xs">
                     <?php ctpress_menu_search(); ?>
                  </div>

               </div>
            </nav>
         <?php endif; ?>

      </header>

      <div id="content_area" class="conteant_area"></div>

 <?php do_action( 'ctpress_after_header' ); ?>
