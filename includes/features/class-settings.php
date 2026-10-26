<?php
/**
 * Admin Settings page for Pergamon. Comprehensive version.
 *
 * @package Pergamon
 * @since   0.1.0
 */
declare( strict_types=1 );
namespace Pergamon\Features;
if ( ! defined( 'ABSPATH' ) ) exit;

final class Settings {
	public function register(): void {
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	public function add_menu(): void {
		add_menu_page( 'Pergamon Settings', 'Pergamon', 'manage_options', 'pergamon-settings', array( $this, 'render_page' ), 'dashicons-admin-generic', 60 );
	}

	public function register_settings(): void {
		register_setting( 'pergamon_settings_group', 'pergamon_settings', array( $this, 'sanitize_settings' ) );

		add_settings_section( 'pergamon_features_section', 'Core Features', null, 'pergamon-settings' );
		add_settings_field( 'enable_dark_mode', 'Dark Mode', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_features_section', array( 'name' => 'enable_dark_mode', 'label' => 'Enable Dark Mode Toggle' ) );
		add_settings_field( 'enable_toc', 'Table of Contents', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_features_section', array( 'name' => 'enable_toc', 'label' => 'Enable TOC' ) );
		add_settings_field( 'enable_reading_progress', 'Reading Progress', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_features_section', array( 'name' => 'enable_reading_progress', 'label' => 'Enable Progress Bar' ) );
		add_settings_field( 'enable_search', 'Search Overlay', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_features_section', array( 'name' => 'enable_search', 'label' => 'Enable Search' ) );

		add_settings_section( 'pergamon_schema_section', 'SEO Settings', null, 'pergamon-settings' );
		add_settings_field( 'schema_mode', 'Schema Mode', array( $this, 'render_schema_field' ), 'pergamon-settings', 'pergamon_schema_section' );
		add_settings_field( 'enable_og_tags', 'Meta Tags', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_schema_section', array( 'name' => 'enable_og_tags', 'label' => 'Enable OG & Twitter' ) );
		add_settings_field( 'enable_canonical', 'Canonical', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_schema_section', array( 'name' => 'enable_canonical', 'label' => 'Enable Canonical' ) );
		add_settings_field( 'google_verify', 'Google Verification', array( $this, 'render_text' ), 'pergamon-settings', 'pergamon_schema_section', array( 'name' => 'google_verify', 'placeholder' => '' ) );
		add_settings_field( 'bing_verify', 'Bing Verification', array( $this, 'render_text' ), 'pergamon-settings', 'pergamon_schema_section', array( 'name' => 'bing_verify', 'placeholder' => '' ) );

		add_settings_section( 'pergamon_floating_section', 'Floating Menu', null, 'pergamon-settings' );
		add_settings_field( 'enable_floating_menu', 'Enable', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'enable_floating_menu', 'label' => 'Enable Floating Menu' ) );
		add_settings_field( 'floating_menu_title', 'Title', array( $this, 'render_text' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'floating_menu_title', 'placeholder' => 'Quick Links' ) );
		add_settings_field( 'floating_menu_position', 'Position', array( $this, 'render_select' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'floating_menu_position', 'options' => array( 'bottom-right' => 'Bottom Right', 'bottom-left' => 'Bottom Left', 'top-right' => 'Top Right', 'top-left' => 'Top Left' ) ) );
		add_settings_field( 'floating_menu_size', 'Size', array( $this, 'render_text' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'floating_menu_size', 'placeholder' => '50' ) );
		add_settings_field( 'floating_menu_color', 'Color', array( $this, 'render_color' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'floating_menu_color' ) );
		add_settings_field( 'floating_menu_icon', 'Icon', array( $this, 'render_text' ), 'pergamon-settings', 'pergamon_floating_section', array( 'name' => 'floating_menu_icon', 'placeholder' => '+' ) );
		add_settings_field( 'floating_menu_items', 'Items', array( $this, 'render_repeater_field' ), 'pergamon-settings', 'pergamon_floating_section' );

		add_settings_section( 'pergamon_ads_section', 'Ads', null, 'pergamon-settings' );
		add_settings_field( 'ad_sticky_top', 'Sticky Top', array( $this, 'render_textarea' ), 'pergamon-settings', 'pergamon_ads_section', array( 'name' => 'ad_sticky_top' ) );
		add_settings_field( 'ad_content_top', 'After Title', array( $this, 'render_textarea' ), 'pergamon-settings', 'pergamon_ads_section', array( 'name' => 'ad_content_top' ) );
		add_settings_field( 'ad_content_paragraph', 'After Para', array( $this, 'render_textarea' ), 'pergamon-settings', 'pergamon_ads_section', array( 'name' => 'ad_content_paragraph' ) );

		add_settings_section( 'pergamon_layout_section', 'Layout', null, 'pergamon-settings' );
		add_settings_field( 'sidebar_position', 'Sidebar', array( $this, 'render_select' ), 'pergamon-settings', 'pergamon_layout_section', array( 'name' => 'sidebar_position', 'options' => array( 'right' => 'Right', 'left' => 'Left', 'none' => 'None' ) ) );
		add_settings_field( 'enable_sticky_header', 'Sticky Header', array( $this, 'render_checkbox' ), 'pergamon-settings', 'pergamon_layout_section', array( 'name' => 'enable_sticky_header', 'label' => 'Enable' ) );
	}

	public function sanitize_settings( array $input ): array {
		$output = array();
		$checks = array('enable_dark_mode','enable_toc','enable_reading_progress','enable_search','enable_og_tags','enable_canonical','enable_floating_menu','enable_sticky_header');
		foreach($checks as $c) { $output[$c] = isset($input[$c]) ? '1' : '0'; }
		
		$texts = array('schema_mode','google_verify','bing_verify','floating_menu_title','floating_menu_position','floating_menu_size','floating_menu_color','floating_menu_icon','sidebar_position');
		foreach($texts as $t) { $output[$t] = isset($input[$t]) ? sanitize_text_field($input[$t]) : ''; }
		
		$output['ad_sticky_top'] = wp_kses_post( $input['ad_sticky_top'] ?? '' );
		$output['ad_content_top'] = wp_kses_post( $input['ad_content_top'] ?? '' );
		$output['ad_content_paragraph'] = wp_kses_post( $input['ad_content_paragraph'] ?? '' );

		$output['floating_menu_items'] = array();
		if ( isset( $input['floating_menu_items'] ) && is_array( $input['floating_menu_items'] ) ) {
			foreach ( $input['floating_menu_items'] as $item ) {
				if ( ! empty( $item['title'] ) || ! empty( $item['url'] ) ) {
					$output['floating_menu_items'][] = array( 'title' => sanitize_text_field( $item['title'] ?? '' ), 'url' => esc_url_raw( $item['url'] ?? '' ) );
				}
			}
		}
		return $output;
	}

	public function render_schema_field(): void {
		$o = get_option('pergamon_settings', []); $v = $o['schema_mode'] ?? 'auto';
		echo '<select name="pergamon_settings[schema_mode]"><option value="auto" '.selected($v,'auto',false).'>Auto</option><option value="on" '.selected($v,'on',false).'>Always On</option><option value="off" '.selected($v,'off',false).'>Always Off</option></select>';
	}
	public function render_checkbox( array $a ): void {
		$o = get_option('pergamon_settings', []); $v = $o[$a['name']] ?? '1';
		echo '<label><input type="checkbox" name="pergamon_settings['.$a['name'].']" value="1" '.checked('1',$v,false).'> '.esc_html($a['label']).'</label>';
	}
	public function render_select( array $a ): void {
		$o = get_option('pergamon_settings', []); $v = $o[$a['name']] ?? '';
		echo '<select name="pergamon_settings['.$a['name'].']">';
		foreach($a['options'] as $k=>$lbl) echo '<option value="'.esc_attr($k).'" '.selected($v,$k,false).'>'.esc_html($lbl).'</option>';
		echo '</select>';
	}
	public function render_text( array $a ): void {
		$o = get_option('pergamon_settings', []); $v = $o[$a['name']] ?? '';
		echo '<input type="text" name="pergamon_settings['.$a['name'].']" value="'.esc_attr($v).'" placeholder="'.esc_attr($a['placeholder']).'" style="width:100%;max-width:400px;">';
	}
	public function render_color( array $a ): void {
		$o = get_option('pergamon_settings', []); $v = $o[$a['name']] ?? '#1A2B4C';
		echo '<input type="color" name="pergamon_settings['.$a['name'].']" value="'.esc_attr($v).'">';
	}
	public function render_textarea( array $a ): void {
		$o = get_option('pergamon_settings', []); $v = $o[$a['name']] ?? '';
		echo '<textarea name="pergamon_settings['.$a['name'].']" rows="4" style="width:100%;max-width:500px;">'.esc_textarea($v).'</textarea>';
	}
	public function render_repeater_field(): void {
		$o = get_option('pergamon_settings', []); $items = $o['floating_menu_items'] ?? [];
		echo '<div id="pergamon-floating-menu-settings"><div id="pergamon-repeater-container" style="display:flex; flex-direction:column; gap:10px; max-width:600px;">';
		foreach ( $items as $i => $it ) {
			echo '<div class="pergamon-repeater-row" style="display:flex; gap:10px; align-items:center;"><input type="text" name="pergamon_settings[floating_menu_items]['.$i.'][title]" value="'.esc_attr($it['title']).'" placeholder="Title" style="flex:1;"><input type="text" name="pergamon_settings[floating_menu_items]['.$i.'][url]" value="'.esc_attr($it['url']).'" placeholder="URL" style="flex:2;"><button type="button" class="button pergamon-move-up">↑</button><button type="button" class="button pergamon-move-down">↓</button><button type="button" class="button pergamon-remove-row" style="color:red;">🗑️</button></div>';
		}
		echo '</div><p><button type="button" class="button button-primary" id="pergamon-add-row">+ Add Item</button></p>';
		echo '<script type="text/template" id="pergamon-row-template"><div class="pergamon-repeater-row" style="display:flex; gap:10px; align-items:center;"><input type="text" name="pergamon_settings[floating_menu_items][__index__][title]" value="" placeholder="Title" style="flex:1;"><input type="text" name="pergamon_settings[floating_menu_items][__index__][url]" value="" placeholder="URL" style="flex:2;"><button type="button" class="button pergamon-move-up">↑</button><button type="button" class="button pergamon-move-down">↓</button><button type="button" class="button pergamon-remove-row" style="color:red;">🗑️</button></div></script></div>';
	}

	public function render_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) return;
		?>
		<div class="wrap">
			<h1>Pergamon Settings</h1>
			<h2 class="nav-tab-wrapper">
				<a href="#features" class="nav-tab nav-tab-active" data-target="pergamon-features">Features</a>
				<a href="#schema" class="nav-tab" data-target="pergamon-schema">SEO</a>
				<a href="#floating" class="nav-tab" data-target="pergamon-floating">Floating Menu</a>
				<a href="#ads" class="nav-tab" data-target="pergamon-ads">Ads</a>
				<a href="#layout" class="nav-tab" data-target="pergamon-layout">Layout</a>
			</h2>
			<form action="options.php" method="post">
				<?php settings_fields( 'pergamon_settings_group' ); ?>
				<div id="pergamon-features" class="pergamon-tab-content active"><?php do_settings_sections( 'pergamon-settings' ); ?></div>
				<div id="pergamon-schema" class="pergamon-tab-content"><?php do_settings_sections( 'pergamon-settings' ); ?></div>
				<div id="pergamon-floating" class="pergamon-tab-content"><?php do_settings_sections( 'pergamon-settings' ); ?></div>
				<div id="pergamon-ads" class="pergamon-tab-content"><?php do_settings_sections( 'pergamon-settings' ); ?></div>
				<div id="pergamon-layout" class="pergamon-tab-content"><?php do_settings_sections( 'pergamon-settings' ); ?></div>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}
