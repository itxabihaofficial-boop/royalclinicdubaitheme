<?php
/**
 * The Footer for Dynamic Clinic Theme
 *
 * Glowence-style footer:
 * - 5-column links grid (Explore, Company Info, Treatments, About, Social)
 * - Copyright bar with hairline separator
 * - Giant display brand name with bronze dot
 *
 * @package DynamicClinic
 */

$clinic_name = function_exists('get_field') ? get_field('clinic_brand_name', 'option') : '';
if ( empty($clinic_name) ) {
    $clinic_name = get_bloginfo('name');
}
if ( empty($clinic_name) ) {
    $clinic_name = 'Dynamic Clinic';
}

$clinic_name_upper = strtoupper( $clinic_name );
?>
<footer class="site-footer" id="contact">

    <!-- Top Links Grid -->
    <div class="footer-grid-wrap">

        <div class="footer-col">
            <h4 class="footer-col-heading">Explore</h4>
            <ul class="footer-links">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#philosophy">About</a></li>
                <li><a href="#book">Pricing</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-col-heading">Company Info</h4>
            <ul class="footer-links">
                <li><a href="#philosophy">About Us</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#book">Book Appointment</a></li>
                <li><a href="#book">Enroll in a Course</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-col-heading">Treatments</h4>
            <ul class="footer-links">
                <li><a href="#services">Skin Rejuvenation</a></li>
                <li><a href="#services">Hair Therapy</a></li>
                <li><a href="#services">Body Wellness</a></li>
                <li><a href="#services">Laser Clinic</a></li>
            </ul>
        </div>

        <div class="footer-col footer-col--about">
            <h4 class="footer-col-heading">About</h4>
            <p class="footer-about-text">At <?php echo esc_html( $clinic_name ); ?>, we blend botanical care with modern technique to create hair, skin and wellness rituals that leave every guest feeling calm, confident and completely themselves.</p>
        </div>

        <div class="footer-col">
            <h4 class="footer-col-heading">Social</h4>
            <div class="footer-social">
                <a href="<?php echo esc_url( function_exists('get_field') ? get_field('social_instagram', 'option') : '#' ); ?>" class="footer-social-btn" aria-label="Instagram">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
                <a href="<?php echo esc_url( function_exists('get_field') ? get_field('social_facebook', 'option') : '#' ); ?>" class="footer-social-btn" aria-label="Facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="<?php echo esc_url( function_exists('get_field') ? get_field('social_tiktok', 'option') : '#' ); ?>" class="footer-social-btn" aria-label="TikTok">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                </a>
            </div>
        </div>

    </div>

    <!-- Copyright Bar -->
    <div class="footer-copy-bar">
        <span>&copy; Copyright &ndash; <?php echo esc_html( $clinic_name ); ?> &nbsp;|&nbsp; <?php echo date('Y'); ?> &nbsp;|&nbsp; All Rights Reserved</span>
    </div>

    <!-- Giant Brand Display Name -->
    <div class="footer-display-brand" aria-hidden="true">
        <span class="footer-display-text"><?php echo esc_html( $clinic_name_upper ); ?></span><span class="footer-display-dot">.</span>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
