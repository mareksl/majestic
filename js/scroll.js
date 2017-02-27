      smoothScroll(scrollElement);
function smoothScroll(e) {
  var posInit = document.documentElement.scrollTop;
  var posGoal = e.offsetTop;
  var posDist = posGoal - posInit;
  var step = posInit + posDist / Math.abs(posDist);
  var scrollUnit = 1;
  var time = 1;
  for (var i = posInit; i <= Math.abs(posDist); i++) {
    setTimeout(scrollWindow, time);
    time++;
  }

  function scrollWindow() {
    window.scrollTo(0, step);
  }
}

function smoothScroll(e) {
  var posInit = document.documentElement.scrollTop;
  var posGoal = e.offsetTop;
  var posDist = posGoal - posInit;
  var absDist = Math.abs(posDist);
  var speed = absDist;
  var step = posInit + (posDist / absDist);
  var scrollUnit = 1;
  var time = 1;
  for (var i = 0; i <= absDist; i++) {
    setTimeout(scrollWindow, time);
    time = easeOutInQuad(i, absDist) * speed;
    console.log(time);
  }

  function scrollWindow() {
    window.scrollTo(0, step);
    posDist > 0 ? step++ : step--;
  }
}
