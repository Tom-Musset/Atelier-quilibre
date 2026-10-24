
<?php get_header(); ?>

<main class="about-page">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <section class="about-hero">
                <p class="about-hero__eyebrow">Qui sommes-nous ?</p>
                <h1>Une communication plus responsable, simplement.</h1>
                <p class="about-hero__intro">
                    Chez Atelier Équilibre, nous pensons qu'une communication
                    efficace n'a pas besoin d'être excessive. Nous privilégions
                    les idées utiles, les choix réfléchis et les supports conçus
                    pour durer.
                </p>
            </section>

            <section class="about-section">
                <h2>Notre approche</h2>
                <p>
                    Chaque projet commence par une question simple :
                    de quoi avez-vous réellement besoin pour communiquer ?
                </p>
                <p>
                    Nous cherchons à proposer des solutions adaptées à vos
                    objectifs, à votre public et à vos moyens, sans multiplier
                    les supports ni les éléments superflus.
                </p>
            </section>

            <section class="about-section about-section--highlight">
                <h2>Nos engagements</h2>

                <div class="about-values">
                    <article class="about-value">
                        <h3>La simplicité</h3>
                        <p>
                            Aller à l'essentiel pour rendre chaque message
                            plus clair et chaque support plus utile.
                        </p>
                    </article>

                    <article class="about-value">
                        <h3>La sobriété</h3>
                        <p>
                            Privilégier des formats adaptés, limiter le
                            superflu et éviter les ressources inutiles.
                        </p>
                    </article>

                    <article class="about-value">
                        <h3>L'accessibilité</h3>
                        <p>
                            Concevoir des contenus lisibles, compréhensibles
                            et utilisables par le plus grand nombre.
                        </p>
                    </article>
                </div>
            </section>

            <section class="about-section">
                <h2>Une méthode fondée sur l'écoute</h2>
                <p>
                    Nous prenons le temps de comprendre votre besoin avant
                    de proposer une solution. L'objectif : concevoir une
                    communication cohérente, utile et facile à faire évoluer.
                </p>
                <p>
                    Parce qu'une démarche responsable commence aussi par
                    les bonnes questions, nous avançons avec vous à chaque
                    étape du projet.
                </p>
                <a class="about-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                    Parlons de votre projet
                </a>
            </section>

        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
