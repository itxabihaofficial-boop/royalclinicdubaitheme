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

    // 3. Global Clinic Settings & Color Customizer (Options Page)
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
