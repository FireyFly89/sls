<?php
get_header();
$title = get_the_title();
$posts = get_latest_posts(15, [
    'category_name' => get_first_category('slug'),
    'paged' => get_current_page_number(),
]);
?>
<section class="hero--blog">
    <div class="hero__content">
        <h1><?php echo $title; ?></h1>
        <nav class="hero__navigation">
            <ul class="hero__navigation__list">
                <?php get_category_links_maybe_pages(); ?>
            </ul>
        </nav>
    </div>
</section>

<section class="blog--page">
    <div class="blog__list">
        <?php while ($posts->have_posts()) :
            $posts->the_post();
            $post_excerpt = get_the_excerpt();
//            $category = get_first_category();
            ?>

            <div class="blog__item">
                <div class="blog__img">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <img src="<?php echo get_image_source('post_thumbnail'); ?>" alt="<?php echo get_image_alt(); ?>">
                    </a>
                </div>
                <div class="blog__content">
<!--                    --><?php //if (!empty($category)) : ?>
<!--                        <a class="blog__category" href="--><?php //echo esc_url(get_category_link($category->term_id)); ?><!--">-->
<!--                            --><?php //echo esc_html($category->name); ?>
<!--                        </a>-->
<!--                    --><?php //endif; ?>

                    <h3><?php echo esc_html(get_the_title()); ?></h3>
                    <p><?php echo $post_excerpt; ?></p>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="cta">
                        <?php _e('Read More', 'sls-website'); ?>
                    </a>
                </div>
            </div>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>

    <?php get_pagination($posts); ?>
</section>
<?php
get_template_part('/templates/homepage/get-in-touch');
get_template_part('/templates/footer/footer', 'careers');
get_footer();
