<?php
/**
 * Site Feature Image
 *
 * @version 1.0
 * @package CtPress
 */

$img_size = wp_is_mobile() ? 'medium' : 'medium_large';
$image_url = get_the_post_thumbnail_url(get_the_ID(), $img_size);

if ( !$image_url ) {
	return;
}

?>
<figure class="img-holder">
    <img class="img-responsive mx-auto d-block" src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
    <?php if( $img_caption = get_the_post_thumbnail_caption() ) : ?>
       <p class="img-caption img-layer-thumb m-b-0"> 
          <?php echo $img_caption; ?>
       </p>
    <?php endif; ?>
 </figure>
