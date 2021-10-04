<?php
defined( 'ABSPATH' ) || exit;
/**
 * The page template file.
 * @version 1.2
 * @package ctpress
 * @author Coders Time
 */
?>

  <div class="container mb-4">
    <div class="row">

      <div class="col-md-12">
         <?php do_action( 'ctpress_before_content' ); ?>
      </div>

      <div class="col-md-7">

        <?php 
           $lead_article =[];
           $top= new WP_Query(array(
                'post_type'            =>'post',
                'posts_per_page'       =>1,
                'post__in'             => get_option( 'sticky_posts' ),
                'category__in'         => ctpress_get_option('topleft'),
                'ignore_sticky_posts'  => 1,
            ));
           while( $top->have_posts() ) : $top->the_post(); 
            $lead_article[] = get_the_ID();
        ?>
        <div class="row lead-news">
          <div class="col-md-5">
            <a href="<?php the_permalink()?>">
               <div class="post-content pt-4">
                  <div class="title-holder">
                      <?php the_title('<h1 class="post-title">','</h1>'); ?> 
                  </div>
                  <div class="post_desc p-t-10">
                     <p><?php echo ctpress_excerpt(50); ?> </p>
                  </div>
               </div>
             </a>
          </div>
          <div class="col-md-7 pe-0">
             <div class="img-holder">
              <?php echo ctpress_get_post_image( 'medium_large' ); ?>
             </div>
          </div>
           
        </div>
        <?php endwhile; ?>
      </div>

      <div class="col-md-5 col-lg-5">
        <div class="row">
           <div class="col-md-6 col-lg-6 lead-news-2">
              <div class="no-margin">

                 <?php
                    $topmiddle= new WP_Query(array(
                         'post_type'            =>'post',
                         'posts_per_page'       =>1,
                         'post__in'             => get_option( 'sticky_posts' ),
                         'category__in'         => ctpress_get_option('topmiddle'),
                         'ignore_sticky_posts'  => 1,
                     ));
                    while($topmiddle->have_posts()) : $topmiddle->the_post();
                     $lead_article[] = get_the_ID();
                 ?>

                 <a class="post-item" href="<?php the_permalink()?>">
                    <figure class="img-holder">
                      <?php echo ctpress_get_post_image( ); ?>
                    </figure>
                    
                    <div class="post-content p-t-20">                                 
                       <div class="title-holder">
                           <?php the_title('<h3 class="post-title">','</h3>'); ?>
                       </div>
                    </div>
                 </a>

                 <?php endwhile; ?>

              </div>
           </div>
           <div class="col-md-6 col-lg-6 lead-news-2">
              <div class=" no-margin">

                 <?php 
                  $topright_lead = 0;
                    $topright = new WP_Query( [
                         'post_type'            => 'post',
                         'posts_per_page'       => 1,
                         'post__in'             => get_option( 'sticky_posts' ),
                         'category__in'         => ctpress_get_option('topright'),
                         'ignore_sticky_posts'  => 1,
                     ]);
                    while( $topright->have_posts()) : $topright->the_post();
                     $lead_article[] = get_the_ID();
                 ?>

                 <a class="post-item" href="<?php the_permalink()?>">
                    <figure class="img-holder">
                      <?php echo ctpress_get_post_image( ); ?>
                    </figure>
                    <div class="post-content pt-34">
                       <div class="title-holder">
                           <?php the_title('<h3 class="post-title">','</h3>'); ?>
                       </div>
                    </div>
                 </a>
                 <?php endwhile; ?>

              </div>
           </div>
        </div>
      </div>

    </div>
  </div>

  <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="advertisement_area">
            <?php do_action( 'ctpress_after_top_news' ); ?>
          </div>
       </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
       <div class="col-xs-12">
          <div class="heading_area">
             <div class="heading-border"></div>
             <div class="section-title pb-3 more_category">
                
               <?php 
                  $fullbody_cat_ids = (array) explode(',', ctpress_get_option('fullbody')); 
                  echo implode(', ',array_map(function( $id ){
                     return sprintf('<h2><a href="%s">%s</a></h2>', get_category_link( $id ), get_cat_name( $id ) );
                  }, $fullbody_cat_ids));
               ?>
                   
             </div>
          </div>                        
       </div>
    </div>
    
    <?php 
       $full_body_num = 0;
       $fullbody = new WP_Query( [
            'post_type'       => 'post',
            'posts_per_page'  => 8,
            'post__not_in'    => $lead_article,
            'category__in'    => explode(',', ctpress_get_option('fullbody'))
        ]);
       while( $fullbody->have_posts()) : $fullbody->the_post();
    ?>
    <?php if( $full_body_num % 4 == 0 ): ?>
        <div class="row pt-4">
    <?php endif; ?>

       <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <a class="post-item bg-grey" href="<?php the_permalink()?>">
             <figure class="img-holder">
              <?php echo ctpress_get_post_image( 'medium' ); ?>
             </figure>
             <div class="post-content pt-1">                        
                <div class="title-holder">
                  <?php the_title('<h3 class="post-title">','</h3>'); ?>
                </div>
             </div>
          </a>
       </div>
    <?php if( $full_body_num % 4 == 3 ): ?>
      </div>
    <?php endif; ?>
    <?php $full_body_num++; endwhile; ?>    
    <?php if( $full_body_num%4==3 ){ echo '</div>'; } ?>    
  </div>

  <div class="container">
     <div class="row">
        <div class="col-md-12">
           <?php do_action( 'ctpress_after_fullbody_section' ); ?>
        </div>
     </div>
  </div>

  <div class="container">
    <div class="row">
       <div class="col-md-8 br-right">

          <div class="row">
             <div class="col-xs-12">
                <div class="heading_area">
                   <div class="heading-border"></div>
                   <div class="section-title pb-3 body_one">
                      <a href="<?php echo esc_url( get_category_link(ctpress_get_option('body_one')) ); ?>">
                         <h2> <?php echo get_cat_name(ctpress_get_option('body_one'));?> </h2>
                      </a>
                   </div>
                </div>                        
             </div>
          </div>
          <div class="row no-margin pb-4 p-r-20">
             <div class="col-xs-12 pb-4">

                <?php 
                   $body_one_lead = 0;
                   $body_one = new WP_Query( [
                        'post_type'=>'post',
                        'posts_per_page'=>1,
                        'post__in' => get_option( 'sticky_posts' ),
                        'category__in'=>ctpress_get_option('body_one')
                    ]);
                   while( $body_one->have_posts()) : $body_one->the_post();
                ?>

                <div class="row">
                   <div class="col-xs-12 col-sm-6 pt-2">
                      <a class="post-item" href="<?php the_permalink()?>">
                         <figure class="img-holder">
                          <?php echo ctpress_get_post_image( 'medium_large' ); ?>
                         </figure>
                      </a>
                   </div>
                   <?php $body_one_lead=get_the_ID(); ?>
                   <div class="col-xs-12 col-sm-6">
                     <a class="post-item" href="<?php the_permalink()?>">
                        <div class="pb-2">
                           <div class="title-holder pt-2">
                              <?php the_title('<h2 class="post-title pb-2">','</h2>'); ?> 
                              <p class="brief"> <?php echo ctpress_excerpt(20); ?> </p>
                            </div>
                            <div class="category-meta">
                              <p class="category">
                                 <?php echo get_cat_name(get_the_ID());?>
                              </p>
                            </div>
                         </div>
                      </a>
                   </div>
                </div>

                <?php endwhile; ?>

             </div>

             <div class="col-xs-12">
                <div class="row">
                   <?php 
                      $body_one = new WP_Query( [
                           'post_type'       => 'post',
                           'posts_per_page'  => 4,
                           'offset'          => 1,
                           'category__in'    => ctpress_get_option('body_one')
                       ]);
                      while( $body_one->have_posts()) : $body_one->the_post();
                   ?>
                      <div class="col-xs-12 col-sm-6 col-md-3">
                         <a class="post-item bg-grey" href="<?php the_permalink()?>">
                            <figure class="img-holder">
                              <?php echo ctpress_get_post_image( ); ?>
                            </figure>
                            <div class="post-content">                               
                               <div class="title-holder">
                                 <?php the_title('<h3 class="post-title">','</h3>'); ?> 
                               </div>
                            </div>
                         </a>
                      </div>
                   <?php endwhile; ?>
                   
                </div>
             </div>
          </div>

          <div class="container">
              <div class="row">
                 <div class="col-md-12">
                    <div class="advertisement_area">
                      <?php do_action( 'ctpress_after_body_one_section' ); ?>
                    </div>
                 </div>
              </div>
          </div>

          <div class="row no-margin">
             <div class="col-xs-12">
                <div class="heading_area">
                   <div class="heading-border"></div>
                   <div class="section-title pb-3 body_two">
                      <a href="<?php echo esc_url( get_category_link(ctpress_get_option('body_two')) ); ?>">
                         <h2> <?php echo get_cat_name(ctpress_get_option('body_two'));?> </h2>
                      </a>
                   </div>
                </div>                        
             </div>
          </div>

          <div class="row no-margin p-b-20 p-r-20 ">
             <div class="col-xs-12 p-b-20">

                <?php 
                   $body_two_lead = 0;
                   $body_two = new WP_Query( [
                        'post_type'       => 'post',
                        'posts_per_page'  => 1,
                        'post__in'        => get_option( 'sticky_posts' ),
                        'category__in'    => ctpress_get_option('body_two'),
                    ]);
                   while( $body_two->have_posts()) : $body_two->the_post();
                ?>

                <div class="row video">
                   <div class="col-xs-12 col-sm-6 p-t-10">
                      <a class="post-item" href="<?php the_permalink()?>">
                         <figure class="img-holder">
                          <?php echo ctpress_get_post_image( 'medium_large' ); ?>
                         </figure>
                      </a>
                   </div>
                   <?php $body_two_lead=get_the_ID(); ?>
                   <div class="col-xs-12 col-sm-6">
                      <a class="post-item" href="<?php the_permalink()?>">
                         <div class="pb-2">
                            <div class="title-holder">
                                <?php the_title('<h2 class="post-title">','</h2>'); ?> 
                               <p class="brief"> <?php echo ctpress_excerpt(20); ?> </p>
                            </div>
                            <div class="category-meta">
                               <p class="category"><?php echo get_cat_name(get_the_ID());?></p>
                            </div>
                         </div>
                      </a>
                   </div>
                </div>

                <?php endwhile; ?>
                

             </div>
          </div>

          <div class="row no-margin">
             <div class="col-xs-12">
                <div class="heading_area">
                   <div class="heading-border"></div>
                   <div class="section-title pb-3 body_three">
                      <a href="<?php echo esc_url( get_category_link(ctpress_get_option('body_three')) ); ?>">
                         <h2> <?php echo get_cat_name(ctpress_get_option('body_three'));?> </h2>
                      </a>
                   </div>
                </div>                        
             </div>
          </div>

          <div class="row no-margin p-b-20 p-r-20 ">
             <div class="col-xs-12 p-b-20">

                <?php 
                   $body_three_lead = 0;
                   $body_three = new WP_Query( [
                        'post_type'       => 'post',
                        'posts_per_page'  => 1,
                        'post__in'        => get_option( 'sticky_posts' ),
                        'category__in'    => ctpress_get_option('body_three')
                    ]);
                   while( $body_three->have_posts()) : $body_three->the_post();
                ?>

                <div class="row video">
                   <div class="col-xs-12 col-md-6 p-t-10">
                      <a class="post-item" href="<?php the_permalink()?>">
                         <figure class="img-holder">
                            <?php echo ctpress_get_post_image( 'medium_large' ); ?>
                         </figure>
                      </a>
                   </div>
                   <?php $body_three_lead=get_the_ID(); ?>
                   <div class="col-xs-12 col-md-6">
                      <a class="post-item" href="<?php the_permalink()?>">
                         <div class="pb-2">
                            <div class="title-holder">
                               <?php the_title('<h3 class="post-title">','</h3>'); ?> 
                               <p class="brief"> <?php echo ctpress_excerpt(20); ?> </p>
                            </div>
                            <div class="category-meta">
                              <p class="category">
                                 <?php echo get_cat_name(get_the_ID());?>
                              </p>
                            </div>
                         </div>
                      </a>
                   </div>
                </div>

                <?php endwhile; ?>
                
             </div>
             <div class="col-xs-12 pt-4">
                <div class="row p-0">
                   <?php 
                      $body_three = new WP_Query( [
                           'post_type'      => 'post',
                           'posts_per_page' => 4,
                           'offset'         => 1,
                           'category__in'   => ctpress_get_option('body_three')
                       ]);
                      while( $body_three->have_posts()) : $body_three->the_post();
                   ?>
                      <div class="col-xs-12 col-sm-6 col-md-3">
                         <a class="post-item bg-grey" href="<?php the_permalink()?>">
                            <figure class="img-holder">
                              <?php echo ctpress_get_post_image( ); ?>
                            </figure>
                            <div class="post-content pt-2">
                               <div class="title-holder">
                                   <?php the_title('<h3 class="post-title no-margin">', '</h3>'); ?> 
                               </div>
                            </div>
                         </a>
                      </div>
                   <?php endwhile; ?>
                   
                </div>
             </div>
          </div>

          <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="advertisement_area">
                    <?php do_action( 'ctpress_body_four' ); ?>
                  </div>
               </div>
            </div>
          </div>


       </div>
       <div class="col-md-4 br-top">

         <?php 
         if ( is_active_sidebar('homepage_sidebar')) {
             dynamic_sidebar('homepage_sidebar');
         }
         ?>

         <div class="special-feature">
            <div class="section-title right_sidebarcat">
               <a href="<?php echo esc_url( get_category_link(ctpress_get_option('right_sidebarcat')) ); ?>">
                  <h2> <?php echo get_cat_name(ctpress_get_option('right_sidebarcat'));?> </h2>
               </a>
            </div>
             <div class="contents">

                <div class="row">
                   <div class="col-xs-12 pt-2">
                      <?php 
                         $right_sidebarcat_lead = 0;
                         $right_sidebarcat = new WP_Query( [
                              'post_type'=>'post',
                              'posts_per_page'=>1,
                              'post__in' => get_option( 'sticky_posts' ),
                              'category__in'=>ctpress_get_option('right_sidebarcat')
                          ]);
                         while( $right_sidebarcat->have_posts()) : $right_sidebarcat->the_post();
                         $right_sidebarcat_lead = get_the_ID();
                      ?>
                      <a class="post-item" href="<?php the_permalink()?>">
                         <figure class="img-holder sidebar-lead me-2 text-center">

                          <?php echo ctpress_get_post_image( ); ?>  

                         </figure>
                         <div class="pb-4">
                            <div class="title-holder">
                                 <?php the_title('<h3 class="post-title">','</h3>'); ?>
                            </div>                                   
                         </div>
                      </a>
                      <?php endwhile; ?>

                   </div>
                </div>

                <div class="row">
                   <?php 
                         $right_sidebarcat = new WP_Query( [
                              'post_type'       => 'post',
                              'posts_per_page'  => 10,
                              'offset'          => 1,
                              'category__in'    => ctpress_get_option('right_sidebarcat')
                          ]);
                         while( $right_sidebarcat->have_posts()) : $right_sidebarcat->the_post();
                      ?>
                   <div class="col-sm-12">
                     <div class="row">
                        <div class="col-sm-5">
                           <figure class="img-holder">
                              <?php echo ctpress_get_post_image( 'thumbnail' ); ?>
                           </figure>
                        </div>

                         <div class="col-sm-7">
                           <a href="<?php the_permalink()?>">
                               <div class="title-holder">
                                  <?php the_title('<h3 class="post-title">','</h3>'); ?>
                               </div>
                            </a>
                         </div>                      
                     </div>                      
                   </div>
                   <?php endwhile; ?>
                   
                </div>
             </div>
          </div>

          <div class="advertisement_area my-4">
            <!-- advertisement area -->     
            <?php do_action('ctpress_home_rightsidebar_bottom'); ?>                
          </div>

       </div>
    </div>
  </div>

  <div class="container p-t-20">
    <div class="row">
       <div class="col-xs-12">
          <div class="heading_area">
             <div class="heading-border"></div>
             <div class="section-title more_category pb-3">
                <?php 

                  $bodybot_cat = ctpress_get_option('bodybottom');                
                  $fullbody_cat_ids = is_array($bodybot_cat) ? $bodybot_cat : (array) explode(',',$bodybot_cat); 
                   echo implode(', ',array_map(function( $id ){
                      return sprintf('<h2><a href="%s">%s</a></h2>', get_category_link( $id ), get_cat_name( $id ) );
                   }, $fullbody_cat_ids));

                ?>
             </div>
          </div>                  
       </div>
    </div>

    <div class="row">
       <div class="col-xs-12 p-t-20 p-b-20">
             <div class="row p-0">

                <?php 
                   $bodybottom = new WP_Query( [
                        'post_type'       => 'post',
                        'posts_per_page'  => 4,
                        'category__in'    => explode(',', $bodybot_cat)
                    ]);
                   while( $bodybottom->have_posts()) : $bodybottom->the_post();
                ?>

                <div class="col-xs-12 col-sm-6 col-md-3">
                   <a class="post-item bg-grey" href="<?php the_permalink()?>">
                      <figure class="img-holder">
                        <?php echo ctpress_get_post_image(  ); ?>
                      </figure>
                      <div class="post-content pt-2">
                         <div class="title-holder">
                           <?php echo the_title('<h3 class="post-title">','</h3>'); ?> 
                         </div>
                      </div>
                   </a>
                </div>

             <?php endwhile; ?>
                                       
             </div>
          </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="advertisement_area">
            <!-- Advertisement area -->
            <?php do_action('ctpress_body_bottom_section'); ?>
          </div>
       </div>
    </div>
  </div>