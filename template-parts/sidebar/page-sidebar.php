<?php
/**
 * Page Sidebar
 *
 * @version 1.1
 * @package Ctpress
 * @author Coders Time
 */

if ( is_active_sidebar('page_sidebar') ) {
    dynamic_sidebar('page_sidebar');
}

if ( is_active_sidebar('common_sidebar')) {
    dynamic_sidebar('common_sidebar');
}
