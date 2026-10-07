/**
 * Dynamic Clinic - Infinite Curved Arc Cards Carousel
 * Creates a continuous, silky-smooth motion along a sweeping bezier arc
 * mathematically calculated and sampled in real time.
 */

class HeroOrbitCarousel {
  constructor(containerSelector = '.hero-orbit-stage') {
    this.stage = document.querySelector(containerSelector);
    if (!this.stage) return;

    this.track = this.stage.querySelector('.orbit-cards-track');
    this.cards = Array.from(this.stage.querySelectorAll('.orbit-card'));
    if (!this.cards.length) return;

    // SVG reference path for exact arc length sampling
    this.svg = null;
    this.path = null;
    this.totalLength = 0;

    // Motion parameters
    this.baseSpeed = 0.75;           // Pixels moved per frame
    this.currentSpeed = this.baseSpeed;
    this.targetSpeed = this.baseSpeed;
    this.progress = 0;               // Continuous distance offset along path
    this.isHovered = false;
    this.isDragging = false;
    this.dragStartX = 0;
    this.dragProgressStart = 0;

    this.init();
  }

  init() {
    this.createPath();
    this.updateDimensions();
    this.bindEvents();
    this.startLoop();
  }

  createPath() {
    // Create hidden SVG container with path for mathematical sampling
    this.svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    this.svg.setAttribute('style', 'position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;opacity:0;');

    this.path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    this.svg.appendChild(this.path);
    this.stage.appendChild(this.svg);
  }

  updateDimensions() {
    const rect = this.stage.getBoundingClientRect();
    const w = rect.width || window.innerWidth;
    const h = rect.height || window.innerHeight;

    /**
     * Curved Arc Geometry:
     * Starts from bottom-left (entering from off-screen),
     * sweeps up and arches over the center title,
     * and slopes gracefully down to the bottom-right.
     */
    const startX = -w * 0.02;
    const startY = h * 0.98;

    const cp1X = w * 0.08;
    const cp1Y = h * 0.02;

    const cp2X = w * 0.92;
    const cp2Y = h * 0.02;

    const endX = w * 1.02;
    const endY = h * 0.98;

    const d = `M ${startX} ${startY} C ${cp1X} ${cp1Y}, ${cp2X} ${cp2Y}, ${endX} ${endY}`;
    this.path.setAttribute('d', d);
    this.totalLength = this.path.getTotalLength();
  }

  bindEvents() {
    // Smooth resize debounce
    let resizeTimer;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        this.updateDimensions();
      }, 100);
    });

    // Hover deceleration
    // this.stage.addEventListener('mouseenter', () => {
    //   this.isHovered = true;
    //   this.targetSpeed = 0.18; // Gently slow down on hover so cards can be inspected
    // });

    // this.stage.addEventListener('mouseleave', () => {
    //   this.isHovered = false;
    //   this.targetSpeed = this.baseSpeed;
    // });

    // Touch and Drag interaction for tactile feel
    const handleDragStart = (e) => {
      this.isDragging = true;
      const clientX = e.touches ? e.touches[0].clientX : e.clientX;
      this.dragStartX = clientX;
      this.dragProgressStart = this.progress;
      this.targetSpeed = 0;
    };

    const handleDragMove = (e) => {
      if (!this.isDragging) return;
      const clientX = e.touches ? e.touches[0].clientX : e.clientX;
      const deltaX = clientX - this.dragStartX;
      this.progress = this.dragProgressStart - deltaX * 1.5;
    };

    const handleDragEnd = () => {
      if (!this.isDragging) return;
      this.isDragging = false;
      this.targetSpeed = this.isHovered ? 0.18 : this.baseSpeed;
    };

    this.stage.addEventListener('mousedown', handleDragStart);
    window.addEventListener('mousemove', handleDragMove);
    window.addEventListener('mouseup', handleDragEnd);

    this.stage.addEventListener('touchstart', handleDragStart, { passive: true });
    window.addEventListener('touchmove', handleDragMove, { passive: true });
    window.addEventListener('touchend', handleDragEnd);
  }

  startLoop() {
    const cardCount = this.cards.length;

    const step = () => {
      // Smooth lerp speed transition
      if (!this.isDragging) {
        this.currentSpeed += (this.targetSpeed - this.currentSpeed) * 0.06;
        this.progress += this.currentSpeed;
      }

      if (this.totalLength > 0 && cardCount > 0) {
        const interval = this.totalLength / cardCount;

        for (let i = 0; i < cardCount; i++) {
          const card = this.cards[i];

          // Distance along path with wrapping
          let dist = (this.progress + i * interval) % this.totalLength;
          if (dist < 0) dist += this.totalLength;

          // Sample coordinates from path
          const pt = this.path.getPointAtLength(dist);

          // Sample tangent for natural tilt
          const sampleDist = Math.min(this.totalLength, dist + 2);
          const nextPt = this.path.getPointAtLength(sampleDist);
          const angleRad = Math.atan2(nextPt.y - pt.y, nextPt.x - pt.x);
          const angleDeg = (angleRad * 180) / Math.PI;

          // Apply 3D hardware-accelerated transform
          card.style.transform = `translate3d(${pt.x}px, ${pt.y}px, 0) translate(-50%, -50%) rotate(${angleDeg}deg)`;
        }
      }

      requestAnimationFrame(step);
    };

    requestAnimationFrame(step);
  }
}

// Auto initialize on DOM ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => new HeroOrbitCarousel());
} else {
  new HeroOrbitCarousel();
}
