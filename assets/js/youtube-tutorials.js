/* Harvest Pro — "How to Use Harvest Pro" tutorial popup. The YouTube
 * player is never embedded until the popup is actually opened (no tracking
 * script loads on every page view for nothing), and clicking a tutorial in
 * the list just swaps the iframe's src — no page reload. */
(function () {
  'use strict';

  var fab = document.getElementById('ytTutorialFab');
  var overlay = document.getElementById('ytModalOverlay');
  var closeBtn = document.getElementById('ytModalClose');
  var iframe = document.getElementById('ytModalIframe');
  if (!fab || !overlay || !iframe) return;

  var items = Array.prototype.slice.call(overlay.querySelectorAll('.yt-tutorial-item'));

  function embedUrl(videoId) {
    return 'https://www.youtube-nocookie.com/embed/' + videoId + '?rel=0&autoplay=1';
  }

  function playVideo(videoId, activeBtn) {
    iframe.src = embedUrl(videoId);
    items.forEach(function (btn) { btn.classList.toggle('active', btn === activeBtn); });
  }

  function openModal() {
    overlay.hidden = false;
    document.body.style.overflow = 'hidden';
    if (!iframe.src && items.length) {
      playVideo(items[0].getAttribute('data-video-id'), items[0]);
    }
  }

  function closeModal() {
    overlay.hidden = true;
    document.body.style.overflow = '';
    iframe.src = ''; // stop playback so audio doesn't keep running in the background
  }

  fab.addEventListener('click', openModal);
  closeBtn.addEventListener('click', closeModal);
  overlay.addEventListener('click', function (e) {
    if (e.target === overlay) closeModal();
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !overlay.hidden) closeModal();
  });
  items.forEach(function (btn) {
    btn.addEventListener('click', function () {
      playVideo(btn.getAttribute('data-video-id'), btn);
    });
  });
})();
