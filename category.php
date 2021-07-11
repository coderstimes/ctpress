<?php
defined( 'ABSPATH' ) || exit;
/**
 * The catergory page.
 * @package ctpress
 * @author Coders Time
 */
get_header(); 
?>

<?php get_template_part( 'template-parts/breadcrumb/category', 'desktop' ); ?>

   <main class="category_wrapper mb-5">

      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <?php
                 if ( have_posts()) :
                  get_template_part( 'template-parts/content/full', 'category' ); 

                  ctpress_pagination();
                  else :
                     get_template_part( 'template-parts/content/no', 'content' );
                  endif; 
               ?> 
            </div>

            <!-- category sidebar -->
            <div class="col-md-4">
               <?php get_template_part( 'template-parts/sidebar/category', 'sidebar' ); ?>
            </div>

         </div>
      </div>
   </main>

<?php get_footer(); 