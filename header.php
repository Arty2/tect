<?php
	if ( stripos($_SERVER['HTTP_USER_AGENT'], 'Nintendo') !== false ) {
		header('Location: http://tect.gr/3ds/');
	}
	if ( is_singular() ) {
		//$body_class = 'single';
	}
?>
<!DOCTYPE html>
<html lang="<?php echo get_locale(); ?>">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
<?php
	$tect_page_title = wp_title('•', false, 'right');
	$tect_page_title .= get_bloginfo('name');
	if ( is_home() || is_front_page() ) {
		$tect_page_title .= ' • ' . get_bloginfo('description');
	}

	echo $tect_page_title;
?>
	</title>
	<meta name="description" content="
<?php if ( (is_home()) || (is_front_page()) ) {
	//fix that bit of code
	echo ('Your main description goes here');
} elseif(is_category()) {
	echo category_description();
} elseif(is_tag()) {
	echo '-tag archive page for this blog' . single_tag_title();
} elseif(is_month()) {
	echo 'archive page for this blog' . the_time('F, Y');
} else {
	echo get_post_meta($post->ID, "Metadescription", true);
}?>">
	<base href="<?php echo site_url('/'); ?>" />
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
	<!-- <link rel="apple-touch-icon" href="img/apple-touch-icon.png"> -->
	<!-- WiiU & 3DS detection -> redirection to be placed here -->

<?php

	wp_head();
	
	if ( is_single() ) {
		//add custom post CSS
		echo tect_get_meta( get_the_ID(), 'tect_css', true, '<style type="text/css" media="screen">','</style> ');
	}
?>

</head>
<body <?php body_class( $body_class ); //http://codex.wordpress.org/Function_Reference/body_class ?>>
<header role="banner">
<!--[if lt IE 11]>
	<p class="notice"><?php _e('You are using a very old browser therefore you can’t expect this website —or “the internet”— to work properly.<br>
	Do yourself a favor and <a href="http://browsehappy.com/">download a better one</a>.','tect'); ?>
	</p>
<![endif]-->
	<div id="about">
<?php
	if ( !dynamic_sidebar( 'tect-about' ) ) {
		echo  '<h1>' . get_bloginfo( 'name' ) . '</h1>';
		echo  get_bloginfo( 'description' );
	}
?>
	</div>
	<nav role="navigation">
<?php
	if ( !dynamic_sidebar( 'tect-nav' ) ) { 
		echo '<ul class="tags"><li>';
		wp_tag_cloud(array(
			'smallest' => 1, //0.8
			'largest' => 1, //1.1
			'unit' => 'rem',
			'separator' => '</li><li>',
		));
		echo '</ul>';
	}
?>
	</nav>
<?php	
	//echo tect_lang_switcher();

	echo '<div id="banner">
		<a id="logo" href="' . get_bloginfo('url') . '">';
		if ( get_header_image() != '' ) {
			echo '<img src="' . get_header_image() . '" alt="' . get_bloginfo('name') . '" />';
		} else {
			bloginfo('name');
		}
		echo '</a>';
		echo '<div id="status">';
			if ( !dynamic_sidebar( 'tect-status' ) ) {
				echo tect_lang_switcher();
				// echo 'some more stuff that I want to say';
			}
		echo '</div>';
	echo '</div>';
?>

</header>