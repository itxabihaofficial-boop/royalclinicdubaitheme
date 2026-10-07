<?php
/**
 * Template Part: Bespoke Treatments Stacked Cards (Scroll Stack Animation)
 *
 * @package DynamicClinic
 */

$theme_uri = get_template_directory_uri();
$treatments = array(
    array(
        'title'    => 'Scalp Wash & Hydro-Therapy',
        'desc'     => 'Experience the ultimate hair-washing ritual, incorporating deep-cleansing scalp massage, specialized steam treatment, and customized conditioning.',
        'image'    => $theme_uri . '/assets/images/treatment-scalp.jpg',
        'link'     => '#book',
        'features' => array(
            array(
                'label' => 'Scalp condition assessment',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 4V2"/><path d="M15 16v-2"/><path d="M8 9h2"/><path d="M20 9h2"/><path d="M17.8 11.8L19 13"/><path d="M15 9h0"/><path d="M17.8 6.2L19 5"/><path d="M3 21l9-9"/></svg>',
            ),
            array(
                'label' => 'Steam activation & deep mask',
                'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/></svg>',
            ),
            array(
                'label' => 'Temperature-controlled hydro wash',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>',
            ),
            array(
                'label' => 'Pressure-point scalp massage',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/></svg>',
            ),
        ),
    ),
    array(
        'title'    => 'Luxury Nail Artistry',
        'desc'     => 'Indulge in a premium manicure session featuring organic scrubs, meticulous cuticle care, and non-toxic, long-lasting gel polishes.',
        'image'    => $theme_uri . '/assets/images/treatment-nails.jpg',
        'link'     => '#book',
        'features' => array(
            array(
                'label' => 'Organic herbal soak & scrub',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 4 13a7 7 0 0 1 7-7c4.5 0 9 2.5 9 14-4 0-7.5-1-9-0z"/><path d="M4 13a9.6 9.6 0 0 0 7 7"/></svg>',
            ),
            array(
                'label' => 'Precision cuticle refinement',
                'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/></svg>',
            ),
            array(
                'label' => 'Non-toxic restorative gel artistry',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3h6v3H9zM10 6v3h4V6M7 9h10l-1 12H8L7 9z"/></svg>',
            ),
            array(
                'label' => 'Pressure-point hand & arm massage',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/></svg>',
            ),
        ),
    ),
    array(
        'title'    => 'Hydra-Infusion Glow Therapy',
        'desc'     => 'Deep pore purification combined with pressurized hyaluronic acid infusion to dramatically enhance skin barrier elasticity and radiant plumpness.',
        'image'    => $theme_uri . '/assets/images/treatment-facial.jpg',
        'link'     => '#book',
        'features' => array(
            array(
                'label' => 'Vortex deep-pore purification',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2a10 10 0 1 0 10 10"/></svg>',
            ),
            array(
                'label' => 'Pressurized hyaluronic infusion',
                'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/></svg>',
            ),
            array(
                'label' => 'Cellular lipid barrier renewal',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
            ),
            array(
                'label' => 'Cryo-firming cold globe sculpting',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/></svg>',
            ),
        ),
    ),
    array(
        'title'    => 'Volcanic Stone Restorative Massage',
        'desc'     => 'Basalt heated stones combined with pure artisanal botanical balms to relieve deep structural tension and promote restorative circulation.',
        'image'    => $theme_uri . '/assets/images/card-massage.jpg',
        'link'     => '#book',
        'features' => array(
            array(
                'label' => 'Heated basalt volcanic stones',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="14" rx="8" ry="5"/><ellipse cx="12" cy="8" rx="5" ry="3"/></svg>',
            ),
            array(
                'label' => 'Artisanal botanical elixir oils',
                'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/></svg>',
            ),
            array(
                'label' => 'Deep neuromuscular release',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>',
            ),
            array(
                'label' => 'Pressure-point muscular alignment',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/></svg>',
            ),
        ),
    ),
);
?>

<section class="section-treatments-stack" id="services">
    <div class="container">

        <!-- Section Header -->
        <div class="treatments-header">
            <div class="treatments-badge-pill">
                <span class="pill-dot" aria-hidden="true"></span>
                <span><?php echo esc_html( get_field('services_badge_text') ?: 'SIGNATURE SERVICES' ); ?></span>
            </div>
            <div class="treatments-header-content">
                <h2 class="treatments-headline"><?php echo wp_kses_post( get_field('services_headline') ?: 'Bespoke Treatments<br>Crafted for Your Well-<br>being' ); ?></h2>
                <p class="treatments-lead"><?php echo esc_html( get_field('services_lead') ?: 'Immerse yourself in our premium collection of curated treatments designed to restore balance, harmony, and natural beauty.' ); ?></p>
            </div>
        </div>

        <!-- Scroll Stack Deck Container -->
        <div class="treatments-stack-container" id="treatments-stack">
            <?php foreach ( $treatments as $index => $item ) : ?>
                <article class="treatment-stack-card" style="--card-index: <?php echo esc_attr($index); ?>;">
                    <div class="treatment-card-grid">
                        <div class="treatment-media-wrap">
                            <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" loading="lazy">
                        </div>
                        <div class="treatment-content-wrap">
                            <h3 class="treatment-name"><?php echo esc_html($item['title']); ?></h3>
                            <p class="treatment-summary"><?php echo esc_html($item['desc']); ?></p>

                            <div class="treatment-features-section">
                                <span class="features-label">CORE FEATURES</span>
                                <div class="features-grid">
                                    <?php foreach ( $item['features'] as $feat ) : ?>
                                        <div class="feature-item">
                                            <span class="feature-icon-wrap" aria-hidden="true">
                                                <?php echo $feat['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                            </span>
                                            <span><?php echo esc_html($feat['label']); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="treatment-card-footer">
                                <div class="treatment-overview-meta">
                                    <img src="<?php echo esc_url($theme_uri . '/assets/images/avatar-therapist.jpg'); ?>" alt="Senior Aesthetician" class="overview-avatar" loading="lazy">
                                    <div class="overview-text">
                                        <span class="overview-title">Treatment Overview</span>
                                        <span class="overview-subtitle">Learn More About This Treatment</span>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url($item['link']); ?>" class="btn-view-service">
                                    <span>VIEW SERVICE</span>
                                    <span class="service-arrow-circle" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
