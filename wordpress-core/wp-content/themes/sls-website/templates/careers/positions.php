<?php
$positions = new WP_Query([
    'post_type' => 'post',
    'order' => 'DESC',
    'orderby' => 'post_date',
    'category_name' => DEFAULT_CATEGORY_POSITIONS
]);
?>
<div class="careers__positions parallax">
    <h2 class="heading-2--center"><?php _e('Open Positions', 'sls-website'); ?></h2>
    <div class="careers__positions__wrap">
        <?php while ($positions->have_posts()) : ?>
            <?php $positions->the_post(); ?>

            <div class="careers__positions__item">
                <div class="careers__positions__content">
                    <span class="careers__positions__location">
                        <?php
                        $country = get_post_meta(get_the_ID(), 'Country', true);
                        $city = get_post_meta(get_the_ID(), 'City', true);
                        if (!empty($country) && !empty($city)) : echo "$country, $city"; endif;
                        ?>
                    </span>
                    <h2 class="careers__positions__title">
                        <?php echo esc_html(get_the_title()); ?>
                    </h2>
                    <p><?php echo wp_trim_words( get_the_content(), 60 ); ?></p>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="cta"><?php _e('Apply', 'sls-website'); ?></a>
                </div>
                <div class="careers__positions__img parallax__single">
                    <img src="<?php echo get_image_source('floated_item'); ?>" alt="<?php echo get_image_alt(); ?>">
                </div>
            </div>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>
