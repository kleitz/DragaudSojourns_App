$(document).ready(function(){
  $("#loggedin-button").bind("click", function(){
    slideLeft("#login-dropdown");
  });
  $("#login-dropdown").parent().bind("mouseleave", function(){
    fadeOut("#login-dropdown");
  });
  bindUploads();
  $('#group-depart').datepicker({
          uiLibrary: 'bootstrap4',
          iconsLibrary: 'fontawesome'
      });
  $('#group-return').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome'
    });

  if ($(".progress-bar-fg").length) {
    let pBars = document.getElementsByClassName('progress-bar-fg');
    let pStats = document.getElementsByClassName('progress-bar-stat');
    for (let i = 0; i < pBars.length; i++){
      let barX = $(pStats[i]).html();
      pBars[i].style.width = barX;
      console.log(barX);
    }
  }

  if ($(".show-account-user").length) {
    $(document).mouseup(function(e)
    {
        var container = $(".admin-helper-modal");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
          $(".show-account-user").removeClass('active');
          $('.admin-helper-modal').addClass('hidden');
        }
    });
    $(".show-account-user").mouseover(function(){
      if (!$(this).hasClass('active')){
        $(".show-account-user").removeClass('active');
        $('.admin-helper-modal').addClass('hidden');
      }
      let modal = $(this).children('.admin-helper-modal');
      let helper = $(this).find('.fix-helper');
      modal.removeClass('hidden');
      helper.css('top', modal.offset().top - $(window).scrollTop() - 25);
      helper.css('left', modal.offset().left + 25);
    });
    $(".show-account-user").mouseleave(function(){
      if (!$(this).hasClass('active'))
      $(this).children('.admin-helper-modal').addClass('hidden');
    });
    $(".show-account-user").click(function(){
      $(".show-account-user").removeClass('active');
      $('.admin-helper-modal').addClass('hidden');
      $(this).addClass('active');
      $(this).children('.admin-helper-modal').removeClass('hidden');
    });
  }

  if ($(".split-panel-link").length){
      function splitPanelActive(){
        let iPosX =  $(".split-panel-link.active").position().left - $('.split-panel-nav').position().left;
        let iFocusX = $(".split-panel-link.active").outerWidth();

        $('#group-nav-focus').css('left', iPosX + 'px');
        $('#group-nav-focus').css('width', iFocusX + 'px');
      }
      setTimeout(function(){splitPanelActive()}, 100);
      $(".split-panel-link").mouseover(function(){
        let posX =  $(this).position().left - $('.split-panel-nav').position().left;
        let focusX = $(this).outerWidth();

        $('#group-nav-focus').css('left', posX + 'px');
        $('#group-nav-focus').css('width', focusX + 'px');
      });

      $(".split-panel-link").mouseleave(function(){
        splitPanelActive();
      });

      $(".gfocus-icon-container").mouseover(function(){
        $("#gfocus-icon-show").removeClass('hidden');
      })
      $(".gfocus-icon-container").mouseleave(function(){
        $("#gfocus-icon-show").addClass('hidden');
      })
  }
});

$(document).scroll(function(){
  let helper = $(this).find('.show-account-user.active .fix-helper');
  if (helper.length) {
    helper.css('top', helper.parent().offset().top - $(window).scrollTop() - 25);
  }
})

function bindUploads(){

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) ;
          }

      });
  });

};
