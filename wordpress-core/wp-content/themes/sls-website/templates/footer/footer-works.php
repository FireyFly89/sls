<footer class="footer">
    <div class="footer__wrap">
        <div class="footer__content">
            <h2><?php _e("Let us show you our work!", 'sls-website'); ?></h2>
            <p><?php _e('Get to know more about SLS Synergy Group!', 'sls-website'); ?></p>
            <a href="<?php echo home_url('/our-products'); ?>" class="cta"><?php _e('Works', 'sls-website'); ?></a>
        </div>
        <div class="footer__navigation">
            <?php wp_nav_menu([
                'theme_location'    => 'header_section',
                'container_class'   => 'footer__navigation',
                'menu'              => 'Header',
                'menu_class'        => 'footer__navigation',
                'items_wrap'        => '<ul class="footer__navigation__list" id="%1$s" class="%2$s">%3$s</ul>',

            ]); ?>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="footer__bottom__wrap">
            <?php wp_nav_menu([
                'theme_location'    => 'footer_section',
                'container_class'   => 'footer__bottom__navigation',
                'menu'              => 'Header',
                'menu_class'        => 'footer__bottom__navigation',
                'items_wrap'        => '<ul class="footer__bottom__navigation__list" id="%1$s" class="%2$s">%3$s</ul>',

            ]); ?>
            <div class="footer__social-links">
                <a href="https://www.linkedin.com/company/slssynergygroup" target="_blank" rel="nofollow">
                    <img src="<?php echo get_static_image('linkedin.svg'); ?>" alt="linkedin" class="svg">
                </a>
                <a href="https://www.facebook.com/slssynergygroup" target="_blank" rel="nofollow">
                    <img src="<?php echo get_static_image('facebook.svg'); ?>" alt="facebook" class="svg">
                </a>
            </div>
        </div>
    </div>
</footer>
