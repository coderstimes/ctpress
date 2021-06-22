<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */

$img_size = wp_is_mobile() ? 'medium' : 'medium_large';
$image_url = get_the_post_thumbnail_url(get_the_ID(), $img_size);

if ( !$image_url ) {
	return;
}

$image = sprintf('<img class="img-responsive mx-auto d-block" src="%s" alt="%s">',$image_url,get_the_title());

if( $img_caption = get_the_post_thumbnail_caption() && !ctpress_get_option('page_img_cap') ) : 
   $img_caption = sprintf('<p class="img-caption img-layer-thumb"> %s </p>',$img_caption);       
endif; 



?>
<figure class="img-holder">
    <?php 
      if( ctpress_get_option('page-heading') ) :
         echo $image;
         echo $img_caption;
      else:
         echo $img_caption;
         echo $image;         
      endif; 
    ?>
 </figure>
