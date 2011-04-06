<?php 
/**
	The Loop for displaying posts.
	Technique adapted from WordPress' twentyten website
*/

?>

<?php // If theres no posts to display (i.e. empty archive page) ?>

<?php if (!have_posts()) : ?>
	<div id="post-0" class="post error404 not-found">
		<h2 class="posttitle center">Not Found</h2>
		<div class="entry">
			<p>There aren't any results for your request. Please try again, by using the search form below.</p>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>

<?php 
/**
	Adapting the WordPress twentyten technique, the same loop is used, but broken
	into different contexts.
	
	-- Note add more of a description here, because you can --
*/
?>

<?php // Galleries
while (have_posts()) : the_post(); ?>

	<?php if ( (function_exists('get_post_format') && 'gallery' == get_post_format($post->ID)) || in_category('gallery', 'gallery category slug')) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php edit_post_link('edit', '<p>', '</p>'); ?>
			<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<div class="entry">
				<?php
				if (post_password_required()):
					the_content();
				else:
					$images = get_children(array('post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => -1));
					$total_images = count($images);
					$image = array_shift($images);
					$image_img_tag = wp_get_attachment_image($image->ID, 'thumbnail');
				?>
				<div class="gallery-thumb">
					<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
				</div>
				<?php
				endif; // ends checking for passwords

				the_excerpt(); 
				
				?>
				<p>This gallery has <em><?php echo $total_images; ?></em> images.</p>
			</div>
			<div class="post-metadata">
				<p><strong>Date:</strong> <?php the_time('F jS, Y') ?> | <strong>Comments:</strong> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				<p><strong>Category:</strong> <?php the_category(', ') ?></p>
				<?php the_tags('<p><strong>Tags:</strong> ', ', ', '</p>'); ?>
			</div>
		</div>
	<?php 
	
	// Asides
	
	elseif ((function_exists('get_post_format') && 'aside' == get_post_format ($post->ID)) || in_category('asides', 'asides category slug')) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php edit_post_link('edit', '<p>', '</p>'); ?>
		<?php if (is_archive() || is_search() ) : // Display excerpts for archives and search ?>
			<div class="entry">
				<?php the_excerpt(); ?>
			</div>
		<?php else : ?>
			<div class="entry">
				<?php 				
				the_content('Continue Reading &raquo;');
				?>
			</div>
		<?php endif; ?>
			<div class="post-metadata">
				<p><strong>Date:</strong> <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_time('F jS, Y') ?></a> | <strong>Comments:</strong> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				<p><strong>Category:</strong> <?php the_category(', ') ?></p>
				<?php the_tags('<p><strong>Tags:</strong> ', ', ', '</p>'); ?>
			</div>
		</div>
	<?php
	
	// Chats
	
	elseif ((function_exists('get_post_format') && 'chat' == get_post_format($post->ID)) || in_category('chat', 'chat category slug')) : ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php edit_post_link('edit', '<p>', '</p>'); ?>
			<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<div class="entry">
				<?php the_content('Continue Reading &raquo;'); ?>
			</div>
			<div class="post-metadata">
				<p><strong>Date:</strong> <?php the_time('F jS, Y') ?> | <strong>Comments:</strong> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				<p><strong>Category:</strong> <?php the_category(', ') ?></p>
				<?php the_tags('<p><strong>Tags:</strong> ', ', ', '</p>'); ?>
			</div>
		</div>
	<?php
	
	// Link
	
	elseif ((function_exists('get_post_format') && 'link' == get_post_format($post->ID)) || in_category('link' , 'link category slug')) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php edit_post_link('edit', '<p>', '</p>'); ?>
				<div class="entry">
					<?php the_content('Continue Reading &raquo;'); ?>
				</div>
			<div class="post-author">posted by: <?php the_author(); ?></div>
			<div class="post-metadata">
				<p><strong>Date:</strong> <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permenant Link To <?php the_title_attribute(); ?>" ><?php the_time('F jS, Y') ?></a> | <strong>Comments:</strong> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				<p><strong>Category:</strong> <?php the_category(', ') ?></p>
				<?php the_tags('<p><strong>Tags:</strong> ', ', ', '</p>'); ?>
			</div>
		</div>
	
	<?php
	
	// Quotes
	
	elseif ((function_exists('get_post_format') && 'quote' == get_post_format($post->ID)) || in_category('quote', 'quote category slug')) : ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php edit_post_link('edit', '<p>', '</p>'); ?>
				<div class="entry">
					<?php the_content('Continue Reading &raquo;'); ?>
				</div>
			<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<div class="post-metadata">
				<p><strong>Date:</strong> <?php the_time('F jS, Y') ?> | <strong>Comments:</strong> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				<p><strong>Category:</strong> <?php the_category(', ') ?></p>
				<?php the_tags('<p><strong>Tags:</strong> ', ', ', '</p>'); ?>
			</div>
		</div>
<?php 

	// Status
	
	elseif ((function_exists('get_post_format') && 'status' == get_post_format($post->ID)) || in_category('status', 'status category slug')) : ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php edit_post_link('edit', '<p>', '</p>'); ?>
				<div class="entry">
					<?php the_content('Continue Reading &raquo;'); ?>
				</div>
			<div class="post-metadata">
				<p>posted by: <strong><?php the_author(); ?></strong> on <strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_time('F jS, Y') ?></a></strong> | <?php comments_popup_link('No Responses &#187;', '1 Response &#187;', '% Responses &#187;'); ?></p>
				<p><strong>Category:</strong> <?php the_category(', ') ?></p>
				<?php the_tags('<p><strong>Tagged:</strong> ', ', ', '</p>'); ?>
			</div>
		</div>

	
	<?php 
	
	// Everything Else
	
	else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php edit_post_link('edit', '<p>', '</p>'); ?>
			<?php
			if (has_post_thumbnail()) :
				the_post_thumbnail('thumbnail');
			endif;
			?>
			<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<div class="post-author">written by: <?php the_author(); ?></div>
			<?php if (is_archive() || is_search() ) : // Display excerpts for archives and search ?>
				<div class="entry">
					<?php the_excerpt(); ?>
				</div>
			<?php else : ?>
				<div class="entry">
					<?php the_content('Continue Reading &raquo;'); ?>
				</div>
			<?php endif; ?>
			<div class="post-metadata">
				<p><strong>Date:</strong> <?php the_time('F jS, Y') ?> | <strong>Comments:</strong> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				<p><strong>Category:</strong> <?php the_category(', ') ?></p>
				<?php the_tags('<p><strong>Tags:</strong> ', ', ', '</p>'); ?>
			</div>
		</div>
	<?php endif; // If statement that broke the posts into parts based on categories
endwhile; // End of the Loop ?>

		<div class="navigation">
			<div class="nav-previous"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="nav-next"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>