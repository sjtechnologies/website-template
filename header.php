<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Merriweather:400,400i|Poppins:400,500,600,700|Rajdhani:700" rel="stylesheet">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
			<div class="site-header-main">
				
				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
					<button id="menu-toggle" class="menu-toggle"><?php _e( '', 'twentysixteen' ); ?></button>

					<div id="site-header-menu" class="site-header-menu">
						<div class="site-branding">
							<!--<?php twentysixteen_the_custom_logo(); ?>-->
							<a href="https://sjtechcorp.com" rel="home" itemprop="url" data-slimstat="5">
								<img src="https://sjtechcorp.com/wp-content/uploads/2018/08/logo2x.png" alt="SJTechnologies" />
							</a>
							
							<?php if ( is_front_page() && is_home() ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php endif;

							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; ?></p>
							<?php endif; ?>
						</div><!-- .site-branding -->

						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							
							<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
								
								<?php
								echo '<ul class="main_menu_content">';	
								
								
									$menu = 'main_menu';
									$navArray = wp_get_nav_menu_items($menu); 
		
		
									$i=0;
									foreach ( $navArray as $navItem ) {
										$idOfPage = get_post_meta( $navItem->ID, '_menu_item_object_id', true );	
										$page_link = get_permalink($idOfPage);
										$page_title = get_the_title($idOfPage);	
				
										//check if nav item has same title as post   -OR-   if nav item's parent has same title as post  -OR-  if nav item's grandparent has same title as post
										$current_title = $post->post_title;
										$parent_current_title = get_the_title($post->post_parent);
										$ancestors = get_post_ancestors();
										$grandparent_of_current_ID = $ancestors[1];
										$grandparent_title = get_the_title($grandparent_of_current_ID);
										
				
										if (is_singular('post') and $i == 2 || $page_title == $grandparent_title || $page_title ==  $current_title || $page_title ==  $parent_current_title) {
											echo '<li class="single_nav_item active">';
										}		
										else {
											echo '<li class="single_nav_item">';
										}										
										$i++;
										
											echo '<a href="' . $page_link .'" title="' . $page_title . '">' . $page_title . '</a>';		
		
											//populate flyout panel
											echo '<ul class="flyout_contents">';
												$idOfPage = get_post_meta( $navItem->ID, '_menu_item_object_id', true );
												$args_parent = array(
													'parent' => $idOfPage, 
													'child_of' => $idOfPage,
													'sort_column' => 'menu_order'
												);
												$parent_pages_copy = get_pages( $args_parent );

												$page_copy = reset($parent_page_copy); 
												$count_copy = 0;

												foreach ( $parent_pages_copy as $parent_page_copy ) {
													$item_link = get_permalink($parent_page_copy);
													$item_title = $parent_page_copy->post_title;
													$page_copy = $parent_pages_copy[$count_copy]; 
													$pageId_copy = $page_copy->ID;
													$args = array( 'post_type'=> 'page', 
																'parent' => $page_copy->ID, 
																'child_of' => $page_copy->ID, 
																'output' => ARRAY_N, 
																//'output_key' => 'ID',
																//'sort_order' => 'ASC', 
																'orderby' => 'menu_order'
																//'output_key'=> 'date'
																);
													$all_pages_copy = get_pages( $args );
													$child_pages_copy = get_page_children($parent_page_copy->ID,  $all_pages_copy );
													$noOfChildren = count($child_pages_copy);
													
													if ($count_copy % 3 == 0 and count($parent_pages_copy) > 5){
														echo '<div class="flyout_newrow"></div>';
													}
													/* Add the menu items */

													
														echo '<li class="flyout_item">';
														echo '<a href="' . $item_link . '" title="'. $item_title .'">';
														echo $parent_page_copy->post_title;
														echo '</a>';

														echo '<p>';
														echo $parent_page_copy->post_excerpt;
														echo '</p>';

														echo '</li>';

													// 	if ($count_copy % 3 == 0){
													// 	echo '</div>';
													// }
													$count_copy++;
												}
											echo '</ul>';	
											
																												/*
									
														else {
															echo '<a href="' . $item_link . '" title="'. $item_title .'">';
															echo $parent_page_copy->post_title;
															echo '</a>';
														}
														*/
														
														//$child_pages_copy = get_page_children($parent_page_copy->ID,  $all_pages_copy );
														/*
														foreach ( $child_pages_copy as $child_page_copy ) {
															$child_page_link = get_permalink($child_page_copy);
															$child_page_title = $child_page_copy->post_title;
														
															echo '<a class="menu_child_link" href="' . $child_page_link . '" title="' . $child_page_title . '">';
															echo $child_page_title;
															echo '</a>';
														}
														*/
														

											
										//echo '</div>';	
											
										echo '</li>';
									}	
										
								echo '<div class="clear"></div>';
								echo '</ul>'; //main_menu_contents
								?>
			
			
								
							</nav><!-- .main-navigation -->
							
						<?php endif; ?>

						<?php if ( has_nav_menu( 'social' ) ) : ?>
							<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
										'link_after'     => '</span>',
									) );
								?>
							</nav><!-- .social-navigation -->
						<?php endif; ?>
						
						
						
						<div class='flyout_menu'></div>
						
						
						
					</div><!-- .site-header-menu -->
					<div class="social_buttons_container">
						
						<a target="_blank" class="social_button linkedin" href="https://www.linkedin.com/company/sj-technologies" title="Visit us on LinkedIn"></a>
						<a target="_blank" class="social_button facebook" href="https://www.facebook.com/sjtechnologies/" title="Visit us on Facebook"></a>
						<a target="_blank" class="social_button twitter" href="https://twitter.com/sjtechcorp?lang=en" title="Visit us on Twitter"></a>
						<a target="_blank" class="social_button instagram" href="https://www.instagram.com/sjtechnologies/" title="Visit us on Instagram"></a>
						<a target="_blank" class="social_button youtube" href="https://www.youtube.com/channel/UCEgNyV70yJgyM2P5l0CEZ9Q" title="Visit us on Youtube"></a>
					</div>
				<?php endif; ?>
			</div><!-- .site-header-main -->

			<?php if ( get_header_image() ) : ?>
				<?php
					/**
					 * Filter the default twentysixteen custom header sizes attribute.
					 *
					 * @since Twenty Sixteen 1.0
					 *
					 * @param string $custom_header_sizes sizes attribute
					 * for Custom Header. Default '(max-width: 709px) 85vw,
					 * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
					 */
					$custom_header_sizes = apply_filters( 'twentysixteen_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
				?>
				<div class="header-image">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
				</div><!-- .header-image -->
			<?php endif; // End header image check. ?>
		</header><!-- .site-header -->
		
		
        </div>
		
		<div class="overlay"></div>
		<div id="content" class="site-content">
