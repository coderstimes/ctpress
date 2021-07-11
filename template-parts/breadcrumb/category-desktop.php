<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
$category = get_queried_object();
?>

<nav class="navbar navbar-default navbar-subcat hidden-sm hidden-xs mt-3">
   <div class="container no-padding">
      <div class="no-padding" id="navbar-menu">
         <ul class="nav navbar-nav navbar-left">
            <li class="cat_name">
                <a href="<?php echo get_category_link($category->cat_ID);?>"><?php echo $category->name;?></a>
            </li>            
         </ul>
      </div>
   </div>
</nav>
<div class="clearFix"></div>

