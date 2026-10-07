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
 * Header scroll — adds/removes .scrolled class so CSS tokens handle appearance
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
 * React-Style Scroll Stack Cards Animation (Framer Motion / GSAP ScrollTrigger)
 * Dynamically binds each stacked treatment card to scroll progress.
 * As each next card scrolls up and enters the sticky stack, earlier cards
 * scale down smoothly, gain subtle ambient depth and blur, creating a tactile card deck stacking illusion.
 */
function initScrollStackCards() {
  const stackContainer = document.querySelector('.treatments-stack-container');
  if (!stackContainer) return;

  const cards = Array.from(stackContainer.querySelectorAll('.treatment-stack-card'));
  if (!cards.length) return;

  // Set card-index for CSS sticky positioning
  cards.forEach((card, index) => {
    card.style.setProperty('--card-index', index);
  });

  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    cards.forEach((card, index) => {
      // The last card does not need to scale down for another card
      if (index === cards.length - 1) return;

      const nextCard = cards[index + 1];
      const targetScale = Math.max(0.88, 1 - (cards.length - index) * 0.035);

      gsap.to(card, {
        scale: targetScale,
        opacity: 0.65,
        filter: 'brightness(0.9) blur(1px)',
        transformOrigin: 'top center',
        ease: 'none',
        scrollTrigger: {
          trigger: nextCard,
          start: 'top 85%',
          end: 'top 18%',
          scrub: 0.4,
        }
      });
    });

    window.addEventListener('resize', () => {
      ScrollTrigger.refresh();
    }, { passive: true });
  }
}
