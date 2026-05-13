import domReady from '@wordpress/dom-ready';

domReady(() => {

  // ── State ──────────────────────────────────────────────────────────────────

  const state = {
    level:  'all',
    day:    'all',
  };

  // ── Element refs ──────────────────────────────────────────────────────────

  const grid       = document.getElementById('js-programs-grid');
  const noResults  = document.getElementById('js-no-results');
  const sessionBadge = document.getElementById('js-session-badge');

  if (!grid) return; // Guard: not on the juniors page

  const cards      = Array.from(grid.querySelectorAll('.program-card'));
  const levelPills = Array.from(document.querySelectorAll('.level-pill'));
  const daySelect  = document.getElementById('day-select');
  const seasonBtns = Array.from(document.querySelectorAll('.season-toggle__btn'));

  // ── Season toggle ─────────────────────────────────────────────────────────
  //
  // Season changes require a page reload so the server renders the correct
  // dataset. We append ?season= to the URL and let the composer handle it.
  // This keeps filtering logic simple and ensures crawlable URLs.

  seasonBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const season = btn.dataset.season;

      // Optimistic UI: update badge text before navigation
      if (sessionBadge) {
        const seasonLabel = season.charAt(0).toUpperCase() + season.slice(1);
        sessionBadge.querySelector('.session-badge__season').textContent = `${seasonLabel} Session`;
        sessionBadge.querySelector('.session-badge__dates').textContent  = btn.dataset.session;
      }

      const url = new URL(window.location.href);
      url.searchParams.set('season', season);
      window.location.href = url.toString();
    });
  });

  // ── Level pills ───────────────────────────────────────────────────────────

  levelPills.forEach(pill => {
    pill.addEventListener('click', () => {
      state.level = pill.dataset.level;

      // Update active state + aria
      levelPills.forEach(p => {
        const active = p.dataset.level === state.level;
        p.classList.toggle('is-active', active);
        p.setAttribute('aria-pressed', active ? 'true' : 'false');
      });

      applyFilters();
    });
  });

  // ── Day filter ────────────────────────────────────────────────────────────

  if (daySelect) {
    daySelect.addEventListener('change', () => {
      state.day = daySelect.value;
      applyFilters();
    });
  }

  // ── Schedule drawers ──────────────────────────────────────────────────────

  grid.addEventListener('click', e => {
    const toggleBtn = e.target.closest('.schedule-toggle');
    if (!toggleBtn) return;

    const card     = toggleBtn.closest('.program-card');
    const drawerId = toggleBtn.getAttribute('aria-controls');
    const drawer   = document.getElementById(drawerId);

    if (!drawer) return;

    const isOpen = toggleBtn.getAttribute('aria-expanded') === 'true';

    toggleBtn.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
    drawer.hidden    = isOpen;
    drawer.setAttribute('aria-hidden', isOpen ? 'true' : 'false');

    toggleBtn.querySelector('.schedule-toggle__label').textContent =
      isOpen ? 'View Schedule' : 'Hide Schedule';

    card.classList.toggle('program-card--schedule-open', !isOpen);
  });

  // ── Core filter logic ─────────────────────────────────────────────────────

  function applyFilters() {
    let visibleCount = 0;

    cards.forEach(card => {
      const levelMatch = state.level === 'all' || card.dataset.level === state.level;

      const cardDays  = (card.dataset.days || '').split(',').filter(Boolean);
      const dayMatch  = state.day === 'all' || cardDays.includes(state.day);

      const show = levelMatch && dayMatch;
      card.hidden = !show;

      // Respect prefers-reduced-motion for the fade
      if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        card.style.animationDelay = show ? `${visibleCount * 0.05}s` : '0s';
      }

      if (show) visibleCount++;
    });

    noResults.hidden = visibleCount > 0;
  }

});
