function validEmail(userEmail){
  var isEmail = 0;
  for (i = 0; i <=userEmail.length; i++){
      if (userEmail.slice(0,1) != "@"){
          if (userEmail.slice(i, i+1) == "@") {
              isEmail += 1;
          } else if (userEmail.slice(i, i+1) == "."){
          	if (userEmail.slice(i-1, i) != "@"){
      	       isEmail *= 2;
            };
          };
      };
      if (userEmail.slice(i , i+1) == " "){
        return false;
      }
  };
  if (isEmail >= 2) {
    return true;
  } else {
   return false;
 }
}

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
    $("#login-email").removeClass('ds-form-error');
    $("#login-email-err").removeClass('ds-show-errmsg');
    $("#login-pass").removeClass('ds-form-error');
    $("#login-pass-err").removeClass('ds-show-errmsg');
    $("#login-pass").removeClass('pass-bullets');
    $("#login-details-err").addClass('hidden');
    $("#login-email").val("");
    $("#login-pass").val("");
    emailAttempt = 0;
    passAttempt = 0;
  }

  $("#login-close").click(function(){
    hideLoginForm()
  })
  // Attempt to login
  $("#login-attempt").click(function(){
    var emailBool = validEmail($("#login-email").val());
    if (emailBool == false) {
      emailAttempt = 1;
      $("#login-email-err").addClass('ds-show-errmsg');
      $("#login-email").addClass('ds-form-error');
    }
    if ($("#login-pass").val() == "") {
      passAttempt = 1;
      $("#login-pass-err").addClass('ds-show-errmsg');
      $("#login-pass").addClass('ds-form-error');
    }
    if (emailBool == true && $("#login-pass").val() != "" ) {
      $("#dark-overlay").removeClass('hidden');
      $("#login-loader").removeClass('hidden');
      setTimeout(function(){
        if ($("#login-email").val() == "jjvannatta88@gmail.com" &&
          $("#login-pass").val() == "Quasar88") {
            alert("You did stuffs");
            $('#login-details-err').addClass('hidden');
          } else {
            $("#dark-overlay").addClass('hidden');
            $("#login-loader").addClass('hidden');
            $('#login-details-err').removeClass('hidden');
          }
        }, 2000);
      }
  })

  // Validate user login email
  $("#login-email").keyup(function(){
    $('#login-details-err').addClass('hidden');
    if (emailAttempt == 1) {
      var emailBool = validEmail($("#login-email").val());
      if (emailBool == false) {
         $("#login-email").addClass('ds-form-error');
         $("#login-email-err").addClass('ds-show-errmsg');
      } else {
        $("#login-email").removeClass('ds-form-error');
        $("#login-email-err").removeClass('ds-show-errmsg');
      }
    }
  })

  // Validate user login password
  $("#login-pass").keyup(function(){
    $('#login-details-err').addClass('hidden');
    if (passAttempt == 1) {
        if ($("#login-pass").val() == "") {
          $("#login-pass").addClass('ds-form-error');
          $("#login-pass-err").addClass('ds-show-errmsg');
       } else {
         $("#login-pass").removeClass('ds-form-error');
         $("#login-pass-err").removeClass('ds-show-errmsg');
      }
    }
    if ($("#login-pass").val() == "") {
      $("#login-pass").removeClass('pass-bullets');
    } else {
      $("#login-pass").addClass('pass-bullets');
    }
  })

  // Display reset password box
  $("#login-pwreset").click(function(){
    $("#dark-overlay").removeClass('hidden');
    $("#overlay-public-pwreset").removeClass('hidden');
  })

  // Display registration box
  $("#login-register").click(function(){
      hideLoginForm();
    $("#dark-overlay").removeClass('hidden');
    $("#msform").removeClass('hidden');
  })

  // Send password reset email

  let resetEmailAttempt = 0;
  $("#pwreset-confirm").click(function(){
    var emailBool = validEmail($("#pwreset-email").val());
    if (emailBool == false) {
       $("#pwreset-email").addClass('ds-form-error');
       $("#pwreset-email-err").addClass('ds-show-errmsg');
       resetEmailAttempt = 1;
    } else {
      // Send email function / display message
      $("#pwreset-email").removeClass('ds-form-error');
      $("#pwreset-email-err").removeClass('ds-show-errmsg');
      $("#overlay-public-pwreset").addClass('hidden');
      $("#pwreset-email").val('');
      $("#pwreset-loader").removeClass('hidden');
      setTimeout(function(){
          $("#pwreset-loader").addClass('hidden');
          $("#pwreset-success").removeClass('hidden');
      }, 2000);
    }
  })

  // Validate reset email

  $("#pwreset-email").keyup(function(){
    if (resetEmailAttempt == 1) {
      var emailBool = validEmail($("#pwreset-email").val());
      if (emailBool == false) {
         $("#pwreset-email").addClass('ds-form-error');
         $("#pwreset-email-err").addClass('ds-show-errmsg');
      } else {
        $("#pwreset-email").removeClass('ds-form-error');
        $("#pwreset-email-err").removeClass('ds-show-errmsg');
      }
    }
  })

  // Close reset password box
  $("#pwreset-cancel").click(function(){
    $("#dark-overlay").addClass('hidden');
    $("#overlay-public-pwreset").addClass('hidden');
  })

  // Close pw success box
  $("#pwreset-success-close").click(function(){
    $("#dark-overlay").addClass('hidden');
    $("#pwreset-success").addClass('hidden');
  })
  $("#pwreset-success-button").click(function(){
    $("#dark-overlay").addClass('hidden');
    $("#pwreset-success").addClass('hidden');
  })

})
