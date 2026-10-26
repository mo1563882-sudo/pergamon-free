<?php
/**
 * Admin Settings page for Pergamon.
 * Handles the Schema mode toggle.
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
	}

	public function sanitize_settings( array $input ): array {
		$output = array();
		if ( isset( $input['schema_mode'] ) && in_array( $input['schema_mode'], array( 'auto', 'on', 'off' ), true ) ) {
			$output['schema_mode'] = $input['schema_mode'];
		} else {
			$output['schema_mode'] = 'auto';
		}
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
		<p class="description">
			<strong>Auto:</strong> Outputs schema only if no SEO plugin (Yoast, RankMath, etc.) is active.<br>
			<strong>Always On:</strong> Forces schema output even if an SEO plugin is active.<br>
			<strong>Always Off:</strong> Disables schema output entirely.
		</p>
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
