<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
$category = get_queried_object();
?>
<nav class="navbar navbar-default navbar-subcat nav-subcat-mobile">
   <div class="container no-padding">
      <div class="no-padding" id="navbar-menu">
         <ul class="nav navbar-nav navbar-left" data-in="" data-out="">
            <li class="cat_name" style="position: absolute; z-index: 1">
               <a href="<?php echo get_category_link($category->cat_ID);?>"> <?php echo $category->name;?> </a>
            </li>

         </ul>
      </div>
   </div>
</nav>
