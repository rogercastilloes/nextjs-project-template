<?php
/**
 * Katie Bray Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function katie_bray_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'katie-bray'),
    ));

    // Add theme support for Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'katie_bray_setup');

/**
 * Include custom post types
 */
require_once get_template_directory() . '/includes/custom-post-types.php';

/**
 * Enqueue scripts and styles
 */
function katie_bray_enqueue_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap',
        array(),
        null
    );

    // Enqueue Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css',
        array(),
        '6.0.0-beta3'
    );

    // Enqueue Tailwind CSS
    wp_enqueue_style(
        'tailwind',
        'https://cdn.tailwindcss.com',
        array(),
        null
    );

    // Enqueue theme's main stylesheet
    wp_enqueue_style(
        'katie-bray-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );

    // Enqueue custom JavaScript
    wp_enqueue_script(
        'katie-bray-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'katie_bray_enqueue_scripts');

/**
 * Handle contact form submission
 */
function katie_bray_handle_contact_form() {
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form_submit')) {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer()));
        exit;
    }

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer()));
        exit;
    }

    $to = get_option('admin_email');
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );

    $email_content = sprintf(
        'Name: %s<br>Email: %s<br>Subject: %s<br><br>Message:<br>%s',
        esc_html($name),
        esc_html($email),
        esc_html($subject),
        nl2br(esc_html($message))
    );

    $mail_sent = wp_mail($to, $subject, $email_content, $headers);

    if ($mail_sent) {
        wp_redirect(add_query_arg('status', 'success', wp_get_referer()));
    } else {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer()));
    }
    exit;
}
add_action('admin_post_contact_form_submit', 'katie_bray_handle_contact_form');
add_action('admin_post_nopriv_contact_form_submit', 'katie_bray_handle_contact_form');

/**
 * Add custom classes to navigation menu items
 */
function katie_bray_nav_menu_css_class($classes, $item) {
    $classes[] = 'nav-link text-sm uppercase tracking-wider';
    if ($item->current) {
        $classes[] = 'text-accent font-medium';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'katie_bray_nav_menu_css_class', 10, 2);

/**
 * Add container-custom class to content wrapper
 */
function katie_bray_content_class() {
    return 'container-custom px-4 mx-auto max-w-7xl';
}
