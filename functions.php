<?php
/**
 * Dynamic Clinic Theme Functions and Definitions
 *
 * @package DynamicClinic
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define( 'DYNAMIC_CLINIC_VERSION', '1.0.2' );
define( 'DYNAMIC_CLINIC_DIR', get_template_directory() );
define( 'DYNAMIC_CLINIC_URI', get_template_directory_uri() );
/**
 * Keep field-group JSON with the theme so settings can be versioned and moved
 * with a theme import. Programmatic fields remain the fallback for all setups.
 */
function dynamic_clinic_acf_json_save_point( $path ) {
    return DYNAMIC_CLINIC_DIR . '/inc/acf-json';
}
add_filter( 'acf/settings/save_json', 'dynamic_clinic_acf_json_save_point' );

function dynamic_clinic_acf_json_load_point( $paths ) {
    $paths[] = DYNAMIC_CLINIC_DIR . '/inc/acf-json';
    return array_unique( $paths );
}
add_filter( 'acf/settings/load_json', 'dynamic_clinic_acf_json_load_point' );
/**
 * Read an ACF field with a safe fallback when ACF is inactive or the field is empty.
 */
function dynamic_clinic_field( $field_name, $fallback = '', $context = false ) {
    if ( ! function_exists( 'get_field' ) ) {
        return $fallback;
    }

    $value = false === $context ? get_field( $field_name ) : get_field( $field_name, $context );
    return ( null === $value || false === $value || '' === $value ) ? $fallback : $value;
}

/**
 * Resolve ACF image values returned as an attachment ID, array, or URL.
 */
function dynamic_clinic_image_url( $image, $fallback = '' ) {
    if ( is_array( $image ) && ! empty( $image['url'] ) ) {
        return $image['url'];
    }
    if ( is_numeric( $image ) ) {
        $url = wp_get_attachment_image_url( (int) $image, 'full' );
        return $url ? $url : $fallback;
    }
    return is_string( $image ) && '' !== $image ? $image : $fallback;
}

/**
 * Resolve ACF link values returned as a Link field array or URL string.
 */
function dynamic_clinic_link_url( $link, $fallback = '#' ) {
    if ( is_array( $link ) && ! empty( $link['url'] ) ) {
        return $link['url'];
    }
    return is_string( $link ) && '' !== $link ? $link : $fallback;
}

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
        $custom_page_bg = get_field( 'brand_page_background_color', 'option' );
        $custom_sand    = get_field( 'brand_light_sand_color', 'option' );
        $custom_text    = get_field( 'brand_text_color', 'option' );

        $custom_primary = sanitize_hex_color( $custom_primary );
        $custom_accent  = sanitize_hex_color( $custom_accent );
        $custom_bg      = sanitize_hex_color( $custom_bg );
        $custom_page_bg = sanitize_hex_color( $custom_page_bg );
        $custom_sand    = sanitize_hex_color( $custom_sand );
        $custom_text    = sanitize_hex_color( $custom_text );

        // The styles use both palette tokens and semantic aliases, so update both layers.
        $inline_css = ':root {';
        if ( $custom_primary ) {
            $inline_css .= '--color-bronze: ' . $custom_primary . ';';
            $inline_css .= '--color-primary: ' . $custom_primary . ';';
            $inline_css .= '--color-accent-gold: ' . $custom_primary . ';';
            $inline_css .= '--e-global-color-75f: ' . $custom_primary . ';';
            $inline_css .= '--global-color-75f: ' . $custom_primary . ';';
        }
        if ( $custom_accent ) {
            $inline_css .= '--color-copper: ' . $custom_accent . ';';
            $inline_css .= '--color-primary-dark: ' . $custom_accent . ';';
            $inline_css .= '--color-accent-amber: ' . $custom_accent . ';';
            $inline_css .= '--color-accent-gold: ' . $custom_accent . ';';
            $inline_css .= '--e-global-color-a56: ' . $custom_accent . ';';
            $inline_css .= '--global-color-a56: ' . $custom_accent . ';';
        }
        if ( $custom_bg ) {
            $inline_css .= '--color-obsidian: ' . $custom_bg . ';';
            $inline_css .= '--color-espresso-dark: ' . $custom_bg . ';';
            $inline_css .= '--color-dark-surface: ' . $custom_bg . ';';
            $inline_css .= '--e-global-color-a02: ' . $custom_bg . ';';
            $inline_css .= '--global-color-a02: ' . $custom_bg . ';';
        }
        if ( $custom_page_bg ) { $inline_css .= '--color-page-bg: ' . $custom_page_bg . ';'; }
        if ( $custom_sand ) { $inline_css .= '--color-light-sand: ' . $custom_sand . ';'; }
        if ( $custom_text ) {
            $inline_css .= '--color-espresso: ' . $custom_text . ';';
            $inline_css .= '--color-secondary: ' . $custom_text . ';';
            $inline_css .= '--e-global-color-2de: ' . $custom_text . ';';
            $inline_css .= '--global-color-2de: ' . $custom_text . ';';
        }
        // Override dependent tokens as well, so every selected setting is visible
        // across sections that use derived shades, navigation, and body surfaces.
        if ( $custom_primary ) {
            $inline_css .= '--color-bronze-80: color-mix(in srgb, ' . $custom_primary . ' 80%, transparent);';
            $inline_css .= '--color-bronze-60: color-mix(in srgb, ' . $custom_primary . ' 60%, transparent);';
            $inline_css .= '--color-bronze-50: color-mix(in srgb, ' . $custom_primary . ' 50%, transparent);';
            $inline_css .= '--color-bronze-10: color-mix(in srgb, ' . $custom_primary . ' 10%, transparent);';
            $inline_css .= '--color-bronze-06: color-mix(in srgb, ' . $custom_primary . ' 6%, transparent);';
            $inline_css .= '--color-primary-light: color-mix(in srgb, ' . $custom_primary . ' 78%, white);';
            $inline_css .= '--color-primary-alpha: color-mix(in srgb, ' . $custom_primary . ' 10%, transparent);';
            $inline_css .= '--color-primary-alpha-50: color-mix(in srgb, ' . $custom_primary . ' 50%, transparent);';
            $inline_css .= '--color-primary-alpha-80: color-mix(in srgb, ' . $custom_primary . ' 80%, transparent);';
            $inline_css .= '--color-accent-gold: ' . $custom_primary . ';';
            $inline_css .= '--color-accent-glow: color-mix(in srgb, ' . $custom_primary . ' 35%, transparent);';
            $inline_css .= '--color-accent-glow-strong: color-mix(in srgb, ' . $custom_primary . ' 55%, transparent);';
            $inline_css .= '--border-primary: color-mix(in srgb, ' . $custom_primary . ' 50%, transparent);';
        }
        if ( $custom_accent ) {
            $inline_css .= '--color-copper: ' . $custom_accent . ';';
            $inline_css .= '--color-primary-dark: ' . $custom_accent . ';';
            $inline_css .= '--color-accent-amber: ' . $custom_accent . ';';
        }
        if ( $custom_bg ) {
            $inline_css .= '--color-obsidian: ' . $custom_bg . ';';
            $inline_css .= '--color-dark-surface: ' . $custom_bg . ';';
            $inline_css .= '--color-dark: ' . $custom_bg . ';';
            $inline_css .= '--color-dark-espresso: ' . $custom_bg . ';';
            $inline_css .= '--color-dark-transparent: color-mix(in srgb, ' . $custom_bg . ' 0%, transparent);';
            $inline_css .= '--color-footer-bg: color-mix(in srgb, ' . $custom_bg . ' 88%, black);';
        }
        if ( $custom_page_bg ) {
            $inline_css .= '--color-page-bg: ' . $custom_page_bg . ';';
            $inline_css .= '--color-page-bg-alt: color-mix(in srgb, ' . $custom_page_bg . ' 92%, black);';
            $inline_css .= '--color-page-section: color-mix(in srgb, ' . $custom_page_bg . ' 92%, white);';
            $inline_css .= '--color-cream: ' . $custom_page_bg . ';';
            $inline_css .= '--bg-body: ' . $custom_page_bg . ';';
            $inline_css .= '--nav-bg: ' . $custom_page_bg . ';';
            $inline_css .= '--nav-bg-scrolled: color-mix(in srgb, ' . $custom_page_bg . ' 96%, transparent);';
            $inline_css .= '--e-global-color-c9a: ' . $custom_page_bg . ';';
            $inline_css .= '--global-color-c9a: ' . $custom_page_bg . ';';
        }
        if ( $custom_sand ) {
            $inline_css .= '--color-sand: ' . $custom_sand . ';';
            $inline_css .= '--color-light-sand: ' . $custom_sand . ';';
            $inline_css .= '--e-global-color-3ee: ' . $custom_sand . ';';
            $inline_css .= '--global-color-3ee: ' . $custom_sand . ';';
        }
        if ( $custom_text ) {
            $inline_css .= '--color-espresso: ' . $custom_text . ';';
            $inline_css .= '--color-espresso-80: color-mix(in srgb, ' . $custom_text . ' 80%, transparent);';
            $inline_css .= '--color-espresso-10: color-mix(in srgb, ' . $custom_text . ' 10%, transparent);';
            $inline_css .= '--color-secondary: ' . $custom_text . ';';
            $inline_css .= '--color-secondary-alpha: color-mix(in srgb, ' . $custom_text . ' 10%, transparent);';
            $inline_css .= '--color-secondary-alpha-50: color-mix(in srgb, ' . $custom_text . ' 80%, transparent);';
            $inline_css .= '--text-main: ' . $custom_text . ';';
            $inline_css .= '--text-dim: color-mix(in srgb, ' . $custom_text . ' 35%, transparent);';
            $inline_css .= '--e-global-color-2de: ' . $custom_text . ';';
            $inline_css .= '--global-color-2de: ' . $custom_text . ';';
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
 * Return the default values used by the Clinic Settings options page.
 */
function dynamic_clinic_settings_defaults() {
    return array(
        'field_opt_primary_color'          => '#986a3e',
        'field_opt_accent_color'           => '#70441b',
        'field_opt_dark_color'             => '#101011',
        'field_opt_page_background_color'  => '#fdf7ef',
        'field_opt_light_sand_color'       => '#f7ecdf',
        'field_opt_text_color'             => '#633b2c',
        'field_opt_clinic_name'            => 'DYNAMIC CLINIC',
        'field_opt_clinic_phone'           => '+1 (800) 456-7890',
        'field_opt_clinic_email'           => 'concierge@dynamicclinic.com',
        'field_opt_clinic_address'         => '450 Luxury Boulevard, Suite 800, Beverly Hills, CA',
        'field_opt_nav_cta_text'           => 'BOOK APPOINTMENT',
        'field_opt_nav_cta_link'           => '#book',
        'field_opt_social_instagram'       => '',
        'field_opt_social_facebook'        => '',
        'field_opt_social_tiktok'          => '',
    );
}

/**
 * Restore every Clinic Settings field after ACF handles the submitted form.
 */
function dynamic_clinic_reset_settings_to_defaults( $post_id ) {
    if ( 'options' !== $post_id || empty( $_POST['dynamic_clinic_reset_defaults'] ) || ! current_user_can( 'edit_posts' ) ) {
        return;
    }

    foreach ( dynamic_clinic_settings_defaults() as $field_key => $default_value ) {
        update_field( $field_key, $default_value, 'option' );
    }

    set_transient( 'dynamic_clinic_settings_reset_' . get_current_user_id(), true, MINUTE_IN_SECONDS );
}
add_action( 'acf/save_post', 'dynamic_clinic_reset_settings_to_defaults', 20 );

/**
 * Add a reset action alongside ACF's settings save button.
 */
function dynamic_clinic_settings_reset_button() {
    $screen = get_current_screen();

    if ( ! $screen || false === strpos( $screen->id, 'clinic-theme-settings' ) ) {
        return;
    }
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var submitArea = document.querySelector('.acf-form-submit');

        if (!submitArea) {
            return;
        }

        var resetButton = document.createElement('button');
        resetButton.type = 'submit';
        resetButton.name = 'dynamic_clinic_reset_defaults';
        resetButton.value = '1';
        resetButton.className = 'button button-secondary';
        resetButton.textContent = 'Reset All Settings';
        resetButton.addEventListener('click', function (event) {
            if (!window.confirm('Reset all Clinic Settings, including colours and contact details, to their defaults?')) {
                event.preventDefault();
            }
        });
        submitArea.appendChild(resetButton);
    });
    </script>
    <?php
}
add_action( 'admin_footer', 'dynamic_clinic_settings_reset_button' );

/**
 * Confirm a completed reset on the Clinic Settings screen.
 */
function dynamic_clinic_settings_reset_notice() {
    if ( empty( $_GET['page'] ) || 'clinic-theme-settings' !== $_GET['page'] ) {
        return;
    }

    $transient_key = 'dynamic_clinic_settings_reset_' . get_current_user_id();
    if ( ! get_transient( $transient_key ) ) {
        return;
    }

    delete_transient( $transient_key );
    echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Clinic Settings have been restored to their defaults.', 'dynamic-clinic' ) . '</p></div>';
}
add_action( 'admin_notices', 'dynamic_clinic_settings_reset_notice' );
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
