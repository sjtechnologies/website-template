<?php
/**
 * Template name: Contact Form
 * The template for displaying contact form
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
			
		
		
		
		
		
			
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );


			// End of the loop.
		endwhile;
		
		echo do_shortcode( '[contact-form-7 id="1234" title="White Paper Download Form"]' ); 
		?>
	</main><!-- .site-main -->


</div><!-- .content-area -->




<?php get_footer(); ?>
