<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package BusinessPress
 */

/**
 * Remove the Related Posts from the bottom of posts
 */
function businesspress_remove_related_posts() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
		$jprp = Jetpack_RelatedPosts::init();
		$callback = array( $jprp, 'filter_add_target_to_dom' );
		remove_filter( 'the_content', $callback, 40 );
	}
}
add_filter( 'wp', 'businesspress_remove_related_posts', 20 );