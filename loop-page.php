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