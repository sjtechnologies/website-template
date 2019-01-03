<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="header_art header_art_whitepaper">
	<h1 class="header-title">Whitepaper Download</h1>
</div>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			get_template_part( 'template-parts/content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentysixteen' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentysixteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'twentysixteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentysixteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'twentysixteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}

			// End of the loop.
		endwhile;
		?>
		<?php echo do_shortcode( '[contact-form-7 id="1234" title="White Paper Download Form"]' ); ?>
	</main><!-- .site-main -->

	
</div><!-- .content-area -->

<aside class="sidebar">
<ul>
	<?php
		$newest_blog_posts = get_posts(array('post_type'=>'post', 'posts_per_page' => 1));
		foreach( $newest_blog_posts as $newest_blog_post ){
			echo '<li>';
				echo '<span class="asset_type">Latest from our blog</span>';				
				echo get_the_post_thumbnail($newest_blog_post);
				echo '<h6>' . $newest_blog_post->post_title . '</h6>';
				$blog_content = $newest_blog_post->post_content;
				$blog_content = strip_tags($blog_content);
				echo '<p>' . substr($blog_content, 0, 120) . '... </p>';
			
				echo '<a href=" ' . get_post_permalink($newest_blog_post) .' "> read now </a>';
			echo '</li>';
		}
	?>
</ul>


</aside>


<?php get_footer(); ?>
