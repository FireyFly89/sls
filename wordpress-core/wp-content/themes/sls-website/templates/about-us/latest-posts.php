<?php
$posts = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'order' => 'DESC',
    'orderby' => 'post_date',
    'category_name' => DEFAULT_CATEGORY_BLOG,
]);
?>

<section class="blog--page pb-0">
    <h2 class="heading-2--center"><?php _e('Latest Blog Posts', 'sls-website'); ?></h2>
    <div class="blog__list">
        <?php while ($posts->have_posts()) :
            $posts->the_post();
            $category = get_first_category();
            ?>

            <div class="blog__item">
                <div class="blog__img">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <img src="<?php echo get_image_source('post_thumbnail'); ?>" alt="<?php echo get_image_alt(); ?>">
                    </a>
                </div>
                <div class="blog__content">
                    <a class="blog__category" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                        <?php echo esc_html($category->name); ?>
                    </a>
                    <h3><?php echo esc_html(get_the_title()); ?></h3>
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
