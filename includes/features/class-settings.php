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
		add_settings_section( 'pergamon_schema_section', 'Schema Settings', array( $this, 'render_section_desc' ), 'pergamon-settings' );
		add_settings_field( 'schema_mode', 'Schema Mode', array( $this, 'render_schema_field' ), 'pergamon-settings', 'pergamon_schema_section' );

		// General Section
		add_settings_section( 'pergamon_general_section', 'Floating Menu Settings', null, 'pergamon-settings' );
		
		add_settings_field( 'enable_floating_menu', 'Enable', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_general_section', array( 'label' => 'Enable Floating Menu' ) );
		add_settings_field( 'floating_menu_position', 'Position', array( $this, 'render_select' ), 'pergamon-settings', 'pergamon_general_section', array( 'options' => array( 'bottom-right' => 'Bottom Right', 'bottom-left' => 'Bottom Left', 'top-right' => 'Top Right', 'top-left' => 'Top Left' ) ) );
		add_settings_field( 'floating_menu_size', 'Size (px)', array( $this, 'render_text' ), 'pergamon-settings', 'pergamon_general_section', array( 'name' => 'floating_menu_size', 'placeholder' => '50' ) );
		add_settings_field( 'floating_menu_color', 'Color', array( $this, 'render_color' ), 'pergamon-settings', 'pergamon_general_section' );
		add_settings_field( 'floating_menu_icon', 'Icon (Emoji/SVG)', array( $this, 'render_text' ), 'pergamon-settings', 'pergamon_general_section', array( 'name' => 'floating_menu_icon', 'placeholder' => '+' ) );
		
		// Repeater Field
		add_settings_field( 'floating_menu_items', 'Menu Items', array( $this, 'render_repeater_field' ), 'pergamon-settings', 'pergamon_general_section' );
	}

	public function sanitize_settings( array $input ): array {
		$output = array();
		$output['schema_mode'] = isset( $input['schema_mode'] ) && in_array( $input['schema_mode'], array( 'auto', 'on', 'off' ), true ) ? $input['schema_mode'] : 'auto';
		$output['enable_floating_menu'] = isset( $input['enable_floating_menu'] ) ? '1' : '0';
		
		$output['floating_menu_position'] = isset( $input['floating_menu_position'] ) ? sanitize_text_field( $input['floating_menu_position'] ) : 'bottom-right';
		$output['floating_menu_size'] = isset( $input['floating_menu_size'] ) ? absint( $input['floating_menu_size'] ) : 50;
		$output['floating_menu_color'] = isset( $input['floating_menu_color'] ) ? sanitize_hex_color( $input['floating_menu_color'] ) : '#1A2B4C';
		$output['floating_menu_icon'] = isset( $input['floating_menu_icon'] ) ? sanitize_text_field( $input['floating_menu_icon'] ) : '+';

		// Sanitize Repeater
		$output['floating_menu_items'] = array();
		if ( isset( $input['floating_menu_items'] ) && is_array( $input['floating_menu_items'] ) ) {
			foreach ( $input['floating_menu_items'] as $item ) {
				if ( ! empty( $item['title'] ) || ! empty( $item['url'] ) ) {
					$output['floating_menu_items'][] = array(
						'title' => sanitize_text_field( $item['title'] ?? '' ),
						'url'   => esc_url_raw( $item['url'] ?? '' ),
					);
				}
			}
		}

		return $output;
	}

	public function render_section_desc(): void { echo '<p>Configure structured data.</p>'; }
	
	public function render_schema_field(): void {
		$options = get_option( 'pergamon_settings', array() );
		$mode    = isset( $options['schema_mode'] ) ? $options['schema_mode'] : 'auto';
		?>
		<select name="pergamon_settings[schema_mode]">
			<option value="auto" <?php selected( $mode, 'auto' ); ?>>Auto</option>
			<option value="on" <?php selected( $mode, 'on' ); ?>>Always On</option>
			<option value="off" <?php selected( $mode, 'off' ); ?>>Always Off</option>
		</select>
		<?php
	}

	public function render_checkbox( array $args ): void {
		$options = get_option( 'pergamon_settings', array() );
		$val = isset( $options['enable_floating_menu'] ) ? $options['enable_floating_menu'] : '0';
		echo '<label><input type="checkbox" name="pergamon_settings[enable_floating_menu]" value="1" ' . checked( '1', $val, false ) . '> ' . esc_html( $args['label'] ) . '</label>';
	}

	public function render_select( array $args ): void {
		$options = get_option( 'pergamon_settings', array() );
		$val = isset( $options['floating_menu_position'] ) ? $options['floating_menu_position'] : 'bottom-right';
		echo '<select name="pergamon_settings[floating_menu_position]">';
		foreach ( $args['options'] as $k => $v ) {
			echo '<option value="' . esc_attr( $k ) . '" ' . selected( $val, $k, false ) . '>' . esc_html( $v ) . '</option>';
		}
		echo '</select>';
	}

	public function render_text( array $args ): void {
		$options = get_option( 'pergamon_settings', array() );
		$name = $args['name'];
		$val = isset( $options[ $name ] ) ? $options[ $name ] : $args['placeholder'];
		echo '<input type="text" name="pergamon_settings[' . esc_attr( $name ) . ']" value="' . esc_attr( $val ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '">';
	}

	public function render_color(): void {
		$options = get_option( 'pergamon_settings', array() );
		$val = isset( $options['floating_menu_color'] ) ? $options['floating_menu_color'] : '#1A2B4C';
		echo '<input type="color" name="pergamon_settings[floating_menu_color]" value="' . esc_attr( $val ) . '">';
	}

	public function render_repeater_field(): void {
		$options = get_option( 'pergamon_settings', array() );
		$items = isset( $options['floating_menu_items'] ) ? $options['floating_menu_items'] : array( array( 'title' => 'Home', 'url' => '/' ), array( 'title' => 'Back to Top', 'url' => '#' ) );
		?>
		<div id="pergamon-repeater-container" style="display:flex; flex-direction:column; gap:10px; max-width:600px;">
			<?php foreach ( $items as $index => $item ) : ?>
				<div class="pergamon-repeater-row" style="display:flex; gap:10px; align-items:center;">
					<input type="text" name="pergamon_settings[floating_menu_items][<?php echo $index; ?>][title]" value="<?php echo esc_attr( $item['title'] ); ?>" placeholder="Title" style="flex:1;">
					<input type="text" name="pergamon_settings[floating_menu_items][<?php echo $index; ?>][url]" value="<?php echo esc_attr( $item['url'] ); ?>" placeholder="URL" style="flex:2;">
					<button type="button" class="button pergamon-move-up" style="cursor:pointer;">↑</button>
					<button type="button" class="button pergamon-move-down" style="cursor:pointer;">↓</button>
					<button type="button" class="button pergamon-remove-row" style="color:red; cursor:pointer;">🗑️</button>
				</div>
			<?php endforeach; ?>
		</div>
		<p><button type="button" class="button button-primary" id="pergamon-add-row">+ Add Item</button></p>
		
		<script type="text/template" id="pergamon-row-template">
			<div class="pergamon-repeater-row" style="display:flex; gap:10px; align-items:center;">
				<input type="text" name="pergamon_settings[floating_menu_items][__index__][title]" value="" placeholder="Title" style="flex:1;">
				<input type="text" name="pergamon_settings[floating_menu_items][__index__][url]" value="" placeholder="URL" style="flex:2;">
				<button type="button" class="button pergamon-move-up" style="cursor:pointer;">↑</button>
				<button type="button" class="button pergamon-move-down" style="cursor:pointer;">↓</button>
				<button type="button" class="button pergamon-remove-row" style="color:red; cursor:pointer;">🗑️</button>
			</div>
		</script>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				let rowIndex = <?php echo count( $items ); ?>;
				const container = document.getElementById('pergamon-repeater-container');
				const template = document.getElementById('pergamon-row-template').innerHTML;

				document.getElementById('pergamon-add-row').addEventListener('click', function() {
					const html = template.replace(/__index__/g, rowIndex);
					const tempDiv = document.createElement('div');
					tempDiv.innerHTML = html;
					container.appendChild(tempDiv.firstElementChild);
					rowIndex++;
				});

				container.addEventListener('click', function(e) {
					const target = e.target;
					const row = target.closest('.pergamon-repeater-row');
					if (!row) return;

					if (target.classList.contains('pergamon-remove-row')) {
						row.remove();
					} else if (target.classList.contains('pergamon-move-up')) {
						if (row.previousElementSibling) {
							row.parentNode.insertBefore(row, row.previousElementSibling);
						}
					} else if (target.classList.contains('pergamon-move-down')) {
						if (row.nextElementSibling) {
							row.parentNode.insertBefore(row.nextElementSibling, row);
						}
					}
				});
			});
		</script>
		<?php
	}

	public function render_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) return;
		?>
		<div class="wrap">
			<h1>Pergamon Settings</h1>
			<form action="options.php" method="post">
				<?php settings_fields( 'pergamon_settings_group' ); do_settings_sections( 'pergamon-settings' ); submit_button(); ?>
			</form>
		</div>
		<?php
	}
}
