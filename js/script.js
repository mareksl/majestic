/* jshint browser: true */
/* jshint esversion: 6 */
'use strict';
// Selectors
var $$ = function(elem) {
    return document.querySelectorAll(elem);
};
var $ = function(elem) {
    return document.querySelector(elem);
};
// Selectors
// Parallax
document.addEventListener("scroll", function() {
    var scrolledHeight = window.pageYOffset || document.documentElement.scrollTop;

    $$(".row-parallax").forEach(function(el) {
        if (scrolledHeight <= el.offsetTop + el.offsetHeight) {
            el.style.backgroundPositionY = ((scrolledHeight - el.offsetTop) / -2) - (el.offsetHeight / 2) + "px";
        } else {
            el.style.backgroundPositionY = "center";
        }
    });
});
// Parallax
// Smooth Scroll
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
// Smooth Scroll
// YT Lazy load
document.addEventListener('DOMContentLoaded', function fetchThumbnail() {
    var youtube = $$(".youtube");

    for (var i = 0; i < youtube.length; i++) {
        var source = "https://img.youtube.com/vi/" + youtube[i].dataset.embed + "/sddefault.jpg";
        var image = new Image();

        image.src = source;
        image.addEventListener("load", function() {
            youtube[i].appendChild(image);
        }(i));
        youtube[i].addEventListener("click", function() {
            var iframe = document.createElement("iframe");

            iframe.setAttribute("frameborder", "0");
            iframe.setAttribute("allowfullscreen", "");
            iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");
            this.innerHTML = "";
            this.appendChild(iframe);
        });
    }
});
// YT Lazy load
// MODAL
var modalOpen = $$(".gallery-grid > a");

for (var i = 0; i < modalOpen.length; i++) {
    modalShow(modalOpen[i]);
}

function modalShow(link) {
    link.addEventListener("click", function(e) {
        e.preventDefault();
        var image = this.querySelector('img').src;
        var modal = document.createElement('div');

        modal.id = 'modal';
        modal.classList.add('modal-background');
        var html = '';
        html += `<div class="modal-window">
            <div class="modal-title">
                <span>Lorem ipsum dolor sit amet</span>
                <span class="modal-close" id="modalClose">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                    <path d="M13.087 103.597l90.51-90.51 11.313 11.315-90.508 90.51z"/>
                    <path d="M24.402 13.088l90.51 90.51-11.315 11.313-90.51-90.507z"/>
                  </svg>
                </span>
            </div>
            <img src="${image}" alt="" class="img-responsive">
        </div>`;

        modal.innerHTML = html;
        document.body.appendChild(modal);
        if ($("#modalClose")) $("#modalClose").onclick = function() {
            document.body.removeChild($('#modal'));
        };
        window.onclick = function(event) {
            if (event.target == $("#modal")) {
                document.body.removeChild($('#modal'));
            }
        };
    });
}
// MODAL
// EVENTS
document.addEventListener("DOMContentLoaded", function eventList() {
    var x = 5;

    function hideEvents(list) {
        var events = list.getElementsByTagName('li');

        for (var i = 0; i < events.length; i++) {
            if (i >= x) {
                events[i].style.display = 'none';
                events[i].style.opacity = 0;
            }
        }
        if (events.length <= 5) {
            $(".events-more").style.display = "none";
        }
    }
    $(".events-more").addEventListener('click', function() {
        var events = $(".events-future").getElementsByTagName('li');

        x = (x + 5 <= events.length) ? x + 5 : events.length;
        for (var i = 5; i < x; i++) {
            show(events[i]);
        }
        if (x === events.length) {
            $(".events-more").style.display = "none";
        }
    });
    hideEvents($(".events-future"));
});
// EVENTS
function show(e) {
    e.style.display = "flex";
    setTimeout(function() {
        e.style.opacity = 1;
    }, 0);
	}
function hide(e) {
    e.style.opacity = 0;
    // e.addEventListener("transitionend", function(event) {
    e.style.display = "none";
    // }, false);
	}
