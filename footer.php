<footer class="site-footer">
	<div class="container footer-inner">

		<div class="footer-columns">
			<div class="footer-col footer-brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/rankcraft-web-no-tagline-dark.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="footer-logo-img" width="1800" height="320" loading="lazy">
				</a>
			</div>

			<div class="footer-col">
				<h2>Services</h2>
				<ul>
					<li><a href="/wordpress-development">WordPress Development</a></li>
					<li><a href="/seo-and-local-search">SEO and Local Search</a></li>
					<li><a href="/performance-audits">Performance Audits</a></li>
				</ul>
			</div>

			<div class="footer-col">
				<h2>Company</h2>
				<ul>
					<li><a href="/about">About</a></li>
					<li><a href="/portfolio">Portfolio</a></li>
					<li><a href="/blog">Blog</a></li>
				</ul>
			</div>

			<div class="footer-col">
				<h2>Get Started</h2>
				<ul>
					<li><a href="https://audit.rankcraftweb.com">Free Audit</a></li>
					<li><a href="/contact">Contact</a></li>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<p class="footer-copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> RankCraft Web. All rights reserved.</p>
			<ul class="footer-legal">
				<li><a href="/privacy-policy">Privacy Policy</a></li>
				<li><a href="/terms-of-service">Terms of Service</a></li>
			</ul>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
