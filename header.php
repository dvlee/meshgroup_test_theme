<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php bloginfo('title') ?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/style.css" ?>">
	<?php wp_head() ?>
</head>
<body <?php body_class() ?>>

<div id="wrapper">
	<header class="mb-4">
		<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
			<div class="container">
				<span class="navbar-brand"><?php bloginfo('title') ?></span>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<?php
				wp_nav_menu([
					'theme_location'  => 'primary_menu',
					'menu_class'      => 'navbar-nav ml-auto',
					'container'       => 'div',
					'container_id'    => 'navbarNav',
					'container_class' => 'collapse navbar-collapse',
				]);
				?>
			</div>
		</nav>
	</header>

	<main>