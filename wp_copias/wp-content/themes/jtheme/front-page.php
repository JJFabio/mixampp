<?php
if (!defined('ABSPATH'))
    exit;

//* Add intro widget area
add_filter('jtheme_content_area', 'jtheme_front_intro', 20);
remove_action('genesis_after_endwhile', 'genesis_posts_nav');

function jtheme_front_intro() {
    $max_posts = get_theme_mod('jtheme_frontpage_num_posts', 3);
    ?>

    <article class="front-page">

        <h1><?php echo get_theme_mod('jtheme_frontpage_title_page'); ?></h1>

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
                        <a href="<?php echo esc_url(get_permalink($blog_page->ID)) ?>"><?php echo get_theme_mod('jtheme_frontpage_all_posts_text') ?></a>
                    </div>
                    <?php
                }
            }
        }
        ?>

    </article>
    <?php
}

//* Build the page
get_header();
do_action('jtheme_content_area');
get_footer();
