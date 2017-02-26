'use strict';

// Parallax
function $$(selector, context) {
  context = context || document;
  var elements = context.querySelectorAll(selector);
  return Array.prototype.slice.call(elements);
}

document.addEventListener("scroll", function () {
  var scrolledHeight = document.documentElement.scrollTop;
  $$(".row-alt").forEach(function (el, index, array) {
    if (scrolledHeight <= el.offsetTop + el.offsetHeight) {
      el.style.backgroundPositionY = ((scrolledHeight - el.offsetTop) / -2) - (el.offsetHeight / 2) + "px";
    } else {
      el.style.backgroundPositionY = "center";
    }
  });
});
// Parallax end
// Smooth scroll
document.addEventListener('DOMContentLoaded', function navScroll() {
  // Get all navigation links
  var navLinks = document.querySelectorAll('nav a');

  function scrollTo(event) {
    if (this.hash !== '') {
      // Prevent default anchor click behavior
      event.preventDefault();
      // Store hash and find DOMElement
      var hash = this.hash.slice(1);
      var scrollElement = document.getElementById(hash);
      // Scroll to element
      smoothScroll(scrollElement);

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

      // Add hash (#) to URL when done scrolling (default click behavior)
      // window.location.hash = hash;
    }
  }
  for (var i = 0; i < navLinks.length; i++) {
    navLinks[i].addEventListener('click', scrollTo);
  };
});
// Smooth Scroll end

function easeOutInQuad(t, d) {
  t /= d;
	return t*t*t;
}
