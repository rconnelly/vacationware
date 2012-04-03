<?php

// Do not delete these lines
	if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ('Please do not load this page directly. Thanks!');
	}

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( "This post is password protected. Enter the password to view comments", "wptouch-pro" ); ?>.</p>
		<?php return; 
	} ?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

	<h3 id="comments">
		<?php comments_number( __( 'No Responses', 'wptouch-pro' ), __( 'One Response', 'wptouch-pro' ), __( '% Responses', 'wptouch-pro' ) ); ?>
	</h3>

	<?php if ( wptouch_theme_wp_comments_nav_on() ) { ?>
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link() ?></div>
			<div class="alignright"><?php next_comments_link() ?></div>
		</div>
	<?php } ?>
	
	<ol class="commentlist rounded-corners-8px">
		<?php wp_list_comments(); ?>
		<?php if ( wptouch_theme_is_ajax_enabled() ) { ?>
			<?php if ( wptouch_theme_comments_newer() ) { ?>
				<li class="load-more-comments-link"><?php previous_comments_link(__( "Load More Comments&hellip;", "wptouch-pro" ) ); ?></li>
			<?php } else { ?>
				<li class="load-more-comments-link"><?php next_comments_link(__( "Load More Comments&hellip;", "wptouch-pro" ) ); ?></li>
			<?php } ?>
		<?php } ?>
	</ol>

	<?php if ( wptouch_theme_wp_comments_nav_on() ) { ?>
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link() ?></div>
			<div class="alignright"><?php next_comments_link() ?></div>
		</div>
	<?php } ?>
 
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e( "Comments are closed", "wptouch-pro" ); ?>.</p>
	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

	<div id="respond">
	
	<h3><?php comment_form_title( __( 'Leave a Reply', 'wptouch-pro' ), __( 'Leave a Reply to %s', 'wptouch-pro' ) ); ?></h3>
	
	<div class="cancel-comment-reply">
		<small><?php cancel_comment_reply_link(); ?></small>
	</div>
	
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p><?php echo sprintf( __( "You must be %slogged in%s to post a comment.", "wptouch-pro" ), '<a href="' . wp_login_url( get_permalink() ) . '" class="no-ajax">', '</a>' ); ?></p>
	
	<?php else : ?>
	
	<form action="<?php echo bloginfo('wpurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	
		<?php if ( is_user_logged_in() ) : ?>
		
		<p><?php _e( "Logged in as", "wptouch-pro" ); ?> <a href="<?php echo bloginfo('wpurl'); ?>/wp-admin/profile.php" class="no-ajax"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e( "Log out of this account", "wptouch-pro" ); ?>"><?php _e( "Log out", "wptouch-pro" ); ?> &raquo;</a></p>
		
		<?php else : ?>
		
		<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="9" <?php if ( $req ) echo "aria-required='true'"; ?> />
		<label for="author"><small><?php _e( "Name", "wptouch-pro" ); ?><?php if ( $req ) echo "*"; ?></small></label></p>
		
		<p><input type="email" autocapitalize="off" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="10" <?php if ( $req ) echo "aria-required='true'"; ?> />
		<label for="email"><small><?php _e( "E-Mail", "wptouch-pro" ); ?><?php if ( $req ) echo "*"; ?></small></label></p>
		
		<p><input type="url" autocapitalize="off" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="11" />
		<label for="url"><small><?php _e( "Website", "wptouch-pro" ); ?></small></label></p>
				
		<?php endif; ?>
			
		<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="12"></textarea></p>
		
		<p><input name="submit" type="submit" id="submit" tabindex="13" value="<?php _e( "Submit Comment", "wptouch-pro" ); ?>" /></p>
		
		<?php comment_id_fields(); ?>

		<?php do_action( 'comment_form', $post->ID ); ?>
	
	</form>
	
	<?php endif; // If registration required and not logged in ?>
	</div>

<?php endif; // if you delete this the sky will fall on your head ?>