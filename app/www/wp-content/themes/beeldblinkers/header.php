<!doctype html>
<html lang="nl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml">
    <link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png"/>
    <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.97074.js"></script>
    <?php wp_head(); ?>

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function(){
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#ed6c05",
                        "text": "#ffffff"
                    },
                    "button": {
                        "background": "#ffffff",
                        "text": "#000000"
                    }
                },
                "content": {
                    "message": "Deze website gebruikt cookies, zodat je een betere ervaring op deze site hebt.",
                    "dismiss": "Ok!",
                    "link": "Lees meer",
                    "href": "https://www.waarkaniknaardewc.nl/privacyverklaring/"
                }
            })});
    </script>
</head>
<noscript><style>.site__header {transform: translate(0px,0px) !Important;}</style></noscript>
<body <?php body_class(); ?>>

<header class="site__header">
    <div class="inner">
        <a href="<?php echo esc_url(get_home_url()); ?>" class="logo" title="waarkaniknaardewc.nl"></a>
        <nav class="nav__main" role="navigation">
            <?php wp_nav_menu(array ('theme_location' => 'primary', 'container' => false)); ?>
            <button class="open_search"><span>Zoeken</span></button>
            <div class="main_nav_search">
                <?php get_search_form(); ?>
            </div>
        </nav>
    </div>
</header>

<a class="open_nav"><span>Menu openen</span><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
<a class="close_nav"><span>Menu sluiten</span><i class="fa fa-close fa-2x" aria-hidden="true"></i></a>

<?php
if(!is_front_page()) {
    get_template_part('content', 'header');
}
?>