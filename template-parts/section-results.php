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
?>

<section class="section-results" id="results" aria-labelledby="results-title">
    <div class="container">
        <div class="results-proof">
            <div class="results-heading">
                <div>
                    <span class="section-tag section-tag--light">Visual Proof</span>
                    <h2 class="results-title" id="results-title">Before <em>&amp;</em> After</h2>
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
                                    <img src="<?php echo esc_url( $results[1]['image'] ); ?>" alt="" class="results-focus-back">
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
                    <span>Begin Your Transformation</span>
                    <span aria-hidden="true">&#8594;</span>
                </a>
            </div>
        </div>
    </div>
</section>
