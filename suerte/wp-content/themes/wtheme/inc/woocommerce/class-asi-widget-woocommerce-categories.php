<?php
if (!defined('ABSPATH')) {
    exit;
}

class ASI_Widget_WooCommerce_Categories extends ASI_Widget {

    public function __construct() {

        $this->widget_id = 'asitheme_widget_woocommerce_categories';
        $this->widget_name = sprintf(__('%s - WooCommerce Categories', ASITHEME_SLUG), CHILD_THEME_AUTHOR);
        $this->widget_cssclass = 'asitheme_widget ' . $this->widget_id;
        $this->widget_description = __('List of product categories', ASITHEME_SLUG);

        $this->settings = array(
            'noparents' => array(
                'type' => 'checkbox',
                'label' => __('Show only categories without parents', ASITHEME_SLUG),
            ),
            'counter' => array(
                'type' => 'checkbox',
                'label' => __('Show post counts', ASITHEME_SLUG),
            ),
            'images' => array(
                'type' => 'checkbox',
                'label' => __('Show images?', ASITHEME_SLUG),
            ),
            'empty' => array(
                'type' => 'checkbox',
                'label' => __('Hide empty categories?', ASITHEME_SLUG),
            ),
        );

        parent::__construct();
    }

    public function widget($args, $instance) {

        if ($this->settings) {
            foreach ($this->settings as $k => $v) {
                if (isset($v['std']) && $v['std']) {
                    $instance[$k] = isset($instance[$k]) ? $instance[$k] : $v['std'];
                }
            }
        }

        $args_terms['taxonomy'] = 'product_cat';

        $args_terms['hide_empty'] = false;
        if ($instance['empty']) {
            $args_terms['hide_empty'] = true;
        }

        if ($instance['noparents']) {
            $args_terms['parent'] = 0;
        }

        $terms = get_terms($args_terms);
        if (!$terms) {
            return;
        }

        ob_start();
        $this->widget_start($args, $instance);
        ?>
        <div class="<?php echo esc_attr($this->widget_cssclass) ?>">

            <?php foreach ($terms as $t): ?>

                <a class="cat-item" href="<?php echo get_term_link($t->term_id); ?>">
                    <?php if ($instance['images']): ?>
                        <div class="image-wrapper">
                            <div class="image-inner">
                                <?php $thumbnail_id = get_term_meta($t->term_id, 'thumbnail_id', true); ?>
                                <?php if ($thumbnail_id): ?>
                                    <img src="<?php echo wp_get_attachment_url($thumbnail_id) ?>"/>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="title">
                        <?php
                        echo $t->name;
                        if ($instance['counter']) {
                            echo ' (' . $t->count . ')';
                        }
                        ?>
                    </div>
                </a>

            <?php endforeach; ?>

        </div>
        <?php
        $this->widget_end($args);
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

}
