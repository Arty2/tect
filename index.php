<?php
get_header();
get_sidebar();
?>

<main class="archive">
<?php
#Get posts only from the default category on homepage
if ( is_home() ) {
	//query_posts('cat=' . get_option('default_category'));
}
#Start The Loop
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$id = get_the_ID();
		echo '<article>'; //lang="??" per article
		echo '<a href="' . get_permalink() . '"><header>';
			echo '<h1>/' . get_the_title() . '</h1>';
			if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail();
			}
			echo '<p class="entry-summary">' . preg_replace('#</?a(\s[^>]*)?>#i', '', get_the_excerpt()) . '</p>';

		echo '</header></a>';
		echo '<footer>';
			// echo '<p class="lang">
			// 	<a href="" class="en" lang="en">en</a>
			// 	<a href="" class="el" lang="el">ελ</a>
			// 	</p>';
			// use WP's date settings / show the_modified_time() ?
			echo '<p class="time">↳ <time class="published" datetime="' . get_the_time( 'r' ) . '" title="' . __('published', 'tect') . '">' . get_the_date() . '</time></p>';
			if ( get_the_date() != get_the_modified_date() ) {
				echo '<p class="time">↺ <time class="modified" datetime="' . get_the_modified_time( 'r' ) . '" title="' . __('modified', 'tect') . '">' . get_the_modified_date() . '</time></p>';
			}
			echo get_the_tag_list('<ul class="tags"><li>','</li><li>','</li></ul>');
		echo '</footer>';
		echo '</article>';
	}
}
#End The Loop
?>
</main>
<?php

get_footer();
?>