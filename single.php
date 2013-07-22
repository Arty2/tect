<?php
get_header();
get_sidebar();

/*
	http://microformats.org/wiki/hAtom
	http://www.readability.com/developers/guidelines
*/
?>

<section id="main" class="single">
<?php
#Start The Loop
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$id = get_the_ID();
		$attribution = get_post_meta($id, 'attribution', true);

		echo '<article class="hentry">';
		echo '<header>';
			echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
			echo '<p class="entry-summary">' . get_the_excerpt() . '</p>';
			echo '<time class="published" datetime="' . get_the_time( 'r' ) . '">' . get_the_time( 'Y-m-d' ) . '</time>';
			if ( $attribution ) {
				echo '<div class="attribution">' . $attribution . '</div>';
			}
		echo '</header>';
		echo '<div class="entry-content">';
			the_content();
		echo '</div>';
		echo '<footer>';
			//echo '<time class="updates" datetime="' . get_the_time( 'r' ) . '">' . get_the_time( 'Y-m-d' ) . '</time>';
			//echo get_the_tag_list('<p class="tags"> ',' · ','</p>'); //active tags appear in main <nav>
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