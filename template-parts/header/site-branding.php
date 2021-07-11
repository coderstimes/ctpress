<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
?>

<div class="logo mt-4 mb-2">
    <?php ctpress_site_logo(); ?>
</div> 

<div class="site-branding mb-4">
    <?php ctpress_site_title(); ?>
	<?php ctpress_site_description(); ?>

    <p class="pt-2 theme-date"> <?php echo date('l, d F Y'); ?> </p>
</div><!-- .site-branding -->
