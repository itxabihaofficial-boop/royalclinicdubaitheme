<?php
/**
 * The main template file
 *
 * @package DynamicClinic
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 10rem 1.5rem 6rem;">
    <div class="container-narrow">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'service-card' ); ?> style="padding: 2.5rem; margin-bottom: 2rem;">
                    <header class="entry-header">
                        <h1 class="entry-title" style="font-family: var(--font-serif); font-size: 2.2rem; color: var(--color-light); margin-bottom: 1rem;">
                            <?php the_title(); ?>
                        </h1>
                    </header>
                    <div class="entry-content" style="color: var(--color-muted); line-height: 1.7;">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <p style="text-align: center; color: var(--color-muted);">No entries found.</p>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
