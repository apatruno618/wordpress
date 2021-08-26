<?php

namespace ShapedPlugin\WPTeam\Admin\Configs;

use ShapedPlugin\WPTeam\Traits\Singleton;
use ShapedPlugin\WPTeam\Admin\Framework\Classes\SPF_TEAM;
use ShapedPlugin\WPTeam\Admin\Configs\Settings\SPTP_Accessibility;
use ShapedPlugin\WPTeam\Admin\Configs\Settings\SPTP_Advance;
use ShapedPlugin\WPTeam\Admin\Configs\Settings\SPTP_Rename;
use ShapedPlugin\WPTeam\Admin\Configs\Settings\SPTP_SinglePage;
use ShapedPlugin\WPTeam\Admin\Configs\Settings\SPTP_SettingsStyle;
if ( ! defined( 'ABSPATH' ) ) {
	die; }

class Settings {

	use Singleton;

	public static function metaboxes( $prefix ) {
		SPF_TEAM::createOptions(
			$prefix,
			array(
				'menu_title'              => __( 'Settings', 'team-free' ),
				'show_bar_menu'           => false,
				'menu_slug'               => 'team_settings',
				'menu_parent'             => 'edit.php?post_type=sptp_member',
				'framework_title'         => __( 'Settings', 'team-free' ),
				'menu_type'               => 'submenu',
				'admin_bar_menu_priority' => 5,
				'show_search'             => false,
				'show_all_options'        => false,
				'show_reset_section'      => true,
				'show_footer'             => false,
				'theme'                   => 'light',
				'framework_class'         => 'sptp-option-settings',
			)
		);
		SPTP_Advance::section( $prefix );
		SPTP_SettingsStyle::section( $prefix );
		SPTP_Rename::section( $prefix );
		SPTP_Accessibility::section( $prefix );
		SPTP_SinglePage::section( $prefix );
	}
}
