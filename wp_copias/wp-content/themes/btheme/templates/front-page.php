<?php
/**
 * Template Name: Front Page
 */
if (!defined('ABSPATH'))
    exit;

//* Add intro widget area
add_filter('asitheme_content_area', 'asitheme_front_intro', 20);

function asitheme_front_intro() {

    $display_posts = get_theme_mod(ASITHEME_SLUG . '_frontpage_display_posts', 'last');
    $max_posts = (int) get_theme_mod(ASITHEME_SLUG . '_frontpage_num_posts', 3);
    $featureds_posts = get_theme_mod(ASITHEME_SLUG . '_frontpage_featured_posts');

    $h1 = get_theme_mod(ASITHEME_SLUG . '_frontpage_title_page');

    $banner_title = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_title');
    $banner_subtitle = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_subtitle');
    $banner_button_link = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_button_link', home_url());
    $banner_button_text = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_button_text');

    $banner_left_show = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_left_show', 'image');
    $banner_image = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_image');
    $banner_image_link = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_image_link');
    $banner_video = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_video', 'https://www.youtube.com/watch?v=eCiYX1SsvXY');

    $ctas = array(
        '1' => array(
            'text' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_text_1'),
            'link' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_link_1'),
            'image' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_image_1'),
        ),
        '2' => array(
            'text' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_text_2'),
            'link' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_link_2'),
            'image' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_image_2'),
        ),
        '3' => array(
            'text' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_text_3'),
            'link' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_link_3'),
            'image' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_image_3'),
        )
    );
    foreach ($ctas as $k => $item) {
        if (!$item['text']) {
            unset($ctas[$k]);
        }
    }
    ?>

    <article class="front-page">

        <?php if ($h1) { ?>
            <h1><?php echo $h1; ?></h1>
        <?php } ?>

        <div class="banner">

            <?php if ($banner_left_show == 'image') { ?>

                <?php if ($banner_image_link == '') { ?>
                    <div class="left-wrapper" style="background-image: url('<?php echo $banner_image; ?>');"></div>
                <?php } else { ?>
                    <a class="left-wrapper" href="<?php echo $banner_image_link; ?>" style="background-image: url('<?php echo $banner_image; ?>');"></a>
                <?php } ?>

            <?php } else if ($banner_left_show == 'video') { ?>

                <div class="video-iframe left-wrapper">
                    <?php echo wp_oembed_get($banner_video, array('width' => 500, 'height' => 281)); ?>
                </div>

            <?php } ?>

            <div class="separator"></div>

            <div class="right-wrapper">
                <?php if ($banner_title) { ?>
                    <h2><?php echo $banner_title; ?></h2>
                <?php } ?>
                <?php if ($banner_subtitle) { ?>
                    <div class="subtitle">
                        <?php echo $banner_subtitle; ?>
                    </div>
                <?php } ?>
                <?php if ($banner_button_link && $banner_button_text) { ?>
                    <a href="<?php echo esc_url($banner_button_link); ?>" class="button">
                        <?php echo esc_html($banner_button_text); ?>
                    </a>
                <?php } ?>
            </div>

        </div>

        <?php if ($ctas) { ?>

            <div class="cta-wrapper cta-<?php echo count($ctas) ?>">

                <?php foreach ($ctas as $item) { ?>

                    <div class="cta">
                        <div class="cta-inner">
                            <?php if ($item['link']) { ?>
                                <a href="<?php echo esc_url($item['link']) ?>">
                                <?php } ?>
                                <?php if ($item['image']) { ?>
                                    <div class="image">
                                        <img src="<?php echo esc_url($item['image']); ?>">
                                    </div>
                                <?php } ?>
                                <div class="text">
                                    <?php echo $item['text'] ?>
                                </div>
                                <?php if ($item['link']) { ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>

                <?php } ?>

                <div class="clear"></div>

            </div>

        <?php } ?>

        <?php
        $args = array();
        if ($display_posts == 'last') {
            $args = array('posts_per_page' => $max_posts);
        } else if ($display_posts == 'featured') {
            if ($featureds_posts) {
                $post_ids = array();
                foreach ($featureds_posts as $key => $value) {
                    array_push($post_ids, $value);
                }
                if ($post_ids) {
                    $args = array(
                        'post__in' => $post_ids,
                        'orderby' => 'post__in'
                    );
                }
            }
        }
        if ($args) {
            global $wp_query;
            $temp_query = clone $wp_query;
            query_posts($args);
            if (have_posts()) :
                ?>

                <div class="asi-posts-wrapper asi-front-page">

                    <?php while (have_posts()) : the_post(); ?><div class="post asicolumn">
                            <a class="entry-image-link" href="<?php echo the_permalink(); ?>" style="background-image: url('<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium_large')[0]; ?>');"></a>
                            <div class="entry-content-wrap">
                                <div class="entry-header">
                                    <h2 class="entry-title" itemprop="headline">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_title() ?>
                                        </a>
                                    </h2>
                                </div>
                                <div class="entry-content">
                                    <?php the_excerpt() ?>
                                </div>
                            </div>
                        </div><?php endwhile; ?>

                </div>

                <?php
            endif;
            $wp_query = clone $temp_query;
        }
        ?>

    </article>
    <?php
}

//* Build the page
get_header();
do_action('asitheme_content_area');
get_footer();
