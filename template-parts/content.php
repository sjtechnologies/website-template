<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

  $postCounter = $wp_query->current_post
?>

<!-- <div id="boxed_half<?php if (($postCounter % 5) == 0) echo '_wide_box'; ?>"> -->
<div id="boxed_half">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="image_container">
	<?php echo '<a href=" ' . get_post_permalink($recent_blog_post) .' ">' ?>
		<?php the_post_thumbnail(); ?></a>
	</div>
	<div class="resource_text_container">
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'twentysixteen' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
			$content = strip_tags(get_the_excerpt()); 
			echo '<p>' . mb_strimwidth($content, 0, 140, '...') . '</p>';
		
			/* translators: %s: Name of current post 
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
				get_the_title()
			) );
			*/
			
			
			
			
			
			

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->
	
			</div> <!-- .resource_text_container -->
			
</article><!-- #post-## -->
<div class="read_more"><?php echo '<a href=" ' . get_post_permalink($recent_blog_post) .' "> read now </a>';?></div>
</div> <!-- boxed_half -->