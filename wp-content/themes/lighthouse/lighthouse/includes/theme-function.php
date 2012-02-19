<?php
load_theme_textdomain( 'templatesquare', TEMPLATEPATH.'/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);


// The excerpt based on character
function ts_string_limit_char($excerpt, $substr=0)
{
	$string = strip_tags(str_replace('...', '...', $excerpt));
	if ($substr>0) {
		$string = substr($string, 0, $substr);
	}
	return $string;
		}

// The excerpt based on words
function ts_string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

if ( ! isset( $content_width ) )
	$content_width = 620;

add_action( 'after_setup_theme', 'ts_setup' );


/* Remove inline styles printed when the gallery shortcode is used.*/
function ts_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'ts_remove_gallery_css' );

/*Template for comments and pingbacks. */
if ( ! function_exists( 'ts_comment' ) ) :
function ts_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="con-comment">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 60 ); ?>
		</div><!-- .comment-author .vcard -->


		<div class="comment-body">
			<?php  printf( __( '%s ', 'templatesquare' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?><br />
			<span class="time">
			<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s %2$s', 'templatesquare' ), get_comment_date(),  get_comment_time() ); ?></a>
				<?php edit_comment_link( __( '(Edit)', 'templatesquare' ), ' ' );?>
			</span>
			<?php comment_text(); ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'templatesquare' ); ?></em>
			<?php endif; ?>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div>
		<div class="clear"></div>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'templatesquare' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'templatesquare'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/*Prints HTML with meta information for the current post (category, tags and permalink).*/
if ( ! function_exists( 'ts_posted_in' ) ) :
function ts_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'Posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'templatesquare' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'Posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'templatesquare' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'templatesquare' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/*Clearing the automatic paragraphs and breaks on shortcodes that WordPress is adding automatically when filtering content.*/
function ts_remove_wpautop($content) { 
	$content = do_shortcode(shortcode_unautop($content)); 
	$content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
	$content = str_replace('<br />', '', $content);
	$content = str_replace('<p><div', '<div', $content);
	return $content;
}
	
/*Used in shortcodes to remove the default paragraphs WordPress adds */
function ts_remove_autop($content) { 
	$content = do_shortcode( shortcode_unautop($content) ); 
	$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
	return $content;
}

/* for top menu */
function nav_page_fallback() {
if(is_front_page()){$class="current_page_item";}
print '<ul id="nav"  class="sf-menu"><li class="'.$class.'"><a href=" '.home_url( '/') .' " title=" '.__('Click for Home','templatesquare').' ">'.__('Home','templatesquare').'</a></li>';
    wp_list_pages( 'title_li=&sort_column=menu_order' );
print '</ul>';
}

/* for excerpt */
function ts_trim_excerpt($text) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text, '<p>');
		$excerpt_length = 80;
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
			array_pop($words);
			array_push($words, '[...]');
			$text = implode(' ', $words);
		}
	}
	return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'ts_trim_excerpt');
?>