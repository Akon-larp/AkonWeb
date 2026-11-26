/*
 * Simple image viewer (replacement for Lightbox, no dependencies).
 * Any <a href="image.jpg" data-lightbox="group"> opens the image in an overlay;
 * links with the same data-lightbox value form one gallery with prev/next.
 */
(function () {
  var overlay, img, counter, prevBtn, nextBtn, loader;
  var group = [], index = 0, touchX = null;

  function build() {
    overlay = document.createElement('div');
    overlay.className = 'gv-overlay';
    overlay.innerHTML =
      '<div class="gv-stage">' +
        '<img class="gv-loader" src="img/loading.gif" alt="">' +
        '<img class="gv-img" alt="">' +
        '<a class="gv-prev" href="#" aria-label="Predchádzajúci"></a>' +
        '<a class="gv-next" href="#" aria-label="Ďalší"></a>' +
      '</div>' +
      '<div class="gv-bar"><span class="gv-counter"></span>' +
        '<a class="gv-close" href="#" aria-label="Zavrieť"></a></div>';
    document.body.appendChild(overlay);

    img = overlay.querySelector('.gv-img');
    loader = overlay.querySelector('.gv-loader');
    counter = overlay.querySelector('.gv-counter');
    prevBtn = overlay.querySelector('.gv-prev');
    nextBtn = overlay.querySelector('.gv-next');

    img.addEventListener('load', function () {
      loader.style.display = 'none';
      img.style.visibility = 'visible';
    });
    prevBtn.addEventListener('click', function (e) { e.preventDefault(); e.stopPropagation(); show(index - 1); });
    nextBtn.addEventListener('click', function (e) { e.preventDefault(); e.stopPropagation(); show(index + 1); });
    overlay.querySelector('.gv-close').addEventListener('click', function (e) { e.preventDefault(); close(); });
    // click on the dark background (not on the photo or the arrows) closes the viewer
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay || e.target.className === 'gv-stage') close();
    });
    overlay.addEventListener('touchstart', function (e) { touchX = e.changedTouches[0].clientX; }, { passive: true });
    overlay.addEventListener('touchend', function (e) {
      if (touchX === null) return;
      var dx = e.changedTouches[0].clientX - touchX;
      touchX = null;
      if (Math.abs(dx) > 50) show(index + (dx < 0 ? 1 : -1));
    });
  }

  function show(i) {
    if (i < 0 || i >= group.length) return;
    index = i;
    img.style.visibility = 'hidden';
    loader.style.display = 'block';
    img.src = group[i].getAttribute('href');
    counter.textContent = group.length > 1 ? 'Obrázok ' + (i + 1) + ' / ' + group.length : '';
    prevBtn.style.display = i > 0 ? 'block' : 'none';
    nextBtn.style.display = i < group.length - 1 ? 'block' : 'none';
    // preload neighbours so stepping through a gallery is quick
    [i - 1, i + 1].forEach(function (n) {
      if (group[n]) new Image().src = group[n].getAttribute('href');
    });
  }

  function open(link) {
    if (!overlay) build();
    var name = link.getAttribute('data-lightbox');
    group = Array.prototype.slice.call(
      document.querySelectorAll('a[data-lightbox="' + name + '"]'));
    overlay.style.display = 'flex';
    document.body.classList.add('gv-open');
    show(group.indexOf(link));
  }

  function close() {
    overlay.style.display = 'none';
    document.body.classList.remove('gv-open');
    img.removeAttribute('src');
  }

  document.addEventListener('click', function (e) {
    var link = e.target.closest && e.target.closest('a[data-lightbox]');
    if (!link || e.ctrlKey || e.metaKey || e.shiftKey || e.button !== 0) return;
    e.preventDefault();
    open(link);
  });

  document.addEventListener('keydown', function (e) {
    if (!overlay || overlay.style.display !== 'flex') return;
    if (e.key === 'Escape') close();
    else if (e.key === 'ArrowLeft') show(index - 1);
    else if (e.key === 'ArrowRight') show(index + 1);
  });
})();
