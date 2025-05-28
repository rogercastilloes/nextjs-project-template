<?php
/**
 * Register Custom Post Types
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Register Workshop Custom Post Type and its taxonomies
 */
function katie_bray_register_workshop_post_type() {
    $labels = array(
        'name'               => _x('Workshops', 'post type general name', 'katie-bray'),
        'singular_name'      => _x('Workshop', 'post type singular name', 'katie-bray'),
        'menu_name'          => _x('Workshops', 'admin menu', 'katie-bray'),
        'name_admin_bar'     => _x('Workshop', 'add new on admin bar', 'katie-bray'),
        'add_new'           => _x('Add New', 'workshop', 'katie-bray'),
        'add_new_item'      => __('Add New Workshop', 'katie-bray'),
        'new_item'          => __('New Workshop', 'katie-bray'),
        'edit_item'         => __('Edit Workshop', 'katie-bray'),
        'view_item'         => __('View Workshop', 'katie-bray'),
        'all_items'         => __('All Workshops', 'katie-bray'),
        'search_items'      => __('Search Workshops', 'katie-bray'),
        'parent_item_colon' => __('Parent Workshops:', 'katie-bray'),
        'not_found'         => __('No workshops found.', 'katie-bray'),
        'not_found_in_trash'=> __('No workshops found in Trash.', 'katie-bray')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'workshops'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('workshop', $args);

    // Register Workshop Category Taxonomy
    register_taxonomy('workshop_category', 'workshop', array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => _x('Workshop Categories', 'taxonomy general name', 'katie-bray'),
            'singular_name'     => _x('Workshop Category', 'taxonomy singular name', 'katie-bray'),
            'search_items'      => __('Search Workshop Categories', 'katie-bray'),
            'all_items'         => __('All Workshop Categories', 'katie-bray'),
            'parent_item'       => __('Parent Workshop Category', 'katie-bray'),
            'parent_item_colon' => __('Parent Workshop Category:', 'katie-bray'),
            'edit_item'         => __('Edit Workshop Category', 'katie-bray'),
            'update_item'       => __('Update Workshop Category', 'katie-bray'),
            'add_new_item'      => __('Add New Workshop Category', 'katie-bray'),
            'new_item_name'     => __('New Workshop Category Name', 'katie-bray'),
            'menu_name'         => __('Categories', 'katie-bray'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'workshop-category'),
        'show_in_rest'      => true,
    ));

    // Register Workshop Level Taxonomy
    register_taxonomy('workshop_level', 'workshop', array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'              => _x('Workshop Levels', 'taxonomy general name', 'katie-bray'),
            'singular_name'     => _x('Workshop Level', 'taxonomy singular name', 'katie-bray'),
            'search_items'      => __('Search Workshop Levels', 'katie-bray'),
            'all_items'         => __('All Workshop Levels', 'katie-bray'),
            'edit_item'         => __('Edit Workshop Level', 'katie-bray'),
            'update_item'       => __('Update Workshop Level', 'katie-bray'),
            'add_new_item'      => __('Add New Workshop Level', 'katie-bray'),
            'new_item_name'     => __('New Workshop Level Name', 'katie-bray'),
            'menu_name'         => __('Levels', 'katie-bray'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'workshop-level'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'katie_bray_register_workshop_post_type');

/**
 * Add custom meta boxes for Workshop post type
 */
function katie_bray_add_workshop_meta_boxes() {
    add_meta_box(
        'workshop_details',
        __('Workshop Details', 'katie-bray'),
        'katie_bray_workshop_details_callback',
        'workshop',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'katie_bray_add_workshop_meta_boxes');

/**
 * Workshop details meta box callback
 */
function katie_bray_workshop_details_callback($post) {
    wp_nonce_field('workshop_details_nonce', 'workshop_details_nonce');
    
    $workshop_date = get_post_meta($post->ID, 'workshop_date', true);
    $workshop_duration = get_post_meta($post->ID, 'workshop_duration', true);
    $workshop_price = get_post_meta($post->ID, 'workshop_price', true);
    $registration_link = get_post_meta($post->ID, 'registration_link', true);
    $what_to_bring = get_post_meta($post->ID, 'what_to_bring', true);
    $prerequisites = get_post_meta($post->ID, 'prerequisites', true);
    ?>
    
    <div class="workshop-meta-box">
        <p>
            <label for="workshop_date"><?php _e('Workshop Date:', 'katie-bray'); ?></label><br>
            <input type="date" id="workshop_date" name="workshop_date" value="<?php echo esc_attr($workshop_date); ?>" class="widefat">
        </p>
        
        <p>
            <label for="workshop_duration"><?php _e('Duration:', 'katie-bray'); ?></label><br>
            <input type="text" id="workshop_duration" name="workshop_duration" value="<?php echo esc_attr($workshop_duration); ?>" class="widefat" placeholder="e.g., 3 hours">
        </p>
        
        <p>
            <label for="workshop_price"><?php _e('Price:', 'katie-bray'); ?></label><br>
            <input type="text" id="workshop_price" name="workshop_price" value="<?php echo esc_attr($workshop_price); ?>" class="widefat" placeholder="e.g., €99">
        </p>
        
        <p>
            <label for="registration_link"><?php _e('Registration Link:', 'katie-bray'); ?></label><br>
            <input type="url" id="registration_link" name="registration_link" value="<?php echo esc_url($registration_link); ?>" class="widefat">
        </p>
        
        <p>
            <label for="what_to_bring"><?php _e('What to Bring:', 'katie-bray'); ?></label><br>
            <textarea id="what_to_bring" name="what_to_bring" rows="4" class="widefat"><?php echo esc_textarea($what_to_bring); ?></textarea>
        </p>
        
        <p>
            <label for="prerequisites"><?php _e('Prerequisites:', 'katie-bray'); ?></label><br>
            <textarea id="prerequisites" name="prerequisites" rows="4" class="widefat"><?php echo esc_textarea($prerequisites); ?></textarea>
        </p>
    </div>
    <?php
}

/**
 * Save workshop details meta box data
 */
function katie_bray_save_workshop_details($post_id) {
    if (!isset($_POST['workshop_details_nonce']) || !wp_verify_nonce($_POST['workshop_details_nonce'], 'workshop_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'workshop_date',
        'workshop_duration',
        'workshop_price',
        'registration_link',
        'what_to_bring',
        'prerequisites'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, $field, $value);
        }
    }
}
add_action('save_post_workshop', 'katie_bray_save_workshop_details');
