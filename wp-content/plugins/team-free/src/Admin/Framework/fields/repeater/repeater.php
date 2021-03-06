<?php
use ShapedPlugin\WPTeam\Admin\Framework\Classes\SPF_TEAM;
if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: repeater
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'TEAMFW_Field_repeater' ) ) {
	class TEAMFW_Field_repeater extends TEAMFW_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'max'          => 0,
					'min'          => 0,
					'button_title' => '<i class="fas fa-plus-circle"></i>',
				)
			);

			if ( preg_match( '/' . preg_quote( '[' . $this->field['id'] . ']' ) . '/', $this->unique ) ) {

				echo '<div class="spf-notice spf-notice-danger">' . esc_html__( 'Error: Field ID conflict.', 'team-free' ) . '</div>';

			} else {

				echo $this->field_before();

				echo '<div class="spf-repeater-item spf-repeater-hidden" data-depend-id="' . esc_attr( $this->field['id'] ) . '">';
				echo '<div class="spf-repeater-content">';
				foreach ( $this->field['fields'] as $field ) {

					$field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';
					$field_unique  = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $this->field['id'] . '][0]' : $this->field['id'] . '[0]';

					SPF_TEAM::field( $field, $field_default, '___' . $field_unique, 'field/repeater' );

				}
				echo '</div>';
				echo '<div class="spf-repeater-helper">';
				echo '<div class="spf-repeater-helper-inner">';
				echo '<i class="spf-repeater-sort fas fa-arrows-alt"></i>';
				echo '<i class="spf-repeater-clone far fa-clone"></i>';
				echo '<i class="spf-repeater-remove spf-confirm fas fa-times" data-confirm="' . esc_html__( 'Are you sure to delete this item?', 'team-free' ) . '"></i>';
				echo '</div>';
				echo '</div>';
				echo '</div>';

				echo '<div class="spf-repeater-wrapper spf-data-wrapper" data-field-id="[' . esc_attr( $this->field['id'] ) . ']" data-max="' . esc_attr( $args['max'] ) . '" data-min="' . esc_attr( $args['min'] ) . '">';

				if ( ! empty( $this->value ) && is_array( $this->value ) ) {

					$num = 0;

					foreach ( $this->value as $key => $value ) {

						echo '<div class="spf-repeater-item">';
						echo '<div class="spf-repeater-content">';
						foreach ( $this->field['fields'] as $field ) {

							  $field_unique = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $this->field['id'] . '][' . $num . ']' : $this->field['id'] . '[' . $num . ']';
							  $field_value  = ( isset( $field['id'] ) && isset( $this->value[ $key ][ $field['id'] ] ) ) ? $this->value[ $key ][ $field['id'] ] : '';

							  SPF_TEAM::field( $field, $field_value, $field_unique, 'field/repeater' );

						}
						echo '</div>';
						echo '<div class="spf-repeater-helper">';
						echo '<div class="spf-repeater-helper-inner">';
						echo '<i class="spf-repeater-sort fas fa-arrows-alt"></i>';
						echo '<i class="spf-repeater-clone far fa-clone"></i>';
						echo '<i class="spf-repeater-remove spf-confirm fas fa-times" data-confirm="' . esc_html__( 'Are you sure to delete this item?', 'team-free' ) . '"></i>';
						echo '</div>';
						echo '</div>';
						echo '</div>';

						$num++;

					}
				}

				echo '</div>';

				echo '<div class="spf-repeater-alert spf-repeater-max">' . esc_html__( 'You cannot add more.', 'team-free' ) . '</div>';
				echo '<div class="spf-repeater-alert spf-repeater-min">' . esc_html__( 'You cannot remove more.', 'team-free' ) . '</div>';
				echo '<a href="#" class="button button-primary spf-repeater-add">' . $args['button_title'] . '</a>';

				echo $this->field_after();

			}

		}

		public function enqueue() {

			if ( ! wp_script_is( 'jquery-ui-sortable' ) ) {
				wp_enqueue_script( 'jquery-ui-sortable' );
			}

		}

	}
}
