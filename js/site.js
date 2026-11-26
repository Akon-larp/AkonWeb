/*
 * Site behaviour (no dependencies):
 *  - collapsible sections on Príbeh / Pravidlá: <hN class="click"><button class="toggle">
 *    shows or hides the element right after the heading
 *  - menu sticks to the top of the screen once the page is scrolled past it
 */
(function () {
  'use strict';

  document.addEventListener('click', (event) => {
    const button = event.target.closest('button.toggle');
    if (!button) return;
    const section = button.parentElement.nextElementSibling;
    if (!section) return;
    const open = button.getAttribute('aria-expanded') !== 'true';
    section.style.display = open ? 'block' : '';
    button.setAttribute('aria-expanded', String(open));
  });

  // registration form: send to Formspree in the background and show the thank-you message
  const form = document.getElementById('registracia');
  if (form) {
    const thanks = document.getElementById('thank_you_msg');
    const error = document.getElementById('form_error');
    const submit = form.querySelector('button[type="submit"]');
    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      error.hidden = true;
      submit.disabled = true;
      try {
        const response = await fetch(form.action, {
          method: 'POST',
          body: new FormData(form),
          headers: { Accept: 'application/json' },
        });
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        form.hidden = true;
        thanks.hidden = false;
      } catch (err) {
        console.error('Registrácia sa neodoslala:', err);
        error.hidden = false;
      } finally {
        submit.disabled = false;
      }
    });
  }

  const menu = document.getElementById('menu');
  if (!menu) return;
  let stickAt = null;

  const updateSticky = () => {
    if (!menu.classList.contains('sticky')) {
      // measured while the menu is in its normal place (the banner may still be loading)
      stickAt = menu.offsetTop;
    }
    menu.classList.toggle('sticky', globalThis.scrollY >= stickAt);
  };

  globalThis.addEventListener('scroll', updateSticky, { passive: true });
  globalThis.addEventListener('load', updateSticky);
  updateSticky();
})();
