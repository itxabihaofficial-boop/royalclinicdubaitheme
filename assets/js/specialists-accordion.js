/**
 * Dynamic Clinic - Specialists Accordion
 * Accessible, single-open accordion enhanced with subtle GSAP entrance motion.
 */

document.addEventListener('DOMContentLoaded', () => {
  const directory = document.querySelector('[data-specialists-directory]');
  if (!directory) return;

  const cards = Array.from(directory.querySelectorAll('[data-specialist-card]'));
  const toggles = cards.map((card) => card.querySelector('.specialist-toggle')).filter(Boolean);
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  const setCardState = (card, open) => {
    const toggle = card.querySelector('.specialist-toggle');
    const panel = card.querySelector('.specialist-panel');
    const label = card.querySelector('.specialist-toggle-label');
    if (!toggle || !panel || !label) return;

    card.classList.toggle('is-open', open);
    toggle.setAttribute('aria-expanded', String(open));
    panel.setAttribute('aria-hidden', String(!open));
    label.textContent = open ? 'Close profile' : 'Meet the specialist';
  };

  const openCard = (selected) => {
    cards.forEach((card) => setCardState(card, card === selected));
    window.requestAnimationFrame(() => {
      if (typeof ScrollTrigger !== 'undefined') ScrollTrigger.refresh();
    });
  };

  toggles.forEach((toggle, index) => {
    toggle.addEventListener('click', () => {
      const card = cards[index];
      const isOpen = card.classList.contains('is-open');
      isOpen ? setCardState(card, false) : openCard(card);
    });

    toggle.addEventListener('keydown', (event) => {
      let nextIndex = null;
      if (event.key === 'ArrowDown') nextIndex = (index + 1) % toggles.length;
      if (event.key === 'ArrowUp') nextIndex = (index - 1 + toggles.length) % toggles.length;
      if (event.key === 'Home') nextIndex = 0;
      if (event.key === 'End') nextIndex = toggles.length - 1;
      if (nextIndex === null) return;
      event.preventDefault();
      toggles[nextIndex].focus();
    });
  });

  if (reducedMotion || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
  gsap.registerPlugin(ScrollTrigger);
  gsap.from(cards, {
    y: 38,
    opacity: 0,
    duration: 0.8,
    stagger: 0.12,
    ease: 'power3.out',
    scrollTrigger: { trigger: directory, start: 'top 78%', once: true },
  });
});