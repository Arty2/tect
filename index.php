<?php
get_header();
get_sidebar();
?>

<section id="main" class="archive">
<?php
#Start The Loop
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$id = get_the_ID();
		echo '<article>'; //lang="??" per article
		echo '<a href="' . get_permalink() . '"><header>';
			echo '<h1>' . get_the_title() . '</h1>';
			if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail($id, array(300,300));
			}
			echo '<p>' . get_the_excerpt() . '</p>';

		echo '</header></a>';
		echo '<footer>';
			echo '<time datetime="' . get_the_time( 'r' ) . '">' . get_the_time( 'Ymd' ) . '</time>'; // use WP's date settings
			echo get_the_tag_list('<p class="tags"> # ',', ','</p>');
		echo '</footer>';
		echo '</article>';
	}
}
#End The Loop
?>
</section>

<?php

get_footer();
?>