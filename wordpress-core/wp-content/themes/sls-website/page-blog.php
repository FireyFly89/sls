<?php
/*
Template Name: Blog
*/
get_header();
$title = get_the_title();
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
$posts = get_latest_posts(15, [
    'category_name' => DEFAULT_CATEGORY_BLOG,
    'paged' => get_current_page_number(),
]);
?>

<section class="hero--blog">
    <div class="hero__overlay">
        <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $title; ?>">
    </div>
    <div class="hero__content">
        <h1><?php echo $title; ?></h1>
        <nav class="hero__navigation">
            <ul class="hero__navigation__list">
                <?php get_category_links_maybe_pages($posts, ['blog']); ?>
            </ul>
        </nav>
    </div>
</section>

<section class="blog--page">
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
                    <a class="blog__category" href="<?php echo get_category_url($category); ?>">
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

    <?php get_pagination($posts); ?>
</section>

<?php
get_template_part('/templates/homepage/get-in-touch');
get_template_part('/templates/footer/footer', 'careers');
get_footer();
