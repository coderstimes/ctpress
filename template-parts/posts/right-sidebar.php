<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */

?> 

<div class="col-md-8">
  <div class="single-post-content">

     <?php 
        if( ctpress_get_option('post-heading') ) {
            /*get featured image and caption if exist*/         
            get_template_part( 'template-parts/posts/featured', 'image' );
            /*get posts heading*/       
            get_template_part( 'template-parts/posts/heading','post' );
        } else {
            /*get posts heading*/   
            get_template_part( 'template-parts/posts/heading', 'post' );
            /*get featured image and caption if exist*/ 
            get_template_part( 'template-parts/posts/featured', 'image' );
        }

         /*
            * Get post content with check post format type
         */
         get_template_part( 'template-parts/posts/post', get_post_format( ));

         /*
            * Get post Navigation   
         */
         get_template_part( 'template-parts/navigation/navigation','post'); 
         ctpress_post_navigation(); 
         /*
            * Get post comments   
         */
         get_template_part( 'template-parts/comments/comment'); 
      ?> 

  </div>
</div>

<div class="col-md-4">
   <?php get_template_part( 'template-parts/sidebar/post', 'sidebar' ); ?>
</div>
