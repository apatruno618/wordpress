<?php
namespace ShapedPlugin\WPTeam\Admin\Preview;

use ShapedPlugin\WPTeam\Frontend\Helper;
/**
 * The admin preview.
 *
 * @link        https://smartpostshow.com/
 * @since      2.1.4
 *
 * @package    WP_Team_free
 * @subpackage WP_Team_free/admin
 */

/**
 * The admin preview.
 *
 * @package    WP_Team_free
 * @subpackage WP_Team_free/admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class SPTP_Preview {

	/**
	 * Script and style suffix
	 *
	 * @since 2.1.4
	 * @access protected
	 * @var string
	 */
	protected $suffix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.1.4
	 */
	public function __construct() {
		$this->sp_team_preview_action();
	}

	/**
	 * Public Action
	 *
	 * @return void
	 */
	private function sp_team_preview_action() {
		// admin Preview.
		add_action( 'wp_ajax_sptp_preview_meta_box', array( $this, 'sp_team_backend_preview' ) );
	}


	/**
	 * Function Team Backed preview.
	 *
	 * @since 3.2.5
	 */
	public function sp_team_backend_preview() {
		$nonce = isset( $_POST['ajax_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['ajax_nonce'] ) ) : '';
		if ( ! wp_verify_nonce( $nonce, 'spf_metabox_nonce' ) ) {
			return;
		}
		$setting = array();
		$data    = ! empty( $_POST['data'] ) ?
			wp_unslash( $_POST['data'] ) // phpcs:ignore
		: '';
		parse_str( $data, $setting );
		$setting       = array_map( 'wp_kses_post_deep', $setting );
		$team_settings = get_option( '_sptp_settings' );
		// Shortcode id.
		$generator_ids = $setting['post_ID'];
		// Preset Layouts.
		$layout                = $setting['_sptp_generator_layout'];
		$settings              = $setting['_sptp_generator'];
		$preview_section_title = $setting['post_title'];

		ob_start();
		echo '<style>';
		$generator_id = $generator_ids;
		$final_css    = '';
		include SPT_PLUGIN_PATH . 'src/Frontend/partials/dynamic-css-settings.php';
		include SPT_PLUGIN_PATH . 'src/Frontend/partials/dynamic-style.php';
		echo esc_html( $final_css );
		echo '</style>';
		Helper::sptp_html_show( $generator_ids, $layout, $settings, $preview_section_title, false );
		die();
	}
}
