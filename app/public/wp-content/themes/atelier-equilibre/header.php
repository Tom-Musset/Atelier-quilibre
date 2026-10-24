
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="site-header__branding">
            <p class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </p>

            <p class="site-description">
                <?php bloginfo( 'description' ); ?>
            </p>
        </div>

        <nav class="site-navigation" aria-label="Navigation principale">
            <button
                class="menu-toggle"
                type="button"
                aria-expanded="false"
                aria-controls="primary-menu"
            >
                <span class="menu-toggle__label">Menu</span>
                <span class="menu-toggle__icon" aria-hidden="true">
                    ☰
                </span>
            </button>

            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'menu_id'        => 'primary-menu',
                )
            );
            ?>
        </nav>
    </header>
