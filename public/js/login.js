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

// Verifies month format (number between 01-12)
function isMonth(evt, x){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    };
    if (x.value == "1" || x.value == "0"){
    	if (x.value == "0"){
        	return true;
        } else if (x.value == "1" && charCode > 50){
        	return false;
        };
    };
    if (x.value != "" && parseInt(x.value) > 1){
    	return false;
    };
};

// Verifies year format (number between )
function isYear(evt, x){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    };
    if (x.value == "1" && charCode < 55){
        return false;
    };
    if (x.value == "" && (charCode > 50 || charCode < 49)){
    	return false;
    };
};

// Clears all placeholder values
function clearPlaceholder(x){
    x.placeholder = "";
};

// Fills & styles placeholder values
function fillPlaceholder(x){
    switch (x.id){
	case "credit-num":
	    x.placeholder="____-____-____-____";
	    break;
	 case "credit-month":
	    if (parseInt(x.value) < 10 && x.value.length < 2){
		 x.value = "0" + x.value;
	    }
            if (parseInt(x.value) < 1) {
                 x.value = "";
            }
	    x.placeholder="- -";
	    break;
	 case "credit-year":
	    if (parseInt(x.value)< 16){
		 x.value = "";
	    }
	    x.placeholder="- -";
	    break;
	 case "credit-cvcode":
	    x.placeholder="- - -"
	    break;
    }
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
      let bool = true;
      switch (obj[i].type) {
        case "email" :
          bool = validEmail(obj[i].elem);
          break;
        case "pass" :
          bool = validPass(obj[i].elem);
          break;
        case "strongpass" :
          bool = strongPass(obj[i].elem);
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
  this.passFormat = function(elem){
    if ($("#" + elem).val() == "") {
      $("#"  + elem).removeClass('pass-bullets');
    } else {
      $("#" + elem).addClass('pass-bullets');
    }
  }
  this.showError = function(elem) {
    for (let i = 0; i < elem.length; i++){
      $("#" + elem[i]).addClass('ds-form-error');
      if ($("#" + elem[i] + -"err"))
          $("#" + elem[i] + "-err").addClass('ds-show-errmsg');
    }
  }
  this.hideError = function(elem) {
    for (let i = 0; i < elem.length; i++){
      $("#" + elem[i]).removeClass('ds-form-error');
      $("#" + elem[i] + "-err").removeClass('ds-show-errmsg');
    }
  }
  this.clearInputs = function(arr) {
    for (let i = 0; i < arr.length; i++) {
      $('#' + arr[i]).val('');
    }
  }
}

let validator = new InputValidator;

function validEmail(input){
  userEmail = $('#' + input).val();
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
  let str = $("#" + input).val();
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
  let str = $("#" + input).val();
  let strong = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
  if (!strong.test(str)) {
    return false;
  } else {
    return true;
  }
}

/**
 * Bounce.js 0.8.2
 * MIT license
 */
!function(a){if("object"==typeof exports)module.exports=a();else if("function"==typeof define&&define.amd)define(a);else{var b;"undefined"!=typeof window?b=window:"undefined"!=typeof global?b=global:"undefined"!=typeof self&&(b=self),b.Bounce=a()}}(function(){return function a(b,c,d){function e(g,h){if(!c[g]){if(!b[g]){var i="function"==typeof require&&require;if(!h&&i)return i(g,!0);if(f)return f(g,!0);throw new Error("Cannot find module '"+g+"'")}var j=c[g]={exports:{}};b[g][0].call(j.exports,function(a){var c=b[g][1][a];return e(c?c:a)},j,j.exports,a,b,c,d)}return c[g].exports}for(var f="function"==typeof require&&require,g=0;g<d.length;g++)e(d[g]);return e}({1:[function(a,b){var c,d,e;e=a("../math/matrix4d"),d={bounce:a("../easing/bounce"),sway:a("../easing/sway"),hardbounce:a("../easing/hardbounce"),hardsway:a("../easing/hardsway")},c=function(){function a(a){a||(a={}),null!=a.easing&&(this.easing=a.easing),null!=a.duration&&(this.duration=a.duration),null!=a.delay&&(this.delay=a.delay),null!=a.from&&(this.from=a.from),null!=a.to&&(this.to=a.to),this.easingObject=new d[this.easing](a)}return a.prototype.easing="bounce",a.prototype.duration=1e3,a.prototype.delay=0,a.prototype.from=null,a.prototype.to=null,a.prototype.calculateEase=function(a){return this.easingObject.calculate(a)},a.prototype.getMatrix=function(){return(new e).identity()},a.prototype.getEasedMatrix=function(){return this.getMatrix()},a.prototype.serialize=function(){var a,b,c,d;b={type:this.constructor.name.toLowerCase(),easing:this.easing,duration:this.duration,delay:this.delay,from:this.from,to:this.to},d=this.easingObject.serialize();for(a in d)c=d[a],b[a]=c;return b},a}(),b.exports=c},{"../easing/bounce":6,"../easing/hardbounce":7,"../easing/hardsway":8,"../easing/sway":10,"../math/matrix4d":13}],2:[function(a,b){var c,d,e,f,g={}.hasOwnProperty,h=function(a,b){function c(){this.constructor=a}for(var d in b)g.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("../math/matrix4d"),f=a("../math/vector2d"),c=a("./index"),e=function(a){function b(){b.__super__.constructor.apply(this,arguments),this.diff=this.to-this.from}return h(b,a),b.prototype.from=0,b.prototype.to=90,b.prototype.getMatrix=function(a){var b,c,e;return c=a/180*Math.PI,b=Math.cos(c),e=Math.sin(c),new d([b,-e,0,0,e,b,0,0,0,0,1,0,0,0,0,1])},b.prototype.getEasedMatrix=function(a){var b,c;return c=this.calculateEase(a),b=this.from+this.diff*c,this.getMatrix(b)},b}(c),b.exports=e},{"../math/matrix4d":13,"../math/vector2d":14,"./index":1}],3:[function(a,b){var c,d,e,f,g={}.hasOwnProperty,h=function(a,b){function c(){this.constructor=a}for(var d in b)g.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("../math/matrix4d"),f=a("../math/vector2d"),c=a("./index"),e=function(a){function b(){b.__super__.constructor.apply(this,arguments),this.fromVector=new f(this.from.x,this.from.y),this.toVector=new f(this.to.x,this.to.y),this.diff=this.toVector.clone().subtract(this.fromVector)}return h(b,a),b.prototype.from={x:.5,y:.5},b.prototype.to={x:1,y:1},b.prototype.getMatrix=function(a,b){var c;return c=1,new d([a,0,0,0,0,b,0,0,0,0,c,0,0,0,0,1])},b.prototype.getEasedMatrix=function(a){var b,c;return b=this.calculateEase(a),c=this.fromVector.clone().add(this.diff.clone().multiply(b)),this.getMatrix(c.x,c.y)},b}(c),b.exports=e},{"../math/matrix4d":13,"../math/vector2d":14,"./index":1}],4:[function(a,b){var c,d,e,f,g={}.hasOwnProperty,h=function(a,b){function c(){this.constructor=a}for(var d in b)g.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("../math/matrix4d"),f=a("../math/vector2d"),c=a("./index"),e=function(a){function b(){b.__super__.constructor.apply(this,arguments),this.fromVector=new f(this.from.x,this.from.y),this.toVector=new f(this.to.x,this.to.y),this.diff=this.toVector.clone().subtract(this.fromVector)}return h(b,a),b.prototype.from={x:0,y:0},b.prototype.to={x:20,y:0},b.prototype.getMatrix=function(a,b){var c,e,f,g;return c=a/180*Math.PI,e=b/180*Math.PI,f=Math.tan(c),g=Math.tan(e),new d([1,f,0,0,g,1,0,0,0,0,1,0,0,0,0,1])},b.prototype.getEasedMatrix=function(a){var b,c;return b=this.calculateEase(a),c=this.fromVector.clone().add(this.diff.clone().multiply(b)),this.getMatrix(c.x,c.y)},b}(c),b.exports=e},{"../math/matrix4d":13,"../math/vector2d":14,"./index":1}],5:[function(a,b){var c,d,e,f,g={}.hasOwnProperty,h=function(a,b){function c(){this.constructor=a}for(var d in b)g.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("../math/matrix4d"),f=a("../math/vector2d"),c=a("./index"),e=function(a){function b(){b.__super__.constructor.apply(this,arguments),this.fromVector=new f(this.from.x,this.from.y),this.toVector=new f(this.to.x,this.to.y),this.diff=this.toVector.clone().subtract(this.fromVector)}return h(b,a),b.prototype.from={x:0,y:0},b.prototype.to={x:0,y:0},b.prototype.getMatrix=function(a,b){var c;return c=0,new d([1,0,0,a,0,1,0,b,0,0,1,c,0,0,0,1])},b.prototype.getEasedMatrix=function(a){var b,c;return b=this.calculateEase(a),c=this.fromVector.clone().add(this.diff.clone().multiply(b)),this.getMatrix(c.x,c.y)},b}(c),b.exports=e},{"../math/matrix4d":13,"../math/vector2d":14,"./index":1}],6:[function(a,b){var c,d,e={}.hasOwnProperty,f=function(a,b){function c(){this.constructor=a}for(var d in b)e.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("./index"),c=function(a){function b(a){var c;null==a&&(a={}),b.__super__.constructor.apply(this,arguments),null!=a.stiffness&&(this.stiffness=a.stiffness),null!=a.bounces&&(this.bounces=a.bounces),this.alpha=this.stiffness/100,c=.005/Math.pow(10,this.stiffness),this.limit=Math.floor(Math.log(c)/-this.alpha),this.omega=this.calculateOmega(this.bounces,this.limit)}return f(b,a),b.prototype.bounces=4,b.prototype.stiffness=3,b.prototype.calculate=function(a){var b;return a>=1?1:(b=a*this.limit,1-this.exponent(b)*this.oscillation(b))},b.prototype.calculateOmega=function(){return(this.bounces+.5)*Math.PI/this.limit},b.prototype.exponent=function(a){return Math.pow(Math.E,-this.alpha*a)},b.prototype.oscillation=function(a){return Math.cos(this.omega*a)},b.prototype.serialize=function(){return{stiffness:this.stiffness,bounces:this.bounces}},b}(d),b.exports=c},{"./index":9}],7:[function(a,b){var c,d,e={}.hasOwnProperty,f=function(a,b){function c(){this.constructor=a}for(var d in b)e.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};c=a("./bounce"),d=function(a){function b(){return b.__super__.constructor.apply(this,arguments)}return f(b,a),b.prototype.oscillation=function(a){return Math.abs(Math.cos(this.omega*a))},b}(c),b.exports=d},{"./bounce":6}],8:[function(a,b){var c,d,e={}.hasOwnProperty,f=function(a,b){function c(){this.constructor=a}for(var d in b)e.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=a("./sway"),c=function(a){function b(){return b.__super__.constructor.apply(this,arguments)}return f(b,a),b.prototype.oscillation=function(a){return Math.abs(Math.sin(this.omega*a))},b}(d),b.exports=c},{"./sway":10}],9:[function(a,b){var c,d;d=a("../math/helpers"),c=function(){function a(){}return a.prototype.calculate=function(a){return a},a.prototype.serialize=function(){return{}},a.prototype.findOptimalKeyPoints=function(a,b){var c,e,f,g,h,i,j,k;for(null==a&&(a=1),null==b&&(b=1e3),h=[0],k=function(){var a,c;for(c=[],f=a=0;b>=0?b>a:a>b;f=b>=0?++a:--a)c.push(this.calculate(f/b));return c}.call(this),h=h.concat(d.findTurningPoints(k)),h.push(b-1),f=0,i=1e3;i--&&f!==h.length-1;)c=d.areaBetweenLineAndCurve(k,h[f],h[f+1]),a>=c?f++:(e=Math.round(h[f]+(h[f+1]-h[f])/2),h.splice(f+1,0,e));return 0===i?[]:j=function(){var a,c,d;for(d=[],a=0,c=h.length;c>a;a++)g=h[a],d.push(g/(b-1));return d}()},a}(),b.exports=c},{"../math/helpers":12}],10:[function(a,b){var c,d,e={}.hasOwnProperty,f=function(a,b){function c(){this.constructor=a}for(var d in b)e.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};c=a("./bounce"),d=function(a){function b(){return b.__super__.constructor.apply(this,arguments)}return f(b,a),b.prototype.calculate=function(a){var b;return a>=1?0:(b=a*this.limit,this.exponent(b)*this.oscillation(b))},b.prototype.calculateOmega=function(){return this.bounces*Math.PI/this.limit},b.prototype.oscillation=function(a){return Math.sin(this.omega*a)},b}(c),b.exports=d},{"./bounce":6}],11:[function(a,b){var c,d,e;e=a("./math/matrix4d"),d={scale:a("./components/scale"),rotate:a("./components/rotate"),translate:a("./components/translate"),skew:a("./components/skew")},c=function(){function a(){this.components=[]}return a.FPS=30,a.counter=1,a.prototype.components=null,a.prototype.duration=0,a.prototype.scale=function(a){return this.addComponent(new d.scale(a))},a.prototype.rotate=function(a){return this.addComponent(new d.rotate(a))},a.prototype.translate=function(a){return this.addComponent(new d.translate(a))},a.prototype.skew=function(a){return this.addComponent(new d.skew(a))},a.prototype.addComponent=function(a){return this.components.push(a),this.updateDuration(),this},a.prototype.serialize=function(){var a,b,c,d,e;for(b=[],e=this.components,c=0,d=e.length;d>c;c++)a=e[c],b.push(a.serialize());return b},a.prototype.deserialize=function(a){var b,c,e;for(c=0,e=a.length;e>c;c++)b=a[c],this.addComponent(new d[b.type](b));return this},a.prototype.updateDuration=function(){return this.duration=this.components.map(function(a){return a.duration+a.delay}).reduce(function(a,b){return Math.max(a,b)})},a.prototype.define=function(b){return this.name=b||a.generateName(),this.styleElement=document.createElement("style"),this.styleElement.innerHTML=this.getKeyframeCSS({name:this.name,prefix:!0}),document.body.appendChild(this.styleElement),this},a.prototype.applyTo=function(a,b){var c,d,e,f,g,h,i,j,k,l;for(null==b&&(b={}),this.define(),a.length||(a=[a]),g=this.getPrefixes(),d=null,window.jQuery&&window.jQuery.Deferred&&(d=new window.jQuery.Deferred),h=0,j=a.length;j>h;h++)for(e=a[h],l=g.animation,i=0,k=l.length;k>i;i++)f=l[i],c=[this.name,""+this.duration+"ms","linear","both"],b.loop&&c.push("infinite"),e.style[""+f+"animation"]=c.join(" ");return b.loop||setTimeout(function(a){return function(){return b.remove&&a.remove(),"function"==typeof b.onComplete&&b.onComplete(),d?d.resolve():void 0}}(this),this.duration),d},a.prototype.remove=function(){var a;if(this.styleElement)return this.styleElement.remove?this.styleElement.remove():null!=(a=this.styleElement.parentNode)?a.removeChild(this.styleElement):void 0},a.prototype.getPrefixes=function(a){var b,c;return b={transform:[""],animation:[""]},c=document.createElement("dummy").style,(a||!("transform"in c)&&"webkitTransform"in c)&&(b.transform=["-webkit-",""]),(a||!("animation"in c)&&"webkitAnimation"in c)&&(b.animation=["-webkit-",""]),b},a.prototype.getKeyframeCSS=function(b){var c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t;for(null==b&&(b={}),this.name=b.name||a.generateName(),i={transform:[""],animation:[""]},(b.prefix||b.forcePrefix)&&(i=this.getPrefixes(b.forcePrefix)),e=[],f=this.getKeyframes(b),r=this.keys,l=0,o=r.length;o>l;l++){for(d=r[l],g=f[d],j="matrix3d"+g,k=[],s=i.transform,m=0,p=s.length;p>m;m++)h=s[m],k.push(""+h+"transform: "+j+";");e.push(""+Math.round(100*d*100)/100+"% { "+k.join(" ")+" }")}for(c=[],t=i.animation,n=0,q=t.length;q>n;n++)h=t[n],c.push("@"+h+"keyframes "+this.name+" { \n  "+e.join("\n  ")+" \n}");return c.join("\n\n")},a.prototype.getKeyframes=function(b){var c,d,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v;if(null==b&&(b={}),k=[0,1],b.optimized)for(u=this.components,n=0,r=u.length;r>n;n++)c=u[n],d=c.easingObject.findOptimalKeyPoints().map(function(a){return function(b){return b*c.duration/a.duration+c.delay/a.duration}}(this)),c.delay&&d.push(c.delay/this.duration-.001),k=k.concat(d);else for(g=Math.round(this.duration/1e3*a.FPS),h=o=0;g>=0?g>=o:o>=g;h=g>=0?++o:--o)k.push(h/g);for(k=k.sort(function(a,b){return a-b}),this.keys=[],j={},p=0,s=k.length;s>p;p++)if(i=k[p],!j[i]){for(l=(new e).identity(),v=this.components,q=0,t=v.length;t>q;q++)c=v[q],f=i*this.duration,c.delay-f>1e-8||(m=(i-c.delay/this.duration)/(c.duration/this.duration),l.multiply(c.getEasedMatrix(m)));this.keys.push(i),j[i]=l.transpose().toFixed(3)}return j},a.generateName=function(){return"animation-"+a.counter++},a.isSupported=function(){var a,b,c,d,e,f,g,h,i;for(e=document.createElement("dummy").style,d=[["transform","webkitTransform"],["animation","webkitAnimation"]],f=0,h=d.length;h>f;f++){for(c=d[f],b=!1,g=0,i=c.length;i>g;g++)a=c[g],b||(b=a in e);if(!b)return!1}return!0},a}(),b.exports=c},{"./components/rotate":2,"./components/scale":3,"./components/skew":4,"./components/translate":5,"./math/matrix4d":13}],12:[function(a,b){var c;c=function(){function a(){}return a.prototype.sign=function(a){return 0>a?-1:1},a.prototype.findTurningPoints=function(a){var b,c,d,e,f,g;for(e=[],b=f=1,g=a.length-1;g>=1?g>f:f>g;b=g>=1?++f:--f)c=this.sign(a[b]-a[b-1]),d=this.sign(a[b+1]-a[b]),c!==d&&e.push(b);return e},a.prototype.areaBetweenLineAndCurve=function(a,b,c){var d,e,f,g,h,i,j,k;for(g=c-b,j=a[b],i=a[c],d=0,f=k=0;g>=0?g>=k:k>=g;f=g>=0?++k:--k)e=a[b+f],h=j+f/g*(i-j),d+=Math.abs(h-e);return d},a}(),b.exports=new c},{}],13:[function(a,b){var c;c=function(){function a(a){this._array=(null!=a?a.slice(0):void 0)||[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]}return a.prototype._array=null,a.prototype.equals=function(a){return this.toString()===a.toString()},a.prototype.identity=function(){return this.setArray([1,0,0,0,0,1,0,0,0,0,1,0,0,0,0,1]),this},a.prototype.multiply=function(b){var c,d,e,f,g,h,i,j;for(f=new a,c=h=0;4>h;c=++h)for(d=i=0;4>i;d=++i)for(e=j=0;4>j;e=++j)g=f.get(c,d)+this.get(c,e)*b.get(e,d),f.set(c,d,g);return this.copy(f)},a.prototype.transpose=function(){var a;return a=this.getArray(),this.setArray([a[0],a[4],a[8],a[12],a[1],a[5],a[9],a[13],a[2],a[6],a[10],a[14],a[3],a[7],a[11],a[15]]),this},a.prototype.get=function(a,b){return this.getArray()[4*a+b]},a.prototype.set=function(a,b,c){return this._array[4*a+b]=c},a.prototype.copy=function(a){return this._array=a.getArray(),this},a.prototype.clone=function(){return new a(this.getArray())},a.prototype.getArray=function(){return this._array.slice(0)},a.prototype.setArray=function(a){return this._array=a,this},a.prototype.toString=function(){return"("+this.getArray().join(", ")+")"},a.prototype.toFixed=function(a){var b;return this._array=function(){var c,d,e,f;for(e=this._array,f=[],c=0,d=e.length;d>c;c++)b=e[c],f.push(parseFloat(b.toFixed(a)));return f}.call(this),this},a}(),b.exports=c},{}],14:[function(a,b){var c;c=function(){function a(a,b){this.x=null!=a?a:0,this.y=null!=b?b:0}return a.prototype.x=0,a.prototype.y=0,a.prototype.add=function(b){return a.isVector2D(b)?(this.x+=b.x,this.y+=b.y,this):this._addScalar(b)},a.prototype._addScalar=function(a){return this.x+=a,this.y+=a,this},a.prototype.subtract=function(b){return a.isVector2D(b)?(this.x-=b.x,this.y-=b.y,this):this._subtractScalar(b)},a.prototype._subtractScalar=function(a){return this._addScalar(-a)},a.prototype.multiply=function(b){return a.isVector2D(b)?(this.x*=b.x,this.y*=b.y,this):this._multiplyScalar(b)},a.prototype._multiplyScalar=function(a){return this.x*=a,this.y*=a,this},a.prototype.divide=function(b){return a.isVector2D(b)?(this.x/=b.x,this.y/=b.y,this):this._divideScalar(b)},a.prototype._divideScalar=function(a){return this._multiplyScalar(1/a)},a.prototype.clone=function(){return new a(this.x,this.y)},a.prototype.copy=function(a){return this.x=a.x,this.y=a.y,this},a.prototype.equals=function(a){return a.x===this.x&&a.y===this.y},a.prototype.toString=function(){return"("+this.x+", "+this.y+")"},a.prototype.toFixed=function(a){return this.x=parseFloat(this.x.toFixed(a)),this.y=parseFloat(this.y.toFixed(a)),this},a.prototype.toArray=function(){return[this.x,this.y]},a.isVector2D=function(b){return b instanceof a},a}(),b.exports=c},{}]},{},[11])(11)});
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

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
var regSwitch = 0;

function nextRegForm(x){
	current_fs = $(x).parent();
	next_fs = $(x).parent().next();

	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		},
		duration: 800,
		complete: function(){
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
};

$(".previous").click(function(){
	if(animating) return false;
	animating = true;

	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();

	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

	//show the previous fieldset
	previous_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		},
		duration: 800,
		complete: function(){
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	return false;
})

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

$(document).ready(function(){
  let registerClose = document.getElementsByClassName('msform-close');
  let registerInput = document.getElementsByClassName('register-input');
  let regEmail, regPass;

  for (i = 0; i < registerClose.length; i++){
    $(registerClose[i]).click(function(){
      fadeOut("#dark-overlay");
      zoomOut("#msform");
      for (j = 0; j < registerInput.length; j++){
        $(registerInput[j]).val('');
      }
    })
  }

  let regEmailAttempt = 0,
      regPassAttempt = 0,
      regMatchAttempt = 0;

  function matchPass(){
    let regPass = $("#reg-new-pass"),
        passCheck = $("#reg-pass-confirm");
    if (passCheck.val() == regPass.val()) {
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
  $("#reg-new-email").keyup(function(){
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
    matchPass();
    validator.passFormat('reg-new-pass');
    if (regPassAttempt == 1) validator.isValid([{elem: 'reg-new-pass', type: 'strongpass'}]);
    if ($("#reg-new-pass").val() != "")
      fadeOut('#new-pass-helper');
  })
  $("#reg-pass-confirm").keyup(function(){
    matchPass();
    validator.passFormat('reg-pass-confirm');
  })
})