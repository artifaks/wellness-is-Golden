<?php
class Wellness_Golden {
    public function run() {
        add_action('init', array($this, 'register_herb_post_type'));
        add_action('init', array($this, 'register_herb_taxonomies'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('add_meta_boxes', array($this, 'add_herb_meta_boxes'));
        add_action('save_post_herb', array($this, 'save_herb_details'));
        add_shortcode('wellness_golden', array($this, 'render_frontend'));
    }

    public function register_herb_post_type() {
        $args = array(
            'public' => true,
            'label'  => 'Herbs',
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-heart',
            'show_in_rest' => true
        );
        register_post_type('herb', $args);
    }

    public function register_herb_taxonomies() {
        register_taxonomy('herb_category', 'herb', array(
            'label' => 'Herb Categories',
            'hierarchical' => true,
            'show_in_rest' => true,
            'show_admin_column' => true
        ));

        register_taxonomy('herb_properties', 'herb', array(
            'label' => 'Herb Properties',
            'hierarchical' => false,
            'show_in_rest' => true,
            'show_admin_column' => true
        ));
    }

    public function add_admin_menu() {
        add_menu_page(
            'Wellness is Golden',
            'Wellness is Golden',
            'manage_options',
            'wellness-is-golden',
            array($this, 'render_admin_page'),
            'dashicons-heart',
            30
        );
    }

    public function render_admin_page() {
        include plugin_dir_path(__FILE__) . 'admin/admin-page.php';
    }

    public function add_herb_meta_boxes() {
        add_meta_box(
            'herb_details',
            'Herb Details',
            array($this, 'render_herb_meta_box'),
            'herb',
            'normal',
            'high'
        );
    }

    public function render_herb_meta_box($post) {
        wp_nonce_field('herb_details_nonce', 'herb_details_nonce');
        $scientific_name = get_post_meta($post->ID, '_scientific_name', true);
        $dosage = get_post_meta($post->ID, '_dosage', true);
        include plugin_dir_path(__FILE__) . 'admin/meta-box.php';
    }

    public function save_herb_details($post_id) {
        if (!isset($_POST['herb_details_nonce']) || 
            !wp_verify_nonce($_POST['herb_details_nonce'], 'herb_details_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        $fields = array('scientific_name', 'dosage');
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }

    public function render_frontend() {
        wp_enqueue_style('wellness-golden-style', plugins_url('assets/style.css', dirname(__FILE__)));
        wp_enqueue_script('wellness-golden-script', plugins_url('assets/script.js', dirname(__FILE__)), array('jquery'), '1.0', true);
        
        ob_start();
        include plugin_dir_path(__FILE__) . 'frontend/app.php';
        return ob_get_clean();
    }
}
