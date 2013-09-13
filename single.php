<?php
get_header();
get_sidebar();

?>

<main class="single">
<?php
#Start The Loop
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$id = get_the_ID();

		echo '<article class="hentry" lang="' . tect_lang_current() . '">';
		echo '<header>';
			echo '<h1 class="entry-title"><a href="' . get_permalink() . '">/' . get_the_title() . '</a></h1>';
			echo '<div class="entry-summary">' . get_the_excerpt() . '</div>';
			echo '<p class="time">↳ <time class="published" datetime="' . get_the_time( 'r' ) . '" title="' . __('published', 'tect') . '">' . get_the_date() . '</time></p>';
			if ( get_the_date() != get_the_modified_date() ) {
				echo '<p class="time">↺ <time class="modified" datetime="' . get_the_modified_time( 'r' ) . '" title="' . __('modified', 'tect') . '">' . get_the_modified_date() . '</time></p>';
			}

			echo get_the_tag_list('<ul class="tags"><li>','</li><li>','</li></ul>');
		echo '</header>';

		$footer = get_post_meta($id, 'footer', true);
		if ( $footer ) {
			echo '<footer>' . $footer . '</footer>';
		}
		//echo '<div class="entry-content">';
			the_content();
		//echo '</div>';
		echo '</article>';
	}
}
#End The Loop
?>
</main>

<?php
get_footer();
?>