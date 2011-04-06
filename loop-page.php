<?php if (!have_posts()) : ?>
	<div id="post-0" class="page error404 not-found">
		<h2 class="posttitle center">Not Found</h2>
		<div class="entry">
			<p>There aren't any results for the requested archive. Please try again, by using the search form below.</p>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php edit_post_link('edit', '', ''); ?>
		<h1 class="posttitle"><?php the_title(); ?></h1>
			<div class="entry">
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => '<div class="post-pages-navigation"><strong>Pages:</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
			</div>
		<?php comments_template(); ?>
<?php endwhile; ?>