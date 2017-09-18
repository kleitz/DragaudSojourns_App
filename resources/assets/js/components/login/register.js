$(document).ready(function(){
  let registerClose = document.getElementsByClassName('msform-close');
  let registerInput = document.getElementsByClassName('register-input');
  let regArray = ['reg-new-email', 'reg-new-pass', 'reg-pass-confirm'];

  // Close registration box
  for (i = 0; i < registerClose.length; i++){
    $(registerClose[i]).click(function(){
      fadeOut("#dark-overlay");
      zoomOut("#msform");
      validator.hideError(regArray);
      validator.clearInputs(regArray);
    })
  }

  let regEmailAttempt = 0,
      regPassAttempt = 0,
      regMatchAttempt = 0;

  function matchPass(){
    if ($("#reg-new-pass").val() == $("#reg-pass-confirm").val()) {
      validator.hideError(['reg-pass-confirm']);
      return true;
    } else {
      validator.showError(['reg-pass-confirm']);
      return false;
    }
  }

  // TRY TO MOVE TO FORM 2
  $("#reg-next-acct").click(function(){
      let checkValid = validator.isValid([
        {elem: 'reg-new-email', type:  'email'},
        {elem: 'reg-new-pass', type: 'strongpass'}
      ])
      checkValid;
      let passMatch = false;
      if (matchPass()) {
        passMatch = true;
      } else {
        regMatchAttempt = 1;
      }
      if (checkValid == true && passMatch == true) {
        nextRegForm("#reg-next-acct");
        validator.hideError(['reg-new-email', 'reg-new-pass', 'reg-pass-confirm']);
      } else {
        for (i = 0; i < checkValid.length; i++) {
          if (checkValid[i] == 'reg-new-email') regEmailAttempt = 1;
          if (checkValid[i] == 'reg-new-pass') regPassAttempt = 1;
        }
      }
  })

  // REGISTRATION FORMATTING : FORM 1
  $("#reg-new-email").bind("change keyup", function(){
    if (regEmailAttempt == 1) validator.isValid([ {elem: 'reg-new-email', type: 'email'} ]);
  })
  $("#reg-new-pass").focus(function(){
    if ($("#reg-new-pass").val() == "")
      slideLeft('#new-pass-helper');
  })
  $("#reg-new-pass").blur(function(){
    fadeOut('#new-pass-helper');
  })
  $("#reg-new-pass").keyup(function(){
    validator.passFormat('reg-new-pass');
    if (regPassAttempt == 1) {
      matchPass();
      validator.isValid([{elem: 'reg-new-pass', type: 'strongpass'}]);
    }
    if ($("#reg-new-pass").val() != "")
      fadeOut('#new-pass-helper');
  })
  $("#reg-pass-confirm").keyup(function(){
    validator.passFormat('reg-pass-confirm');
    if (regPassAttempt == 1)
      matchPass();
  })
})
