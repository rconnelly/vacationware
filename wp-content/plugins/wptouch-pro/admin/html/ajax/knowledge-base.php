<?php global $wptouch_pro; ?>
<?php $forum_posts = $wptouch_pro->bnc_api->get_support_posts( 5 ); ?>
<ul>
<?php if ( $forum_posts ) { ?>
	<?php foreach ( $forum_posts as $forum_posting ) { ?>
    <li>
        <a href="http://www.bravenewcode.com/support/topic/<?php echo $forum_posting->topic_slug; ?>" target="_blank"><?php echo $forum_posting->topic_title; ?></a> <?php echo sprintf( __( 'by %s', 'wptouch-pro' ), '<em>' . htmlentities( $forum_posting->topic_poster_name ), ENT_COMPAT, "UTF-8" ) . '</em>'; ?>
    </li>
    <?php } ?>
<?php } else { ?>
	<li class="no-listings"><?php _e( "The BraveNewCode Forums timed out.", "wptouch-pro" ); ?></li>
<?php } ?>
</ul>