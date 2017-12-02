$(document).ready(function(){
  // $.ajax({
  //     type: "GET",
  //     url: '/payments/update',
  //     data: { records: 20, start_at: 5},
  //     success: function(data){
  //       let response = JSON.parse(data);
  //       console.log(response);
  //     },
  //     error : function(error){
  //       console.log(error);
  //     }
  // });

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

  if ($('.trip-controller').length) {
    tripModalExpand($('.trip-controller').first());
  }
  if ($('.coordinator-trips-table').length) {
    $(".expander-controller").click(function(){
      if ($(this).html() == 'Show details') {
        $(".expander-controller").html('Show details');
        $(this).html('Hide details');
        openExpander($('.coordinator-expander'));
        expanderController(($(this).parent()));
      } else {
        $(this).html('Show details');
        openExpander($(this));
      }
    });
  }
});

function tripModalExpand(el){
  let elP = $(el).closest('.trip-modal');
  let min = elP.find('.trip-details-min');
  let max = elP.find('.trip-details-full');
  if ($(el).html() == 'Show details') {
    $('.trip-details-min').removeClass('hidden');
    $('.trip-details-full').addClass('hidden');
    openExpander($('.trip-expander'));
    $('.trip-controller').html('Show details');

    $(el).html('Hide details');
    max.removeClass('hidden');
    min.addClass('hidden');
  } else {
    $(el).html('Show details');
    max.addClass('hidden');
    min.removeClass('hidden');
  }
  expanderController(el);
}
