/* Harvest Pro — front-end interactions */
(function () {
  'use strict';

  // Mobile navigation toggle
  var toggle = document.getElementById('navToggle');
  var links  = document.getElementById('navLinks');

  if (toggle && links) {
    toggle.addEventListener('click', function () {
      links.classList.toggle('open');
    });
    // Close menu when a link is tapped
    links.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        links.classList.remove('open');
      });
    });
  }

  // Simple active-link state on scroll (Home/About/Features/Contact)
  var sections = ['home', 'about', 'features', 'contact'];
  var navAnchors = links ? links.querySelectorAll('a') : [];

  window.addEventListener('scroll', function () {
    var pos = window.scrollY + 120;
    var current = 'home';
    sections.forEach(function (id) {
      var el = document.getElementById(id);
      if (el && el.offsetTop <= pos) current = id;
    });
    navAnchors.forEach(function (a) {
      var href = a.getAttribute('href') || '';
      a.classList.toggle('active', href === '#' + current);
    });
  }, { passive: true });
})();
