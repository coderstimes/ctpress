<?php
/**
 * Site Branding
 *
 * @version 1.0
 * @package Ctpress
 */
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">

      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb mt-3 w-100">
        <li class="breadcrumb-item"><a href="<?php echo get_home_url(); ?>"> <svg xmlns="http://www.w3.org/2000/svg" fill="#6e7072" viewBox="0 0 16 16" style="width: 22px;"><path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 01-1.5 1.5h-9A1.5 1.5 0 012 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5z"></path><path fill-rule="evenodd" d="M7.293 1.5a1 1 0 011.414 0l6.647 6.646a.5.5 0 01-.708.708L8 2.207 1.354 8.854a.5.5 0 11-.708-.708L7.293 1.5z"></path></svg> </a></li>
        <?php 
          $categories = get_the_category();
          foreach ( $categories as $category ) {
             echo sprintf('<li class="breadcrumb-item" aria-current="page"> <a href="%s">%s</a> </li>', get_category_link( $category->cat_ID ), $category->name );
          }
       ?>
       <li class="breadcrumb-item active"> 
           <?php the_title('<a href="#">','</a>'); ?> 
       </li>
      </ol>
    </nav>
      
    </div>
  </div>
    
 </div> 
 <div class="clearFix"></div>