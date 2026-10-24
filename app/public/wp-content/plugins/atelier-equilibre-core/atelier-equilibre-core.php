<?php
/**
 * Plugin Name: Atelier Équilibre Core
 * Description: Fonctionnalités métier du site Atelier Équilibre.
 * Version: 1.0.0
 * Author: Tom
 */

function atelier_equilibre_register_project_type() {
    $labels = array(
        'name'              =>      'Réalisations',
        'singular_name'     =>      'Réalisation',
        'add_new_item'      =>      'Ajouter une réalisation',
        'edit_item'         =>      'Modifier la réalisation',
        'new_item'          =>      'Nouvelle réalisation',
        'view_item'         =>      'Voir la réalisation',
        'search_items'      =>      'Rechercher des réalisations',
        'not_found'         =>      'Aucune réalisation trouvée',
        'menu_name'         =>      'Réalisations',
    );

    $args = array(
        'labels'        =>  $labels,
        'public'        =>  true,
        'has_archive'   =>  true,
        'rewrite'       =>  array( 'slug'   =>  'realisations'),
        'menu_icon'     =>  'dashicons-portfolio',
        'supports'      =>  array( 'title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'  =>  true,
    );

    register_post_type( 'realisation', $args);
}

add_action( 'init', 'atelier_equilibre_register_project_type');