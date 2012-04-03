<?php get_header(); ?>

	<div class="attachment posts-nav post rounded-corners-8px">
		<span class="left clearfix"><a href="javascript:return false" onclick="window.history.back();"><?php _e( 'Back', 'wptouch-pro' ); ?></a></span>
	</div><!-- #nav-single -->


<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

	<?php the_post(); ?>
	
	<h1 class="entry-title"><?php the_title(); ?></h1>
	
	<div class="entry-meta">
		<?php
		$metadata = wp_get_attachment_metadata();
		printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span><span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span>
		<br />at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a><br />in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'wptouch-pro' ),
		esc_attr( get_the_time() ),
		get_the_date(),
		esc_url( wp_get_attachment_url() ),
		$metadata['width'],
		$metadata['height'],
		esc_url( get_permalink( $post->post_parent ) ),
		get_the_title( $post->post_parent )
		);
		?>
		<?php edit_post_link( __( ' | Edit', 'wptouch-pro' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-meta -->
	<br />
	<div class="content">
		<?php
		$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
		foreach ( $attachments as $k => $attachment ) {
			if ( $attachment->ID == $post->ID )
				break;
			}
			$k++;
		if ( count( $attachments ) > 1 ) {
			if ( isset( $attachments[ $k ] ) )
				// get the URL of the next image attachment
				$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
			else
				// or get the URL of the first image attachment
				$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
		} else {
			// or, if there's only 1 image, get the URL of the image
			$next_attachment_url = wp_get_attachment_url();
		}
		?>
		<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
			<?php echo wp_get_attachment_image( $post->ID, array( 600, 600 ) ); ?>
		</a>
	
		<?php if ( ! empty( $post->post_excerpt ) ) : ?>
			<div class="entry-caption">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>

	</div><!-- .content -->

	<div class="entry-description">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-description -->
	
</div><!-- .post -->

	<div id="nav-single" class="attachment posts-nav post rounded-corners-8px">
		<span class="left"><?php previous_image_link( false, __( 'Previous Image' , 'wptouch-pro' ) ); ?></span>
		<span class="right clearfix"><?php next_image_link( false, __( 'Next Image' , 'wptouch-pro' ) ); ?></span>
	</div><!-- #nav-single -->


<?php get_footer(); ?>