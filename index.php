<?php
get_header();
get_sidebar();
?>

<section id="main">
<?php
#Start The Loop
if (have_posts()) {
	while (have_posts()) {
		the_post();
		$id = get_the_ID();
		echo '<article>';
		echo '<header>';
			if (has_post_thumbnail()) {
				echo get_the_post_thumbnail( $id, array(300,300) );
			}
			echo '<a href="'.get_permalink().'"><h1>'.get_the_title().'</h1></a>';
			echo '<time datetime="'.get_the_time( 'r' ).'">'.get_the_time( 'Ymd' ).'</time>';
			echo '<p>'.get_the_excerpt().'</p>';
			echo get_the_tag_list('<p>tags: ',', ','</p>');

		echo '</header>';
		echo '</article>';
	}
}
#End The Loop
?>
</section>

<?php

get_footer();
?>