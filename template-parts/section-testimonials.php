<?php
/**
 * Template Part: Patient Testimonials
 *
 * @package DynamicClinic
 */

$theme_uri = get_template_directory_uri();
$testimonials = array(
    array( 'quote' => 'My skin finally felt understood. Every step was explained with care, and the results are natural, calm, and exactly what I hoped for.', 'name' => 'Sofia Hale', 'role' => 'Clinic patient', 'image' => 'avatar-therapist.jpg' ),
    array( 'quote' => 'From consultation to follow-up, the whole experience felt exceptionally personal. My treatment plan was clear and considered.', 'name' => 'Daniel Brooks', 'role' => 'Entrepreneur', 'image' => 'card-facial.jpg' ),
    array( 'quote' => 'The doctors listened closely and never rushed me. I left feeling confident in the plan and genuinely cared for.', 'name' => 'Olivia Chen', 'role' => 'Creative director', 'image' => 'card-skincare.jpg' ),
    array( 'quote' => 'A quietly luxurious experience with real clinical expertise behind it. The difference in my skin has been remarkable.', 'name' => 'Priya Mehta', 'role' => 'Product manager', 'image' => 'card-glow.jpg' ),
);
?>
<section class="section-testimonials" id="testimonials" aria-labelledby="testimonials-title" data-testimonials>
    <div class="container">
        <div class="testimonials-layout">
            <header class="testimonials-intro">
                <span class="testimonials-eyebrow">Patient stories</span>
                <h2 id="testimonials-title">What our<br><em>patients say.</em></h2>
                <div class="testimonials-controls" aria-label="Testimonial controls">
                    <button type="button" class="testimonials-control" data-testimonial-prev aria-label="Show previous testimonials">&larr;</button>
                    <button type="button" class="testimonials-control" data-testimonial-next aria-label="Show next testimonials">&rarr;</button>
                </div>
                <p class="testimonials-count" aria-live="polite"><span data-testimonial-current>01</span> / <?php echo esc_html( str_pad( (string) count( $testimonials ), 2, '0', STR_PAD_LEFT ) ); ?> patient stories</p>
            </header>

            <div class="testimonials-stage" data-testimonial-stage>
                <?php foreach ( $testimonials as $index => $testimonial ) : ?>
                    <article class="testimonial-card<?php echo $index < 2 ? ' is-active' : ''; ?>"<?php echo $index > 1 ? ' hidden' : ''; ?> data-testimonial-card>
                        <span class="testimonial-stars" aria-label="5 out of 5 stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                        <p>&ldquo;<?php echo esc_html( $testimonial['quote'] ); ?>&rdquo;</p>
                        <footer>
                            <img src="<?php echo esc_url( $theme_uri . '/assets/images/' . $testimonial['image'] ); ?>" alt="" loading="lazy">
                            <span><strong><?php echo esc_html( $testimonial['name'] ); ?></strong><small><?php echo esc_html( $testimonial['role'] ); ?></small></span>
                        </footer>
                    </article>
                <?php endforeach; ?>
            </div>

            <aside class="testimonials-score" aria-label="Patient satisfaction rating">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/card-glow.jpg' ); ?>" alt="Relaxing aesthetic care" loading="lazy">
                <div class="testimonials-score-card">
                    <strong>4.9</strong><span class="testimonial-stars" aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span><small>Client rating</small>
                    <div class="testimonials-avatars" aria-hidden="true">
                        <img src="<?php echo esc_url( $theme_uri . '/assets/images/avatar-therapist.jpg' ); ?>" alt=""><img src="<?php echo esc_url( $theme_uri . '/assets/images/card-facial.jpg' ); ?>" alt=""><img src="<?php echo esc_url( $theme_uri . '/assets/images/card-skincare.jpg' ); ?>" alt=""><img src="<?php echo esc_url( $theme_uri . '/assets/images/card-glow.jpg' ); ?>" alt="">
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>