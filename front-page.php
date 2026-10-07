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

    <!-- 5. Clinical Specialists Directory -->
    <?php get_template_part( 'template-parts/section-specialists' ); ?>

    <!-- 6. Why Patients Choose Us -->
    <?php get_template_part( 'template-parts/section-why-clinic' ); ?>

    <!-- 7. Patient Testimonials -->
    <?php get_template_part( 'template-parts/section-testimonials' ); ?>

    <!-- 8. Skin Insights -->
    <?php get_template_part( 'template-parts/section-insights' ); ?>

    <!-- 9. Appointment Request -->
    <?php get_template_part( 'template-parts/section-cta' ); ?>

</main>

<?php
get_footer();
