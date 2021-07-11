<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 * @author Coders Time
 */
   $mobile = wp_is_mobile();
   $img_size = $mobile ? 'medium' : 'medium';
   $margin_bottom = $mobile ? 'mb-5' : '';

   $row_num = 0;
   $home_news = new WP_Query(array(  'post_type'=>'post'   ));
   if ( $home_news->have_posts()) :
      while( $home_news->have_posts()) : $home_news->the_post();
?>

<?php echo ( $row_num % 3 == 0 ) ? '<div class="row py-5 br-bottom">' : '';  ?>

   <div class="col-md-4 <?php echo ( $row_num % 3 == 0 ) ? $margin_bottom : '' ; ?>">

      <a href="<?php the_permalink(); ?>">
         <figure class="img-holder text-center">
            <?php echo ctpress_get_post_image( $img_size ); ?>
         </figure>
      </a>
      
      <div class="mt-3">
         <div class="title-holder">
            <strong>
               <h2 class="post-title no-margin p-b-10">
                  <?php the_title(); ?>
               </h2>
            </strong>
            <p class="brief my-3"> <?php echo  ctpress_content(30); ?> </p>
            <?php ctpress_read_more_button(); ?>
         </div>
      </div>
      
   </div>
<?php echo ( $row_num % 3 == 2 ) ? '</div>' : '';  ?>

<?php 
   $row_num++; endwhile;  
   echo ( $row_num % 3 < 2 ) ? '</div>' : '';
      
   ctpress_pagination();
   else :
      get_template_part( 'template-parts/content/no', 'content' );
   endif; 
?> 