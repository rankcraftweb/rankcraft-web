<?php
/**
 * Template for the Contact page (slug: contact).
 *
 * The pricing section on /services/ sends three links here, so this is
 * the page reached with the most intent on the whole site: someone who
 * has read a figure and decided they can afford it. It used to answer
 * none of what that person wants to know before typing - who reads it,
 * how long a reply takes, and whether they are about to be put through
 * a sales call.
 *
 * Content is template-driven rather than pulled from the editor, the
 * same as every other page here. the_content() is no longer called.
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="contact-page">
	<div class="container contact-page-inner">

		<div class="contact-intro">
			<p class="section-label">Contact</p>
			<h1>Get in touch</h1>
			<p class="contact-lead">One person reads everything that arrives here, and you will hear back within one business day.</p>
			<p class="contact-lead">If you have a site already, paste the address into the message. Most of what I would otherwise ask in a first reply I can see for myself, which saves us both a round trip.</p>

			<p class="contact-direct">Or reach me directly at <a href="mailto:hello@rankcraftweb.com">hello@rankcraftweb.com</a> or <a href="tel:+639696012157">0969 601 2157</a>.</p>
		</div>

		<div class="contact-form-wrap">
			<?php if ( isset( $_GET['contact'] ) && $_GET['contact'] === 'success' ) : ?>
				<div class="form-notice form-notice-success">Thanks, your message has been sent. I'll get back to you within one business day.</div>
			<?php elseif ( isset( $_GET['contact'] ) && $_GET['contact'] === 'error' ) : ?>
				<div class="form-notice form-notice-error">Something went wrong. Double check your details and try again, or email me directly.</div>
			<?php endif; ?>

			<?php rankcraft_contact_form(); ?>
		</div>

	</div>
</section>

<section class="contact-next">
	<div class="container">
		<h2>What happens after you send it</h2>
		<div class="steps-grid">
			<div class="step">
				<span class="step-number">1</span>
				<h3>I look at the site first</h3>
				<p>If you sent an address, I run the same measurements the free audit tool does before I write back. That way the first answer has something behind it instead of a list of questions back at you.</p>
			</div>
			<div class="step">
				<span class="step-number">2</span>
				<h3>A reply from me, not a calendar link</h3>
				<p>Within one business day, written by the person who would do the work. There is nobody else here to hand it to.</p>
			</div>
			<div class="step">
				<span class="step-number">3</span>
				<h3>We only talk if it is worth talking</h3>
				<p>If what you need is not something I do, or the site is already fine, the reply will say that. You are not going to be chased.</p>
			</div>
		</div>
		<p class="section-intro contact-next-note">Not ready to talk to anyone yet? The <a href="https://audit.rankcraftweb.com">free audit</a> runs the same measurements I would start from and puts the report on screen straight away. It asks for a name, an email and the address of your site, and nothing else.</p>
	</div>
</section>

<?php get_footer(); ?>
