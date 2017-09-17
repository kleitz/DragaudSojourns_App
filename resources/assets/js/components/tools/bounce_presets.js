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
