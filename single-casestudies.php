<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>


<div class="header_art_before"></div>
<div class="header_art" style="background-image:url(/wp-content/uploads/2018/08/header_services_taller.jpg);">
<?php the_title( '<h1 class="header-title">', '</h1>' ); ?>
</div>

<div id="content-area-case-study">
	<main id="main" class="site-main" role="main">



		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
		
			// Include the single post content template.
			get_template_part( 'template-parts/content-casestudy', 'single' );

			// End of the loop.
		endwhile;
		?>


	</main>
</div><!-- .content-area -->

<?php get_footer(); ?>
