<?php
/**
 * Post Navigation
 *
 * @version 1.0
 * @package Ctpress
 * @author Coders Time
 */

if ( ctpress_get_option( 'post-tags' ) ) {
   return;
}

?>

<div class="post-tags-alt my-4 mx-auto" style="width:fit-content;">
 	<?php 
	 $tags = get_the_tags();
	 if( $tags ): 
 	?>
    <div class="tags-wrap">
       <i class="fa fa-tags" style="font-size:1.3em"></i>
       <?php foreach($tags as $tag): ?>
          <a class="cat-world" href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo ucwords($tag->name);?></a>
       <?php endforeach; ?>
    </div>
 	<?php endif; ?>
</div>