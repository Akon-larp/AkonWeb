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

  // registration form: send to FormSubmit (formsubmit.co) in the background and show the thank-you message.
  // The form's action is https://formsubmit.co/<address>; the AJAX endpoint is https://formsubmit.co/ajax/<address>.
  const form = document.getElementById('registracia');
  if (form) {
    const thanks = document.getElementById('thank_you_msg');
    const error = document.getElementById('form_error');
    const errorText = error.querySelector('.form_error_title');
    const defaultError = errorText.textContent;
    const submit = form.querySelector('button[type="submit"]');
    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      error.hidden = true;
      submit.disabled = true;
      try {
        const data = new FormData(form);
        data.append('_replyto', form.querySelector('#email').value); // "Reply" in the email goes to the player
        const response = await fetch(form.action.replace('formsubmit.co/', 'formsubmit.co/ajax/'), {
          method: 'POST',
          body: data,
          headers: { Accept: 'application/json' },
        });
        const result = await response.json().catch(() => ({}));
        // FormSubmit answers {"success": "true"} or {"success": "false", "message": "..."}
        if (!response.ok || String(result.success) !== 'true') {
          throw new Error(result.message || `HTTP ${response.status}`);
        }
        form.hidden = true;
        thanks.hidden = false;
      } catch (err) {
        console.error('Registrácia sa neodoslala:', err);
        errorText.textContent = err.message.startsWith('HTTP') ? defaultError : `${defaultError} (${err.message})`;
        error.hidden = false;
      } finally {
        submit.disabled = false;
      }
    });
  }

  const menu = document.getElementById('menu');
  const content = document.getElementById('content');
  if (!menu || !content) return;
  let stickAt = null;

  // While the menu is fixed it no longer takes up space, so the page would jump up.
  // A spacer takes its place; its height is exactly how far the content moved.
  const spacer = document.createElement('div');
  spacer.className = 'menu-spacer';
  spacer.setAttribute('aria-hidden', 'true');
  spacer.hidden = true;
  menu.after(spacer);

  const setSticky = (on) => {
    if (on === menu.classList.contains('sticky')) return;
    if (on) {
      const before = content.getBoundingClientRect().top;
      menu.classList.add('sticky');
      spacer.style.height = '0px';
      spacer.hidden = false;
      spacer.style.height = `${before - content.getBoundingClientRect().top}px`;
    } else {
      menu.classList.remove('sticky');
      spacer.hidden = true;
    }
  };

  const updateSticky = () => {
    if (!menu.classList.contains('sticky')) {
      // measured while the menu is in its normal place (the banner may still be loading)
      stickAt = menu.offsetTop;
    }
    setSticky(globalThis.scrollY >= stickAt);
  };

  globalThis.addEventListener('scroll', updateSticky, { passive: true });
  globalThis.addEventListener('load', updateSticky);
  // the menu's height changes with the screen width (it wraps on phones): measure again
  globalThis.addEventListener('resize', () => {
    setSticky(false);
    updateSticky();
  });
  updateSticky();
})();
