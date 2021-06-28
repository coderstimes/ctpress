<?php
defined( 'ABSPATH' ) || exit;
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 * @package ctpress
 */

?>

<?php do_action( 'ctpress_before_footer' ); ?>

<footer>
   <div class="container">
      <div class="row">
         <div class="col-sm-4 footer-box">
            <div class="footer-logo">
               <img src="<?php echo ctpress_get_option('footer_logo')['url'] ? : ctpress_get_option('logo')['url'] ?>" class="img-responsive" alt="<?php echo get_bloginfo( 'name' ) . ' logo'; ?>" />
               <ul>
                  <?php echo ctpress_get_option('footer_logo_bottom');?>
                  <?php echo ctpress_get_option('footer_text');?>
               </ul>
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
      
      <script async >
         (function( $ ){
          $(document).ready( function(){ 
               
                /*add class on ul li has ul*/
                $('ul .menu-item-has-children').addClass('dropdown');
                $('.menu-item-has-children').css('display','block');
                $('.sub-menu').addClass('dropdown-menu megamenu-content megamenu-others animated');

                $(".search_btn").click(function(){
                  $(".searchform input").removeClass('d-none');
                });

                $(".searchform input").keydown(function(){
                  if ( this.value.length > 2 ) {
                     $('.search_btn').attr("type", 'submit');
                  } else {
                     $('.search_btn').attr("type", 'button');
                  }               
                });

                $("#menu-main-menu .dropdown-menu .nav-link").each(function(){
                  $(this).addClass('dropdown-item').removeClass('nav-link');
                  // console.log(this);
                })

            });
         })(jQuery);         
      </script>
      <?php wp_footer(); ?>
   </body>
</html>