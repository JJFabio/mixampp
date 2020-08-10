<?php
if (!defined('ABSPATH')) {
    exit;
}

class ASI_Widget_Main extends ASI_Widget {

    public function __construct() {
        $this->widget_id = 'asitheme_widget_main';
        $this->widget_name = sprintf(__('%s - Main', ASITHEME_SLUG), CHILD_THEME_AUTHOR);
        $this->widget_cssclass = 'asitheme_widget ' . $this->widget_id;
        $this->widget_description = '';
        $this->settings = array(
            'title' => array(
                'type' => 'textarea',
                'std' => 'One Page WordPress Theme with Genesis Framework',
                'label' => __('Title'),
            ),
            'text' => array(
                'type' => 'textarea',
                'std' => 'Lorem ipsum dolor sit amet, consectetur adipisicing eli quis nostrud.',
                'label' => __('Text'),
            ),
            'text_align' => array(
                'type' => 'select',
                'std' => 'right',
                'label' => __('Text align', ASITHEME_SLUG),
                'options' => array(
                    'center' => __('Center'),
                    'left' => __('Left'),
                    'right' => __('Right'),
                )
            ),
            'text_color' => array(
                'type' => 'text',
                'std' => '#000',
                'label' => __('Text color', ASITHEME_SLUG),
                'class_input' => 'widget-color-picker'
            ),
            'group_1' => array(
                'type' => 'group',
                'label' => __('Button', ASITHEME_SLUG),
                'items' => array(
                    'button_text' => array(
                        'type' => 'text',
                        'std' => 'Contact',
                        'label' => __('Button text', ASITHEME_SLUG),
                    ),
                    'button_link' => array(
                        'type' => 'text',
                        'std' => get_home_url(),
                        'label' => __('Button link', ASITHEME_SLUG),
                    ),
                    'button_target' => array(
                        'type' => 'checkbox',
                        'label' => __('Open in a new tab', ASITHEME_SLUG),
                    ),
                )
            ),
            'background_image' => array(
                'type' => 'image',
                'std' => '',
                'label' => __('Background image', ASITHEME_SLUG)
            ),
            'background_opacity' => array(
                'type' => 'range',
                'std' => '50',
                'label' => __('Opacity'),
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'desc' => __("black layer's opacity above the picture", ASITHEME_SLUG),
            ),
        );

        parent::__construct();
    }

    public function admin_head_widgets() {
        parent::admin_head_widgets();
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
    }

    public function widget($args, $instance) {
        if ($this->settings) {
            foreach ($this->settings as $k => $v) {
                if (isset($v['std']) && $v['std']) {
                    $instance[$k] = isset($instance[$k]) ? $instance[$k] : $v['std'];
                }
                if (isset($v['type']) && $v['type'] == 'group') {
                    $items = $v['items'];
                    if ($items) {
                        foreach ($items as $kk => $vv) {
                            if (isset($vv['std']) && $vv['std']) {
                                $instance[$kk] = isset($instance[$kk]) ? $instance[$kk] : $vv['std'];
                            }
                        }
                    }
                }
            }
        }
        $h_wrap = 'h2';
        if (asitheme_is_first_widget_in_front_page($args['id'], $this->id)) {
            $h_wrap = 'h1';
        }
        ob_start();
        $this->widget_start($args, $instance);
        $img = '';
        if ($instance['background_image']) {
            $image = asitheme_get_image_sizes($instance['background_image']);
            if ($image) {
                $img = $image['url'];
            }
        }
        $back = $img && is_numeric($instance['background_opacity']);
        ?>
        <div class="<?php echo $instance['text_align'] ? esc_attr('text-' . $instance['text_align']) : '' ?> <?php echo esc_attr($this->widget_cssclass) ?> <?php echo $back ? '' : 'black'; ?> <?php echo $img ? 'hasbackground' : 'nobackground'; ?> <?php echo $instance['title'] ? '' : esc_attr('no-title') ?>" style="<?php echo $img ? "background-image: url('" . esc_url($img) . "')" : '' ?>">
            <?php if ($back) { ?>
                <div class="back"></div>
            <?php } ?>
            <div class="inner">
                <?php
                if ($instance['title']) {
                    genesis_markup(array('open' => "<$h_wrap %s>", 'context' => 'title'));
                    echo do_shortcode(nl2br($instance['title']));
                    genesis_markup(array('close' => "</$h_wrap>", 'context' => 'title'));
                }
                ?>
                <?php if ($instance['text']) { ?>
                    <p class="text">
                        <?php echo do_shortcode($instance['text']) ?>
                    </p>
                <?php } ?>
                <?php if ($instance['button_link'] && $instance['button_text']) { ?>
                    <a <?php echo $instance['button_target'] ? 'target="_blank"' : ''; ?> class="button" href="<?php echo $instance['button_link']; ?>">
                        <?php echo $instance['button_text'] ?>
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php if ($back) { ?>
            <style>
                <?php echo '#' . $this->id ?>
                .asitheme_widget_main > .back{
                    opacity: <?php echo (float) $instance['background_opacity'] / 100 ?>;
                }
                <?php echo '#' . $this->id ?>
                .asitheme_widget_main > .inner .title,
                <?php echo '#' . $this->id ?> .asitheme_widget_main > .inner .text{
                    color: <?php echo $instance['text_color']; ?>;
                }
            </style>
            <?php
        }
        $this->widget_end($args);
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

}
