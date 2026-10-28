<?php
declare( strict_types=1 );
namespace Pergamon\Features;
if ( ! defined( 'ABSPATH' ) ) exit;

final class Settings {
	public function register(): void {
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	public function add_menu(): void {
		add_menu_page( __( 'Pergamon Settings', 'pergamon' ), __( 'Pergamon', 'pergamon' ), 'manage_options', 'pergamon-settings', array( $this, 'render_page' ), 'dashicons-admin-generic', 60 );
	}

	/** التبويبات: id => label. */
	private function get_tabs(): array {
		return array(
			'features' => __( 'Features', 'pergamon' ),
			'seo'      => __( 'SEO', 'pergamon' ),
			'floating' => __( 'Floating Menu', 'pergamon' ),
			'ads'      => __( 'Ads', 'pergamon' ),
			'layout'   => __( 'Layout', 'pergamon' ),
		);
	}

	private function tab_page( string $tab ): string {
		return 'pergamon-tab-' . $tab;
	}

	public function register_settings(): void {
		register_setting( 'pergamon_settings_group', 'pergamon_settings', array( $this, 'sanitize_settings' ) );

		$f = $this->tab_page( 'features' );
		add_settings_section( 'pergamon_features_section', __( 'Core Features', 'pergamon' ), null, $f );
		add_settings_field( 'enable_dark_mode', __( 'Dark Mode', 'pergamon' ), array( $this, 'render_checkbox' ), $f, 'pergamon_features_section', array( 'name' => 'enable_dark_mode', 'label' => __( 'Enable Dark Mode Toggle', 'pergamon' ) ) );
		add_settings_field( 'enable_toc', __( 'Table of Contents', 'pergamon' ), array( $this, 'render_checkbox' ), $f, 'pergamon_features_section', array( 'name' => 'enable_toc', 'label' => __( 'Enable TOC', 'pergamon' ) ) );
		add_settings_field( 'enable_reading_progress', __( 'Reading Progress', 'pergamon' ), array( $this, 'render_checkbox' ), $f, 'pergamon_features_section', array( 'name' => 'enable_reading_progress', 'label' => __( 'Enable Progress Bar', 'pergamon' ) ) );
		add_settings_field( 'enable_search', __( 'Search Overlay', 'pergamon' ), array( $this, 'render_checkbox' ), $f, 'pergamon_features_section', array( 'name' => 'enable_search', 'label' => __( 'Enable Search', 'pergamon' ) ) );

		$s = $this->tab_page( 'seo' );
		add_settings_section( 'pergamon_schema_section', __( 'SEO Settings', 'pergamon' ), null, $s );
		add_settings_field( 'schema_mode', __( 'Schema Mode', 'pergamon' ), array( $this, 'render_schema_field' ), $s, 'pergamon_schema_section' );
		add_settings_field( 'enable_og_tags', __( 'Meta Tags', 'pergamon' ), array( $this, 'render_checkbox' ), $s, 'pergamon_schema_section', array( 'name' => 'enable_og_tags', 'label' => __( 'Enable OG & Twitter', 'pergamon' ) ) );
		add_settings_field( 'enable_canonical', __( 'Canonical', 'pergamon' ), array( $this, 'render_checkbox' ), $s, 'pergamon_schema_section', array( 'name' => 'enable_canonical', 'label' => __( 'Enable Canonical', 'pergamon' ) ) );
		add_settings_field( 'google_verify', __( 'Google Verification', 'pergamon' ), array( $this, 'render_text' ), $s, 'pergamon_schema_section', array( 'name' => 'google_verify', 'placeholder' => '' ) );
		add_settings_field( 'bing_verify', __( 'Bing Verification', 'pergamon' ), array( $this, 'render_text' ), $s, 'pergamon_schema_section', array( 'name' => 'bing_verify', 'placeholder' => '' ) );

		$m = $this->tab_page( 'floating' );
		add_settings_section( 'pergamon_floating_section', __( 'Floating Menu', 'pergamon' ), null, $m );
		add_settings_field( 'enable_floating_menu', __( 'Enable', 'pergamon' ), array( $this, 'render_checkbox' ), $m, 'pergamon_floating_section', array( 'name' => 'enable_floating_menu', 'label' => __( 'Enable Floating Menu', 'pergamon' ) ) );
		add_settings_field( 'floating_menu_title', __( 'Menu Title', 'pergamon' ), array( $this, 'render_text' ), $m, 'pergamon_floating_section', array( 'name' => 'floating_menu_title', 'placeholder' => 'Quick Links' ) );
		add_settings_field( 'floating_menu_position', __( 'Position', 'pergamon' ), array( $this, 'render_select' ), $m, 'pergamon_floating_section', array( 'name' => 'floating_menu_position', 'options' => array( 'bottom-right' => __( 'Bottom Right', 'pergamon' ), 'bottom-left' => __( 'Bottom Left', 'pergamon' ), 'top-right' => __( 'Top Right', 'pergamon' ), 'top-left' => __( 'Top Left', 'pergamon' ) ) ) );
		add_settings_field( 'floating_menu_size', __( 'Size (px)', 'pergamon' ), array( $this, 'render_text' ), $m, 'pergamon_floating_section', array( 'name' => 'floating_menu_size', 'placeholder' => '50' ) );
		add_settings_field( 'floating_menu_color', __( 'Color', 'pergamon' ), array( $this, 'render_color' ), $m, 'pergamon_floating_section', array( 'name' => 'floating_menu_color' ) );
		add_settings_field( 'floating_menu_icon', __( 'Icon (Emoji/SVG)', 'pergamon' ), array( $this, 'render_text' ), $m, 'pergamon_floating_section', array( 'name' => 'floating_menu_icon', 'placeholder' => '+' ) );
		add_settings_field( 'floating_menu_items', __( 'Menu Items', 'pergamon' ), array( $this, 'render_repeater_field' ), $m, 'pergamon_floating_section' );

		$a = $this->tab_page( 'ads' );
		add_settings_section( 'pergamon_ads_section', __( 'Ads', 'pergamon' ), null, $a );
		add_settings_field( 'ad_sticky_top', __( 'Sticky Top Ad (HTML/JS)', 'pergamon' ), array( $this, 'render_textarea' ), $a, 'pergamon_ads_section', array( 'name' => 'ad_sticky_top' ) );
		add_settings_field( 'ad_content_top', __( 'Ad After Title', 'pergamon' ), array( $this, 'render_textarea' ), $a, 'pergamon_ads_section', array( 'name' => 'ad_content_top' ) );
		add_settings_field( 'ad_content_paragraph', __( 'Ad After First Paragraph', 'pergamon' ), array( $this, 'render_textarea' ), $a, 'pergamon_ads_section', array( 'name' => 'ad_content_paragraph' ) );

		$l = $this->tab_page( 'layout' );
		add_settings_section( 'pergamon_layout_section', __( 'Layout', 'pergamon' ), null, $l );
		add_settings_field( 'sidebar_position', __( 'Sidebar Position', 'pergamon' ), array( $this, 'render_select' ), $l, 'pergamon_layout_section', array( 'name' => 'sidebar_position', 'options' => array( 'right' => __( 'Right', 'pergamon' ), 'left' => __( 'Left', 'pergamon' ), 'none' => __( 'None', 'pergamon' ) ) ) );
		add_settings_field( 'enable_sticky_header', __( 'Sticky Header', 'pergamon' ), array( $this, 'render_checkbox' ), $l, 'pergamon_layout_section', array( 'name' => 'enable_sticky_header', 'label' => __( 'Enable Sticky Navigation', 'pergamon' ) ) );
	}

	public function sanitize_settings( array $input ): array {
		$output = array();
		$checks = array( 'enable_dark_mode', 'enable_toc', 'enable_reading_progress', 'enable_search', 'enable_og_tags', 'enable_canonical', 'enable_floating_menu', 'enable_sticky_header' );
		foreach ( $checks as $c ) { $output[ $c ] = isset( $input[ $c ] ) ? '1' : '0'; }

		$texts = array( 'schema_mode', 'google_verify', 'bing_verify', 'floating_menu_title', 'floating_menu_position', 'floating_menu_size', 'floating_menu_color', 'floating_menu_icon', 'sidebar_position' );
		foreach ( $texts as $t ) { $output[ $t ] = isset( $input[ $t ] ) ? sanitize_text_field( $input[ $t ] ) : ''; }

		$output['ad_sticky_top']      = wp_kses_post( $input['ad_sticky_top'] ?? '' );
		$output['ad_content_top']     = wp_kses_post( $input['ad_content_top'] ?? '' );
		$output['ad_content_paragraph'] = wp_kses_post( $input['ad_content_paragraph'] ?? '' );

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

	public function render_schema_field(): void {
		$o = get_option( 'pergamon_settings', array() ); $v = $o['schema_mode'] ?? 'auto';
		echo '<select name="pergamon_settings[schema_mode]"><option value="auto" ' . selected( $v, 'auto', false ) . '>' . esc_html__( 'Auto', 'pergamon' ) . '</option><option value="on" ' . selected( $v, 'on', false ) . '>' . esc_html__( 'Always On', 'pergamon' ) . '</option><option value="off" ' . selected( $v, 'off', false ) . '>' . esc_html__( 'Always Off', 'pergamon' ) . '</option></select>';
	}
	public function render_checkbox( array $a ): void {
		$o = get_option( 'pergamon_settings', array() ); $v = $o[ $a['name'] ] ?? '1';
		echo '<label><input type="checkbox" name="pergamon_settings[' . esc_attr( $a['name'] ) . ']" value="1" ' . checked( '1', $v, false ) . '> ' . esc_html( $a['label'] ) . '</label>';
	}
	public function render_select( array $a ): void {
		$o = get_option( 'pergamon_settings', array() ); $v = $o[ $a['name'] ] ?? '';
		echo '<select name="pergamon_settings[' . esc_attr( $a['name'] ) . ']">';
		foreach ( $a['options'] as $k => $lbl ) { echo '<option value="' . esc_attr( $k ) . '" ' . selected( $v, $k, false ) . '>' . esc_html( $lbl ) . '</option>'; }
		echo '</select>';
	}
	public function render_text( array $a ): void {
		$o = get_option( 'pergamon_settings', array() ); $v = $o[ $a['name'] ] ?? '';
		echo '<input type="text" name="pergamon_settings[' . esc_attr( $a['name'] ) . ']" value="' . esc_attr( $v ) . '" placeholder="' . esc_attr( $a['placeholder'] ) . '" style="width:100%;max-width:400px;">';
	}
	public function render_color( array $a ): void {
		$o = get_option( 'pergamon_settings', array() ); $v = $o[ $a['name'] ] ?? '#0F3D3E';
		echo '<input type="color" name="pergamon_settings[' . esc_attr( $a['name'] ) . ']" value="' . esc_attr( $v ) . '">';
	}
	public function render_textarea( array $a ): void {
		$o = get_option( 'pergamon_settings', array() ); $v = $o[ $a['name'] ] ?? '';
		echo '<textarea name="pergamon_settings[' . esc_attr( $a['name'] ) . ']" rows="4" style="width:100%;max-width:500px;">' . esc_textarea( $v ) . '</textarea>';
	}
	public function render_repeater_field(): void {
		$o = get_option( 'pergamon_settings', array() ); $items = $o['floating_menu_items'] ?? array();
		echo '<div id="pergamon-floating-menu-settings"><div id="pergamon-repeater-container" style="display:flex;flex-direction:column;gap:10px;max-width:600px;">';
		foreach ( $items as $i => $it ) {
			echo '<div class="pergamon-repeater-row" style="display:flex;gap:10px;align-items:center;"><input type="text" name="pergamon_settings[floating_menu_items][' . intval( $i ) . '][title]" value="' . esc_attr( $it['title'] ) . '" placeholder="Title" style="flex:1;"><input type="text" name="pergamon_settings[floating_menu_items][' . intval( $i ) . '][url]" value="' . esc_attr( $it['url'] ) . '" placeholder="URL" style="flex:2;"><button type="button" class="button pergamon-move-up">↑</button><button type="button" class="button pergamon-move-down">↓</button><button type="button" class="button pergamon-remove-row" style="color:red;">🗑️</button></div>';
		}
		echo '</div><p><button type="button" class="button button-primary" id="pergamon-add-row">' . esc_html__( '+ Add Item', 'pergamon' ) . '</button></p>';
		echo '<script type="text/template" id="pergamon-row-template"><div class="pergamon-repeater-row" style="display:flex;gap:10px;align-items:center;"><input type="text" name="pergamon_settings[floating_menu_items][__index__][title]" value="" placeholder="Title" style="flex:1;"><input type="text" name="pergamon_settings[floating_menu_items][__index__][url]" value="" placeholder="URL" style="flex:2;"><button type="button" class="button pergamon-move-up">↑</button><button type="button" class="button pergamon-move-down">↓</button><button type="button" class="button pergamon-remove-row" style="color:red;">🗑️</button></div></script></div>';
	}

	public function render_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) { return; }
		$tabs = $this->get_tabs();
		?>
		<div class="wrap pergamon-settings-page">
			<h1><?php esc_html_e( 'Pergamon Settings', 'pergamon' ); ?></h1>
			<h2 class="nav-tab-wrapper">
				<?php $first = true; foreach ( $tabs as $id => $label ) : ?>
					<a href="#<?php echo esc_attr( $id ); ?>" class="nav-tab<?php echo $first ? ' nav-tab-active' : ''; ?>" data-target="<?php echo esc_attr( $this->tab_page( $id ) ); ?>"><?php echo esc_html( $label ); ?></a>
					<?php $first = false; endforeach; ?>
			</h2>
			<form action="options.php" method="post">
				<?php settings_fields( 'pergamon_settings_group' ); ?>
				<?php $first = true; foreach ( $tabs as $id => $label ) : ?>
					<div id="<?php echo esc_attr( $this->tab_page( $id ) ); ?>" class="pergamon-tab-content<?php echo $first ? ' active' : ''; ?>">
						<?php do_settings_sections( $this->tab_page( $id ) ); ?>
					</div>
					<?php $first = false; endforeach; ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}
