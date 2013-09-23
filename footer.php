<?php
	//perhaps move the appendix into page footer?
	echo '<section id="appendix">';
		$tect_page_title = wp_title( '•', false, 'right' );
		$tect_page_title .= get_bloginfo( 'name' );

		echo '<h1>' . __( 'Hyperlink index', 'tect' ) . '</h1>';
		echo '<p>'
		. '<small>' . __( 'cite', 'tect' ) . ': <em>' . $tect_page_title . '</em> ('
		. __('Accessed', 'tect') . date_i18n( ' j F Y', time())
		. ') &lt;&nbsp;http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '&nbsp;&gt; '
		. '</small></p>';
		echo '<ol></ol>';
	echo '</section>';
?>
<footer>
<?php
if (!dynamic_sidebar('sidebar-footer')) { 
		//copyright notice?
	}
?>
</footer>
<?php
	wp_footer();
	if ( is_single() ) {
		echo tect_get_meta( get_the_ID(), 'tect_javascript', true, '<script>','</script> ');
	}
?>
</body>
</html>