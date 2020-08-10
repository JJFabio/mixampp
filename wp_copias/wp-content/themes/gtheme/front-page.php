<?php
if (!defined('ABSPATH'))
    exit;

//* Add intro widget area
add_filter('gtheme_content_area', 'gtheme_front_intro', 20);

function gtheme_front_intro() {
    ?>

    <article class="front-page">

        <div class="banner" style="background-image: url('<?php echo get_theme_mod('gtheme_frontpage_banner_image'); ?>');">

            <div class="banner-inner">
                <h1><?php echo get_theme_mod('gtheme_frontpage_banner_title'); ?></h1>
                <div class="subtitle">
                    <?php echo get_theme_mod('gtheme_frontpage_banner_subtitle'); ?>
                </div>
                <a href="<?php echo esc_url(get_theme_mod('gtheme_frontpage_banner_button_link', '#')); ?>" class="button">
                    <?php echo esc_html(get_theme_mod('gtheme_frontpage_banner_button_text')); ?>
                </a>
            </div>

        </div>

        <div class="front-page-inner">

            <div class="cta-wrapper">

                <div class="cta-wrapper-inner">

                    <a class="cta" href="<?php echo get_theme_mod('gtheme_frontpage_cta_link_1'); ?>">
                        <div class="cta-inner">
                            <div class="title"><?php echo get_theme_mod('gtheme_frontpage_cta_title_1'); ?></div>
                            <div class="description"><?php echo get_theme_mod('gtheme_frontpage_cta_description_1'); ?></div>
                        </div>
                    </a>

                    <a class="cta" href="<?php echo get_theme_mod('gtheme_frontpage_cta_link_2'); ?>">
                        <div class="cta-inner">
                            <div class="title"><?php echo get_theme_mod('gtheme_frontpage_cta_title_2'); ?></div>
                            <div class="description"><?php echo get_theme_mod('gtheme_frontpage_cta_description_2'); ?></div>
                        </div>
                    </a>

                    <a class="cta" href="<?php echo get_theme_mod('gtheme_frontpage_cta_link_3'); ?>">
                        <div class="cta-inner">
                            <div class="title"><?php echo get_theme_mod('gtheme_frontpage_cta_title_3'); ?></div>
                            <div class="description"><?php echo get_theme_mod('gtheme_frontpage_cta_description_3'); ?></div>
                        </div>
                    </a>

                </div>

            </div>

            <?php $posts = get_posts(array('posts_per_page' => 3)); ?>

            <?php if ($posts): ?>

                <div class="asi-posts-wrapper asi-table-columns asi-front-page">

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
                                <div class="entry-content">
                                    <p><?php echo get_the_excerpt($p->ID) ?></p>
                                </div>
                            </div>
                        </div><?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </article>
    <?php
}

//* Build the page
get_header();
do_action('gtheme_content_area');
get_footer();
