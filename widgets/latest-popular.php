<?php

class LatestPopular_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'latest_popular_article', // Base ID
            __( 'Latest Popular Article', 'ctpress' ), // Name
            array( 'description' => __( 'Your website latest uploaded article and popular article based on visitor read', 'ctpress' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
 
        $latest_title = ( ! empty( $instance['latest_title'] ) ) ? apply_filters( 'widget_latest_title', $instance['latest_title'] ) : 'Latest';
        $popular_title = ( ! empty( $instance['popular_title'] ) ) ? apply_filters( 'widget_popular_title', $instance['popular_title'] ) : 'Popular';
        $show_per_page = ( ! empty( $instance['show_per_page'] ) ) ? apply_filters( 'widget_show_per_page', $instance['show_per_page'] ) : 25;

        $exclude_latest_cat = ( ! empty( $instance['exclude_latest_cat'] ) ) ? apply_filters( 'widget_popular_title', $instance['exclude_latest_cat'] ) : 0;
        $exclude_popular_cat = ( ! empty( $instance['exclude_popular_cat'] ) ) ? apply_filters( 'widget_popular_title', $instance['exclude_popular_cat'] ) : 0;

        $latest_cat = ( ! empty( $instance['latest_cat'] ) ) ? apply_filters( 'widget_popular_title', $instance['latest_cat'] ) : 0;
        $popular_cat = ( ! empty( $instance['popular_cat'] ) ) ? apply_filters( 'widget_popular_title', $instance['popular_cat'] ) : 0;
?>

<div class="tabs-container p-t-10" style="height: 410px;">
   <div class="tabs-wrapper">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-latest-tab" data-bs-toggle="tab" data-bs-target="#nav-latest" type="button" role="tab" aria-controls="nav-latest" aria-selected="true"><?php echo $latest_title; ?></button>
          <button class="nav-link" id="nav-popular-tab" data-bs-toggle="tab" data-bs-target="#nav-popular" type="button" role="tab" aria-controls="nav-popular" aria-selected="false"> <?php echo $popular_title; ?> </button>
        </div>
      </nav> 
      <div class="tab-content" style="overflow: scroll; height: 345px" id="nav-tabContent">
         <div role="tabpanel" class="tab-pane fade show active" id="nav-latest">
            <div class="most-viewed" id="latest">
               <div class="row mobile_list_simple ">
                  <ul class="list-group list-group-flush">
                  <?php 

                  $latest_args = array(
                     'post_type'    =>'post',
                     'posts_per_page'=> $show_per_page,
                     'category__in' => $latest_cat ? : '',
                  );

                  if ( $exclude_latest_cat && $latest_cat  ) {
                      $latest_args = array(
                         'post_type'    =>'post',
                         'posts_per_page'=> $show_per_page,
                         'category__not_in' => $latest_cat
                      );
                  }

                  $latest_article= new WP_Query( $latest_args );

                  while( $latest_article->have_posts() ) : $latest_article->the_post(); 
                  ?>
                      <li class="list-group-item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    
                  <?php endwhile; ?>
                  </ul>

               </div>
            </div>
         </div>
         <div role="tabpanel" class="tab-pane fade" id="nav-popular">
            <div class="most-viewed" id="most-today">
               <div class="row mobile_list_simple ">
                <ul class="list-group list-group-flush">
                  <?php 

                  $popular_args = array(
                    'post_type'    =>'post',
                    'posts_per_page'=> $show_per_page,
                    'meta_key' => 'post_views_count', 
                    'orderby' => 'meta_value_num', 
                    'order' => 'DESC', 
                    'category__in' => $popular_cat ? : '',
                  );

                  if ( $exclude_popular_cat && $popular_cat  ) {
                      $popular_args = array(
                        'post_type'    =>'post',
                        'posts_per_page'=> $show_per_page,
                        'meta_key' => 'post_views_count', 
                        'orderby' => 'meta_value_num', 
                        'order' => 'DESC', 
                        'category__not_in' => $popular_cat
                      );
                  }

                  $popular_article= new WP_Query( $popular_args );

                    while($popular_article->have_posts()) : $popular_article->the_post(); 
                  ?>
                  <li class="list-group-item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                  <?php endwhile; ?>    
                  </ul>                                
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php
        
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
 
        $instance['latest_title'] = ( !empty( $new_instance['latest_title'] ) ) ? strip_tags( $new_instance['latest_title'] ) : '';
        $instance['popular_title'] = ( !empty( $new_instance['popular_title'] ) ) ? strip_tags( $new_instance['popular_title'] ) : '';
        $instance['show_per_page'] = ( !empty( $new_instance['show_per_page'] ) ) ? strip_tags( $new_instance['show_per_page'] ) : 25;
        $instance['exclude_latest_cat'] = ( !empty( $new_instance['exclude_latest_cat'] ) ) ? strip_tags( $new_instance['exclude_latest_cat'] ) : '';
        $instance['exclude_popular_cat'] = ( !empty( $new_instance['exclude_popular_cat'] ) ) ? strip_tags( $new_instance['exclude_popular_cat'] ) : '';
        $instance['latest_cat'] = ( !empty( $new_instance['latest_cat'] ) ) ? array_map( 'esc_attr', $new_instance['latest_cat'] ) : '';
        $instance['popular_cat'] = ( !empty( $new_instance['popular_cat'] ) ) ? array_map( 'esc_attr', $new_instance['popular_cat'] ) : '';
 
        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        $latest_title = ! empty( $instance['latest_title'] ) ? $instance['latest_title'] : esc_html__( 'Latest Title', 'ctpress' );
        $popular_title = ! empty( $instance['popular_title'] ) ? $instance['popular_title'] : esc_html__( 'Popular Title', 'ctpress' );
        $show_per_page = ! empty( $instance['show_per_page'] ) ? $instance['show_per_page'] : 25;
        $exclude_latest_cat = ! empty( $instance['exclude_latest_cat'] ) ? 'checked' : '';
        $exclude_popular_cat = ! empty( $instance['exclude_popular_cat'] ) ? 'checked' : '';
        $latest_cats = ! empty( $instance['latest_cat'] ) ? $instance['latest_cat']  : [];
        $popular_cats = ! empty( $instance['popular_cat'] ) ? $instance['popular_cat']  : [];

        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'latest_title' ) ); ?>"><?php echo esc_html__( 'Latest Title:', 'ctpress' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_title ); ?>">
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'popular_title' ) ); ?>"><?php echo esc_html__( 'Popular Title:', 'ctpress' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'popular_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'popular_title' ) ); ?>" type="text" value="<?php echo esc_attr( $popular_title ); ?>">
        </p>
        
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'show_per_page' ) ); ?>"><?php echo esc_html__( 'Article Show per page', 'ctpress' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_per_page' ) ); ?>" type="text" value="<?php echo esc_attr( $show_per_page ); ?>">
        </p>

        <p>
            <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'exclude_latest_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_latest_cat' ) ); ?>" <?php echo $exclude_latest_cat; ?> >
            <label for="<?php echo esc_attr( $this->get_field_id( 'exclude_latest_cat' ) ); ?>"> <?php echo esc_html__( 'Exclude Latest Category', 'ctpress' ); ?></label>
            <br>
        </p>

        <?php 
        $categories = get_categories(['hide_empty'      => false,]);
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'latest_cat' ) ); ?>"><?php _e( 'Latest Article categories', 'ctpress' ); ?></label>
            <select class="widefat category_select" name="<?php echo esc_attr( $this->get_field_name( 'latest_cat' ) ); ?>[]" multiple="multiple">
                <?php 
                    foreach ( $categories as $category ) {
                        printf( '<option value="%s" %s>%s</option><br />',
                            esc_html( $category->term_id ),
                            in_array($category->term_id, $latest_cats) ? 'selected': '',
                            esc_html( $category->name )
                        );
                    }
                ?>
            </select>
        </p>

         <p>
            <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'exclude_popular_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_popular_cat' ) ); ?>" <?php echo $exclude_popular_cat; ?> >
            <label for="<?php echo esc_attr( $this->get_field_id( 'popular_title' ) ); ?>"> <?php echo esc_html__( 'Exclude Popular Category', 'ctpress' ); ?>  </label>
            <br>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'popular_cat' ) ); ?>"><?php _e( 'Popular Article categories', 'ctpress' ); ?></label>
            <select class="widefat category_select" name="<?php echo esc_attr( $this->get_field_name( 'popular_cat' ) ); ?>[]" multiple="multiple">
                <?php 
                    foreach ( $categories as $category ) {
                        printf( '<option value="%s" %s>%s</option><br />',
                            esc_html( $category->term_id ),
                            in_array($category->term_id, $popular_cats) ? 'selected': '',
                            esc_html( $category->name )
                        );
                    }
                ?>
            </select>
        </p>


        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lib/ReduxCore/assets/css/select2.css?ver=3.5.2">
        <script src="<?php echo get_template_directory_uri(); ?>/lib/ReduxCore/assets/js/select2.js?ver=3.5.2"></script>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery(".category_select").select2();
            });
        </script>
        <?php      
    }

} 
/*class Foo_Widget*/

function ct_latest_popular_article_widget() {
    register_widget( 'LatestPopular_Widget' );
}

add_action( 'widgets_init', 'ct_latest_popular_article_widget' );
