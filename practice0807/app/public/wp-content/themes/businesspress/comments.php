<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package BusinessPress
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				comments_number( '', esc_html__( '1 Comment', 'businesspress' ), esc_html__( '% Comments', 'businesspress' ) );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav class="comment-navigation">
			<h3 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'businesspress' ); ?></h3>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Previous Comments', 'businesspress' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Next Comments &rarr;', 'businesspress' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- .comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav class="comment-navigation">
			<h3 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'businesspress' ); ?></h3>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Previous Comments', 'businesspress' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Next Comments &rarr;', 'businesspress' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- .comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'businesspress' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array(
		'title_reply'         => esc_html__( 'Leave a Comment', 'businesspress' ),
		'comment_notes_after' => '',
	) ); ?>

</div><!-- #comments -->
