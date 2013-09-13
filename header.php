<?php
	if ( stripos($_SERVER['HTTP_USER_AGENT'], 'Nintendo') !== false ) {
		header('Location: http://tect.gr/3ds/');
	}
	if ( is_singular() ) {
		//$body_class = 'single';
	}
?>
<!DOCTYPE html>
<html lang="<?php echo tect_lang_current(); ?>">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
<?php
	wp_title('•', true, 'right');
	bloginfo('name');
	if ( is_home() || is_front_page() ) {
		echo ' • ';
		bloginfo('description');
	}
?>
	</title>
	<base href="<?php echo 'http://'.dirname($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']).'/'; ?>" />
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
	<!-- <link rel="apple-touch-icon" href="img/apple-touch-icon.png"> -->
	<!-- WiiU & 3DS detection -> redirection to be placed here -->

<?php

	//Sublime's LiveReload; really messes loading times when online
	if ( $_SERVER['HTTP_HOST'] == 'localhost' ) {
	//echo '<script src="http://localhost:35729/livereload.js?snipver=1"></script>';
	}

	wp_head();

	//http://codex.wordpress.org/Function_Reference/body_class
?> 
</head>
<body <?php body_class($body_class); ?>>
<header>
<!--[if lt IE 9]>
	<p class="oldbrowser">You are using a very old browser therefore you can't expect this website —or “the internet”— to work properly.<br>
	Do yourself a favor and <a href="http://browsehappy.com/">download a better one</a>.
	</p>
<![endif]-->
	<div id="about">
<?php
	if (!dynamic_sidebar('sidebar-about')) { 
		bloginfo('description');
	}
?>
	</div>
	<nav role="navigation">
<?php
	if (!dynamic_sidebar('sidebar-nav')) { 
		echo '<ul class="tags"><li>';
		wp_tag_cloud(array(
			'smallest' => 0.8,
			'largest' => 1.1,
			'unit' => 'rem',
			'separator' => '</li><li>',
		));
		echo '</ul>';
	}
?>
	</nav>
<?php	
	//echo tect_lang_switcher();

	echo '<div id="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_header_image() . '" alt="' . get_bloginfo('name') . '" /></a></div>'
?>

</header>
<?php echo tect_lang_switcher(); ?>