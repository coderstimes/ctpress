<?php
defined( 'ABSPATH' ) || exit;
/**
 * The page template file.
 * @package bengal
 * Template Name: Right Sidebar Template
 */
get_header();

?>
   </header>

      <main class="page_main_wrapper mb-5">

         <?php get_template_part( 'template-parts/breadcrumb/single', 'page' ); ?>
         
         <div class="container">
            <div class="row">
                  <?php 
                     if ( have_posts() ) : 
                        while (have_posts()) : 
                           the_post();
                           get_template_part( 'template-parts/page/right', 'sidebar' );
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
         if( $('.img-holder .img-caption')[0] ) {
            $('.img-holder .img-caption').css('width',$(".img-holder img")[0].clientWidth); 
         }                
      });      
   })(jQuery);   
</script>
