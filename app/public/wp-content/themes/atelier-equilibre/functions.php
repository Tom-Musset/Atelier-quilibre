<?php
function atelier_equilibre_setup(){
    add_theme_support( 'title-tag' );
    add_theme_support('post-thumbnails');
}

add_action( 'after_setup_theme', 'atelier_equilibre_setup' );

function atelier_equilibre_enqueue_style(){

    $style_path = get_theme_file_path('/style.min.css');
    $script_path = get_theme_file_path('/js/menu.min.js');

    wp_enqueue_style(
        'atelier-equilibre-style',
        get_theme_file_uri('/style.min.css'),
        array(),
        filemtime($style_path)
    );

    wp_enqueue_script(
        'atelier-equilibre-menu',
        get_theme_file_uri('/js/menu.min.js'),
        [],
        filemtime($script_path),
        true
    );
}

add_action(
    'wp_enqueue_scripts',
    'atelier_equilibre_enqueue_style'
);

function atelier_equilibre_register_menus() {
    register_nav_menus(
        array(
            'primary' => 'Menu Principal',
        )
    );
}

add_action(
    'after_setup_theme',
    'atelier_equilibre_register_menus'
);

function atelier_equilibre_meta_description() {
    if ( is_front_page() ) {
        $description 
        = 
        'Atelier Équilibre accompagne les entreprises dans une communication plus responsable 
        grâce à des supports utiles, accessibles et éco-conçus.';
    } elseif ( is_page('services') ) {
        $description 
        =
        "Découvrez les services d'Atelier Équilibre pour concevoir une communication 
        plus responsable, adaptée aux besoins de votre entreprise.";
    } elseif ( is_post_type_archive('realisation') ) {
        $description
        =
        "Découvrez les projets d'Atelier Équilibre et des exemples de supports de 
        communication conçus dans une démarche plus responsable.";
    } elseif ( is_page('a-propos') ) {
        $description
        =
        'Découvrez Atelier Équilibre, sa démarche et ses engagements pour une communication 
        plus responsable et accessible.';
    } elseif ( is_page('contact') ) {
        $description
        =
        'Contactez Atelier Équilibre pour échanger sur votre projet et vos besoins en 
        communication responsable.';
    } elseif ( is_singular('realisation') ) {
        $description = get_the_excerpt();

        if ( empty($description) ) {
            $description 
            = 
            get_the_title() 
            . " : découvrez cette réalisation d'Atelier Équilibre.";
        }
    } else {
        return ;
    }
    echo '<meta name="description" content="' . esc_attr(wp_strip_all_tags( $description ) ) . '">' . "\n";
} 

add_action('wp_head', 'atelier_equilibre_meta_description');


function atelier_equilibre_handle_contact_form() {
    if( $_SERVER['REQUEST_METHOD'] !== 'POST'
        || ! isset( $_POST['contact_submit'] ) ) {
        return;
    }

    $redirect_url = get_permalink();

    if(
        ! isset($_POST['contact_nonce'])
        || ! wp_verify_nonce(
            sanitize_text_field(wp_unslash( $_POST['contact_nonce'] ) ),
            'atelier_equilibre_contact'
        )
    ){
        wp_safe_redirect( add_query_arg('contact_status', 'invalid', $redirect_url ) );
        exit;
    }

    //protection de l'envoi du formulaire via token
    $contact_token = isset( $_POST['contact_token'] )
        ? sanitize_text_field( wp_unslash( $_POST['contact_token'] ) )
        :'';

    if ( ! wp_is_uuid( $contact_token, 4 ) ) {
        wp_safe_redirect(
            add_query_arg( 'contact_status', 'invalid', $redirect_url)
        );
        exit;
    }

    $token_key = 'atelier_contact_' . $contact_token;

    if ( get_transient( $token_key ) !== false ) {
        wp_safe_redirect(
            add_query_arg( 'contact_status', 'duplicate', $redirect_url )
        );
        exit;
    }


    $name = isset( $_POST['contact_name'])
        ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) )
        : '';
    
    $subject = isset( $_POST['contact_subject'] )
        ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) )
        : '';

    $message = isset( $_POST['contact_message'] )
        ? sanitize_textarea_field( wp_unslash($_POST['contact_message'] ) )
        : '';

    $email_raw = isset( $_POST['contact_email'] )
    ? trim( sanitize_text_field( wp_unslash( $_POST['contact_email'] ) ) )
    : '';

    if ( 
        $name === ''
        || $email_raw === ''
        || $subject === ''
        || $message === ''
    ){
        wp_safe_redirect( add_query_arg( 'contact_status', 'error', $redirect_url ) );
        exit;
    }

    if ( ! is_email( $email_raw ) ) {
        wp_safe_redirect(
            add_query_arg( 'contact_status', 'error_mail', $redirect_url )
        );
        exit;
    }

    $email = sanitize_email( $email_raw );

    $to = 'contact@atelier-equilibre.text';

    $email_subject = '[Atelier Équilibre] ' . $subject;

    $email_message = "Nouveau message depuis le formulaire de contact. \n\n";
    $email_message .="Nom : " .$name . "\n";
    $email_message .="Email : " .$email ."\n";
    $email_message .="Sujet : " .$subject ."\n";
    $email_message .="Message : " .$message;

    $headers = array(
        'Reply-To: ' .$name . ' <' . $email . '>',
    );

    set_transient( $token_key, 'processing', 10 * MINUTE_IN_SECONDS );
    
    $mail_sent = wp_mail(
        $to,
        $email_subject,
        $email_message,
        $headers
    );

    $status = $mail_sent ? 'sent' : 'mail_error';

    wp_safe_redirect(
        add_query_arg( 'contact_status', $status, $redirect_url )
    );
    exit;
}

add_action( 'template_redirect', 'atelier_equilibre_handle_contact_form');

function atelier_equilibre_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7);
    remove_action( 'wp_print_styles', 'print_emoji_styles');
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_mail' );
}

add_action( 'init', 'atelier_equilibre_disable_emojis' );

