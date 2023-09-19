<?php
/*
Template Name: Our Products
*/
get_header();
$title = get_the_title();
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
$products = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 15,
    'order' => 'DESC',
    'orderby' => 'post_date',
    'category_name' => DEFAULT_CATEGORY_WORKS
]);
?>

<section class="hero--page">
    <div class="hero__overlay">
        <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $title; ?>">
    </div>
    <div class="hero__content">
        <h1><?php echo $title; ?></h1>
    </div>
</section>

<section class="our-products--page parallax">
    <div class="section__header">
        <h2 class="heading-2--center"><?php _e('Products for Everyone', 'sls-website'); ?></h2>
        <p><?php _e('For our own products, we handle not only IT development tasks, but also marketing, customer service, and overall business development. We are actively looking for partners with whom we can further develop our products and launch them in new markets. Moreover, we are technically prepared to develop our own brands and brand them for you.', 'sls-website'); ?></p>
    </div>
    <div class="our-products__list">
        <?php while ($products->have_posts()) :
            $products->the_post();
            ?>

            <div class="our-products__list__item">
                <div class="our-products__list__item__content">
                    <h2 class="our-products__list__item__title"><?php echo esc_html(get_the_title()); ?></h2>
                    <p><?php echo get_the_excerpt(); ?></p>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="cta"><?php _e('View project', 'sls-website'); ?></a>
                </div>
                <div class="our-products__list__item__img parallax__single">
                    <img src="<?php echo get_image_source('floated_item_big'); ?>" alt="<?php echo get_image_alt(); ?>">
                </div>
            </div>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>

<?php
get_template_part('/templates/homepage/get-in-touch');
get_template_part('/templates/footer/footer', 'careers');
get_footer();
