$(document).ready(function(){

  let resEmail = $("#pwreset-email");
  let resetEmailAttempt = 0;
  let passAttempt = 0;

  // Display reset password box
  $("#admin-pwreset").click(function(){
    fadeIn('#dark-overlay');
    zoomIn("#overlay-admin-pwreset");
  })

  function resetEmailExists(){
    $.ajax({
      type: "GET",
      url: '/admin/precheck',
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

  $("#pwreset-confirm").click(function(){
    let emailBool = validator.isValid([{'elem':'pwreset-email', 'type': 'email'}]);
    if (emailBool == true) {
      validator.hideError(['pwreset-email']);
      $("#pwreset-confirm, #pwreset-cancel").addClass('button-locked');
      $.ajax({
        type: "GET",
        url: '/admin/precheck',
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
                url: '/admin/password/email',
                data: {email: resEmail.val()},
                success: function(response){
                  zoomOut("#overlay-admin-pwreset");
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
    zoomOut("#overlay-admin-pwreset");
    fadeOut("#dark-overlay");
    $("#pwreset-exists").addClass('hidden');
    resEmail.removeClass('input-add-errparent');
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

})
