<?php

// width of the content
if (!isset($content_width))
	$content_width = 720;

// Allows additional post formats
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'chat', 'link', 'quote', 'status', 'image', 'video', 'audio') );

// Making sure Feed Links are automatically displayed
add_theme_support('automatic-feed-links');

//Allow for Thumbnails in Posts
add_theme_support('post-thumbnails');

// Loads jQuery, and required functions for the theme
function jQuery_load () {
	wp_enqueue_script('jquery');
	}	

add_action ('init', 'jQuery_load');

function menuslide() {
	if (!is_admin()) :
		// Load the Menu Sliding Capabilities
		wp_register_script('menuslide',
			get_template_directory_uri() . '/js/menuslide.js',
			array('jquery'),
			'1.0',
			true);
		wp_enqueue_script('menuslide');
		
		// Load the Widget Toggling Capabilities
		wp_register_script('togglewidgets',
			get_template_directory_uri() . '/js/togglewidgets.js',
			array('jquery'),
			'1.0',
			true);
		wp_enqueue_script('togglewidgets');
	endif;
}

add_action('init', 'menuslide');

function fancybox() {
	if (!is_admin()) :
		// Load the JavaScript
		wp_register_script('fancybox_jquery',
			get_template_directory_uri() . '/js/fancybox/jquery.fancybox-1.3.4.js',
			array('jquery'),
			'1.3.4',
			true);
		wp_enqueue_script('fancybox_jquery');
	
		// Load the CSS
		wp_register_style('fancybox_css',
			get_template_directory_uri(). '/js/fancybox/jquery.fancybox-1.3.4.css',
			array(),
			false,
			'screen');
		wp_enqueue_style('fancybox_css');
	
		// Load Fancy Box Settings
		wp_register_script('fancybox_settings',
			get_template_directory_uri() . '/js/fancybox_settings.js',
			array('fancybox_jquery'),
			'1.0',
			true);
		wp_enqueue_script('fancybox_settings');	
	endif;
}

// Loads Fancybox plugin, required for lightboxing
add_action('init','fancybox');


// A custom page menu
function custom_page_menu(){ ?>
	<div id="menu">
		<ul>
			<?php if (!is_home() || !is_front_page()) : ?>
			<li class="page_item"><a href="<?php echo home_url(); ?>">Home</a></li>
			<?php endif; ?>
			<?php wp_list_pages('title_li='); ?>
		</ul>
	</div>
<?php 
}

// Custom Menu Logic - use the nav menu if WordPress 3.0+, else use custom_page_menu
function custom_nav_menu() {
	if (function_exists('wp_nav_menu')) :
		wp_nav_menu(array('theme_location' => 'main-menu', 'container' => 'div', 'container_id' => 'menu', 'fallback_cb' => 'custom_page_menu'));
	else :
		custom_page_menu();
	endif;
}

add_action('init', 'register_custom_menu');

// Menu Registration
function register_custom_menu() {
	register_nav_menu('main-menu', __('Main Menu'));
}

// Sidebar Registration and Display
if ( function_exists('register_sidebar') )
    register_sidebar(array('name'=>'main_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
    ));

// Comment Display
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>"> 
		<div class="comment-author vcard">
			<?php echo get_avatar($comment,$size='32'); ?>
			<?php edit_comment_link('edit','',''); ?>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<?php if ($comment->comment_approved == '0') : ?><em class="comment_notice">Your comment is awaiting moderation.</em><?php endif; ?>
			<cite><?php comment_author() ?></cite>
			<a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> - <?php comment_time() ?></a>
		</div>
		<div class="comment-entry">
			<?php comment_text(); ?>
		</div>
	</li>
<?php }

// Trackback and Ping Display
function mytheme_trackback_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
   	<li class="comment_line" id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?></li>
<?php }

// Excerpt Design
function tr_excerpt_more($post) {
	global $post;
	return ' ... <a href="'. get_permalink($post->ID) . '">' . 'Continue Reading' . '</a>';
}
add_filter('excerpt_more', 'tr_excerpt_more');



?>