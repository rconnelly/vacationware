<li id="<?php comment_ID() ?>" <?php comment_class() ?>>
	<div class="comment-buttons">
			<?php edit_comment_link( __( 'Edit', "wptouch-pro" ), ' <span class="edit-link">', '</span>' ); ?>
			<?php if ( !class_exists( 'wp_thread_comment' ) ) { ?>
				<?php if ( $args[ 'type' ] == 'all' || get_comment_type() == 'comment' ) { 
					comment_reply_link( 
						array_merge( 
							$args, array(
								'reply_text' => __( 'Reply',"wptouch-pro" ),
								'login_text' => __( 'Login',"wptouch-pro" ),
								'depth' => $depth
							)
						) 
					);
				} ?>
			
			<?php } ?>
    	</div>
	   	<?php classic_ipad_commenter_link() ?>
		<div class="comment-meta">
			<?php printf( __( '%1$s &bull; %2$s <span class="meta-sep"></span>', "wptouch-pro" ),
				get_comment_date(), 
				get_comment_time() ); 
			?>
		</div>
		<?php comment_text() ?>
		<?php if ( !$comment->comment_approved == '0' ) __( "<span class='unapproved'>Your comment is awaiting moderation.</span>", "wptouch-pro" ) ?>
	</div><!-- comment-content -->