<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
?>

<div class="title-holder my-4 text-center">
    <h1> <?php echo the_title(); ?> </h1>
</div>

<div class="post_info bg-light p-3 mb-3">
 <?php ctpress_entry_meta(); ?>
</div> 