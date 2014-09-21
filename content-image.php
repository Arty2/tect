<?php
	$id = get_the_ID();
	$slug = basename(get_permalink());

	if ( get_the_title() != $slug ) {
		// $excerpt = '<h2 class="entry-title">' . get_the_title() . '</h2>';
	}
	$excerpt .= preg_replace( '#</?a(\s[^>]*)?>#i', '', get_the_excerpt() );

	$post_class = implode( ' ',  get_post_class() );

	echo '<article class="hentry hnews ' . $post_class . '" role="article">';	
	if ( has_post_thumbnail() ) { 
		$thumbnail_original = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		echo '
			<figure>'
			. '<a class="post-thumbnail" href="' . $thumbnail_original[0] . '" title="' . $excerpt . '" >' . get_the_post_thumbnail() . '</a>'
			. '<figcaption>'
			. '<a href="' . get_permalink() . '">'
			. '<p>' . $excerpt . '</p>'
			. tect_get_meta( $id, 'tect_time', true, '<time datetime="' . tect_get_meta( $id, 'tect_time') . '">','</time> ')
			. '</a>'
			. '</figcaption>'
			. '</figure>';
	}
	echo '</article>';
	//http://codex.wordpress.org/Function_Reference/wp_get_attachment_metadata
	$excerpt = '';
	$post_class = '';
?>