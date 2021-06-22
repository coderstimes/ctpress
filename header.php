<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @version 1.1
 * @package Ctpress
 */
defined( 'ABSPATH' ) || exit;

 $theme = wp_get_theme();
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

      <?php do_action( 'ctpress_before_site' ); ?>

      <!-- <div class="se-pre-con"></div> -->

      <header>
         <div class="header-top">
            <div class="container">
               <div class="row">

                  <div class="col-sm-4">
                     <?php get_template_part( 'template-parts/header/site', 'social' ); ?>
                     <div class="top-left-menu">
                     </div>
                  </div>

                  <div class="col-sm-8 pull-right">
                     <?php get_template_part( 'template-parts/header/site', 'top-right' ); ?>
                  </div>
               </div>
            </div>
         </div>

         <div class="header-mid d-none d-md-block">
            <div class="container">
               <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">

                     <?php get_template_part( 'template-parts/header/site', 'logo' ); ?>
                     
                  </div>
                  <div class="col-md-4"></div>                  
               </div>
            </div>
         </div>

         <?php do_action( 'ctpress_before_menu' ); ?>

         <nav class="navbar navbar-expand-lg navbar-sticky navbar-mobile bootsnav">
            <div class="top-search">
               <div class="container">
                  <!-- <div class="attr-nav"> -->
                     <?php ctpress_menu_search(); ?>
                  <!-- </div> -->
               </div>
            </div>
            <div class="container no-padding">
               
               <div class="navbar-header">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="fa fa-bars"></span>
                  </button>
                  <?php 
                     if ( $wp_is_mobile ) {
                        get_template_part( 'template-parts/header/site', 'logo-mobile' ); 
                     }                     
                  ?>                  
               </div>
               <div class="collapse navbar-collapse" id="navbar-menu">
                  <?php get_template_part( 'template-parts/header/site', 'menu' ); ?>
               </div>

               <div class="attr-nav hidden-sm hidden-xs">
                  <?php ctpress_menu_search(); ?>
               </div>

            </div>
         </nav>
      </header>

 <?php do_action( 'ctpress_after_header' ); ?>
