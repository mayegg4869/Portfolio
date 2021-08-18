<?php
/**
 * @package BusinessPress
 */
?>

<div class="post-summary">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( is_sticky() && is_home() && ! is_paged() ): ?>
			<div class="featured"><?php esc_html_e( 'Featured', 'businesspress' ); ?></div>
			<?php endif; ?>
			<?php businesspress_category(); ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php businesspress_entry_meta(); ?>
			<?php if ( has_post_thumbnail() && ! get_theme_mod( 'businesspress_hide_featured_image_on_summary' ) ): ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			</div>
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<p><a class="continue-reading" href="<?php the_permalink() ?>" rel="bookmark"><?php esc_html_e( 'Continue reading &rarr;', 'businesspress' ) ?></a></p>
		</div><!-- .entry-summary -->
	</article><!-- #post-## -->
</div><!-- .post-summary -->