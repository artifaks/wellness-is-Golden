<?php if (!defined('ABSPATH')) exit; ?>

<div class="wrap">
    <h1>Wellness is Golden Dashboard</h1>
    
    <div class="card">
        <h2>Quick Stats</h2>
        <p>Total Herbs: <?php echo wp_count_posts('herb')->publish; ?></p>
        <p>Categories: <?php echo wp_count_terms('herb_category'); ?></p>
        <p>Properties: <?php echo wp_count_terms('herb_properties'); ?></p>
    </div>

    <div class="card">
        <h2>Add New Content</h2>
        <p><a href="<?php echo admin_url('post-new.php?post_type=herb'); ?>" class="button button-primary">Add New Herb</a></p>
        <p><a href="<?php echo admin_url('edit-tags.php?taxonomy=herb_category&post_type=herb'); ?>" class="button">Manage Categories</a></p>
        <p><a href="<?php echo admin_url('edit-tags.php?taxonomy=herb_properties&post_type=herb'); ?>" class="button">Manage Properties</a></p>
    </div>
</div>
