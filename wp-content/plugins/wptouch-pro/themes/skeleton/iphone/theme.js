/*
* WPtouch Pro Skeleton JS
* This file holds all the default jQuery & Ajax functions for the  theme
* Description: JavaScript for the  theme
* Expected jQuery version: 1.3.2
*/

var touchJS = jQuery.noConflict();

//Hide the addressbar on load
function hideAddressBar() {
	var webApp = window.navigator.standalone;
	if ( !webApp ) {
	// Get out of frames!
		if ( top.location!= self.location ) { top.location = self.location.href }
	// Hide addressBar
		window.addEventListener( 'load', function() {
		    setTimeout( scrollTo, 0, 0, 1 );
		}, false );
	} //Webapp
}

//-- touchJS --//

// New function fadeToggle()
touchJS.fn.fadeToggle = function( speed, easing, callback ) { 
	return this.animate( { opacity: 'toggle', height: 'toggle' }, speed, easing, callback ); 
}

// New function opacityToggle()
touchJS.fn.opacityToggle = function( speed, easing, callback ) { 
	return this.animate( { opacity: 'toggle' }, speed, easing, callback ); 
}

// New function loadingCentered()
touchJS.fn.viewportCenter = function() {
    this.css( 'position','absolute');
    this.css( 'top', ( touchJS( window ).height() - this.height() ) / 3 + touchJS( window ).scrollTop() + 'px' );
    this.css( 'left', ( touchJS( window ).width() - this.width() ) / 2 + touchJS( window ).scrollLeft() + 'px' );
    return this;
}

function webApp_Only() {
	var webApp = window.navigator.standalone;
	if ( webApp ) {		
		touchJS( '#switch' ).remove();
		touchJS( '#switch' ).remove();
		touchJS( '#welcome-message' ).remove();
		touchJS( 'a.comment-reply-link' ).remove();
		if ( touchJS( 'body.black-translucent' ).length ) {
			touchJS( 'body.black-translucent' ).css('margin-top', '20px');
		}
	}
}

// load domain urls with Ajax (works with hijackPostLinks(); )
function LoadPage( url ) {
	touchJS( 'body' ).append( '<div id="progress">Loading...</div>' );
	touchJS( '#progress' ).viewportCenter();
	touchJS( '#outer-ajax' ).load( url + ' #inner-ajax', function( allDone ) {
		touchJS('#progress').fadeOut(350);
		setTimeout( function() { 
			touchJS('#progress').remove();
		}, 1250 );		
		scrollTo( 0, 0 );
		doReady();
	} );
}

// Hijack links inside .content (posts, pages)
	// a) in Web-App Mode, ask users if they want to open a browser to view it (posts only)
	// b) in browser follow local links but open others in external windows (posts only)
function hijackPostLinks() {
	// Make the menu toggles not do AJAX in webapp mode
	touchJS( '#main-menu ul li.has_children > a, a.load-more-link' ).addClass( 'no-ajax' );
	
	// Menu workaround
	if ( window.navigator.standalone ) {
		touchJS( '#main-menu ul li a img' ).click( function() {
			touchJS( this ).parent().click();
			
			return false;
		});
	}

	var allExternalLinks = touchJS( 'a:not(.no-ajax)' );
	if ( allExternalLinks.length ) {    
	    allExternalLinks.unbind( 'click' ).click( function( e ) {
			var url = e.target.href;
			var isPhoneNumber = ( url.indexOf( 'tel:' ) >= 0 );
			var isEmail = ( url.indexOf( 'mailto:' ) >= 0 );
			var isUnsupportedFile = ( 
				url.lastIndexOf( '.pdf' ) >= 0 || url.lastIndexOf( '.xls' ) >= 0 || url.lastIndexOf( '.numbers' ) >= 0 || url.lastIndexOf( '.pages' ) >= 0 || 
				url.lastIndexOf( '.mp3' ) >= 0 || url.lastIndexOf( '.mp4' ) >= 0 || url.lastIndexOf( '.m4v' ) >= 0 || url.lastIndexOf( '.mov' ) >= 0
			);

	        var localDomain = document.domain;
	        var webApp = window.navigator.standalone;

	      	/* Check for phone numbers, email addresses, unsupported file types */
	      	if ( isPhoneNumber || isEmail || isUnsupportedFile ) {
	      		return true;	
	      	}
			
			if ( webApp ) {
				if ( touchJS( this ).hasClass( 'comment-reply-link' ) ) {
					return true;	
				}
								
				var actualLink = touchJS( this ).attr( 'href' );
				if ( actualLink[0] == '#' ) {
					return true;
				}							

				if ( url.match( localDomain ) && !touchJS( this ).parent().hasClass( 'email' ) ) {
					// Check to see if menu is showing
					if ( touchJS( '#main-menu' ).hasClass( 'show-menu' ) ) {
						// menu is showing, so lets collapse it	
						touchJS( 'a#header-menu-toggle' ).click();
					}				
					
					LoadPage( url );	
					return false;
				} else {
					if ( touchJS( this ).parent().hasClass( 'email' ) ) {
						return true;	
					}
					
			       	var answer = confirm( "External Link \n Open in browser?" );
					if ( answer ) {
						return true;
					} else {
						return false;
					}
				}
			} else {
				if ( touchJS( this ).parent().hasClass( 'email' ) ) {
					touchJS( '#main-menu' ).opacityToggle( 0 );
					touchJS( '#main-menu' ).toggleClass( 'show-menu' );
					touchJS( 'a#header-menu-toggle' ).toggleClass( 'menu-toggle-open' );
				}				
				
				if ( url.match( localDomain ) || touchJS( this ).parent().hasClass( 'email' ) ) {
	        		return true;
		    	} else {
		    		window.open( url );
		    		return false;
	    		}
			}
	    });
	}
}

function SetupLoadMore() {
	var loadMoreLink = touchJS( 'a.load-more-link' );
	if ( loadMoreLink.length ) {
		loadMoreLink.unbind( 'click' ).click( function() {
			touchJS( this ).addClass( 'ajax-spinner' );
			var loadMoreURL = touchJS( this ).attr( 'rel' );
			touchJS( '#content' ).append( "<div class='ajax-page-target'></div>" );
			touchJS( 'div.ajax-page-target' ).hide().load( loadMoreURL + ' #content .post,#content .load-more-link', function() {
				touchJS( 'div.ajax-page-target' ).replaceWith( touchJS( 'div.ajax-page-target' ).html() );				
				setTimeout( function() { loadMoreLink.fadeOut( 500 ); }, 500 );
				
				SetupLoadMore();
				hijackPostLinks();	
			});
			return false;
		});	
	}	
}

function loadMoreComments() {
	var loadMoreLink = touchJS( 'ol.commentlist li.load-more-comments-link a' );
	if ( loadMoreLink.length ) {
		loadMoreLink.unbind( 'click' ).click( function() {
			touchJS( this ).addClass( 'ajax-spinner' );
			var loadMoreURL = touchJS( this ).attr( 'href' );
			touchJS( 'ol.commentlist' ).append( "<div class='ajax-page-target'></div>" );
			touchJS( 'div.ajax-page-target' ).hide().load( loadMoreURL + ' ol.commentlist > li', function() {
				touchJS( 'div.ajax-page-target' ).replaceWith( touchJS( 'div.ajax-page-target' ).html() );				
				setTimeout( function() { loadMoreLink.fadeOut( 350 ); }, 500 );
 				webApp_Only();
				loadMoreComments();
			});
			return false;
		});	
	}	
}

//-- Document Ready Functions --//
 
function doReady() {	

	// Tweak touchJS Timer for iPhone, mobile devices
	touchJS.timerId = setInterval( function(){
		var timers = touchJS.timers;
		for ( var i = 0; i < timers.length; i++ ) {
			if ( !timers[i]() ) {
				timers.splice( i--, 1 );
			}
		}
		if ( !timers.length ) {
			clearInterval( touchJS.timerId );
			touchJS.timerId = null;
		}
	}, 83 );	
		
	// If Prowl Message Sent
	if ( touchJS( '#prowl-message' ).length ) {
		setTimeout( function() { touchJS( '#prowl-message' ).fadeOut( 350 ); }, 5000 );
	}
	
	// Add a rounded top left corner to the first gravatar in comments, remove double border
	if ( touchJS( '.commentlist' ).length ) {
		touchJS( '.commentlist li.parent:first' ).addClass( 'first' );
		touchJS( '.commentlist img.avatar:first' ).addClass( 'first' );
	}
		
	// Header #tab-bar tabs
	touchJS( function () {
	    var tabContainers = touchJS( '#menu-container > div' );
	     var loginTab = touchJS( '#menu-tab5' );
	
	    touchJS( '#tab-inner-wrap-left a' ).unbind( 'click' ).click( function () {
	        tabContainers.hide().filter( this.hash ).opacityToggle( 450 );
	    	touchJS( '#tab-inner-wrap-left a' ).removeClass( 'selected' );
	   		touchJS( this ).addClass( 'selected' );
	   		if ( loginTab ) {
	   			touchJS( 'input#log' ).focus();
	   		} else {
	   			touchJS( 'input#log' ).blur();   		
	   		}
	        return false;
	    }).filter( ':first' ).click();
	});
		
			
	// Header Menu Toggle (toggle button animation and menu showing)
	touchJS( 'a#header-menu-toggle' ).unbind( 'click' ).click( function() {
		touchJS( '#main-menu' ).opacityToggle( 450 );
		touchJS( '#main-menu' ).toggleClass( 'show-menu' );
		touchJS( this ).toggleClass( 'menu-toggle-open' );
		return false;
	});	
	
	// Toggling the search bar from within the menu
	touchJS( 'a#tab-search' ).unbind( 'click' ).click( function() {
		
		touchJS( '#search-bar' ).toggleClass( 'show-search' );
		touchJS( this ).toggleClass( 'search-toggle-open' );
		
		if ( touchJS( '#search-bar' ).hasClass( 'show-search' ) ) {
			touchJS( 'input#search-input' ).focus();
		} else{
			touchJS( 'input#search-input' ).blur();		
		}
		return false;
	});	

	//Filter parent link href's and make them toggles for their children 
	touchJS( '#main-menu' ).find( 'li.has_children ul' ).hide();
	
	touchJS( '#main-menu ul li.has_children > a' ).unbind( 'click' ).click( function() {
		touchJS( this ).parent().children( 'ul' ).opacityToggle( 350 );
		touchJS( this ).toggleClass( 'arrow-toggle' );
		touchJS( this ).parent().toggleClass( 'open-tree' );
		return false;
	});
	
	hideAddressBar();
	webApp_Only();
	hijackPostLinks();
	SetupLoadMore();	
	loadMoreComments();

} // End Document Ready Functions

touchJS( document ).ready( function() { doReady(); } );