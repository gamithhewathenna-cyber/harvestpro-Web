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

  // Sticky navbar: switch to a solid bar (and swap the logo) once scrolled
  var navFixed = document.getElementById('navFixed');

  function onScroll() {
    if (navFixed) {
      navFixed.classList.toggle('scrolled', window.scrollY > 30);
    }

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
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // Hero slider: slides horizontally between slides, with dots + arrows + autoplay
  var heroSlider = document.getElementById('heroSlider');
  if (heroSlider) {
    var slides = heroSlider.querySelectorAll('.hero-slide');
    var dots   = document.querySelectorAll('.hero-dot');
    var prevBtn = document.getElementById('heroPrev');
    var nextBtn = document.getElementById('heroNext');
    var current = 0;
    var timer   = null;

    var render = function () {
      slides.forEach(function (s, i) {
        s.style.transform = 'translateX(' + ((i - current) * 100) + '%)';
        s.classList.toggle('active', i === current);
      });
      dots.forEach(function (d, i) { d.classList.toggle('active', i === current); });
    };
    var goTo = function (index) {
      current = (index + slides.length) % slides.length;
      render();
    };
    var next = function () { goTo(current + 1); };
    var prev = function () { goTo(current - 1); };
    var restart = function () {
      if (timer) clearInterval(timer);
      if (slides.length > 1) timer = setInterval(next, 6000);
    };

    dots.forEach(function (d, i) {
      d.addEventListener('click', function () { goTo(i); restart(); });
    });
    if (nextBtn) nextBtn.addEventListener('click', function () { next(); restart(); });
    if (prevBtn) prevBtn.addEventListener('click', function () { prev(); restart(); });

    render();
    restart();
  }
})();
