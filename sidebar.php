<?php
/**
 * The sidebar containing the widget area on blog pages.
 *
 * @package ctpress
 */

/*Check if Sidebar should be displayed.*/
if ( ctpress_has_sidebar() ) : ?>

	<section id="secondary" class="sidebar widget-area" role="complementary">

		<?php dynamic_sidebar( 'common_sidebar' ); ?>

	</section> <!-- #secondary -->

	<?php
endif;
