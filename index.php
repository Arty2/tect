<?php
get_header();
get_sidebar();
?>

<main class="archive">
<?php
// Get posts only from the default category on homepage
if ( is_home() ) {
	// create setting in options
	// query_posts('cat=' . get_option('default_category'));
	// query_posts('orderby=meta_value&meta_key=tect_time&order=DESC');
	
}
// Start The Loop
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$id = get_the_ID();
		$slug = basename(get_permalink());

		if ( get_the_title() != $slug ) {
			$excerpt = '<h2 class="entry-title">' . get_the_title() . '</h2>';
		}
		$excerpt .= preg_replace( '#</?a(\s[^>]*)?>#i', '', get_the_excerpt() );

		$post_class = implode( ' ',  get_post_class() );
		if ( has_post_thumbnail() ) {
			$post_class .= ' illustrated';
		}

		echo '<article class="' . $post_class . '">'; // http://codex.wordpress.org/Function_Reference/post_class//lang="??" per article
		echo '<header>';
			echo '<h1 rel="bookmark">/' . basename(get_permalink()) . '</h1>';

			echo '<a href="' . get_permalink() . '"><figure>';
			if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail();
			}
			echo '<figcaption>' . $excerpt . '</figcaption>';
			echo '</figure></a>';
			
			echo '<p class="time">';
			echo tect_get_meta( $id, 'tect_time', true, '<time datetime="' . tect_get_meta( $id, 'tect_time') . '">','</time> ');
			echo '<time class="published" datetime="' . get_the_time( 'r' ) . '" title="' . __('published', 'tect') . '">' . get_the_date() . '</time>';
			if ( get_the_date() != get_the_modified_date() ) {
				echo ' <time class="updated" datetime="' . get_the_modified_time( 'r' ) . '" title="' . __('updated', 'tect') . '">' . get_the_modified_date() . '</time>';
			}
			echo '</p>';

			echo get_the_tag_list( '<ul class="tags"><li>','</li><li>','</li></ul>' );
		echo '</header>';
		echo '</article>';

		$excerpt = '';
		$post_class = '';
	}

	echo '<div class="pagination">';
	echo '<a class="nav-newer" href="' . get_previous_posts_page_link() . '">' . __('newer', 'tect') . '</a>';
	echo '<a class="nav-older" href="' . get_next_posts_page_link() . '">' . __('older', 'tect') . '</a>';
	echo '</div>';
} else {
	echo '<p>' . __( 'In the beginning there was only chaos.', 'tect' ) . '</p>';
}
// End The Loop
?>
</main>
<?php

get_footer();
?>