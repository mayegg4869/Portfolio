<?php
/**
 * The template used for displaying sticky post.
 *
 * @package BusinessPress
 */
?>

<div class="slick-item">
	<div class="featured-entry" <?php businesspress_post_background(); ?>>
		<div class="featured-entry-overlay">
			<div class="featured-entry-content">
				<?php if ( ! get_theme_mod( 'businesspress_hide_category' ) ) : ?>
				<div class="featured-entry-category"><?php the_category( '<span class="category-sep">/</span>' ); ?></div>
				<?php endif; ?>
				<h2 class="featured-entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo businesspress_shorten_text( get_the_title(), 60 ); ?></a></h2>
				<div class="featured-entry-date posted-on"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_the_date(); ?></a></div>
			</div><!-- .featured-entry-content -->
		</div><!-- .featured-entry-overlay -->
	</div><!-- .featured-entry -->
</div><!-- .slick-item -->