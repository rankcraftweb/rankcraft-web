<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
			<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/rankcraft-web-no-tagline-dark.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo-img">
		</a>
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
		<a href="#free-audit" class="btn btn-primary">Get your free audit</a>
	</div>
</header>
