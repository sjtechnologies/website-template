<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php 
$pageID = get_option('page_for_posts');
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $pageID ), 'single-post-thumbnail' );$imageURL = $image[0];
$title = get_the_title($pageID);
?>
<div class="header_art_before"></div>
<div class="header_art" style="background-image:url(<?php echo htmlspecialchars($imageURL); ?>);">
<h1 class="header-title"><?php the_title(); ?></h1>
</div>

<div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_content(); ?>

	

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
