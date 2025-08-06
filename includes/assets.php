<?php
add_action('wp_enqueue_scripts', function () {
    $base = plugin_dir_url(__FILE__) . '../assets/';
    $version = '1.0'; // Or use filemtime() or random for dev
    

    wp_register_script(
        'faq-accordion-init',
        $base . 'js/faq-accordion.js',
        [ 'jquery'],
        $version,
        true
    );

    wp_register_style(
        'slick-carousel-css',
        $base . 'css/slick.css',
        [],
        $version
    );

    wp_register_script(
        'slick-carousel-js',
        $base . 'js/slick.min.js',
        [ 'jquery' ],
        $version,
        true
    );

    wp_register_script(
        'testimonial-carousel-init',
        $base . 'js/testimonial-carousel.js',
        [ 'jquery', 'slick-carousel-js' ],
        $version,
        true
    );

    wp_register_style(
        'esmond-elementor-menu-css',
        $base . 'css/elementor.css',
        [],
        $version
    );

    wp_register_style(
        'newsletter-signup-style',
        $base  . 'css/newsletter-signup.css',
        [],
        '1.0'
    );

    wp_register_script(
        'newsletter-signup-init',
        $base . 'js/newsletter-signup.js',
        [ 'jquery' ],
        '1.0',
        true
    );

    wp_localize_script('newsletter-signup-init', 'newsletterAjax', [
        'ajaxurl' => admin_url('admin-ajax.php')
    ]);

    
});