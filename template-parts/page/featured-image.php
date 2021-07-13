<?php
/**
 * Page Feature Image
 *
 * @version 1.1
 * @package Ctpress
 * @author Coders Time
 */

$img_size = wp_is_mobile() ? 'medium' : 'medium_large';
$image_url = get_the_post_thumbnail_url(get_the_ID(), $img_size);

if ( !$image_url ) {
	return;
}

$image = sprintf('<img class="img-responsive mx-auto d-block" src="%s" alt="%s">',$image_url,get_the_title());

$img_caption = '';
if( get_the_post_thumbnail_caption() && !ctpress_get_option('post_img_cap') ) :
   $img_caption = sprintf( '<p class="img-caption img-layer-thumb"> %1$s </p>',get_the_post_thumbnail_caption() ); 
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
