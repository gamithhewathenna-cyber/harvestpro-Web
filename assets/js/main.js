/* Harvest Pro — front-end interactions */
(function () {
  'use strict';

  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

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

  // Scroll-reveal animation: fade + rise content blocks into view as the
  // user scrolls to them, staggering siblings slightly for a cascade effect.
  // Purely additive — elements only get hidden once this JS actually adds
  // the .reveal class, so a JS failure just leaves everything visible.
  if (!prefersReducedMotion && 'IntersectionObserver' in window) {
    var revealTargets = document.querySelectorAll([
      '.hero-content', '.page-banner-inner',
      '.why-media', '.why-text',
      '.features-left', '.feature-item',
      '.how-left', '.how-right',
      '.cta-inner',
      '.about-story-panel', '.about-story-photo',
      '.partners-head', '.partner-card',
      '.why-choose-title', '.why-choose-card',
      '.feature-row-inner > *',
      '.contact-info', '.contact-form-col',
      '.footer-brand', '.footer-col'
    ].join(', '));

    var revealObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

    // Stagger siblings that reveal together (e.g. the four feature cards).
    var siblingIndex = new Map();
    revealTargets.forEach(function (el) {
      var parent = el.parentElement;
      var idx = siblingIndex.get(parent) || 0;
      siblingIndex.set(parent, idx + 1);
      el.style.transitionDelay = Math.min(idx * 0.12, 0.48) + 's';
      el.classList.add('reveal');
      revealObserver.observe(el);
    });
  }

  // Scroll parallax: shift hero/banner/CTA background images at a slightly
  // different rate than the page scroll for a subtle sense of depth.
  if (!prefersReducedMotion) {
    var parallaxEls = document.querySelectorAll('.hero-slide, .page-banner, .cta');
    if (parallaxEls.length) {
      var parallaxTicking = false;
      var updateParallax = function () {
        var vh = window.innerHeight;
        parallaxEls.forEach(function (el) {
          var rect = el.getBoundingClientRect();
          if (rect.bottom < -100 || rect.top > vh + 100) return;
          var shift = Math.max(-60, Math.min(60, rect.top * -0.12));
          el.style.backgroundPositionY = 'calc(50% + ' + shift + 'px)';
        });
        parallaxTicking = false;
      };
      window.addEventListener('scroll', function () {
        if (!parallaxTicking) {
          requestAnimationFrame(updateParallax);
          parallaxTicking = true;
        }
      }, { passive: true });
      window.addEventListener('resize', updateParallax);
      updateParallax();
    }
  }
})();
