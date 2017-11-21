$(document).ready(function(){
  // Activate login button behavior
  $("#loggedin-button").bind("click", function(){
    slideLeft("#login-dropdown");
  });
  $("#login-dropdown").parent().bind("mouseleave", function(){
    fadeOut("#login-dropdown");
  });

  // Activate date pcker behavior
  bindUploads();
  $('#group-depart').datepicker({
          uiLibrary: 'bootstrap4',
          iconsLibrary: 'fontawesome'
      });
  $('#group-return').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome'
    });

  // Initiate groups progress bars
  if ($(".progress-bar-fg").length) {
    let pBars = document.getElementsByClassName('progress-bar-fg');
    let pStats = document.getElementsByClassName('progress-bar-stat');
    for (let i = 0; i < pBars.length; i++){
      let barX = $(pStats[i]).html();
      pBars[i].style.width = barX;
    }
  }

  // Account & traveler Helper modal behavior
  if ($(".show-account-user").length) {
    $(document).mouseup(function(e)
    {
        let container = $(".admin-helper-modal");
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

  // Overflow hidden container -> fixed helper modal behavior
  $(document).scroll(function(){
    let helper = $(this).find('.show-account-user.active .fix-helper');
    if (helper.length) {
      helper.css('top', helper.parent().offset().top - $(window).scrollTop() - 25);
    }
  })

  // All payment form behavior
if ($("#payment-show-app").length){
    // Initialize chart
    initAnalyiticsChart();

    // Set chart cookie state & set status
    let aState = (readCookie('aState') !== null) ? readCookie('aState') : '';
    let cState = (aState == '') ? '+' : '-' ;
    $("#analytics-controller").html(cState)
    $("#admin-payment-analytics").addClass(aState);

    // Control status on click
    $("#analytics-controller").click(function(){
      $("#admin-payment-analytics").removeClass('static');
      if (aState != 'expanded') {
        aState = 'expanded';
        cState = '-';
        initAnalyiticsChart();
      } else {
        aState = '';
        cState = '+';
      }
      $("#admin-payment-analytics").toggleClass('expanded');
      createCookie('aState', aState, 2);
      $(this).html(cState);
    })

    // Listen for 'enter' on page and search
    $(document).keydown(function(event){
      if (event.keyCode == 13) {
        let datefrom = $("#date-begin").val();
        let dateto = $("#date-end").val();
        let searchterm = $("#admin-search").val();
        let query = "?datefrom=" + datefrom + "&dateto=" + dateto + "&search=" + searchterm;
        window.location = '/admin/' + authAdmin + '/payments/1' + query;
      }
    })
  }

  // Behavior for split-panel features
  if ($(".split-panel-link").length){
      // Set link bar position to active link
      function splitPanelActive(){
        let iPosX =  $(".split-panel-link.active").position().left - $('.split-panel-nav').position().left;
        let iFocusX = $(".split-panel-link.active").outerWidth();

        $('#group-nav-focus').css('left', iPosX + 'px');
        $('#group-nav-focus').css('width', iFocusX + 'px');
      }
      setTimeout(function(){splitPanelActive()}, 100);
      // Set link bar position to hovered link
      $(".split-panel-link").mouseover(function(){
        let posX =  $(this).position().left - $('.split-panel-nav').position().left;
        let focusX = $(this).outerWidth();

        $('#group-nav-focus').css('left', posX + 'px');
        $('#group-nav-focus').css('width', focusX + 'px');
      });
      // Return link bar position to active link
      $(".split-panel-link").mouseleave(function(){
        splitPanelActive();
      });

      // Icon select container
      $(".gfocus-icon-container").mouseover(function(){
        $("#gfocus-icon-show").removeClass('hidden');
      })
      $(".gfocus-icon-container").mouseleave(function(){
        $("#gfocus-icon-show").addClass('hidden');
      })
  }
});

// File upload behavior
function bindUploads(){

  $(document).on('change', ':file', function() {
    let input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          let input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) ;
          }

      });
  });

};

// Create, read, erase cookies
function createCookie(name,value,days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for(let i=0;i < ca.length;i++) {
        let c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

function initAnalyiticsChart(){
  let paymentCfg = {
      type: 'doughnut',
      data: {
          datasets: [{
              data: [
  							analyticsChart.credit,
  							analyticsChart.paypal,
                analyticsChart.check
              ],
              backgroundColor: [
  							"#559dad",
                "#6fc99d",
                "#cb9853",
              ],
              label: 'Total revenue',
  						pointHoverBackgroundColor: "#73b8c4",
          }],
          labels: [
  				  "Credit",
            "Paypal",
            "Check"
          ]
      },
      options: {
  			tooltips: {
  						 enabled: true,
  						 mode: 'single',
  				 },
  				cutoutPercentage: 66,
          responsive: true,
          legend: {
  						display: false,
              position: 'bottom',
          },
          title: {
              display: false,
              text: 'Total revenue'
          },
          animation: {
              animateScale: false,
              animateRotate: true
          }
      }
  };
  let paymentCtx = document.getElementById("panalytics-chart").getContext('2d');
  window.paymentSnapshot = new Chart(paymentCtx, paymentCfg);
  $("#panalytics-chart").addClass('absolute');
}
