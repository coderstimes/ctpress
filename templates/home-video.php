<?php
defined( 'ABSPATH' ) || exit;
/**
 * The main template file.
 * @package ctpress
 * @author coderstime
 * Template Name: Homepage Video
 */
get_header();
?>

<main class="two_column_wrapper mb-5">

   <div class="container">
      <div class="row">

         <div class="col-md-10 m-auto">
            <?php
               get_template_part( 'template-parts/content/video', 'home' ); 
            ?>
         </div>

      </div>
   </div>
</main>

<?php get_footer(); ?>

