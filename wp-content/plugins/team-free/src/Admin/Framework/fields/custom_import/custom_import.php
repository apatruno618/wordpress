<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: Custom_import
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'TEAMFW_Field_custom_import' ) ) {
	class TEAMFW_Field_custom_import extends TEAMFW_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}
		public function render() {
			echo $this->field_before();
			$sptp_member        = admin_url( 'edit.php?post_type=sptp_member' );
			$sptp_shortcodelink = admin_url( 'edit.php?post_type=sptp_generator' );
				echo '<p><input type="file" id="import" accept=".json"></p>';
				echo '<p><button type="button" class="import">Import</button></p>';
				echo '<a id="sptp_shortcode_link_redirect" href="' . $sptp_shortcodelink . '"></a>';
				echo '<a id="sptp_member_link_redirect" href="' . $sptp_member . '"></a>';
			echo $this->field_after();
		}
	}
}
