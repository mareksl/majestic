'use strict';
function $$(selector, context) {
  context = context || document;
  var elements = context.querySelectorAll(selector);
  return Array.prototype.slice.call(elements);
}

window.addEventListener("scroll", function() {
  var scrolledHeight = window.pageYOffset;
  $$(".row-alt").forEach(function(el,index,array) {
      if(scrolledHeight <= el.offsetTop + el.offsetHeight) {
          el.style.backgroundPositionY = (scrolledHeight - el.offsetTop) / -2 + "px";
      }
      else {
          el.style.backgroundPositionY = "center";
      }
  });
});
