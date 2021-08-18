<?php
/**
 * @package BusinessPress
 */
?>

<div class="post-list">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( has_post_thumbnail() && ! get_theme_mod( 'businesspress_hide_featured_image_on_list' ) ): ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'businesspress-post-thumbnail-list' ); ?></a>
		</div><!-- .post-thumbnail -->
		<?php endif; ?>
		<div class="post-list-content">
			<header class="entry-header">
				<?php if ( is_sticky() && is_home() && ! is_paged() ): ?>
				<div class="featured"><?php esc_html_e( 'Featured', 'businesspress' ); ?></div>
				<?php endif; ?>
				<?php businesspress_category(); ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php businesspress_entry_meta(); ?>
			</header><!-- .entry-header -->
			<div class="entry-summary">
				<p><?php echo businesspress_shorten_text( get_the_excerpt(), 160 ); ?></p>
			</div><!-- .entry-summary -->
		</div><!-- .post-list-content -->
	</article><!-- #post-## -->
</div><!-- .post-list -->