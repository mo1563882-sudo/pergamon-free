<?php
/**
 * Admin Settings page for Pergamon.
 * Final comprehensive version for all Free features.
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

		// 1. Schema & SEO Tab
		add_settings_section( 'pergamon_schema_section', 'SEO Settings', null, 'pergamon-settings' );
		add_settings_field( 'schema_mode', 'Schema Mode', array( $this, 'render_schema_field' ), 'pergamon-settings', 'pergamon_schema_section' );
		add_settings_field( 'enable_og_tags', 'Enable Open Graph & Twitter Cards', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_schema_section', array( 'name' => 'enable_og_tags', 'label' => 'Enable Meta Tags' ) );
		add_settings_field( 'enable_canonical', 'Enable Canonical Tags', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_schema_section', array( 'name' => 'enable_canonical', 'label' => 'Enable Canonical' ) );

		// 2. Floating Menu Tab
		add_settings_section( 'pergamon_floating_section', 'Floating Menu Settings', null, 'pergamon-settings' );
		add_settings_field( 'enable_floating_menu', 'Enable', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'enable_floating_menu', 'label' => 'Enable Floating Menu' ) );
		add_settings_field( 'floating_menu_title', 'Menu Title', array( $this, 'render_text' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'floating_menu_title', 'placeholder' => 'Quick Links' ) );
		add_settings_field( 'floating_menu_position', 'Position', array( $this, 'render_select' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'floating_menu_position', 'options' => array( 'bottom-right' => 'Bottom Right', 'bottom-left' => 'Bottom Left', 'top-right' => 'Top Right', 'top-left' => 'Top Left' ) ) );
		add_settings_field( 'floating_menu_size', 'Size (px)', array( $this, 'render_text' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'floating_menu_size', 'placeholder' => '50' ) );
		add_settings_field( 'floating_menu_color', 'Color', array( $this, 'render_color' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'floating_menu_color' ) );
		add_settings_field( 'floating_menu_icon', 'Icon (Emoji/SVG)', array( $this, 'render_text' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'floating_menu_icon', 'placeholder' => '+' ) );
		add_settings_field( 'floating_menu_items', 'Menu Items', array( $this, 'render_repeater_field' ), 'pergamon-settings', 'pergamon_floating_section' );

		// 3. Ads Tab
		add_settings_section( 'pergamon_ads_section', 'Advertisements', null, 'pergamon-settings' );
		add_settings_field( 'ad_sticky_top', 'Sticky Top Ad (HTML/JS)', array( $this, 'render_textarea' ), 'pergamon-settings', 'pergamon_ads_section', array( 'name' => 'ad_sticky_top' ) );
		add_settings_field( 'ad_content_top', 'Ad After Title', array( $this, 'render_textarea' ), 'pergamon-settings', 'pergamon_ads_section', array( 'name' => 'ad_content_top' ) );
		add_settings_field( 'ad_content_paragraph', 'Ad After First Paragraph', array( $this, 'render_textarea' ), 'pergamon-settings', 'pergamon_ads_section', array( 'name' => 'ad_content_paragraph' ) );

		// 4. Layout Tab
		add_settings_section( 'pergamon_layout_section', 'Layout Settings', null, 'pergamon-settings' );
		add_settings_field( 'sidebar_position', 'Sidebar Position', array( $this, 'render_select' ), 'pergamon-settings', 'pergamon_layout_section', array( 'name' => 'sidebar_position', 'options' => array( 'right' => 'Right', 'left' => 'Left', 'none' => 'None' ) ) );
		add_settings_field( 'enable_sticky_header', 'Sticky Header', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_layout_section', array( 'name' => 'enable_sticky_header', 'label' => 'Enable Sticky Navigation' ) );
	}

	public function sanitize_settings( array $input ): array {
		$output = array();
		
		// SEO
		$output['schema_mode'] = in_array( $input['schema_mode'] ?? '', array( 'auto', 'on', 'off' ), true ) ? $input['schema_mode'] : 'auto';
		$output['enable_og_tags'] = isset( $input['enable_og_tags'] ) ? '1' : '0';
		$output['enable_canonical'] = isset( $input['enable_canonical'] ) ? '1' : '0';

		// Floating Menu
		$output['enable_floating_menu'] = isset( $input['enable_floating_menu'] ) ? '1' : '0';
		$output['floating_menu_title'] = sanitize_text_field( $input['floating_menu_title'] ?? 'Quick Links' );
		$output['floating_menu_position'] = sanitize_text_field( $input['floating_menu_position'] ?? 'bottom-right' );
		$output['floating_menu_size'] = absint( $input['floating_menu_size'] ?? 50 );
		$output['floating_menu_color'] = sanitize_hex_color( $input['floating_menu_color'] ?? '#1A2B4C' );
		$output['floating_menu_icon'] = sanitize_text_field( $input['floating_menu_icon'] ?? '+' );
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

		// Ads (Allow HTML/JS, so use wp_kses_post or raw depending on user trust. We'll use wp_kses_post for safety)
		$output['ad_sticky_top'] = wp_kses_post( $input['ad_sticky_top'] ?? '' );
		$output['ad_content_top'] = wp_kses_post( $input['ad_content_top'] ?? '' );
		$output['ad_content_paragraph'] = wp_kses_post( $input['ad_content_paragraph'] ?? '' );

		// Layout
		$output['sidebar_position'] = sanitize_text_field( $input['sidebar_position'] ?? 'right' );
		$output['enable_sticky_header'] = isset( $input['enable_sticky_header'] ) ? '1' : '0';

		return $output;
	}

	// --- Renderers ---
	public function render_schema_field(): void {
		$options = get_option( 'pergamon_settings', array() );
		$mode    = $options['schema_mode'] ?? 'auto';
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
		$val = $options[ $args['name'] ] ?? '0';
		echo '<label><input type="checkbox" id="' . esc_attr( $args['name'] ) . '" name="pergamon_settings[' . esc_attr( $args['name'] ) . ']" value="1" ' . checked( '1', $val, false ) . '> ' . esc_html( $args['label'] ) . '</label>';
	}

	public function render_select( array $args ): void {
		$options = get_option( 'pergamon_settings', array() );
		$val = $options[ $args['name'] ] ?? '';
		echo '<select name="pergamon_settings[' . esc_attr( $args['name'] ) . ']">';
		foreach ( $args['options'] as $k => $v ) {
			echo '<option value="' . esc_attr( $k ) . '" ' . selected( $val, $k, false ) . '>' . esc_html( $v ) . '</option>';
		}
		echo '</select>';
	}

	public function render_text( array $args ): void {
		$options = get_option( 'pergamon_settings', array() );
		$val = $options[ $args['name'] ] ?? $args['placeholder'];
		echo '<input type="text" name="pergamon_settings[' . esc_attr( $args['name'] ) . ']" value="' . esc_attr( $val ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '">';
	}

	public function render_color( array $args ): void {
		$options = get_option( 'pergamon_settings', array() );
		$val = $options[ $args['name'] ] ?? '#1A2B4C';
		echo '<input type="color" name="pergamon_settings[' . esc_attr( $args['name'] ) . ']" value="' . esc_attr( $val ) . '">';
	}

	public function render_textarea( array $args ): void {
		$options = get_option( 'pergamon_settings', array() );
		$val = $options[ $args['name'] ] ?? '';
		echo '<textarea name="pergamon_settings[' . esc_attr( $args['name'] ) . ']" rows="4" style="width:100%; max-width:500px;">' . esc_textarea( $val ) . '</textarea>';
	}

	public function render_repeater_field(): void {
		$options = get_option( 'pergamon_settings', array() );
		$items = $options['floating_menu_items'] ?? array();
		?>
		<div id="pergamon-floating-menu-settings">
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
		</div>
		<?php
	}

	public function render_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) return;
		?>
		<div class="wrap">
			<h1>Pergamon Settings</h1>
			<h2 class="nav-tab-wrapper">
				<a href="#schema" class="nav-tab nav-tab-active" data-target="pergamon-schema">SEO</a>
				<a href="#floating" class="nav-tab" data-target="pergamon-floating">Floating Menu</a>
				<a href="#ads" class="nav-tab" data-target="pergamon-ads">Ads</a>
				<a href="#layout" class="nav-tab" data-target="pergamon-layout">Layout</a>
			</h2>
			<form action="options.php" method="post">
				<?php settings_fields( 'pergamon_settings_group' ); ?>
				
				<div id="pergamon-schema" class="pergamon-tab-content active">
					<?php do_settings_sections( 'pergamon-settings' ); ?>
				</div>
				
				<div id="pergamon-floating" class="pergamon-tab-content">
					<?php do_settings_sections( 'pergamon-settings' ); ?>
				</div>

				<div id="pergamon-ads" class="pergamon-tab-content">
					<?php do_settings_sections( 'pergamon-settings' ); ?>
				</div>

				<div id="pergamon-layout" class="pergamon-tab-content">
					<?php do_settings_sections( 'pergamon-settings' ); ?>
				</div>
				
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}
