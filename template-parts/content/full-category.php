<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
$mobile = wp_is_mobile();
// $img_size = $mobile ? 'medium' : 'medium_large';
$img_size = $mobile ? 'medium' : 'medium';
$margin_bottom = $mobile ? 'mb-5' : '';

   $row_num = 0;
   while( have_posts()) : the_post();
?>

<?php echo ( $row_num % 2 == 0 ) ? '<div class="row py-5 br-bottom">' : '';  ?>

   <div class="col-md-6 <?php echo ( $row_num % 2 == 0 ) ? $margin_bottom : '' ; ?>">

      <a href="<?php the_permalink(); ?>">
         <?php echo ctpress_get_post_image( $img_size ); ?>
      </a>

      <div class="mt-3">
         <div class="title-holder">
            <strong>
               <h2 class="post-title no-margin p-b-10">
                  <?php the_title(); ?>
               </h2>
            </strong>
            <p class="brief my-3"> <?php echo  more_content(30); ?> </p>
            <?php ctpress_read_more_button(); ?>
         </div>
      </div>
      
   </div>
<?php echo ( $row_num % 2 == 0 ) ? '' : '</div>';  ?>

<?php $row_num++; endwhile;  
echo ( $row_num & 1 ) ? '</div>' : '';