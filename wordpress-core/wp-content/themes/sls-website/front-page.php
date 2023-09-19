<?php
get_header();

get_template_part('/templates/homepage/hero');
get_template_part('/templates/homepage/about-us');
//get_template_part('/templates/homepage/latest-blog-posts');
get_template_part('/templates/homepage/services');
get_template_part('/templates/homepage/our-products');
get_template_part('/templates/homepage/management');
get_template_part('/templates/homepage/our-partners');
get_template_part('/templates/homepage/get-in-touch');

get_template_part('/templates/footer/footer', 'careers');

get_footer();
