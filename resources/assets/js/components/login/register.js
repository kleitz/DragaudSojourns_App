$(document).ready(function(){
  let registerClose = document.getElementsByClassName('msform-close');
  let registerInput = document.getElementsByClassName('register-input');
  let regArray = ['reg-new-email', 'reg-new-pass', 'reg-pass-confirm',
                  'reg-new-fullname', 'reg-new-phone', 'reg-new-home',
                  'reg-new-street', 'reg-new-zip'];

  // Close registration box
  for (i = 0; i < registerClose.length; i++){
    $(registerClose[i]).click(function(){
      fadeOut("#dark-overlay");
      zoomOut("#msform");
      validator.hideError(regArray);
      validator.clearInputs(regArray);
      regEmailAttempt = 0, regPassAttempt = 0, regMatchAttempt = 0,
      regNameAttempt = 0, regPhoneAttempt = 0, regStreetAttempt = 0,
      regZipAttempt = 0;
    })
  }

  // Initiate form one variables
  let regEmailAttempt = 0,
      regPassAttempt = 0,
      regMatchAttempt = 0;

  // Compare passwords
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
    formatter.passFormat('reg-new-pass');
    if (regPassAttempt == 1) {
      matchPass();
      validator.isValid([{elem: 'reg-new-pass', type: 'strongpass'}]);
    }
  })
  $("#reg-pass-confirm").keyup(function(){
    formatter.passFormat('reg-pass-confirm');
    if (regPassAttempt == 1)
      matchPass();
  })

  // Initiate form two variables
  let regNameAttempt = 0,
      regPhoneAttempt = 0,
      regStreetAttempt = 0,
      regZipAttempt = 0;

  //  Test phone numbers
  function phoneCombo(){
    if ($("#reg-new-phone").val() == '' && $("#reg-new-home").val() == '') {

      $("#reg-new-phone-err").html('Please enter at least one phone number');
      validator.showError(['reg-new-phone']);
      return false;

    } else {
      validator.hideError(['reg-new-phone', 'reg-new-home']);
      let phoneArr = [];
      if ($("#reg-new-phone").val() != '') phoneArr.push({elem: 'reg-new-phone', type: 'phone'});
      if ($("#reg-new-home").val() != '') phoneArr.push({elem: 'reg-new-home', type: 'phone'});
      let checkValid = validator.isValid(phoneArr);

      if (checkValid != true) {
        $("#reg-new-phone-err").html('Please enter a correct phone number');
        $("#reg-new-phone-err").addClass('ds-show-errmsg');
        return false;
      } else {
        return true;
      }
    }
}
  // TRY TO MOVE TO FORM 3
  $("#reg-next-det").click(function(){
    let checkValid = validator.isValid([
      {elem: 'reg-new-fullname', type: 'string'},
      {elem: 'reg-new-street', type: 'string'},
      {elem: 'reg-new-zip', type: 'zip'}
    ])
    checkValid;
    let comboPhone = false;
    if (phoneCombo()) {
      comboPhone = true;
    } else {
      regPhoneAttempt = 1;
    }
    if (checkValid == true && comboPhone == true) {
      nextRegForm("#reg-next-det");
      validator.hideError(['reg-new-fullname', 'reg-new-address', 'reg-new-zip', 'reg-new-phone']);
    } else {
      for (i = 0; i < checkValid.length; i++) {
        if (checkValid[i] == 'reg-new-fullname') regNameAttempt = 1;
        if (checkValid[i] == 'reg-new-street') regStreetAttempt = 1;
        if (checkValid[i] == 'reg-new-zip') regZipAttempt = 1;
      }
    }
  })

  // REGISTRATION FORMATTING: FORM 2
  $('.phone-format').mask('(000)000-0000');
  $("#reg-new-fullname").keyup(function(){
    if (regNameAttempt == 1)
      validator.isValid([{elem: 'reg-new-fullname', type: 'string'}]);
  })
  $('.phone-format').mask('(000)000-0000');
  $('#reg-new-phone, #reg-new-home').keyup(function(){
    if (regPhoneAttempt == 1)
      phoneCombo();

  })
  $("#reg-new-phone").focus(function(){
    if ($("#reg-new-phone").val() == "")
      slideLeft('#new-phone-helper');
  })
  $("#reg-new-phone").blur(function(){
    fadeOut('#new-phone-helper');
  })
  $("#reg-new-street").keyup(function(){
    if (regStreetAttempt == 1)
      validator.isValid([{elem: 'reg-new-street', type: 'string'}]);
  })
  $("#reg-new-zip").keyup(function(){
    str = $("#reg-new-zip").val();
    var reg = /^[0-9]{0,5}$/;
    if (!reg.test(str))
      $("#reg-new-zip").val(str.slice(0, str.length -1));
    if (str.length == 5) {
      getZipData(str, 'reg-zip-autofill');
    } else {
      document.getElementById('reg-zip-autofill').innerHTML = '';
    }
    if (regZipAttempt == 1)
      validator.isValid([{elem: 'reg-new-zip', type: 'zip'}]);
  })

})
