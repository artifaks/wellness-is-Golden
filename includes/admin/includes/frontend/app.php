<?php if (!defined('ABSPATH')) exit; ?>

<div class="wellness-golden-app">
    <div class="search-section">
        <input type="text" id="herb-search" placeholder="Search herbs...">
        <select id="herb-category">
            <option value="">All Categories</option>
            <?php
            $categories = get_terms(['taxonomy' => 'herb_category']);
            foreach ($categories as $category) {
                echo '<option value="' . esc_attr($category->slug) . '">' . 
                     esc_html($category->name) . '</option>';
            }
            ?>
        </select>
        <button id="search-button">Search</button>
    </div>

    <div id="herbs-results" class="herbs-grid"></div>
</div>
