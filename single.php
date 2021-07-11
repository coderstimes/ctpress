<?php
defined( 'ABSPATH' ) || exit;
/**
 * The single posts file.
 * @package ctpress
 */

/*
   * If the current post is protected by a password and
   * the visitor has not yet entered the password we will
   * return early without loading the comments.
*/
if ( post_password_required() ) {
   return;
}

get_header(); 
$img_size = wp_is_mobile() ? 'medium_large' : 'full';
 
?>
      <div id="fb-root"></div>

      <main class="page_main_wrapper">

         <?php get_template_part( 'template-parts/breadcrumb/single', 'page' ); ?>

         <div class="container">
            <div class="row">
               <div class="col-md-12">

                  <div id="post-<?php the_ID(); ?>" <?php post_class('mt-2 mb-5 pb-5 row'); ?>>
                  <?php
                  
                     if ( have_posts()) : 
                        while (have_posts()) : 
                           the_post();
                           ctpress_setViews( get_the_ID() );

                           switch ( ctpress_get_option('post-screen') ) {
                              case '1':
                                 get_template_part( 'template-parts/posts/right', 'sidebar' );
                                 break;
                              case '2':
                                 get_template_part( 'template-parts/posts/left', 'sidebar' );
                                 break;
                              case '3':
                                 get_template_part( 'template-parts/posts/no', 'sidebar' );
                                 break;
                              case '4':
                                 get_template_part( 'template-parts/posts/fullwidth' );
                                 break;                        
                              default:
                                 break;
                           }
                        endwhile; 
                     else :
                        get_template_part( 'template-parts/content/no', 'content' );
                     endif;  
                  ?>
               </div>

                  
               </div>
            </div>
         </div>

         
        
      </main>


<?php  if ( ctpress_get_option('comment_option')) : ?>
   <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=<?php echo ctpress_get_option('fb_appId')? : '492209628792946';?>&autoLogAppEvents=1" nonce="YLjsSwmz"></script>

<?php endif; 

   get_footer(); 
?>
