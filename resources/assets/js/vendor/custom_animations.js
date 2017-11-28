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

// Card carousel
function cardCarousel(){
  // Define elements
  let Lbutton = $(".carousel-button.left");
  let Rbutton = $(".carousel-button.right");
  let Cards = $('.hz-card');
  let Reel = $(".card-carousel-reel");
  // Initialize variables
  let Scrub = 0;
  let Left = 0;
  let Pad = 50;
  let Width = $(".card-carousel").parent().outerWidth() / ($(Cards[Scrub]).outerWidth() + 10);
  Width = Math.floor(Width);

  // Push carousel left or right depending on function state
  function cardReel(x){
    // Increase carousel position & current card
    Left += ($(Cards[Scrub]).outerWidth() + 10) * x;
    Scrub -= x;
    // Determine buttons and padding state
    if (Scrub == 0) {
      Pad = 0;
      Lbutton.addClass('hidden');
    } else {
      Pad = 50;
      Lbutton.removeClass('hidden')
      if (Scrub > Cards.length - Width - 1)
        Rbutton.addClass('hidden');
    }
    if (x > 0) Rbutton.removeClass('hidden');
    // Move carousel by position
    Reel.css('left', Left + Pad);
  }

  // Initialize starting position
  if (Cards.length >= Width + 1){
    Rbutton.removeClass('hidden');
  };

  for (let i = 0; i < Cards.length; i++){
    if (i > Width - 1) {
      cardReel(-1);
    }
    if ($(Cards[i]).hasClass('card-active')){
        break;
    }
  }

  Rbutton.click(function(){ cardReel(-1) });
  Lbutton.click(function(){ cardReel(1) });
}

$(document).ready(function(){
  cardCarousel();
});

// Create, read, erase cookies
function createCookie(name,value,days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for(let i=0;i < ca.length;i++) {
        let c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}
