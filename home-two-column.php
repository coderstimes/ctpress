<?php
defined( 'ABSPATH' ) || exit;
/**
 * The main template file.
 * @package ctpress
 * @author coderstime
 * Template Name: Two column Home
 */
get_header();
?>

<main class="two_column_wrapper mb-5">

   <div class="container">
      <div class="row">

         <div class="col-md-8">
            <?php
               get_template_part( 'template-parts/content/twocolumn', 'home' ); 
            ?>
         </div>

         <!-- category sidebar -->
         <div class="col-md-4 pt-5">
            <?php get_template_part( 'template-parts/sidebar/home', 'sidebar' ); ?>
         </div>

      </div>
   </div>
</main>

<?php get_footer(); ?>

