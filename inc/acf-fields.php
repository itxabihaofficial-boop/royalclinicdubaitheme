<?php
/**
 * Dynamic Clinic - Programmatic ACF Field Definitions
 * Automatically registers field groups in ACF without requiring manual imports.
 *
 * @package DynamicClinic
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'acf/init', 'dynamic_clinic_register_acf_fields' );

function dynamic_clinic_register_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // 1. Homepage Hero Section Field Group
    acf_add_local_field_group( array(
        'key' => 'group_hero_orbit_section',
        'title' => 'Homepage Hero (Curved Arc Carousel)',
        'fields' => array(
            array(
                'key' => 'field_hero_badge',
                'label' => 'Hero Pill Badge',
                'name' => 'hero_badge_text',
                'type' => 'text',
                'default_value' => 'DYNAMIC CLINIC',
            ),
            array(
                'key' => 'field_hero_title',
                'label' => 'Hero Main Title',
                'name' => 'hero_title',
                'type' => 'text',
                'default_value' => 'Beauty, Refined.',
            ),
            array(
                'key' => 'field_hero_subtitle',
                'label' => 'Hero Subtitle',
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Luxury hair, skin, and wellness treatments crafted to enhance your natural beauty.',
            ),
            array(
                'key' => 'field_hero_cta_text',
                'label' => 'Hero Button Text',
                'name' => 'hero_cta_text',
                'type' => 'text',
                'default_value' => 'BOOK APPOINTMENT',
            ),
            array(
                'key' => 'field_hero_cta_link',
                'label' => 'Hero Button Link',
                'name' => 'hero_cta_link',
                'type' => 'text',
                'default_value' => '#book',
            ),
            array(
                'key' => 'field_hero_backdrop',
                'label' => 'Hero Background Image',
                'name' => 'hero_backdrop_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_hero_cards_repeater',
                'label' => 'Orbiting Treatment Cards',
                'name' => 'hero_orbit_cards',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Treatment Card',
                'sub_fields' => array(
                    array(
                        'key' => 'field_card_title',
                        'label' => 'Treatment Title',
                        'name' => 'title',
                        'type' => 'text',
                        'default_value' => 'Skin Therapy',
                    ),
                    array(
                        'key' => 'field_card_img',
                        'label' => 'Card Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                    ),
                    array(
                        'key' => 'field_card_url',
                        'label' => 'Target Link',
                        'name' => 'link',
                        'type' => 'text',
                        'default_value' => '#services',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
    ) );

    // 2. Scroll Text Reveal Philosophy Section Field Group
    acf_add_local_field_group( array(
        'key' => 'group_scroll_reveal_section',
        'title' => 'Philosophy (Scroll Text-Fill Reveal)',
        'fields' => array(
            array(
                'key' => 'field_reveal_eyebrow',
                'label' => 'Section Eyebrow Tag',
                'name' => 'reveal_eyebrow',
                'type' => 'text',
                'default_value' => 'PHILOSOPHY & CRAFT',
            ),
            array(
                'key' => 'field_reveal_headline',
                'label' => 'Scroll-Fill Statement Headline',
                'name' => 'reveal_headline',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Where clinical dermatology merges with bespoke aesthetic ritual to awaken the natural brilliance of your skin.',
            ),
            array(
                'key' => 'field_stat1_num',
                'label' => 'Stat 1 Number',
                'name' => 'stat_item_1_number',
                'type' => 'text',
                'default_value' => '15+',
            ),
            array(
                'key' => 'field_stat1_lbl',
                'label' => 'Stat 1 Label',
                'name' => 'stat_item_1_label',
                'type' => 'text',
                'default_value' => 'Years of Clinical Mastery',
            ),
            array(
                'key' => 'field_stat2_num',
                'label' => 'Stat 2 Number',
                'name' => 'stat_item_2_number',
                'type' => 'text',
                'default_value' => '99.4%',
            ),
            array(
                'key' => 'field_stat2_lbl',
                'label' => 'Stat 2 Label',
                'name' => 'stat_item_2_label',
                'type' => 'text',
                'default_value' => 'Client Radiance Satisfaction',
            ),
            array(
                'key' => 'field_stat3_num',
                'label' => 'Stat 3 Number',
                'name' => 'stat_item_3_number',
                'type' => 'text',
                'default_value' => '100%',
            ),
            array(
                'key' => 'field_stat3_lbl',
                'label' => 'Stat 3 Label',
                'name' => 'stat_item_3_label',
                'type' => 'text',
                'default_value' => 'Personalized Skincare Protocols',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
    ) );

    // 3. Remaining homepage content. Repeaters keep every repeated card editable.
    acf_add_local_field_group( array(
        'key' => 'group_homepage_content_sections',
        'title' => 'Homepage Content Sections',
        'fields' => array(
            array( 'key' => 'field_services_badge', 'label' => 'Services eyebrow', 'name' => 'services_badge_text', 'type' => 'text', 'default_value' => 'SIGNATURE SERVICES' ),
            array( 'key' => 'field_services_headline', 'label' => 'Services headline', 'name' => 'services_headline', 'type' => 'textarea', 'new_lines' => 'br', 'default_value' => 'Bespoke Treatments<br>Crafted for Your Well-<br>being' ),
            array( 'key' => 'field_services_lead', 'label' => 'Services introduction', 'name' => 'services_lead', 'type' => 'textarea', 'default_value' => 'Immerse yourself in our premium collection of curated aesthetic procedures designed to restore balance, harmony, and natural beauty.' ),
            array( 'key' => 'field_services_items', 'label' => 'Service cards', 'name' => 'services_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add service', 'sub_fields' => array(
                array( 'key' => 'field_service_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
                array( 'key' => 'field_service_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea' ),
                array( 'key' => 'field_service_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array' ),
                array( 'key' => 'field_service_link', 'label' => 'Link', 'name' => 'link', 'type' => 'link' ),
                array( 'key' => 'field_service_doctor', 'label' => 'Clinician label', 'name' => 'doctor', 'type' => 'text' ),
                array( 'key' => 'field_service_features', 'label' => 'Features (one per line)', 'name' => 'features', 'type' => 'textarea' ),
            ) ),
            array( 'key' => 'field_results_badge', 'label' => 'Results eyebrow', 'name' => 'results_badge', 'type' => 'text', 'default_value' => 'Visual Proof' ),
            array( 'key' => 'field_results_title', 'label' => 'Results title', 'name' => 'results_title', 'type' => 'text', 'default_value' => 'Before & After' ),
            array( 'key' => 'field_results_tags', 'label' => 'Result categories (one per line)', 'name' => 'results_tags', 'type' => 'textarea' ),
            array( 'key' => 'field_results_gallery', 'label' => 'Results gallery', 'name' => 'results_gallery', 'type' => 'gallery', 'return_format' => 'array' ),
            array( 'key' => 'field_results_cta_text', 'label' => 'Results button text', 'name' => 'results_cta_text', 'type' => 'text', 'default_value' => 'Begin Your Transformation' ),
            array( 'key' => 'field_results_cta_link', 'label' => 'Results button link', 'name' => 'results_cta_link', 'type' => 'link' ),
            array( 'key' => 'field_specialists_eyebrow', 'label' => 'Specialists eyebrow', 'name' => 'specialists_eyebrow', 'type' => 'text' ),
            array( 'key' => 'field_specialists_title', 'label' => 'Specialists title', 'name' => 'specialists_title', 'type' => 'text' ),
            array( 'key' => 'field_specialists_lead', 'label' => 'Specialists introduction', 'name' => 'specialists_lead', 'type' => 'textarea' ),
            array( 'key' => 'field_specialists_items', 'label' => 'Specialist cards', 'name' => 'specialists_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add specialist', 'sub_fields' => array(
                array( 'key' => 'field_specialist_service', 'label' => 'Service', 'name' => 'service', 'type' => 'text' ), array( 'key' => 'field_specialist_summary', 'label' => 'Summary', 'name' => 'summary', 'type' => 'textarea' ), array( 'key' => 'field_specialist_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text' ), array( 'key' => 'field_specialist_role', 'label' => 'Role', 'name' => 'role', 'type' => 'text' ), array( 'key' => 'field_specialist_image', 'label' => 'Photo', 'name' => 'image', 'type' => 'image', 'return_format' => 'array' ), array( 'key' => 'field_specialist_facts', 'label' => 'Facts (one per line)', 'name' => 'facts', 'type' => 'textarea' ),
            ) ),
            array( 'key' => 'field_testimonials_eyebrow', 'label' => 'Testimonials eyebrow', 'name' => 'testimonials_eyebrow', 'type' => 'text' ), array( 'key' => 'field_testimonials_title', 'label' => 'Testimonials title', 'name' => 'testimonials_title', 'type' => 'text' ),
            array( 'key' => 'field_testimonial_items', 'label' => 'Testimonials', 'name' => 'testimonial_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add testimonial', 'sub_fields' => array(
                array( 'key' => 'field_testimonial_quote', 'label' => 'Quote', 'name' => 'quote', 'type' => 'textarea' ), array( 'key' => 'field_testimonial_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text' ), array( 'key' => 'field_testimonial_role', 'label' => 'Role', 'name' => 'role', 'type' => 'text' ), array( 'key' => 'field_testimonial_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array' ),
            ) ),
            array( 'key' => 'field_insights_eyebrow', 'label' => 'Insights eyebrow', 'name' => 'insights_eyebrow', 'type' => 'text' ), array( 'key' => 'field_insights_title', 'label' => 'Insights title', 'name' => 'insights_title', 'type' => 'text' ), array( 'key' => 'field_insights_lead', 'label' => 'Insights introduction', 'name' => 'insights_lead', 'type' => 'textarea' ),
            array( 'key' => 'field_insights_items', 'label' => 'Insight articles', 'name' => 'insights_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add article', 'sub_fields' => array(
                array( 'key' => 'field_insight_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ), array( 'key' => 'field_insight_category', 'label' => 'Category', 'name' => 'category', 'type' => 'text' ), array( 'key' => 'field_insight_date', 'label' => 'Date', 'name' => 'date', 'type' => 'date_picker', 'return_format' => 'M j, Y' ), array( 'key' => 'field_insight_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array' ), array( 'key' => 'field_insight_link', 'label' => 'Article link', 'name' => 'link', 'type' => 'link' ),
            ) ),
            array( 'key' => 'field_booking_eyebrow', 'label' => 'Booking eyebrow', 'name' => 'booking_eyebrow', 'type' => 'text' ), array( 'key' => 'field_booking_title', 'label' => 'Booking title', 'name' => 'booking_title', 'type' => 'text' ), array( 'key' => 'field_booking_intro', 'label' => 'Booking introduction', 'name' => 'booking_intro', 'type' => 'textarea' ), array( 'key' => 'field_booking_image', 'label' => 'Booking image', 'name' => 'booking_image', 'type' => 'image', 'return_format' => 'array' ), array( 'key' => 'field_booking_inquiries_heading', 'label' => 'Contact-card heading', 'name' => 'booking_inquiries_heading', 'type' => 'text' ),
        ),
        'location' => array( array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ) ),
        'position' => 'normal', 'style' => 'default', 'label_placement' => 'top',
    ) );
    // 4. Global Clinic Settings & Color Customizer (Options Page)
    acf_add_local_field_group( array(
        'key' => 'group_global_clinic_options',
        'title' => 'Global Brand & Clinic Settings',
        'fields' => array(
            array(
                'key' => 'field_opt_primary_color',
                'label' => 'Brand Primary Color (Luxury Bronze)',
                'name' => 'brand_primary_color',
                'type' => 'color_picker',
                'default_value' => '#986a3e',
            ),
            array(
                'key' => 'field_opt_accent_color',
                'label' => 'Brand Accent Gold / Copper Color',
                'name' => 'brand_accent_color',
                'type' => 'color_picker',
                'default_value' => '#70441b',
            ),
            array(
                'key' => 'field_opt_dark_color',
                'label' => 'Brand Dark Surface Color (Deep Obsidian)',
                'name' => 'brand_dark_color',
                'type' => 'color_picker',
                'default_value' => '#101011',
            ),
            array(
                'key' => 'field_opt_page_background_color',
                'label' => 'Page Background Color',
                'name' => 'brand_page_background_color',
                'type' => 'color_picker',
                'default_value' => '#fdf7ef',
            ),
            array(
                'key' => 'field_opt_light_sand_color',
                'label' => 'Light Sand Surface Color',
                'name' => 'brand_light_sand_color',
                'type' => 'color_picker',
                'default_value' => '#f7ecdf',
            ),
            array(
                'key' => 'field_opt_text_color',
                'label' => 'Primary Text Color',
                'name' => 'brand_text_color',
                'type' => 'color_picker',
                'default_value' => '#633b2c',
            ),
            array(
                'key' => 'field_opt_clinic_name',
                'label' => 'Clinic Brand Name',
                'name' => 'clinic_brand_name',
                'type' => 'text',
                'default_value' => 'DYNAMIC CLINIC',
            ),
            array(
                'key' => 'field_opt_clinic_phone',
                'label' => 'Concierge Phone',
                'name' => 'clinic_phone',
                'type' => 'text',
                'default_value' => '+1 (800) 456-7890',
            ),
            array(
                'key' => 'field_opt_clinic_email',
                'label' => 'Concierge Email',
                'name' => 'clinic_email',
                'type' => 'email',
                'default_value' => 'concierge@dynamicclinic.com',
            ),
            array(
                'key' => 'field_opt_clinic_address',
                'label' => 'Physical Address',
                'name' => 'clinic_address',
                'type' => 'text',
                'default_value' => '450 Luxury Boulevard, Suite 800, Beverly Hills, CA',
            ),
            array(
                'key' => 'field_opt_nav_cta_text',
                'label' => 'Header Appointment Button Text',
                'name' => 'header_appointment_cta_text',
                'type' => 'text',
                'default_value' => 'BOOK APPOINTMENT',
            ),
            array(
                'key' => 'field_opt_nav_cta_link',
                'label' => 'Header Appointment Button Link',
                'name' => 'header_appointment_cta_link',
                'type' => 'text',
                'default_value' => '#book',
            ),
            array(
                'key' => 'field_opt_social_instagram',
                'label' => 'Instagram URL',
                'name' => 'social_instagram',
                'type' => 'url',
            ),
            array(
                'key' => 'field_opt_social_facebook',
                'label' => 'Facebook URL',
                'name' => 'social_facebook',
                'type' => 'url',
            ),
            array(
                'key' => 'field_opt_social_tiktok',
                'label' => 'TikTok URL',
                'name' => 'social_tiktok',
                'type' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'clinic-theme-settings',
                ),
            ),
        ),
    ) );
}
