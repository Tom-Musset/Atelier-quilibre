<?php get_header(); ?>

<main class="page-content contact-page">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ): the_post(); ?>
            <article>
                <h1><?php the_title(); ?></h1>

                <div class="page-content__body">
                    <?php the_content(); ?>
                    <?php
                    $contact_status = isset( $_GET['contact_status'] )
                        ? sanitize_key( wp_unslash( $_GET['contact_status'] ) )
                        : '';

                    if ( $contact_status === 'mail_error' ) :
                    ?>
                        <p role="alert">Une erreur est survenue lors de l'envoi. Veuillez réessayer ultérieurement</p>
                    <?php elseif ( $contact_status === 'invalid' ) : ?>
                        <p role="alert">La vérification du formulaire a échoué. Veuillez réessayer.</p>
                    <?php elseif ( $contact_status === 'duplicate' ) : ?>
                        <p role="alert">
                            Ce formulaire a déjà été envoyé. Si nécessaire, veuillez patienter avant de réessayer.    
                        </p>
                    <?php elseif ( $contact_status === 'sent' ) : ?>
                        <p role="status">Votre message a été envoyé. Nous vous répondrons rapidement !</p>
                    <?php elseif ( $contact_status === 'error' ) : ?>
                        <p role="alert">Vérifiez les champs : certaines informations sont manquantes ou invalides.</p>
                    <?php elseif ( $contact_status === 'error_mail' ) : ?>
                        <p role="alert">Veuillez rentrer un mail valide.</p>
                    <?php endif; ?>
                </div>

                <?php $contact_token = wp_generate_uuid4();?>

                <form class="contact-form" method="post">
                    <div class="contact-form__field">
                        <label for="contact-name">Votre nom</label>
                        <input
                            type="text"
                            id="contact-name"
                            name="contact_name"
                            autocomplete="name"
                            required
                            >
                    </div>

                    <div class="contact-form__field">
                        <label for="contact-email">Votre adresse e-mail</label>
                        <input
                            type="email"
                            id="contact-email"
                            name="contact_email"
                            autocomplete="email"
                            required
                        >
                    </div>

                    <div class="contact-form__field">
                        <label for="contact-subject">Sujet</label>
                        <input
                            type="text"
                            id="contact-subject"
                            name="contact_subject"
                            required
                        >
                    </div>

                    <div class="contact-form__field">
                        <label for="contact-message">Votre message</label>
                        <textarea
                            id="contact-message"
                            name="contact_message"
                            rows="6"
                            required
                        ></textarea>
                    </div>

                    <?php wp_nonce_field( 'atelier_equilibre_contact', 'contact_nonce'); ?>

                    <input
                        type="hidden"
                        name="contact_token"
                        value="<?php echo esc_attr( $contact_token ); ?>"
                    >

                    <button type="submit" name="contact_submit">
                        Envoyer le message
                    </button>
                </form>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>