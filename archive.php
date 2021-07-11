<?php
defined( 'ABSPATH' ) || exit;
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @version 1.0
 * @package Ctpress
 * @author Coders Time
 */

get_header();

?>

   <main class="archive_wrapper my-5" id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
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

            <div class="col-md-4">
               <?php get_template_part( 'template-parts/sidebar/category', 'desktop' ); ?>
            </div>

         </div>
      </div>
   </main>
<?php 
get_footer();
