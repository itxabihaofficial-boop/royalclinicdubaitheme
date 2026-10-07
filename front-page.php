<?php
/**
 * The Front Page Template for Dynamic Clinic
 *
 * Displays the Hero section with curved orbital cards conveyor,
 * the on-scroll text color fill philosophy section,
 * signature treatments grid, and the luxury booking CTA.
 *
 * @package DynamicClinic
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- 1. Hero with Infinite Curved Arc Cards Carousel -->
    <?php get_template_part( 'template-parts/hero-orbit' ); ?>

    <!-- 2. On-Scroll Text Color Fill (Philosophy Section) -->
    <?php get_template_part( 'template-parts/section-scroll-reveal' ); ?>

    <!-- 3. Signature Skin & Wellness Treatments -->
    <?php get_template_part( 'template-parts/section-services' ); ?>

    <!-- 4. Before & After Results Gallery -->
    <?php get_template_part( 'template-parts/section-results' ); ?>

    <!-- 5. Luxury Private Booking CTA -->
    <?php get_template_part( 'template-parts/section-cta' ); ?>

</main>

<?php
get_footer();
