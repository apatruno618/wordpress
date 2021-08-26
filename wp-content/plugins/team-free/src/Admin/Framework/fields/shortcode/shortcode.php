<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: Shortcode
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'TEAMFW_Field_shortcode' ) ) {
	class TEAMFW_Field_shortcode extends TEAMFW_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			// global $post;
			// $postid = $post->ID;
			$post_id = get_the_ID();

			if ( empty( $post_id ) ) {
				return 'Post ID not found.';
			}
			echo '<div class="sptp-scode-wrap">
				<span class="sptp-sc-title">Shortcode:</span>
					<span class="sptp-shortcode-selectable">
						[wpteam id="' . esc_html( $post_id ) . '"]
					</span>
				</div>';
			echo '<div class="sptp-scode-wrap">
				<div class="sptp-after-copy-text">
					<i class="fa fa-check-circle"></i> ' . __( 'Shortcode Copied to Clipboard!', 'team-free' ) . '</div>
					<span class="sptp-sc-title">Template Include:</span>
					<span class="sptp-shortcode-selectable">
					&lt;?php echo do_shortcode( \'[wpteam id="' . $post_id . '"]\'); ?&gt;
					</span>
				</div>';
		}
	}

}
