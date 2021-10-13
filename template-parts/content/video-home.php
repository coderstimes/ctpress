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
            $sticky_posts = get_option( 'sticky_posts' );
           $toplead= new WP_Query(array(
                'post_type'            =>'post',
                'posts_per_page'       => 10,
                'post__in'             => $sticky_posts,
                'category__in'         => ctpress_get_option('topleft'),
                'ignore_sticky_posts'  => 1,
            ));
            if ( $toplead->have_posts()) :
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
   ctpress_pagination();
   else :
      get_template_part( 'template-parts/content/no', 'content' );
   endif; 
 
   