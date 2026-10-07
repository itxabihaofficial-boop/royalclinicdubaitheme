/**
 * Dynamic Clinic - Scroll Animations & Text Color Fill
 * Creates the Awwwards-style text fill on scroll effect
 * Resolves color tokens dynamically from global CSS custom properties.
 * Supports GSAP ScrollTrigger with zero-dependency vanilla fallback.
 */

document.addEventListener('DOMContentLoaded', () => {
  initScrollTextFill();
  initScrollStackCards();
  initHeaderScroll();
});

/**
 * Text Color Fill on Scroll
 * Splits the statement text into words, then progressively illuminates each word
 * using the global color tokens as the user scrolls through the section.
 */
function initScrollTextFill() {
  const headline = document.querySelector('.scroll-fill-headline');
  if (!headline) return;

  // Split text into individual span words if not already split
  const rawText = headline.innerText.trim();
  const words = rawText.split(/\s+/);
  
  headline.innerHTML = words
    .map(word => `<span class="fill-word">${word}</span>`)
    .join(' ');

  const wordSpans = headline.querySelectorAll('.fill-word');
  const section = headline.closest('.section-scroll-reveal');

  // Read global tokens dynamically
  const rootStyles = getComputedStyle(document.documentElement);
  const colorDim = rootStyles.getPropertyValue('--text-dim').trim() || 'rgba(99, 59, 44, 0.35)';
  const colorLight = rootStyles.getPropertyValue('--color-espresso').trim() || '#633b2c';

  // GSAP ScrollTrigger implementation if available
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    gsap.fromTo(
      wordSpans,
      {
        color: colorDim,
        opacity: 0.35,
        y: 6
      },
      {
        color: colorLight,
        opacity: 1,
        y: 0,
        stagger: 0.1,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: section,
          start: 'top 75%',
          end: 'bottom 45%',
          scrub: 0.8,
        }
      }
    );
  } else {
    // High-performance Vanilla fallback using requestAnimationFrame & scroll calculations
    const updateWordFills = () => {
      if (!section) return;
      const rect = section.getBoundingClientRect();
      const viewportH = window.innerHeight;

      // Start when section top is at 80% viewport, end when top is at 10%
      const start = viewportH * 0.8;
      const end = viewportH * 0.15;
      const totalDist = start - end;
      const current = start - rect.top;

      let progress = Math.max(0, Math.min(1, current / totalDist));
      const activeCount = Math.floor(progress * wordSpans.length);

      wordSpans.forEach((span, idx) => {
        if (idx <= activeCount) {
          span.style.color = colorLight;
          span.style.opacity = '1';
          span.style.transform = 'translateY(0)';
        } else {
          span.style.color = colorDim;
          span.style.opacity = '0.4';
          span.style.transform = 'translateY(4px)';
        }
      });
    };

    window.addEventListener('scroll', () => requestAnimationFrame(updateWordFills), { passive: true });
    updateWordFills();
  }
}

/**
 * Header scroll â€” adds/removes .scrolled class so CSS tokens handle appearance
 */
function initHeaderScroll() {
  const header = document.querySelector('.site-header');
  if (!header) return;

  const onScroll = () => {
    if (window.scrollY > 20) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll(); // run once on load
}

/**
 * React-Style Scroll Stack Cards Animation (GSAP ScrollTrigger)
 * Dynamically binds each stacked treatment card to scroll progress.
 * As each subsequent card scrolls up and stacks over the previous cards,
 * earlier cards stay fully bright, crisp, and visible while subtly scaling
 * to create a seamless, elegant luxury card deck stacking effect.
 */
function initScrollStackCards() {
  const stackContainer = document.querySelector('.treatments-stack-container');
  if (!stackContainer) return;

  const cards = Array.from(stackContainer.querySelectorAll('.treatment-stack-card'));
  if (!cards.length) return;

  // Set card-index and z-index for clean sticky stacking order
  cards.forEach((card, index) => {
    card.style.setProperty('--card-index', index);
    card.style.zIndex = index + 10;
  });

  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    cards.forEach((card, index) => {
      // The last card does not need to scale down for another card
      if (index === cards.length - 1) return;

      const nextCard = cards[index + 1];
      // Subtle, refined scale reduction to create layered physical deck depth
      // Leaves all cards 100% visible, fully opaque, crisp, and bright
      const targetScale = Math.max(0.94, 1 - (cards.length - index) * 0.018);

      gsap.to(card, {
        scale: targetScale,
        opacity: 1,
        transformOrigin: 'top center',
        ease: 'none',
        scrollTrigger: {
          trigger: nextCard,
          start: 'top 85%',
          end: 'top 20%',
          scrub: 0.5,
        }
      });
    });

    window.addEventListener('resize', () => {
      ScrollTrigger.refresh();
    }, { passive: true });
  }
}
