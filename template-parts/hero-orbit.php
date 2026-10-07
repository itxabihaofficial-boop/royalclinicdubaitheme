<?php
/**
 * Template Part: Hero Section with Infinite Curved Arc Cards Carousel
 *
 * The hero is wrapped in .hero-wrapper for the Dermato-style inset card border effect.
 * All fields are wired to ACF with luxury defaults.
 *
 * @package DynamicClinic
 */

$theme_uri = get_template_directory_uri();

// Retrieve ACF fields with fallbacks
$hero_badge    = function_exists('get_field') ? get_field('hero_badge_text') : '';
$hero_title    = function_exists('get_field') ? get_field('hero_title') : '';
$hero_subtitle = function_exists('get_field') ? get_field('hero_subtitle') : '';
$hero_cta_text = function_exists('get_field') ? get_field('hero_cta_text') : '';
$hero_cta_link = function_exists('get_field') ? get_field('hero_cta_link') : '';
$hero_bg       = function_exists('get_field') ? get_field('hero_backdrop_image') : '';

if ( empty($hero_badge) )    $hero_badge    = 'Leading Aesthetic & Plastic Surgery Clinic in Dubai';
if ( empty($hero_title) )    $hero_title    = 'Welcome to Dynamic Life Clinics';
if ( empty($hero_subtitle) ) $hero_subtitle = 'Previously Named As Dynamic Aesthetic Clinic.';
if ( empty($hero_cta_text) ) $hero_cta_text = 'BOOK APPOINTMENT';
if ( empty($hero_cta_link) ) $hero_cta_link = '#book';
if ( empty($hero_bg) )       $hero_bg       = $theme_uri . '/assets/images/hero-bg.jpg';

// Orbit Cards: ACF Repeater or Curated Luxury Default Cards
$orbit_cards = array();
if ( function_exists('have_rows') && have_rows('hero_orbit_cards') ) {
    while ( have_rows('hero_orbit_cards') ) {
        the_row();
        $orbit_cards[] = array(
            'title' => get_sub_field('title'),
            'image' => get_sub_field('image'),
            'link'  => get_sub_field('link') ?: '#services',
        );
    }
}

// Fallback high-res treatment cards array (matches screenshot arc of 10 floating cards)
if ( empty($orbit_cards) ) {
    $orbit_cards = array(
        array( 'title' => 'Hydra-Facial Glow',     'image' => $theme_uri . '/assets/images/card-facial.jpg',   'link' => '#services' ),
        array( 'title' => 'Herbal Hair Elixir',     'image' => $theme_uri . '/assets/images/card-hair.jpg',     'link' => '#services' ),
        array( 'title' => 'Hot Stone Therapy',      'image' => $theme_uri . '/assets/images/card-massage.jpg',  'link' => '#services' ),
        array( 'title' => 'Botanical Alchemy',      'image' => $theme_uri . '/assets/images/card-skincare.jpg', 'link' => '#services' ),
        array( 'title' => 'Radiance Rejuvenation',  'image' => $theme_uri . '/assets/images/card-glow.jpg',     'link' => '#services' ),
        array( 'title' => 'Aesthetic Dermal Peel',  'image' => $theme_uri . '/assets/images/card-facial.jpg',   'link' => '#services' ),
        array( 'title' => 'Deep Tissue Ritual',     'image' => $theme_uri . '/assets/images/card-massage.jpg',  'link' => '#services' ),
        array( 'title' => 'Scalp Micro-Nourish',    'image' => $theme_uri . '/assets/images/card-hair.jpg',     'link' => '#services' ),
        array( 'title' => 'Cellular Youth Serum',   'image' => $theme_uri . '/assets/images/card-skincare.jpg', 'link' => '#services' ),
        array( 'title' => 'Dewy Luminescence',      'image' => $theme_uri . '/assets/images/card-glow.jpg',     'link' => '#services' ),
    );
}
?>

<!-- Hero Inset Card Wrapper (Dermato Style — cream background peeks around edges) -->
<div class="hero-wrapper" id="hero">
<section class="hero-section">
    <!-- Ambient Background Backdrop -->
    <div class="hero-backdrop" style="background-image: url('<?php echo esc_url($hero_bg); ?>');"></div>
    <div class="hero-overlay"></div>

    <!-- The Infinite Curved Arc Orbit Cards Stage -->
    <div class="hero-orbit-stage" aria-label="<?php esc_attr_e( 'Interactive Treatment Showcase Carousel', 'dynamic-clinic' ); ?>">
        <div class="orbit-cards-track">
            <?php foreach ( $orbit_cards as $index => $card ) : ?>
                <div class="orbit-card" data-index="<?php echo esc_attr($index); ?>">
                    <img src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?>" loading="eager">
                    <span class="orbit-card-tag"><?php echo esc_html($card['title']); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Center Hero Editorial Content -->
    <div class="hero-center-content">
        <!-- Eyebrow Pill Badge -->
        <?php if ( ! empty( trim($hero_badge) ) ) : ?>
        <div class="hero-badge-pill">
            <span class="pill-dot" aria-hidden="true"></span>
            <span><?php echo esc_html($hero_badge); ?></span>
        </div>
        <?php endif; ?>

        <!-- Hero Headline -->
        <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>

        <!-- Subtitle -->
        <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>

        <!-- CTA Pill Button -->
        <a href="<?php echo esc_url($hero_cta_link); ?>" class="btn-hero-primary">
            <span class="btn-arrow-circle" aria-hidden="true">➔</span>
            <span><?php echo esc_html($hero_cta_text); ?></span>
        </a>
    </div>
</section>
</div><!-- /.hero-wrapper -->
