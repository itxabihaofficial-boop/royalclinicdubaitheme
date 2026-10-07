/** Dynamic Clinic - Testimonials carousel */
document.addEventListener('DOMContentLoaded', () => {
  const section = document.querySelector('[data-testimonials]');
  if (!section) return;

  const cards = Array.from(section.querySelectorAll('[data-testimonial-card]'));
  const previous = section.querySelector('[data-testimonial-prev]');
  const next = section.querySelector('[data-testimonial-next]');
  const current = section.querySelector('[data-testimonial-current]');
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!cards.length || !previous || !next) return;

  let start = 0;
  let timer;
  const render = () => {
    cards.forEach((card, index) => {
      const visible = index === start || index === (start + 1) % cards.length;
      card.hidden = !visible;
      card.classList.toggle('is-active', visible);
    });
    if (current) current.textContent = String(start + 1).padStart(2, '0');
  };
  const move = (direction) => { start = (start + direction + cards.length) % cards.length; render(); };
  const stop = () => { window.clearInterval(timer); timer = undefined; };
  const play = () => { if (!reduceMotion) { stop(); timer = window.setInterval(() => move(1), 6500); } };

  previous.addEventListener('click', () => { move(-1); play(); });
  next.addEventListener('click', () => { move(1); play(); });
  section.addEventListener('mouseenter', stop);
  section.addEventListener('mouseleave', play);
  section.addEventListener('focusin', stop);
  section.addEventListener('focusout', (event) => { if (!section.contains(event.relatedTarget)) play(); });
  render();
  play();
});