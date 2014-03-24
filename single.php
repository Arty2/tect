<?php
get_header();
get_sidebar();

?>

<main class="single">
<?php
#Start The Loop
if ( have_posts() ) {
	while ( have_posts() ) {
		get_template_part( 'content', 'single' );
	}
}
#End The Loop
?>

</main>

<?php
get_footer();
?>