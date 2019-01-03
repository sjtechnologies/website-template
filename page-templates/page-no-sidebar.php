<?php
/**
 * Template name: Inner without sidebars
 * The template for displaying inner pages without sidebar
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
<style>
.content-area {
    float: left;
    margin-right: -100%;
    width: 90%;
}
</style>
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


<div class="content-area">
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
