<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */


/*If comments are open or we have at least one comment, load up the comment template.*/
if ( comments_open() || get_comments_number() ) :
    comments_template();
endif;

