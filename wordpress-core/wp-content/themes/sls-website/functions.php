<?php
set_time_limit(60);
date_default_timezone_set("Europe/Budapest");
const SLS_THEME_VERSION = "0.1.0";
const DEFAULT_CATEGORY_SERVICES = 'services';
const DEFAULT_CATEGORY_WORKS = 'works';
const DEFAULT_CATEGORY_BLOG = 'blog';
const DEFAULT_CATEGORY_POSITIONS = 'positions';

const NEW_IMAGE_SIZES = [
    'page_top_stripe' => [ // Top full-width, but small height image on page top
        'width' => 1905,
        'height' => 240,
        'mobile_res' => '100vw',
        'positioning' => ['center', 'center']
    ],
    'homepage_billboard' => [ // Homepage billboard image on the top
        'width' => 1905,
        'height' => 512,
        'mobile_res' => '100vw',
        'positioning' => ['center', 'center']
    ],
    'floated_item' => [ // Example: Services on homepage
        'width' => 442,
        'height' => 440,
        'mobile_res' => '90vw',
        'positioning' => ['center', 'center']
    ],
    'floated_item_big' => [ // Example: Our products page
        'width' => 607,
        'height' => 440,
        'mobile_res' => '90vw',
        'positioning' => ['center', 'center']
    ],
    'post_thumbnail' => [ // Example: Our products on homepage
        'width' => 350,
        'height' => 240,
        'mobile_res' => '90vw',
        'positioning' => ['center', 'center']
    ],
    'profile_pictures' => [ // Example: Our products on homepage
        'width' => 355,
        'height' => 350,
        'mobile_res' => '90vw',
        'positioning' => ['center', 'center']
    ],
];

add_action('after_setup_theme', function () {
    foreach (NEW_IMAGE_SIZES as $size_id => $data) {
        $cropPositioning = ['left', 'top'];

        if (array_key_exists('positioning', $data)) {
            $cropPositioning = $data['positioning'];
        }

        if (array_key_exists('width', $data) && array_key_exists('height', $data)) {
            add_image_size($size_id, $data['width'], $data['height'], $cropPositioning);
        }
    }
});

add_filter('wp_calculate_image_sizes', function ($sizes, $size) {
    foreach (NEW_IMAGE_SIZES as $size_id => $data) {
        if (array_key_exists('width', $data) && array_key_exists('height', $data) && array_key_exists('mobile_res', $data) && $size[0] === $data['width']) {
            $sizes = '(min-width: 1200px) ' . $data['width'] . 'px, ' . $data['mobile_res'];
        }
    }
    return $sizes;
}, 10, 2);

if (!class_exists('ArticleStorage')) {
    require get_template_directory() . '/includes/ArticleStorage.php';
}

function load_scripts()
{
    $main_styles_handle_pretag = 'main-styles';
    $main_scripts_handle_pretag = 'main-scripts';

    // Load main stylesheet
    wp_enqueue_style($main_styles_handle_pretag, get_stylesheet_uri(), [], SLS_THEME_VERSION);
    wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');

    wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], false, true);
    wp_enqueue_script($main_scripts_handle_pretag, (get_template_directory_uri() . '/assets/scripts/main.js'), ['jquery', 'slick-js'], SLS_THEME_VERSION, true);

    // Localize useful variables, making them avaialable in javascript file (by handle name)
    wp_localize_script($main_scripts_handle_pretag, 'resolutions', [
        'hd' => 1600,
        'hdReady' => 1366,
        'large' => 1200,
        'medium' => 992,
        'small' => 768,
        'extraSmall' => 480,
        'old' => 375,
    ]);
}

add_action('wp_enqueue_scripts', 'load_scripts');

// Set-up the theme
function theme_supports()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('post-formats');

    register_nav_menus([
        'header_section' => __('Header section'),
        'footer_section' => __('Footer section'),
    ]);
}

add_action('after_setup_theme', 'theme_supports');

// Utility function to dump more readable data
function pre_dump($data)
{
    echo "<pre style='position: relative;'>";
    var_dump($data);
    echo "</pre>";
}

// Retrieves a static image from custom asset path
function get_static_image($image_name)
{
    return get_template_directory_uri() . "/assets/images/" . $image_name;
}

function custom_pagination($max_page, $type = 'array', $prev_text = '<button class="pagination__button--prev"></button>', $next_text = '<button class="pagination__button--next"></button>')
{
    $high_num = 999999999;

    return paginate_links([
        'base' => str_replace($high_num, '%#%', esc_url(get_pagenum_link($high_num))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $max_page,
        'mid_size' => 1,
        'prev_text' => $prev_text,
        'next_text' => $next_text,
        'type' => $type
    ]);
}

add_filter('excerpt_length', function ($length) {
    return 15;
}, 999);

function get_latest_posts($number_of_posts, $extra_filters = [])
{
    return ArticleStorage::get_instance()->get_posts([
            'post_type' => 'post',
            'order' => 'DESC',
            'orderby' => 'post_date',
            'posts_per_page' => $number_of_posts
        ] + $extra_filters);
}

function is_blog_post()
{
    $post_categories = get_the_category();

    foreach ($post_categories as $category) {
        if ($category->slug === DEFAULT_CATEGORY_BLOG) {
            return true;
        }
    }

    return false;
}

function get_current_page_number()
{
    $paged = get_query_var("paged");
    return !empty($paged) ? $paged : 0;
}

function is_category_exists($categories, $reference)
{
    if (empty($categories) || empty($reference)) {
        return false;
    }

    foreach ($categories as $category) {
        if ($category->slug === $reference) {
            return true;
        }
    }

    return false;
}

// Post global object must be set!
function get_first_category($parameter = null)
{
    if (empty($categories = get_the_category())) {
        return false;
    }

    foreach ($categories as $category) {
        if (!empty($parameter) && property_exists($category, $parameter) && !empty($category->{$parameter})) {
            return $category->{$parameter};
        }

        return $category;
    }

    return "";
}

function get_category_url($category)
{
    $category_url = get_category_link($category->term_id);

    if ($category->slug === DEFAULT_CATEGORY_BLOG) {
        $category_url = get_page_template_url(DEFAULT_CATEGORY_BLOG);
    }

    return esc_url($category_url);
}

// Post global object must be set!
function get_category_links_maybe_pages($posts = null, $exceptions = [])
{
    $categories_output = [];

    if (!empty($posts)) {
        while ($posts->have_posts()) {
            $posts->the_post();
            output_categories($categories_output, $exceptions);
        }

        wp_reset_postdata();
        return true;
    }

    output_categories($categories_output, $exceptions);
    return true;
}

// Post global object must be set, or wrapper function "get_category_links_maybe_pages"
function output_categories(&$categories_output = [], $exceptions)
{
    $categories = get_the_category();

    foreach ($categories as $category) {
        if (!in_array($category->slug, $categories_output) && !in_array($category->slug, $exceptions)) {
            echo '<li><a href="' . get_category_url($category) . '">' . $category->name . '</a></li>';
            $categories_output[] = $category->slug;
        }
    }
}

// Post global object must be set!
function get_image_source($size = 'source')
{
    $image_id = get_post_thumbnail_id(get_the_ID());

    if (!empty($image_id)) {
        return esc_url(wp_get_attachment_image_url($image_id, $size));
    }

    return "";
}

// Post global object must be set!
function get_image_alt()
{
    $image_id = get_post_thumbnail_id(get_the_ID());
    return esc_attr(get_the_title($image_id));
}

function get_page_template_url($template)
{
    if (!is_page_template_exists($template)) {
        return false;
    }

    if (empty($page_data = get_page_data_by_slug($template))) {
        return false;
    }

    return get_page_link($page_data->ID);
}

function is_page_template_exists($reference)
{
    $templates = wp_get_theme()->get_page_templates();

    foreach ($templates as $template) {
        if (strtolower($template) === $reference) {
            return true;
        }
    }

    return false;
}

function get_page_data_by_slug($slug)
{
    $pages = new WP_Query([
        'post_type' => 'page',
        'pagename' => $slug,
    ]);

    if (empty($pages)) {
        return false;
    }

    if (property_exists($pages, 'posts') && !empty($pages->posts)) {
        return $pages->posts[0];
    }

    return false;
}

function get_pagination($posts)
{
    $pagination = custom_pagination($posts->max_num_pages);

    if (empty($pagination)) {
        return false;
    }

    echo '<div class="pagination">';

    foreach ($pagination as $page) {
        echo $page;
    }

    echo '</div>';
}

function get_category_dependent_content($categories, $reference, $options = [])
{
    if (is_category_exists($categories, $reference) && array_key_exists('category_exists', $options)) {
        foreach ($options['category_exists'] as $template_name => $template_path) {
            get_template_part($template_path, $template_name);
        }

        return true;
    }

    foreach ($options['category_exists_not'] as $template_name => $template_path) {
        get_template_part($template_path, $template_name);
    }

    return true;
}
