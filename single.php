<?php
defined( 'ABSPATH' ) || exit;
/**
 * The main template file.
 * @package bengal
 */
get_header(); 
$img_size = wp_is_mobile() ? 'medium_large' : 'full';
 
?>
      </header>

      <div id="fb-root"></div>

      <main class="page_main_wrapper">

         <?php get_template_part( 'template-parts/breadcrumb/single', 'page' ); ?>

         <div class="container">
            <div class="row my-5">

            <?php 

               if ( have_posts()) : 
                  while (have_posts()) : 
                     the_post();
                     setPostViews( get_the_ID() );  

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
                           echo "string";
                           break;
                     }

                  endwhile; 
               else :
                  get_template_part( 'template-parts/content/no', 'content' );
               endif;  
            ?>
              
            </div>
         </div>
        
      </main>

<?php get_footer(); ?>
<script>
   (function($){
      $(document).ready(function(){
         if($('.img-holder .img-caption')[0]){
            $('.img-holder .img-caption').css('width',$(".img-holder img")[0].clientWidth);
         }         
      });

      function fb_comments_func() {
         var fb_comments_count = $(".fb_comments_count");
         fb_comments_count.append( fb_comments_count.text()> 1 ? ' Commments' : ' Comment');
         if ( fb_comments_count.text().length < 1 ) {
            setTimeout(fb_comments_func, 1000);
         }
      }
      setTimeout(fb_comments_func, false);  
   })(jQuery);   
</script>

<?php  if ( ctpress_get_option('comment_option')) : ?>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=<?php echo ctpress_get_option('fb_appId')? : '492209628792946';?>&autoLogAppEvents=1" nonce="YLjsSwmz"></script>

<?php endif; ?>
