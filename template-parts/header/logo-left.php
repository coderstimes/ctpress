<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
$date_time = ctpress_get_option('theme-date') == 0 ? '' : date('l, d F Y') ;
?>

<div class="col-md-4">
  <div class="logo my-4">
    <a href="<?php echo  home_url(); ?>">
       <img src="<?php echo ctpress_get_option('logo')['url'] ?>" class="logo" alt="<?php echo get_bloginfo( 'name' ) . ' logo'; ?>">
    </a>
    <p class="pt-2"> <?php echo $date_time; ?> </p>
  </div> 
</div>
 <!-- site logo -->

<div class="col-md-4 mt-4">
  <?php do_action( 'ctpress_logo_center' ); ?>
</div>
<div class="col-md-4 mt-4">
  <?php do_action( 'ctpress_logo_right' ); ?>
</div>