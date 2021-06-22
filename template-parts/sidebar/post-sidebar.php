<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
?>


<?php 

if (is_active_sidebar('post_sidebar')) {
    dynamic_sidebar('post_sidebar');
}

if (is_active_sidebar('common_sidebar')) {
    dynamic_sidebar('common_sidebar');
}

?>

