<?php
/*
Template Name: Streaming Systems
*/
$title = get_the_title();
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
get_header(); ?>

    <section class="hero--page">
        <div class="hero__overlay">
            <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $title; ?>">
        </div>
        <div class="hero__content">
            <h1><?php echo get_the_title(); ?></h1>
            <a href="<?php echo home_url("/services"); ?>" class="btn--black hero__content__back"><?php _e('Back to all services', 'sls-website'); ?></a>
        </div>
    </section>

    <main class="streaming-systems">
        <div class="streaming-systems__header">
            <h2 class="heading-2--center"><?php echo get_the_title(); ?></h2>
            <?php echo get_the_content(); ?>
        </div>

        <?php
            get_template_part('/templates/streaming-systems/questions');
            get_template_part('/templates/streaming-systems/options');
            get_template_part('/templates/streaming-systems/details');
            get_template_part('/templates/streaming-systems/case-study');
            get_template_part('/templates/streaming-systems/specialists');
            get_template_part('/templates/streaming-systems/more-services');
        ?>
    </main>

<?php

get_template_part('/templates/homepage/get-in-touch');

get_template_part('/templates/footer/footer', 'careers');

get_footer();
