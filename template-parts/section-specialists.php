<?php
/**
 * Template Part: Clinical Specialists Directory
 *
 * @package DynamicClinic
 */

$theme_uri = get_template_directory_uri();
$specialists = array(
    array(
        'id'      => 'dermatology',
        'service' => 'Cosmetic Dermatology',
        'summary' => 'Refined skin, hair, and injectable care guided by an individual clinical assessment.',
        'name'    => 'Dr. Sannia Awais',
        'role'    => 'Cosmetic Dermatologist & Hair Specialist',
        'image'   => $theme_uri . '/assets/images/card-glow.jpg',
        'facts'   => array(
            'Specialty: Cosmetic dermatology and hair restoration',
            'Experience: 12+ years of clinical practice',
            'Languages: English, Urdu',
            'Registered with: DHA (Licence No. 81230795-001)',
        ),
    ),
    array(
        'id'      => 'plastic-surgery',
        'service' => 'Plastic & Reconstructive Surgery',
        'summary' => 'Thoughtful surgical planning that honours proportion, comfort, and natural-looking outcomes.',
        'name'    => 'Dr. Sirouse Ghouchkhani',
        'role'    => 'Lead Plastic & Reconstructive Surgeon',
        'image'   => $theme_uri . '/assets/images/treatment-plastic-surgery.jpg',
        'facts'   => array(
            'Specialty: Plastic and reconstructive surgery',
            'Experience: 20+ years of surgical practice',
            'Languages: Persian, English, Turkish, Azerbaijani',
            'Registered with: DHA (Licence No. 17891743-012)',
        ),
    ),
);

// Use the page's ACF repeater when it has content, while retaining the
// curated cards as a complete fallback for a new or partially configured page.
$acf_specialists = dynamic_clinic_field( 'specialists_items', array() );
if ( is_array( $acf_specialists ) && ! empty( $acf_specialists ) ) {
    $default_specialists = $specialists;
    $specialists = array();

    foreach ( $acf_specialists as $index => $item ) {
        $default = isset( $default_specialists[ $index ] ) ? $default_specialists[ $index ] : $default_specialists[0];
        $service = ! empty( $item['service'] ) ? $item['service'] : $default['service'];
        $facts = ! empty( $item['facts'] )
            ? preg_split( '/\r\n|\r|\n/', $item['facts'] )
            : $default['facts'];

        $specialists[] = array(
            'id'      => sanitize_title( $service ) . '-' . ( $index + 1 ),
            'service' => $service,
            'summary' => ! empty( $item['summary'] ) ? $item['summary'] : $default['summary'],
            'name'    => ! empty( $item['name'] ) ? $item['name'] : $default['name'],
            'role'    => ! empty( $item['role'] ) ? $item['role'] : $default['role'],
            'image'   => dynamic_clinic_image_url( isset( $item['image'] ) ? $item['image'] : '', $default['image'] ),
            'facts'   => array_values( array_filter( array_map( 'trim', $facts ) ) ),
        );
    }
}

$specialists_eyebrow = dynamic_clinic_field( 'specialists_eyebrow', 'Clinical expertise, considered personally' );
$specialists_title   = dynamic_clinic_field( 'specialists_title', 'Meet our <em>specialists.</em>' );
$specialists_lead    = dynamic_clinic_field( 'specialists_lead', 'Every consultation begins with listening. Explore the clinicians behind our most considered aesthetic and restorative care.' );
?>

<section class="section-specialists" id="specialists" aria-labelledby="specialists-title">
    <div class="container">
        <div class="specialists-intro">
            <div>
                <span class="specialists-eyebrow"><span aria-hidden="true"></span> <?php echo esc_html( $specialists_eyebrow ); ?></span>
                <h2 id="specialists-title"><?php echo wp_kses_post( $specialists_title ); ?></h2>
            </div>
            <p><?php echo esc_html( $specialists_lead ); ?></p>
        </div>

        <div class="specialists-directory" data-specialists-directory>
            <?php foreach ( $specialists as $index => $specialist ) : ?>
                <?php $is_open = 0 === $index; ?>
                <article class="specialist-card<?php echo $is_open ? ' is-open' : ''; ?>" data-specialist-card>
                    <div class="specialist-card-summary">
                        <span class="specialist-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="24" cy="16" r="7"></circle><path d="M12 39c1.8-8.2 7-12.3 12-12.3S34.2 30.8 36 39"></path><path d="M35.5 11.5 39 15l-3.5 3.5M12.5 11.5 9 15l3.5 3.5"></path>
                            </svg>
                        </span>
                        <h3><?php echo esc_html( $specialist['service'] ); ?></h3>
                    </div>

                    <div class="specialist-card-action">
                        <p><?php echo esc_html( $specialist['summary'] ); ?></p>
                        <button class="specialist-toggle" type="button" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="specialist-panel-<?php echo esc_attr( $specialist['id'] ); ?>">
                            <span class="specialist-toggle-label"><?php echo $is_open ? esc_html__( 'Close profile', 'dynamic-clinic' ) : esc_html__( 'Meet the specialist', 'dynamic-clinic' ); ?></span>
                            <span class="specialist-toggle-icon" aria-hidden="true"></span>
                        </button>
                    </div>

                    <div class="specialist-panel" id="specialist-panel-<?php echo esc_attr( $specialist['id'] ); ?>" aria-hidden="<?php echo $is_open ? 'false' : 'true'; ?>">
                        <div class="specialist-panel-inner">
                            <div class="specialist-profile-copy">
                                <span class="specialist-profile-overline">Dynamic Clinic</span>
                                <h4><?php echo esc_html( $specialist['name'] ); ?></h4>
                                <p class="specialist-profile-role"><?php echo esc_html( $specialist['role'] ); ?></p>
                                <ul class="specialist-facts">
                                    <?php foreach ( $specialist['facts'] as $fact ) : ?>
                                        <li><?php echo esc_html( $fact ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="#book" class="specialist-book-link">Book a consultation <span aria-hidden="true">&rarr;</span></a>
                            </div>
                            <div class="specialist-profile-visual">
                                <img src="<?php echo esc_url( $specialist['image'] ); ?>" alt="" loading="lazy">
                                <span>Private consultation</span>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>