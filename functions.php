<?php
/**
 * Dynamic Clinic Theme Functions and Definitions
 *
 * @package DynamicClinic
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define( 'DYNAMIC_CLINIC_VERSION', '1.0.0' );
define( 'DYNAMIC_CLINIC_DIR', get_template_directory() );
define( 'DYNAMIC_CLINIC_URI', get_template_directory_uri() );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function dynamic_clinic_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'dynamic-clinic', DYNAMIC_CLINIC_DIR . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support( 'post-thumbnails' );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Custom logo support
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Register primary navigation menu
    register_nav_menus( array(
        'primary-menu' => esc_html__( 'Primary Floating Menu', 'dynamic-clinic' ),
        'footer-menu'  => esc_html__( 'Footer Menu', 'dynamic-clinic' ),
    ) );
}
add_action( 'after_setup_theme', 'dynamic_clinic_setup' );

/**
 * Enqueue scripts and styles.
 */
function dynamic_clinic_scripts() {
    // Google Fonts (Cormorant Garamond & Plus Jakarta Sans)
    wp_enqueue_style(
        'dynamic-clinic-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Global Design Tokens
    wp_enqueue_style(
        'dynamic-clinic-tokens',
        DYNAMIC_CLINIC_URI . '/assets/css/tokens.css',
        array(),
        DYNAMIC_CLINIC_VERSION
    );

    // Master Theme Stylesheet
    wp_enqueue_style(
        'dynamic-clinic-theme',
        DYNAMIC_CLINIC_URI . '/assets/css/theme.css',
        array( 'dynamic-clinic-tokens' ),
        DYNAMIC_CLINIC_VERSION
    );

    // Root WordPress stylesheet
    wp_enqueue_style(
        'dynamic-clinic-style',
        get_stylesheet_uri(),
        array( 'dynamic-clinic-theme' ),
        DYNAMIC_CLINIC_VERSION
    );

    // Dynamic CSS Injection from ACF Options Page (Global Colors & Tokens)
    if ( function_exists( 'get_field' ) ) {
        $custom_primary = get_field( 'brand_primary_color', 'option' );
        $custom_accent  = get_field( 'brand_accent_color', 'option' );
        $custom_bg      = get_field( 'brand_dark_color', 'option' );

        $inline_css = ':root {';
        if ( ! empty( $custom_primary ) ) {
            $inline_css .= '--color-primary: ' . esc_attr( $custom_primary ) . ';';
        }
        if ( ! empty( $custom_accent ) ) {
            $inline_css .= '--color-accent-amber: ' . esc_attr( $custom_accent ) . ';';
            $inline_css .= '--color-accent-gold: ' . esc_attr( $custom_accent ) . ';';
        }
        if ( ! empty( $custom_bg ) ) {
            $inline_css .= '--bg-body: ' . esc_attr( $custom_bg ) . ';';
        }
        $inline_css .= '}';

        wp_add_inline_style( 'dynamic-clinic-tokens', $inline_css );
    }

    // GSAP and ScrollTrigger Animation Engine
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        array(),
        '3.12.5',
        true
    );

    wp_enqueue_script(
        'gsap-scroll-trigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        array( 'gsap' ),
        '3.12.5',
        true
    );

    // Theme JS Modules
    wp_enqueue_script(
        'dynamic-clinic-orbit',
        DYNAMIC_CLINIC_URI . '/assets/js/orbit-carousel.js',
        array(),
        DYNAMIC_CLINIC_VERSION,
        true
    );

    wp_enqueue_script(
        'dynamic-clinic-scroll-anim',
        DYNAMIC_CLINIC_URI . '/assets/js/scroll-animations.js',
        array( 'gsap', 'gsap-scroll-trigger' ),
        DYNAMIC_CLINIC_VERSION,
        true
    );

    wp_enqueue_script(
        'dynamic-clinic-results-gallery',
        DYNAMIC_CLINIC_URI . '/assets/js/before-after-gallery.js',
        array( 'gsap', 'gsap-scroll-trigger' ),
        DYNAMIC_CLINIC_VERSION,
        true
    );

    wp_enqueue_script(
        'dynamic-clinic-specialists',
        DYNAMIC_CLINIC_URI . '/assets/js/specialists-accordion.js',
        array( 'gsap', 'gsap-scroll-trigger' ),
        DYNAMIC_CLINIC_VERSION,
        true
    );
    wp_enqueue_script(
        'dynamic-clinic-why-clinic',
        DYNAMIC_CLINIC_URI . '/assets/js/why-clinic.js',
        array( 'gsap', 'gsap-scroll-trigger' ),
        DYNAMIC_CLINIC_VERSION,
        true
    );
    wp_enqueue_script(
        'dynamic-clinic-testimonials',
        DYNAMIC_CLINIC_URI . '/assets/js/testimonials.js',
        array(),
        DYNAMIC_CLINIC_VERSION,
        true
    );
    wp_enqueue_script(
        'dynamic-clinic-main',
        DYNAMIC_CLINIC_URI . '/assets/js/main.js',
        array( 'dynamic-clinic-orbit', 'dynamic-clinic-scroll-anim', 'dynamic-clinic-results-gallery', 'dynamic-clinic-specialists', 'dynamic-clinic-why-clinic' ),
        DYNAMIC_CLINIC_VERSION,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'dynamic_clinic_scripts' );

/**
 * Register ACF Options Page for Global Theme Settings
 */
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( array(
        'page_title'    => esc_html__( 'Clinic Theme Settings', 'dynamic-clinic' ),
        'menu_title'    => esc_html__( 'Clinic Settings', 'dynamic-clinic' ),
        'menu_slug'     => 'clinic-theme-settings',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-heart',
        'redirect'      => false,
        'update_button' => esc_html__( 'Save Clinic Settings', 'dynamic-clinic' ),
    ) );
}

/**
 * Load ACF Programmatic Fields definition
 */
if ( file_exists( DYNAMIC_CLINIC_DIR . '/inc/acf-fields.php' ) ) {
    require_once DYNAMIC_CLINIC_DIR . '/inc/acf-fields.php';
}

/**
 * Enable SVG Uploads for clinic branding
 */
function dynamic_clinic_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'dynamic_clinic_mime_types' );
