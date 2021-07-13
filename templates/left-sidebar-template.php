<?php
defined( 'ABSPATH' ) || exit;
/**
 * The page template file.
 * @version 1.1
 * @package ctpress
 * @author Coders Time
 * Template Name: Left Sidebar Template
 */
get_header();

?>

<main class="page_main_wrapper mb-5">

   <?php get_template_part( 'template-parts/breadcrumb/single', 'page' ); ?>
   
   <div class="container">
      <div class="row">
            <?php 
               if ( have_posts() ) : 
                  while (have_posts()) : 
                     the_post();
                     get_template_part( 'template-parts/page/left', 'sidebar' );
                  endwhile; 
               else :
                  get_template_part( 'template-parts/content/no', 'content' );
               endif; 
            ?>
      </div>
   </div>
  
</main>
<?php get_footer(); 

