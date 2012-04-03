<?php

//add_action( 'wptouch_module_init', 'wptouch_youtube_mobile_init' );

function wptouch_youtube_mobile_init() {
	add_filter( 'wptouch_the_content', 'wptouch_youtube_module_content' );	
}

function wptouch_youtube_module_content( $content ) {
	$result = preg_match_all( '#<object (.*)>(.*)<param (.*) value=["\']http://www.youtube.com/v/(.*)\?(.*)["\'] (.*)>(.*)</object>#iU', $content, $matches );
	if ( $result && count( $matches ) ) {		
		for( $i = 0 ; $i < count( $matches[0] ) ; $i++ ) {
			$video_id = $matches[4][$i];

			$video_width = 640;
			$video_height = 480;

			if ( preg_match( '#width=["\'](.*)["\']#iU', $matches[0][$i], $wmatches ) ) {
				$video_width = $wmatches[1];
			}

			if ( preg_match( '#height=["\'](.*)["\']#iU', $matches[0][$i], $hmatches ) ) {
				$video_height = $hmatches[1];
			}

			$width_height = '';

			$width_height = 'width="' . $video_width . '" height="' . $video_height . '" ';
			
			$content = str_replace( $matches[0][$i], '<iframe class="youtube-player" type="text/html" ' . $width_height . 'src="http://www.youtube.com/embed/' . $video_id . '" frameborder="0"></iframe>', $content );	
		}
	}
	
	return $content;	
}

