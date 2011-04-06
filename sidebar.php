	<div id="left-col">
		<?php custom_nav_menu(); ?>


		<div id="sidebar">
        	<div id="feed-container">
        		<p><a href="<?php bloginfo('rss2_url'); ?>" id="feed_link">Subscribe to the RSS Feed</a></p>
        	</div>

			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('main_sidebar') ) : ?>
			
			<div class="widget static-widget">
				<h3 class="widgettitle">Archives</h3>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</div>
			
			<div class="widget static-widget">
				<h3 class="widgettitle">Categories</h3>
				<ul>
					<?php wp_list_categories('show_count=0&title_li=&hierarchical=0'); ?>
				</ul>
			</div>
		<?php endif; ?>
		</div>
	</div>

