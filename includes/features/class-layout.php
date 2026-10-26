<?php
/**
 * Layout & Disable Elements feature.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Layout {

	public function register(): void {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
		add_filter( 'body_class', array( $this, 'add_layout_classes' ) );
		add_filter( 'render_block', array( $this, 'hide_template_parts' ), 10, 2 );
	}

	public function add_meta_box(): void {
		add_meta_box(
			'pergamon_layout_options',
			'Pergamon: Disable Elements',
			array( $this, 'render_meta_box' ),
			array( 'post', 'page' ),
			'side',
			'default'
		);
	}

	public function render_meta_box( \WP_Post $post ): void {
		wp_nonce_field( 'pergamon_layout_save', 'pergamon_layout_nonce' );
		$disable_header  = get_post_meta( $post->ID, '_pergamon_disable_header', true );
		$disable_footer  = get_post_meta( $post->ID, '_pergamon_disable_footer', true );
		$disable_title   = get_post_meta( $post->ID, '_pergamon_disable_title', true );
		$disable_sidebar = get_post_meta( $post->ID, '_pergamon_disable_sidebar', true );
		?>
		<p><label><input type="checkbox" name="pergamon_disable_header" value="1" <?php checked( $disable_header, '1' ); ?>> Hide Header</label></p>
		<p><label><input type="checkbox" name="pergamon_disable_footer" value="1" <?php checked( $disable_footer, '1' ); ?>> Hide Footer</label></p>
		<p><label><input type="checkbox" name="pergamon_disable_title" value="1" <?php checked( $disable_title, '1' ); ?>> Hide Page Title</label></p>
		<p><label><input type="checkbox" name="pergamon_disable_sidebar" value="1" <?php checked( $disable_sidebar, '1' ); ?>> Hide Sidebar</label></p>
		<?php
	}

	public function save_meta_box( int $post_id ): void {
		if ( ! isset( $_POST['pergamon_layout_nonce'] ) || ! wp_verify_nonce( $_POST['pergamon_layout_nonce'], 'pergamon_layout_save' ) ) return;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;

		update_post_meta( $post_id, '_pergamon_disable_header', isset( $_POST['pergamon_disable_header'] ) ? '1' : '0' );
		update_post_meta( $post_id, '_pergamon_disable_footer', isset( $_POST['pergamon_disable_footer'] ) ? '1' : '0' );
		update_post_meta( $post_id, '_pergamon_disable_title', isset( $_POST['pergamon_disable_title'] ) ? '1' : '0' );
		update_post_meta( $post_id, '_pergamon_disable_sidebar', isset( $_POST['pergamon_disable_sidebar'] ) ? '1' : '0' );
	}

	public function add_layout_classes( array $classes ): array {
		$options = get_option( 'pergamon_settings', array() );
		$sidebar = isset( $options['sidebar_position'] ) ? $options['sidebar_position'] : 'right';
		
		$classes[] = 'pergamon-sidebar-' . $sidebar;
		
		if ( is_singular() ) {
			$post_id = get_the_ID();
			if ( '1' === get_post_meta( $post_id, '_pergamon_disable_sidebar', true ) ) {
				$classes[] = 'pergamon-hide-sidebar';
			}
		}
		return $classes;
	}

	public function hide_template_parts( string $block_content, array $block ): string {
		if ( ! is_singular() || is_admin() ) {
			return $block_content;
		}

		if ( 'core/template-part' === $block['blockName'] ) {
			$slug = $block['attrs']['slug'] ?? '';
			$post_id = get_the_ID();

			if ( 'header' === $slug && '1' === get_post_meta( $post_id, '_pergamon_disable_header', true ) ) {
				return '';
			}
			if ( 'footer' === $slug && '1' === get_post_meta( $post_id, '_pergamon_disable_footer', true ) ) {
				return '';
			}
		}
		return $block_content;
	}
}
