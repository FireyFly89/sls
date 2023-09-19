<?php
/*
Template Name: Careers
*/
$title = get_the_title();
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
get_header();
?>

<section class="hero--page">
    <div class="hero__overlay">
        <img class="bottom" src="<?php echo $featured_img_url; ?>" alt="<?php echo $title; ?>">
    </div>
    <div class="hero__content">
        <h1><?php echo $title; ?></h1>
    </div>
</section>

<section class="careers">
    <?php
    get_template_part('/templates/careers/hiring-process');
    get_template_part('/templates/careers/positions');
    get_template_part('/templates/careers/how-work'); ?>
</section>

<?php
get_template_part('/templates/homepage/get-in-touch');

get_template_part('/templates/footer/footer', 'careers');

get_footer();
