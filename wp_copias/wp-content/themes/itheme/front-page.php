<?php
if (!defined('ABSPATH'))
    exit;

//* Add intro widget area
add_action('itheme_front_page_content_area', 'itheme_front_intro', 20);
remove_action('genesis_after_endwhile', 'genesis_posts_nav');

function itheme_front_intro() {
    $max_posts = get_theme_mod('itheme_frontpage_num_posts', 2);
    $color_text = get_theme_mod('itheme_frontpage_banner_title_color', '#ffffff');
    ?>

    <style type="text/css">
        article.front-page .banner h1,    
        article.front-page .banner h1 *{
            color: <?php echo $color_text; ?>;
        }
    </style>

    <article class="front-page">

        <div class="banner" style="background-image: url('<?php echo get_theme_mod('itheme_frontpage_banner_image'); ?>');">

            <div class="banner-inner">
                <h1><?php echo get_theme_mod('itheme_frontpage_banner_title'); ?></h1>
                <a href="<?php echo esc_url(get_theme_mod('itheme_frontpage_banner_button_link', '#')); ?>" class="button">
                    <?php echo esc_html(get_theme_mod('itheme_frontpage_banner_button_text')); ?>
                </a>
            </div>

        </div>

        <div class="wrapper-inner">

            <div class="cta-wrapper">

                <div class="cta">
                    <div class="cta-inner">
                        <div class="image">
                            <img src="<?php echo get_theme_mod('itheme_frontpage_cta_image_1'); ?>"/>
                        </div>
                        <div class="text"><?php echo get_theme_mod('itheme_frontpage_cta_text_1'); ?></div>
                    </div>
                </div>

                <div class="cta">
                    <div class="cta-inner">
                        <div class="image">
                            <img src="<?php echo get_theme_mod('itheme_frontpage_cta_image_2'); ?>"/>
                        </div>
                        <div class="text"><?php echo get_theme_mod('itheme_frontpage_cta_text_2'); ?></div>
                    </div>
                </div>

                <div class="cta">
                    <div class="cta-inner">
                        <div class="image">
                            <img src="<?php echo get_theme_mod('itheme_frontpage_cta_image_3'); ?>"/>
                        </div>
                        <div class="text"><?php echo get_theme_mod('itheme_frontpage_cta_text_3'); ?></div>
                    </div>
                </div>

                <div class="clear"></div>

            </div>

            <div class="asi-posts-wrapper">
                <?php genesis_custom_loop(array('posts_per_page' => $max_posts)); ?>
            </div>

            <?php
            $count_posts = wp_count_posts();
            if ($count_posts->publish > $max_posts) {
                $blog_page_id = (int) get_option('page_for_posts');
                if ($blog_page_id) {
                    $blog_page = get_post($blog_page_id);
                    if ($blog_page && isset($blog_page->ID) && $blog_page->ID) {
                        ?>
                        <div class="all-posts">
                            <a href="<?php echo esc_url(get_permalink($blog_page->ID)) ?>"><?php echo get_theme_mod('itheme_frontpage_all_posts_text') ?></a>
                        </div>
                        <?php
                    }
                }
            }
            ?>

        </div>

    </article>
    <?php
}

//* Build the page
get_header();
do_action('itheme_front_page_content_area');
get_footer();
