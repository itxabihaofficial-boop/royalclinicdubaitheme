<?php
/**
 * Template Part: Before & After Results Gallery
 *
 * Replace the demo image paths below with consented patient photography before publishing.
 *
 * @package DynamicClinic
 */

$theme_uri = get_template_directory_uri();
$results = array(
    array( 'image' => $theme_uri . '/assets/images/card-facial.jpg',    'alt' => 'Facial treatment result' ),
    array( 'image' => $theme_uri . '/assets/images/card-skincare.jpg', 'alt' => 'Skincare treatment result' ),
    array( 'image' => $theme_uri . '/assets/images/card-glow.jpg',     'alt' => 'Radiance treatment result' ),
    array( 'image' => $theme_uri . '/assets/images/card-hair.jpg',     'alt' => 'Hair treatment result' ),
    array( 'image' => $theme_uri . '/assets/images/card-massage.jpg',  'alt' => 'Wellness treatment result' ),
);

$acf_results = dynamic_clinic_field( 'results_gallery', array() );
if ( is_array( $acf_results ) && ! empty( $acf_results ) ) {
    $results = array();
    foreach ( $acf_results as $image ) {
        $results[] = array(
            'image' => dynamic_clinic_image_url( $image ),
            'alt'   => is_array( $image ) && ! empty( $image['alt'] ) ? $image['alt'] : 'Treatment result',
        );
    }
}
?>

<section class="section-results" id="results" aria-labelledby="results-title">
    <div class="container">
        <div class="results-proof">
            <div class="results-heading">
                <div>
                    <span class="section-tag section-tag--light"><?php echo esc_html( dynamic_clinic_field( 'results_badge', 'Visual Proof' ) ); ?></span>
                    <h2 class="results-title" id="results-title"><?php echo wp_kses_post( str_replace( '&', '<em>&amp;</em>', dynamic_clinic_field( 'results_title', 'Before & After' ) ) ); ?></h2>
                </div>

                <div class="results-tags" aria-label="Treatment result categories">
                    <span>[ Brightening &amp; Glow ]</span>
                    <span>[ Texture Refinement ]</span>
                    <span>[ Hair Restoration ]</span>
                    <span>[ Hydration &amp; Plumpness ]</span>
                </div>
            </div>

            <div class="results-media" aria-label="Treatment results image gallery">
                <?php foreach ( $results as $index => $result ) : ?>
                    <figure class="results-card results-card--<?php echo esc_attr( $index + 1 ); ?><?php echo 0 === $index ? ' results-card--focus' : ''; ?>">
                        <?php if ( 0 === $index ) : ?>
                            <div class="results-flip-card">
                                <div class="results-flip-face results-flip-face--front">
                                    <img src="<?php echo esc_url( $result['image'] ); ?>" alt="<?php echo esc_attr( $result['alt'] ); ?>" class="results-focus-front">
                                </div>
                                <div class="results-flip-face results-flip-face--back">
                                    <img src="<?php echo esc_url( ( isset( $results[1] ) ? $results[1]['image'] : $results[0]['image'] ) ); ?>" alt="" class="results-focus-back">
                                </div>
                            </div>
                        <?php else : ?>
                            <img src="<?php echo esc_url( $result['image'] ); ?>" alt="<?php echo esc_attr( $result['alt'] ); ?>" loading="lazy">
                        <?php endif; ?>
                    </figure>
                <?php endforeach; ?>
            </div>

            <div class="results-action">
                <a href="#book" class="results-link">
                    <span><?php echo esc_html( dynamic_clinic_field( 'results_cta_text', 'Begin Your Transformation' ) ); ?></span>
                    <span aria-hidden="true">&#8594;</span>
                </a>
            </div>
        </div>
    </div>
</section>
