<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
?>


<?php 

if (is_active_sidebar('category_sidebar')) {
    dynamic_sidebar('category_sidebar');
}

if (is_active_sidebar('common_sidebar')) {
    dynamic_sidebar('common_sidebar');
}

?>