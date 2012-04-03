<?php

// Do not delete these lines
	if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ('Please do not load this page directly. Thanks!');
	}

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( "This post is password protected. Enter the password to view comments", "wptouch-pro" ); ?>.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<div class="navigation dark-gradient">
		<?php if ( classic_wp_comments_nav_on() && !classic_is_ajax_enabled() ) { ?>
			<div class="alignleft"><?php previous_comments_link() ?></div>
		<?php } ?>
		<div class="aligncenter"><?php classic_ipad_comments_title(); ?></div>
		<?php if ( classic_wp_comments_nav_on() && !classic_is_ajax_enabled() ) { ?>
			<div class="alignright"><?php next_comments_link() ?></div>
		<?php } ?>
	</div>
	
	<ol class="commentlist rounded-corners-8px">
		<?php wp_list_comments('type=all&callback=classic_ipad_custom_comments'); ?>
		<?php if ( classic_is_ajax_enabled() ) { ?>
			<?php if ( classic_comments_newer() ) { ?>
				<li class="load-more-comments-link"><?php previous_comments_link(__( "Load More Comments&hellip;", "wptouch-pro" ) ); ?></li>
			<?php } else { ?>
				<li class="load-more-comments-link"><?php next_comments_link(__( "Load More Comments&hellip;", "wptouch-pro" ) ); ?></li>
			<?php } ?>
		<?php } ?>
	</ol>
 
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e( "Comments are closed on this entry.", "wptouch-pro" ); ?></p>
	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>
	
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<br />
		<div class="aligncenter"><a class="reply-to-comment button" href="javascript: return false"><?php _e( "Log In To Comment", "wptouch-pro" ); ?></a></div>
	<?php else : ?>
		<br />
		<div class="aligncenter"><div class="leave-a-comment button"><?php _e( "Leave A Comment", "wptouch-pro" ); ?></div></div>
	<?php endif; ?>
	<div id="respond" style="display:none">
	
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p class="logged"><?php echo sprintf( __( "You must be %slogged in%s to post a comment.", "wptouch-pro" ), '<a href="' . wp_login_url( get_permalink() ) . '">', '</a>' ); ?></p>
	<?php else : ?>
	
	<form action="<?php wptouch_bloginfo('wpurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( is_user_logged_in() ) : ?>
		
		<p class="logged"><?php _e( "Logged in as", "wptouch-pro" ); ?> <?php echo $user_identity; ?>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e( "Log out of this account", "wptouch-pro" ); ?>"><?php _e( "Log out", "wptouch-pro" ); ?> &raquo;</a></p>
		
		<?php else : ?>
		
		<span class="namespan">
			<input placeholder="<?php _e( "Name  (Required)", "wptouch-pro" ); ?>" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" <?php if ( $req ) echo "aria-required='true'"; ?> tabindex="10" />
		</span>
		<span class="emailspan">
			<input placeholder="<?php _e( "E-Mail (Required)", "wptouch-pro" ); ?>" type="email" autocapitalize="off" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" <?php if ( $req ) echo "aria-required='true'"; ?> tabindex="11" />
		</span>	
		<input placeholder="<?php _e( "Your Website Address", "wptouch-pro" ); ?>" type="url" autocapitalize="off" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="12" />
		<?php endif; ?>
			
		<div id="container1">
			<div id="peek" class="button"><span>&#132;</span></div>		
			<textarea name="comment" id="comment" cols="58" rows="10" tabindex="13"></textarea>
			<input name="submit" type="submit" id="submit" class="button" value="<?php _e( "Publish Comment", "wptouch-pro" ); ?>" tabindex="14" />
		</div>
		
		<div id="container2"></div>
	
		<?php comment_id_fields(); ?>
		
		<?php do_action( 'comment_form', $post->ID ); ?>
		
		<input type="hidden" name="comment_post_ID" value="<?php the_ID(); ?>" id="comment_post_ID">
		<input type="hidden" name="comment_parent" id="comment_parent" value="0">
	</form>
	
	<?php endif; // If registration required and not logged in ?>
	</div>
<?php endif; // if you delete this the sky will fall on your head ?>
