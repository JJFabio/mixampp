<div class="grid_12 alpha">
    <div class="widget_inner">
        <?php if (is_active_sidebar('first-footer-widget-area')) : ?>
            <?php dynamic_sidebar('first-footer-widget-area'); ?>
        <?php else : ?>  
            <h3><?php _e('ABOUT YOUR BUSINESS','business-pro'); ?></h3>
            <p><?php _e('Business Pro is a Professional Theme with Easy Customization Options. Business Pro theme is suitable for all Business Websites. You can change your logo, three slider images, featured text and image with using theme options panel.','business-pro'); ?></p>
            <br/>
            <p><?php _e('If your looking for help with our themes this is the place to be.','business-pro'); ?></p>               
        <?php endif; ?> 
    </div>
</div>
<div class="grid_6">
    <div class="widget_inner last">
        <?php if (is_active_sidebar('second-footer-widget-area')) : ?>
            <?php dynamic_sidebar('second-footer-widget-area'); ?>
        <?php else : ?> 
            <h3><?php _e('SOCIAL LINK','business-pro'); ?></h3>
            <ul class="Social-links">
                <?php if (businesspro_get_option('businesspro_facebook') != '') { ?>
                    <li><a href="<?php echo businesspro_get_option('businesspro_facebook'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" /><?php _e('&nbsp;&nbsp;Join Us On Facebook','business-pro'); ?></a> </li>
                <?php } ?>  
                <?php if (businesspro_get_option('businesspro_twitter') != '') { ?>
                    <li><a href="<?php echo businesspro_get_option('businesspro_twitter'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" /><?php _e('&nbsp;&nbsp;Join Us On Twitter','business-pro'); ?></a></li>
                <?php } ?>
                <?php if (businesspro_get_option('businesspro_linked') != '') { ?>
                    <li><a href="<?php echo businesspro_get_option('businesspro_linked'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkdin.png" /><?php _e('&nbsp;&nbsp;Join Us On In.com','business-pro'); ?></a></li>
                <?php } ?>
                <?php if (businesspro_get_option('businesspro_rss') != '') { ?>
                    <li><a href="<?php echo businesspro_get_option('businesspro_rss'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/subscribe.png" /><?php _e('&nbsp;&nbsp;Subscribe to Our Blog','business-pro'); ?></a></li>
                <?php } ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
<div class="grid_6 omega">
    <div class="widget_inner">
        <?php if (is_active_sidebar('third-footer-widget-area')) : ?>
            <?php dynamic_sidebar('third-footer-widget-area'); ?>
        <?php else : ?> 
            <h3><?php _e('FOOTER SETUP','business-pro'); ?></h3>
            <p><?php _e('Footer is widgetized. To setup the footer, drag the required Widgets in Appearance -> Widgets Tab in the First, Second or Third Footer Widget Areas.','business-pro'); ?></P>
        <?php endif; ?>
    </div>
</div>
