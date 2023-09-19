<?php
$more_services = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'order' => 'DESC',
    'orderby' => 'post_date',
    'category_name' => DEFAULT_CATEGORY_SERVICES
]);
?>

<section class="featured__items parallax">
    <h2 class="heading-2--center"><?php _e('More Services', 'sls-website'); ?></h2>
    <div class="featured__items__wrap">
        <?php while ($more_services->have_posts()) :
            $more_services->the_post();
            $category = get_first_category();
            ?>

            <div class="featured__item parallax__item">
                <div class="featured__item__img">
                    <img src="<?php echo get_image_source('post_thumbnail'); ?>" alt="<?php echo get_image_alt(); ?>">
                </div>
                <div class="featured__item__content">
                    <span class="featured__item__content__category"><?php echo esc_html($category->name); ?></span>
                    <h3 class="featured__item__content__title"><?php echo esc_html(get_the_title()); ?></h3>
                    <p><?php echo get_the_excerpt(); ?></p>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="cta">
                        <?php _e('Read More', 'sls-website'); ?>
                    </a>
                </div>
            </div>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
