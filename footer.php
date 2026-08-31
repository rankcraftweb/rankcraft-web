</main>

<footer class="site-footer">
	<div class="container footer-inner">

		<div class="footer-columns">
			<div class="footer-col footer-brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/rankcraft-web-no-tagline-dark.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="footer-logo-img" width="1800" height="320" loading="lazy">
				</a>

				<?php
				/*
				 * <address> rather than a div: this is the contact information
				 * for the owner of the page, which is exactly what the element
				 * is for, and it puts the details in one place on every page
				 * instead of only on /contact/.
				 *
				 * The phone number has to match the Google Business Profile
				 * character for character, formatting included. Change it in
				 * both places or in neither.
				 */
				?>
				<address class="footer-nap">
					<span>Silang, Cavite, Philippines</span>
					<a href="tel:+639696012157">+63 969 601 2157</a>
					<a href="mailto:hello@rankcraftweb.com">hello@rankcraftweb.com</a>
				</address>
			</div>

			<?php
			/*
			 * These three labels were <h2>, which put site-wide boilerplate
			 * at the same outline level as the page's own section headings.
			 * Demoting them to plain text on its own would have cost screen
			 * reader users the grouping, so each list becomes a <nav> named
			 * by its label instead: the labels leave the heading outline,
			 * and the groups become landmarks you can jump straight to.
			 */
			?>
			<div class="footer-col">
				<p class="footer-col-title" id="footer-nav-services">Services</p>
				<nav aria-labelledby="footer-nav-services">
					<ul>
						<li><a href="/wordpress-development">WordPress Development</a></li>
						<li><a href="/seo-and-local-search">SEO and Local Search</a></li>
						<li><a href="/performance-audits">Performance Audits</a></li>
					</ul>
				</nav>
			</div>

			<div class="footer-col">
				<p class="footer-col-title" id="footer-nav-company">Company</p>
				<nav aria-labelledby="footer-nav-company">
					<ul>
						<li><a href="/about">About</a></li>
						<li><a href="/portfolio">Portfolio</a></li>
						<li><a href="/blog">Blog</a></li>
					</ul>
				</nav>
			</div>

			<div class="footer-col">
				<p class="footer-col-title" id="footer-nav-get-started">Get Started</p>
				<nav aria-labelledby="footer-nav-get-started">
					<ul>
						<li><a href="https://audit.rankcraftweb.com">Free Audit</a></li>
						<li><a href="/contact">Contact</a></li>
					</ul>
				</nav>
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
