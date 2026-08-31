</main>

<footer class="site-footer">
	<div class="container footer-inner">

		<div class="footer-columns">
			<?php
			/*
			 * A typeset wordmark rather than the logo image. The image was
			 * 315px wide against columns whose headings are 14px, so the
			 * first column read as a different weight of thing from the
			 * other three. The header still carries the full logo.
			 *
			 * <address> for the details below it: this is the contact
			 * information for the owner of the page, which is what the
			 * element is for, and it puts them on every page rather than
			 * only on /contact/.
			 *
			 * The phone number has to match the Google Business Profile
			 * character for character. The profile displays it as
			 * 0969 601 2157; the href stays international so the link still
			 * dials from anywhere. Change it in both places or in neither.
			 */
			?>
			<div class="footer-col footer-brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-wordmark">RankCraft <span>Web</span></a>
				<address class="footer-nap">
					<span>Silang, Cavite, Philippines</span>
					<a href="tel:+639696012157">0969 601 2157</a>
					<a href="mailto:hello@rankcraftweb.com">hello@rankcraftweb.com</a>
					<a href="https://maps.google.com/?cid=8104698444060568540" target="_blank" rel="noopener">Google Business Profile</a>
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
