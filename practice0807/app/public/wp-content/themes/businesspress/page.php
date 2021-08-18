<?php
/**
 * The template for displaying all pages.
 *
 * @package BusinessPress
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/content', 'page' ); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

	<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar( 'page' ); ?>
<?php get_footer(); ?>
