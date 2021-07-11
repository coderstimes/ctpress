<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 * @author Coders Time
 */
?>

<div class="col-md-4">
  <?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
</div>
 <!-- site logo -->
 <div class="col-md-8 mt-4">
  <?php do_action( 'ctpress_logo_right_column' ); ?>
</div>