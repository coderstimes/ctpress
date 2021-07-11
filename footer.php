<?php
defined( 'ABSPATH' ) || exit;
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 * @package ctpress
 * @author coderstime
 */

?>

<?php do_action( 'ctpress_before_footer' ); ?>

<footer class="pt-5">
   <div class="container pb-4">
      <div class="row">
         <div class="col-sm-4 footer-box">
            <div class="footer-logo">
               
               <?php if( isset(ctpress_get_option('footer_logo')['url']) ) :  ?>
                  <img src="<?php echo ctpress_get_option('footer_logo')['url']; ?>" class="img-responsive" alt="<?php echo get_bloginfo( 'name' ) . ' logo'; ?>" />
               <?php endif; ?>
               
               <div class="footer-description">
                  <?php echo ctpress_get_option('footer_logo_bottom');?>
                  <?php echo ctpress_get_option('footer_text');?>
               </div>
               
            </div>
         </div>
         <div class="col-sm-4 footer-box">
            <div class="footer-logo address">
               <ul>
                  <li>
                    <?php echo ctpress_get_option('footer_info');?>                          
                  </li>
               </ul>                     
            </div>
         </div>
         <div class="col-sm-4 footer-box">
            <?php get_template_part( 'template-parts/footer/site', 'social' ); ?>
         </div>
      </div>
   </div>
   <!-- show credit link info -->
   <?php ctpress_credit_link(); ?>
</footer>

      <?php do_action( 'ctpress_after_footer' ); ?>
      <?php wp_footer(); ?>
   </body>
</html>