<?php

	/**
	* Theme support rules
	*/

	add_theme_support('post-thumbnails');
	set_post_thumbnail_size( 300, 300, true );

	/**
	* Register widget areas
	*/

	register_sidebar(array(
		'name' => 'footer'
		));

	/**
	* Allow Twitter embeds
	* ! remove when this is built into the core
	*/

	add_filter('oembed_providers','tect_twitter_oembed');
	function tect_twitter_oembed($a) {
		$a['#http(s)?://(www\.)?twitter.com/.+?/status(es)?/.*#i'] = array('http://api.twitter.com/1/statuses/oembed.{format}', true);
		return $a;
	}

	/**
	* Register theme shortcodes
	*/

	add_action( 'init', 'tect_shortcodes' );
	function tect_shortcodes() {
		add_shortcode( '@', 'tect_at' );
		add_shortcode( 'page', 'tect_page' );
	}
		//shortcode / get page content by slug
		function tect_page( $atts ) {
			extract( shortcode_atts( array(
				'slug' => 'colophon',
			), $atts));
			$post = get_page_by_path( $slug );
			//watch for infinite inclusion loop here!
			$content = apply_filters( 'the_content', $post->post_content );
			return $content;
		}

	/**
	* Admin Bar changes
	*/

	if ( is_admin_bar_showing() ) {
		add_action( 'wp_head', 'tect_admin_bar_bottom' );
		add_action( 'admin_bar_menu', 'tect_admin_bar_host', 25 );
	}
		//stick to bottom
		function tect_admin_bar_bottom() {
			echo '<style type="text/css" media="screen">body{margin-top:-28px}#wpadminbar{top:auto!important;-moz-background-clip:padding;-webkit-background-clip:padding;background-clip:padding-box;bottom:-28px;border-top:28px solid transparent}#wpadminbar:hover{bottom:0;border-top:0}#wpadminbar .quicklinks .ab-sub-wrapper{bottom:28px}#wpadminbar .menupop .ab-sub-wrapper,#wpadminbar .shortlink-input{border-width:1px 1px 0 1px;-moz-box-shadow:0 -4px 4px rgba(0,0,0,0.2);-webkit-box-shadow:0 -4px 4px rgba(0,0,0,0.2);box-shadow:0 -4px 4px rgba(0,0,0,0.2)}#wpadminbar .quicklinks .menupop ul#wp-admin-bar-wp-logo-default{background-color:#eee}#wpadminbar .quicklinks .menupop ul#wp-admin-bar-wp-logo-external{background-color:white}body.wp-admin div#wpwrap div#footer{bottom:28px!important}</style>';
		}

		//toggle between localhost and www
		function tect_admin_bar_host() {
			global $wp_admin_bar;

			if ( $_SERVER['HTTP_HOST'] == 'localhost' ) {
				$href = 'http://archi.tect.gr' . str_replace( '/tectgr/archi.tect.gr', '', $_SERVER['REQUEST_URI'] );
				$title = 'offline';
			}
			else {
				$href = 'http://localhost/tectgr/archi.tect.gr' . $_SERVER['REQUEST_URI'];
				$title = 'www';
			}

			$wp_admin_bar->add_menu(array(
				'id' => 'host',
				'title' => $title,
				'href' => $href
			) );
		}
	
	/**
	* WordPress-like update mechanism
	* via http://w-shadow.com/blog/2011/06/02/automatic-updates-for-commercial-themes/
	* ! tentantive
	*/

	require( 'includes/theme-updates/theme-update-checker.php' );
	$tect_update_checker = new ThemeUpdateChecker(
		'tect',
		'https://raw.github.com/Arty2/tect/master/update.json'
	);

	/**
	* HTML5 captions
	* based on http://writings.orangegnome.com/writes/improved-html5-wordpress-captions/
	*/

	function tect_img_caption_shortcode_filter( $val, $attr, $content = null ) {
		extract(shortcode_atts(array(
			'id'	=> '',
			'align'	=> '',
			'width'	=> '',
			'caption' => ''
		), $attr));

		if ( 1 > (int) $width || empty( $caption ) ) {
			return $val;
		}

		return '<figure id="' . $id . '" class="' . esc_attr($align) . '">'
		. do_shortcode( $content ) . '<figcaption>' . $caption . '</figcaption></figure>';
	}

	add_filter( 'img_caption_shortcode', 'tect_img_caption_shortcode_filter', 10, 3 );
	
	add_shortcode( 'wp_caption', 'fixed_img_caption_shortcode' );
	add_shortcode( 'caption', 'fixed_img_caption_shortcode' );

	/**
	* Change behaviour of <img>'s
	*/

	//remove <p>'s around lone images
	function filter_ptags_on_images( $content ) {
		return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	}

	add_filter( 'the_content', 'filter_ptags_on_images' );

	//based on http://www.sitepoint.com/wordpress-change-img-tag-html/
	//only return simplified align classes ( left, right )
	function image_tag_class( $class, $id, $align, $size ) {
		return ( $align != 'none' ? $align : '' );
	}

	add_filter( 'get_image_tag_class', 'image_tag_class', 0, 4 );

	//edit add media replacements
	function image_tag( $html, $id, $alt, $title ) {
		return preg_replace(
			array(
			'@' . get_bloginfo( 'url' ) . '@', // make src and href relative
			'/(width|height)="\d*"\s/', // remove width & height
			),
		array(
			'.',
			'',
			),
		$html );
	}

	add_filter( 'get_image_tag', 'image_tag', 10, 4 );
	add_filter( 'image_send_to_editor', 'image_tag', 10, 4 ); // 'post_thumbnail_html' too ?

	/**
	* Magnific Popup → https://github.com/dimsemenov/Magnific-Popup
	* workaround based on http://ajtroxell.com/use-magnific-popup-with-wordpress-now/
	* ! remove section once the plugin is ready: http://dimsemenov.com/plugins/magnific-popup/wordpress.html
	*/
	
	function enqueue_magnific_popup_styles() {
		wp_register_style( 'magnific_popup_style', get_stylesheet_directory_uri() . '/magnific-popup/magnific-popup.css' );
		wp_enqueue_style( 'magnific_popup_style' );
	}

	add_action('wp_enqueue_scripts', 'enqueue_magnific_popup_styles');

	function enqueue_magnific_popup_scripts() {
		wp_register_script( 'magnific_popup_script',get_stylesheet_directory_uri() . '/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'magnific_popup_script' );
		wp_register_script( 'magnific_init_script', get_stylesheet_directory_uri() . '/magnific-popup/jquery.magnific-init.js', array( 'jquery' ) );
		wp_enqueue_script( 'magnific_init_script' );
	}

	add_action( 'wp_enqueue_scripts', 'enqueue_magnific_popup_scripts' );
?>