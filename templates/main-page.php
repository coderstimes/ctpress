<?php
defined( 'ABSPATH' ) || exit;
/**
 * The main template file.
 * @version 1.1
 * @package ctpress
 * @author coderstime
 * Template Name: Home Page 1
 */
get_header(); 
?>

<main class="page_main_wrapper my-4">

   <?php get_template_part( 'templates/template', 'post' ); ?>

</main>
      
<?php get_footer(); ?>