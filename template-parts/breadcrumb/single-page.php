<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
?>

<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="#"> <i class="fa fa-home"></i>&nbsp; </a></li>
        <?php 
          $categories = get_the_category();
          foreach ( $categories as $category ) {
             echo sprintf('<li class="breadcrumb-item" aria-current="page"> <a href="%s">%s</a> </li>', get_category_link( $category->cat_ID ), $category->name );
          }
       ?>
       <li class="breadcrumb-item active"> 
          <a href="#"> <?php echo the_title(); ?> </a> 
       </li>
      </ol>
    </nav>
 </div>