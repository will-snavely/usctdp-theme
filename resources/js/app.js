import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
  const hotspots = document.querySelectorAll('.biohotspot');
  const tooltip = document.getElementById('map-tooltip');
  const container = document.querySelector('.team-image-container');

  hotspots.forEach(hotspot => {

    // 1. Show tooltip and populate quote
    hotspot.addEventListener('mouseenter', (e) => {
      const quoteId = e.target.getAttribute('data-quote');
      const quoteElem = document.getElementById(quoteId);
      if (quoteElem) {
        quoteElem.classList.remove("transparent");
        quoteElem.classList.add("opaque");
      }
    });

    // 3. Hide tooltip when mouse exits
    hotspot.addEventListener('mouseleave', (e) => {
      const quoteId = e.target.getAttribute('data-quote');
      const quoteElem = document.getElementById(quoteId);

      if (quoteElem) {
        quoteElem.classList.remove("opaque");
        quoteElem.classList.add("transparent");
      }
    });

  });
});