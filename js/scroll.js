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
