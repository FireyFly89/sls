<?php
get_header();
the_post();
$image_id = get_post_thumbnail_id(get_the_ID());
$featured_img_url = "";
$post_categories = get_the_category();

if (!empty($image_id)) {
    $featured_img_url = wp_get_attachment_image_url($image_id, 'homepage_billboard');
}
?>

<section class="hero--article">
    <div class="hero__overlay">
        <img src="<?php echo esc_url($featured_img_url); ?>" alt="<?php echo esc_attr(get_the_title($image_id)); ?>">
    </div>
    <div class="hero__content">
        <?php if (is_blog_post()) : ?>
            <a href="<?php echo home_url("/blog"); ?>" class="btn--black"><?php _e('Back to all Blog post', 'sls-website'); ?></a>
        <?php endif; ?>
        <?php if (is_category_exists($post_categories, DEFAULT_CATEGORY_POSITIONS)) : ?>
            <a href="<?php echo home_url("/careers"); ?>" class="btn--black"><?php _e('Back to Careers', 'sls-website'); ?></a>
        <?php endif; ?>
    </div>
</section>

<article <?php post_class('article'); ?> id="post-<?php the_ID(); ?>">
    <div class="article__header">
        <h1><?php echo esc_html(get_the_title()); ?></h1>

        <?php if (is_category_exists($post_categories, DEFAULT_CATEGORY_POSITIONS)) : ?>
            <a href="#applyForm" class="btn--primary"><?php _e('Apply Job', 'sls-website'); ?></a>
        <?php endif; ?>
    </div>
    <?php the_content(); ?>
</article>

<section class="featured__items parallax">
    <?php if (is_blog_post()) : ?>
        <h2 class="heading-2--center"><?php _e('More Blog Posts', 'sls-website'); ?></h2>
    <?php endif; ?>

    <?php if (is_category_exists($post_categories, DEFAULT_CATEGORY_POSITIONS)) : ?>
        <h2 class="heading-2--center"><?php _e('More Open Positions', 'sls-website'); ?></h2>
    <?php endif; ?>

    <div class="featured__items__wrap">
        <?php
        $query_category = ['category_name' => DEFAULT_CATEGORY_BLOG];

        if (is_category_exists($post_categories, DEFAULT_CATEGORY_POSITIONS)) {
            $query_category = ['category_name' => DEFAULT_CATEGORY_POSITIONS];
        }

        if (!empty($post_categories)) {
            $query_category = $query_category + ['cat' => $post_categories[0]->cat_ID];
        }

        $posts = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 3,
                'order' => 'DESC',
                'orderby' => 'post_date',
                'post__not_in' => [get_the_ID()],
            ] + $query_category);

        while ($posts->have_posts()) :
            $posts->the_post();
            $category = get_first_category();
            ?>

            <div class="featured__item parallax__item">
                <div class="featured__item__img">
                    <img src="<?php echo get_image_source('post_thumbnail'); ?>" alt="<?php echo get_image_alt(); ?>">
                </div>
                <div class="featured__item__content">
                    <a class="featured__item__content__category" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                        <?php echo esc_html($category->name); ?>
                    </a>
                    <h3 class="featured__item__content__title">
                        <?php echo esc_html(get_the_title()); ?>
                    </h3>
                    <p><?php echo esc_html(get_the_excerpt()); ?></p>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="cta"><?php _e('Read More', 'sls-website'); ?></a>
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

        <?php if (is_blog_post()) : ?>
            <a href="<?php echo home_url("/blog"); ?>" class="btn--primary parallax__item"><?php _e('Back to all blog post', 'sls-website'); ?></a>
        <?php endif; ?>

        <?php if (is_category_exists($post_categories, DEFAULT_CATEGORY_POSITIONS)) : ?>
            <a href="<?php echo home_url("/careers"); ?>" class="btn--primary parallax__item"><?php _e('Back to Careers', 'sls-website'); ?></a>
        <?php endif; ?>
    </div>
</section>

<?php if (is_category_exists($post_categories, DEFAULT_CATEGORY_POSITIONS)) : ?>
    <!-- Ez csak Apply oldalon van -->
    <section class="contact">
        <div class="contact__wrap">
            <div class="contact__content">
                <h2><?php _e('We will get in touch with you!', 'sls-website'); ?></h2>
                <h4><?php _e('SLS Hungary BT. <br /> Révay Street 6, Budapest 1065, Hungary', 'sls-website'); ?></h4>
                <h4><?php _e('SLS IT Services KFT. <br /> Pauler Street 6, Budapest 1013, Hungary', 'sls-website'); ?></h4>
                <h4><?php _e('SLS Service Center SRL <br /> Strada Buzesti 50, Bucharest 011015, Romania', 'sls-website'); ?></h4>
                <p><a href="mailto:info@slshungary.com"><?php _e('info@slshungary.com', 'sls-website'); ?></a></p>
            </div>
            <div class="contact__form" id="applyForm">
                <p><?php _e('Fill out the form to submit your message.', 'sls-website'); ?></p>
                <?php echo do_shortcode('[contact-form-7 id="59" title="Apply"]'); ?>
            </div>
        </div>
    </section>
<?php endif;

get_category_dependent_content($post_categories, DEFAULT_CATEGORY_POSITIONS, [
    'category_exists' => [
        'apply' => '/templates/footer/footer'
    ],
    'category_exists_not' => [
        'get-in-touch' => '/templates/homepage',
        'careers' => '/templates/footer/footer',
    ]
]);

get_footer();
