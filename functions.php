<?php

	#add support rules
	add_theme_support('post-thumbnails');

	#allow Twitter embeds
	add_filter('oembed_providers','tect_twitter_oembed');
	function tect_twitter_oembed($a) {
		$a['#http(s)?://(www\.)?twitter.com/.+?/status(es)?/.*#i'] = array('http://api.twitter.com/1/statuses/oembed.{format}', true);
		return $a;
	}

	#adminbar addons
	if ( is_admin_bar_showing() ) {
		add_action('wp_head', 'tect_admin_bar_bottom');
		add_action('admin_bar_menu', 'tect_admin_bar_host',25);
	}
		#stick to bottom
		function tect_admin_bar_bottom() {
			echo '<style type="text/css" media="screen">body{margin-top:-28px}#wpadminbar{top:auto!important;-moz-background-clip:padding;-webkit-background-clip:padding;background-clip:padding-box;bottom:-28px;border-top:28px solid transparent}#wpadminbar:hover{bottom:0;border-top:0}#wpadminbar .quicklinks .ab-sub-wrapper{bottom:28px}#wpadminbar .menupop .ab-sub-wrapper,#wpadminbar .shortlink-input{border-width:1px 1px 0 1px;-moz-box-shadow:0 -4px 4px rgba(0,0,0,0.2);-webkit-box-shadow:0 -4px 4px rgba(0,0,0,0.2);box-shadow:0 -4px 4px rgba(0,0,0,0.2)}#wpadminbar .quicklinks .menupop ul#wp-admin-bar-wp-logo-default{background-color:#eee}#wpadminbar .quicklinks .menupop ul#wp-admin-bar-wp-logo-external{background-color:white}body.wp-admin div#wpwrap div#footer{bottom:28px!important}</style>';
		}

		#switch between localhost and www
		function tect_admin_bar_host() {
			global $wp_admin_bar;

			if ( $_SERVER['HTTP_HOST'] == 'localhost' ) {
				$href = 'http://archi.tect.gr'.str_replace('/tectgr/archi.tect.gr', '', $_SERVER['REQUEST_URI']);
				$title = 'offline';
			}
			else {
				$href = 'http://localhost/tectgr/archi.tect.gr'.$_SERVER['REQUEST_URI'];
				$title = 'www';
			}

			$wp_admin_bar->add_menu(array(
				'id' => 'host',
				'title' => $title,
				'href' => $href
			) );
		}

	#register [shortcodes]
	add_action('init', 'tect_shortcodes');
	function tect_shortcodes() {
		add_shortcode('@', 'tect_at');
		add_shortcode('page', 'tect_page');
	}
		#shortcode / get page content by slug
		function tect_page($atts) {
			extract(shortcode_atts(array(
				'slug' => 'colophon',
			), $atts));
			$post = get_page_by_path($slug);
			//watch for infinite inclusion loop here
			$content = apply_filters('the_content', $post->post_content);
			return $content;
		}
		#shortcode / show the date (stamp) according to WP's settings
		//todo

	#register widget areas
	register_sidebar(array(
		'name' => 'footer'
		));

	#the update mechanism
	require('includes/theme-updates/theme-update-checker.php');
	$tect_update_checker = new ThemeUpdateChecker(
		'tect',
		'https://raw.github.com/Arty2/tect/master/update.json'
	);
?>