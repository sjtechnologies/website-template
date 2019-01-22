<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<?php 
	$pageID = get_option('page_for_posts');
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $pageID ), 'single-post-thumbnail' );$imageURL = $image[0];
	$title = get_the_title($pageID);
	?>
	<div class="header_art_before"></div>
	<div class="header_art" style="background-image:url(<?php echo htmlspecialchars($imageURL); ?>);">
		<h1 class="header-title"><?php echo $title ?></h1>
	</div>

	<div id="resources_container">

			<?php if ( have_posts() ) : ?>

					<?php if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?> </h1>
						</header>
					<?php endif; ?>

					<?php
					// Start the loop.
	
					while ( have_posts() ) : the_post();

						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_format() );
						
					// End the loop.
					endwhile;

					// Previous/next page navigation.
					echo '<div id="navigation">';
					the_posts_pagination( array(
						'prev_text'          => __( 'Previous page', 'twentysixteen' ),
						'next_text'          => __( 'Next page', 'twentysixteen' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
					) );
					echo '</div>';
				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

	</div>
<?php get_footer(); ?>
