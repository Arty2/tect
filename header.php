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
	<title>
	<?php
		echo get_bloginfo('name').' // '.get_bloginfo('description');
	?>
	</title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="shortcut icon" href="./favicon.ico">
	<!-- WiiU & 3DS detection -> redirection -->
	 <?php wp_head(); ?> 
</head>
<body <?php body_class($body_class); ?>>