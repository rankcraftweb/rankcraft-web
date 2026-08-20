<footer class="site-footer">
	<div class="container footer-inner">
		<div class="footer-brand">
			<div class="footer-logo"><?php bloginfo( 'name' ); ?></div>
			<p class="footer-tagline">Web &bull; SEO &bull; Systems</p>
		</div>

		<nav class="footer-nav">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'menu_class'     => 'footer-menu',
				'fallback_cb'    => false,
			) );
			?>
		</nav>

		<p class="footer-copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> RankCraft Web. All rights reserved.</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
