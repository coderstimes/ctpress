<?php
defined( 'ABSPATH' ) || exit;
/**
 * The main template file.
 * @package bengal
 */
get_header();

?>

   </header>

   <main class="search_wrapper my-5">

      <?php get_template_part( 'template-parts/breadcrumb/single', 'page' ); ?>

      <div class="container">
         <div class="row">

            <div class="col-md-12">
               <?php ctpress_archive_header(); ?>
            </div>
            
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

            <!-- search sidebar -->
            <div class="col-md-4">
               <?php get_template_part( 'template-parts/sidebar/page', 'sidebar' ); ?>
            </div>

         </div>

      </div>
   </main>

<?php get_footer(); 
