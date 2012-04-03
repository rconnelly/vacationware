/* WPtouch Pro Classic iPad JS */
/* This file holds all the default jQuery & Ajax functions for the classic theme on iPad */
/* Description: JavaScript for the Classic theme on iPad */
/* Required jQuery version: 1.6+ */

var touchJS = jQuery.noConflict();
var WPtouchWebApp = navigator.standalone;
var iOS5 = navigator.userAgent.match( 'OS 5_' );

/* For debugging Web-App mode in a browser */
//var WPtouchWebApp = true;

/* see http://cubiq.org/add-to-home-screen for additional options */
var addToHomeConfig = {
	animationIn: 'drop',
	animationOut: 'bubble',
	startDelay: 550,								// milliseconds
	lifespan: 1000*60,							// milliseconds  (set to: 30 secs)
	expire: 60*24*WPtouch.expiryDays,	// minutes (set in admin settings)
	bottomOffset: 14,
	touchIcon: true,
	arrow: true,
	message: WPtouch.add2home_message
};

/* Try to get out of frames! */
if ( window.top != window.self ) { 
	window.top.location = self.location.href
}

/* If it's iPad, use touchstart, in desktop browser, use click (touchstart/end is faster on iOS) */
if ( typeof ontouchstart != 'undefined' && typeof ontouchend != 'undefined' ) { 
	var touchStartOrClick = 'touchstart'; 
	var touchEndOrClick = 'touchend'; 
} else {
	var touchStartOrClick = 'click'; 
	var touchEndOrClick = 'click'; 
};

function doClassiciPadReady() {

	/* Prevent default touchmove function for iScrolls */	
	if ( iOS5 ) {
		var staticElements = touchJS( '#wptouch-header, #logo-area, .popover header' ); // these elements will not trigger a touchmove event
		staticElements.bind( 'touchmove', function( e ){ e.preventDefault(); } );
	} else {
		document.addEventListener( 'touchmove', function( e ){ e.preventDefault(); }, false );

		/* Fix for select elements on iOS 4.3.2 */		
		var formElements = touchJS( 'select, input, textarea' );
		formElements.bind( touchStartOrClick, function( e ) { e.stopPropagation(); } );	
	}

	/* Add the orientation event listener */	
	window.addEventListener( 'orientationchange', function() {
		classicUpdateOrientation();
	});

	/* Menubar Button Left Popover Triggers */	
	touchJS( '.head-left div.menubar-button' ).bind( touchEndOrClick, function(){
		var popoverName = '#pop-' + touchJS( this ).attr( 'id' );
		var linkOffset = touchJS( this ).offset();
		touchJS( popoverName ).css({
			top: '40px',
			left: linkOffset.left + 'px'
		}).popOverToggle();
		touchJS( popoverName + ' .menu-pointer-arrow' ).css( 'left', '20px' );
		headerDismissSpan();
		scrollerRefresh();
	});
	
	/* Menubar Button Right Popover Triggers */	
	touchJS( '.head-right div.menubar-button' ).bind( touchEndOrClick, function() {
		var popoverName = '#pop-' + touchJS( this ).attr( 'id' );
		var linkOffset = touchJS( this ).offset();
		touchJS( popoverName ).css({
			top: '40px',
			left: linkOffset.left - touchJS( popoverName ).width() / 1.45
		}).popOverToggle();
		touchJS( popoverName + ' .menu-pointer-arrow' ).css( 'right', '58px' );
		headerDismissSpan();
		scrollerRefresh();
	});
	
	/*  Tap the menubar to scroll the main content to top on pre-ios5 */	
	if ( !iOS5 ) {
		touchJS( '.head-center h1' ).bind( touchStartOrClick, function() {
			var homeScroller = touchJS( '#iscroll-wrapper' ).data( 'scroller' );
			homeScroller.scrollTo( 0, 0, 500 );
		});
	}

	/*  Menubar Blog PopOver Inner Tabs */
	touchJS( function() {
	    var tabContainers = touchJS( '#pop-blog > div' );

	    touchJS( 'ul.menu-tabs a' ).bind( touchStartOrClick, function( e ) {
	        tabContainers.hide().filter( this.rel ).show();
	    	touchJS( 'ul.menu-tabs a' ).removeClass( 'selected' );
	   		touchJS( this ).addClass( 'selected' );
			e.preventDefault();
			scrollerRefresh();
	  	  }).filter( ':first' ).trigger( touchStartOrClick );
	});

	/* Add highlights to a popover and menu links when clicked */
		touchJS( '#popovers-container .pop-inner li a, #pages-wrapper a' ).live( 'click', function() {
			touchJS( this ).parent().toggleClass( 'highlight' );
		});

	/* .active styling to mimic default iOS functionality */
	var touchDivs = '.button, .content a, .title-area a, .footer a, ol.commentlist a';
		touchJS( touchDivs ).live( touchStartOrClick, function() {
			touchJS( this ).addClass( 'active' );
		}).live( touchEndOrClick, function() {
			touchJS( this ).removeClass( 'active' );
		});
	
	/* Page menu: Hide the Child ULs */
	touchJS( '#pages-wrapper' ).find( 'li.has_children ul' ).hide();

	/* Page menu: Filter parent link href's and make them toggles for thier children */
	touchJS( '#pages-wrapper ul li.has_children > a' ).unbind( 'click' ).bind( 'click', function() {
		touchJS( this ).next().webkitSlideToggle( 350 );
		touchJS( this ).toggleClass( 'arrow-toggle' );
		touchJS( this ).parent().toggleClass( 'open-tree' );
		scrollerRefresh();
		return false;
	});
	
	/* Single post page share popover */	
	touchJS( 'a.share-post' ).unbind( 'click' ).bind( 'click', function() {
		var linkOffset = touchJS( this ).offset();
			touchJS( '#share-popover' ).css({
				top: linkOffset.top - 260 + 'px',
				left: linkOffset.left -	 25 + 'px',
				}).fadeIn( 350 );
		headerDismissSpan();
		return false;
	});
	
	/*  On single posts and pages, move the comments to the fly-in box */
	touchJS( '#respond' ).detach().appendTo( '.comment-reply-box .pop-inner' ).css( 'display', 'block' );
	touchJS( '#share-placeholder' ).detach().appendTo( '#share-popover' ).css( 'display', 'block' );

	touchJS( '.leave-a-comment, span.comments-close-button' ).unbind( 'click' ).bind( 'click', function() {
		touchJS( '.comment-reply-box' ).toggleClass( 'fly-in' ).flyInToggle();
		touchJS( 'input#comment_parent' ).val( '0' );
		touchJS( '#box-head h3' ).html( WPtouch.leave_a_comment );
		touchJS( '#peek' ).hide();
		touchJS( '#container1 textarea' ).removeClass( 'reply' );
		touchJS('#commentform input, #commentform textarea').blur();
		return false;
	});

	/* Peek in Comment Reply */
	touchJS( '#peek' ).unbind( 'click' ).bind( 'click', function() {
		touchJS( '#container1' ).toggleClass( 'slide' );
		touchJS( '#container2' ).toggleClass( 'slide2' );
		return false;
	});
  
	/* Log In To Comment Trigger */
  	touchJS( 'a.comment-reply-login, a.reply-to-comment' ).unbind( 'click' ).bind( touchStartOrClick, function() {
		touchJS( '#account.menubar-button' ).trigger( touchEndOrClick );
		return false;
	});	

	/* Try to make imgs and captions nicer in posts (images and caption larger than 350px get aligncenter)  */	
	if ( touchJS( '.post' ).length ) {
		touchJS( '.content img, .content .wp-caption' ).each( function() {
			if ( touchJS( this ).width() >= 350 ) {
				touchJS( this ).addClass( 'aligncenter' );
			}
		});
	}

	/*  Make sure the menubar stays present when form textareas are out of focus (non-iOS 5) */	
	if ( !iOS5 ) {
		touchJS( 'textarea, form#prowl-direct-message input, form#loginform input, .content input' ).bind( 'blur', function() {
			scrollTo( 0, 0, 100 );
		});
	}
	
	/* Instapaper Share Hookup */
	touchJS( 'li#instapaper a' ).click( function() {
		var userName = prompt( WPtouch.instapaper_username, '' );
		if ( userName ) {
			var passWord = prompt( WPtouch.instapaper_password, '' );
			if ( !passWord ) {
				passWord = 'default';	
			}
			
			var ajaxParams = {
				url: document.location.href,
				username: userName,
				password: passWord,
				title: document.title
			};
			
			WPtouchAjax( 'instapaper', ajaxParams, function( result ) {
				if ( result == '1' ) {
					alert( WPtouch.instapaper_saved );
					touchJS( '#share-popover' ).fadeOut( 350 );
				} else {
					alert( WPtouch.instapaper_try_again );
				}
			});
		}
		return false;
	});

	/* Ajaxify commentform */
	var postURL = document.location;
	var CommentFormOptions = {
		beforeSubmit: function() {
			touchJS( '#container1' ).append( '<div id="comment-spinner"></div>' );
		},
		success: function() {
			touchJS( 'ol.commentlist' ).load( postURL + ' ol.commentlist > li', function(){ 
				touchJS( '#comment-spinner' ).remove();
				touchJS( '#container1 textarea' ).addClass( 'success' );			
				commentReplyLinks();
			});
			setTimeout( function() { 
				touchJS( '.comments-close-button' ).trigger( 'click' );
				touchJS( '#container1 textarea' ).removeClass( 'success' );
				scrollerRefresh();
			}, 1500 );
		},
		error: function() {
		touchJS( '#comment-spinner' ).remove();
			touchJS( '#container1 textarea' ).addClass( 'error' );
			touchJS( '#container1' ).prepend( '<div id="error-text">' + WPtouch.comment_failure +'</div>' );
			setTimeout( function () { 
				touchJS( '#container1 textarea' ).removeClass( 'error' );
				touchJS( '#error-text' ).remove();
			}, 3000 );
		},
		resetForm: true,
		timeout:   7500
	} 	//end options
	
	
	if ( touchJS.isFunction( touchJS.fn.ajaxForm ) ) {
		touchJS( '#commentform' ).ajaxForm( CommentFormOptions );
	}

	/* Ajaxify Prowl Form */
	var prowlFormOptions = {
		beforeSubmit: function formValidate( formData, jqForm, options ) { 
				for ( var i=0; i < formData.length; i++ ) { 
					if ( !formData[i].value ) { 
						alert( WPtouch.validation_message ); 
						return false; 
					}
				touchJS( '#prowl-direct-message p' ).prepend( '<div id="prowl-spinner"></div>' );
				}
		},
		success: function() {
		touchJS( '#prowl-spinner' ).remove();
			touchJS( '#prowl-direct-message textarea' ).addClass( 'success' );
			setTimeout( function () { 
				touchJS( '#message' ).trigger( touchEndOrClick );
				touchJS( '#prowl-direct-message textarea' ).removeClass( 'success' );
			}, 1000 );
		},
		error: function() {
		touchJS( '#prowl-spinner' ).remove();
			touchJS( '#prowl-direct-message textarea' ).addClass( 'error' );
			touchJS( '#prowl-direct-message' ).prepend( '<div id="prowl-error-text">' + WPtouch.prowl_failure +'</div>' );
			setTimeout( function () { 
				touchJS( '#prowl-direct-message textarea' ).removeClass( 'error' );
				touchJS( '#prowl-error-text' ).remove();
			}, 4000 );
		},
		resetForm: true,
		timeout:   3500
	} 	//end options
	
	if ( touchJS.isFunction( touchJS.fn.ajaxForm ) ) {
		touchJS( '#prowl-direct-message' ).ajaxForm( prowlFormOptions );
	}

	/* Refresh the main iScroll when all page items are loaded */	
	touchJS( window ).load( function() {  
		if ( touchJS( '#welcome-message' ).length ) { touchJS( '#welcome-message' ).show(); }
		setTimeout( function() { scrollerRefresh(); }, 0 );
	});
	
	/* Set tabindex automagically */
	touchJS( function(){
	var tabindex = 1;
		touchJS( 'input, select, textarea' ).each( function() {
			if ( this.type != 'hidden' ) {
				var inputToTab = touchJS( this );
				inputToTab.attr( 'tabindex', tabindex );
				tabindex++;
			}
		});
	});
	
	/* New Toggle Switch JS */
	var onLabel = WPtouch.toggle_on;
	touchJS( '.on' ).text( onLabel );
	
	var offLabel = WPtouch.toggle_off;
	touchJS( '.off' ).text( offLabel );
	
	touchJS( '#switch div' ).bind( touchEndOrClick, function(){ 
		var switchURL = touchJS( this ).attr( 'title' );
		touchJS( '.on' ).toggleClass( 'active' );
		touchJS( '.off' ).toggleClass( 'active' );
		setTimeout( function () { window.location = switchURL }, 500 );
		return false;
	});
	
	/* add dynamic automatic video resizing via fitVids */

	var videoSelectors = [
		"iframe[src^='http://player.vimeo.com']",
		"iframe[src^='http://www.youtube.com']",
		"iframe[src^='http://www.kickstarter.com']",
		"object",
		"embed",
		"video"
	];
	
	var allVideos = touchJS( '.content' ).find(videoSelectors.join(','));
	
	touchJS( allVideos ).each( function(){ 
		touchJS( this ).unwrap().addClass( 'wptouch-videos' ).parentsUntil( '.content', 'div:not(.fluid-width-video-wrapper), span' ).removeAttr( 'width' ).removeAttr( 'height' ).removeAttr( 'style' );
	});

	touchJS( '.content' ).fitVids();

	/* Functions to run onReady */
	classicUpdateOrientation();
	loadMoreEntries();
	commentReplyLinks();
	loadMoreComments();
	welcomeMessage();
	webAppLinks();
	webAppOnly();
	setupScrolls();
	classicHandleShortcodes();
}
/* End Document Ready */

/* Setup iScrolls */
function setupScrolls(){
	if ( !iOS5 ) {
		touchJS( '.iscroller' ).each( function(){
			var scroller = touchJS( this ).attr( 'id' );
			activeScroller = new iScroll( scroller );
			touchJS( this ).data( 'scroller', activeScroller );
		});
	}
}

function scrollerRefresh() {
	if ( !iOS5 ) {
			var currentScroller = touchJS( '.iscroller' ).filter( ':visible' ).data( 'scroller' );
			var homeScroller = touchJS( '#iscroll-wrapper' ).data( 'scroller' );
		setTimeout( function() { 
			currentScroller.refresh(); 
			homeScroller.refresh();
		}, 0 );
	} else {
		return true; // continue on
	}
}

/* Detect orientation and do some Voodoo with the menubar's menu */
function classicUpdateOrientation() {	
	var windowHeight = touchJS( window ).height() - 44;
	var imageHeight = touchJS( '#logo-area' ).height();
	var menuHeight = windowHeight - imageHeight;
	var orientationCookie = WPtouchReadCookie( 'wptouch-ipad-orientation' );
	switch( window.orientation ) {
		// Portrait
		case 0:
		case 180:
			touchJS( 'body' ).removeClass( 'landscape' ).addClass( 'portrait' );
			touchJS( '#iscroll-wrapper' ).css( 'height', windowHeight );
			touchJS( '#main-menu #pages-wrapper' ).detach().appendTo( '#pop-menu .pop-inner' ).css( 'height', 'auto' ).css( 'max-height', '500px' );
			touchJS( '.popover.open' ).each( function() { touchJS( this ).removeClass( 'open' ).hide(); });
			WPtouchCreateCookie( 'wptouch-ipad-orientation', 'portrait', 365 );
		break;
		// Landscape & Browsers
		case 90:
		case -90:
		default:
			touchJS( 'body' ).removeClass( 'portrait' ).addClass( 'landscape' );
			touchJS( '#iscroll-wrapper' ).css( 'height', windowHeight );
			touchJS( '#pages-wrapper' ).detach().css( 'height', menuHeight ).css( 'max-height', 'none' ).appendTo( '#main-menu' );
			touchJS( '.popover.open' ).each( function() { touchJS( this ).removeClass( 'open' ).hide(); });
			WPtouchCreateCookie( 'wptouch-ipad-orientation', 'landscape', 365 );
	}
	if ( !iOS5 ) {
		setTimeout( function() { 
			var homeScroller = touchJS( '#iscroll-wrapper' ).data( 'scroller' );
			homeScroller.refresh();
		}, 550 );
	}
}

/* Create a dismiss span that will reverse open popovers when triggered */
function headerDismissSpan() {
	if ( !touchJS( '#dismiss-underlay' ).length ) {
		touchJS( 'body' ).append( '<span id="dismiss-underlay"></span>' );
		touchJS( '#dismiss-underlay' ).bind( touchStartOrClick, function( e ) {
			touchJS( this ).remove();
			touchJS( '#popovers-container .popover.open' ).removeClass( 'open' ).fadeOut( 350 );
			touchJS( '#share-popover' ).fadeOut( 350 );
			return false;
		});
	} else {
		touchJS( '#dismiss-underlay' ).remove();	
	}
}

function classicHandleShortcodes() {
	// For web application mode
	if ( WPtouchWebApp ) {
		var webAppDivs = jQuery( '.wptouch-shortcode-webapp-only' );
		if ( webAppDivs.length ) {
			webAppDivs.show();
		}
	}
}

function loadMoreEntries() {
	var loadMoreLink = touchJS( 'a.load-more-link' );
	var ajaxDiv = '.ajax-page-target';
	if ( loadMoreLink.length ) {
		loadMoreLink.unbind( 'click' ).live( 'click', function() {
			touchJS( 'a.load-more-link span' ).addClass( 'ajax-spinner' );
			var loadMoreURL = touchJS( this ).attr( 'href' );
			touchJS( '#content' ).append( "<div class='ajax-page-target'></div>" );
			touchJS( ajaxDiv ).hide().load( loadMoreURL + ' #content .post, #content .load-more-link', function() {
				touchJS( this ).replaceWith( touchJS( this ).html() );	
				touchJS( 'span.ajax-spinner' ).parent().fadeOut( 350 );
				webAppLinks();
				scrollerRefresh();
				touchJS( '.content' ).fitVids();
			});
			return false;
		});	
	}	
}

/* Load More Comments */
function loadMoreComments() {
	var loadMoreLink = touchJS( 'ol.commentlist li.load-more-comments-link a' );
	if ( loadMoreLink.length ) {
		loadMoreLink.unbind( 'click' ).live( 'click', function() {
			var loadMoreURL = touchJS( this ).attr( 'href' );
			touchJS( this ).addClass( 'ajax-spinner' ).delay( 1250 ).fadeOut( 350 );
			touchJS( 'ol.commentlist' ).append( "<div class='ajax-page-target'></div>" );

			touchJS( 'div.ajax-page-target' ).hide().load( loadMoreURL + ' ol.commentlist > li', function() {
				touchJS( this ).replaceWith( touchJS( this ).html() );	
				commentReplyLinks();
				webAppLinks();
				scrollerRefresh();
			});
			return false;
		});	
	}	
}

/* Comment Reply Gravy - Not perfect yet  */	
function commentReplyLinks() {
	touchJS( '.commentlist a.comment-reply-link' ).bind( touchStartOrClick, function() {
		var CommentID = touchJS( this ).closest( 'li.comment' ).attr( 'ID' );
		var CommenterName = touchJS( '#' + CommentID ).find( 'span.fn:first' ).text();
		var PostID = touchJS( '.commentlist ol' ).attr( 'ID' );
		var CommentContent = touchJS( 'li#' + CommentID + ' .comment-content:first > p' ).text();

		touchJS( '.comment-reply-box' ).addClass( 'fly-in' ).flyInToggle();		
		touchJS( '#box-head h3' ).html( WPtouch.leave_a_reply + ' <span>' + CommenterName + '</span>');
		touchJS( '#peek' ).show();
		touchJS( 'input#comment_parent' ).val( CommentID );
		touchJS( '#container1 textarea' ).addClass( 'reply' );
		touchJS( '#container2' ).html( CommentContent );
		return false;
	});
}

function webAppLinks() {
	if ( WPtouchWebApp ) {
		// The New Sauce ( Nobody makes tasty gravy like mom )		
		// bind to all links, except UI controls and such
		var webAppLinks = touchJS( 'a' ).not( 
			'.no-ajax, .email a, .button, .comment-buttons a, ul.menu-tabs a, #pages-wrapper .has_children > a, a.load-more-link, .load-more-comments-link a, #share-popover a, .GTTabs a' );

 		webAppLinks.each( function(){
			var targetUrl = touchJS( this ).attr( 'href' ); 		
			var targetLink = touchJS( this );
			var localDomain = location.protocol + '//' + location.hostname;
			var rootDomain = location.hostname.split( '.' );
			var masterDomain = rootDomain[1] + '.' + rootDomain[2];

			// link is local, but set to be non-mobile
			if ( typeof wptouch_ignored_urls != 'undefined' ) {
			   touchJS.each( wptouch_ignored_urls, function( i, value ) {
			       if ( targetUrl.match( value ) ) {
						targetLink.addClass( 'ignored' );
			       }
			   });
			}

		   // filetypes, images class name additions
	       if ( targetUrl.match( ( /[^\s]+(\.(pdf|numbers|pages|xls|xlsx|doc|docx|zip|tar|gz|csv|txt))$/i ) ) ) {
				targetLink.addClass( 'external' );
	       } else if ( targetUrl.match( ( /[^\s]+(\.(jpg|jpeg|gif|png|bmp|tiff))$/i ) ) ) {
				targetLink.addClass( 'img-link' );
	       }

			touchJS( targetLink ).unbind( 'click' ).bind( 'click', function( e ) {
				// is this an external link? Confirm to leave WAM
				if ( touchJS( targetLink ).hasClass( 'external' ) || touchJS( targetLink ).parent( 'li' ).hasClass( 'external' ) ) {
			       	confirmForExternal = confirm( WPtouch.external_link_text + ' \n' + WPtouch.open_browser_text );
					if ( confirmForExternal ) {
						return true;
					} else {			
						e.preventDefault();
						e.stopImmediatePropagation();
					}
				// prevent images with links to larger ones from opening in web-app mode
				} else if ( touchJS( targetLink ).hasClass( 'img-link' ) ) {
					return false;

				// local http link or no http present: 
				} else if ( targetUrl.match( localDomain ) || !targetUrl.match( 'http://' ) ) {
					// make sure it's not in the ignored list first
					if ( touchJS( targetLink ).hasClass( 'ignored' ) || touchJS( targetLink ).parent( 'li' ).hasClass( 'ignored' ) ) {
				       	confirmForExternal = confirm( WPtouch.wptouch_ignored_text + ' \n' + WPtouch.open_browser_text );
							if ( confirmForExternal ) {
								return true;	
							} else {
								return false;
							}
					// okay, it's passed the tests, this is a local link, fire WAM
					} else {
						WPtouchCreateCookie( 'wptouch-load-last-url', targetUrl, 365 );
						window.location = targetUrl;  
						e.preventDefault();
					} 
				// not local, not ignored, doesn't have no-ajax but it's got an external http domain url
				} else {
			       	confirmForExternal = confirm( WPtouch.external_link_text + ' \n' + WPtouch.open_browser_text );
					if ( confirmForExternal ) {
						return true;
					} else {			
						return false;
					}					
				}
			}); /* end click bindings */
		}); /* end .each loop */
	} else {
		// Do non web-app setup
		touchJS( 'li.target a' ).attr( 'target', '_blank' );
	}
}

function webAppOnly() {
	if ( WPtouchWebApp ) {
		var persistenceOn = touchJS( 'body.loadsaved' ).length;
		touchJS( 'body' ).addClass( 'web-app' );
		touchJS( '#account-link-area, #switch, #welcome-message' ).remove();
		if ( !persistenceOn ) {
			WPtouchEraseCookie( 'wptouch-load-last-url' );
		}
		/* prevent images with links to larger ones from opening in web-app mode */
		touchJS( '.post a' ).has( 'img' ).each( function(){ 
			touchJS( this ).click( function( e ) {
		  		var imgURL = touchJS( this ).attr( 'href' );
				if ( imgURL.match( '.jpg' ) || imgURL.match( '.png' ) || imgURL.match( '.jpeg' ) || imgURL.match( '.gif' ) ) {
					e.preventDefault();
					e.stopImmediatePropagation();
				}
			});
		});
	}
}

function welcomeMessage() {
	if ( !WPtouchWebApp ) {	
		touchJS( 'a#close-msg' ).unbind( 'click' ).bind( 'click', function() {
			WPtouchCreateCookie( 'wptouch_welcome', '1', 365 );
			touchJS( '#welcome-message' ).fadeOut( 350 );
			return false;
		});
	}
}

//	if ( window.history.length < 2 ) {
//		touchJS( '#back, #forward' ).hide();
//	} else if ( window.history.length = 2 ) {
//		touchJS( '#forward' ).hide();
//	} else {	
//		touchJS( '#back, #forward' ).show();
//	}
//	  
//	  touchJS( '#back, #forward' ).bind( touchEndOrClick, function( e ) {
//		if ( touchJS( this ).attr( 'ID' ) == 'back' ) {
//		  	history.back();
//	  	} else {
//		  	history.forward();	  	
//	  	}
//	  });

/* New touchJS function popOverToggle() for popover windows */
touchJS.fn.popOverToggle = function() { 
	if ( !this.hasClass( 'open' ) ) {
		this.show().addClass( 'open' );
	} else {
		this.removeClass( 'open' ).fadeOut( 350 );
	}
}

/* New touchJS function flyInToggle() for Message/Comment Windows */
touchJS.fn.flyInToggle = function() { 
//	var boxHeight = this.height() + 150;
	if ( this.hasClass( 'fly-in' ) ) {
		this.viewportCenter().css('-webkit-transform', 'scale(1)' ).css( 'opacity', '1' ).css( '-webkit-transition', '350ms' );
	} else {
		this.viewportCenter().css('-webkit-transform', 'scale(0)' ).css( 'opacity', '0' ).css( '-webkit-transition', '350ms' );
	}
}

/* New jQuery function viewportCenter() */
jQuery.fn.viewportCenter = function() {
    this.css( 'position', 'absolute' );
    this.css( 'top', ( ( touchJS( window ).height() - this.outerHeight() ) / 2 ) + touchJS( window ).scrollTop() + 'px' );
    this.css( 'left', ( ( touchJS( window ).width() - this.outerWidth() ) / 2 ) + touchJS( window ).scrollLeft() + 'px' );
	this.show();
    return this;
}

/* New touchJS function webkitSlideToggle() */
touchJS.fn.webkitSlideToggle = function() { 
	if ( !this.hasClass( 'slide-in' ) ) {
		this.show().addClass( 'slide-in' );
	} else {
		this.slideUp( 350 ).removeClass( 'slide-in' );
	}
}

/* Cookie Functions */

function WPtouchCreateCookie( name, value, days ) {
	if ( days ) {
		var date = new Date();
		date.setTime( date.getTime() + ( days*24*60*60*1000 ) );
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path="+WPtouch.siteurl;
}

function WPtouchReadCookie( name ) {
	var nameEQ = name + "=";
	var ca = document.cookie.split( ';' );
	for( var i=0;i < ca.length;i++ ) {
		var c = ca[i];
		while ( c.charAt(0)==' ' ) c = c.substring( 1, c.length );
		if ( c.indexOf( nameEQ ) == 0 ) return c.substring( nameEQ.length, c.length );
	}
	return null;
}

function WPtouchEraseCookie( name ) {
	WPtouchCreateCookie( name,"",-1 );
}

touchJS( document ).ready( function() { doClassiciPadReady(); } );