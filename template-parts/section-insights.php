<?php
/**
 * Template Part: Skin Insights
 *
 * @package DynamicClinic
 */

$theme_uri = get_template_directory_uri();
$articles = array(
    array( 'title' => 'Daily skincare habits that damage your skin', 'category' => 'Skin health', 'date' => 'Mar 5, 2026', 'image' => 'treatment-facial.jpg', 'featured' => true ),
    array( 'title' => 'Laser treatments: are they right for you?', 'category' => 'Treatment guide', 'date' => 'Mar 4, 2026', 'image' => 'card-glow.jpg' ),
    array( 'title' => 'How stress affects your skin health', 'category' => 'Skin health', 'date' => 'Mar 1, 2026', 'image' => 'card-facial.jpg' ),
    array( 'title' => 'Chemical peels: what to expect before and after', 'category' => 'Acne care', 'date' => 'Feb 27, 2026', 'image' => 'card-skincare.jpg' ),
);
foreach ( $articles as &$article ) {
    $article['link'] = '#book';
}
unset( $article );

$acf_articles = dynamic_clinic_field( 'insights_items', array() );
if ( is_array( $acf_articles ) && ! empty( $acf_articles ) ) {
    $default_articles = $articles;
    $articles = array();

    foreach ( $acf_articles as $index => $item ) {
        $default = isset( $default_articles[ $index ] ) ? $default_articles[ $index ] : $default_articles[0];
        $articles[] = array(
            'title'    => ! empty( $item['title'] ) ? $item['title'] : $default['title'],
            'category' => ! empty( $item['category'] ) ? $item['category'] : $default['category'],
            'date'     => ! empty( $item['date'] ) ? $item['date'] : $default['date'],
            'image'    => dynamic_clinic_image_url( isset( $item['image'] ) ? $item['image'] : '', $theme_uri . '/assets/images/' . $default['image'] ),
            'link'     => dynamic_clinic_link_url( isset( $item['link'] ) ? $item['link'] : '', '#book' ),
        );
    }
}

$insights_eyebrow = dynamic_clinic_field( 'insights_eyebrow', 'Skin insights' );
$insights_title    = dynamic_clinic_field( 'insights_title', 'Helpful tips and<br><em>expert advice.</em>' );
$insights_lead     = dynamic_clinic_field( 'insights_lead', 'Practical guidance from our clinical team, designed to help you make informed decisions about your skin, hair, and wellbeing.' );
?>
<section class="section-insights" id="insights" aria-labelledby="insights-title">
    <div class="container">
        <header class="insights-header">
            <span class="insights-eyebrow"><span aria-hidden="true"></span> <?php echo esc_html( $insights_eyebrow ); ?></span>
            <h2 id="insights-title"><?php echo wp_kses_post( $insights_title ); ?></h2>
            <p><?php echo esc_html( $insights_lead ); ?></p>
        </header>

        <div class="insights-grid">
            <?php $featured = $articles[0]; ?>
            <article class="insight-featured">
                <a href="<?php echo esc_url( $featured['link'] ); ?>" class="insight-image-link" aria-label="Read: <?php echo esc_attr( $featured['title'] ); ?>"><img src="<?php echo esc_url( dynamic_clinic_image_url( $featured['image'], $theme_uri . '/assets/images/treatment-facial.jpg' ) ); ?>" alt="<?php echo esc_attr( $featured['title'] ); ?>" loading="lazy"></a>
                <div class="insight-meta"><time><?php echo esc_html( $featured['date'] ); ?></time><span aria-hidden="true"></span><span><?php echo esc_html( $featured['category'] ); ?></span></div>
                <h3><a href="<?php echo esc_url( $featured['link'] ); ?>"><?php echo esc_html( $featured['title'] ); ?></a></h3>
                <a href="<?php echo esc_url( $featured['link'] ); ?>" class="insight-read-link">Read article <span aria-hidden="true">&rarr;</span></a>
            </article>

            <div class="insights-list">
                <?php foreach ( array_slice( $articles, 1 ) as $article ) : ?>
                    <article class="insight-list-item">
                        <a href="<?php echo esc_url( $article['link'] ); ?>" class="insight-list-image" aria-label="Read: <?php echo esc_attr( $article['title'] ); ?>"><img src="<?php echo esc_url( dynamic_clinic_image_url( $article['image'], $theme_uri . '/assets/images/card-glow.jpg' ) ); ?>" alt="" loading="lazy"></a>
                        <div><div class="insight-meta"><time><?php echo esc_html( $article['date'] ); ?></time><span aria-hidden="true"></span><span><?php echo esc_html( $article['category'] ); ?></span></div><h3><a href="<?php echo esc_url( $article['link'] ); ?>"><?php echo esc_html( $article['title'] ); ?></a></h3><a href="<?php echo esc_url( $article['link'] ); ?>" class="insight-read-link">Read article <span aria-hidden="true">&rarr;</span></a></div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>