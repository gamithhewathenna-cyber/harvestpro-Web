/* Harvest Pro — "Live Estate Activity" demo card simulation.
 *
 * Everything shown here is deterministic: every number is derived purely
 * from (a) today's date in Sri Lanka (Asia/Colombo, fixed UTC+5:30, no
 * DST) and (b) a fixed string key per metric, run through a seeded hash.
 * There is no Math.random() anywhere in this file — refreshing the page,
 * or opening it on a different device, reproduces exactly the same
 * day's numbers. Only the wall clock moving forward changes what's
 * displayed, and only forward (values never drop back down).
 */
(function () {
  'use strict';

  var configEl = document.getElementById('liveFeedConfig');
  var wrap = document.getElementById('liveFeedCards');
  var visitorEl = document.getElementById('liveVisitorCount');
  if (!configEl || !wrap) return;

  var cfg;
  try {
    cfg = JSON.parse(configEl.textContent);
  } catch (e) {
    return;
  }

  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var SL_OFFSET_MS = 5.5 * 60 * 60 * 1000;

  // ---- Deterministic seeded "randomness" (cyrb53-style string hash) ----
  function seededFloat(str) {
    var h1 = 0xdeadbeef, h2 = 0x41c6ce57;
    for (var i = 0; i < str.length; i++) {
      var ch = str.charCodeAt(i);
      h1 = Math.imul(h1 ^ ch, 2654435761);
      h2 = Math.imul(h2 ^ ch, 1597334677);
    }
    h1 = Math.imul(h1 ^ (h1 >>> 16), 2246822507) ^ Math.imul(h2 ^ (h2 >>> 13), 3266489909);
    h2 = Math.imul(h2 ^ (h2 >>> 16), 2246822507) ^ Math.imul(h1 ^ (h1 >>> 13), 3266489909);
    var combined = 4294967296 * (2097151 & h2) + (h1 >>> 0);
    return (combined % 1000000) / 1000000; // [0, 1)
  }
  function seededSigned(str) { return (seededFloat(str) - 0.5) * 2; } // [-1, 1)

  // ---- Sri Lanka wall-clock time, independent of the visitor's own TZ ----
  function colomboNow() {
    return new Date(Date.now() + SL_OFFSET_MS);
  }
  function pad2(n) { return n < 10 ? '0' + n : '' + n; }
  function dayKeyOf(d) {
    return d.getUTCFullYear() + '-' + pad2(d.getUTCMonth() + 1) + '-' + pad2(d.getUTCDate());
  }
  function minutesOfDay(d) {
    return d.getUTCHours() * 60 + d.getUTCMinutes() + d.getUTCSeconds() / 60;
  }

  // ---- Per-day cached values (targets, expense plan, factory rate) ----
  var dayCache = { key: null };
  function ensureDayCache(dayKey) {
    if (dayCache.key === dayKey) return dayCache;
    dayCache = { key: dayKey, targets: {}, expensePlan: null, factoryRate: null };

    Object.keys(cfg.metrics).forEach(function (metricKey) {
      var m = cfg.metrics[metricKey];
      var variance = m.targetVariance ? seededSigned(dayKey + '|' + metricKey + '|target') * m.targetVariance : 0;
      dayCache.targets[metricKey] = Math.round(m.targetBase + variance);
    });

    dayCache.factoryRate = Math.round(cfg.factoryRateMin + seededFloat(dayKey + '|factoryrate') * (cfg.factoryRateMax - cfg.factoryRateMin));

    var ranges = {
      fertilizer: [3000, 15000], transport: [1500, 6000], fuel: [2000, 8000],
      fieldMaintenance: [1000, 5000], clearing: [1500, 7000], equipment: [2000, 10000]
    };
    var win = cfg.expenses, span = win.endMin - win.startMin, entries = [];
    win.categories.forEach(function (catKey) {
      var includeRoll = seededFloat(dayKey + '|expense|include|' + catKey);
      if (includeRoll < 0.12) return; // most days include every category; occasionally skip one
      var range = ranges[catKey] || [1000, 5000];
      var amount = Math.round(range[0] + seededFloat(dayKey + '|expense|amount|' + catKey) * (range[1] - range[0]));
      var revealMin = win.startMin + seededFloat(dayKey + '|expense|time|' + catKey) * span;
      entries.push({ key: catKey, amount: amount, revealMin: revealMin, dynamic: false });
    });
    var labourReveal = win.startMin + span * (0.45 + seededFloat(dayKey + '|expense|time|casualLabour') * 0.4);
    entries.push({ key: 'casualLabour', amount: 0, revealMin: labourReveal, dynamic: true });
    entries.sort(function (a, b) { return a.revealMin - b.revealMin; });
    dayCache.expensePlan = entries;

    return dayCache;
  }

  // ---- Smooth, non-linear, monotonic progress curve within a window ----
  function computeProgress(dayKey, metricKey, startMin, endMin, startVal, targetVal, nowMin) {
    if (nowMin <= startMin) return startVal;
    if (nowMin >= endMin) return targetVal;
    var duration = endMin - startMin;
    var bucketMinutes = Math.max(3, duration / 12);
    var totalBuckets = Math.max(1, Math.round(duration / bucketMinutes));
    var elapsedBuckets = (nowMin - startMin) / bucketMinutes;
    var idx = Math.floor(elapsedBuckets);
    var frac = elapsedBuckets - idx;
    var rising = targetVal >= startVal;

    function checkpoint(i) {
      if (i <= 0) return startVal;
      if (i >= totalBuckets) return targetVal;
      var idealFrac = i / totalBuckets;
      var eased = 1 - Math.pow(1 - idealFrac, 1.15);
      var idealVal = startVal + (targetVal - startVal) * eased;
      var span = Math.abs(targetVal - startVal) * 0.035;
      var noise = seededSigned(dayKey + '|' + metricKey + '|bucket|' + i) * span;
      var v = idealVal + noise;
      if (rising) { if (v < startVal) v = startVal; if (v > targetVal) v = targetVal; }
      else { if (v > startVal) v = startVal; if (v < targetVal) v = targetVal; }
      return v;
    }

    var a = checkpoint(idx);
    var b = checkpoint(idx + 1);
    if (rising ? b < a : b > a) b = a;
    return a + (b - a) * frac;
  }

  // ---- "People viewing now": follows the shape of the day (quiet at dawn,
  // busiest in the evening) via the same keyframes PHP used for the first
  // paint, plus a small seeded wiggle so it still feels alive minute to
  // minute without ever being pure Math.random(). ----
  function computeVisitorCount(dayKey, nowMin) {
    var kf = cfg.visitors.keyframes;
    var base = kf[kf.length - 1][1];
    for (var i = 0; i < kf.length - 1; i++) {
      var a = kf[i], b = kf[i + 1];
      if (nowMin >= a[0] && nowMin <= b[0]) {
        var frac = b[0] > a[0] ? (nowMin - a[0]) / (b[0] - a[0]) : 0;
        base = a[1] + (b[1] - a[1]) * frac;
        break;
      }
    }
    var bucket = Math.floor(nowMin / 2); // wiggle changes every 2 minutes
    var jitter = seededSigned(dayKey + '|visitors|' + bucket) * 4;
    return Math.max(4, Math.round(base + jitter));
  }

  // ---- Formatting ----
  function fmtNum(n) { return Math.round(n).toLocaleString('en-US'); }
  function fmtValue(value, unit) {
    if (unit === 'currency') return 'Rs. ' + fmtNum(value);
    if (unit === 'workers') return fmtNum(value) + ' ' + cfg.i18n.workers;
    return fmtNum(value) + ' kg';
  }

  // ---- Cell updates (with a gentle highlight flash instead of digit-by-
  // digit tweening, since the text mixes units/arrows/counts per row) ----
  var lastText = {};
  function setCellText(key, text, title) {
    var cell = wrap.querySelector('[data-progress="' + key + '"]');
    if (!cell) return;
    if (lastText[key] === text) return;
    var changed = lastText[key] !== undefined;
    lastText[key] = text;
    cell.textContent = text;
    if (title) { cell.title = title; } else { cell.removeAttribute('title'); }
    if (changed && !prefersReducedMotion) {
      cell.classList.remove('lf-updated');
      // eslint-disable-next-line no-unused-expressions
      cell.offsetWidth; // force reflow so the animation restarts
      cell.classList.add('lf-updated');
    }
    return changed;
  }

  // ---- Main render pass ----
  var lastValues = {}; // floor so nothing ever visibly drops *within a day*
  var lastExpenseTotal = 0;
  var lastRenderedDayKey = null;

  function render() {
    var now = colomboNow();
    var dayKey = dayKeyOf(now);
    var nowMin = minutesOfDay(now);
    var day = ensureDayCache(dayKey);
    if (day.key !== dayKey) day = ensureDayCache(dayKey); // day rolled over mid-tick

    // New Sri Lanka calendar day: forget yesterday's floors so every metric
    // can count up from its start value again instead of staying pinned at
    // yesterday's target forever.
    if (lastRenderedDayKey !== null && lastRenderedDayKey !== dayKey) {
      lastValues = {};
      lastExpenseTotal = 0;
    }
    lastRenderedDayKey = dayKey;

    if (visitorEl) {
      var visitorCount = computeVisitorCount(dayKey, nowMin);
      if (String(visitorCount) !== visitorEl.textContent) {
        visitorEl.textContent = visitorCount;
        if (!prefersReducedMotion) {
          visitorEl.classList.remove('bump');
          // eslint-disable-next-line no-unused-expressions
          visitorEl.offsetWidth; // force reflow so the animation restarts
          visitorEl.classList.add('bump');
        }
      }
    }

    Object.keys(cfg.metrics).forEach(function (metricKey) {
      var m = cfg.metrics[metricKey];
      var target = day.targets[metricKey];
      var raw = computeProgress(dayKey, metricKey, m.startMin, m.endMin, m.startVal, target, nowMin);
      var floor = lastValues[metricKey] !== undefined ? lastValues[metricKey] : m.startVal;
      var value = Math.max(raw, floor);
      lastValues[metricKey] = value;

      var text, title;
      if (nowMin < m.startMin) {
        text = fmtValue(m.startVal, m.unit);
        var card = wrap.querySelector('[data-key="' + metricKey + '"]');
        var startLabel = card ? card.getAttribute('data-start') : '';
        title = cfg.i18n.startsAt.replace('%s', startLabel);
      } else if (nowMin >= m.endMin) {
        text = fmtValue(target, m.unit);
        title = metricKey === 'factory' ? cfg.i18n.rate + ': Rs. ' + day.factoryRate + '/kg' : null;
      } else {
        text = fmtValue(value, m.unit);
        title = metricKey === 'factory' ? cfg.i18n.rate + ': Rs. ' + day.factoryRate + '/kg' : null;
      }
      setCellText(metricKey, text, title);
    });

    // Field expenses: sum of every entry "revealed" by now, one entry
    // (casual labour) computed live from the green-leaf figure above.
    var win = cfg.expenses;
    var effectiveNow = nowMin < win.startMin ? win.startMin - 1 : (nowMin >= win.endMin ? win.endMin : nowMin);
    var total = 0, count = 0, breakdown = [];
    day.expensePlan.forEach(function (entry) {
      if (entry.revealMin > effectiveNow) return;
      var amount = entry.dynamic ? Math.round(cfg.labourRatePerKg * lastValues.greenleaf) : entry.amount;
      total += amount;
      count++;
      var label = cfg.expenses.categoryLabels[entry.key] || entry.key;
      breakdown.push(label + ': Rs. ' + fmtNum(amount));
    });
    total = Math.max(total, lastExpenseTotal);
    lastExpenseTotal = total;
    var expensesText = count === 0 ? cfg.i18n.noEntries : ('Rs. ' + fmtNum(total));
    setCellText('expenses', expensesText, breakdown.join('\n'));
  }

  render();
  setInterval(render, 4000);
})();
