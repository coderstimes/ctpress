<?php
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Ctpress
 */

if ( ! function_exists( 'ctpress_menu_search' ) ) :
	/**
	 * Displays the site logo in the header area
	 */
	function ctpress_menu_search() {

		if (  ! ctpress_get_option( 'menu_search' ) || is_customize_preview() ) : ?>

              <form class="searchform d-flex">
                <input class="form-control me-2 d-none" type="search" placeholder="<?php _e( 'Search', 'ctpress' ); ?>" aria-label="search" name="s">
                <button class="btn btn-outline-warning search_btn" type="button"> <?php _e( 'Search', 'ctpress' ); ?></button>               
              </form>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'ctpress_site_title' ) ) :
	/**
	 * Displays the site title in the header area
	 */
	function ctpress_site_title() {

		if ( is_home() ) :
			?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'ctpress_header_image' ) ) :
	/**
	 * Displays the custom header image below the navigation menu
	 */
	function ctpress_header_image() {
		if ( has_header_image() ) :
			?>

			<div id="headimg" class="header-image default-header-image">

				<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

			</div>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'ctpress_archive_header' ) ) :
	/**
	 * Displays the header title on archive pages.
	 */
	function ctpress_archive_header() {
		?>

		<header class="archive-header entry-header">

			<?php the_archive_title( '<h1 class="archive-title entry-title">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

		</header>
		<!-- .archive-header -->

		<?php
	}
endif;


if ( ! function_exists( 'ctpress_search_header' ) ) :
	/**
	 * Displays the header title on search results.
	 */
	function ctpress_search_header() {
		?>

		<header class="search-header entry-header">

			<h1 class="search-title entry-title">
				<?php
				// translators: Search Results title.
				printf( esc_html__( 'Search Results for: %s', 'ctpress' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
			<?php get_search_form(); ?>

		</header><!-- .search-header -->

		<?php
	}
endif;



if ( ! function_exists( 'ctpress_entry_meta' ) ) :
	/**
	 * Displays the date and author of a post
	 */
	function ctpress_entry_meta() {

		$postmeta  = ctpress_entry_date();
		$postmeta .= ctpress_entry_author();
		$postmeta .= ctpress_entry_comments();

		echo '<div class="entry-meta pb-3">' . $postmeta . '</div>';
	}
endif;


if ( ! function_exists( 'ctpress_entry_date' ) ) :
	/**
	 * Returns the post date
	 */
	function ctpress_entry_date() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		return sprintf( '<span class="posted-on pe-2 float-start"> <a href="%s" rel="bookmark">%s</a> </span>',esc_url( get_permalink() ), $time_string );
	}
endif;


if ( ! function_exists( 'ctpress_entry_author' ) ) :
	/**
	 * Returns the post author
	 */
	function ctpress_entry_author() {

		$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			// translators: post author link.
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'ctpress' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);

		return '<span class="posted-by px-2 float-start" ' . $author_string . '</span>';
	}
endif;


if ( ! function_exists( 'ctpress_entry_comments' ) ) :
	/**
	 * Displays the post comments
	 */
	function ctpress_entry_comments() {

		

		/*Check if comments are open or we have at least one comment.*/
		if ( ! ( comments_open() || get_comments_number() ) || ctpress_get_option('post-comment') ) {
			return;
		}

		if ( ctpress_get_option('comment_option') ) {
			/*Display facebook comment number*/
			return sprintf('<span class="entry-comments ps-2 float-start fb-comments-count" data-href="%s"></span>', get_the_permalink() );
		} else {
			/*Start Output Buffering.*/
			ob_start();

			/*Display Comments.*/
			comments_popup_link(
				esc_html__( 'No comments', 'ctpress' ),
				esc_html__( '1 comment', 'ctpress' ),
				esc_html__( '% comments', 'ctpress' )
			);
			$comments = ob_get_contents();

			// End Output Buffering.
			ob_end_clean();		

			return '<span class="entry-comments ps-2 float-start"> ' . $comments . '</span>';

		}

		
	}
endif;



if ( ! function_exists( 'ctpress_read_more_button' ) ) :
	/**
	 * Displays the read more button on posts
	 */
	function ctpress_read_more_button() {
		printf('<a href="%s" class="text-center"> <button type="button" class="readmore btn"> %s </button> </a>',get_the_permalink(), esc_html( 'Read More', 'ctpress' ));
	}
endif;


if ( ! function_exists( 'ctpress_post_navigation' ) ) :
	/**
	 * Displays Single Post Navigation
	 */
	function ctpress_post_navigation() {

		if ( !ctpress_get_option( 'post-navigation' ) || is_customize_preview() ) :

			the_post_navigation( array(
				'prev_text' => '<span class="nav-link-text"> ' . esc_html_x( 'Previous Post', 'post navigation', 'ctpress' ) . '</span><h3 class="entry-title">%title</h3>',
				'next_text' => '<span class="nav-link-text">' . esc_html_x( 'Next Post', 'post navigation', 'ctpress' ) . '</span><h3 class="entry-title">%title</h3>',
			) );

		endif;
	}
endif;


if ( ! function_exists( 'ctpress_pagination' ) ) :
	/**
	 * Displays pagination on archive pages
	 */
	function ctpress_pagination() {
		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&laquo <span class="pagination-text">' . esc_html_x( 'Previous', 'pagination', 'ctpress' ) . '</span>',
			'next_text' => '<span class="pagination-text">' . esc_html_x( 'Next', 'pagination', 'ctpress' ) . '</span> &raquo;',
		) );
	}
endif;


if ( ! function_exists( 'ctpress_footer_text' ) ) :
	/**
	 * Displays footer text on footer line
	 */
	function ctpress_footer_text() {
		if ( '' !== ctpress_get_option( 'footer_text' ) || is_customize_preview() ) :
			?>

			<span class="footer-text">
				<?php echo do_shortcode( wp_kses_post( ctpress_get_option( 'footer_text' ) ) ); ?> 
			</span>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'ctpress_credit_link' ) ) :
	/**
	 * Displays credit link on footer line
	 */
	function ctpress_credit_link() {
		if ( true === ctpress_get_option( 'credit_link' ) || is_customize_preview() ) :
			?>
			<div class="sub-footer copyright_credit_link">
	      <div class="container">
	         <div class="row">
	            <div class="col-xs-12 col-md-12">
	               <div class="copy"> 
	               	<?php 
	               	printf( 
	               		esc_html__('Copyright &copy; 2021 %s | Powered by %s','ctpress'),
	               		esc_html__( 'CTPress','ctpress' ),
	               		'<a href="https://www.facebook.com/coderstime" style="display: inline-block;font-weight: bold;"> CTPress WordPress Theme </a>');
	               	?> 
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>

			<?php
		endif;
	}
endif;


