/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 42);
/******/ })
/************************************************************************/
/******/ ({

/***/ 42:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(43);


/***/ }),

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(44);
__webpack_require__(45);
__webpack_require__(46);

/***/ }),

/***/ 44:
/***/ (function(module, exports) {

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function () {
	if (animating) return false;
	animating = true;

	current_fs = $(this).parent();
	next_fs = $(this).parent().next();

	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show();
	//hide the current fieldset with style
	current_fs.animate({ opacity: 0 }, {
		step: function step(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = now * 50 + "%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({ 'transform': 'scale(' + scale + ')' });
			next_fs.css({ 'left': left, 'opacity': opacity });
		},
		duration: 800,
		complete: function complete() {
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function () {
	if (animating) return false;
	animating = true;

	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();

	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

	//show the previous fieldset
	previous_fs.show();
	//hide the current fieldset with style
	current_fs.animate({ opacity: 0 }, {
		step: function step(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = (1 - now) * 50 + "%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({ 'left': left });
			previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity });
		},
		duration: 800,
		complete: function complete() {
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function () {
	return false;
});

/***/ }),

/***/ 45:
/***/ (function(module, exports) {

function validEmail(userEmail) {
  var isEmail = 0;
  for (i = 0; i <= userEmail.length; i++) {
    if (userEmail.slice(0, 1) != "@") {
      if (userEmail.slice(i, i + 1) == "@") {
        isEmail += 1;
      } else if (userEmail.slice(i, i + 1) == ".") {
        if (userEmail.slice(i - 1, i) != "@") {
          isEmail *= 2;
        };
      };
    };
    if (userEmail.slice(i, i + 1) == " ") {
      return false;
    }
  };
  if (isEmail >= 2) {
    return true;
  } else {
    return false;
  }
}

$(document).ready(function () {
  var emailAttempt = 0;
  var passAttempt = 0;
  // Display login button & login form
  $("#login-button").click(function () {
    $(this).addClass('login-button-active');
    $('#login-modal').addClass('login-modal-reveal');
  });
  // Close login form

  function hideLoginForm() {
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

  $("#login-close").click(function () {
    hideLoginForm();
  });
  // Attempt to login
  $("#login-attempt").click(function () {
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
    if (emailBool == true && $("#login-pass").val() != "") {
      $("#dark-overlay").removeClass('hidden');
      $("#login-loader").removeClass('hidden');
      setTimeout(function () {
        if ($("#login-email").val() == "jjvannatta88@gmail.com" && $("#login-pass").val() == "Quasar88") {
          alert("You did stuffs");
          $('#login-details-err').addClass('hidden');
        } else {
          $("#dark-overlay").addClass('hidden');
          $("#login-loader").addClass('hidden');
          $('#login-details-err').removeClass('hidden');
        }
      }, 2000);
    }
  });

  // Validate user login email
  $("#login-email").keyup(function () {
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
  });

  // Validate user login password
  $("#login-pass").keyup(function () {
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
  });

  // Display reset password box
  $("#login-pwreset").click(function () {
    $("#dark-overlay").removeClass('hidden');
    $("#overlay-public-pwreset").removeClass('hidden');
  });

  // Display registration box
  $("#login-register").click(function () {
    hideLoginForm();
    $("#dark-overlay").removeClass('hidden');
    $("#msform").removeClass('hidden');
  });

  // Send password reset email

  var resetEmailAttempt = 0;
  $("#pwreset-confirm").click(function () {
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
      setTimeout(function () {
        $("#pwreset-loader").addClass('hidden');
        $("#pwreset-success").removeClass('hidden');
      }, 2000);
    }
  });

  // Validate reset email

  $("#pwreset-email").keyup(function () {
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
  });

  // Close reset password box
  $("#pwreset-cancel").click(function () {
    $("#dark-overlay").addClass('hidden');
    $("#overlay-public-pwreset").addClass('hidden');
  });

  // Close pw success box
  $("#pwreset-success-close").click(function () {
    $("#dark-overlay").addClass('hidden');
    $("#pwreset-success").addClass('hidden');
  });
  $("#pwreset-success-button").click(function () {
    $("#dark-overlay").addClass('hidden');
    $("#pwreset-success").addClass('hidden');
  });
});

/***/ }),

/***/ 46:
/***/ (function(module, exports) {

$(document).ready(function () {
  var registerClose = document.getElementsByClassName('msform-close');
  var registerInput = document.getElementsByClassName('register-input');

  for (i = 0; i < registerClose.length; i++) {
    $(registerClose[i]).click(function () {
      $("#dark-overlay").addClass('hidden');
      $("#msform").addClass('hidden');
      if (i == registerClose.length) {
        for (j = 0; j < registerInput.length; j++) {
          $(registerInput[j]).val('');
        }
      }
    });
  }
});

/***/ })

/******/ });