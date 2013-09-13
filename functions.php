<?php
/**
* Utilities
*/
	function add_filters( $tags, $function ) {
		foreach( $tags as $tag ) {
			add_filter( $tag, $function );
		}
	}

/**
* Wordpress settings
*/

	function tect_excerpt_length( $length ) {
		return 20;
	}

	add_filter( 'excerpt_length', 'tect_excerpt_length' );

	add_theme_support('post-thumbnails');
	set_post_thumbnail_size( 600 );

	//change upload directory
	//add this to theme options
	if ( !is_multisite() ) {
		update_option( 'upload_path', 'media' );
	}

/**
* Internationalization
*/

	function tect_i18n() {
		load_theme_textdomain( 'tect', get_template_directory() );
	}

	add_action( 'after_setup_theme', 'tect_i18n' );

	//get current language
	function tect_lang_current() {
		if ( function_exists( 'pll_the_languages' ) ) { //requires Polylang plugin
			return pll_current_language('locale');
		} else {
			return 'en'; //default theme language
		}
	}
	//Language switcher
	function tect_lang_switcher() {
		if ( function_exists( 'pll_the_languages' ) ) {
			//requires Polylang plugin
			//http://polylang.wordpress.com/documentation/documentation-for-developers/functions-reference/
			$raw = pll_the_languages( array( 'raw' => 1 ) );
			$output = '<ul class="languages">';
			foreach ( $raw as $lang ) {
				if ( !$lang['no_translation'] ) {
					if ( $lang['current_lang'] ) {
						$output .= '<li><a class="active"';
					} else {
						$output .= '<li><a';
						$output .= ' href="' . $lang['url'] . '" hreflang="' . $lang['slug'] . '"';
					}
					$output .= ' lang="' . $lang['slug'] . '" title="' . $lang['name'] . '" >';
					$output .= mb_strtolower( mb_substr( $lang['name'] , 0, 2) ) . '</a></li>';
				}
			}
			$output .= '</ul>';
			return $output;
		}
	}

/**
* Register widget areas
*/

	register_sidebar(array(
		'name' => 'about',
		'id' => 'sidebar-about',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'name' => 'nav',
		'id' => 'sidebar-nav',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'name' => 'footer',
		'id' => 'sidebar-footer',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

	//add_action( 'widgets_init', array ( 'Text Unfiltered', 'register' ), 20 );

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
* Custom header image (#logo)
*/
	$args = array(
		'header-text'   => false,
		'default-image' => get_template_directory_uri() . '/graphics/logo.png',
		'uploads'       => true,
		'flex-width'    => true,
		'width'         => 250,
		'flex-height'    => true,
		'height'        => 250,
	);
	add_theme_support( 'custom-header', $args );


/**
* wpautop() fixes
*/

	//make it run after ashortcodes
	remove_filter( 'the_content', 'wpautop' );
 	add_filter( 'the_content', 'wpautop' , 12);

	//remove <p>'s around lone images
	//need to replace this with something that doesn't filter the whole content…
	//via http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
	function tect_image_block_level( $content ) {
		return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	}

	add_filter( 'the_content', 'tect_image_block_level', 12 );

/**
* CSS and script enqueues
*/
	function tect_enqueue() {
		wp_register_style( 'tect_style', get_bloginfo('stylesheet_url') );
		wp_enqueue_style( 'tect_style' );

		wp_register_script( 'core', get_stylesheet_directory_uri() . '/scripts/core.js', array( 'jquery' ), true );
		wp_enqueue_script( 'core' );
	}

	add_action( 'wp_enqueue_scripts', 'tect_enqueue' );

/**
* Prism.js
*/

	function tect_enqueue_prism() {
		wp_register_style( 'prism_style', get_template_directory_uri() . '/includes/prism/prism.css' );
		wp_enqueue_style( 'prism_style' );

		wp_register_script( 'prism_script', get_template_directory_uri() . '/includes/prism/prism.js', false, true );
		wp_enqueue_script( 'prism_script' );
	}

	add_action( 'wp_enqueue_scripts', 'tect_enqueue_prism' );

/**
* Magnific Popup → https://github.com/dimsemenov/Magnific-Popup
* workaround based on http://ajtroxell.com/use-magnific-popup-with-wordpress-now/
* ! remove section once the plugin is ready: http://dimsemenov.com/plugins/magnific-popup/wordpress.html
*/
	
	function tect_enqueue_magnific_popup() {
		wp_register_style( 'magnific_popup_style', get_template_directory_uri() . '/includes/magnific-popup/magnific-popup.css' );
		wp_enqueue_style( 'magnific_popup_style' );

		wp_register_script( 'magnific_popup_script', get_template_directory_uri() . '/includes/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'magnific_popup_script' );
		wp_register_script( 'magnific_init_script', get_template_directory_uri() . '/includes/magnific-popup/jquery.magnific-init.js', array( 'jquery' ) );
		wp_enqueue_script( 'magnific_init_script' );
	}

	add_action( 'wp_enqueue_scripts', 'tect_enqueue_magnific_popup' );

/**
* Allow Twitter embeds
* ! remove when this is built into the core
*/

	// add_filter('oembed_providers','tect_twitter_oembed');
	// function tect_twitter_oembed($a) {
	// 	$a['#http(s)?://(www\.)?twitter.com/.+?/status(es)?/.*#i'] = array('http://api.twitter.com/1/statuses/oembed.{format}', true);
	// 	return $a;
	// }

/**
* Admin Bar mofications
*/
		//simple collapse to top, opens on :hover
		function tect_adminbar_collapse() {
			echo '<style type="text/css" media="screen">html{margin-top:0!important}#wpadminbar{top:-28px;border-bottom:28px solid transparent;-moz-background-clip:padding;-webkit-background-clip:padding;background-clip:padding-box;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box}
#wpadminbar:hover{top:0}</style>';
		}

		//toggle between localhost and www
		function tect_admin_bar_host() {
			global $wp_admin_bar;

			if ( $_SERVER['HTTP_HOST'] == 'localhost' ) {
				$href = 'http://archi.tect.gr' . str_replace( '/tectgr/archi.tect.gr', '', $_SERVER['REQUEST_URI'] );
				$title = 'offline';
			} else {
				$href = 'http://localhost/tectgr/archi.tect.gr' . $_SERVER['REQUEST_URI'];
				$title = 'www';
			}

			$wp_admin_bar->add_menu(array(
				'id' => 'host',
				'title' => $title,
				'href' => $href
			) );
		}

		if ( is_admin_bar_showing() ) {
			add_action( 'wp_head', 'tect_adminbar_collapse', 99 );
			add_action( 'admin_bar_menu', 'tect_admin_bar_host', 25 );
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

	function tect_caption( $val, $attr, $content = null ) {
		extract(shortcode_atts(array(
			'id'	=> '',
			'align'	=> '',
			'width'	=> '',
			'caption' => '',
		), $attr));

		if ( 1 > (int) $width || empty( $caption ) ) {
			return $val;
		}

		return '<figure class="' . esc_attr($align) . '"' . ($width > 1 ? ' style="width:' . $width . 'px;"': '') . '>' // id="' . $id . '" class="' . esc_attr($align) . '"
		. do_shortcode( $content ) . '<figcaption>' . $caption . '</figcaption></figure>';
	}

	add_filter( 'img_caption_shortcode', 'tect_caption', 10, 3 );

/**
* Improved gallery code
*/

	//based on http://wordpress.stackexchange.com/a/57702/37483
	function tect_gallery($output, $attr) {
		global $post;
		static $instance = 0;
		$instance++;

		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			// 'itemtag'    => 'dl',
			// 'icontag'    => 'dt',
			// 'captiontag' => 'dd',
			// 'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => '',
		), $attr));

		$id = intval($id);
		if ( 'RAND' == $order ) { $orderby = 'none'; }

		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) ) { return ''; }

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}

		$size_class = sanitize_html_class( $size );

		$selector = "gallery-{$instance}";
		$output = "<div id='$selector' class='gallery'>";
		foreach ( $attachments as $id => $attachment ) {
			$output .= isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false) : wp_get_attachment_link($id, $size, true);
			//on column count, echo <br />
		}
		$output .= "</div>\n";
		return $output;
	}

	add_filter( "post_gallery", "tect_gallery", 10, 2 );

/**
* Image related improvements
*/

	//based on http://www.sitepoint.com/wordpress-change-img-tag-html/
	//remove whatever is too scarcely used: id, alignnone, size-whatever
	function tect_image_tag_class( $class, $id, $align, $size ) {
		return ( $align != 'none' ? 'align' . $align : '' );
	}

	add_filter( 'get_image_tag_class', 'tect_image_tag_class', 0, 4 );

	//edit add media replacements
	function tect_image_tag( $html, $id, $alt, $title ) {
		return preg_replace(
			array(
			'@' . get_bloginfo( 'url' ) . '@', // make src and href relative, borks visual editor!
			//'/(width|height)="\d*"\s/', // remove width & height
			),
		array(
			'.',
			//'',
			),
		$html );
	}

	add_filter( 'get_image_tag', 'tect_image_tag', 10, 4 );
	add_filter( 'image_send_to_editor', 'tect_image_tag', 10, 4 ); // 'post_thumbnail_html' too ?


/**
* Make WordPress URLs hyper-relative!
* this isn't bug free, but will work for now
*/
	function tect_buffer_filter( $buffer ) {
		return preg_replace(
			array(
			'@' . get_bloginfo( 'url' ) . '@',
			),
		array(
			'.',
			),
		$buffer );
	}

	function tect_buffer_start() { ob_start( 'tect_buffer_filter' ); }

	function tect_buffer_end() { ob_end_flush(); }

	add_action( 'wp_head', 'tect_buffer_start', 1 );
	add_action( 'wp_footer', 'tect_buffer_end', 9999 ); //admin-bar has annoyingly low priority
?>