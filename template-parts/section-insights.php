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
?>
<section class="section-insights" id="insights" aria-labelledby="insights-title">
    <div class="container">
        <header class="insights-header">
            <span class="insights-eyebrow"><span aria-hidden="true"></span> Skin insights</span>
            <h2 id="insights-title">Helpful tips and<br><em>expert advice.</em></h2>
            <p>Practical guidance from our clinical team, designed to help you make informed decisions about your skin, hair, and wellbeing.</p>
        </header>

        <div class="insights-grid">
            <?php $featured = $articles[0]; ?>
            <article class="insight-featured">
                <a href="#book" class="insight-image-link" aria-label="Read: <?php echo esc_attr( $featured['title'] ); ?>"><img src="<?php echo esc_url( $theme_uri . '/assets/images/' . $featured['image'] ); ?>" alt="<?php echo esc_attr( $featured['title'] ); ?>" loading="lazy"></a>
                <div class="insight-meta"><time datetime="2026-03-05"><?php echo esc_html( $featured['date'] ); ?></time><span aria-hidden="true"></span><span><?php echo esc_html( $featured['category'] ); ?></span></div>
                <h3><a href="#book"><?php echo esc_html( $featured['title'] ); ?></a></h3>
                <a href="#book" class="insight-read-link">Read article <span aria-hidden="true">&rarr;</span></a>
            </article>

            <div class="insights-list">
                <?php foreach ( array_slice( $articles, 1 ) as $article ) : ?>
                    <article class="insight-list-item">
                        <a href="#book" class="insight-list-image" aria-label="Read: <?php echo esc_attr( $article['title'] ); ?>"><img src="<?php echo esc_url( $theme_uri . '/assets/images/' . $article['image'] ); ?>" alt="" loading="lazy"></a>
                        <div><div class="insight-meta"><time><?php echo esc_html( $article['date'] ); ?></time><span aria-hidden="true"></span><span><?php echo esc_html( $article['category'] ); ?></span></div><h3><a href="#book"><?php echo esc_html( $article['title'] ); ?></a></h3><a href="#book" class="insight-read-link">Read article <span aria-hidden="true">&rarr;</span></a></div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>