<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 * @author Coders Time
 */
?>

<div class="col-md-8">
  <div class="single-post-content">

     <?php 
        if( ctpress_get_option('page-heading') ) {
        /*get featured image and caption if exist*/         
         get_template_part( 'template-parts/page/featured', 'image' );
         /*get page heading*/       
         get_template_part( 'template-parts/page/heading' );
        } else {
         /*get page heading*/   
         get_template_part( 'template-parts/page/heading' );
         /*get featured image and caption if exist*/ 
         get_template_part( 'template-parts/page/featured', 'image' );
        }
     ?>
     
     <div class="content_area">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
     </div>                   
  </div>
</div>

<div class="col-md-4">
  <?php get_template_part( 'template-parts/sidebar/page', 'sidebar' ); ?>
</div>