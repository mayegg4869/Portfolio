<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package BusinessPress
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php get_sidebar( 'footer' ); ?>

		<?php if ( has_nav_menu( 'footer' ) || has_nav_menu( 'footer-social' ) || ! get_theme_mod( 'businesspress_hide_footer_text' ) || ! get_theme_mod( 'businesspress_hide_credit' ) ) : ?>
		<div class="site-bottom">
			<div class="site-bottom-content">

				<?php if ( has_nav_menu( 'footer' ) || has_nav_menu( 'footer-social' ) ) : ?>
				<div class="footer-menu">
					<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<nav class="footer-navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'footer' , 'depth' => 1 ) ); ?>
					</nav><!-- .footer-navigation -->
					<?php endif; ?>
					<?php if ( has_nav_menu( 'footer-social' ) ) : ?>
					<nav class="footer-social-link social-link-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-social', 'depth' => 1, 'link_before'  => '<span class="screen-reader-text">', 'link_after'  => '</span>' ) ); ?>
					</nav><!-- .footer-social-link -->
					<?php endif; ?>
				</div><!-- .footer-menu -->
				<?php endif; ?>

				<?php businesspress_footer(); ?>

			</div><!-- .site-bottom-content -->
		</div><!-- .site-bottom -->
		<?php endif; ?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<div class="back-to-top"></div>

<?php wp_footer(); ?>

</body>
</html>
