/* Harvest Pro — "How It Works" step tabs (top ribbon + bottom explore grid
 * both drive the same set of panels; prev/next buttons walk between them). */
(function () {
  'use strict';

  var ribbon = document.getElementById('hiwRibbon');
  var panelWrap = document.getElementById('hiwPanels');
  if (!ribbon || !panelWrap) return;

  var pills  = Array.prototype.slice.call(ribbon.querySelectorAll('.hiw-pill'));
  var panels = Array.prototype.slice.call(panelWrap.querySelectorAll('.hiw-panel'));
  var cards  = Array.prototype.slice.call(document.querySelectorAll('.hiw-card'));
  var steps  = panels.map(function (p) { return p.getAttribute('data-step-panel'); });

  function indexOf(key) {
    var i = steps.indexOf(key);
    return i === -1 ? 0 : i;
  }

  function activate(key, opts) {
    opts = opts || {};
    var index = indexOf(key);
    key = steps[index];

    pills.forEach(function (pill) { pill.classList.toggle('active', pill.getAttribute('data-step') === key); });
    panels.forEach(function (panel) { panel.classList.toggle('active', panel.getAttribute('data-step-panel') === key); });

    var activePanel = panels[index];
    activePanel.querySelectorAll('[data-hiw-prev]').forEach(function (btn) { btn.disabled = index === 0; });
    activePanel.querySelectorAll('[data-hiw-next]').forEach(function (btn) { btn.disabled = index === steps.length - 1; });

    if (!opts.silent) {
      var activePill = pills[index];
      if (activePill) activePill.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
      if (history.replaceState) history.replaceState(null, '', '#' + key);
    }

    if (opts.scroll) {
      panelWrap.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  pills.forEach(function (pill) {
    pill.addEventListener('click', function () { activate(pill.getAttribute('data-step')); });
  });
  cards.forEach(function (card) {
    card.addEventListener('click', function () { activate(card.getAttribute('data-step'), { scroll: true }); });
  });
  panelWrap.querySelectorAll('[data-hiw-prev]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var current = steps.indexOf(panels.filter(function (p) { return p.classList.contains('active'); })[0].getAttribute('data-step-panel'));
      if (current > 0) activate(steps[current - 1]);
    });
  });
  panelWrap.querySelectorAll('[data-hiw-next]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var current = steps.indexOf(panels.filter(function (p) { return p.classList.contains('active'); })[0].getAttribute('data-step-panel'));
      if (current < steps.length - 1) activate(steps[current + 1]);
    });
  });

  var hashKey = location.hash ? location.hash.slice(1) : '';
  var deepLinked = steps.indexOf(hashKey) !== -1;
  activate(deepLinked ? hashKey : steps[0], deepLinked ? { scroll: true } : { silent: true });
})();
