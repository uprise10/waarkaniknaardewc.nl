<?php
/**
 * ibpix functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

if (!function_exists('ibpix_setup')) :
    /**
     * ibpix setup.
     *
     * Set up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support post thumbnails.
     *
     * @since ibpix 1.0
     */
    function ibpix_setup () {

        /*
         * Make ibpix available for translation.
         *
         * Translations can be added to the /languages/ directory.
         * If you're building a theme based on ibpix, use a find and
         * replace to change 'ibpix' to the name of your theme in all
         * template files.
         */
        load_theme_textdomain('ibpix', get_template_directory() . '/languages');

        // This theme styles the visual editor to resemble the theme style.
        //add_editor_style( array( 'css/editor-style.css', ibpix_font_url() ) );

        // Add RSS feed links to <head> for posts and comments.
        //add_theme_support( 'automatic-feed-links' );

        //Enable support for Post Thumbnails, and declare two sizes.
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'quote-bg-fw-plus-slides', 1034, 552, true );
        add_image_size( 'big-slides', 1600, 9999, false );
        add_image_size( 'small', 200, 9999, false );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array (
            'primary' => __('Top primary menu', 'ibpix'),
            // 'footer' => __('Footer menu 1', 'ibpix'),
            // 'footer_two' => __('Footer menu 2', 'ibpix'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array (
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));


	    $sidebar_args = array(
		    'name'          => __( 'Sidebar', 'ibpix' ),
		    'id'            => 'sidebar-1',
		    'description'   => '',
		    'class'         => '',
		    'before_widget' => '<li id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</li>',
		    'before_title'  => '<h3 class="widgettitle">',
		    'after_title'   => '</h3>' );

	    // adde widgets sidebar
	    if ( function_exists('register_sidebar') ) {
		    register_sidebar( $sidebar_args );
		    register_sidebar( array(
			    'name'          => __( 'Footer 1', 'ibpix' ),
			    'id'            => 'footer-sidebar-1',
			    'description'   => '',
			    'class'         => '',
			    'before_widget' => '<div id="%1$s" class="widget %2$s">',
			    'after_widget'  => '</div>',
			    'before_title'  => '<h3 class="widgettitle">',
			    'after_title'   => '</h3>'
		    ) );
		    register_sidebar( array(
			    'name'          => __( 'Footer 2', 'ibpix' ),
			    'id'            => 'footer-sidebar-2',
			    'description'   => '',
			    'class'         => '',
			    'before_widget' => '<div id="%1$s" class="widget %2$s">',
			    'after_widget'  => '</div>',
			    'before_title'  => '<h3 class="widgettitle">',
			    'after_title'   => '</h3>'
		    ) );
	    }

        // tags and cats for pages
        function add_taxonomies_to_pages() {
            register_taxonomy_for_object_type( 'post_tag', 'page' );
            //register_taxonomy_for_object_type( 'category', 'page' );
        }
        add_action( 'init', 'add_taxonomies_to_pages' );


        // Register Script
        function custom_scripts() {

            wp_register_script( 'plugins', get_template_directory_uri() . '/js/plugins.min.js', array( 'jquery' ), false, true );
            wp_enqueue_script( 'plugins' );

            wp_register_script( 'scripts', get_template_directory_uri() . '/js/script.min.js', array( 'plugins' ), false, true );
            wp_enqueue_script( 'scripts' );

        }
        add_action( 'wp_enqueue_scripts', 'custom_scripts' );

	    add_filter( 'embed_oembed_html', function ( $html ) {
		    return $html !== '' ? '<div class="video-wrapper"><div class="embed-container">' . $html . '</div></div>' : '';
	    } );

    }
endif; // ibpix_setup
add_action('after_setup_theme', 'ibpix_setup');

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since ibpix 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function ibpix_wp_title ($title, $sep) {
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo('name', 'display');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'ibpix'), max($paged, $page));
    }

    return $title;
}

add_filter('wp_title', 'ibpix_wp_title', 10, 2);


// change category widget output
add_filter('wp_list_categories', 'add_span_cat_count');
function add_span_cat_count($links) {
    $links = str_replace('</a> (', '</a> <span>', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

// enable svg uploads
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


// custom site settings page
if( function_exists('acf_add_options_page') ) {

    $option_page = acf_add_options_page(array(
        'page_title' 	=> 'Site instellingen',
        'menu_title' 	=> 'Site instellingen',
        'menu_slug' 	=> 'theme-general-settings',
        'capability' 	=> 'edit_posts',
        'redirect' 	=> false
    ));

}

// custom excerpt
function new_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

// exclude categories from loop
function exclude_widget_categories($args){
    $exclude = "1"; // The IDs of the excluding categories
    $args["exclude"] = $exclude;
    return $args;
}
add_filter("widget_categories_args","exclude_widget_categories");

//// enable ACF Google Maps api
//function my_acf_init() {
//
//    acf_update_setting('google_api_key', 'api_key');
//}
//
//add_action('acf/init', 'my_acf_init');

// Enable font size & font family selects in the editor
if ( ! function_exists( 'wpex_mce_buttons' ) ) {
    function wpex_mce_buttons( $buttons ) {
        array_unshift( $buttons, 'fontselect' ); // Add Font Select
        //array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
        return $buttons;
    }
}
add_filter( 'mce_buttons_3', 'wpex_mce_buttons' );

// Add custom Fonts to the Fonts list
if ( ! function_exists( 'wpex_mce_google_fonts_array' ) ) {
    function wpex_mce_google_fonts_array( $initArray ) {
        $initArray['font_formats'] = 'BebasNeuBook=bebas_neuebook,Helvetica Neue,Arial,sans-serif;BebasNeuBold=bebas_neuebold,Helvetica Neue,Arial,sans-serif;Roboto=Roboto,Helvetica Neue,Arial,sans-serif;';
        return $initArray;
    }
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_google_fonts_array' );

// Add Formats Dropdown Menu To MCE
if ( ! function_exists( 'wpex_style_select' ) ) {
    function wpex_style_select( $buttons ) {
        array_push( $buttons, 'styleselect' );
        return $buttons;
    }
}
add_filter( 'mce_buttons_3', 'wpex_style_select' );

// Add new styles to the TinyMCE "formats" menu dropdown
if ( ! function_exists( 'wpex_styles_dropdown' ) ) {
    function wpex_styles_dropdown( $settings ) {

        // Create array of new styles
        $new_styles = array(
            array(
                'title'	=> __( 'Tekst stijlen', 'ibpix' ),
                'items'	=> array(
                    array(
                        'title'		=> __('Titel','ibpix'),
                        'inline'	=> 'span',
                        'classes'	=> 'headingOne',
                    ),
                    array(
                        'title'		=> __('Inleiding','ibpix'),
                        'inline'	=> 'span',
                        'classes'	=> 'headingTwo',
                    ),
                    array(
                        'title'		=> __('Button','ibpix'),
                        'selector'	=> 'a',
                        'classes'	=> 'button',
                        'exact'     => true,
                    ),
                    array(
                        'title'		=> __('Button oranje','ibpix'),
                        'selector'	=> 'a',
                        'classes'	=> 'button btn-yellow',
                        'exact'     => true,
                    ),
                    array(
                        'title'		=> __('Download button','ibpix'),
                        'selector'	=> 'a',
                        'classes'	=> 'button btn-download',
                        'exact'     => true,
                    ),
                    array(
                        'title' => 'Tekst oranje',
                        'inline' => 'span',
                        'classes' => 'txt_color_orange',
                        'styles' => array(
                            'color'         => '#ed6c05', // or hex value #ff0000
                            // 'fontWeight'    => 'bold',
                            // 'textTransform' => 'uppercase'
                        )
                    ),
                    // array(
                    //     'title' => 'Geschreven tekst met pijltje',
                    //     'inline' => 'span',
                    //     'classes' => 'written_arrow',
                    //     'styles' => array(
                    //         'color'         => '#2db8c3', // or hex value #ff0000
                    //         // 'fontWeight'    => 'bold',
                    //         // 'textTransform' => 'uppercase'
                    //     )
                    // ),
                ),
            ),
        );

        // Merge old & new styles
        $settings['style_formats_merge'] = false;

        // Add new styles
        $settings['style_formats'] = json_encode( $new_styles );

        // Return New Settings
        return $settings;

    }
}
add_filter( 'tiny_mce_before_init', 'wpex_styles_dropdown' );

// Filter to hide protected posts
function exclude_protected($where) {
    global $wpdb;
    return $where .= " AND {$wpdb->posts}.post_password = '' ";
}

// Decide where to display them
function exclude_protected_action($query) {
    if( !is_single() && !is_page() && !is_admin() ) {
        add_filter( 'posts_where', 'exclude_protected' );
    }
}

// Action to queue the filter at the right time
add_action('pre_get_posts', 'exclude_protected_action');

function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "De inhoud van deze pagina is beveiligd met een wachtwoord.<br> Vul hieronder het wachtwoord in om de inhoud te kunnen bekijken." ) . '
    <p><label for="' . $label . '">' . __( "Wachtwoord " ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input class="button btn-yellow" type="submit" name="Submit" value="' . esc_attr__( "Inloggen" ) . '" />
    </p></form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );

/**
 * @var $roleObject WP_Role
 */
$roleObject = get_role( 'editor' );
if (!$roleObject->has_cap( 'edit_theme_options' ) ) {
    $roleObject->add_cap( 'edit_theme_options' );
}


add_action( 'pre_get_posts', function( \WP_Query $query ) {
	if( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		$meta_query = [
			'relation' => 'OR',
			[
				'key' =>  '_yoast_wpseo_meta-robots-noindex',
				'value' => '1',
				'compare' => '!=',
			],
			[
				'key' =>  '_yoast_wpseo_meta-robots-noindex',
				'value' => '',
				'compare' => 'NOT EXISTS',
			]
		];

		$query->set( 'meta_query', $meta_query );
	}

	return $query;
});