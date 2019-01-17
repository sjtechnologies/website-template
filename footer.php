<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
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

			<div id="site_map_container">
				<div class="site_map_content">
					<div class="footer_grouping">
						<ul>
							<li>Why SJ Technologies</li>

							<li>
								<?php 
									$page = get_post(117);
									$page_title = $page->post_title; 
									$link = get_page_link($page);
									echo '<a href="' . $link . '" title="' . $page_title . '">' . $page_title . '</a>';
								?>
							</li>
							<li>
								<?php 
									$page = get_post(125);
									$page_title = $page->post_title; 
									$link = get_page_link($page);
									echo '<a href="' . $link . '" title="' . $page_title . '">' . $page_title . '</a>';
								?>
							</li>
							<li>
							<a href="https://sjnp.sjtechcorp.com/techblog/">Resources</a>
						  </li>
							<li>
								<?php 
									$page = get_post(321);
									$page_title = $page->post_title; 
									$link = get_page_link($page);
									echo '<a href="' . $link . '" title="' . $page_title . '">' . $page_title . '</a>';
								?>
							</li>
							<li>
								<?php 
									$page = get_post(263);
									$page_title = $page->post_title; 
									$link = get_page_link($page);
									echo '<a href="' . $link . '" title="' . $page_title . '">' . $page_title . '</a>';
								?>
							</li>
						</ul>
					
						
					</div>
					<div class="footer_grouping">
						<ul>
							<li>Our services</li>
							<?php wp_list_pages( array(
								'child_of' => 13,
								'parent' => 13,
								'title_li' => '',
								'sort_order' => 'ASC'
							) ); ?>
					</ul>
					</div>
					<!--
					<div class="footer_grouping">
						<ul>
							<li>Resources</li>
							<?php wp_list_pages( array(
								'child_of' => 100,
								'parent' => 100,
								'title_li' => ''
							) ); ?>
						</ul>
						<div id="footer_logos">
							<img src="https://sjtechcorp.com/wp-content/uploads/2018/08/logo_WOB.png" alt="Women Owned" />
							<img src="https://sjtechcorp.com/wp-content/uploads/2018/08/logo_SBA.png" alt="SBA8a Certified" />
						</div>
					</div>
					-->
					<div class="footer_grouping">
					<ul>
							<li>Vehicles &amp; Certifications</li>
							<li>
								<?php 
									$page = get_post(121);
									$page_title = $page->post_title; 
									$link = get_page_link($page);
									echo '<a href="' . $link . '" title="' . $page_title . '">' . $page_title . '</a>';
								?>
							</li>
							<li>
								<?php 
									$page = get_post(140);
									$page_title = $page->post_title; 
									$link = get_page_link($page);
									echo '<a href="' . $link . '" title="' . $page_title . '">' . $page_title . '</a>';
								?>
							</li>
							<li>
								<?php 
									$page = get_post(142);
									$page_title = $page->post_title; 
									$link = get_page_link($page);
									echo '<a href="' . $link . '" title="' . $page_title . '">' . $page_title . '</a>';
								?>
							</li>
						</ul>
						<div id="footer_logos">
							<img src="https://sjtechcorp.com/wp-content/uploads/2018/08/logo_WOB.png" alt="Women Owned" />
							<img src="https://sjtechcorp.com/wp-content/uploads/2018/08/logo_SBA.png" alt="SBA8a Certified" />
						
						</div>
					</div>
				</div>
					<p style="text-align:center">&copy; Copyright <?php echo date("Y"); ?> by SJ Technologies Inc. All rights reserved.</p>
			</div>
			
			
			
			
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->




<?php wp_footer(); ?>

<script>		
(function($) {
	$(document).ready( function() {
		var nav_item = $("li.single_nav_item");
		nav_item.mouseenter(function(){
			if ($("li.flyout_item").is(":visible") || $("li.flyout_item_narrow").is(":visible")) {
				var dynamicHeight = $(this).find("ul.flyout_contents").height();
				var flyout_menu = $(".flyout_menu");
				
				flyout_menu.css("height", (dynamicHeight + 58));
				flyout_menu.show();
			}
		});	
		nav_item.mouseleave(function(){
			$(".flyout_menu").hide();
		});	
		
		var dynamicHeight = $("ul.flyout_contents").height();
		
		
		
		var toggler = $("button#menu-toggle");
		var panel = $("nav#site-navigation");
		var page = $("#page");
		//var content = $("#content");
		var overlay = $(".overlay");
		
		toggler.click(function() {
			panel.toggleClass("mobile_menu_on", 1000, "easeOutSine");
			page.toggleClass("page_off");
			overlay.toggle();
			
			//content.before("<p class='overlay'></p>" );
			//$("p.overlay").remove();
		});
		
		
		
		//toggle services flyout on mobile
		var trigger = $("ul.services_flyout a");
		var flyout = $("ul.services_flyout li ul");
		trigger.click(function() {
			flyout.toggle();
		})
		
		
		
		
		$(function(){
			// this will get the full URL at the address bar
			var url = window.location.href; 

			// passes on every "a" tag 
			$("#site-navigation a").each(function() {
					// checks if its the same on the address bar
				if(url == (this.href)) { 
					$(this).closest("li").addClass("active");
				}
			});
		});
		
		
		
		//conditional placement of social media buttons and accreditation 
		if($(window).width() < 1130) {
			//$('#footer_logos').detach().appendTo('#site_map_container');
			$('.social_buttons_container').detach().appendTo('#site_map_container');
		}
		
		
		//mobile menu accordion
		if($(window).width() < 1029) {
			var drawer_contents = $("#site-navigation li.single_nav_item ul.flyout_contents");
			drawer_contents.each(function(){
				if($(this).children().length > 0) {
					$(this).parent().addClass("has_children");
					$(this).parent().children("a").attr("onclick", "return false");
					
					$(this).parent().click(function(){
						var siblings = $(this).siblings().children("ul.flyout_contents");
						
						$(this).children("ul.flyout_contents").toggle();
						$(this).toggleClass("selected");
						siblings.hide();
						$(this).siblings().removeClass("selected");
					});
				}
			});
		}
		
		
		
		
		
	});
})( jQuery );		
</script>
</body>
</html>
