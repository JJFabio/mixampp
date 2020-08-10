<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>
            <?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?>
        </title> 
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
       <?php  
	

        wp_head(); ?>	
        
    </head>				
    <body <?php body_class(); ?>  >
        <div class="main-container">
            <div class="container_24">
                <div class="grid_24">
                    <div class="header">
                        <div class="grid_16 alpha">
                            <div class="logo"> <a href="<?php echo home_url(); ?>"><img src="<?php if (businesspro_get_option('businesspro_logo') != '') { ?><?php echo businesspro_get_option('businesspro_logo'); ?><?php } else { ?><?php echo get_template_directory_uri(); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" /></a></div>
                        </div>
                        <div class="grid_8 omega">
                            <div class="header-info">
                                <?php if (businesspro_get_option('businesspro_topright_cell') != '') { ?>
                                    <p class="cell"><img src="<?php echo get_template_directory_uri(); ?>/images/call-us.png"  class="call-us" />&nbsp; <?php echo stripslashes(businesspro_get_option('businesspro_topright_cell')); ?></p>
                                <?php } else { ?>
                                    <p class="cell"><img src="<?php echo get_template_directory_uri(); ?>/images/call-us.png"  class="call-us" />&nbsp;Call Us (9924241667)</p>
                                <?php } ?>
                                <?php if (businesspro_get_option('businesspro_topright_text') != '') { ?>
                                    <p><?php echo stripslashes(businesspro_get_option('businesspro_topright_text')); ?></p>
                                <?php } else { ?>
                                    <p><?php _e('B4, Sahajand Complex, C. G. Road, Ahmedabad, Gujarat, India','business-pro'); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <!--start Menu wrapper-->
                    <div class="menu_wrapper">
                    <div class="menu-position">
                        <div class="grid_18">
                            <div id="MainNav">
                                <a href="#" class="mobile_nav closed"><?php _e('Pages Navigation Menu','business-pro'); ?><span></span></a>
                                <?php businesspro_nav(); ?> 
                                <div class="grid_6 omega">
                            <div class="top-search">

                                <?php get_search_form(); ?>
                            </div>
                        </div>
                            </div></div>
                    </div>    
                    </div>
                    <!--End Menu wrapper-->
                    <div class="clear"></div>
