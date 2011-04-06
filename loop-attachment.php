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
			<div id="post-author">posted by: <?php the_author(); ?></div>

			<div class="entry">
				<?php 
					// if it's an image
					if (wp_attachment_is_image()) :
						echo wp_get_attachment_image( $post->ID, 'full');
					else:
					// if not an image
				?> 
					<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
				<?php
					endif;
				?>
				
			<?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?>
			<div class="post-metadata alt">
				<p><strong>Date:</strong> <?php the_time('F jS, Y') ?> </p>
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
			<div class="navigation">
				<div class="nav-previous"><?php previous_image_link( false, 'Previous Image' ); ?></div>
				<div class="nav-next"><?php next_image_link( false, 'Next Image' ); ?></div>
			</div>

			</div>


<?php comments_template(); ?>
<?php endwhile; ?>
