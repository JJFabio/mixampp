<?php

add_action('init', 'businesspro_options');
if (!function_exists('businesspro_options')) {

    function businesspro_options() {
        // VARIABLES
        $themename = wp_get_theme(get_stylesheet_directory_uri());
        $themename = $themename['Name'];
        $shortname = "of";
        // Populate OptionsFramework option in array for use in theme
        global $businesspro_options;
        $businesspro_options = businesspro_get_option('businesspro_options');
        //Front page on/off
        $file_rename = array("on" => "On", "off" => "Off");
        // Background Defaults
        $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
        // Pull all the categories into an array
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
            $options_categories[$category->cat_ID] = $category->cat_name;
        }
        // Populate OptionsFramework option in array for use in theme
        $testimonial = array("on" => "On", "off" => "Off");
        $home_page_blog = array("on" => "On", "off" => "Off");
        $sign_up_section = array("on" => "On", "off" => "Off");
        // Pull all the pages into an array
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
        }

        // If using image radio buttons, define a directory path
        $imagepath = get_stylesheet_directory_uri() . '/images/';
        /* ---------------------------------------------------------------------------- */
        /* General Setting */
        /* ---------------------------------------------------------------------------- */
        $options = array(
            array("name" => "General Settings",
                "type" => "heading"),
            array("name" => "Custom Logo",
                "desc" => "Choose your own logo. Optimal Size: 221px Wide by 84px Height.",
                "id" => "businesspro_logo",
                "type" => "upload"),
            array("name" => "Home Page Top Right Cell Info",
                "desc" => "Enter your text for home page top right cell info.",
                "id" => "businesspro_topright_cell",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Home Page Top Right Contact Info",
                "desc" => "Enter your text for home page top right contact info.",
                "id" => "businesspro_topright_text",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Custom Favicon",
                "desc" => "Specify a 16px x 16px image that will represent your website's favicon.",
                "id" => "businesspro_favicon",
                "type" => "upload"),
           
            /* ---------------------------------------------------------------------------- */
            /* Slider Setting */
            /* ---------------------------------------------------------------------------- */
            //Slider Setting
            array("name" => "Home Top Feature",
                "type" => "heading"),
            //First Slider
            array("name" => "Home Top Feature Image",
                "desc" => "Choose your image for first slider. Optimal size is 950px wide and 390px height.",
                "id" => "businesspro_slideimage1",
                "std" => "",
                "type" => "upload"),
            array("name" => "Home Top Feature Heading",
                "desc" => "Enter your text heading for first slider.",
                "id" => "businesspro_sliderheading1",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Home Top Feature Link URL",
                "desc" => "Enter your link url for first Slider section.",
                "id" => "businesspro_Sliderlink1",
                "std" => "",
                "type" => "text"),
            array("name" => "Home Top Feature Description",
                "desc" => "Enter your text description for first slider.",
                "id" => "businesspro_sliderdes1",
                "std" => "",
                "type" => "textarea"),
			//Second Slider	
			array("name" => "Home Top Feature Image1",
                "desc" => "Choose your image for second slider. Optimal size is 950px wide and 390px height.",
                "id" => "businesspro_slideimage2",
                "std" => "",
                "type" => "upload"),
            array("name" => "Home Top Feature Heading",
                "desc" => "Enter your text heading for second slider.",
                "id" => "businesspro_sliderheading2",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Home Top Feature Link URL",
                "desc" => "Enter your link url for second slider section.",
                "id" => "businesspro_Sliderlink2",
                "std" => "",
                "type" => "text"),
            array("name" => "Home Top Feature Description",
                "desc" => "Enter your text description for second slider.",
                "id" => "businesspro_sliderdes2",
                "std" => "",
                "type" => "textarea"),
			//Third Slider		
			array("name" => "Home Top Feature Image2",
                "desc" => "Choose your image for third slider. Optimal size is 950px wide and 390px height.",
                "id" => "businesspro_slideimage3",
                "std" => "",
                "type" => "upload"),
            array("name" => "Home Top Feature Heading",
                "desc" => "Enter your text heading for third slider.",
                "id" => "businesspro_sliderheading3",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Home Top Feature Link URL",
                "desc" => "Enter your link url for third Slider section.",
                "id" => "businesspro_Sliderlink3",
                "std" => "",
                "type" => "text"),
            array("name" => "Home Top Feature Description",
                "desc" => "Enter your text description for third slider.",
                "id" => "businesspro_sliderdes3",
                "std" => "",
                "type" => "textarea"),
				
				
            /* ---------------------------------------------------------------------------- */
            /* Homepage Feature Area */
            /* ---------------------------------------------------------------------------- */
            array("name" => "Homepage Settings",
                "type" => "heading"),
            //Homepage Main Heading 
            array("name" => "Home Page Heading",
                "desc" => "Enter your heading text for home page",
                "id" => "businesspro_mainheading",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Home Page Feature Content",
                "type" => "saperate",
                "class" => "saperator"),
            //***Code for Feature Feature***//
            array("name" => "First Feature Heading",
                "desc" => "Enter your heading for first Feature area",
                "id" => "businesspro_headline1",
                "std" => "",
                "type" => "textarea"),
            array("name" => "First Feature Image",
                "desc" => "Choose image for your first Feature area. Optimal size 158px x 165px",
                "id" => "businesspro_wimg1",
                "std" => "",
                "type" => "upload"),
            array("name" => "First Feature Content",
                "desc" => "Enter your content for first Feature area",
                "id" => "businesspro_feature1",
                "std" => "",
                "type" => "textarea"),
            array("name" => "First Feature Link",
                "desc" => "Enter your link for first Feature area",
                "id" => "businesspro_link1",
                "std" => "",
                "type" => "text"),
//***Code for second Feature***//
            array("name" => "Second Feature Heading",
                "desc" => "Enter your heading for second Feature area",
                "id" => "businesspro_headline2",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Second Feature Image",
                "desc" => "Choose image for your second Feature area. Optimal size 158px x 165px",
                "id" => "businesspro_fimg2",
                "std" => "",
                "type" => "upload"),
            array("name" => "Second Feature Content",
                "desc" => "Enter your content for second feature area",
                "id" => "businesspro_feature2",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Second Feature Link",
                "desc" => "Enter your link for second Feature area",
                "id" => "businesspro_link2",
                "std" => "",
                "type" => "text"),
//***Code for third Feature***//	
            array("name" => "Third Feature Heading",
                "desc" => "Enter your heading for third Feature area",
                "id" => "businesspro_headline3",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Third Feature Image",
                "desc" => "Choose image for your thrid Feature. Optimal size 158px x 165px",
                "id" => "businesspro_fimg3",
                "std" => "",
                "type" => "upload"),
            array("name" => "Third Feature Content",
                "desc" => "Enter your content for third Feature area",
                "id" => "businesspro_feature3",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Third Feature Link",
                "desc" => "Enter your link for third feature area",
                "id" => "businesspro_link3",
                "std" => "",
                "type" => "text"),
            /* ---------------------------------------------------------------------------- */
            /* Social Logos */
            /* ---------------------------------------------------------------------------- */
            array("name" => "Social Logos",
                "type" => "heading"),
            array("name" => "Facebook URL",
                "desc" => "Enter your Facebook URL if you have one",
                "id" => "businesspro_facebook",
                "std" => "#",
                "type" => "text"),
            array("name" => "Twitter URL",
                "desc" => "Enter your Twitter URL if you have one",
                "id" => "businesspro_twitter",
                "std" => "#",
                "type" => "text"),
            array("name" => "LinkedIn URL",
                "desc" => "Enter your LinkedIn URL if you have one",
                "id" => "businesspro_linked",
                "std" => "#",
                "type" => "text"),
            array("name" => "RSS Feed URL",
                "desc" => "Enter your RSS Feed URL if you have one",
                "id" => "businesspro_rss",
                "std" => "#",
                "type" => "text"),
            /* ---------------------------------------------------------------------------- */
            /* Styling Setting */
            /* ---------------------------------------------------------------------------- */
            array("name" => "Styling Options",
                "type" => "heading"),
            array("name" => "Custom CSS",
                "desc" => "Quickly add some Custom CSS to your theme by adding it to this block.",
                "id" => "businesspro_customcss",
                "std" => "",
                "type" => "textarea")
        );
        businesspro_update_option('of_template', $options);
        businesspro_update_option('of_themename', $themename);
        businesspro_update_option('of_shortname', $shortname);
    }

}
?>
