<?php
if (!defined('ABSPATH'))
    exit;

//* Add intro widget area
add_filter('ktheme_content_area', 'ktheme_front_intro', 20);

function ktheme_front_intro() {
    $max_posts = 6;
    ?>

    <article class="front-page">

        <h1><?php echo get_theme_mod('ktheme_frontpage_title_page'); ?></h1>

        <?php $posts = get_posts(array('posts_per_page' => $max_posts)); ?>

        <?php if ($posts): ?>

            <div class="asi-posts-wrapper">

                <?php foreach ($posts as $p): ?><div class="post asicolumn">
                        <a class="entry-image-link" href="<?php echo get_permalink($p->ID); ?>" style="background-image: url('<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($p->ID), 'medium_large')[0]; ?>');"></a>
                        <div class="entry-content-wrap">
                            <div class="entry-header">
                                <h2 class="entry-title" itemprop="headline">
                                    <a href="<?php echo get_permalink($p->ID); ?>" rel="bookmark">
                                        <?php echo get_the_title($p->ID) ?>
                                    </a>
                                </h2>
                            </div>
                        </div>
                    </div><?php endforeach; ?>

            </div>

        <?php endif; ?>

        <?php
        $count_posts = wp_count_posts();
        if ($count_posts->publish > $max_posts) {
            $blog_page_id = (int) get_option('page_for_posts');
            if ($blog_page_id) {
                $blog_page = get_post($blog_page_id);
                if ($blog_page && isset($blog_page->ID) && $blog_page->ID) {
                    ?>
                    <div class="all-posts">
                        <a href="<?php echo esc_url(get_permalink($blog_page->ID)) ?>"><?php echo get_theme_mod('ktheme_frontpage_all_posts_text') ?></a>
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
do_action('ktheme_content_area');
get_footer();
