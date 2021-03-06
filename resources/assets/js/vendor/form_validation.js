// CLASS BASED AUTO FORMATTING

$(document).ready(function(){
  bindFormatters();
});

function bindFormatters(){
  $(".numbers-only").keypress(function(){
    return event.charCode >=48 && event.charCode <= 57;
  })
  $(".floats-only").keypress(function(){
    return (event.charCode >=48 && event.charCode <= 57) || event.charCode == 46;
  })
  $('.phone-format').mask('(000)000-0000');
  $('.credit-format').mask('0000-0000-0000-0000-000');
  $('.fulldate-format').mask('00/00/0000');
  $('.fulldate-format').keyup(function(){
    if ($(this).val().length > 10) return false;
  })
  $('.date-format').bind('blur', function(){
    let num = '00000' + $(this).val().toString();
    if ($(this).val() == "" || $(this).val() < 1) num = "";
    $(this).val(num.slice(-2));
  })
  $(".zip-format").keyup(function(){
    zipData($(this));
  })
  $('.pass-format').bind('keyup click', function(){
    $(this).attr('type', 'password');
    if ($(this).val() != ""){
      $(this).addClass('pass-bullets');
    } else {
      $(this).removeClass('pass-bullets');
    }
  });
  $('.currency-format').bind('blur change', function(){
    let str = $(this).val();
    currArr = str.split('.');
    correct = currArr[0];
    if (currArr.length > 1)
      correct = currArr[0] + '.' + currArr[1];
    $(this).val(formatCurrency(correct));
  })
  $('.pass-reveal').bind('mouseenter click focus', function(){
    $(this).parent().children('.form-control').removeClass('pass-format');
    $(this).parent().children('.form-control').attr('type', 'text');
  });
  $('.pass-reveal').bind('mouseleave blur', function(){
    $(this).parent().children('.form-control').addClass('pass-format');
    $(this).parent().children('.form-control').attr('type', 'password');
  });
  var zipElems = document.getElementsByClassName('zip-format');
  for (let i = 0; i < zipElems.length; i++){
    let el = zipElems[i];
    zipData($(el));
  };
  $('.material-input').focus(function(){
    $(this).parent().children('.material-label').addClass('material-label-focus active');
  });
  $('.material-input').blur(function(){
    $(this).parent().children('.material-label').removeClass('active');
    if ($(this).val() == ""){
      $(this).parent().children('.material-label').removeClass('material-label-focus');
    }
  })
  $('.ds-button').click(function(){
    if ($('.material-input').val() == ""){
      $('.material-input').parent().children('.material-label').removeClass('material-label-focus');
    }
  })
}

function formatCurrency(val){
  return parseFloat(Math.round(val * 100) / 100).toFixed(2);
}

function toTitleCase(txt)
{
    return txt.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
// Fill zip data

function zipData(elem){
  str = elem.val();
  fill = elem.parent().children('.zip-autofill');
  var reg = /^[0-9]{0,5}$/;
  if (!reg.test(str))
    elem.val(str.slice(0, 5));
  if (str.length == 5) {
    fillZipData(str, fill);
  } else if (str.length < 5) {
    fill.html('');
  }
}

// INPUT FORMATTER CLASS
function InputFormatter() {
  this.passFormat = function(elem){
    if ($("#" + elem).val() == "") {
      $("#"  + elem).removeClass('pass-bullets');
    } else {
      $("#" + elem).addClass('pass-bullets');
    }
  }
}

let formatter = new InputFormatter();

// Styles payment amount into $0.00 format
function amtFloat(){
  if (!isNaN(paymentAmt.value) && paymentAmt.value != "") {
     paymentAmt.value = "$" + parseFloat(paymentAmt.value).toFixed(2);
  } else {
     paymentAmt.value = "";
     paymentAmt.className = "";
     paymentAmt.placeholder = "$0.00";
  }
};
// Styles card into xxxx-xxxx-xxxx-xxxx format
function formatCard(x){
    var ccArr = creditNum.value.split('-'),
    	start = x.selectionStart;

    	ccArr = ccArr.join('');
    	ccArr = ccArr.split('');

    for (i = 0; i <= ccArr.length-1; i++){
    	if (i == 4 || i == 9 || i == 14){
        	if (ccArr[i] != "-"){
            	ccArr.splice(i, 0, "-");
            } else {
            	continue;
            };
        };
    };
    creditNum.value = ccArr.slice(0,19).join('');
    if (start < creditNum.value.length-1){
    	x.setSelectionRange(start, start);
    };
};

// Verifies if input is a number & allows only numerical input
function isNumber(evt, id) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 45 || charCode > 57)) {
        return false;
    };
    if (id == "payment-amount"){
    	if (charCode == 47 || charCode == 45){
    		return false;
    	};
    } else if (id == "credit-cvcode" || id=="credit-num"){
    	if (charCode == 47 || charCode == 46 || charCode == 45){
    		return false;
    	};
    };
    return true;
};

// Check credit card validity via Luhn algorithm check
function checkCard(userInput){
	var backwards = "";
	var multiplyx2 = "";
	var total = 0;
	for(i = userInput.length-2; i >= 0; i-=2){
		backwards += userInput.charAt(i);
	}
	for(i = 0; i < backwards.length; i++){
		multiplyx2 += backwards.charAt(i)*2;
	}
	for(i = 0; i < multiplyx2.length; i++){
		total += parseInt(multiplyx2.charAt(i));
	}
	for(i = userInput.length-3; i >= 0; i-=2){
		total += parseInt(userInput.charAt(i));
	}
	total += parseInt(userInput.charAt(userInput.length-1))
	if((total % 10) == 0 && creditNum.value.length > 10){
		return true;
	}
};

// Get's cc payment method, eg. visa, mc, amex, discover
function getMethod(input){
    var number = input.toString();
    var re = new RegExp("^4");
    if (number.match(re) != null){ return "visa"; }

    re = new RegExp("^5[1-5]");
    if (number.match(re) != null){ return "mastercard"; }

    re = new RegExp("^3[47]");
    if (number.match(re) != null){ return "amex"; }

    re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
    if (number.match(re) != null){ return "discover"; }

    re = new RegExp("^36");
    if (number.match(re) != null) return "diners";

    re = new RegExp("^30[0-5]");
    if (number.match(re) != null) return "diners";

    re = new RegExp("^(3(?:088|096|112|158|337|5(?:2[89]|[3-8][0-9])))");
    if (number.match(re) != null) return "jcb";

    re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
    if (number.match(re) != null) return "visa electron";


    return "";
};

// INPUT VALIDATION BUILDER
function InputValidator() {
  this.isValid = function(obj) {
    let v = [];
    for (let i = 0; i < obj.length; i++) {
      let elV = $('#' + obj[i].elem).val();
      let bool = true;
      switch (obj[i].type) {
        case "email" :
          bool = validEmail(elV);
          break;
        case "pass" :
          bool = validPass(elV);
          break;
        case "strongpass" :
          bool = strongPass(elV);
          break;
        case "string" :
          bool = validString(elV);
          break;
        case "phone" :
          bool = validPhone(elV);
          break;
        case "zip" :
          bool = validZip(elV);
          break;
        case "select" :
          bool = validSelect(elV);
          break;
        case "date" :
          bool = validDate(elV);
          break;
        default:
          bool = false;
          break;
      }
      if (bool == false) {
        this.showError([obj[i].elem]);
        v.push(obj[i].elem);
      } else {
        this.hideError([obj[i].elem]);
      }
    }
    if (v.length > 0){ return v } else { return true };
  }
  this.showError = function(elem) {
    for (let i = 0; i < elem.length; i++){
      $("#" + elem[i]).addClass('ds-form-error');
      $("#" + elem[i]).parent().children('.material-label').addClass('label-err');
      if ($("#" + elem[i] + -"err"))
          $("#" + elem[i] + "-err").addClass('ds-show-errmsg');
    }
  }
  this.hideError = function(elem) {
    for (let i = 0; i < elem.length; i++){
      $("#" + elem[i]).removeClass('ds-form-error');
      $("#" + elem[i]).parent().children('.material-label').removeClass('label-err');
      $("#" + elem[i] + "-err").removeClass('ds-show-errmsg');
    }
  }
  this.clearInputs = function(arr) {
    for (let i = 0; i < arr.length; i++) {
      $('#' + arr[i]).val('');
    }
  }
}

var validator = new InputValidator;

function validEmail(input){
  userEmail = input;
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

function validPass(input) {
  let str = input;
  let spaces = false;
  for (let i = 0; i < str.length; i++) {
    if (str.slice(i, i+1) != ' ') spaces = true;
  }
  if (str != '' && spaces){
    return true
  } else {
    return false;
  }
}

function strongPass(input) {
  let str = input;
  let strong = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
  if (!strong.test(str)) {
    return false;
  } else {
    return true;
  }
}

function validString(input, type) {
    let str = input;

    if (str == undefined || str == "") {
      return false;
    } else {
      return true;
    }
}

function validZip(input) {
  let str = input;
  let regX = /(^\d{5}$)|(^\d{5}-\d{4}$)/;

  if (!regX.test(str)) {
    return false;
  } else {
    return true;
  }
}

function validPhone(input) {
  let num = input;
  if(num.length < 13) {
    return false;
  } else {
    return true;
  }
}

function validSelect(input) {
  let str = input;

  if (!str) {
    return false;
  } else {
    return true;
  }
}

function validDate(input) {
  let num = input;
  let str = num.split('/');
  let now = new Date();
  let mm = str[0];
  let dd = str[1];
  let yy = str[2];
  let yyNow = now.getFullYear();
  if (num.length < 10 || mm > 12 || dd > 31 || yy < 1900 || yy > yyNow) {
    return false;
  } else {
    return true;
  }
}


// CREDIT CARD type
'use strict';

var types = {};
var VISA = 'visa';
var MASTERCARD = 'master-card';
var AMERICAN_EXPRESS = 'american-express';
var DINERS_CLUB = 'diners-club';
var DISCOVER = 'discover';
var JCB = 'jcb';
var UNIONPAY = 'unionpay';
var MAESTRO = 'maestro';
var CVV = 'CVV';
var CID = 'CID';
var CVC = 'CVC';
var CVN = 'CVN';
var testOrder = [
  VISA,
  MASTERCARD,
  AMERICAN_EXPRESS,
  DINERS_CLUB,
  DISCOVER,
  JCB,
  UNIONPAY,
  MAESTRO
];

function clone(x) {
  var prefixPattern, exactPattern, dupe;

  if (!x) { return null; }

  prefixPattern = x.prefixPattern.source;
  exactPattern = x.exactPattern.source;
  dupe = JSON.parse(JSON.stringify(x));
  dupe.prefixPattern = prefixPattern;
  dupe.exactPattern = exactPattern;

  return dupe;
}

types[VISA] = {
  niceType: 'Visa',
  type: VISA,
  prefixPattern: /^4$/,
  exactPattern: /^4\d*$/,
  gaps: [4, 8, 12],
  lengths: [16, 18, 19],
  code: {
    name: CVV,
    size: 3
  }
};

types[MASTERCARD] = {
  niceType: 'MasterCard',
  type: MASTERCARD,
  prefixPattern: /^(5|5[1-5]|2|22|222|222[1-9]|2[3-6]|27|27[0-2]|2720)$/,
  exactPattern: /^(5[1-5]|222[1-9]|2[3-6]|27[0-1]|2720)\d*$/,
  gaps: [4, 8, 12],
  lengths: [16],
  code: {
    name: CVC,
    size: 3
  }
};

types[AMERICAN_EXPRESS] = {
  niceType: 'American Express',
  type: AMERICAN_EXPRESS,
  prefixPattern: /^(3|34|37)$/,
  exactPattern: /^3[47]\d*$/,
  isAmex: true,
  gaps: [4, 10],
  lengths: [15],
  code: {
    name: CID,
    size: 4
  }
};

types[DINERS_CLUB] = {
  niceType: 'Diners Club',
  type: DINERS_CLUB,
  prefixPattern: /^(3|3[0689]|30[0-5])$/,
  exactPattern: /^3(0[0-5]|[689])\d*$/,
  gaps: [4, 10],
  lengths: [14, 16, 19],
  code: {
    name: CVV,
    size: 3
  }
};

types[DISCOVER] = {
  niceType: 'Discover',
  type: DISCOVER,
  prefixPattern: /^(6|60|601|6011|65|64|64[4-9])$/,
  exactPattern: /^(6011|65|64[4-9])\d*$/,
  gaps: [4, 8, 12],
  lengths: [16, 19],
  code: {
    name: CID,
    size: 3
  }
};

types[JCB] = {
  niceType: 'JCB',
  type: JCB,
  prefixPattern: /^(2|21|213|2131|1|18|180|1800|3|35)$/,
  exactPattern: /^(2131|1800|35)\d*$/,
  gaps: [4, 8, 12],
  lengths: [16],
  code: {
    name: CVV,
    size: 3
  }
};

types[UNIONPAY] = {
  niceType: 'UnionPay',
  type: UNIONPAY,
  prefixPattern: /^((6|62|62\d|(621(?!83|88|98|99))|622(?!06)|627[02,06,07]|628(?!0|1)|629[1,2])|622018)$/,
  exactPattern: /^(((620|(621(?!83|88|98|99))|622(?!06|018)|62[3-6]|627[02,06,07]|628(?!0|1)|629[1,2]))\d*|622018\d{12})$/,
  gaps: [4, 8, 12],
  lengths: [16, 17, 18, 19],
  code: {
    name: CVN,
    size: 3
  }
};

types[MAESTRO] = {
  niceType: 'Maestro',
  type: MAESTRO,
  prefixPattern: /^(5|5[06-9]|6\d*)$/,
  exactPattern: /^(5[06-9]|6[37])\d*$/,
  gaps: [4, 8, 12],
  lengths: [12, 13, 14, 15, 16, 17, 18, 19],
  code: {
    name: CVC,
    size: 3
  }
};

function creditCardType(cardNumber) {
  var type, value, i;
  var prefixResults = [];
  var exactResults = [];

  if (!(typeof cardNumber === 'string' || cardNumber instanceof String)) {
    return [];
  }

  for (i = 0; i < testOrder.length; i++) {
    type = testOrder[i];
    value = types[type];

    if (cardNumber.length === 0) {
      prefixResults.push(clone(value));
      continue;
    }

    if (value.exactPattern.test(cardNumber)) {
      exactResults.push(clone(value));
    } else if (value.prefixPattern.test(cardNumber)) {
      prefixResults.push(clone(value));
    }
  }

  return exactResults.length ? exactResults : prefixResults;
}

creditCardType.getTypeInfo = function (type) {
  return clone(types[type]);
};

creditCardType.types = {
  VISA: VISA,
  MASTERCARD: MASTERCARD,
  AMERICAN_EXPRESS: AMERICAN_EXPRESS,
  DINERS_CLUB: DINERS_CLUB,
  DISCOVER: DISCOVER,
  JCB: JCB,
  UNIONPAY: UNIONPAY,
  MAESTRO: MAESTRO
};

// LUHN test
// Check credit card validity via Luhn algorithm check
function luhnValidator(userInput){
	var backwards = "";
	var multiplyx2 = "";
	var total = 0;
	for(i = userInput.length-2; i >= 0; i-=2){
		backwards += userInput.charAt(i);
	}
	for(i = 0; i < backwards.length; i++){
		multiplyx2 += backwards.charAt(i)*2;
	}
	for(i = 0; i < multiplyx2.length; i++){
		total += parseInt(multiplyx2.charAt(i));
	}
	for(i = userInput.length-3; i >= 0; i-=2){
		total += parseInt(userInput.charAt(i));
	}
	total += parseInt(userInput.charAt(userInput.length-1))
	if((total % 10) == 0){
		return true;
	}
  return false;
};
