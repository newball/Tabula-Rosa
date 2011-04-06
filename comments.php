<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}


?>

<!-- You can start editing here. -->

<?php if ('open' == $post->comment_status) : ?>

<div id="comment-reply">
	
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p class="comment_notice">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
	<?php
		
		else :

		$aria_req = ( $req ? " aria-required='true'" : '' ); // used to preserve $aria_req functionality in WordPress and for screen readers.

		$fields = array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">(required)</span>' : '' ) .
	            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email' => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">(required - your e-mail will not be shared)</span>' : '' ) .
	            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	        'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
	            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
			);

		$defaults = array(
			'fields' => apply_filters('comment_form_default_fields', $fields),
			'comment_notes_before' => '',
			'comment_notes_after' => ''
		);
		
		comment_form($defaults); 
	
	?>	
</div>

<?php endif; // If registration required and not logged in ?>

<div id="comment-wrapper">
<?php if (get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
	<div class="navigation">
		<?php paginate_comments_links(); ?>
	</div>
<?php endif; ?>

<?php if (have_comments()) : ?>
	<div id="comment-responses">
		<h3 id="comments-title"><?php comments_number('No Responses', 'Responses', 'Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

		<ol class="commentlist"><?php wp_list_comments('type=comment&callback=mytheme_comment'); ?> </ol>
	</div>
	
<?php else: // this is displayed if no comments at the moment ?> 
	<div id="comment-response">
	<?php if (comments_open()) : // If Comments are open but no comments ?>
		<p class="comment-message">There aren't any comments at the moment, be the first to start the discussion!</p>
		<?php else : //comments are closed ?>
			<p class="comment-messsage">Comments are closed on this post.</p>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if(have_comments()) : ?>
	<div id="comment-trackbacks">
		<h3 id="trackbacks-title">Trackbacks</h3>
	    <ol class="commentlist">
		    <?php wp_list_comments('type=pings&callback=mytheme_trackback_comment'); ?> 
	    </ol>
	    
    </div>
<?php endif; ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>