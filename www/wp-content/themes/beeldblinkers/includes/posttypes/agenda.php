<?php
// Register Custom Post Type Agenda
function agenda_post_type() {

    $labels = array(
        'name'                  => _x( 'Agenda', 'Post Type General Name', 'ibpix' ),
        'singular_name'         => _x( 'Agenda', 'Post Type Singular Name', 'ibpix' ),
        'menu_name'             => __( 'Agenda', 'ibpix' ),
        'name_admin_bar'        => __( 'Agenda', 'ibpix' ),
        'archives'              => __( 'Agenda Archives', 'ibpix' ),
        'parent_item_colon'     => __( 'Hoofd Agenda:', 'ibpix' ),
        'all_items'             => __( 'Alle agenda items', 'ibpix' ),
        'add_new_item'          => __( 'Nieuw agenda item', 'ibpix' ),
        'add_new'               => __( 'Nieuw agenda item', 'ibpix' ),
        'new_item'              => __( 'Nieuw agenda item', 'ibpix' ),
        'edit_item'             => __( 'Agenda aanpassen', 'ibpix' ),
        'update_item'           => __( 'Update Agenda', 'ibpix' ),
        'view_item'             => __( 'Bekijk Agenda', 'ibpix' ),
        'search_items'          => __( 'Zoek agenda', 'ibpix' ),
        'not_found'             => __( 'Geen agenda gevonden', 'ibpix' ),
        'not_found_in_trash'    => __( 'Geen agenda gevonden in de prullenbak', 'ibpix' ),
        'featured_image'        => __( 'Uitgelichte Afbeelding', 'ibpix' ),
        'set_featured_image'    => __( 'Uitgelichte Afbeelding instellen', 'ibpix' ),
        'remove_featured_image' => __( 'Verwijder Uitgelichte Afbeelding', 'ibpix' ),
        'use_featured_image'    => __( 'Gebruik als Uitgelichte Afbeelding', 'ibpix' ),
        'insert_into_item'      => __( 'Insert into item', 'ibpix' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'ibpix' ),
        'items_list'            => __( 'Items list', 'ibpix' ),
        'items_list_navigation' => __( 'Items list navigation', 'ibpix' ),
        'filter_items_list'     => __( 'Filter items list', 'ibpix' ),
    );
    $args = array(
        'label'                 => __( 'Agenda', 'ibpix' ),
        'description'           => __( 'Agenda information pages.', 'ibpix' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'author', 'editor' ),
        'taxonomies'            => array( '' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-heart',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'custom_agenda_slug'),
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'agenda', $args );

}
add_action( 'init', 'agenda_post_type', 0 );