<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */

if (ctpress_get_option('post-comment')) {
    return;
}

?>

<div class="comment-area mt-3">
    <h4 style="background: #2e303a;padding: 15px;color: #fff;margin:-1px -1px 0;"> <?php esc_html_e( 'Share your comment :', 'ctpress' ); ?> </h4>
    <?php 

        if ( ctpress_get_option('comment_option') ) {
            get_template_part( 'template-parts/comments/facebook');
        } else {
            get_template_part( 'template-parts/comments/wordpress');
        }

    ?>

</div>