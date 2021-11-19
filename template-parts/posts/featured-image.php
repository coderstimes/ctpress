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

?>

<figure class="img-holder">
    <?php 
      if( get_the_post_thumbnail_caption() ) :
         switch ( ctpress_get_option('post_img_cap') ) {
            case '1':
               echo $image;
               echo sprintf( '<p class="img-caption img-layer-bottom"> %1$s </p>',get_the_post_thumbnail_caption() );
               break;
            case '2':
               echo sprintf( '<p class="img-caption img-layer-top"> %1$s </p>',get_the_post_thumbnail_caption() );
               echo $image;
               break;  
            case '3':
               echo $image;
               echo sprintf( '<p class="img-caption img-layer-thumb"> %1$s </p>',get_the_post_thumbnail_caption() );
               break;                      
            default:
               echo $image;               
               break;
         }
      else:
         echo $image;
      endif; 
    ?>
 </figure>
