<?php
/*
Template Name: Contact
*/
$title = get_the_title();
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
get_header(); ?>

<section class="hero--page">
    <div class="hero__overlay">
        <img class="bottom" src="<?php echo $featured_img_url; ?>" alt="<?php echo $title; ?>">
    </div>
    <div class="hero__content">
        <h1><?php echo $title; ?></h1>
    </div>
</section>

<section class="contact">
    <div class="contact__wrap">
        <div class="contact__content">
            <h2><?php _e('We will get in touch with you!', 'sls-website'); ?></h2>
            <h4><?php _e('SLS Hungary BT. <br /> Révay Street 6, Budapest 1065, Hungary', 'sls-website'); ?></h4>
            <h4><?php _e('SLS IT Services KFT. <br /> Pauler Street 6, Budapest 1013, Hungary', 'sls-website'); ?></h4>
            <h4><?php _e('SLS Service Center SRL <br /> Strada Buzesti 50, Bucharest 011015, Romania', 'sls-website'); ?></h4>
            <p><a href="mailto:info@slshungary.com"><?php _e('info@slshungary.com', 'sls-website'); ?></a></p>
        </div>
        <div class="contact__form">
            <p><?php _e('Fill out the form to submit your message.', 'sls-website'); ?></p>
            <?php echo do_shortcode('[contact-form-7 id="38" title="Contact"]'); ?>
        </div>
    </div>
</section>

<?php
get_template_part('/templates/footer/footer', 'works');

get_footer();
