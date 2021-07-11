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

?>

   <div class="col-md-12 mt-5 br-bottom">
 
        <?php
           $toplead= new WP_Query(array(
                'post_type'            =>'post',
                'posts_per_page'       => 1,
                'post__in'             => get_option( 'sticky_posts' ),
                'category__in'         => ctpress_get_option('topleft'),
                'ignore_sticky_posts'  => 1,
            ));
           while( $toplead->have_posts() ) : $toplead->the_post(); 
        ?>

         <figure class="img-holder text-center">
            <?php echo ctpress_get_post_image( 'full' ); ?>
         </figure>

            <a href="<?php the_permalink()?>">
               <div class="post-content pt-4">
                  <div class="title-holder">
                     <h1 class="post-title no-margin"> <?php echo the_title(); ?> </h1>
                  </div>
                  <div class="post_desc p-t-10">
                     <p> <?php echo ctpress_content(50); ?> </p>
                  </div>
               </div>
             </a>

        <?php endwhile; ?>
      </div>
      
<?php

   $row_num = 0;
   $home_news = new WP_Query(array( 
      'post_type'       =>'post',
      'posts_per_page'  => 1,
      'offset'          => 1
   ));
   if ( $home_news->have_posts()) :
      while( $home_news->have_posts()) : $home_news->the_post();
?>

<?php echo ( $row_num % 2 == 0 ) ? '<div class="row py-5 br-bottom">' : '';  ?>

   <div class="col-md-6 <?php echo ( $row_num % 2 == 0 ) ? $margin_bottom : '' ; ?>">

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
<?php echo ( $row_num % 2 == 0 ) ? '' : '</div>';  ?>

<?php 
   $row_num++; endwhile;  
   echo ( $row_num & 1 ) ? '</div>' : ''; 
      
   ctpress_pagination();
   else :
      get_template_part( 'template-parts/content/no', 'content' );
   endif; 
?> 