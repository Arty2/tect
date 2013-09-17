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
	<base href="<?php echo TECT_DOMAIN; ?>" />
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
	<!-- <link rel="apple-touch-icon" href="img/apple-touch-icon.png"> -->
	<!-- WiiU & 3DS detection -> redirection to be placed here -->

<?php

	wp_head();

	//http://codex.wordpress.org/Function_Reference/body_class
?> 
</head>
<body <?php body_class($body_class); ?>>
<header>
<!--[if lt IE 9]>
	<p class="notice">You are using a very old browser therefore you can't expect this website —or “the internet”— to work properly.<br>
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