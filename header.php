<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( ! is_user_logged_in() ) : ?>
	<!-- Google tag (gtag.js) -->
	<script async src="<?php echo esc_url( 'https://www.googletagmanager.com/gtag/js?id=' . RANKCRAFT_GA4_ID ); ?>"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', '<?php echo esc_js( RANKCRAFT_GA4_ID ); ?>');
	</script>
	<?php endif; ?>
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo esc_url( RANKCRAFT_URI . '/assets/fonts/poppins-400-latin.woff2' ); ?>">
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo esc_url( RANKCRAFT_URI . '/assets/fonts/poppins-700-latin.woff2' ); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/favicon-32.png' ); ?>">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/favicon-192.png' ); ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/apple-touch-icon.png' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="container header-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
			<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/rankcraft-web-no-tagline-dark.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo-img" width="1800" height="320">
		</a>

		<button type="button" class="nav-toggle" aria-expanded="false" aria-controls="header-nav-wrap" aria-label="Toggle menu">
			<span></span>
			<span></span>
			<span></span>
		</button>

		<div class="header-nav-wrap" id="header-nav-wrap">
			<nav class="primary-nav">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'nav-menu',
					'fallback_cb'    => false,
				) );
				?>
			</nav>
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
		</div>
	</div>
</header>

<main id="content">
