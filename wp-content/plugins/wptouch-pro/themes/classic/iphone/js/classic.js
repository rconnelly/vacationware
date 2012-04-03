/* WPtouch Pro Classic JS */
/* This file holds all the default jQuery & Ajax functions for the classic theme on mobile */
/* Description: JavaScript for the Classic theme on mobile */
/* Required jQuery version: 1.5.2+ */

var touchJS = jQuery.noConflict();
var WPtouchWebApp = navigator.standalone;
var iOS5 = navigator.userAgent.match( 'OS 5_' );

/* For debugging Web-App mode in a browser */
//var WPtouchWebApp = true;

/* see http://cubiq.org/add-to-home-screen for additional options */
var addToHomeConfig = {
	animationIn: 'bubble',
	animationOut: 'drop',
	startDelay: 550,								// milliseconds
	lifespan: 1000*60,							// milliseconds  (set to: 30 secs)
	expire: 60*24*WPtouch.expiryDays,	// minutes (set in admin settings)
	bottomOffset: 14,
	touchIcon: true,
	arrow: true,
	message: WPtouch.add2home_message
};

/*
If it's a device that supports ontouchstart & ontouchend, then we'll use the faster event handlers. 
Desktop browsers use click (ontouchstart/end is faster on iOS & Android).
*/
if ( typeof ontouchstart != 'undefined' && typeof ontouchend != 'undefined' ) { 
	var touchStartOrClick = 'touchstart', touchEndOrClick = 'touchend'; 
} else {
	var touchStartOrClick = 'click', touchEndOrClick = 'click'; 
};

/* Try to get out of frames! */
if ( window.top != window.self ) { 
	window.top.location = self.location.href
}

function doClassicReady() {

	/*  Header #tab-bar tabs */
	touchJS( function() {
	    var tabContainers = touchJS( '#menu-container > div' );
	
	    touchJS( '#tab-inner-wrap-left a' ).click( function() {
	        tabContainers.hide().filter( this.hash ).show();
	    	touchJS( '#tab-inner-wrap-left a' ).removeClass( 'selected' );
	   		touchJS( this ).addClass( 'selected' );
	        return false;
	    }).filter( ':first' ).click();
	});

	touchJS( 'a#header-menu-toggle' ).click( function() {
//		if ( WPtouchWebApp && iOS5 ) {
//			touchJS( this ).toggleClass( 'menu-toggle-open' );
//			touchJS( '#main-menu' ).toggleClass( 'open' ).toggleClass( 'closed' );	
//			return false;		
//		} else {
			touchJS( this ).toggleClass( 'menu-toggle-open' );
			touchJS( '#main-menu' ).opacityToggle( 380 );	
			return false;
//		}
	});	

	touchJS( '#main-menu ul li a:not(li.has_children > a)' ).bind( 'click', function(){
		touchJS( this ).parent().addClass( 'active' );
	});

	touchJS( 'a#tab-search' ).click( function() {
		touchJS( '#search-bar' ).toggleClass( 'show-search' );
		touchJS( this ).toggleClass( 'search-toggle-open' );
		return false;
	});	

	/* Filter parent link href's and make them toggles for thier children */
	touchJS( '#main-menu' ).find( 'li.has_children ul' ).hide();
	
	touchJS( '#main-menu ul li.has_children > a' ).click( function() {
		touchJS( this ).parent().children( 'ul' ).opacityToggle( 380 );
		touchJS( this ).toggleClass( 'arrow-toggle' );
		touchJS( this ).parent().toggleClass( 'open-tree' );
		return false;
		});

	/* If Prowl Message Sent */
	if ( touchJS( '#prowl-message' ).length ) {
		setTimeout( function() { touchJS( '#prowl-message' ).fadeOut( 350 ); }, 2500 );
	}

	/* Try to make imgs and captions nicer in posts */	
		touchJS( '.content img, .content .wp-caption' ).each( function() {
			if ( !touchJS( this ).hasClass( 'aligncenter' ) && touchJS( this ).width() > 105 ) {
				touchJS( this ).addClass( 'aligncenter' );
			}
		});

	/* Pesky plugin image protect stuff */	
	touchJS( '.single .p3-img-protect' ).each( function() {
		touchJS( '.p3-overlay' ).remove();
		var insideContent = touchJS( this ).html();
		touchJS( this ).replaceWith( insideContent );
	});

	/* Single post page share menu */
	touchJS( 'a#share-toggle' ).click( function( e ) {
		touchJS( '#share-links' ).opacityToggle( 330 );
		e.PreventDefault();
	});	
	
	/* .active styling to mimic default iOS functionality */
		touchJS( '#action-buttons a, .comment-buttons a, a#cancel-comment-reply-link, a.com-toggle' ).bind( touchStartOrClick, function() {
			touchJS( this ).addClass( 'active' );
		}).bind( touchEndOrClick, function() {
			touchJS( this ).removeClass( 'active' );
		});

	touchJS( 'a#instapaper-toggle' ).click( function( e ) {
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
				} else {
					alert( WPtouch.instapaper_try_again );
					touchJS( 'a#instapaper-toggle' ).click();
				}
			});
		}
		e.PreventDefault();
	});

	touchJS( '#email a' ).click( function() {
		touchJS( 'a#share-toggle' ).click();
		return true;
	});

	/* Add a rounded top left corner to the first gravatar in comments, removes double bordering */
	touchJS( '.commentlist li :first, .commentlist img.avatar:first' ).addClass( 'first' );

	touchJS( 'a.com-toggle' ).bind( 'click', function() {
		touchJS( 'ol.commentlist' ).toggleClass( 'hidden' );
		touchJS( 'img#com-arrow' ).toggleClass( 'com-arrow-down' );
		return false;
	});
		
	/* Detect window width and add corresponding 'portrait' or 'landscape' classes onload */
	if ( touchJS( window ).width() >= 480 ) { 
		touchJS( 'body' ).addClass( 'landscape' );
	} else {
		touchJS( 'body' ).addClass( 'portrait' );
	}

	/* Detect orientation change and add or remove corresponding 'portrait' or 'landscape' classes */
	window.onorientationchange = function() {
		var scrollPosition = touchJS( 'body' ).scrollTop() + 1;
		var orientation = window.orientation;
			switch( orientation ) {
				//Portrait
				case 0:
				case 180:
				touchJS( 'body' ).addClass( 'portrait' ).removeClass( 'landscape' );
				window.scrollTo( 0, scrollPosition,100 );
				break;
				//Landscape
				case 90:
				case -90:
				touchJS( 'body' ).addClass( 'landscape' ).removeClass( 'portrait' );
				window.scrollTo( 0, scrollPosition,100 );
				break;
				default:
				touchJS( 'body' ).addClass( 'portrait' ).removeClass( 'landscape' );				
			}
	}
	
	var header = touchJS( '#header' ).get(0);
	header.addEventListener( 'touchmove', classicTouchMove, false );
    
    // Check to make sure the menu bar is in the DOM
    if ( touchJS( '#tab-bar' ).length ) {
        var tabBar = touchJS( '#tab-bar' ).get(0);
        tabBar.addEventListener( 'touchmove', classicTouchMove, false );
    }
	
	/* Ajaxify commentform */
	var postURL = document.location;
	var CommentFormOptions = {
		beforeSubmit: function() {
			touchJS( '#commentform textarea' ).addClass( 'loading' );			
		},
		success: function() {
			touchJS( '#commentform textarea' ).removeClass( 'loading' ).addClass( 'success' );			
			alert( WPtouch.comment_success );
			setTimeout( function () { 
				touchJS( '#commentform textarea' ).removeClass( 'success' );
			}, 1500 );
//			touchJS( 'ol.commentlist' ).load( postURL + ' ol.commentlist > li', function(){ 
//				comReplyArrows();
//			});
		},
		error: function() {
			touchJS( '#commentform textarea' ).removeClass( 'loading' ).addClass( 'error' );
			alert( WPtouch.comment_failure );
			setTimeout( function () { 
				touchJS( '#commentform textarea' ).removeClass( 'error' );
			}, 3000 );
		},
		resetForm: true,
		timeout:   10000
	} 	//end options
	
	if ( touchJS.isFunction( touchJS.fn.ajaxForm ) ) {
		touchJS( '#commentform' ).ajaxForm( CommentFormOptions );
	}

	loadMoreEntries();
	loadMoreComments();
	comReplyArrows();
	classicExcerptToggle();
	welcomeMessage();
	webAppLinks();
	webAppOnly();
	
	touchJS( 'a.login-req, a.comment-reply-login' ).bind( 'click', function() {
		touchJS( 'a#header-menu-toggle, a#tab-login' ).click();
		scrollTo( 0,0,1 );
		return false;
	});
			
	/* Hide addressBar */
	if ( touchJS( 'body' ).hasClass( 'hide-addressbar' ) ) {
		touchJS( window ).load( function() {
		    setTimeout( function(){ scrollTo( 0, 0 ) }, 1 );
		});
	}
	
	/*Single post Back to Top */
	touchJS( 'a.back-to-top' ).click( function(){
	    touchJS( 'body' ).animate( { scrollTop: touchJS( 'html' ).offset().top }, 750 );		
		return false;
	});
	
	/*Single postSkip to Comments */
	touchJS( 'a.middle-link' ).click( function(){
	    touchJS( 'body' ).animate( { scrollTop: touchJS( '.nav-bottom' ).offset().top }, 750 );		
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

	/* Set tabindex automagically */
	touchJS( function(){
	var tabindex = 1;
		touchJS( 'input, select, textarea' ).each( function() {
			if ( this.type != "hidden" ) {
				var inputToTab = touchJS( this );
				inputToTab.attr( 'tabindex', tabindex );
				tabindex++;
			}
		});
	});
	
	/* New Toggle Switch JS */
	var onLabel = WPtouch.toggle_on, offLabel = WPtouch.toggle_off;
	touchJS( '.on' ).text( onLabel );
	touchJS( '.off' ).text( offLabel );
	
	touchJS( '#switch div' ).bind( touchEndOrClick, function(){ 
		var switchURL = touchJS( this ).attr( 'title' );
		touchJS( '.on' ).toggleClass( 'active' );
		touchJS( '.off' ).toggleClass( 'active' );
		setTimeout( function () { window.location = switchURL }, 500 );
		return false;
	});

	classicHandleShortcodes();
}
/* End Document Ready */

function classicTouchMove( e ){
	e.preventDefault();
}

/* New jQuery function opacityToggle() */
touchJS.fn.opacityToggle = function( speed, easing, callback ) { 
	return this.animate( { opacity: 'toggle' }, speed, easing, callback ); 
}

/* New jQuery function viewportCenter() */
jQuery.fn.viewportCenter = function() {
    this.css( 'position', 'absolute' );
    this.css( 'top', ( ( touchJS( window ).height() - this.outerHeight() ) / 3 ) + touchJS( window ).scrollTop() + 'px' );
    this.css( 'left', ( ( touchJS( window ).width() - this.outerWidth() ) / 2 ) + touchJS( window ).scrollLeft() + 'px' );
	this.show();
    return this;
}

function welcomeMessage() {
	if ( !WPtouchWebApp ) {	
		touchJS( '#welcome-message' ).show();
		touchJS( 'a#close-msg' ).bind( 'click', function() {
			WPtouchCreateCookie( 'wptouch_welcome', '1', 365 );
			touchJS( '#welcome-message' ).fadeOut( 350 );
			return false;
		});
	}
}

function webAppLinks() {
	if ( WPtouchWebApp ) {
		// The New Sauce ( Nobody makes tasty gravy like mom )		
		// bind to all links, except UI controls and such
		var webAppLinks = touchJS( 'a' ).not( 
			'.no-ajax, .email a, .feed a, a#header-menu-toggle, .has_children > a, a.load-more-link, .load-more-comments-link a, a#share-toggle, .GTTabs a' 
		);

 		webAppLinks.each( function(){
			var targetUrl = touchJS( this ).attr( 'href' ), targetLink = touchJS( this );
			var localDomain = location.protocol + '//' + location.hostname,  rootDomain = location.hostname.split( '.' ), masterDomain = rootDomain[1] + '.' + rootDomain[2];
//			var localDomain = location.hostname.match(/\.?([^.]+)\.[^.]+.?$/)[1];	
//			var localDomain = location.hostname;	
	
			// link is local, but set to be non-mobile
			if ( typeof wptouch_ignored_urls != 'undefined' ) {
				touchJS.each( wptouch_ignored_urls, function( i, val ) {
					if ( targetUrl.match( val ) ) {
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
						return false;
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
						/* Check to see if menu is showing */
						if ( touchJS( '#main-menu' ).hasClass( 'show-menu' ) ) {
							/* Menu is showing, so lets close it */
							touchJS( this ).opacityToggle( 380 );
							touchJS( 'a#header-menu-toggle' ).toggleClass( 'menu-toggle-open' );
						}
						loadPage( targetUrl ); 
						return false;
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

/* Load domain urls with Ajax (works with webAppLinks(); ) */
function loadPage( targetUrl ) {
	var persistenceOn = touchJS( 'body.loadsaved' ).length;
	if ( touchJS( 'body.ajax-on' ).length ) {
		touchJS( 'body' ).append( '<div id="progress"></div>' );
		touchJS( '#progress' ).viewportCenter();
		touchJS( document ).unbind();
		touchJS( '#outer-ajax' ).load( targetUrl + ' #inner-ajax', function( allDone ) {
			touchJS( '#progress' ).addClass( 'done' );
			if ( persistenceOn ) {
		  		WPtouchCreateCookie( 'wptouch-load-last-url', targetUrl, 365 );
			} else {
			  	WPtouchEraseCookie( 'wptouch-load-last-url' );	
			}
			doClassicReady();
			scrollTo( 0, 0, 100 );
		});
	} else {
		touchJS( 'body' ).append( '<div id="progress"></div>' );
		touchJS( '#progress' ).viewportCenter();
		if ( persistenceOn ) {
	  		WPtouchCreateCookie( 'wptouch-load-last-url', targetUrl, 365 );
		}
		setTimeout( function () { window.location = targetUrl; }, 550 );
	}
}

/* Things to do only when in Web-App Mode */
function webAppOnly() {
	if ( WPtouchWebApp ) {
		var persistenceOn = touchJS( 'body.loadsaved' ).length;
		if ( !persistenceOn ) {
			WPtouchEraseCookie( 'wptouch-load-last-url' );
		}
		touchJS( 'body' ).addClass( 'web-app' );
		touchJS( 'body.black-translucent' ).css( 'margin-top', '20px' );
		touchJS( 'a.comment-reply-link, a.comment-edit-link' ).remove();
		setTimeout( function () { touchJS( '#progress' ).remove(); }, 150 );
	}
}

function classicExcerptToggle() {
	touchJS( 'a.excerpt-button' ).live( 'click', function() {
		touchJS( this ).toggleClass( 'open' ).parent( '.post' ).find( '.content' ).opacityToggle( 380 );	
		return false;	
	});
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
	loadMoreLink.live( 'click', function() {
		touchJS( this ).addClass( 'ajax-spinner' ).text( WPtouch.loading_text );
		var loadMoreURL = touchJS( this ).attr( 'rel' );
		touchJS( '#content' ).append( "<div class='ajax-page-target'></div>" );
		touchJS( ajaxDiv ).hide().load( loadMoreURL + ' #content .post, #content .load-more-link', function() {
			touchJS( this ).replaceWith( touchJS( this ).html() );	
			touchJS( 'a.load-more-link.ajax-spinner' ).fadeOut( 350 );
			webAppLinks();
			touchJS( '.content' ).fitVids();
		});
		return false;
	});	
}

function loadMoreComments() {
	var loadMoreLink = touchJS( 'li.load-more-comments-link a' );
	var ajaxDiv = '.ajax-page-target';
	loadMoreLink.live( 'click', function() {
		touchJS( this ).addClass( 'ajax-spinner' );
		var loadMoreURL = touchJS( this ).attr( 'href' );
		touchJS( 'ol.commentlist' ).append( "<div class='ajax-page-target'></div>" );
		touchJS( ajaxDiv ).hide().load( loadMoreURL + ' ol.commentlist > li', function() {
			touchJS( this ).replaceWith( touchJS( this ).html() );	
			touchJS( '.load-more-comments-link a.ajax-spinner' ).parent().fadeOut( 350 );
			if ( WPtouchWebApp ) { 
				touchJS( 'a.comment-reply-link, a.comment-edit-link' ).remove();
				webAppLinks(); 
			}
		});
		return false;
	});	
}

function comReplyArrows() {
	var comReply = touchJS( 'ol.commentlist li li > .comment-top' );
	touchJS.each( comReply, function() {
		touchJS( comReply ).prepend( "<div class='com-down-arrow'></div>" );
	});
}

function WPtouchCreateCookie( name, value, days ) {
	if ( days ) {
		var date = new Date();
		date.setTime( date.getTime() + ( days*24*60*60*1000 ) );
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path="+WPtouch.siteurl;
}

function WPtouchEraseCookie( name ) {
	WPtouchCreateCookie( name,"",-1 );
}

touchJS( document ).ready( function() { doClassicReady(); } );