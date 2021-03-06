$(document).ready(function(){

  let emailAttempt = 0;
  let passAttempt = 0;
  // Display login button & login form
  $("#login-button").click(function(){
    setTimeout(function(){
      $("#login-email").focus();
    }, 300);
    $(this).addClass('login-button-active');
    $('#login-modal').addClass('login-modal-reveal');
  });
  // Close login form

  function hideLoginForm(){
    $("#login-email").blur();
    $("#login-button").removeClass('login-button-active');
    $('#login-modal').removeClass('login-modal-reveal');
    $("#login-pass").removeClass('pass-bullets');
    $("#login-details-err").addClass('hidden');
    validator.hideError(['login-email', 'login-pass']);
    validator.clearInputs(['login-email', 'login-pass']);
    emailAttempt = 0;
    passAttempt = 0;
  }

  $("#login-close").click(function(){
    hideLoginForm()
  })
  // Attempt to login
  function attemptLogin(){
    let loginEmail = $("#login-email").val();
    let loginPass = $("#login-pass").val();

    let checkValid = validator.isValid([
      {elem: 'login-email', type: 'email'},
      {elem: 'login-pass', type: 'pass'}
    ]);
    checkValid;

    if (checkValid == true) {
      $("#login-email").blur();
      $("#login-pass").blur();
      fadeIn("#dark-overlay");
      slideLeft("#login-loader");
      $('#login-details-err').addClass('hidden');
      $.ajax({
        type: "POST",
        url: '/login',
        data: { email: loginEmail, password: loginPass},
        success: function(response){
            $("#login-success-button").attr('href', '/profile/' + loginEmail);
            if (response== "VALID") {
              setTimeout(function(){
                fadeOut("#login-loader");
                slideLeft("#login-success");
              },2000);
            } else if (response== "INVALID") {
              setTimeout(function(){
                fadeOut("#dark-overlay");
                zoomOut("#login-loader");
                $('#login-details-err').removeClass('hidden');
              },2000);
            }
        },
        error: function (request, status, error) {
          console.log(request.responseText);
        }
      });
      } else {
        for (i = 0; i < checkValid.length; i++) {
          if (checkValid[i] == 'login-email') emailAttempt = 1;
          if (checkValid[i] == 'login-pass') passAttempt = 1;
        }
      }
  }

  $("#login-attempt").click(function(){
    attemptLogin();
  });

  $("#login-modal").keypress(function(event){
    if ( event.which == 13 ) {
      attemptLogin();
    }
  });


  // Validate user login email after failure
  $("#login-email").keyup(function(){
    $('#login-details-err').addClass('hidden');
    if (emailAttempt == 1) {
      validator.isValid([{elem: 'login-email', type: 'email'}]);
    }
  })

  // Validate user login password after failure
  $("#login-pass").keyup(function(){
    $('#login-details-err').addClass('hidden');
    if (passAttempt == 1) {
      validator.isValid([{elem: 'login-pass', type: 'pass'}]);
    }
    formatter.passFormat('login-pass');
  })

  // Display reset password box
  $("#login-pwreset").click(function(){
    hideLoginForm();
    fadeIn('#dark-overlay');
    zoomIn("#overlay-public-pwreset");
  })

  // Display registration box
  $("#login-register").click(function(){
      formatter.passFormat('reg-new-pass');
      formatter.passFormat('reg-pass-confirm');
      hideLoginForm();
      resetRegistration();
      fadeIn("#dark-overlay");
      zoomIn("#msform");
  })

  function resetEmailExists(){
    $.ajax({
      type: "GET",
      url: '/precheck',
      data: {email: resEmail.val()},
      success: function(response){
          if (response === "OPEN"){
            $("#pwreset-exists").removeClass('hidden');
            resEmail.addClass('input-add-errparent');
          } else {
            $("#pwreset-exists").addClass('hidden');
            resEmail.removeClass('input-add-errparent');
          }
      }
    });
  }

  // Send password reset email
  let resEmail = $("#pwreset-email");
  let resetEmailAttempt = 0;
  $("#pwreset-confirm").click(function(){
    let emailBool = validator.isValid([{'elem':'pwreset-email', 'type': 'email'}]);
    if (emailBool == true) {
      validator.hideError(['pwreset-email']);
      $("#pwreset-confirm, #pwreset-cancel").addClass('button-locked');
      $.ajax({
        type: "GET",
        url: '/precheck',
        data: {email: resEmail.val()},
        success: function(response){
            if (response === "OPEN"){
              $("#pwreset-exists").removeClass('hidden');
              resEmail.addClass('input-add-errparent');
              resetEmailAttempt = 1;
              $("#pwreset-confirm, #pwreset-cancel").removeClass('button-locked');
            } else {
              $("#pwreset-exists").addClass('hidden');
              resEmail.removeClass('input-add-errparent');
              $.ajax({
                type: "POST",
                url: '/user/password/email',
                data: {email: resEmail.val()},
                success: function(response){
                  zoomOut("#overlay-public-pwreset");
                  $("#pwreset-email").val('');
                  slideLeft("#pwreset-loader");
                  setTimeout(function(){
                      zoomOut("#pwreset-loader");
                      slideLeft("#pwreset-success");
                      $("#pwreset-confirm, #pwreset-cancel").removeClass('button-locked');
                  }, 2000);
                }
              });
            }
        }
      });
    } else {
      resetEmailAttempt = 1;
    }
  })

  // Validate reset email
  $("#pwreset-email").keyup(function(){
    if (resetEmailAttempt == 1) {
      let check = validator.isValid([{elem: 'pwreset-email', type: 'email'}])
      if (check == true) {
        resetEmailExists();
      } else {
          $("#pwreset-exists").addClass('hidden');
          resEmail.removeClass('input-add-errparent');
      }
    }
  })

  // Close reset password box
  $("#pwreset-cancel").click(function(){
    // $("#dark-overlay").addClass('hidden');
    zoomOut("#overlay-public-pwreset");
    fadeOut("#dark-overlay");
    validator.clearInputs(['pwreset-email']);
    validator.hideError(['pwreset-email']);
    resetEmailAttempt = 0;
    resetEmailX = false;
  })

  // Close pw success box
  $("#pwreset-success-close, #pwreset-success-button").click(function(){
    fadeOut("#dark-overlay");
    zoomOut("#pwreset-success");
  })

  // User Authenticated
  $("#loggedin-button").bind("click", function(){
    slideLeft("#login-dropdown");
  });
  $("#login-dropdown").parent().bind("mouseleave", function(){
    fadeOut("#login-dropdown");
  });

  // User Logged In
  $("#login-success-close").attr("href", window.location);

})
