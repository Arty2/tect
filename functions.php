<?php
if ( !defined('ABSPATH') ) die;
/*--------------------------------------------------------------
Utilities
--------------------------------------------------------------*/
	function tect_get_meta( $id, $key, $single = true, $before = false, $after = false ) {
		$meta = get_post_meta($id, $key, $single);
		if ( $meta ) {
			return ( $before ? $before : '' ) . $meta . ( $after ? $after : '' );
		} else {
			return false;
		}
	}

/*--------------------------------------------------------------
Theme settings
--------------------------------------------------------------*/
	
	// Define base location for use in header.php // site_url()
	//define('WP_BASE', 'http://'.dirname($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']).'/');

	// Add link to WordPress Options in Admin
	function tect_wp_options() {
		add_options_page( __('Options'), __('Options'), 'administrator', 'options.php' );
	}

	add_action( 'admin_menu', 'tect_wp_options' );
	
	// Set excerpt length
	function tect_excerpt_length( $length ) {
		return 20;
	}

	add_filter( 'excerpt_length', 'tect_excerpt_length' );

	// Excerpts for pages
	add_post_type_support( 'page', 'excerpt' );


	// http://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', array(
		// 'aside',
		// 'gallery',
		// 'link',
		'image',
		// 'quote',
		//'status',
		// 'video',
		// 'audio',
		//'chat'
	) );

	// Thumbnail settings
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 600 , 600 );
	//http://codex.wordpress.org/Plugin_API/Filter_Reference/image_size_names_choose

	// Custom header image (#logo)
	$args = array(
		'header-text'   => false,
		'default-image' => get_template_directory_uri() . '/graphics/tect.svg',
		'uploads'       => true,
		'flex-width'    => true,
		'width'         => 100,
		'flex-height'    => true,
		'height'        => 100,
	);

	add_theme_support( 'custom-header', $args );

	// Custom background
	add_theme_support( 'custom-background' );
	

	// Add classes to navigation links
	function tect_nav_newer() {
		return 'class="nav-newer"';
	}

	add_filter('previous_posts_link_attributes', 'tect_nav_newer');

	function tect_nav_older() {
		return 'class="nav-older"';
	}

	add_filter('next_posts_link_attributes', 'tect_nav_older');


/*--------------------------------------------------------------
Cleanup
--------------------------------------------------------------*/
	// Enable soil plugin - https://github.com/roots/soil
	add_theme_support('soil-clean-up');
	add_theme_support('soil-relative-urls');
	add_theme_support('soil-nice-search');
	add_theme_support('soil-disable-trackbacks');
	add_theme_support('soil-disable-asset-versioning');

	//remove extra adminbar styles
	function tect_adminbar() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}

	add_action('get_header', 'tect_adminbar');

/*--------------------------------------------------------------
Menus
--------------------------------------------------------------*/
	function tect_menus() {
		register_nav_menus(
			array(
				'navigation' => __( 'navigation' ),
			)
		);
	}
	add_action( 'init', 'tect_menus' );

/*--------------------------------------------------------------
Internationalization
--------------------------------------------------------------*/

	function tect_i18n(){
		load_theme_textdomain('tect', get_template_directory() . '/languages');
	}

	add_action('after_setup_theme', 'tect_i18n');

	/**
	 * Language switcher
	 * requires Polylang plugin
	 * reference: http://polylang.wordpress.com/documentation/documentation-for-developers/functions-reference/
	 */
	function tect_lang_switcher() {
		if ( function_exists( 'pll_the_languages' ) ) {
			$raw = pll_the_languages( array( 'raw' => 1 ) );
			$output = '<nav><ul class="languages">';
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
			$output .= '</ul></nav>';
			return $output;
		}
	}


/*--------------------------------------------------------------
wpautop() tweaks
--------------------------------------------------------------*/

	//make it run after ashortcodes
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 12);

	//remove <p>'s around lone images
	//via http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
	function tect_image_block_level( $content ) {
		return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	}

	add_filter( 'the_content', 'tect_image_block_level', 12 );

/*--------------------------------------------------------------
CSS and script enqueues
--------------------------------------------------------------*/
	function tect_enqueue() {
		wp_register_style( 'tect_style', get_bloginfo('stylesheet_url') );
		wp_enqueue_style( 'tect_style' );

		wp_register_script( 'core', get_stylesheet_directory_uri() . '/scripts/core.js', array( 'jquery' ), true );
		wp_enqueue_script( 'core' );

		wp_register_script( 'popup', get_stylesheet_directory_uri() . '/scripts/jquery.popupWindow.js', array( 'jquery' ), true );
		wp_enqueue_script( 'popup' );

		// wp_enqueue_script( 'masonry' );
	}

	add_action( 'wp_enqueue_scripts', 'tect_enqueue' );

	//custom TinyMCE styles
	add_editor_style( 'editor.css' );

/*--------------------------------------------------------------
Magnific Popup → https://github.com/dimsemenov/Magnific-Popup
	workaround based on http://ajtroxell.com/use-magnific-popup-with-wordpress-now/
	remove section once the plugin is ready: http://dimsemenov.com/plugins/magnific-popup/wordpress.html
--------------------------------------------------------------*/
	
	function tect_enqueue_magnific_popup() {
		wp_register_style( 'magnific_popup_style', get_template_directory_uri() . '/scripts/magnific-popup/magnific-popup.css' );
		wp_enqueue_style( 'magnific_popup_style' );

		wp_register_script( 'magnific_popup_script', get_template_directory_uri() . '/scripts/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'magnific_popup_script' );
		wp_register_script( 'magnific_init_script', get_template_directory_uri() . '/scripts/magnific-popup/jquery.magnific-init.js', array( 'jquery' ) );
		wp_enqueue_script( 'magnific_init_script' );
	}

	add_action( 'wp_enqueue_scripts', 'tect_enqueue_magnific_popup' );

/*--------------------------------------------------------------
Register widget areas
--------------------------------------------------------------*/

	register_sidebar(array(
		'name' => 'about',
		'id' => 'tect-about',
		'description'   => 'Defaults to blog’s name and tagline.',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'name' => 'navigation',
		'id' => 'tect-nav',
		'description'   => 'Defaults to hashtag cloud.',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'name' => 'status',
		'id' => 'tect-status',
		'description'   => __( 'Defaults to Polylang language switcher.', 'tect' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'name' => 'share',
		'id' => 'tect-share',
		'description'   => 'Defaults to no—track twitter and facebook.',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'name' => 'footer',
		'id' => 'tect-footer',
		'description'   => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

/*--------------------------------------------------------------
Tag cloud improved
via http://www.sitepoint.com/better-wordpress-tag-cloud/
--------------------------------------------------------------*/

function tect_tags($params = array()) {
	extract(shortcode_atts(array(
		'orderby' => 'name',
		'order' => 'ASC',
		'number' => '',
		'sizemin' => 1,
		'sizemax' => 5
	), $params));

	$list = ''; $min = 9999999; $max = 0;

	$tags = get_tags(array('orderby' => $orderby, 'order' => $order, 'number' => $number));
	
	foreach ($tags as $tag) { // get minimum and maximum number tag counts
		$min = min($min, $tag->count);
		$max = max($max, $tag->count);
	}
	
	foreach ($tags as $tag) { // generate tag list
		$url = get_tag_link($tag->term_id);
		$title = $tag->count .' '. _n( 'article', 'articles', $tag->count, 'tect' );
		if ($max > $min) {
			$class = 'tag-' . floor((($tag->count - $min) / ($max - $min)) * ($sizemax - $sizemin) + $sizemin);
		}
		else {
			$class = 'tag';
		}
		$list .= '<li><a href="' . $url . '" class="' . $class . '" title="' . $title . '">' . $tag->name . '</a></li>';
	}
	return '<ul class="tags">' . $list . '</ul>';
}

/*--------------------------------------------------------------
Custom fields and meta boxes
	based on http://wp.smashingmagazine.com/2011/10/04/create-custom-post-meta-boxes-wordpress/
--------------------------------------------------------------*/

	//based on http://wpsnipp.com/index.php/excerpt/add-a-character-counter-to-excerpt-metabox/
	function excerpt_count() {
	echo '<script>jQuery(document).ready(function($){ $("#excerpt").after(\'<div id="excerpt_counter"></div>\'); function excerpt_count() { var count = $("#excerpt").val(); $("#excerpt_counter").text($("<p>"+count+"</p>").text().length); } excerpt_count(); $("#excerpt").keyup( function() { excerpt_count(); }); }); </script>';
	}

	add_action( 'admin_head-post.php', 'excerpt_count');
	add_action( 'admin_head-post-new.php', 'excerpt_count');


	function tect_post_meta_boxes_add() {
		add_meta_box(
			'tect-post-time',
			esc_html__( 'Event time', 'tect' ),
			'tect_post_time_meta_box',
			'post',
			'side',
			'default'
		);
		add_meta_box(
			'tect-post-credits',
			esc_html__( 'Credits', 'tect' ),
			'tect_post_credits_meta_box',
			'post',
			'normal',
			'default'
		);
		add_meta_box(
			'tect-post-css',
			esc_html__( 'Custom post CSS', 'tect' ),
			'tect_post_css_meta_box',
			'post',
			'normal',
			'default'
		);
		add_meta_box(
			'tect-post-javascript',
			esc_html__( 'Custom post JavaScript', 'tect' ),
			'tect_post_javascript_meta_box',
			'post',
			'normal',
			'default'
		);
	}

	function tect_meta_boxes_setup() {
		add_action( 'add_meta_boxes', 'tect_post_meta_boxes_add' );
		add_action( 'save_post', 'tect_post_credits_meta_box_save', 10, 2 );
		add_action( 'save_post', 'tect_post_time_meta_box_save', 10, 2 );
		add_action( 'save_post', 'tect_post_css_meta_box_save', 10, 2 );
		add_action( 'save_post', 'tect_post_javascript_meta_box_save', 10, 2 );
	}

	add_action( 'load-post.php', 'tect_meta_boxes_setup' );
	add_action( 'load-post-new.php', 'tect_meta_boxes_setup' );

	function tect_post_time_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'tect_post_time_nonce' );
		echo '<p><label for="tect-post-time">' .
		__( 'Event time by <a href="http://en.wikipedia.org/wiki/ISO_8601" target="_blank">ISO 6801</a>.', 'tect' ) . '</label><br />
			<input class="widefat" type="text" name="tect-post-time" id="tect-post-time" size="30" value="' .
			esc_attr( get_post_meta( $object->ID, 'tect_time', true ) ) . '" /></p>';
	}

	function tect_post_credits_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'tect_post_credits_nonce' );
		echo '<label for="tect-post-credits">' .
		__( 'Refer to the guidelines for accepted structures.', 'tect' ) . '</label><br />
			<textarea class="widefat" type="text" name="tect-post-credits" id="tect-post-credits" rows="10">' .
			esc_attr( get_post_meta( $object->ID, 'tect_credits', true ) ) . '</textarea>';
	}

	function tect_post_css_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'tect_post_css_nonce' );
		echo '<label for="tect-post-css">' .
		__( 'Caution: not validated automagically.', 'tect' ) . '</label><br />
			<textarea class="widefat" type="text" name="tect-post-css" id="tect-post-css" rows="10">' .
			esc_attr( get_post_meta( $object->ID, 'tect_css', true ) ) . '</textarea>';
	}

	function tect_post_javascript_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'tect_post_javascript_nonce' );
		echo '<label for="tect-post-javascript">' .
		__( 'Caution: not validated automagically.', 'tect' ) . '</label><br />
			<textarea class="widefat" type="text" name="tect-post-javascript" id="tect-post-javascript" rows="10">' .
			esc_attr( get_post_meta( $object->ID, 'tect_javascript', true ) ) . '</textarea>';
	}

	function tect_post_time_meta_box_save( $post_id, $post ) { tect_post_meta_box_save( 'time', $post_id, $post ); }
	function tect_post_credits_meta_box_save( $post_id, $post ) { tect_post_meta_box_save( 'credits', $post_id, $post ); }
	function tect_post_css_meta_box_save( $post_id, $post ) { tect_post_meta_box_save( 'css', $post_id, $post ); }
	function tect_post_javascript_meta_box_save( $post_id, $post ) { tect_post_meta_box_save( 'javascript', $post_id, $post ); }

	function tect_post_meta_box_save( $field, $post_id, $post ) {
		if ( !isset( $_POST[ 'tect_post_' . $field . '_nonce' ] ) || !wp_verify_nonce( $_POST[ 'tect_post_' . $field . '_nonce' ], basename( __FILE__ ) ) ) {
			return $post_id;
		}

		$post_type = get_post_type_object( $post->post_type );
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}

		$new_meta_value = ( isset( $_POST[ 'tect-post-' . $field ] ) ? $_POST[ 'tect-post-' . $field ] : '' );
		$meta_key = 'tect_' . $field;
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		if ( $new_meta_value && $meta_value === '' ) {
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		} elseif ( $new_meta_value === '' && $meta_value ) {
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}


/*--------------------------------------------------------------
Hide password protected posts from timeline
--------------------------------------------------------------*/
function tect_hide_protected($where = '') {
	if (!is_single() && !is_admin()) {
		$where .= " AND post_password = ''";
	}
	return $where;
}
add_filter( 'posts_where', 'tect_hide_protected' );

/*--------------------------------------------------------------
Sort posts by key of 'tect_time' or post_date if it doesn't exist
--------------------------------------------------------------*/
	//LEFT JOIN the meta table so that we can sort by it
	function tect_query_join($join) { 
		global $wp_query, $wpdb;
		if ( is_home() || is_archive() || is_search() ) { 
			$join .= "LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id AND meta_key = 'tect_time' ";
			//custom categories to display here?
		}
		return $join;
	}

	add_filter( 'posts_join', 'tect_query_join' );

	//sort by custom field by key of e.g. 'tect_time' or post_date if it doesn't exist
	function tect_query_order( $orderby ) {
		if ( is_home() || is_archive() || is_search() ) { 
			$orderby = "COALESCE(meta_value, post_date) DESC";
		}
		return $orderby;
	}

	add_filter( 'posts_orderby', 'tect_query_order' );

/*--------------------------------------------------------------
HTML5 captions
--------------------------------------------------------------*/
/**
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

/*--------------------------------------------------------------
Improved gallery code
--------------------------------------------------------------*/

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
			//$output .= isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false) : wp_get_attachment_link($id, $size, true);
			$output .= isset($attr['link']) && 'file' == $attr['link'] ? '<a href="'. wp_get_attachment_url($id) .'" title="'. get_post($id)->post_excerpt .'">'. wp_get_attachment_image($id, $size) .'</a>' : wp_get_attachment_link($id, $size, true);
			//on column count, echo <br />
		}
		$output .= "</div>\n";
		return $output;
	}

	add_filter( "post_gallery", "tect_gallery", 10, 2 );


/*--------------------------------------------------------------
Make WordPress URLs hyper-relative! (domain agnostic)
deprecated by soil plugin, required localhost on other device
--------------------------------------------------------------*/
/*	function tect_buffer_filter( $buffer ) {
		return preg_replace(
			array(
			'@' . get_bloginfo( 'url' ) . '/@',
			'@="\./@',
			),
		array(
			'//'.dirname($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']).'/',
			'="' . '//'.dirname($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']).'/',
			),
		$buffer );
	}

	function tect_buffer_start() { ob_start( 'tect_buffer_filter' ); }

	function tect_buffer_end() { ob_end_flush(); }

	add_action( 'wp_head', 'tect_buffer_start', 1 );
	add_action( 'wp_footer', 'tect_buffer_end', 9999 );
*/

/*--------------------------------------------------------------
TGM Plugin Activation
http://tgmpluginactivation.com/
--------------------------------------------------------------*/
require_once dirname( __FILE__ ) . '/utilities/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
 
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'         => 'GitHub Updater',
			'slug'         => 'github-updater',
			'source'       => 'https://github.com/afragen/github-updater/archive/master.zip',
			'required'     => true,
			'external_url' => 'https://github.com/afragen/github-updater',
		),
		array(
			'name'         => 'tect-media',
			'slug'         => 'tect-media',
			'source'       => 'https://github.com/Arty2/tect-media/archive/master.zip',
			'required'     => false,
			'external_url' => 'https://github.com/Arty2/tect-media',
		),
		array(
			'name'         => 'wp-toolbar-collapse',
			'slug'         => 'wp-toolbar-collapse',
			'source'       => 'https://github.com/Arty2/wp-toolbar-collapse/archive/master.zip',
			'required'     => false,
			'external_url' => 'https://github.com/Arty2/wp-toolbar-collapse',
		),
		array(
			'name'         => 'Soil',
			'slug'         => 'soil',
			'source'       => 'https://github.com/roots/soil/archive/master.zip',
			'required'     => false,
			'external_url' => 'http://roots.io/plugins/soil/',
		),
		array(
			'name'         => 'Magic Widgets',
			'slug'         => 'magic-widgets',
			'required'     => false,
		),
		array(
			'name'         => 'Polylang',
			'slug'         => 'polylang',
			'required'     => false,
		),
		array(
			'name'         => 'JP Markdown',
			'slug'         => 'jetpack-markdown',
			'required'     => false,
		),
		array(
			'name'         => 'Greeklish-permalink',
			'slug'         => 'greeklish-permalink',
			'required'     => false,
		),
		array(
			'name'         => 'Font emoticons',
			'slug'         => 'font-emoticons',
			'required'     => false,
		),
		array(
			'name'         => 'Regenerate Thumbnails',
			'slug'         => 'regenerate-thumbnails',
			'required'     => false,
		),
		array(
			'name'         => 'Prism Syntax Highlighter',
			'slug'         => 'prism-syntax-highlighter',
			'required'     => false,
		),
		array(
			'name'         => 'Facebook OGraph and Twitter Cards',
			'slug'         => 'wonderm00ns-simple-facebook-open-graph-tags',
			'required'     => false,
		),
 
	);
 

	$config = array(
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'is_automatic' => false,
		'message'      => __( 'Hand picked plugins that work well with this theme.', 'tect' ),
	);
 
	tgmpa( $plugins, $config );
 
}


/*--------------------------------------------------------------
DEBUG
--------------------------------------------------------------*/
	function tect_debug() {
		define('WP_DEBUG', true);
		define('SAVEQUERIES', true);
		define('WP_DEBUG_DISPLAY', true);
		// define('WP_DEBUG_LOG', true);

		$stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory',
			get_num_queries(),
			timer_stop( 0, 3 ),
			memory_get_peak_usage() / 1024 / 1024
			);

		echo $stat;
	}
	// add_action( 'wp_footer', 'tect_debug', 20 );



?>