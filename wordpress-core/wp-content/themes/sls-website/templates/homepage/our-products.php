<?php
$products = new WP_Query([
'post_type' => 'post',
'posts_per_page' => 15,
'order' => 'DESC',
'orderby' => 'post_date',
'category_name' => DEFAULT_CATEGORY_WORKS
]);
?>

<section class="our-products parallax">
    <h2 class="heading-2--center"><?php _e('Our Products', 'sls-website'); ?></h2>
    <div class="our-products__wrap" id="our_products_slider">
        <?php while ($products->have_posts()) : ?>
            <?php $products->the_post(); ?>

            <div class="our-products__item parallax__item">
                <div class="our-products__img">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <img src="<?php echo get_image_source('floated_item'); ?>" alt="<?php echo get_image_alt(); ?>">
                    </a>
                </div>
                <div class="our-products__content">
                    <span class="our-products__content__category"><?php _e('work', 'sls-website'); ?></span>
                    <h3 class="our-products__content__title"><?php echo esc_html(get_the_title()); ?></h3>
                    <p><?php echo get_the_excerpt(); ?></p>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="cta"><?php _e('Read More', 'sls-website'); ?></a>
                </div>
            </div>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
