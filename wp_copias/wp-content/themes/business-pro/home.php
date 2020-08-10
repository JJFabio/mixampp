<?php
/**
 * Home Page
 * The template for displaying front page pages.
 * 
 *
 */
 get_header(); ?>  
<div class="clear"></div>
<!--Start Slider Wrapper-->
<div class="slider-wrapper">            
    <div class="flexslider">
        <ul class="slides">
            <!--Start Slider-->
            <?php
            //The strpos funtion is comparing the strings to allow uploading of the Videos & Images in the Slider
            $mystring1 = businesspro_get_option('businesspro_slideimage1');
            $value_img = array('.jpg', '.png', '.jpeg', '.gif', '.bmp', '.tiff', '.tif');
            $check_img_ofset = 0;
            foreach ($value_img as $get_value) {
                if (preg_match("/$get_value/", $mystring1)) {
                    $check_img_ofset = 1;
                }
            }
            // Note our use of ===.  Simply == would not work as expected
            // because the position of 'a' was the 0th (first) character.
            ?>
            <?php if ($check_img_ofset == 0 && businesspro_get_option('businesspro_slideimage1') != '') { ?>
                <li><?php echo businesspro_get_option('businesspro_slideimage1'); ?></li>
            <?php } else { ?>  
                <li>  <?php if (businesspro_get_option('businesspro_slideimage1') != '') { ?>
                        <img  src="<?php echo businesspro_get_option('businesspro_slideimage1'); ?>" alt=""/>
                    <?php } else { ?>
                        <img  src="<?php echo get_template_directory_uri(); ?>/images/slider1.png" alt=""/>
                    <?php } ?>
                    <div class="flex-caption">
                        <?php if (businesspro_get_option('businesspro_sliderheading1') != '') { ?>

                            <h1><a href="<?php
                    if (businesspro_get_option('businesspro_Sliderlink1') != '') {
                        echo businesspro_get_option('businesspro_Sliderlink1');
                    }
                            ?>"><?php echo stripslashes(businesspro_get_option('businesspro_sliderheading1')); ?></a></h1>
                        <?php } else { ?>
                            <h1><a href="#"><?php _e('Elegancy with Simplicity', 'business-pro'); ?></a></h1>
                            <?php } ?>
                            <?php if (businesspro_get_option('businesspro_sliderdes1') != '') { ?>
                            <p>					   
                            <?php echo stripslashes(businesspro_get_option('businesspro_sliderdes1')); ?>
                            </p>
                        <?php } else { ?>
                            <p><?php _e('Business Pro Theme allows you to create your website through an easy to use themes options panel.', 'business-pro'); ?></p>
                <?php } ?>						 
                    </div>
                </li>
                
                
                 <li>  <?php if (businesspro_get_option('businesspro_slideimage2') != '') { ?>
                        <img  src="<?php echo businesspro_get_option('businesspro_slideimage2'); ?>" alt=""/>
                    <?php } else { ?>
                        <img  src="<?php echo get_template_directory_uri(); ?>/images/slider2.png" alt=""/>
                    <?php } ?>
                    <div class="flex-caption">
                        <?php if (businesspro_get_option('businesspro_sliderheading2') != '') { ?>

                            <h1><a href="<?php
                    if (businesspro_get_option('businesspro_Sliderlink2') != '') {
                        echo businesspro_get_option('businesspro_Sliderlink2');
                    }
                            ?>"><?php echo stripslashes(businesspro_get_option('businesspro_sliderheading2')); ?></a></h1>
                        <?php } else { ?>
                            <h1><a href="#"><?php _e('Elegancy with Simplicity', 'business-pro'); ?></a></h1>
                            <?php } ?>
                            <?php if (businesspro_get_option('businesspro_sliderdes2') != '') { ?>
                            <p>					   
                            <?php echo stripslashes(businesspro_get_option('businesspro_sliderdes2')); ?>
                            </p>
                        <?php } else { ?>
                            <p><?php _e('Business Pro Theme allows you to create your website through an easy to use themes options panel.', 'business-pro'); ?></p>
                <?php } ?>						 
                    </div>
                </li>
                
                
                 <li>  <?php if (businesspro_get_option('businesspro_slideimage3') != '') { ?>
                        <img  src="<?php echo businesspro_get_option('businesspro_slideimage3'); ?>" alt=""/>
                    <?php } else { ?>
                        <img  src="<?php echo get_template_directory_uri(); ?>/images/slider3.png" alt=""/>
                    <?php } ?>
                    <div class="flex-caption">
                        <?php if (businesspro_get_option('businesspro_sliderheading3') != '') { ?>

                            <h1><a href="<?php
                    if (businesspro_get_option('businesspro_Sliderlink3') != '') {
                        echo businesspro_get_option('businesspro_Sliderlink3');
                    }
                            ?>"><?php echo stripslashes(businesspro_get_option('businesspro_sliderheading3')); ?></a></h1>
                        <?php } else { ?>
                            <h1><a href="#"><?php _e('Elegancy with Simplicity', 'business-pro'); ?></a></h1>
                            <?php } ?>
                            <?php if (businesspro_get_option('businesspro_sliderdes3') != '') { ?>
                            <p>					   
                            <?php echo stripslashes(businesspro_get_option('businesspro_sliderdes3')); ?>
                            </p>
                        <?php } else { ?>
                            <p><?php _e('Business Pro Theme allows you to create your website through an easy to use themes options panel.', 'business-pro'); ?></p>
                <?php } ?>						 
                    </div>
                </li>
                
                
                
<?php } ?>
            <!--End Slider-->
        </ul>
    </div>
</div>
<!--End Silder Wrapper-->
<div class="clear"></div>
<div class="seprator"></div>
<div class="content">
    <?php if (businesspro_get_option('businesspro_mainheading') != '') { ?>
        <h1><?php echo stripslashes(businesspro_get_option('businesspro_mainheading')); ?></h1>
    <?php } else { ?>
        <h1><?php _e('Design attractive &amp; specialized Website with the Business Pro Theme simply & rapidly.', 'business-pro'); ?></h1>
<?php } ?>
</div>
<div class="feature-content">
    <div class="circle-content">
        <div class="grid_8 alpha">
            <div class="feature-content-inner one">
                <?php if (businesspro_get_option('businesspro_wimg1') != '') { ?>
                    <div class="circle"><img src="<?php echo businesspro_get_option('businesspro_wimg1'); ?>" /></div>
                <?php } else { ?>
                    <div class="circle"><img src="<?php echo get_template_directory_uri(); ?>/images/img1.png" /></div>
                        <?php } ?>
                        <?php if (businesspro_get_option('businesspro_headline1') != '') { ?><h1><a href="<?php
                        if (businesspro_get_option('businesspro_link1') != '') {
                            echo businesspro_get_option('businesspro_link1');
                        }
                            ?>"><?php echo stripslashes(businesspro_get_option('businesspro_headline1')); ?></a></h1>
                <?php } else { ?> <h1><a href="#"><?php _e('Leadership', 'business-pro'); ?></a></h1>
                <?php } ?>
                <?php if (businesspro_get_option('businesspro_feature1') != '') { ?>
                    <p><?php echo stripslashes(businesspro_get_option('businesspro_feature1')); ?></p>
                <?php } else { ?>
                    <p><?php _e('The only leadership that is shown by energy conglomerates is to sustain the corporate structure not our energy...', 'business-pro'); ?></p>
<?php } ?>
                <a class="read-more" href="<?php
if (businesspro_get_option('businesspro_link1') != '') {
    echo businesspro_get_option('businesspro_link1');
}
?>">Read More</a> </div>
        </div>
        <div class="grid_8">
            <div class="feature-content-inner two">
                        <?php if (businesspro_get_option('businesspro_fimg2') != '') { ?>
                    <div class="circle"><img src="<?php echo businesspro_get_option('businesspro_fimg2'); ?>" /></div>
                <?php } else { ?>
                    <div class="circle"><img src="<?php echo get_template_directory_uri(); ?>/images/img2.png" /></div>
                <?php } ?>
                <?php if (businesspro_get_option('businesspro_headline2') != '') { ?><h1><a href="<?php
                    if (businesspro_get_option('businesspro_link2') != '') {
                        echo businesspro_get_option('businesspro_link2');
                    }
                    ?>"><?php echo stripslashes(businesspro_get_option('businesspro_headline2')); ?></a></h1>
                <?php } else { ?> <h1><a href="#"><?php _e('Professional', 'business-pro'); ?></a></h1>
                   <?php } ?>
<?php if (businesspro_get_option('businesspro_feature2') != '') { ?>
                    <p><?php echo stripslashes(businesspro_get_option('businesspro_feature2')); ?></p>
                <?php } else { ?>
                    <p><?php _e('We execute product training for the team offering technical support for the team and customers whenever needed...', 'business-pro'); ?></p>
                <?php } ?>
                <a class="read-more" href="<?php
                if (businesspro_get_option('businesspro_link2') != '') {
                    echo businesspro_get_option('businesspro_link2');
                }
                ?>"><?php _e('Read More', 'business-pro') ?></a> </div>
        </div>
        <div class=" grid_8 omega">
            <div class="feature-content-inner three">
                <?php if (businesspro_get_option('businesspro_fimg3') != '') { ?>
                    <div class="circle"><img src="<?php echo businesspro_get_option('businesspro_fimg3'); ?>" /></div>
                <?php } else { ?>
                    <div class="circle"><img src="<?php echo get_template_directory_uri(); ?>/images/img3.png" /></div>
                <?php } ?>
                <?php if (businesspro_get_option('businesspro_headline3') != '') { ?><h1><a href="<?php
                    if (businesspro_get_option('businesspro_link3') != '') {
                        echo businesspro_get_option('businesspro_link3');
                    }
                    ?>"><?php echo stripslashes(businesspro_get_option('businesspro_headline3')); ?></a></h1>
                <?php } else { ?> <h1><a href="#"><?php _e('Solutions', 'business-pro'); ?></a></h1>
                <?php } ?>
                <?php if (businesspro_get_option('businesspro_feature3') != '') { ?>
                                    <p><?php echo stripslashes(businesspro_get_option('businesspro_feature3')); ?></p>
                <?php } else { ?>
                                    <p><?php _e('Utmost Satisfaction in provided to the customers with most probable solutions. With deep...', 'business-pro'); ?></p>
                <?php } ?>
                <a class="read-more" href="<?php
if (businesspro_get_option('businesspro_link3') != '') {
    echo businesspro_get_option('businesspro_link3');
}
?>"><?php _e('Read More', 'business-pro'); ?></a> </div>
        </div>
    </div>
</div>			
<div class="clear"></div>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>
