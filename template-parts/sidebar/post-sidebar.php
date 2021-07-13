<?php
/**
 * Post Sidebar
 *
 * @version 1.1
 * @package Ctpress
 * @author Coders Time
 */

if (is_active_sidebar('post_sidebar')) {
    dynamic_sidebar('post_sidebar');
}

if (is_active_sidebar('common_sidebar')) {
    dynamic_sidebar('common_sidebar');
}
