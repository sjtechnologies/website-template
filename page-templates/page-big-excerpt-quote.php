<?php
/**
 * Template name: Big Excerpt Quote
 *
 * This is used by the front page and other static pages with a large fly in quote at the top.
 * 
 * 
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<!-- BIG TEST -->

	<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
	         
	<div id="homepage_module" style="background-image: url('<?php echo $backgroundImg[0]; ?>');">
		<?php
			while ( have_posts() ) : the_post();
				the_excerpt();
			endwhile;
		?>

	</div>  
	  	<!-- add main paragraph -->
			<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>
	
	

	<?php get_template_part('contactform'); ?>  
	
	
	<!-- make dynamic -->
	<div id="recirc_container">
		<div class="recirc_content">
			<h3>Resources</h3>
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
					$recent_blog_posts = get_posts(array('post_type'=>'post', 'posts_per_page' => 4));
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
  
  
  	
  	
  	
  	
  	

  


	
		
		
	






	
	






<?php get_footer(); ?>
