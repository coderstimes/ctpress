<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */

?> 

<div class="col-md-10 mx-auto">
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
     ?>
     
     <div class="content_area">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
     </div>

      <?php 
         get_template_part( 'template-parts/navigation/navigation','post'); 
         ctpress_post_navigation(); 
         get_template_part( 'template-parts/comments/comment'); 
      ?>  

  </div>
</div>



