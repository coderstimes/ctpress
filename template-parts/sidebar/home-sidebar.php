<?php
/**
 * Homepage Sidebar
 *
 * @version 1.0
 * @package Ctpress
 * @author Coders Time
 */


if (is_active_sidebar('home_sidebar')) {
    dynamic_sidebar('home_sidebar');
}

if (is_active_sidebar('common_sidebar')) {
    dynamic_sidebar('common_sidebar');
}
