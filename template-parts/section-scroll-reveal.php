<?php
/**
 * Template Part: Philosophy & On-Scroll Text Color Fill Section
 *
 * Each word of the statement fills with glowing light color as the user scrolls.
 * All text and metrics are dynamically hooked to ACF.
 *
 * @package DynamicClinic
 */

$reveal_eyebrow  = function_exists('get_field') ? get_field('reveal_eyebrow') : '';
$reveal_headline = function_exists('get_field') ? get_field('reveal_headline') : '';
$stat1_num       = function_exists('get_field') ? get_field('stat_item_1_number') : '';
$stat1_lbl       = function_exists('get_field') ? get_field('stat_item_1_label') : '';
$stat2_num       = function_exists('get_field') ? get_field('stat_item_2_number') : '';
$stat2_lbl       = function_exists('get_field') ? get_field('stat_item_2_label') : '';
$stat3_num       = function_exists('get_field') ? get_field('stat_item_3_number') : '';
$stat3_lbl       = function_exists('get_field') ? get_field('stat_item_3_label') : '';

if ( empty($reveal_eyebrow) )  $reveal_eyebrow  = 'PHILOSOPHY & CLINICAL ARTISTRY';
if ( empty($reveal_headline) ) $reveal_headline = 'Where clinical dermatology merges with bespoke aesthetic ritual to awaken the natural brilliance of your skin.';
if ( empty($stat1_num) )       $stat1_num       = '15+';
if ( empty($stat1_lbl) )       $stat1_lbl       = 'Years of Clinical Mastery';
if ( empty($stat2_num) )       $stat2_num       = '99.4%';
if ( empty($stat2_lbl) )       $stat2_lbl       = 'Client Radiance Satisfaction';
if ( empty($stat3_num) )       $stat3_num       = '100%';
if ( empty($stat3_lbl) )       $stat3_lbl       = 'Personalized Skincare Protocols';
?>

<section class="section-scroll-reveal" id="philosophy">
    <div class="reveal-inner">
        
        <div class="reveal-eyebrow">
            <span><?php echo esc_html($reveal_eyebrow); ?></span>
        </div>

        <!-- The On-Scroll Word Color Fill Headline -->
        <h2 class="scroll-fill-headline" data-scroll="text-fill">
            <?php echo esc_html($reveal_headline); ?>
        </h2>

        <!-- Trust & Excellence Metrics -->
        <div class="reveal-stats-grid">
            <div class="stat-item">
                <span class="stat-number"><?php echo esc_html($stat1_num); ?></span>
                <span class="stat-label"><?php echo esc_html($stat1_lbl); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo esc_html($stat2_num); ?></span>
                <span class="stat-label"><?php echo esc_html($stat2_lbl); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo esc_html($stat3_num); ?></span>
                <span class="stat-label"><?php echo esc_html($stat3_lbl); ?></span>
            </div>
        </div>

    </div>
</section>
