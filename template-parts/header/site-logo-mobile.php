<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
?>

<div class="navbar-brand hidden-sm hidden-md hidden-lg float-start">
 <!-- <a class="navbar-brand" href="#"> -->

   <div class="logo mb-2">
       <?php ctpress_site_logo(); ?>
   </div> 

   <div class="site-branding">
       <?php ctpress_site_title(); ?>
      <?php ctpress_site_description(); ?>

       <p class="pt-2 theme-date"> <?php echo date('l, d F Y'); ?> </p>
   </div><!-- .site-branding -->

 <!-- </a> -->
</div> <!-- site logo -->
