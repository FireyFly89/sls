<?php $posts = get_latest_posts(3); ?>

<section class="about-us parallax">
    <h2 class="heading-2--center"><?php _e('About Us', 'sls-website'); ?></h2>
    <div class="about-us__wrap">
        <div class="about-us__item parallax__item">
            <div class="about-us__item__title"><?php _e('What does the SLS do?', 'sls-website'); ?></div>
            <div class="about-us__item__cta">
                <a href="<?php echo home_url('/about-us'); ?>" class="cta"><?php _e('About us', 'sls-website'); ?></a>
            </div>
        </div>
        <div class="about-us__item parallax__item">
            <div class="about-us__item__title">3</div>
            <div class="about-us__item__text"><?php _e('companies in three countries', 'sls-website'); ?></div>
        </div>
        <div class="about-us__item parallax__item">
            <div class="about-us__item__title">124.500</div>
            <div class="about-us__item__text"><?php _e('miles flown last year to meet our partners', 'sls-website'); ?></div>
        </div>
        <div class="about-us__item parallax__item">
            <div class="about-us__item__title">168</div>
            <div class="about-us__item__text"><?php _e('hours a week business and tech support', 'sls-website'); ?></div>
        </div>
        <div class="about-us__item parallax__item">
            <div class="about-us__item__title">85%</div>
            <div class="about-us__item__text"><?php _e('of our team are Netflix fans', 'sls-website'); ?></div>
        </div>

        <?php while ($posts->have_posts()) :
            $posts->the_post();
            $category = get_first_category();
            ?>

            <div class="about-us__item parallax__item">
                <div class="about-us__item__category">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                        <?php echo esc_html($category->name); ?>
                    </a>
                </div>
                <div class="about-us__item__text">
                    <?php echo esc_html(get_the_title()); ?>
                </div>
                <div class="about-us__item__content">
                    <?php echo esc_html(get_the_excerpt()); ?>
                </div>
                <div class="about-us__item__cta">
                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="cta">
                        <?php _e('Read More', 'sls-website'); ?>
                    </a>
                </div>
            </div>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
