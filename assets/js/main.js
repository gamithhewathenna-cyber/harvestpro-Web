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

  // Sticky navbar: switch to a solid bar (and swap the logo) once scrolled.
  // (Which nav link is "active" is decided server-side per page — Home/About/
  // Features/Contact are separate pages now, not same-page anchors.)
  var navFixed = document.getElementById('navFixed');

  function onScroll() {
    if (navFixed) {
      navFixed.classList.toggle('scrolled', window.scrollY > 30);
    }
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

  // Highlights card slider: slides by one card width at a time, disabling
  // the arrows at either end. Card-width and how many fit per view are
  // measured live, so it adapts automatically at every breakpoint.
  var highlightsTrack = document.getElementById('highlightsTrack');
  if (highlightsTrack) {
    var hPrev = document.getElementById('highlightsPrev');
    var hNext = document.getElementById('highlightsNext');
    var hCards = highlightsTrack.children;
    var hIndex = 0;

    var hCardStep = function () {
      if (!hCards.length) return 0;
      var style = window.getComputedStyle(highlightsTrack);
      var gap = parseFloat(style.columnGap || style.gap || '0') || 0;
      return hCards[0].getBoundingClientRect().width + gap;
    };
    var hMaxIndex = function () {
      var step = hCardStep();
      if (!step) return 0;
      var visible = Math.max(1, Math.round(highlightsTrack.parentElement.getBoundingClientRect().width / step));
      return Math.max(0, hCards.length - visible);
    };
    var hRender = function () {
      var max = hMaxIndex();
      hIndex = Math.min(hIndex, max);
      highlightsTrack.style.transform = 'translateX(-' + (hIndex * hCardStep()) + 'px)';
      if (hPrev) hPrev.disabled = hIndex <= 0;
      if (hNext) hNext.disabled = hIndex >= max;
    };

    if (hPrev) hPrev.addEventListener('click', function () { hIndex = Math.max(0, hIndex - 1); hRender(); });
    if (hNext) hNext.addEventListener('click', function () { hIndex = Math.min(hMaxIndex(), hIndex + 1); hRender(); });
    window.addEventListener('resize', hRender);
    hRender();
  }

  // Lazy-load below-the-fold CSS background images (why photos, feature media,
  // about story photo, CTA banners) — they're stashed in data-bg until the
  // element is about to scroll into view, instead of downloading on page load.
  var lazyBgEls = document.querySelectorAll('[data-bg]');
  if (lazyBgEls.length) {
    var loadBg = function (el) {
      el.style.backgroundImage = el.getAttribute('data-bg');
      el.removeAttribute('data-bg');
    };
    if ('IntersectionObserver' in window) {
      var bgObserver = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            loadBg(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, { rootMargin: '200px 0px' });
      lazyBgEls.forEach(function (el) { bgObserver.observe(el); });
    } else {
      // No IntersectionObserver support: just load them all up front.
      lazyBgEls.forEach(loadBg);
    }
  }
})();
