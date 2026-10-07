/**
 * Dynamic Clinic - Why Patients Choose Us
 * Comparison slider, testimonial motion, and accessible count-up details.
 */
document.addEventListener('DOMContentLoaded', () => {
  const section = document.querySelector('[data-why-clinic]');
  if (!section) return;

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const counters = Array.from(section.querySelectorAll('[data-count]'));
  const setCounter = (element, value) => {
    const decimals = Number(element.dataset.decimals || 0);
    const suffix = element.dataset.suffix || '';
    element.textContent = `${Number(value).toFixed(decimals)}${suffix}`;
  };

  section.querySelectorAll('[data-comparison]').forEach((comparison) => {
    const slider = comparison.querySelector('.comparison-range');
    if (!slider) return;
    const updateComparison = () => comparison.style.setProperty('--comparison-position', `${slider.value}%`);
    slider.addEventListener('input', updateComparison);
    updateComparison();
  });

  if (reducedMotion || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    counters.forEach((counter) => setCounter(counter, counter.dataset.count));
    return;
  }

  gsap.registerPlugin(ScrollTrigger);
  const heading = section.querySelector('[data-why-reveal]');
  const cards = section.querySelectorAll('[data-why-card]');
  gsap.timeline({
    defaults: { ease: 'power3.out' },
    scrollTrigger: { trigger: section, start: 'top 72%', once: true },
  })
    .from(heading, { y: 36, opacity: 0, duration: 0.75 })
    .from(cards, { y: 42, opacity: 0, duration: 0.85, stagger: 0.075 }, '-=0.35');

  counters.forEach((counter) => {
    const target = Number(counter.dataset.count);
    const state = { value: 0 };
    ScrollTrigger.create({
      trigger: counter,
      start: 'top 88%',
      once: true,
      onEnter: () => gsap.to(state, {
        value: target,
        duration: 1.45,
        ease: 'power2.out',
        onUpdate: () => setCounter(counter, state.value),
      }),
    });
  });
});