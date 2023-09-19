<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="<?php echo home_url($wp->request); ?>">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#222222">
    <meta name="theme-color" content="#111111">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <header class="header">
        <div class="header__wrap">
            <div class="header__logo">
                <a href="<?php echo home_url("/"); ?>">
                    <img src="<?php echo get_static_image("sls-logo.svg"); ?>" alt="svg" class="svg">
                </a>
            </div>
            <?php wp_nav_menu([
                'theme_location'    => 'header_section',
                'container_class'   => 'header__navigation',
                'menu'              => 'Header',
                'menu_class'        => 'header__navigation',
                'items_wrap'        => '<ul class="header__navigation__list" id="%1$s" class="%2$s">%3$s</ul>',

            ]); ?>
            <button class="header__navigation__button">
                <span></span><span></span><span></span>
            </button>
        </div>
    </header>
