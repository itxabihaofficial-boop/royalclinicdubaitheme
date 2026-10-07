<?php
/**
 * Template Part: Why Patients Choose Us
 *
 * @package DynamicClinic
 */

$theme_uri = get_template_directory_uri();
$care_points = array(
    array( 'title' => 'Personalised treatment plans', 'text' => 'Individualised care and treatment planning based on your goals, concerns, and clinical assessment.' ),
    array( 'title' => 'Patient-centred care', 'text' => 'Clear consultations, honest recommendations, and considered support at every step.' ),
    array( 'title' => 'DHA-registered doctors', 'text' => 'A multidisciplinary team of healthcare professionals registered with the Dubai Health Authority.' ),
    array( 'title' => 'Advanced technology', 'text' => 'Technology-supported treatments across aesthetic medicine, laser dermatology, and hair restoration.' ),
);
?>

<section class="section-why-clinic" id="why-choose-us" aria-labelledby="why-clinic-title" data-why-clinic>
    <div class="container">
        <header class="why-clinic-header" data-why-reveal>
            <span class="why-clinic-eyebrow"><span aria-hidden="true"></span> Why patients choose us</span>
            <h2 id="why-clinic-title">Care that puts <em>you</em> first.</h2>
            <p>Expert-led aesthetic care, shaped around your goals and delivered with clinical rigour from consultation through aftercare.</p>
        </header>

        <div class="why-clinic-grid">
            <article class="why-card why-card--journey why-card--comparison" data-why-card data-comparison style="--comparison-position: 50%;">
                <img class="comparison-image" src="<?php echo esc_url( $theme_uri . '/assets/images/card-facial.jpg' ); ?>" alt="Before aesthetic treatment" loading="lazy">
                <div class="comparison-after" aria-hidden="true"><img class="comparison-image" src="<?php echo esc_url( $theme_uri . '/assets/images/card-skincare.jpg' ); ?>" alt="" loading="lazy"></div>
                <span class="comparison-label comparison-label--before">Before</span>
                <span class="comparison-label comparison-label--after">After</span>
                <span class="comparison-divider" aria-hidden="true"><span class="comparison-handle">&#8249; &#8250;</span></span>
                <input class="comparison-range" type="range" min="0" max="100" value="50" aria-label="Reveal before and after treatment result">
            </article>

            <article class="why-card why-card--experience" data-why-card>
                <div class="why-card-content">
                    <span class="why-card-kicker">A seamless experience</span>
                    <h3>Thoughtful details at every touchpoint.</h3>
                    <p>Private consultations, transparent guidance, and a calm, considered environment designed around you.</p>
                </div>
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/treatment-plastic-surgery.jpg' ); ?>" alt="Aesthetic treatment detail" loading="lazy">
            </article>

            <article class="why-card why-card--credentials" data-why-card>
                <span class="why-card-kicker">Clinical confidence</span>
                <div class="why-stat-main"><span data-count="2007" data-suffix="">2007</span></div>
                <p>Trusted expertise since</p>
                <div class="why-stat-pills"><span>Licensed facility</span><span>Dubai-based care</span></div>
                <span class="why-stat-watermark">Since 2007</span>
            </article>

            <article class="why-card why-card--plan" data-why-card>
                <div class="why-avatar-row" aria-hidden="true">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/card-glow.jpg' ); ?>" alt="">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/card-skincare.jpg' ); ?>" alt="">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/treatment-facial.jpg' ); ?>" alt="">
                </div>
                <h3>Tailored to your vision.</h3>
                <p>Customised treatment plans for every skin type, concern, and stage of your journey.</p>
            </article>

            <article class="why-card why-card--trust" data-why-card>
                <div class="why-trust-score"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span><strong>99<span>%</span></strong><p>Trusted patient experience</p></div>
                <div class="why-testimonial-viewport" aria-label="Patient testimonials">
                    <div class="why-testimonial-track">
                        <article class="why-review-quote"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span><p>Clear, professional, and reassuring from the first consultation.</p><strong>Olivia Chen</strong><small>Creative Director</small></article>
                        <article class="why-review-quote"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span><p>The doctors listened carefully and explained every step with real honesty.</p><strong>Priya Mehta</strong><small>Product Manager</small></article>
                        <article class="why-review-quote"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span><p>The whole experience felt calm, considered, and completely personal.</p><strong>Sofia Hale</strong><small>Clinic patient</small></article>
                        <article class="why-review-quote" aria-hidden="true"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span><p>Clear, professional, and reassuring from the first consultation.</p><strong>Olivia Chen</strong><small>Creative Director</small></article>
                        <article class="why-review-quote" aria-hidden="true"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span><p>The doctors listened carefully and explained every step with real honesty.</p><strong>Priya Mehta</strong><small>Product Manager</small></article>
                        <article class="why-review-quote" aria-hidden="true"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span><p>The whole experience felt calm, considered, and completely personal.</p><strong>Sofia Hale</strong><small>Clinic patient</small></article>
                    </div>
                </div>
            </article>

            <article class="why-card why-card--consult" data-why-card>
                <span class="why-consult-badge">Private</span>
                <h3>Begin with a skin analysis.</h3>
                <p>Take the first step with an expert consultation and a plan made for you.</p>
                <a href="#book" class="why-consult-link">Book a consultation <span aria-hidden="true">&rarr;</span></a>
            </article>

            <article class="why-card why-card--care-points" data-why-card>
                <span class="why-card-kicker">What guides our care</span>
                <div class="why-care-list">
                    <?php foreach ( $care_points as $point ) : ?>
                        <div class="why-care-item">
                            <span aria-hidden="true"></span>
                            <div><h3><?php echo esc_html( $point['title'] ); ?></h3><p><?php echo esc_html( $point['text'] ); ?></p></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </article>

            <article class="why-card why-card--stats" data-why-card>
                <div class="why-stats-grid">
                    <div><strong data-count="250" data-suffix="K+">250K+</strong><span>Satisfied clients globally</span></div>
                    <div><strong data-count="3.5" data-decimals="1" data-suffix="K+">3.5K+</strong><span>Surgeries performed</span></div>
                    <div><strong data-count="20" data-suffix="K+">20K+</strong><span>Aesthetic treatments annually</span></div>
                </div>
                <p>Experience built through care that is personal, precise, and transparently delivered.</p>
            </article>
        </div>
    </div>
</section>