<?php
/**
 * Admin Settings page for Pergamon.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Settings {

	public function register(): void {
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	public function add_menu(): void {
		add_menu_page(
			'Pergamon Settings',
			'Pergamon',
			'manage_options',
			'pergamon-settings',
			array( $this, 'render_page' ),
			'dashicons-admin-generic',
			60
		);
	}

	public function register_settings(): void {
		register_setting( 'pergamon_settings_group', 'pergamon_settings', array( $this, 'sanitize_settings' ) );

		// Schema Section
		add_settings_section(
			'pergamon_schema_section',
			'Schema Settings',
			array( $this, 'render_section_desc' ),
			'pergamon-settings'
		);

		add_settings_field(
			'schema_mode',
			'Schema Mode',
			array( $this, 'render_schema_field' ),
			'pergamon-settings',
			'pergamon_schema_section'
		);

		// General Section
		add_settings_section(
			'pergamon_general_section',
			'General Settings',
			null,
			'pergamon-settings'
		);

		add_settings_field(
			'enable_floating_menu',
			'Floating Menu',
			array( $this, 'render_floating_menu_field' ),
			'pergamon-settings',
			'pergamon_general_section'
		);
	}

	public function sanitize_settings( array $input ): array {
		$output = array();

		// Schema
		if ( isset( $input['schema_mode'] ) && in_array( $input['schema_mode'], array( 'auto', 'on', 'off' ), true ) ) {
			$output['schema_mode'] = $input['schema_mode'];
		} else {
			$output['schema_mode'] = 'auto';
		}

		// Floating Menu
		$output['enable_floating_menu'] = isset( $input['enable_floating_menu'] ) ? '1' : '0';

		return $output;
	}

	public function render_section_desc(): void {
		echo '<p>Configure how Pergamon handles Structured Data (JSON-LD).</p>';
	}

	public function render_schema_field(): void {
		$options = get_option( 'pergamon_settings', array() );
		$mode    = isset( $options['schema_mode'] ) ? $options['schema_mode'] : 'auto';
		?>
		<select name="pergamon_settings[schema_mode]">
			<option value="auto" <?php selected( $mode, 'auto' ); ?>>Auto (Detect SEO plugins)</option>
			<option value="on" <?php selected( $mode, 'on' ); ?>>Always On</option>
			<option value="off" <?php selected( $mode, 'off' ); ?>>Always Off</option>
		</select>
		<p class="description">Auto: Outputs schema only if no SEO plugin is active.</p>
		<?php
	}

	public function render_floating_menu_field(): void {
		$options = get_option( 'pergamon_settings', array() );
		$enabled = isset( $options['enable_floating_menu'] ) ? $options['enable_floating_menu'] : '0';
		?>
		<label>
			<input type="checkbox" name="pergamon_settings[enable_floating_menu]" value="1" <?php checked( $enabled, '1' ); ?>>
			Enable Floating Menu
		</label>
		<p class="description">Displays a unified floating action button on the frontend.</p>
		<?php
	}

	public function render_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		?>
		<div class="wrap">
			<h1>Pergamon Settings</h1>
			<form action="options.php" method="post">
				<?php
				settings_fields( 'pergamon_settings_group' );
				do_settings_sections( 'pergamon-settings' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}
}
