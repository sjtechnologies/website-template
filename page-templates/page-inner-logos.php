<?php
/**
 * Template name: Inner logo page
 * The template for displaying inner pages full of logos
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<?php 
if ( has_post_thumbnail() ) {
	$thumb = get_the_post_thumbnail_url(); 
}
else {
	$thumb = 'http://bstojkov.com/NEW/wp-content/uploads/2018/07/header_generic.jpg';
}
?>
<div class="header_art_before"></div>
<div class="header_art" style="background-image:url(<?php echo htmlspecialchars($thumb); ?>);">
<?php the_title( '<h1 class="header-title">', '</h1>' ); ?>
</div>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );
			// End of the loop.
		endwhile;
		?>
		
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
