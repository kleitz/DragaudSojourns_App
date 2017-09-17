$(document).ready(function(){

  let emailAttempt = 0;
  let passAttempt = 0;
  // Display login button & login form
  $("#login-button").click(function(){
    $(this).addClass('login-button-active');
    $('#login-modal').addClass('login-modal-reveal');
  });
  // Close login form

  function hideLoginForm(){
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
  $("#login-attempt").click(function(){
    let checkValid = validator.isValid([
      {elem: 'login-email', type: 'email'},
      {elem: 'login-pass', type: 'pass'}
    ]);
    checkValid;
    if (checkValid == true) {
      fadeIn("#dark-overlay");
      slideLeft("#login-loader");
      $('#login-details-err').addClass('hidden');
      setTimeout(function(){
        if ($("#login-email").val() != "jjvannatta88@gmail.com" &&
          $("#login-pass").val() != "Quasar88") {
            fadeOut("#dark-overlay");
            zoomOut("#login-loader");
            $('#login-details-err').removeClass('hidden');
          }
        }, 2000);
      } else {
        for (i = 0; i < checkValid.length; i++) {
          if (checkValid[i] == 'login-email') emailAttempt = 1;
          if (checkValid[i] == 'login-pass') passAttempt = 1;
        }
      }
  })

  // Validate user login email
  $("#login-email").keyup(function(){
    $('#login-details-err').addClass('hidden');
    if (emailAttempt == 1) {
      validator.isValid([{elem: 'login-email', type: 'email'}]);
    }
  })

  // Validate user login password
  $("#login-pass").keyup(function(){
    $('#login-details-err').addClass('hidden');
    if (passAttempt == 1) {
      validator.isValid([{elem: 'login-pass', type: 'pass'}]);
    }
    validator.passFormat('login-pass');
  })

  // Display reset password box
  $("#login-pwreset").click(function(){
    hideLoginForm();
    fadeIn('#dark-overlay');
    zoomIn("#overlay-public-pwreset");
  })

  // Display registration box
  $("#login-register").click(function(){
      validator.passFormat('reg-new-pass');
      validator.passFormat('reg-pass-confirm');
      hideLoginForm();
      fadeIn("#dark-overlay");
      zoomIn("#msform");
  })

  // Send password reset email
  let resetEmailAttempt = 0;
  $("#pwreset-confirm").click(function(){
    var emailBool = validator.isValid([{'elem':'pwreset-email', 'type': 'email'}]);
    if (emailBool == true) {
      validator.hideError(['pwreset-email']);
      zoomOut("#overlay-public-pwreset");
      $("#pwreset-email").val('');
      slideLeft("#pwreset-loader");
      setTimeout(function(){
          zoomOut("#pwreset-loader");
          slideLeft("#pwreset-success");
      }, 3000);
    } else {
      resetEmailAttempt = 1;
    }
  })

  // Validate reset email
  $("#pwreset-email").keyup(function(){
    if (resetEmailAttempt == 1) {
      validator.isValid([{elem: 'pwreset-email', type: 'email'}]);
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
  })

  // Close pw success box
  $("#pwreset-success-close").click(function(){
    fadeOut("#dark-overlay");
    zoomOut("#pwreset-success");
  })
  $("#pwreset-success-button").click(function(){
    fadeOut("#dark-overlay");
    zoomOut("#pwreset-success");
  })

})
