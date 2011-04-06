<?php if (!have_posts()) : ?>
	<div id="post-0" class="post error404 not-found">
		<h2 class="posttitle center">Not Found</h2>
		<div class="entry">
			<p>There aren't any results for the requested archive. Please try again, by using the search form below.</p>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>

<?php 

// Asides

if ((function_exists('get_post_format') && 'aside' == get_post_format ($post->ID)) || in_category('asides', 'asides category slug')) : ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php edit_post_link('edit', '', ''); ?>

		<div class="entry">
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<div class="post-pages-navigation"><strong>Pages:</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>				
		</div>

		<div class="post-metadata alt">
			<p><strong>Date:</strong> <?php the_time('F jS, Y') ?> </p>
			<p><strong>Category:</strong> <?php the_category(', ') ?></p>
			<?php the_tags('<p><strong>Tags:</strong> ', ', ', '</p>'); ?>
			<p><strong>Comments/Trackbacks:</strong>
			<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
			// Both Comments and Pings are open ?>
			<a href="#respond">Comments</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> allowed.</p>

			<?php } elseif (!comments_open() && pings_open()) {
			// Only Pings are Open ?>
			<a href="<?php trackback_url(); ?> " rel="trackback">Trackback</a> only.

			<?php } elseif (comments_open() && !pings_open()) {
			// Comments are open, Pings are not ?>
			<a href="#respond">Comments</a> only.

			<?php } elseif (!comments_open() && !pings_open()) {
			// Neither Comments, nor Pings are open ?>
			Not allowed.
			<?php } ?>
			</p>
		</div>

<?php else: ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php edit_post_link('edit', '', ''); ?>
		<h1 class="posttitle"><?php the_title(); ?></h1>
		<div id="post-author">written by: <?php the_author(); ?></div>

		<div class="entry">
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<div class="post-pages-navigation"><strong>Pages:</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>				
		</div>

		<div class="post-metadata alt">
			<p><strong>Date:</strong> <?php the_time('F jS, Y') ?> </p>
			<p><strong>Category:</strong> <?php the_category(', ') ?></p>
			<?php the_tags('<p><strong>Tags:</strong> ', ', ', '</p>'); ?>
			<p><strong>Comments/Trackbacks:</strong>
			<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
			// Both Comments and Pings are open ?>
			<a href="#respond">Comments</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> allowed.</p>

			<?php } elseif (!comments_open() && pings_open()) {
			// Only Pings are Open ?>
			<a href="<?php trackback_url(); ?> " rel="trackback">Trackback</a> only.

			<?php } elseif (comments_open() && !pings_open()) {
			// Comments are open, Pings are not ?>
			<a href="#respond">Comments</a> only.

			<?php } elseif (!comments_open() && !pings_open()) {
			// Neither Comments, nor Pings are open ?>
			Not allowed.
			<?php } ?>
			</p>
		</div>
<?php endif; ?>
<?php comments_template(); ?>
<?php endwhile; ?>
