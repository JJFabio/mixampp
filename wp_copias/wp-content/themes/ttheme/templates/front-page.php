<?php
/**
 * Template Name: Front Page
 */
if (!defined('ABSPATH'))
    exit;

//* Add intro widget area
add_filter('asitheme_content_area', 'asitheme_front_intro', 20);

function asitheme_front_intro() {

    $title = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_title', 'Amazing Genesis WordPress Theme');
    $subtitle = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_subtitle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui. Aliquam erat volutpat.');
    $button_text = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_button_text', __('Contact', ASITHEME_SLUG));
    $button_link = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_button_link', home_url('/'));
    $banner_image = get_theme_mod(ASITHEME_SLUG . '_frontpage_banner_image', ASITHEME_CDN . '/assets/images/default.png');

    $newsletter = get_theme_mod(ASITHEME_SLUG . '_frontpage_newsletter');
    $newsletter_title = get_theme_mod(ASITHEME_SLUG . '_frontpage_newsletter_title', __('Subscribe to the newsletter', ASITHEME_SLUG));
    $newsletter_content = get_theme_mod(ASITHEME_SLUG . '_frontpage_newsletter_content', "<ul><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui. </li><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui. </li><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui. </li><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui. </li></ul>");
    $newsletter_form = get_theme_mod(ASITHEME_SLUG . '_frontpage_newsletter_form');

    $title_ctas = get_theme_mod(ASITHEME_SLUG . '_frontpage_title_ctas', __('Services', ASITHEME_SLUG));
    $ctas = array(
        '1' => array(
            'title' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_title_1', __('Service one', ASITHEME_SLUG)),
            'text' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_description_1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui.'),
            'link' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_link_1', '#'),
            'image' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_image_1', ASITHEME_CDN . '/assets/images/folder.png'),
        ),
        '2' => array(
            'title' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_title_2', __('Service two', ASITHEME_SLUG)),
            'text' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_description_2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui.'),
            'link' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_link_2', '#'),
            'image' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_image_2', ASITHEME_CDN . '/assets/images/diamond.png'),
        ),
        '3' => array(
            'title' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_title_3', __('Service three', ASITHEME_SLUG)),
            'text' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_description_3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui.'),
            'link' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_link_3', '#'),
            'image' => get_theme_mod(ASITHEME_SLUG . '_frontpage_cta_image_3', ASITHEME_CDN . '/assets/images/lego.png'),
        )
    );
    foreach ($ctas as $k => $item) {
        if (!$item['text'] && !$item['title']) {
            unset($ctas[$k]);
        }
    }

    $posts_title = get_theme_mod(ASITHEME_SLUG . '_frontpage_posts_title', __('Last posts', ASITHEME_SLUG));
    $display_posts = get_theme_mod(ASITHEME_SLUG . '_frontpage_display_posts', 'last');
    $max_posts = (int) get_theme_mod(ASITHEME_SLUG . '_frontpage_num_posts', 4);
    $featureds_posts = get_theme_mod(ASITHEME_SLUG . '_frontpage_featured_posts');
    $all_posts_text = get_theme_mod(ASITHEME_SLUG . '_frontpage_all_posts_text', __('View all posts', ASITHEME_SLUG));
    ?>

    <article class="front-page">

        <section class="banner-wrapper">
            <div class="block-center">
                <div class="left-wrapper">
                    <?php if ($title) : ?>
                        <h1><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <?php if ($subtitle) : ?>
                        <div class="subtitle">
                            <?php echo $subtitle; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($button_text && $button_link) : ?>
                        <a class="button" href="<?php echo esc_url($button_link) ?>">
                            <?php echo esc_html($button_text) ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="right-wrapper">
                    <img src="<?php echo $banner_image; ?>"/>
                </div>
            </div>
        </section>

        <?php if ($newsletter): ?>
            <section class="newsletter-wrapper">
                <div class="block-center">
                    <?php if ($newsletter_title) : ?>
                        <h2><?php echo $newsletter_title; ?></h2>
                    <?php endif; ?>
                    <div class="info-wrapper <?php echo (!$newsletter_content) ? 'no-content' : '' ?>">
                        <?php if ($newsletter_content) : ?>
                            <div class="content">
                                <?php echo $newsletter_content; ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-wrapper">
                            <?php
                            if ($newsletter_form) {
                                $form_slug = explode('-', $newsletter_form);
                                $form_id = (int) $form_slug[1];
                                switch ($form_slug[0]) {
                                    case 'ninja':
                                        if (class_exists('Ninja_Forms')) {
                                            Ninja_Forms()->display($form_id);
                                        }
                                        break;
                                    case 'gravity':
                                        if (function_exists('gravity_form')) {
                                            gravity_form($form_id, false, false, false, false, true, 200, true);
                                        }
                                        break;
                                    case 'wysija':
                                        if (class_exists('WYSIJA_NL_Widget')) {
                                            $form = new WYSIJA_NL_Widget(true);
                                            echo $form->widget(array('form' => $form_id, 'form_type' => 'php'));
                                        }
                                        break;
                                    case 'mailpoet':
                                        if (class_exists('MailPoet\Form\Widget')) {
                                            $form = new MailPoet\Form\Widget(true);
                                            echo $form->widget(array('form' => $form_id, 'form_type' => 'php'));
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($ctas) : ?>
            <section>

                <div class="block-center">

                    <?php if ($title_ctas) : ?>
                        <h2><?php echo $title_ctas ?></h2>
                    <?php endif; ?>

                    <div class="ctas-wrapper cta-<?php echo count($ctas) ?>">

                        <?php foreach ($ctas as $item) { ?>

                            <div class="cta">
                                <?php if ($item['link']) { ?>
                                    <a class="cta-inner" href="<?php echo esc_url($item['link']) ?>">
                                    <?php } else { ?>
                                        <div class="cta-inner">
                                        <?php } ?>
                                        <?php if ($item['image']) { ?>
                                            <div class="image">
                                                <img src="<?php echo esc_url($item['image']); ?>">
                                            </div>
                                        <?php } ?>
                                        <div class="info">
                                            <div class="title">
                                                <?php echo $item['title'] ?>
                                            </div>
                                            <div class="text">
                                                <?php echo $item['text'] ?>
                                            </div>
                                        </div>
                                        <?php if ($item['link']) { ?>
                                    </a>
                                <?php } else { ?>
                                </div>
                            <?php } ?>
                        </div>

                    <?php } ?>

                </div>

                </div>

            </section>
        <?php endif; ?>

        <?php
        $posts = array();
        if ($display_posts == 'last') {
            $posts = get_posts(array('posts_per_page' => $max_posts));
        } else if ($display_posts == 'featured') {
            if ($featureds_posts) {
                $post_ids = array();
                foreach ($featureds_posts as $key => $value) {
                    array_push($post_ids, $value);
                }
                $posts = get_posts(array(
                    'post__in' => $post_ids,
                    'orderby' => 'post__in'
                ));
            }
        }
        ?>

        <?php if ($posts): ?>

            <section class="blog-wrapper">

                <div class="block-center">

                    <?php if ($posts_title) : ?>
                        <h2><?php echo $posts_title; ?></h2>
                    <?php endif; ?>

                    <div class="asi-posts-wrapper">
                        <?php foreach ($posts as $p): ?>
                            <div class="post entry">
                                <a class="entry-image-link" href="<?php echo get_permalink($p->ID); ?>" style="background-image: url('<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($p->ID), 'medium_large')[0]; ?>');"></a>
                                <div class="entry-content-wrap">
                                    <div class="entry-header">
                                        <h3 class="entry-title" itemprop="headline">
                                            <a href="<?php echo get_permalink($p->ID); ?>" rel="bookmark">
                                                <?php echo get_the_title($p->ID) ?>
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php
                    if ($all_posts_text) {
                        $count_posts = wp_count_posts();
                        if (($display_posts == 'last' && $count_posts->publish > $max_posts) || ($display_posts == 'featured' && $count_posts->publish > count($posts))) {
                            $blog_page_id = (int) get_option('page_for_posts');
                            if ($blog_page_id) {
                                $blog_page = get_post($blog_page_id);
                                if ($blog_page && isset($blog_page->ID) && $blog_page->ID) {
                                    ?>
                                    <div class="all-posts">
                                        <a class="button" href="<?php echo esc_url(get_permalink($blog_page->ID)) ?>">
                                            <?php echo $all_posts_text; ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>

                </div>

            </section>

        <?php endif; ?>

    </article>
    <?php
}

//* Build the page
get_header();
do_action('asitheme_content_area');
get_footer();
