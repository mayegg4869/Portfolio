<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package BusinessPress
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function businesspress_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'businesspress_pingback_header' );

/**
 * Change excerpt length.
 */
if ( 'ja' !== get_bloginfo( 'language' ) ) {
	function businesspress_change_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		return 35;
	}
	add_filter( 'excerpt_length', 'businesspress_change_excerpt_length', 999 );
}

/**
 * Change excerpt length in Japanese.
 */
function businesspress_change_excerpt_mblength( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return 100;
}
add_filter( 'excerpt_mblength', 'businesspress_change_excerpt_mblength' );

/**
 * Change the [...] string in the excerpt.
 */
function businesspress_change_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	return '...';
}
add_filter( 'excerpt_more', 'businesspress_change_excerpt_more' );

/**
 * Modify the read more link text
 */
function businesspress_modify_read_more_link() {
	return '<a class="continue-reading" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html__( 'Continue reading &rarr;', 'businesspress' ) . '</a>';
}
add_filter( 'the_content_more_link', 'businesspress_modify_read_more_link' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function businesspress_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'businesspress_page_menu_args' );

/**
 * Adds a box to the side column on the Page edit screen.
 */
function businesspress_add_meta_box() {
	add_meta_box( 'businesspress_page_title_display', __( 'Page Title Display', 'businesspress' ), 'businesspress_meta_box_callback', 'page', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'businesspress_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function businesspress_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'businesspress_save_meta_box_data', 'businesspress_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	global $post;
	$value = get_post_meta( $post->ID, 'businesspress_hide_page_title', true );
	$checked = ( $value ) ? ' checked="checked"' : '';

	echo '<label for="businesspress_hide_page_title">';
	echo '<input type="checkbox" id="businesspress_hide_page_title" name="businesspress_hide_page_title" value="1"' . $checked . ' />';
	echo __( 'Hide Page Title', 'businesspress' );
	echo '</label>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function businesspress_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['businesspress_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['businesspress_meta_box_nonce'], 'businesspress_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	/* OK, it's safe for us to save the data now. */

	// Sanitize user input.
	$my_data = businesspress_sanitize_checkbox( $_POST['businesspress_hide_page_title'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'businesspress_hide_page_title', $my_data );
}
add_action( 'save_post', 'businesspress_save_meta_box_data' );