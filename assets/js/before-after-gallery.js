/**
 * Dynamic Clinic - Before & After Gallery
 * Recreates the focal-card flip and fanned image reveal used in the reference.
 */

document.addEventListener('DOMContentLoaded', () => {
  const gallery = document.querySelector('.results-proof');
  if (!gallery || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const focusCard = gallery.querySelector('.results-flip-card');
  const focusFront = gallery.querySelector('.results-focus-front');
  const focusBack = gallery.querySelector('.results-focus-back');
  const cards = gallery.querySelectorAll('.results-card');
  const heading = gallery.querySelector('.results-heading');
  const action = gallery.querySelector('.results-action');

  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
  gsap.registerPlugin(ScrollTrigger);

  const desktopOnly = window.matchMedia('(min-width: 1000px)');
  let reveal;
  let cycle;

  const reset = () => {
    if (reveal) reveal.kill();
    if (cycle) cycle.kill();
    cycle = null;
    gsap.set([heading, action, ...cards], { clearProps: 'all' });
    gsap.set(focusCard, { clearProps: 'transform' });
  };

  const startImageCycle = () => {
    if (!focusCard || cycle) return;
    const sources = Array.from(cards).map((card) => {
      const image = card.querySelector('img');
      return image ? image.currentSrc || image.src : '';
    }).filter(Boolean);
    if (sources.length < 2) return;

    let imageIndex = 1;
    let showingBack = false;
    cycle = gsap.timeline({ repeat: -1, repeatDelay: 0.45 });

    for (let turn = 0; turn < sources.length - 1; turn += 1) {
      cycle.call(() => {
        const nextFace = showingBack ? focusFront : focusBack;
        nextFace.src = sources[imageIndex % sources.length];
        imageIndex += 1;
      });
      cycle.to(focusCard, {
        rotateY: '+=180',
        duration: 0.68,
        ease: 'power2.inOut',
        onComplete: () => { showingBack = !showingBack; },
      });
      cycle.to({}, { duration: 0.6 });
    }
  };

  const makeAnimation = () => {
    reset();
    if (!desktopOnly.matches) return;

    const sideCards = Array.from(cards).slice(1);
    const positions = [
      { xPercent: -145, yPercent: -80, rotation: -7 },
      { xPercent: 145, yPercent: -80, rotation: 7 },
      { xPercent: -145, yPercent: 80, rotation: 5 },
      { xPercent: 145, yPercent: 80, rotation: -5 },
    ];

    gsap.set(sideCards, { xPercent: 0, yPercent: 0, rotation: 0, opacity: 0, scale: 0.82 });
    gsap.set([heading, action], { y: 36, opacity: 0 });
    gsap.set(focusCard, { rotateY: 0 });

    reveal = gsap.timeline({
      paused: true,
      defaults: { ease: 'power3.out' },
      scrollTrigger: { trigger: gallery, start: 'top 72%', once: true },
    })
      .to(heading, { y: 0, opacity: 1, duration: 0.7 })
      .to(sideCards, {
        opacity: 1,
        scale: 1,
        duration: 0.9,
        stagger: 0.08,
        onStart: () => sideCards.forEach((card, index) => gsap.to(card, { ...positions[index], duration: 0.9, ease: 'power3.out' })),
      }, '-=0.22')
      .to(action, { y: 0, opacity: 1, duration: 0.55 }, '-=0.25')
      .call(startImageCycle);
  };

  makeAnimation();
  desktopOnly.addEventListener('change', makeAnimation);
});
