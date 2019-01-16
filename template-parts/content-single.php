<?php
/**
 * The template part for displaying single posts
 * applies to blog and white papers posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php $featuredImage = wp_get_attachment_image_url( get_post_thumbnail_id($post->ID), 'full' );
			$fname = get_the_author_meta('first_name');
			$lname = get_the_author_meta('last_name');
			$title = get_the_title();
			$pageTitle = get_the_title($pageID);
?>
	         
<div id="boxed_resources_content">

		<div id="boxed_half" class="boxed_border_left">
		<?php
	
		echo '<h1>' . $title . '</h1>';
		echo '<header id="header" class="entry-header">';
			echo '<span class="date">' . get_the_date() . '</span>';
			echo '<span class="author">by ' . trim( "$fname $lname" ) . '</span>';
			echo the_category();
		echo '</header>';
		?>
		</div>
		<div id="boxed_half">
			<img src="<?php echo "$featuredImage" ?>">
		</div>
<!-- body of the article -->				   
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
	</div><!-- boxed_resources_conntent -->
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

<div id="recirc_container">
		<div class="recirc_content">
			<h3>More Resources</h3>
			<ul>
				<?php
					//get the top/highest 2 white papers
					/*
					$recent_whitepaper_posts = get_posts(array('post_type'=>'whitepapers', 'posts_per_page' => 2));
					foreach( $recent_whitepaper_posts as $recent_whitepaper_post ){
						echo '<li>';
							//echo '<span class="asset_type">White Paper</span>';
							echo '<div class="fixed_image_container"><img src="http://bstojkov.com/NEW/wp-content/uploads/2018/05/icon_whitepaper_2x.png" /></div>';
							
							echo '<h6>' . $recent_whitepaper_post->post_title . '</h6>';
							echo '<p>' . $recent_whitepaper_post->post_excerpt . '</p>';
							echo '<a href=" ' . get_post_permalink($recent_whitepaper_post) . ' ">' . download . '</a>';
						echo '</li>';
					}
					*/

					//get the top/highest most recent blog posts
					
					$recent_blog_posts = get_posts(array('post_type'=>'post', 'orderby' =>'rand', 'posts_per_page' => 4, 'post_not_in' => $post->ID ));
					foreach( $recent_blog_posts as $recent_blog_post ){
						echo '<li>';
							//echo '<span class="asset_type">Blog</span>';
							
							if( has_post_thumbnail($recent_blog_post) ) {
								echo '<div class="image_container">' . get_the_post_thumbnail($recent_blog_post) . '</div>';
							}
							else {
								echo '<div class="fixed_image_container"><img src="http://sjtechcorp.com/wp-content/uploads/2018/08/icon_generic_blog.jpg" /></div>';
							}
							echo '<h6>' . $recent_blog_post->post_title . '</h6>';
							$blog_content = $recent_blog_post->post_content;
							$blog_content = strip_tags($blog_content);
							echo '<p>' . substr($blog_content, 0, 120) . '... </p>';
							echo '<a href=" ' . get_post_permalink($recent_blog_post) .' "> read now </a>';
						echo '</li>';
					}
				?>
			</ul>
		</div>
	</div>