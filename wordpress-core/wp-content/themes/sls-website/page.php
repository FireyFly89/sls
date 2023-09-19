<?php
get_header();
the_post();
?>

    <?php if (!empty($image_id)) { ?>
        <section class="hero--article">
            <div class="hero__overlay">
                <img src="<?php echo get_image_source('homepage_billboard'); ?>" alt="<?php echo get_image_alt(); ?>">
            </div>
        </section>
    <?php } ?>

    <article <?php post_class('article'); ?> id="post-<?php the_ID(); ?>">
        <div class="article__header">
            <h1><?php echo esc_html(get_the_title()); ?></h1>
        </div>
        <?php the_content(); ?>
    </article>

<?php
get_template_part('/templates/homepage/get-in-touch');
get_template_part('/templates/footer/footer', 'careers');

get_footer();
