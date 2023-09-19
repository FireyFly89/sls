<?php
$services = new WP_Query([
    'post_type' => 'post',
    'order' => 'DESC',
    'orderby' => 'post_date',
    'category_name' => DEFAULT_CATEGORY_SERVICES
]);
?>
<section class="services--page parallax">
    <?php while ($services->have_posts()) :
        $services->the_post();
        $category = get_first_category();
        ?>

        <div class="services__item">
            <div class="services__content">
                <span class="services__item__category">
                    <?php echo esc_html($category->name); ?>
                </span>
                <h2 class="services__item__title"><?php echo esc_html(get_the_title()); ?></h2>
                <p><?php echo get_the_excerpt(); ?></p>
                <a href="<?php echo esc_url(get_permalink()); ?>" class="cta">
                    <?php _e('Read More', 'sls-website'); ?>
                </a>
            </div>
            <div class="services__item__img parallax__single">
                <img src="<?php echo get_image_source('floated_item'); ?>" alt="<?php echo get_image_alt(); ?>">
            </div>
        </div>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</section>
