(function($){

   $(".search_btn").click(function(){
      $(".searchform input").removeClass('d-none');
      if($(".searchform input").val().length>1){
         $("form.searchform").submit();
      }
    });

    $(".searchform input").keydown(function(){
      if ( this.value.length > 2 ) {
         $('.search_btn').attr("type", 'submit');
      } else {
         $('.search_btn').attr("type", 'button');
      }               
    });

   if($('.img-holder .img-caption')[0]){
      $('.img-holder .img-caption').css('width',$(".img-holder img")[0].clientWidth);
   }
   setTimeout(fb_comments_func, false); 
   function fb_comments_func() {
      var fb_comments_count = $(".fb_comments_count");
      fb_comments_count.append( fb_comments_count.text()> 1 ? ' Commments' : ' Comment');
      if ( fb_comments_count.text().length < 1 ) {
         setTimeout(fb_comments_func, 1000);
      }
   }

   $(".menu-item-has-children").click(function(){
      $(".dropdown-menu").removeAttr("data-bs-popper");
   });

   /*single page video show problem solved by removing wp-has-aspect-ratio class*/
   if ($(".is-type-video").hasClass('wp-has-aspect-ratio')) {
      $(".is-type-video").removeClass('wp-has-aspect-ratio');
   }

   
})(jQuery);



