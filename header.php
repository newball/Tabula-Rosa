<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if(is_404() || is_search() || is_archive()) { ?>
	<meta name="googlebot" content="noindex,noarchive,follow,noodp" />
    <meta name="robots" content="noindex,follow" />
    <meta name="msnbot" content="noindex,follow" />
<?php }?>
<title>

<?php
// Titles for different page types

if ( is_home() || is_front_page() ) : // Home or Front Page
	bloginfo('name');
	global $page, $paged; // Pagenating - Thanks Automatic for this idea - taken from the TwentyTen theme
		if ( $paged >= 2 || $page >= 2 ):
			echo ' | ' . sprintf('Page %s', max( $paged, $page ) );
		 endif;
	echo ' | ';
	bloginfo('description');
	elseif (is_search()): // For Search Pages
		echo 'Search Results for: '; the_search_query(); echo ' | '; bloginfo('name');
	elseif (is_tag()): // For Tag Archives
		echo 'Tag Archive for: '; single_tag_title();  echo ' | '; bloginfo('name');
	elseif (is_category()): // For Category Archives
		echo 'Category Archive for: '; single_cat_title(); echo ' | '; bloginfo('name');
	elseif (is_day()): // For Day, Month, Year Archives
		echo 'Archive for: '; the_time('F jS, Y'); echo ' | '; bloginfo('name');
	elseif (is_month()): // Month, Year Archives
		echo 'Archive for: '; the_time('F, Y'); echo ' | '; bloginfo('name');
	elseif (is_year()): // Year Archives
		echo 'Archive for: '; the_time('Y');   echo ' | '; bloginfo('name');
	else : // Every other sort of archive
		wp_title('', TRUE, 'right'); echo ' | '; bloginfo('name');
	endif;
?>
</title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php 
	// For threaded comment replies
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );


	wp_head(); 
?>

</head>
<body <?php body_class(); ?>>
		
	<div id="header">
		<div id="header-wrapper">
		<h1 id="blog-title"><a href="<?php echo home_url(); ?>" title="Home"><?php bloginfo('name'); ?></a></h1>       
        <h2 id="blog-description"><?php bloginfo('description'); ?></h2>
        
        <!-- Design Note: Add breadcrumbs here at the end of this logic -->
        <?php /* If this is the front page */ if (is_home() || is_front_page()) :?>
        	<h2 class="breadcrumb">Home</h2>
        <?php else : ?>
			<h2 class="breadcrumb"><a href="<?php echo home_url(); ?>">Home</a> - 
		<?php endif; ?>
		<?php /* If this is a category archive */ if (is_category()) : ?>
			<span class="underline"><?php single_cat_title(); ?></span> Category Archive</h2>
		<?php /* If this is a tag archive */  elseif( is_tag() ) :?>
			Posts Tagged <span class="underline"><?php single_tag_title(); ?></span></h2>
		<?php /* If this is a daily archive */ elseif (is_day()) : ?>
			Archive for <span class="underline"><?php the_time('F jS, Y'); ?></span></h2>
		<?php /* If this is a monthly archive */ elseif (is_month()) : ?>
			Archive for <span class="underline"><?php the_time('F, Y'); ?></span></h2>
		<?php /* If this is a yearly archive */ elseif (is_year()) : ?>
			Archive for <span class="underline"><?php the_time('Y'); ?></span></h2>
		<?php /* If this is an author archive */ elseif (is_author()) : ?>
			Author Archive</h2>
		<?php /* If this is a paged archive */ elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
			Blog Archives</h2>
		<?php  /*If this is a search page */ elseif (is_search()) :  ?>
			Search Results for: "<?php the_search_query(); ?>"</h2>
		<?php /*If this is an error page */ elseif (is_404()) : ?>
			Page Error: 404</h2>
		<?php /* Breadcrumb */ elseif((is_single() || is_page()) && !is_front_page()) : ?>
			<?php /* If it is a post-page, show the category */
			if (is_single()) :
				foreach((get_the_category()) as $category) {
					echo '<a href="' . get_category_link($category->cat_ID) . '" title="' . $category->cat_name . '">';
					echo $category->cat_name;
					echo '</a>';
					echo ' - ';
				}
			endif;
			single_post_title();
			?>
			</h2>
		<?php endif; ?>
		</div>
		<?php get_search_form(); ?>
	</div>


<div id="wrapper">
