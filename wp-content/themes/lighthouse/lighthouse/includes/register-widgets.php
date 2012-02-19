<?php
/**
 * Loads up all the widgets defined by this theme. Note that this function will not work for versions of WordPress 2.7 or lower
 *
 */


include_once (TEMPLATEPATH . '/includes/widgets/ts-recent-comment.php');
include_once (TEMPLATEPATH . '/includes/widgets/ts-recent-posts.php');
include_once (TEMPLATEPATH . '/includes/widgets/ts-post-cycle.php');
include_once (TEMPLATEPATH . '/includes/widgets/ts-property-search.php');
include_once (TEMPLATEPATH . '/includes/widgets/ts-property-tag.php');

add_action("widgets_init", "load_ts_widgets");

function load_ts_widgets() {
	register_widget("TS_RecentCommentWidget");
	register_widget("TS_RecentPostWidget");
	register_widget("TS_PostCycleWidget");
	register_widget("TS_PropertySearchWidget");
	register_widget("TS_PropertyTagWidget");
}
?>