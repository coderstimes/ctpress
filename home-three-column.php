<?php
defined( 'ABSPATH' ) || exit;
/**
 * The main template file.
 * @package bengal
 * Template Name: Three column Home
 */
get_header();

?>

   </header>
   <main class="two_column_wrapper mb-5">
      <div class="container">
         <?php
            get_template_part( 'template-parts/content/threecolumn', 'home' ); 
         ?>
      </div>
   </main>

<?php get_footer(); ?>

