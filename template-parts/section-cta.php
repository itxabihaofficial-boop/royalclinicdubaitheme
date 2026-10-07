<?php
/**
 * Template Part: Appointment Request
 *
 * @package DynamicClinic
 */

$theme_uri = get_template_directory_uri();
$clinic_phone = function_exists( 'get_field' ) ? get_field( 'clinic_phone', 'option' ) : '';
$clinic_email = function_exists( 'get_field' ) ? get_field( 'clinic_email', 'option' ) : '';
$clinic_phone = $clinic_phone ?: '+971 4 123 4567';
$clinic_email = $clinic_email ?: 'concierge@dynamicclinic.com';
?>

<section class="section-booking-request" id="book" aria-labelledby="booking-request-title">
    <div class="container">
        <div class="booking-request">
            <div class="booking-form-panel">
                <span class="booking-eyebrow">Private consultation</span>
                <h2 id="booking-request-title">Request an appointment</h2>
                <p>Tell us a little about your goals and our concierge team will contact you shortly.</p>

                <form class="booking-form" action="#book" method="post">
                    <div class="booking-form-grid">
                        <label>Name*<input type="text" name="name" autocomplete="name" placeholder="Your name" required></label>
                        <label>Email*<input type="email" name="email" autocomplete="email" placeholder="Email address" required></label>
                        <label>Phone*<input type="tel" name="phone" autocomplete="tel" placeholder="Phone number" required></label>
                        <label>Therapy*<select name="therapy" required><option value="" selected disabled>Select a treatment</option><option>Skin rejuvenation</option><option>Injectables and fillers</option><option>Laser treatment</option><option>Hair restoration</option><option>Plastic surgery</option></select></label>
                    </div>
                    <label class="booking-message">How can we help?<textarea name="message" rows="4" placeholder="Tell us about your goals"></textarea></label>
                    <label class="booking-consent"><input type="checkbox" required><span>I agree to be contacted about my appointment request.</span></label>
                    <div class="booking-form-footer"><button type="submit" class="booking-submit"><span aria-hidden="true">&rarr;</span> Book an appointment</button><small>We will reply within 24&ndash;48 hours.</small></div>
                </form>
            </div>

            <aside class="booking-visual" aria-label="Dynamic Clinic consultation">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/card-glow.jpg' ); ?>" alt="Radiant skin treatment detail" loading="lazy">
                <div class="booking-contact-card">
                    <span aria-hidden="true" class="booking-contact-mark">&#10022;</span>
                    <h3>General inquiries</h3>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $clinic_phone ) ); ?>"><?php echo esc_html( $clinic_phone ); ?></a>
                    <a href="mailto:<?php echo esc_attr( $clinic_email ); ?>"><?php echo esc_html( $clinic_email ); ?></a>
                </div>
            </aside>
        </div>
    </div>
</section>