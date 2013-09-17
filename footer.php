<section id="appendix">
<?php
	$tect_page_title = wp_title('•', false, 'right');
	$tect_page_title .= get_bloginfo('name');

	echo '<h1>' . __('Hyperlink index', 'tect') . '</h1>';
	echo '<p><button title="' . __('Make a Hyperlink index.', 'tect') . '">&#x1f4c3;</button>'
	. '<small><em>' . $tect_page_title . '</em> ('
	. __('Accessed', 'tect') . date_i18n( ' j F Y', time())
	. ') &lt;&nbsp;http://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'] . '&nbsp;&gt; '
	. '</small></p>';
	echo '<ol></ol>';

?>
</section>
<footer>
<?php
if (!dynamic_sidebar('sidebar-footer')) { 
		//copyright notice?
	}
?>
</footer>
<?php wp_footer(); ?>
</body>
</html>