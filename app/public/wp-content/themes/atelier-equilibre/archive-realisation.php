<?php get_header(); ?>

<main class="projects">
    <header class="projects__header">
        <h1>Nos réalisations</h1>
        <p>
            Découvrez quelques projets conçus avec créativité,
            accessibilité et sobriété numérique.
        </p>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="projects__grid">
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="project-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php
                            the_post_thumbnail(
                                'medium',
                                array(
                                    'loading' => 'lazy',
                                )
                            );
                            ?>
                        <?php endif ; ?>

                        <h2><?php the_title(); ?></h2>
                    </a>

                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; ?>
        </div>

        <nav class="projects-pagination" aria-label="Pagination des réalisations">
            <?php the_posts_pagination(
                array(
                    'mid_size'  => 1,
                    'prev_text' => '← Précédent',
                    'next_text' => 'Suivant →',
                )
            );
            ?>
        </nav>
    <?php else : ?>
        <p>Aucune réalisation n'est publiée pour le moment.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>