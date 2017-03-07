/* jshint browser: true */
'use strict';
var $$ = function (elem) {
  return document.querySelectorAll(elem);
};
var $ = function (elem) {
  return document.querySelector(elem);
};
document.addEventListener("scroll", function () {
  var scrolledHeight = window.pageYOffset || document.documentElement.scrollTop;
  $$(".row-parallax").forEach(function (el) {
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
  var navLinks = $$('nav a');

  function scrollTo(event) {
    if (this.hash !== '') {
      // Prevent default anchor click behavior
      event.preventDefault();
      // Store hash and find DOMElement
      var hash = this.hash;
      var scrollElement = $(hash);
      // Scroll to element
      Velocity(scrollElement, 'scroll', {
        duration: 1000,
        easing: 'easeInOutQuad',
        offset: -64
      });
      // Add hash (#) to URL
      window.location.hash = hash;
    }
  }
  for (var i = 0; i < navLinks.length; i++) {
    navLinks[i].addEventListener('click', scrollTo);
  }
});
// Smooth Scroll end
function easeOutInQuad(t, d) {
  t /= d;
  return t * t * t;
}
// Youtube lazy load
document.addEventListener('DOMContentLoaded', function fetchThumbnail() {
  var youtube = $$(".youtube");
  for (var i = 0; i < youtube.length; i++) {
    var source = "https://img.youtube.com/vi/" + youtube[i].dataset.embed + "/sddefault.jpg";
    var image = new Image();
    image.src = source;
    image.addEventListener("load", function () {
      youtube[i].appendChild(image);
    }(i));
    youtube[i].addEventListener("click", function () {
      var iframe = document.createElement("iframe");
      iframe.setAttribute("frameborder", "0");
      iframe.setAttribute("allowfullscreen", "");
      iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");
      this.innerHTML = "";
      this.appendChild(iframe);
    });
  }
});

function show(e) {
  e.style.display = "flex";
  setTimeout(function () {
    e.style.opacity = 1;
  }, 0);
}

function hide(e) {
  e.style.opacity = 0;
  // e.addEventListener("transitionend", function(event) {
  e.style.display = "none";
  // }, false);
}
var modalOpen = $("#modalOpen");
modalOpen.addEventListener("click", function () {
  show($("#modal"));
});
if ($("#modalClose")) $("#modalClose").onclick = function () {
  hide($("#modal"));
};
window.onclick = function (event) {
  if (event.target == $("#modal")) {
    hide($("#modal"));
  }
};
// var images = ;
// for (var i = 0; i < array.length; i++) {
//   array[i]
// };
/* Modal object
for each .modal create object
method: hide, show
*/
