<?php
/**
 * The template used for displaying page content.
 *
 * @package BusinessPress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header screen-reader-text">
		<?php if( is_front_page() ) : ?>
		<h2 class="entry-title"><?php the_title(); ?></h2>
		<?php else : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endif; ?>
		<?php businesspress_page_meta(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array(	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'businesspress' ), 'after'  => '</div>', 'pagelink' => '<span class="page-numbers">%</span>',  ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->