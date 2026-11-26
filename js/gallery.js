/*
 * Simple image viewer (replacement for Lightbox, no dependencies).
 * Any <a href="image.jpg" data-lightbox="group"> opens the image in an overlay;
 * links with the same data-lightbox value form one gallery with prev/next.
 */
(function () {
  'use strict';

  const SWIPE_DISTANCE = 50;
  let overlay = null;
  let img;
  let counter;
  let prevBtn;
  let nextBtn;
  let loader;
  let group = [];
  let index = 0;
  let touchX = null;

  function preload(link) {
    if (link) {
      const image = new Image();
      image.src = link.getAttribute('href');
    }
  }

  function show(i) {
    if (i < 0 || i >= group.length) return;
    index = i;
    img.style.visibility = 'hidden';
    loader.style.display = 'block';
    img.src = group[i].getAttribute('href');
    img.alt = group[i].querySelector('img')?.alt || '';
    counter.textContent = group.length > 1 ? `Obrázok ${i + 1} / ${group.length}` : '';
    prevBtn.style.display = i > 0 ? 'block' : 'none';
    nextBtn.style.display = i < group.length - 1 ? 'block' : 'none';
    // preload neighbours so stepping through a gallery is quick
    preload(group[i - 1]);
    preload(group[i + 1]);
  }

  function close() {
    overlay.style.display = 'none';
    document.body.classList.remove('gv-open');
    img.removeAttribute('src');
  }

  function build() {
    overlay = document.createElement('div');
    overlay.className = 'gv-overlay';
    overlay.innerHTML =
      '<div class="gv-stage">' +
        '<img class="gv-loader" src="img/loading.gif" alt="">' +
        '<img class="gv-img" alt="">' +
        '<button type="button" class="gv-prev" aria-label="Predchádzajúci"></button>' +
        '<button type="button" class="gv-next" aria-label="Ďalší"></button>' +
      '</div>' +
      '<div class="gv-bar"><span class="gv-counter"></span>' +
        '<button type="button" class="gv-close" aria-label="Zavrieť"></button></div>';
    document.body.appendChild(overlay);

    img = overlay.querySelector('.gv-img');
    loader = overlay.querySelector('.gv-loader');
    counter = overlay.querySelector('.gv-counter');
    prevBtn = overlay.querySelector('.gv-prev');
    nextBtn = overlay.querySelector('.gv-next');

    img.addEventListener('load', () => {
      loader.style.display = 'none';
      img.style.visibility = 'visible';
    });
    prevBtn.addEventListener('click', (e) => { e.stopPropagation(); show(index - 1); });
    nextBtn.addEventListener('click', (e) => { e.stopPropagation(); show(index + 1); });
    overlay.querySelector('.gv-close').addEventListener('click', close);
    // click on the dark background (not on the photo or the arrows) closes the viewer
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay || e.target.classList.contains('gv-stage')) close();
    });
    overlay.addEventListener('touchstart', (e) => { touchX = e.changedTouches[0].clientX; }, { passive: true });
    overlay.addEventListener('touchend', (e) => {
      if (touchX === null) return;
      const dx = e.changedTouches[0].clientX - touchX;
      touchX = null;
      if (Math.abs(dx) > SWIPE_DISTANCE) show(index + (dx < 0 ? 1 : -1));
    });
  }

  function open(link) {
    if (!overlay) build();
    const name = link.dataset.lightbox;
    group = Array.from(document.querySelectorAll('a[data-lightbox]'))
      .filter((a) => a.dataset.lightbox === name);
    overlay.style.display = 'flex';
    document.body.classList.add('gv-open');
    show(group.indexOf(link));
  }

  document.addEventListener('click', (e) => {
    const link = e.target.closest('a[data-lightbox]');
    if (!link || e.ctrlKey || e.metaKey || e.shiftKey || e.button !== 0) return;
    e.preventDefault();
    open(link);
  });

  // "Zobraziť ďalšie fotky": the gallery page starts with the first batch, each click shows the next one
  const moreButton = document.querySelector('.gallery-more-button');
  if (moreButton) {
    const gallery = document.getElementById(moreButton.getAttribute('aria-controls'));
    const pageSize = Number(gallery.dataset.pageSize) || 30;
    const counter = document.querySelector('.gallery-count');
    const links = Array.from(gallery.querySelectorAll('a[data-lightbox]'));
    moreButton.addEventListener('click', () => {
      const next = links.filter((a) => a.hidden).slice(0, pageSize);
      for (const link of next) link.hidden = false;
      const visible = links.filter((a) => !a.hidden).length;
      counter.textContent = `${visible} / ${links.length}`;
      if (visible === links.length) moreButton.parentElement.hidden = true;
    });
  }

  document.addEventListener('keydown', (e) => {
    if (overlay?.style.display !== 'flex') return;
    if (e.key === 'Escape') close();
    else if (e.key === 'ArrowLeft') show(index - 1);
    else if (e.key === 'ArrowRight') show(index + 1);
  });
})();
