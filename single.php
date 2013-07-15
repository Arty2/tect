<?php
get_header();
get_sidebar();
?>

<section id="main" class="single">
<?php
#Start The Loop
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$id = get_the_ID();
		echo '<article>';
		echo '<header>';
			// if ( has_post_thumbnail() ) {
			// 	echo '<aside>' . get_the_post_thumbnail($id, array(300,300)) . '</aside>';
			// }
			echo '<h1>' . get_the_title() . '</h1>';
			echo '<p>' . get_the_excerpt() . '</p>';
		echo '</header>';
		the_content();
		echo '<footer>';
			echo '<time datetime="' . get_the_time( 'r' ) . '">' . get_the_time( 'Y-m-d' ) . '</time>';
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