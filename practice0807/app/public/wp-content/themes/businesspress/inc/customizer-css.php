<?php
/**
 * Set CSS for Customizer options.
 *
 * @package BusinessPress
 */

/**
 * Set custom CSS for Customizer options.
 */
function businesspress_customizer_css() {

	$link_color = get_theme_mod( 'businesspress_link_color', '#4693f5' );
	$link_hover_color = get_theme_mod( 'businesspress_link_hover_color', '#639af6' );
	$light_background_color = get_theme_mod( 'businesspress_light_background_color', '#f4f5f6' );

	$header_image = get_header_image();
	$home_header_layout = get_theme_mod( 'businesspress_home_header_layout', 'left' );

	$footer_width_1 = get_theme_mod( 'businesspress_footer_width_1', '6' );
	$footer_width_2 = get_theme_mod( 'businesspress_footer_width_2', '3' );
	$footer_width_3 = get_theme_mod( 'businesspress_footer_width_3', '3' );
	$footer_width_4 = get_theme_mod( 'businesspress_footer_width_4', '0' );
	$footer_width_5 = get_theme_mod( 'businesspress_footer_width_5', '0' );
	$footer_width_6 = get_theme_mod( 'businesspress_footer_width_6', '0' );

	$css = '
	a,
	.subheader {
		color: ' . esc_attr( $link_color ) . ';
	}
	a:hover {
		color: ' . esc_attr( $link_hover_color ) . ';
	}
	a.home-header-button-main {
		background-color: ' . esc_attr( $link_color ) . ';
	}
	a.home-header-button-main:hover {
		background-color: ' . esc_attr( $link_hover_color ) . ';
	}
	code, kbd, tt, var,
	th,
	pre,
	.top-bar,
	.author-profile,
	.pagination .current,
	.page-links .page-numbers,
	.tagcloud a,
	.widget_calendar tbody td a,
	.container-wrapper,
	.site-bottom {
		background-color: ' . esc_attr( $light_background_color ) . ';
	}

	.jumbotron {
		background-image: url("' . esc_attr( $header_image) . '");
	}
	.home-header-content {
		text-align: ' . esc_attr( $home_header_layout ) . ';
	}

	@media screen and (min-width: 980px) {
		.footer-widget-1 {
			width: ' . esc_attr( $footer_width_1 * 8.33 ) . '%;
		}
		.footer-widget-2 {
			width: ' . esc_attr( $footer_width_2 * 8.33 ) . '%;
		}
		.footer-widget-3 {
			width: ' . esc_attr( $footer_width_3 * 8.33 ) . '%;
		}
		.footer-widget-4 {
			width: ' . esc_attr( $footer_width_4 * 8.33 ) . '%;
		}
		.footer-widget-5 {
			width: ' . esc_attr( $footer_width_5 * 8.33 ) . '%;
		}
		.footer-widget-6 {
			width: ' . esc_attr( $footer_width_6 * 8.33 ) . '%;
		}
	}
	';

	wp_add_inline_style( 'businesspress-style', $css );
}
add_action( 'wp_enqueue_scripts', 'businesspress_customizer_css' );
