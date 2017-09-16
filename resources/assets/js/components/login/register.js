$(document).ready(function(){
  let registerClose = document.getElementsByClassName('msform-close');
  let registerInput = document.getElementsByClassName('register-input');

  for (i = 0; i < registerClose.length; i++){
    $(registerClose[i]).click(function(){
      $("#dark-overlay").addClass('hidden');
      $("#msform").addClass('hidden');
      if (i == registerClose.length) {
        for (j = 0; j < registerInput.length; j++){
          $(registerInput[j]).val('');
        }
      }
    })
  }

})
