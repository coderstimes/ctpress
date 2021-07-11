<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
?>

<div class="col-md-4 mt-4">
  <?php do_action( 'ctpress_logo_left' ); ?>
</div>
<div class="col-md-4 mt-4">
  <?php do_action( 'ctpress_logo_center' ); ?>
</div>

<div class="col-md-4">
  <?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
</div>
 <!-- site logo -->