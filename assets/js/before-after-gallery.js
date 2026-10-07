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
  const wideDesktop = window.matchMedia('(min-width: 1200px)');
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

    const desktopWide = wideDesktop.matches;
    const positions = desktopWide
      ? [
          { x: 0, y: 0 },
          { x: -408, y: -213 },
          { x: 408, y: -213 },
          { x: -408, y: 208 },
          { x: 408, y: 208 },
        ]
      : [
          { x: 0, y: 0 },
          { x: -320, y: -213 },
          { x: 320, y: -213 },
          { x: -320, y: 208 },
          { x: 320, y: 208 },
        ];

    gsap.set(cards, {
      autoAlpha: 0,
      xPercent: 50,
      yPercent: 0,
      y: () => -window.innerHeight * 1.2,
      rotation: 45,
      transformOrigin: 'center center',
    });
    gsap.set(heading, { y: 214, opacity: 1 });
    gsap.set(action, { y: 20, autoAlpha: 0 });
    gsap.set(focusCard, { rotateY: 0 });

    reveal = gsap.timeline({
      paused: true,
      defaults: { ease: 'power3.out' },
      scrollTrigger: { trigger: gallery, start: 'top 72%', once: true },
    })
      .to(heading, { y: 0, duration: 0.8 })
      .to(cards, {
        autoAlpha: 1,
        xPercent: -50,
        yPercent: -50,
        x: (index) => positions[index].x,
        y: (index) => positions[index].y,
        rotation: 0,
        duration: 0.95,
        stagger: 0.12,
      }, '-=0.2')
      .to(action, { y: 0, autoAlpha: 1, duration: 0.55 }, '-=0.18')
      .call(startImageCycle);
  };
  makeAnimation();
  desktopOnly.addEventListener('change', makeAnimation);
  wideDesktop.addEventListener('change', makeAnimation);
});
