<?php if (!defined('ABSPATH')) exit; ?>

<div class="herb-meta-box">
    <p>
        <label for="scientific_name"><strong>Scientific Name:</strong></label><br>
        <input type="text" id="scientific_name" name="scientific_name" 
               value="<?php echo esc_attr($scientific_name); ?>" style="width: 100%">
    </p>

    <p>
        <label for="dosage"><strong>Recommended Dosage:</strong></label><br>
        <textarea id="dosage" name="dosage" rows="4" style="width: 100%"><?php 
            echo esc_textarea($dosage); 
        ?></textarea>
    </p>
</div>
