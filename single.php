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
		$slug = basename(get_permalink());

		echo '<article class="hnews hentry" lang="' . tect_lang_current() . '">';
		echo '<header>';
			echo '<h1><a href="' . get_permalink() . '" rel="bookmark">/' . $slug . '</a></h1>';
			echo '<div class="entry-summary">';
			if ( get_the_title() != $slug ) {
				echo '<h2 class="entry-title">' . get_the_title() . '</h2>';
			}
			echo get_the_excerpt();
			echo '</div>';

			// post datetimes 
			echo '<p class="time">';
			echo tect_get_meta( $id, 'tect_time', true, '<time datetime="' . tect_get_meta( $id, 'tect_time') . '">','</time> ');
			echo '<time class="published" datetime="' . get_the_time( 'r' ) . '" title="' . __('published', 'tect') . '">' . get_the_date() . '</time>';
			if ( get_the_date() != get_the_modified_date() ) {
				echo ' <time class="updated" datetime="' . get_the_modified_time( 'r' ) . '" title="' . __('updated', 'tect') . '">' . get_the_modified_date() . '</time>';
			}
			echo '</p>';

			if (!dynamic_sidebar('share') ) {
			// share buttons 
			echo '
				<p class="share">
					<a class="share-twitter" href="https://twitter.com/intent/tweet?original_referer=&source=tweetbutton&text='
					. urlencode( strip_tags( get_the_excerpt() ) . ' → ' )
					. '&url=' . urlencode( get_permalink() )
					. '" target="_blank" title="' . __( 'tweet', 'tect' ) . '"><span>twitter</span></a>
					<a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?s=100'
					. '&amp;p[title]='. urlencode( get_the_title() . ' • ' . get_bloginfo( 'name' ) )
					. '&amp;p[summary]=' . urlencode( strip_tags(get_the_excerpt()) )
					. '&amp;p[url]=' . get_permalink()
					. '&amp;&amp;p[images][0]=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) )
					. '" target="_blank" title="' . __( 'share on facebook', 'tect' ) . '"><span>facebook</span></a>
					<!--<a id="appendix-hyperlinks" title="' . __('Make a Hyperlink index and print.', 'tect') . '"><span>' . __('print', 'tect') . '</span></a>-->
				</p>';	//https://plus.google.com/share?url=' . urlencode( get_permalink() ) . '
			}

			//tags
			echo get_the_tag_list('<ul class="tags"><li>','</li><li>','</li></ul>');


		echo '</header>';
		echo '<footer>';
			echo tect_get_meta( $id, 'tect_credits', true );
		echo '</footer>';
		echo '<div class="entry-content">';
			the_content();
		echo '</div>';
		echo '</article>';
	}
}
#End The Loop
?>
</main>

<?php
get_footer();
?>