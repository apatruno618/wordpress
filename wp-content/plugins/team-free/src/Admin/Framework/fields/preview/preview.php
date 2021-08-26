<?php
if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.
/**
 *
 * Field: shortcode
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'TEAMFW_Field_preview' ) ) {
	class TEAMFW_Field_preview extends TEAMFW_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}
		public function render() {
			// $post_id = get_the_ID();
			echo '<div class="sp__team-preview-box"><div id="sp__team-preview-box"></div></div>';
			// echo '<div class="spsp-preview-box"><h3 class="pcp-sc-title">Preview</h3><div id="spsp-preview-box"></div></div>';

			// echo '<div class="pcp-scode" style="width:90%;margin: 30px auto;">' . do_shortcode( '[smart_post_show id="' . $post_id . '"]' ) . '</div>';
			// Get the Post ID.
			/*
			 echo ( ! empty( $post_id ) ) ? '<div class="pcp-scode-wrap"><span class="pcp-sc-title">Shortcode:</span><span class="pcp-shortcode-selectable">[smart_post_show id="' . $post_id . '"]</span></div><div class="pcp-scode-wrap"><span class="pcp-sc-title">Template Include:</span><span class="pcp-shortcode-selectable">&lt;?php echo do_shortcode(\'[smart_post_show id="' . $post_id . '"]\'); ?&gt;</span></div>' : '';
			echo ( ! empty( $post_id ) ) ? '<div class="pcp-scode-wrap-side"><h3 class="pcp-sc-title">Shortcode</h3> <p>Copy and paste this shortcode into your posts, pages or block editor:</p><span class="pcp-shortcode-selectable">[smart_post_show id="' . $post_id . '"]</span> <button class="pcp-copy"><div class="pcp-tooltip">Copy</div><i class="fa fa-clone"></i></button></div><div class="pcp-scode-wrap-side"><h3 class="pcp-sc-title">Template Include</h3><p>Paste the PHP code into your template file:</p><span class="pcp-shortcode-selectable">&lt;?php echo do_shortcode(\'[smart_post_show id="' . $post_id . '"]\'); ?&gt;</span> <button class="pcp-copy"><i class="fa fa-clone"></i><div class="pcp-tooltip">Copy</div></button></div>' : '';
			*/
		}

	}
}
