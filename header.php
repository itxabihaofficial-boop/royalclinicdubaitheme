<?php
/**
 * The Header for Dynamic Clinic Theme
 *
 * Flat three-column navigation bar (Dermato style):
 * Left = nav links | Center = brand logo | Right = CTA button
 *
 * @package DynamicClinic
 */
?><?php // phpcs:ignore ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
    <div class="nav-pill-wrapper">
        <nav class="nav-pill" aria-label="<?php esc_attr_e( 'Main Navigation', 'dynamic-clinic' ); ?>">

            <!-- Left: Desktop Navigation Menu -->
            <?php
            if ( has_nav_menu( 'primary-menu' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'nav-menu',
                    'fallback_cb'    => false,
                    'depth'          => 2,
                ) );
            } else {
                // Default Menu
                ?>
                <ul class="nav-menu">
                    <li class="nav-item current-menu-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#philosophy" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#services" class="nav-link">Services <span class="nav-arrow">▾</span></a></li>
                    <li class="nav-item"><a href="#services" class="nav-link">Academy <span class="nav-arrow">▾</span></a></li>
                    <li class="nav-item"><a href="#philosophy" class="nav-link">Journal <span class="nav-arrow">▾</span></a></li>
                    <li class="nav-item"><a href="#book" class="nav-link">Contact</a></li>
                </ul>
                <?php
            }
            ?>

            <!-- Center: Brand Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
                <span class="logo-badge-icon" aria-hidden="true"></span>
                <span><?php
                    $clinic_name = function_exists('get_field') ? get_field('clinic_brand_name', 'option') : '';
                    if ( empty($clinic_name) ) {
                        $clinic_name = get_bloginfo('name');
                    }
                    if ( empty($clinic_name) ) {
                        $clinic_name = 'Dynamic Clinic';
                    }
                    echo esc_html( $clinic_name );
                ?></span>
            </a>

            <!-- Right: Appointment CTA Button -->
            <?php
            $nav_btn_text = function_exists('get_field') ? get_field('header_appointment_cta_text', 'option') : 'Book Appointment';
            $nav_btn_link = function_exists('get_field') ? get_field('header_appointment_cta_link', 'option') : '#book';
            if ( empty($nav_btn_text) ) $nav_btn_text = 'Book Appointment';
            if ( empty($nav_btn_link) ) $nav_btn_link = '#book';
            ?>
            <a href="<?php echo esc_url( $nav_btn_link ); ?>" class="btn-nav-appointment">
                <span class="btn-arrow-circle" aria-hidden="true"></span>
                <span><?php echo esc_html( $nav_btn_text ); ?></span>
            </a>

            <!-- Mobile Hamburger Toggle -->
            <button class="mobile-nav-toggle" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'dynamic-clinic' ); ?>" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </nav>
    </div>
</header>
