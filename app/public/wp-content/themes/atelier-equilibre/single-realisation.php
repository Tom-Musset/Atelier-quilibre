<?php get_header() ; ?>

<main class="project-detail">
    <?php if(have_posts()) : ?>
        <?php while (have_posts() ): the_post(); ?>
            <article <?php post_class(); ?>>
                <header class="project-detail__header">
                    <h1><?php the_title(); ?></h1>

                    <?php if ( has_excerpt() ) : ?>
                        <p><?php the_excerpt(); ?></p>
                    <?php endif ; ?>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <figure class="project-detail__image">
                        <?php the_post_thumbnail('large'); ?>
                    </figure>
                <?php endif ; ?>

                <div class="project-detail__content">
                    <?php the_content(); ?>
                </div>

                <p>
                    <a href="<?php echo esc_url(get_post_type_archive_link('realisation') ); ?>" >
                       ← Retour aux réalisations
                    </a>
                </p>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer() ; ?>