<?php
/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the plugin Settings page.
 *
 * @package Genesis Login modal box
 * @subpackage Admin
 *
 * @since 1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register a metabox and default settings for the Genesis Simple Logo.
 *
 * @package Genesis\Admin
 */
class WPSTUDIO_Glmb_Settings extends Genesis_Admin_Boxes {
	/**
	 * Create an archive settings admin menu item and settings page for relevant custom post types.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$settings_field   = 'glmb-settings';
		$page_id          = 'glmb';
		$menu_ops         = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Genesis login modal box - Settings', 'wpstudio-login-modal-box' ),
				'menu_title'  => __( 'Login modal box', 'wpstudio-login-modal-box' ),
			),
		);
		$page_ops         = array(); // use defaults.
		$center           = current_theme_supports( 'genesis-responsive-viewport' ) ? 'mobile' : 'never';
		$default_settings = apply_filters(
			'glmb_settings_defaults',
			array(
				'glmb_loginurl'  => '',
				'glmb_logouturl' => '',
				'glmb_title'     => __( 'Sign in to your account', 'wpstudio-login-modal-box' ),
				'glmb_position'  => 'none',
			)
		);
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitizer_filters' ) );
	}
	/**
	 * Register each of the settings with a sanitization filter type.
	 *
	 * @since 1.0.0
	 *
	 * @uses genesis_add_option_filter() Assign filter to array of settings.
	 *
	 * @see \Genesis_Settings_Sanitizer::add_filter()
	 */
	public function sanitizer_filters() {
		genesis_add_option_filter(
			'no_html',
			$this->settings_field,
			array(
				'glmb_loginurl',
				'glmb_logouturl',
				'glmb_title',
				'glmb_position',
			)
		);
	}

	function metaboxes() {
		add_meta_box( 'genesis-theme-settings-version', __( 'Information', 'wpstudio-login-modal-box' ), array( $this, 'info_box' ), $this->pagehook, 'main', 'high' );
		add_meta_box( 'glmb-settings', __( 'Plugin Settings', 'wpstudio-login-modal-box' ), array( $this, 'glmb_settings' ), $this->pagehook, 'main', 'high' );
	}

	function info_box() {

		echo '<ul>
		<li><strong style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;">' . __( 'Developed By', 'wpstudio-login-modal-box' ) . ':</strong> <a href="http://www.frankschrijvers.com" target="_blank">Frank Schrijvers</a></li>
		<li><strong style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;">' . __( 'Website', 'wpstudio-login-modal-box' ) . ':</strong> <a href="https://www.wpstud.io" target="_blank">www.wpstud.io</a></li>
		<li><strong style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;">' . __( 'Contact', 'wpstudio-login-modal-box' ) . ':</strong> <a href="mailto:info@wpstud.io">info@wpstud.io</a></li>
		</ul>';
	}

	function glmb_settings() {

		?>

		<p>
			<label style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;" for="<?php echo $this->get_field_name( 'glmb_loginurl' ); ?>"><?php _e( 'Page after login', 'wpstudio-login-modal-box' ); ?></label>
			<input type="text" data-default-color="#ffffff" name="<?php echo $this->get_field_name( 'glmb_loginurl' );?>" id="<?php echo $this->get_field_id( 'glmb_loginurl' );?>?" value="<?php echo $this->get_field_value( 'glmb_loginurl' ); ?>" />
		</p>

		<p>
			<label style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;" for="<?php echo $this->get_field_name( 'glmb_logouturl' ); ?>"><?php _e( 'Page after logout', 'wpstudio-login-modal-box' ); ?></label>
			<input type="text" data-default-color="#ffffff" name="<?php echo $this->get_field_name( 'glmb_logouturl' );?>" id="<?php echo $this->get_field_id( 'glmb_logouturl' );?>?" value="<?php echo $this->get_field_value( 'glmb_logouturl' ); ?>" />
		</p>
		<p>
			<label style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;" for="<?php echo $this->get_field_name( 'glmb_title' ); ?>"><?php _e( 'Header title', 'wpstudio-login-modal-box' ); ?></label>
			<input type="text" data-default-color="#ffffff" name="<?php echo $this->get_field_name( 'glmb_title' );?>" id="<?php echo $this->get_field_id( 'glmb_title' );?>?" value="<?php echo $this->get_field_value( 'glmb_title' ); ?>" />
		</p>

		<p>
			<label style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;" for="<?php echo $this->get_field_name( 'glmb_position' ); ?>"><?php _e( 'Add to navigation', 'wpstudio-login-modal-box' ); ?>:</label>
			<select name="<?php echo $this->get_field_name( 'glmb_position' ); ?>">
				<?php
				$positions = array( 'primary', 'secondary', 'none' );
				foreach ( $positions as $position ) {

					echo '<option value="' . $position . '"' . selected( $this->get_field_value( 'glmb_position' ), 'trigger-' . $position ) . '>' . $position . '</option>';
				}
				?>
			</select>

		</p>

		<?php
	}

}
