<?php
	if ( stripos($_SERVER['HTTP_USER_AGENT'], 'Nintendo') !== false ) {
		header('Location: http://tect.gr/3ds/');
	}
	if ( is_singular() ) {
		//$body_class = 'single';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>
	<?php
		echo get_bloginfo('name').' • '.get_bloginfo('description');
	?>
	</title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
	<!-- <link rel="apple-touch-icon" href="img/apple-touch-icon.png"> -->
	<!-- WiiU & 3DS detection -> redirection -->
	<?php
		if ( $_SERVER['HTTP_HOST'] == 'localhost' ) { //Sublime's LiveReload; really messes loading times when online
		echo "<script>document.write('<script src=\"http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1\"></' + 'script>')</script>";
		}
	?>
	 <?php wp_head(); ?> 
</head>
<body <?php body_class($body_class); ?>>
<!-- http://codex.wordpress.org/Function_Reference/body_class -->
	<header>

		<div id="colophon" class="vcard"> <!-- move to settings page or just use a text widget → sidebar.php -->
			<h1><a class="url fn" href="http://archi.tect.gr/">Heracles Papatheodorou</a></h1>
			<span class="title">licensed architect, <abbr title="Diploma in Architectural Engineering">dipl.</abbr> <a href="http://www.ntua.gr/index_en.html"><abbr title="National Technical University of Athens">NTUA</abbr></a></span>
			<div class="adr">based in  <span class="locality">Athens</span>, <span class="country-name">Greece</span></div>
			twitter: <a class="url" rel="me" href="http://twitter.com/Arty2">@<span class="nickname">Arty2</span></a><br />
			email: <a class="email" href="mailto://archi@tect.gr">archi@tect.gr</span></a>
		</div>

		<a class="url" href="http://archi.tect.gr/"><img class="logo" src="http://archi.tect.gr//monogram.png" alt="monogram" /></a>

		<nav role="navigation"> <!-- use widget instead! -->
		<?php
			// wp_tag_cloud(array(
			// 	'smallest' => 0.75,
			// 	'largest' => 1.1,
			// 	'unit' => 'em'
			// ));
		?>
		</nav>
		<?php
			dynamic_sidebar('header');
		?>
	</header>

	<nav class="language" title="does not work, yet">
		<ul><!--  hide non-available language in .single -->
			<li><a href="#" hreflang="el"><abbr lang="en" title="ελληνικά">ελ</abbr></a></li>
			<li><a href="#" hreflang="en" class="active"><abbr lang="de" title="english">en</abbr></a></li>
		</ul>
	</nav>