$(document).ready(function(){
  // User Authenticated
  $("#loggedin-button").bind("click", function(){
    slideLeft("#login-dropdown");
  });
  $("#login-dropdown").parent().bind("mouseleave", function(){
    fadeOut("#login-dropdown");
  });

  $('.slider-nav').slick({
    infinite: true,
   slidesToShow: 5,
   slidesToScroll: 5
  });

  $('.slick-arrow').addClass('slider-button btn-floating btn-large waves-effect waves-light grey darken-1');
  $('.slick-prev').html('<i class="material-icons">chevron_left</i>');
  $('.slick-next').html('<i class="material-icons">chevron_right</i>');

})
