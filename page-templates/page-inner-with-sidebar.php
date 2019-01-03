<?php
/**
 * Template name: Inner With Resource Sidebar
 * The template for displaying inner pages with an asset sidebar
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
<?php 

	if( 2 == count( get_post_ancestors( $post->ID ) ) ){
		$title = get_the_title(wp_get_post_parent_id());
		$link = get_permalink(wp_get_post_parent_id());
	}
	else {
		$title = get_the_title($post->ID);
		$link = get_permalink($post->ID);
		
	}
	
	$page_title = get_the_title($post->ID);
	
	echo '<h1 class="header-title"><a href="'. $link .'" title="'. $title .'">' . $title . '</a></h1>';

echo '</div>';

echo '<div id="navigation_secondary">';
	echo '<ul>';
			if( 2 <= count( get_post_ancestors( $post->ID ) ) ){
				$ID = wp_get_post_parent_id();
			}
			else {
				$ID = $post->ID;
			}
			$args = array(
				'post_type'      => 'page',
				'posts_per_page' => -1,
				'post_parent'    => $ID,
				'order'          => 'ASC',
				'orderby'        => 'menu_order'
			);
			
			
			//generate secondary nav 
			$self = new WP_Query( $args );
			if ( $self->have_posts() ) : 
				 while ( $self->have_posts() ) : $self->the_post();
				 		$updating_page_title = get_the_title($post->ID);
				 		$updating_page_link = get_permalink($post->ID);
				 		
				 		$secondary_nav_item_title = $post->post_title;
						if (strpos($page_title, $secondary_nav_item_title) !== false) {
							$select_status = 'selected';
						}
						else {
							$select_status = '';
						}
					
						echo '<li><a class="' . $select_status . '" href="' . $updating_page_link .'" title="' . $updating_page_title . '"><span>' . $updating_page_title . '</span></a></li>';	
				 endwhile; 
			endif; wp_reset_postdata(); 
				
			
	echo '</ul>'; //main_menu_contents
	?>
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


<aside class="sidebar">
<?php
$post_object = get_field('sidebar_whitepaper_');
if( $post_object ): 
	echo '<div class="sidebar_item">';
		// override $post
		$post = $post_object;
		setup_postdata( $post ); 

		echo '<span class="asset_type">White paper</span>';
		echo '<div class="fixed_image_container"><img src="http://bstojkov.com/NEW/wp-content/uploads/2018/05/icon_whitepaper_2x.png" /></div>';
		echo '<h6>' . get_the_title($post) . '</h6>';
		echo '<p>' . get_the_excerpt($post) . '</p>';
		echo '<a href="' . get_the_permalink($post) . '">' . Download . '</a>';
    echo '</div>';
    
    wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
endif; 


$blog_post_object = get_field('sidebar_blog_post');
if( $blog_post_object ){ 
	echo '<div class="sidebar_item">';
		// override $post
		$post = $blog_post_object;
		setup_postdata( $post ); 

		echo '<span class="asset_type">Blog</span>';
		echo '<div class="image_container">' . get_the_post_thumbnail($blog_post_object) . '</div>';	
		echo '<h6>' . get_the_title($post) . '</h6>';
		
		$blog_content = $blog_post_object->post_content;
		$blog_content = strip_tags($blog_content);
		echo '<p>' . substr($blog_content, 0, 120) . '... </p>';
		echo '<a href=" ' . get_post_permalink($blog_post_object) .' "> read now </a>';
	
    echo '</div>';
    
    wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
}
else {
	$recent_blog_posts = get_posts(array('post_type'=>'post', 'posts_per_page' => 1));
	foreach( $recent_blog_posts as $recent_blog_post ){
		echo '<div class="sidebar_item">';
			echo '<span class="asset_type">Blog</span>';
			
			if( has_post_thumbnail($recent_blog_post) ) {
				echo '<div class="image_container">' . get_the_post_thumbnail($recent_blog_post) . '</div>';
			}
			else {
				echo '<div class="fixed_image_container"><img src="http://bstojkov.com/NEW/wp-content/uploads/2018/05/icon_generic_blog.jpg" /></div>';
			}
			echo '<h6>' . $recent_blog_post->post_title . '</h6>';
			$blog_content = $recent_blog_post->post_content;
			$blog_content = strip_tags($blog_content);
			echo '<p>' . substr($blog_content, 0, 120) . '... </p>';
			echo '<a href=" ' . get_post_permalink($recent_blog_post) .' "> read now </a>';
		echo '</div>';
	}
}
	
?>
</aside>
<?php get_footer(); ?>
