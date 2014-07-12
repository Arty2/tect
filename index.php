<?php
get_header();
get_sidebar();
?>

<main id="content" class="archive">
<?php
	// Get posts only from the default category on homepage
	if ( is_home() ) {
		// create setting in options
		// query_posts('cat=' . get_option('default_category'));
		
	}
	// Start The Loop
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}
	} else {
		echo '<p>' . __( 'In the beginning there was only chaos.', 'tect' ) . '</p>';
	}
	// End The Loop
?>
</main>
<?php
	get_template_part( 'pagination' );
	get_footer();
?>