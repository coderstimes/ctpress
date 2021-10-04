<?php
defined( 'ABSPATH' ) || exit;
/**
 * The main template file.
 * @package ctpress
 * @author coderstime
 */
get_header();

?>

<main class="page_main_wrapper my-4">

   <?php get_template_part( 'templates/template', 'post' ); ?>
   
</main>
      
<?php get_footer(); ?>