<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'TEAMFW_Field_icon' ) ) {
  class TEAMFW_Field_icon extends TEAMFW_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'team-free' ),
        'remove_title' => esc_html__( 'Remove Icon', 'team-free' ),
      ) );

      echo $this->field_before();

      $nonce  = wp_create_nonce( 'spf_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="spf-icon-select">';
      echo '<span class="spf-icon-preview'. esc_attr( $hidden ) .'"><i class="'. esc_attr( $this->value ) .'"></i></span>';
      echo '<a href="#" class="button button-primary spf-icon-add" data-nonce="'. esc_attr( $nonce ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button spf-warning-primary spf-icon-remove'. esc_attr( $hidden ) .'">'. $args['remove_title'] .'</a>';
      echo '<input type="text" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'" class="spf-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo $this->field_after();

    }

    public function enqueue() {
      add_action( 'admin_footer', array( &$this, 'add_footer_modal_icon' ) );
      add_action( 'customize_controls_print_footer_scripts', array( &$this, 'add_footer_modal_icon' ) );
    }

    public function add_footer_modal_icon() {
    ?>
      <div id="spf-modal-icon" class="spf-modal spf-modal-icon hidden">
        <div class="spf-modal-table">
          <div class="spf-modal-table-cell">
            <div class="spf-modal-overlay"></div>
            <div class="spf-modal-inner">
              <div class="spf-modal-title">
                <?php esc_html_e( 'Add Icon', 'team-free' ); ?>
                <div class="spf-modal-close spf-icon-close"></div>
              </div>
              <div class="spf-modal-header">
                <input type="text" placeholder="<?php esc_html_e( 'Search...', 'team-free' ); ?>" class="spf-icon-search" />
              </div>
              <div class="spf-modal-content">
                <div class="spf-modal-loading"><div class="spf-loading"></div></div>
                <div class="spf-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

  }
}
