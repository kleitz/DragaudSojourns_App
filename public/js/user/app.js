// jQuery Mask Plugin v0.6.0
// github.com/igorescobar/jQuery-Mask-Plugin

(function($){"use strict";var e,oValue,oNewValue,keyCode,pMask;var Mask=function(el,mask,options){var plugin=this,$el=$(el),defaults={byPassKeys:[8,9,37,38,39,40],specialChars:{':':191,'-':189,'.':190,'(':57,')':48,'/':191,',':188,'_':189,' ':32,'+':187},translation:{0:'(.)',1:'(.)',2:'(.)',3:'(.)',4:'(.)',5:'(.)',6:'(.)',7:'(.)',8:'(.)',9:'(.)','A':'(.)','S':'(.)',':':'(:)?','-':'(-)?','.':'(\\\.)?','(':'(\\()?',')':'(\\))?','/':'(/)?',',':'(,)?','_':'(_)?',' ':'(\\s)?','+':'(\\\+)?'}};plugin.settings={};plugin.init=function(){plugin.settings=$.extend({},defaults,options);options=options||{};$el.each(function(){mask=resolveDynamicMask(mask,$(this).val(),e,$(this),options);$el.attr('maxlength',mask.length);$el.attr('autocomplete','off');destroyEvents();setOnKeyUp();setOnPaste();});};plugin.remove=function(){destroyEvents();$el.val(onlyNumbers($el.val()));};var resolveDynamicMask=function(mask,oValue,e,currentField,options){return typeof mask=="function"?mask(oValue,e,currentField,options):mask;};var onlyNumbers=function(string){return string.replace(/\W/g,'');};var onPasteMethod=function(){setTimeout(function(){$el.trigger('keyup');},100);};var setOnPaste=function(){(hasOnSupport())?$el.on("paste",onPasteMethod):$el.onpaste=onPasteMethod;};var setOnKeyUp=function(){$el.keyup(maskBehaviour).trigger('keyup');};var hasOnSupport=function(){return $.isFunction($.on);};var destroyEvents=function(){$el.unbind('keyup').unbind('onpaste');};var maskBehaviour=function(e){e=e||window.event;keyCode=e.keyCode||e.which;if($.inArray(keyCode,plugin.settings.byPassKeys)>=0)
return true;var oCleanedValue=onlyNumbers($el.val());pMask=(typeof options.reverse=="boolean"&&options.reverse===true)?getProportionalReverseMask(oCleanedValue,mask):getProportionalMask(oCleanedValue,mask);oNewValue=applyMask(e,$el,pMask,options);if(oNewValue!==$el.val()){$el.val(oNewValue).trigger('change');}
return seekCallbacks(e,options,oNewValue,mask,$el);};var applyMask=function(e,fieldObject,mask,options){oValue=onlyNumbers(fieldObject.val()).substring(0,onlyNumbers(mask).length);return oValue.replace(new RegExp(maskToRegex(mask)),function(){oNewValue='';for(var i=1;i<arguments.length-2;i++){if(typeof arguments[i]=="undefined"||arguments[i]===""){arguments[i]=mask.charAt(i-1);}
oNewValue+=arguments[i];}
return cleanBullShit(oNewValue,mask);});};var getProportionalMask=function(oValue,mask){var endMask=0,m=0;while(m<=oValue.length-1){while(typeof plugin.settings.specialChars[mask.charAt(endMask)]==="number")
endMask++;endMask++;m++;}
return mask.substring(0,endMask);};var getProportionalReverseMask=function(oValue,mask){var startMask=0,endMask=0,m=0;startMask=(mask.length>=1)?mask.length:mask.length-1;endMask=startMask;while(m<=oValue.length-1){while(typeof plugin.settings.specialChars[mask.charAt(endMask-1)]==="number")
endMask--;endMask--;m++;}
endMask=(mask.length>=1)?endMask:endMask-1;return mask.substring(startMask,endMask);};var maskToRegex=function(mask){var regex='';for(var i=0;i<mask.length;i++){if(plugin.settings.translation[mask.charAt(i)])
regex+=plugin.settings.translation[mask.charAt(i)];}
return regex;};var validDigit=function(nowMask,nowDigit){if(isNaN(parseInt(nowMask,10))===false&&/\d/.test(nowDigit)===false){return false;}else if(nowMask==='A'&&/[a-zA-Z0-9]/.test(nowDigit)===false){return false;}else if(nowMask==='S'&&/[a-zA-Z]/.test(nowDigit)===false){return false;}else if(typeof plugin.settings.specialChars[nowDigit]==="number"&&nowMask!==nowDigit){return false;}
return true;};var cleanBullShit=function(oNewValue,mask){oNewValue=oNewValue.split('');for(var i=0;i<mask.length;i++){if(validDigit(mask.charAt(i),oNewValue[i])===false)
oNewValue[i]='';}
return oNewValue.join('');};var seekCallbacks=function(e,options,oNewValue,mask,currentField){if(options.onKeyPress&&e.isTrigger===undefined&&typeof options.onKeyPress=="function"){options.onKeyPress(oNewValue,e,currentField,options);}
if(options.onComplete&&e.isTrigger===undefined&&oNewValue.length===mask.length&&typeof options.onComplete=="function"){options.onComplete(oNewValue,e,currentField,options);}};plugin.init();};$.fn.mask=function(mask,options){return this.each(function(){$(this).data('mask',new Mask(this,mask,options));});};})(jQuery);

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

  if (str) {
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

/**
 * Bounce.js 0.8.2
 * MIT license
 */
!function(a){if("object"==typeof exports)module.exports=a();else if("function"==typeof define&&define.amd)define(a);else{var b;"undefined"!=typeof window?b=window:"undefined"!=typeof global?b=global:"undefined"!=typeof self&&(b=self),b.Bounce=a()}}(function(){return function a(b,c,d){function e(g,h){if(!c[g]){if(!b[g]){var i="function"==typeof require&&require;if(!h&&i)return i(g,!0);if(f)return f(g,!0);throw new Error("Cannot find module '"+g+"'")}var j=c[g]={exports:{}};b[g][0].call(j.exports,function(a){var c=b[g][1][a];return e(c?c:a)},j,j.exports,a,b,c,d)}return c[g].exports}for(var f="function"==typeof require&&require,g=0;g<d.length;g++)e(d[g]);return e}({1:[function(a,b){var c,d,e;e=a("../math/matrix4d"),d={bounce:a("../easing/bounce"),sway:a("../easing/sway"),hardbounce:a("../easing/hardbounce"),hardsway:a("../easing/hardsway")},c=function(){function a(a){a||(a={}),null!=a.easing&&(this.easing=a.easing),null!=a.duration&&(this.duration=a.duration),null!=a.delay&&(this.delay=a.delay),null!=a.from&&(this.from=a.from),null!=a.to&&(this.to=a.to),this.easingObject=new d[this.easing](a)}return a.prototype.easing="bounce",a.prototype.duration=1e3,a.prototype.delay=0,a.prototype.from=null,a.prototype.to=null,a.prototype.calculateEase=function(a){return this.easingObject.calculate(a)},a.prototype.getMatrix=function(){return(new e).identity()},a.prototype.getEasedMatrix=function(){return this.getMatrix()},a.prototype.serialize=function(){var a,b,c,d;b={type:this.constructor.name.toLowerCase(),easing:this.easing,duration:this.duration,delay:this.delay,from:this.from,to:this.to},d=this.easingObject.serialize();for(a in d)c=d[a],b[a]=c;return b},a}(),b.exports=c},{"../easing/bounce":6,"../easing/hardbounce":7,"../easing/hardsway":8,"../easing/sway":10,"../math/matrix4d":13}],2:[function(a,b){var c,d,e,f,g={}.hasOwnProperty,h=function(a,b){function c(){this.constructor=a}for(var d in b)g.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("../math/matrix4d"),f=a("../math/vector2d"),c=a("./index"),e=function(a){function b(){b.__super__.constructor.apply(this,arguments),this.diff=this.to-this.from}return h(b,a),b.prototype.from=0,b.prototype.to=90,b.prototype.getMatrix=function(a){var b,c,e;return c=a/180*Math.PI,b=Math.cos(c),e=Math.sin(c),new d([b,-e,0,0,e,b,0,0,0,0,1,0,0,0,0,1])},b.prototype.getEasedMatrix=function(a){var b,c;return c=this.calculateEase(a),b=this.from+this.diff*c,this.getMatrix(b)},b}(c),b.exports=e},{"../math/matrix4d":13,"../math/vector2d":14,"./index":1}],3:[function(a,b){var c,d,e,f,g={}.hasOwnProperty,h=function(a,b){function c(){this.constructor=a}for(var d in b)g.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("../math/matrix4d"),f=a("../math/vector2d"),c=a("./index"),e=function(a){function b(){b.__super__.constructor.apply(this,arguments),this.fromVector=new f(this.from.x,this.from.y),this.toVector=new f(this.to.x,this.to.y),this.diff=this.toVector.clone().subtract(this.fromVector)}return h(b,a),b.prototype.from={x:.5,y:.5},b.prototype.to={x:1,y:1},b.prototype.getMatrix=function(a,b){var c;return c=1,new d([a,0,0,0,0,b,0,0,0,0,c,0,0,0,0,1])},b.prototype.getEasedMatrix=function(a){var b,c;return b=this.calculateEase(a),c=this.fromVector.clone().add(this.diff.clone().multiply(b)),this.getMatrix(c.x,c.y)},b}(c),b.exports=e},{"../math/matrix4d":13,"../math/vector2d":14,"./index":1}],4:[function(a,b){var c,d,e,f,g={}.hasOwnProperty,h=function(a,b){function c(){this.constructor=a}for(var d in b)g.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("../math/matrix4d"),f=a("../math/vector2d"),c=a("./index"),e=function(a){function b(){b.__super__.constructor.apply(this,arguments),this.fromVector=new f(this.from.x,this.from.y),this.toVector=new f(this.to.x,this.to.y),this.diff=this.toVector.clone().subtract(this.fromVector)}return h(b,a),b.prototype.from={x:0,y:0},b.prototype.to={x:20,y:0},b.prototype.getMatrix=function(a,b){var c,e,f,g;return c=a/180*Math.PI,e=b/180*Math.PI,f=Math.tan(c),g=Math.tan(e),new d([1,f,0,0,g,1,0,0,0,0,1,0,0,0,0,1])},b.prototype.getEasedMatrix=function(a){var b,c;return b=this.calculateEase(a),c=this.fromVector.clone().add(this.diff.clone().multiply(b)),this.getMatrix(c.x,c.y)},b}(c),b.exports=e},{"../math/matrix4d":13,"../math/vector2d":14,"./index":1}],5:[function(a,b){var c,d,e,f,g={}.hasOwnProperty,h=function(a,b){function c(){this.constructor=a}for(var d in b)g.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("../math/matrix4d"),f=a("../math/vector2d"),c=a("./index"),e=function(a){function b(){b.__super__.constructor.apply(this,arguments),this.fromVector=new f(this.from.x,this.from.y),this.toVector=new f(this.to.x,this.to.y),this.diff=this.toVector.clone().subtract(this.fromVector)}return h(b,a),b.prototype.from={x:0,y:0},b.prototype.to={x:0,y:0},b.prototype.getMatrix=function(a,b){var c;return c=0,new d([1,0,0,a,0,1,0,b,0,0,1,c,0,0,0,1])},b.prototype.getEasedMatrix=function(a){var b,c;return b=this.calculateEase(a),c=this.fromVector.clone().add(this.diff.clone().multiply(b)),this.getMatrix(c.x,c.y)},b}(c),b.exports=e},{"../math/matrix4d":13,"../math/vector2d":14,"./index":1}],6:[function(a,b){var c,d,e={}.hasOwnProperty,f=function(a,b){function c(){this.constructor=a}for(var d in b)e.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("./index"),c=function(a){function b(a){var c;null==a&&(a={}),b.__super__.constructor.apply(this,arguments),null!=a.stiffness&&(this.stiffness=a.stiffness),null!=a.bounces&&(this.bounces=a.bounces),this.alpha=this.stiffness/100,c=.005/Math.pow(10,this.stiffness),this.limit=Math.floor(Math.log(c)/-this.alpha),this.omega=this.calculateOmega(this.bounces,this.limit)}return f(b,a),b.prototype.bounces=4,b.prototype.stiffness=3,b.prototype.calculate=function(a){var b;return a>=1?1:(b=a*this.limit,1-this.exponent(b)*this.oscillation(b))},b.prototype.calculateOmega=function(){return(this.bounces+.5)*Math.PI/this.limit},b.prototype.exponent=function(a){return Math.pow(Math.E,-this.alpha*a)},b.prototype.oscillation=function(a){return Math.cos(this.omega*a)},b.prototype.serialize=function(){return{stiffness:this.stiffness,bounces:this.bounces}},b}(d),b.exports=c},{"./index":9}],7:[function(a,b){var c,d,e={}.hasOwnProperty,f=function(a,b){function c(){this.constructor=a}for(var d in b)e.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};c=a("./bounce"),d=function(a){function b(){return b.__super__.constructor.apply(this,arguments)}return f(b,a),b.prototype.oscillation=function(a){return Math.abs(Math.cos(this.omega*a))},b}(c),b.exports=d},{"./bounce":6}],8:[function(a,b){var c,d,e={}.hasOwnProperty,f=function(a,b){function c(){this.constructor=a}for(var d in b)e.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("./sway"),c=function(a){function b(){return b.__super__.constructor.apply(this,arguments)}return f(b,a),b.prototype.oscillation=function(a){return Math.abs(Math.sin(this.omega*a))},b}(d),b.exports=c},{"./sway":10}],9:[function(a,b){var c,d;d=a("../math/helpers"),c=function(){function a(){}return a.prototype.calculate=function(a){return a},a.prototype.serialize=function(){return{}},a.prototype.findOptimalKeyPoints=function(a,b){var c,e,f,g,h,i,j,k;for(null==a&&(a=1),null==b&&(b=1e3),h=[0],k=function(){var a,c;for(c=[],f=a=0;b>=0?b>a:a>b;f=b>=0?++a:--a)c.push(this.calculate(f/b));return c}.call(this),h=h.concat(d.findTurningPoints(k)),h.push(b-1),f=0,i=1e3;i--&&f!==h.length-1;)c=d.areaBetweenLineAndCurve(k,h[f],h[f+1]),a>=c?f++:(e=Math.round(h[f]+(h[f+1]-h[f])/2),h.splice(f+1,0,e));return 0===i?[]:j=function(){var a,c,d;for(d=[],a=0,c=h.length;c>a;a++)g=h[a],d.push(g/(b-1));return d}()},a}(),b.exports=c},{"../math/helpers":12}],10:[function(a,b){var c,d,e={}.hasOwnProperty,f=function(a,b){function c(){this.constructor=a}for(var d in b)e.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};c=a("./bounce"),d=function(a){function b(){return b.__super__.constructor.apply(this,arguments)}return f(b,a),b.prototype.calculate=function(a){var b;return a>=1?0:(b=a*this.limit,this.exponent(b)*this.oscillation(b))},b.prototype.calculateOmega=function(){return this.bounces*Math.PI/this.limit},b.prototype.oscillation=function(a){return Math.sin(this.omega*a)},b}(c),b.exports=d},{"./bounce":6}],11:[function(a,b){var c,d,e;e=a("./math/matrix4d"),d={scale:a("./components/scale"),rotate:a("./components/rotate"),translate:a("./components/translate"),skew:a("./components/skew")},c=function(){function a(){this.components=[]}return a.FPS=30,a.counter=1,a.prototype.components=null,a.prototype.duration=0,a.prototype.scale=function(a){return this.addComponent(new d.scale(a))},a.prototype.rotate=function(a){return this.addComponent(new d.rotate(a))},a.prototype.translate=function(a){return this.addComponent(new d.translate(a))},a.prototype.skew=function(a){return this.addComponent(new d.skew(a))},a.prototype.addComponent=function(a){return this.components.push(a),this.updateDuration(),this},a.prototype.serialize=function(){var a,b,c,d,e;for(b=[],e=this.components,c=0,d=e.length;d>c;c++)a=e[c],b.push(a.serialize());return b},a.prototype.deserialize=function(a){var b,c,e;for(c=0,e=a.length;e>c;c++)b=a[c],this.addComponent(new d[b.type](b));return this},a.prototype.updateDuration=function(){return this.duration=this.components.map(function(a){return a.duration+a.delay}).reduce(function(a,b){return Math.max(a,b)})},a.prototype.define=function(b){return this.name=b||a.generateName(),this.styleElement=document.createElement("style"),this.styleElement.innerHTML=this.getKeyframeCSS({name:this.name,prefix:!0}),document.body.appendChild(this.styleElement),this},a.prototype.applyTo=function(a,b){var c,d,e,f,g,h,i,j,k,l;for(null==b&&(b={}),this.define(),a.length||(a=[a]),g=this.getPrefixes(),d=null,window.jQuery&&window.jQuery.Deferred&&(d=new window.jQuery.Deferred),h=0,j=a.length;j>h;h++)for(e=a[h],l=g.animation,i=0,k=l.length;k>i;i++)f=l[i],c=[this.name,""+this.duration+"ms","linear","both"],b.loop&&c.push("infinite"),e.style[""+f+"animation"]=c.join(" ");return b.loop||setTimeout(function(a){return function(){return b.remove&&a.remove(),"function"==typeof b.onComplete&&b.onComplete(),d?d.resolve():void 0}}(this),this.duration),d},a.prototype.remove=function(){var a;if(this.styleElement)return this.styleElement.remove?this.styleElement.remove():null!=(a=this.styleElement.parentNode)?a.removeChild(this.styleElement):void 0},a.prototype.getPrefixes=function(a){var b,c;return b={transform:[""],animation:[""]},c=document.createElement("dummy").style,(a||!("transform"in c)&&"webkitTransform"in c)&&(b.transform=["-webkit-",""]),(a||!("animation"in c)&&"webkitAnimation"in c)&&(b.animation=["-webkit-",""]),b},a.prototype.getKeyframeCSS=function(b){var c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t;for(null==b&&(b={}),this.name=b.name||a.generateName(),i={transform:[""],animation:[""]},(b.prefix||b.forcePrefix)&&(i=this.getPrefixes(b.forcePrefix)),e=[],f=this.getKeyframes(b),r=this.keys,l=0,o=r.length;o>l;l++){for(d=r[l],g=f[d],j="matrix3d"+g,k=[],s=i.transform,m=0,p=s.length;p>m;m++)h=s[m],k.push(""+h+"transform: "+j+";");e.push(""+Math.round(100*d*100)/100+"% { "+k.join(" ")+" }")}for(c=[],t=i.animation,n=0,q=t.length;q>n;n++)h=t[n],c.push("@"+h+"keyframes "+this.name+" { \n  "+e.join("\n  ")+" \n}");return c.join("\n\n")},a.prototype.getKeyframes=function(b){var c,d,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v;if(null==b&&(b={}),k=[0,1],b.optimized)for(u=this.components,n=0,r=u.length;r>n;n++)c=u[n],d=c.easingObject.findOptimalKeyPoints().map(function(a){return function(b){return b*c.duration/a.duration+c.delay/a.duration}}(this)),c.delay&&d.push(c.delay/this.duration-.001),k=k.concat(d);else for(g=Math.round(this.duration/1e3*a.FPS),h=o=0;g>=0?g>=o:o>=g;h=g>=0?++o:--o)k.push(h/g);for(k=k.sort(function(a,b){return a-b}),this.keys=[],j={},p=0,s=k.length;s>p;p++)if(i=k[p],!j[i]){for(l=(new e).identity(),v=this.components,q=0,t=v.length;t>q;q++)c=v[q],f=i*this.duration,c.delay-f>1e-8||(m=(i-c.delay/this.duration)/(c.duration/this.duration),l.multiply(c.getEasedMatrix(m)));this.keys.push(i),j[i]=l.transpose().toFixed(3)}return j},a.generateName=function(){return"animation-"+a.counter++},a.isSupported=function(){var a,b,c,d,e,f,g,h,i;for(e=document.createElement("dummy").style,d=[["transform","webkitTransform"],["animation","webkitAnimation"]],f=0,h=d.length;h>f;f++){for(c=d[f],b=!1,g=0,i=c.length;i>g;g++)a=c[g],b||(b=a in e);if(!b)return!1}return!0},a}(),b.exports=c},{"./components/rotate":2,"./components/scale":3,"./components/skew":4,"./components/translate":5,"./math/matrix4d":13}],12:[function(a,b){var c;c=function(){function a(){}return a.prototype.sign=function(a){return 0>a?-1:1},a.prototype.findTurningPoints=function(a){var b,c,d,e,f,g;for(e=[],b=f=1,g=a.length-1;g>=1?g>f:f>g;b=g>=1?++f:--f)c=this.sign(a[b]-a[b-1]),d=this.sign(a[b+1]-a[b]),c!==d&&e.push(b);return e},a.prototype.areaBetweenLineAndCurve=function(a,b,c){var d,e,f,g,h,i,j,k;for(g=c-b,j=a[b],i=a[c],d=0,f=k=0;g>=0?g>=k:k>=g;f=g>=0?++k:--k)e=a[b+f],h=j+f/g*(i-j),d+=Math.abs(h-e);return d},a}(),b.exports=new c},{}],13:[function(a,b){var c;c=function(){function a(a){this._array=(null!=a?a.slice(0):void 0)||[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]}return a.prototype._array=null,a.prototype.equals=function(a){return this.toString()===a.toString()},a.prototype.identity=function(){return this.setArray([1,0,0,0,0,1,0,0,0,0,1,0,0,0,0,1]),this},a.prototype.multiply=function(b){var c,d,e,f,g,h,i,j;for(f=new a,c=h=0;4>h;c=++h)for(d=i=0;4>i;d=++i)for(e=j=0;4>j;e=++j)g=f.get(c,d)+this.get(c,e)*b.get(e,d),f.set(c,d,g);return this.copy(f)},a.prototype.transpose=function(){var a;return a=this.getArray(),this.setArray([a[0],a[4],a[8],a[12],a[1],a[5],a[9],a[13],a[2],a[6],a[10],a[14],a[3],a[7],a[11],a[15]]),this},a.prototype.get=function(a,b){return this.getArray()[4*a+b]},a.prototype.set=function(a,b,c){return this._array[4*a+b]=c},a.prototype.copy=function(a){return this._array=a.getArray(),this},a.prototype.clone=function(){return new a(this.getArray())},a.prototype.getArray=function(){return this._array.slice(0)},a.prototype.setArray=function(a){return this._array=a,this},a.prototype.toString=function(){return"("+this.getArray().join(", ")+")"},a.prototype.toFixed=function(a){var b;return this._array=function(){var c,d,e,f;for(e=this._array,f=[],c=0,d=e.length;d>c;c++)b=e[c],f.push(parseFloat(b.toFixed(a)));return f}.call(this),this},a}(),b.exports=c},{}],14:[function(a,b){var c;c=function(){function a(a,b){this.x=null!=a?a:0,this.y=null!=b?b:0}return a.prototype.x=0,a.prototype.y=0,a.prototype.add=function(b){return a.isVector2D(b)?(this.x+=b.x,this.y+=b.y,this):this._addScalar(b)},a.prototype._addScalar=function(a){return this.x+=a,this.y+=a,this},a.prototype.subtract=function(b){return a.isVector2D(b)?(this.x-=b.x,this.y-=b.y,this):this._subtractScalar(b)},a.prototype._subtractScalar=function(a){return this._addScalar(-a)},a.prototype.multiply=function(b){return a.isVector2D(b)?(this.x*=b.x,this.y*=b.y,this):this._multiplyScalar(b)},a.prototype._multiplyScalar=function(a){return this.x*=a,this.y*=a,this},a.prototype.divide=function(b){return a.isVector2D(b)?(this.x/=b.x,this.y/=b.y,this):this._divideScalar(b)},a.prototype._divideScalar=function(a){return this._multiplyScalar(1/a)},a.prototype.clone=function(){return new a(this.x,this.y)},a.prototype.copy=function(a){return this.x=a.x,this.y=a.y,this},a.prototype.equals=function(a){return a.x===this.x&&a.y===this.y},a.prototype.toString=function(){return"("+this.x+", "+this.y+")"},a.prototype.toFixed=function(a){return this.x=parseFloat(this.x.toFixed(a)),this.y=parseFloat(this.y.toFixed(a)),this},a.prototype.toArray=function(){return[this.x,this.y]},a.isVector2D=function(b){return b instanceof a},a}(),b.exports=c},{}]},{},[11])(11)});
// ELEMENT TRANSITIONS

var zoomMeIn = new Bounce();
zoomMeIn.scale({
    from: {x: 0.5, y: 0.5},
    to: {x: 1, y: 1}
})
zoomMeIn.define('zoomIn');

var zoomMeOut = new Bounce();
zoomMeOut.scale({
    from: {x: 1, y: 1},
    to: {x: 0.5, y: 0.5}
})
zoomMeOut.define('zoomOut');


var slideMeLeft = new Bounce();

slideMeLeft.translate({
  from: { x: 150, y: 0},
  to: {x:0, y: 0},
  duration: 1300,
  stiffness: 4
})
slideMeLeft.define('slideLeft');

function fadeOut(elem){
  $(elem).css('transition', '.2s');
  $(elem).css('opacity', '0');
  setTimeout(function(){
    $(elem).addClass('hidden');
  }, 300);
}

function fadeIn(elem){
  $(elem).removeClass('hidden');
  $(elem).css('transition', '.2s');
  $(elem).css('opacity', '1');
}

function slideLeft(elem) {
  fadeIn(elem);
  slideMeLeft.applyTo($(elem));
}

function zoomIn(elem) {
  zoomMeIn.applyTo($(elem));
  fadeIn(elem);
}

function zoomOut(elem) {
  zoomMeOut.applyTo($(elem));
  fadeOut(elem);
}

// CUSTOM ELEMENTS

// Register traveler controller

function bindTravelerModal(x){
  let elemP = x.parent();
  let elem = elemP.find('.traveler-modal-details');
  let elemC = elemP.find('.traveler-modal-title').outerHeight();
  let elemH = elem.outerHeight();

  if (elemP.hasClass('active')) {
    elemP.removeClass('active');
    elemP.css('max-height', elemC);
    elem.css('bottom', elemH);
    $(x).find('.flex-arrow').removeClass('flex-arrow-minus');
  } else {
    $('.traveler-modal-container').find('.traveler-modal-details').css('bottom', elemH);
    $('.traveler-modal-container').css('max-height', elemC);
    $('.traveler-modal-container').removeClass('active');
    $('.traveler-modal-container').find('.flex-arrow').removeClass('flex-arrow-minus');
    elemP.addClass('active');
    elemP.css('max-height', elemC + elemH + 30);
    elem.css('bottom', '0px');
    $(x).find('.flex-arrow').addClass('flex-arrow-minus');
  }
}

// Accounts traveler controller

function acctTravelerModal(x){
  let elemP = x.parent();
  let elem = elemP.find('.traveler-modal-details');
  let elemC = elemP.find('.traveler-modal-title').outerHeight();
  let elemH = elem.outerHeight();

  if (elemP.hasClass('active')) {
    elemP.removeClass('active');
    elemP.css('max-height', '35px');
    elemP.css('width', '100%');
    elem.css('bottom', elemH);
    $(x).find('.flex-arrow').removeClass('flex-arrow-minus');
  } else {
    $('.traveler-modal-container').find('.traveler-modal-details').css('bottom', elemH + 30);
    $('.traveler-modal-container').css('max-height', elemC);
    $('.traveler-modal-container').css('width', '100%');
    $('.traveler-modal-container').removeClass('active');
    $('.traveler-modal-container').find('.flex-arrow').removeClass('flex-arrow-minus');
    elemP.addClass('active');
    elemP.css('max-height', elemC + elemH + 30);
    elemP.css('width', '110%');
    elem.css('bottom', '0px');
    $(x).find('.flex-arrow').addClass('flex-arrow-minus');
  }
}

// Expander

function openExpander(elem){
    let xP = elem;
    let xH = xP.children(".expander-header");
    let xC = xP.children(".expander-content");

    xP.addClass('expander-open');
    xP.css('max-height', xH.outerHeight());
    xC.css('bottom', xC.outerHeight());
}

function closeExpander(elem){
    let xP = elem;
    let xH = xP.children(".expander-header");
    let xC = xP.children(".expander-content");

    xP.removeClass('expander-open');
    xP.css('max-height', xC.outerHeight() + xH.outerHeight());
    xC.css('bottom', '0px');
}

function expanderController(el){
  let par = $(el).closest('.expander');
  if (par.hasClass("expander-open")) {
    closeExpander(par);
  } else {
    openExpander(par);
  }
}

$(document).ready(function(){
  let expanders = document.getElementsByClassName('expander');

  for (let i = 0; i < expanders.length; i++){
    let xP = $(expanders[i]);
    let xH = xP.children(".expander-header");
    let xC = xP.children(".expander-content");

    (xP.hasClass("expander-open")) ? closeExpander(xP) : openExpander(xP);
  };

  $(".expander-controller").click(function(){
      let par = $(this).closest('.expander');
      if (par.hasClass("expander-open")) {
        closeExpander(par);
      } else {
        openExpander(par);
      }
  });

});

// Linear expander

$(".linear-expander-controller").click(function(){
  $(".linear-expander").removeClass('static');
  $(".linear-expander").toggleClass('expanded');
})

function getZipData(zip, elem){
  var lat;
  var lng;
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'address': zip }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
          geocoder.geocode({'latLng': results[0].geometry.location}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              if (results[1]) {
                  var loc = getCityState(results);
              }
          }
      });
      }
  });

  function getCityState(results)
  {
      var a = results[0].address_components;
      var city, state;
      for(i = 0; i <  a.length; ++i)
      {
         var t = a[i].types;
         if(compIsType(t, 'administrative_area_level_1'))
            state = a[i].long_name; //store the state
         else if(compIsType(t, 'locality'))
            city = a[i].long_name; //store the city
      }
      document.getElementById(elem).innerHTML = city + ', ' + state;
  }

}

function fillZipData(zip, elem){
  var lat;
  var lng;
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'address': zip }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
          geocoder.geocode({'latLng': results[0].geometry.location}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              if (results[1]) {
                  var loc = getCityState(results);
              }
          }
      });
      }
  });

  function getCityState(results)
  {
      var a = results[0].address_components;
      var city, state;
      for(i = 0; i <  a.length; ++i)
      {
         var t = a[i].types;
         if(compIsType(t, 'administrative_area_level_1'))
            state = a[i].long_name; //store the state
         else if(compIsType(t, 'locality'))
            city = a[i].long_name; //store the city
      }
      elem.html(city + ', ' + state);
  }

}


function compIsType(t, s) {
   for(z = 0; z < t.length; ++z)
      if(t[z] == s)
         return true;
   return false;
}

$(document).ready(function(){
  // User Authenticated
  $("#loggedin-button").bind("click", function(){
    slideLeft("#login-dropdown");
  });
  $("#login-dropdown").parent().bind("mouseleave", function(){
    fadeOut("#login-dropdown");
  });

  $('.slider-nav').slick({
    infinite: true,
   slidesToShow: 5,
   slidesToScroll: 5
  });

  $('.slick-arrow').addClass('slider-button btn-floating btn-large waves-effect waves-light grey darken-1');
  $('.slick-prev').html('<i class="material-icons">chevron_left</i>');
  $('.slick-next').html('<i class="material-icons">chevron_right</i>');
});

function tripModalExpand(el){
  let elP = $(el).closest('.trip-modal');
  let min = elP.find('.trip-details-min');
  let max = elP.find('.trip-details-full');
  if ($(el).html() == 'Show details') {
    $('.trip-details-min').removeClass('hidden');
    $('.trip-details-full').addClass('hidden');
    openExpander($('.trip-expander'));
    $('.trip-controller').html('Show details');
    
    $(el).html('Hide details');
    max.removeClass('hidden');
    min.addClass('hidden');
  } else {
    $(el).html('Show details');
    max.addClass('hidden');
    min.removeClass('hidden');
  }
  expanderController(el);
}
