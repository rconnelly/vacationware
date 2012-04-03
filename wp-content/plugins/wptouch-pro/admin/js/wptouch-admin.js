/* WPtouch Pro Admin JS */

/* ZeroClipboard backup key */
var wptouchClip = 0;

/* Start onReady */
function WPtouchProAdminReady() {	

/* Disable caching of AJAX responses */
	jQuery.ajaxSetup ({
	    cache: false
	});
	
/* General Admin Functions */
	WPtouchCookieSetup();
	WPtouchSetupTabSwitching();
	WPtouchTooltipSetup();
	WPtouchLoadRSS();
	WPtouchSetupLicenseArea();
	WPtouchSetupPluginCompat();
	WPtouchCheckApiServer();
	WPtouchSetupPluginDismiss();
	WPtouchSavedOrResetNotice();
	WPtouchLicenseFeedback();

/* Select & Checkbox toggles */
	WPtouchSetupSelects();
	WPtouchCheckToggle( '#classic_show_attached_image', '#setting_classic_show_attached_image_location' );
	WPtouchCheckToggle( '#enable_home_page_redirect', '.type-redirect' );
	WPtouchCheckToggle( 'input#classic_webapp_enabled', '.section-web-app-settings' );
	WPtouchCheckToggle( '#show_switch_link', '#setting_home_page_redirect_address, #setting_desktop_switch_css' );
	WPtouchCheckToggle( '#debug_log', '#setting_debug_log_level' );
	WPtouchCheckToggle( '#classic_show_webapp_notice', '#setting_classic_add2home_msg' );
	WPtouchCheckToggle( '#classic_webapp_use_loading_img', '#setting_classic_webapp_loading_img_location, #setting_classic_ipad_webapp_loading_img_location, #setting_webapp-copytext-info, #setting_classic_webapp_retina_loading_img_location, #setting_classic_ipad_webapp_landscape_loading_img_location' );
	WPtouchCheckToggle( '#menu_show_rss', '#setting_menu_custom_rss_url' );
	WPtouchCheckToggle( '#menu_show_email', '#setting_menu_custom_email_address' );
	WPtouchCheckToggle( '#cache_menu_tree', '#setting_cache_time' );
	WPtouchCheckToggle( '#wptouch_enable_custom_post_types', '#setting_wptouch_show_custom_post_taxonomy, #setting_wptouch_show_custom_post_taxonomy_on_blog, #setting_wptouch_show_custom_post_type_tweet' );

	/* Theme Browser Functions */
	WPtouchSetupActivateThemes();
	WPtouchSetupCopyThemes();
	WPtouchSetupDeleteThemes();

	/* Make the theme browser and WPtouchboard boxes the same height */
	jQuery( '#touchboard .box-holder' ).equalHeights( 285 , 400 );

	/* Add a shake for unlicensed folks to remind them */
	jQuery( '#unlicensed-board' ).shake( 4, 5, 750 );
	
	/* Code for colorpicker.com window */
	jQuery( 'a#color-picker' ).live( 'click', function( e ) {
		NewWindow( this.href, 'av', '530', '530', 'no', 'no' );
		e.preventDefault();
	}); 

	// Ajax routines
	var ajaxRequests = 0;
	jQuery( 'div.admin-ajax' ).each( function() {
		var divTitle = jQuery( this ).attr( "title" );
		var divId = jQuery( this ).attr( "id" );
		
		if ( ajaxRequests == 0 ) {
			WPtouchAjaxOn();
		}
		
		ajaxRequests++;

		WPtouchAdminAjax( divTitle, {}, function( data ) {
			jQuery( '#' + divId ).html( data );
			
			ajaxRequests--;
			
			if ( ajaxRequests == 0 ) {
				//WPtouchSetupAjax();
			}	
		});
		
	});

	/* Show saving div when form submit, for some postive feedback */
	jQuery( '#bnc-submit' ).live( 'click', function() {
		jQuery( '#saving-ajax' ).fadeIn( 200 );
	});

	/* Reset confirmation */
	jQuery( '#bnc-submit-reset input' ).click( function() {
		var answer = confirm( WPtouchCustom.reset_admin_settings );
		if ( answer ) {
			jQuery.cookie( 'wptouch-tab', '' );
			jQuery.cookie( 'wptouch-list', '' );
		} else {
			return false;	
		}
	});
	
	jQuery( '#bnc-form' ).live( 'click', function() {			
			var totalItems = '';
			var uncheckedMenuItems = jQuery( 'ul.icon-menu li input.checkbox:not(:checked)' );
			jQuery.each( uncheckedMenuItems, function( i, e ) {
				var menuItemTitle = jQuery( e ).attr( 'title' );
				totalItems = totalItems + menuItemTitle + ",";
			});
			
			jQuery( 'input#hidden-menu-items' ).attr( 'value', totalItems );
			return true;
	});
	
	/*  Page Menu Tabs */
	jQuery( function() {
	    var pageTabDivs = jQuery( '#page-tab-container div.menu-tab-div' );
		jQuery( '#menu-select li a' ).live( 'click', function( e ) {
			pageTabDivs.hide().filter( this.hash ).show();
			jQuery( '#menu-select li a' ).removeClass( 'active' );
			jQuery( this ).addClass( 'active' );
			e.preventDefault();
		}).filter( ':first' ).click();
	});
	
	if ( jQuery( '#wptouch-icon-list' ).length ) {
		WPtouchSetupIconDragDrag();
		
		var wptouchMenuOpen = false;
		
		jQuery( 'a.expand' ).live( 'click', function( e ) {
			var parentListItem = jQuery( this ).parent( 'li' );
			if ( parentListItem.length ) {
				
				if ( parentListItem.hasClass( 'open' ) ) {
					if ( wptouchMenuOpen ) {
						jQuery( 'li.open' ).removeClass( 'open' );
						wptouchMenuOpen = false;
						jQuery( '#wptouch-icon-menu ul ul' ).slideUp( 250 );
					}
				} else {
					if ( wptouchMenuOpen ) {
						jQuery( '#wptouch-icon-menu ul ul' ).slideUp( 250 );
						jQuery( 'li.open' ).removeClass( 'open' );
					}
					
					var delay = 400;
					if ( !wptouchMenuOpen ) {
						delay = 0;
					}
					
					setTimeout( function() {
						parentListItem.find( 'ul' ).slideDown( 250 );
						parentListItem.addClass( 'open' );
						wptouchMenuOpen = true;
					}, delay );
				}
			}
			e.preventDefault();
		});
		
		jQuery( '#active-icon-set' ).change( function() {
			var selectItem = jQuery( this );
			jQuery( '#wptouch-icon-list' ).animate( { opacity: 0.4 }, 250 );
			
			var ajaxParams = {
				set: selectItem.val()
			};
			
			WPtouchAdminAjax( 'update-icon-pack', ajaxParams, function( result ) {
				setTimeout( function() { 
					jQuery( '#wptouch-icon-list' ).html( result ).animate( { opacity: 1 }, 250 );
					WPtouchSetupIconDragDrag();
				}, 250 );
			});	
		});

		jQuery( '#active-icon-set' ).change();
		
		jQuery( 'a#reset-menu-all' ).click( function() { 
			var answer = confirm( WPtouchCustom.reset_icon_menu_settings );
			
			if ( answer ) {
				WPtouchAdminAjax( 'reset-menu-icons', {}, function( result ) {
					// Reset the default menu icon
					jQuery( '#bnc-form' ).submit();
				});
				return false;
			} else {
				return false;			
			}
		});

		jQuery( 'a#pages-check-all' ).live( 'click', function( e ) { 
			jQuery( 'ul.icon-menu input:checkbox:not(:checked)' ).attr( 'checked', true );
			e.preventDefault();
		});

		jQuery( 'a#pages-check-none' ).live( 'click', function( e ) { 
			jQuery( 'ul.icon-menu input:checkbox' ).attr( 'checked', false );
			e.preventDefault();
		});
		
		jQuery( 'ul.icon-menu input.checkbox' ).change( function() {
			switch( jQuery( this ).prop() ) {
				case 'checked':
					jQuery( this ).parent( 'li' ).find( '.checkbox' ).attr( 'checked', 'checked' );
					WPtouchDoTreeDisable();
					break;	
				default:
					jQuery( this ).parent( 'li' ).find( '.checkbox' ).removeAttr( 'checked' );
					WPtouchDoTreeDisable();
					break;	
			}
		});
		
//		WPtouchDoTreeDisable();
	}
	
	/* The manage sets page */
	if ( jQuery( '#manage-sets' ).length ) { 
		jQuery( '#manage-icon-set-area li a' ).live( 'click', function() {
			var iconSetName = jQuery( this ).attr( 'title' );
			var clickedLink = jQuery( this );

			jQuery( '#manage-icon-set-area li' ).removeClass( 'active' );
			jQuery( this ).parent().addClass( 'active' );

			jQuery( '#manage-icon-ajax' ).animate( { opacity: 0.4 }, 250 );

			var ajaxParams = {
				area: 'manage',
				set: iconSetName	
			};
			
			WPtouchAdminAjax( 'update-icon-pack', ajaxParams, function( result ) {
				setTimeout( function() { 
					jQuery( '#manage-icon-ajax' ).html( result ).animate( { opacity: 1 }, 250 );
											
						jQuery( 'a.delete-icon' ).unbind( 'click' ).bind( 'click', function() {
							var deleteLink = jQuery( this );
							var linkOffset = jQuery( this ).offset();
				
							jQuery( '#bnc .poof' ).css( {
								left: linkOffset.left + 14 + 'px',
								top: linkOffset.top + 10 + 'px'
							}).show();

							WPtouchAnimatePoof();

							var iconFile = jQuery( this ).parent().find( 'img' ).attr( 'src' );
							
							var ajaxParams = {
								area: 'manage',
								icon: iconFile
							};
							
							WPtouchAdminAjax( 'delete-icon', ajaxParams, function( result ) {
								var currentIcons = jQuery( '#manage-icon-ajax li' );
								if ( currentIcons.size() == 1 ) {
									jQuery( '#manage-icon-set-area li:first a' ).click();
								}
							});							
							
							jQuery( this ).parent().fadeOut( 400 );			
							return false;
						});
																	
						if ( clickedLink.parent().hasClass( 'dark' ) ) {
							jQuery( '#pool-color-switch a.dark' ).click();
						} else {
							jQuery( '#pool-color-switch a.light' ).click();
						}
						
						jQuery( 'a.delete-set' ).unbind( 'click' ).click( function() {
							// We're going to delete a set here
							var iconSetName = jQuery( this ).parent().parent().find( 'em' ).html();
							if ( confirm( WPtouchCustom.are_you_sure_set ) ) {

								var ajaxParams = {
									area: 'manage',
									set: iconSetName
								};
								
								WPtouchAdminAjax( 'delete-icon-pack', ajaxParams, function( result ) {								
									jQuery( '#bnc-form' ).submit();	
								});
							}
							return false;
						});
						
					}, 250 );	

			});			
			return false;
		});
		
		jQuery( '#pool-color-switch a' ).live( 'click', function( e ) {
			jQuery( '#manage-icon-area' ).removeClass( 'light' ).removeClass( 'dark' );
			jQuery( '#pool-color-switch a' ).removeClass( 'active' );
			
			if ( jQuery( this ).hasClass( 'light' ) ) {
				// user clicked light
				jQuery( '#manage-icon-area' ).addClass( 'light' );	
			} else {
				// user clicked dark
				jQuery( '#manage-icon-area' ).addClass( 'dark' );
			}
			
			jQuery( this ).addClass( 'active' );			
			e.preventDefault();
		});
		
		/* Icon Upload goods */
		new AjaxUpload( 'manage-upload-button', {
			action: ajaxurl,
			data: {
				action: 'wptouch_ajax',
				wptouch_action: 'manage-upload',
				wptouch_nonce: WPtouchCustom.admin_nonce
			},
			autoSubmit: true,
			onSubmit: function( file, extension ) {
				jQuery( '#manage-set-upload-name' ).html( file ).show();
				WPtouchDoManageStatus( WPtouchCustom.upload_header, WPtouchCustom.upload_status, false, 'success' );
			},
			onComplete: function( file, response ) {
				if ( response == 'invalid' ) {
						WPtouchDoManageStatus( WPtouchCustom.upload_invalid_header, WPtouchCustom.upload_invalid_status, true, 'failure' );
				} else if ( response == 'icon-done' ) {
					// move this into its own function					
					setTimeout( function() {
							WPtouchDoManageStatus( WPtouchCustom.upload_done_header, WPtouchCustom.upload_done_icon_status, true, 'success' );		
							jQuery( '#manage-icon-set-area #icon-set-list li a:last' ).click();
					}, 250 );					
				} else if ( response == 'zip' ) {				
					WPtouchDoManageStatus( WPtouchCustom.upload_unzip_header, WPtouchCustom.upload_unzip_status, false, 'success' );
					WPtouchAdminAjax( 'manage-unzip-set', {}, function( result ) {
						if ( result == 'done' ) {
							setTimeout( 
								function() {								
									WPtouchDoManageStatus( WPtouchCustom.upload_done_header, WPtouchCustom.upload_done_set_status, true, 'success' );
									jQuery( '#bnc-form' ).submit();
							}, 250 );	
						} else if ( result == 'create-readme' ) {
							setTimeout( 
								function() {								
									WPtouchDoManageStatus( WPtouchCustom.upload_done_header, WPtouchCustom.upload_describe_set, true, 'success' );
									jQuery( '#wptouch-set-input-area' ).fadeIn();
							}, 250 );					
						} else {
							alert( 'Unknown error. Please contact support.' );	
						}
					});
				} else {
					setTimeout( function() {
							WPtouchDoManageStatus( WPtouchCustom.upload_processing_header, WPtouchCustom.upload_processing_status, false, 'success' );	
					}, 250 );
					setTimeout( function() {
						WPtouchDoManageStatus( WPtouchCustom.upload_done_header, WPtouchCustom.upload_done_status, true, 'success' ); 
					}, 500 ); 
				}
			}

		});
		
		jQuery( '#manage-icon-set-area li:first a' ).click();
		jQuery( '#pool-color-switch a:first' ).click();
	}
	
	var manageLicense = jQuery( '#wptouch-license-area' );
	if ( manageLicense.length ) {
		
		WPtouchAdminAjax( 'profile', {}, function( result ) { 
			jQuery( '#wptouch-license-area' ).html( result );
			WPtouchSetupLicenseArea();
		});
	}
	
	var wptouchboardAjax = jQuery( '#touchboard-ajax' );
	if ( wptouchboardAjax.length ) {
		WPtouchAdminAjax( 'license-info', {}, function( result ) { 
			wptouchboardAjax.html( result );
		});		
	}

	var licensesRemaining = jQuery( '#wptouch-licenses-remaining' );
	if ( licensesRemaining.length ) {
		WPtouchAdminAjax( 'licenses-left', {}, function( result ) { 
			licensesRemaining.hide().html( result ); 
			WPtouchSetupTabSwitching(); 
			licensesRemaining.fadeIn( 200 );
			jQuery( '#right-now-box img.ajax-loader' ).remove();
		});		
	}
		
	// For handling forum postings
	var newForumPostSubmit = jQuery( '#support-form-submit' );
	if ( newForumPostSubmit.length ) {
		newForumPostSubmit.click( function() {
			var postTitle = jQuery( '#forum-post-title' ).val();
			if ( postTitle ) {
				var postTags = jQuery( '#forum-post-tag' ).val();
				if ( postTags ) {
					var postDesc = jQuery( '#forum-post-content' ).val();
					if ( postDesc ) {
						jQuery( '#support-form-inside' ).animate( { opacity: 0.5 } );
						
						var ajaxParams = {
							title: postTitle,
							tags: postTags,
							desc: postDesc	
						};
						
						// Ajax routine
						WPtouchAdminAjax( 'support-posting', ajaxParams, function( result ) {				
							if ( result == "ok" ) {
								alert( WPtouchCustom.forum_topic_success );
								
								jQuery( '#forum-post-title, #forum-post-tag, #forum-post-content' ).val( '' );
								
								wptouchLoadSupportPosts();
							} else {
								alert( WPtouchCustom.forum_topic_failed );	
							}
							
							jQuery( '#support-form-inside' ).animate( { opacity: 1.0 } );
						});
					} else {
						alert( WPtouchCustom.forum_topic_text );	
					}
				} else {
					alert( WPtouchCustom.forum_topic_tags );	
				}
			} else {
				alert( WPtouchCustom.forum_topic_title );	
			}
			return false;
		});	
	}
	
	/* Add style colors to input for visual feedback */
	jQuery( '.section-body-style-settings input.text' ).each( function() {
		var inputColor = '#' + jQuery( this ).val();
		jQuery( this ).css( 'color', inputColor ).css( 'border-color', inputColor );
		jQuery( this ).parent().find( 'label' ).css( 'color', inputColor );
	});

	/* Remove Client Mode options for non-developers */
	if ( jQuery( '#wptouch-tabbed-area.developer' ).length == 0 ) {
		jQuery( '.section-clientmode' ).remove();
	}

}
/* End onReady */

/* Function to make it easy to add checkbox element toggles */
function WPtouchCheckToggle( checkBox, toggleElement ) {
	jQuery( checkBox ).change( function() {
		if ( jQuery( checkBox ).attr( 'checked' ) ) {
			jQuery( toggleElement ).slideDown();	
		} else {
			jQuery( toggleElement ).hide();
		}
	});	
	jQuery( checkBox ).change();
}

/* Function to take care of select switches */
function WPtouchSetupSelects() {

	jQuery( '#developer_mode' ).change( function() {
		var fadeDiv = jQuery( '#setting_developer_mode_device_class' ).get( 0 );
		switch( jQuery( this ).val() ) {
			case 'off':
				jQuery( fadeDiv ).hide();
				break;	
			default:
				jQuery( fadeDiv ).slideDown();
				break;
		}
	}).change();
	
	jQuery( '#custom_menu_name' ).change( function() {
		var fadeDiv = jQuery( '#setting_menu_sort_order' ).get( 0 );
		switch( jQuery( this ).val() ) {
			case 'none':
				jQuery( fadeDiv ).slideDown();
				break;	
			default:
				jQuery( fadeDiv ).hide();
				break;
		}
	}).change();
	
	jQuery( '#home_page_redirect_target' ).change( function() {
		var fadeDiv = jQuery( '#setting_home_page_redirect_custom' ).get( 0 );
		switch( jQuery( this ).val() ) {
			case 'custom':
				jQuery( fadeDiv ).slideDown();
				break;	
			default:
				jQuery( fadeDiv ).hide();
				break;
		}
	}).change();
	
	jQuery( '#advertising_type' ).change( function() {
		var googleDiv = '#setting_adsense_id,#setting_adsense_channel';
		var admobDiv = '#setting_admob_publisher_id';
		var custDiv = '#setting_custom_advertising_code';
		var displayDiv = '#setting_ad-display';

		switch( jQuery( this ).val() ) {
			case 'none':
				jQuery( googleDiv + ',' + admobDiv + ',' + custDiv ).hide();
				
				if ( jQuery( '#ipad_advertising_type' ).val() == 'none' ) {
					jQuery( displayDiv ).hide();
				}				
				break;
			case 'google':
				jQuery( googleDiv + ',' + displayDiv ).slideDown();
				jQuery( admobDiv + ',' + custDiv ).hide();
				break;
			case 'admob':
				jQuery( admobDiv + ',' + displayDiv ).slideDown();
				jQuery( googleDiv + ',' + custDiv ).hide();
				break;
			case 'custom':
				jQuery( googleDiv + ',' + admobDiv  ).hide();
				jQuery( custDiv + ',' + displayDiv ).slideDown();
				break;
		}
	}).change();
	
	jQuery( '#ipad_advertising_type' ).change( function() {
		var custDiv = '#setting_custom_ipad_advertising_code';
		var displayDiv = '#setting_ad-display';
				
		switch( jQuery( '#ipad_advertising_type' ).val() ) {
			case 'none':
				jQuery( custDiv  ).hide();
				
				if ( jQuery( this ).val() == 'none' ) {
					jQuery( displayDiv ).hide();
				}
				break;
			case 'custom':
				jQuery( custDiv + ',' + displayDiv ).slideDown();
				break;
		}		
	}).change();	

	jQuery( '#classic_calendar_icon_bg' ).change( function() {
		switch( jQuery( this ).val() ) {
			case 'cal-custom':
				jQuery( '#setting_classic_custom_cal_icon_color' ).slideDown();
				break;	
			default:
				jQuery( '#setting_classic_custom_cal_icon_color' ).hide();
				break;
		}
	}).change();
	
	jQuery( '#classic_icon_type' ).change( function() {
		var ThumbDiv = '.section-thumbnail-icon-options';
		var customThumbDiv = '#setting_classic_custom_field_thumbnail_name';
		var calDiv = '.section-calendar-icon-options';
	
		switch( jQuery( this ).val() ) {
			case 'calendar':
				jQuery( calDiv ).slideDown();
				jQuery( ThumbDiv + ', ' + customThumbDiv ).hide();
				break;	
			case 'thumbnails':
				jQuery( ThumbDiv ).slideDown();
				jQuery( calDiv + ', ' + customThumbDiv ).hide();
				break;	
			case 'custom_thumbs':
				jQuery( ThumbDiv + ', ' + customThumbDiv ).slideDown();
				jQuery( calDiv ).hide();
				break;	
			case 'none':
				jQuery( calDiv + ', ' + ThumbDiv + ', ' + customThumbDiv ).hide();
				break;
		}
	}).change();

	jQuery( '#ipad_support' ).change( function() {
		var ipadDivs = '.section-ipad-style-settings, #setting_ipad-menubar-settings';
		switch( jQuery( this ).val() ) {
			case 'none':
				jQuery( ipadDivs ).hide();
				break;	
			default:
				jQuery( ipadDivs ).slideDown();
				break;
		}
	}).change();
	
	jQuery( '#classic_ipad_content_bg' ).change( function() {
		switch( jQuery( this ).val() ) {
			case 'custom':
				jQuery( '#setting_classic_ipad_content_bg_custom, #setting_classic_ipad_background_repeat' ).slideDown();
				break;	
			default:
				jQuery( '#setting_classic_ipad_content_bg_custom, #setting_classic_ipad_background_repeat' ).hide();
				break;
		}
	}).change();
	
	jQuery( '#classic_ipad_sidebar_bg' ).change( function() {
		switch( jQuery( this ).val() ) {
			case 'custom':
				jQuery( '#setting_classic_ipad_sidebar_bg_custom' ).slideDown();
				break;	
			default:
				jQuery( '#setting_classic_ipad_sidebar_bg_custom' ).hide();
				break;
		}
	}).change();
	
	jQuery( '.section-body-style-settings input.text, #setting_ipad-style-settings input.text' ).change( function() {
		var inputColor = '#' + jQuery( this ).val();
		jQuery( this ).css( 'color', inputColor ).css( 'border-color', inputColor );
		jQuery( this ).parent().find( 'label' ).css( 'color', inputColor );
	}).change();
	
	jQuery( '#backup_or_restore' ).change( function() {
		switch( jQuery( this ).val() ) {
			case 'backup':
				jQuery( '#setting_import' ).hide();
				jQuery( '#setting_backup' ).slideDown();			
				WPtouchHandleBackupClipboard();
				break;	
			case 'restore':
				jQuery( '#setting_backup' ).hide();
				jQuery( '#setting_import' ).slideDown();	
				break;	
		}
	}).change();
}

function WPtouchSetupPluginDismiss() {
	var dismissButtons = jQuery( 'a.dismiss-button' );
	if ( dismissButtons.length > 0 ) {
		dismissButtons.live( 'click', function() {
			
			var linkOffset = jQuery( this ).offset();
			jQuery( '#bnc .poof' ).css({
				left: linkOffset.left + 14 + 'px',
				top: linkOffset.top - 5 + 'px'
			}).show();

			WPtouchAnimatePoof();
			
			jQuery( this ).parent().parent().fadeOut( 250 );
						
			var ajaxParams = {
				plugin: jQuery( this ).attr( 'id' )
			};
			
			WPtouchAdminAjax( 'dismiss-warning', ajaxParams, function( result ) {
				if ( result == '0' ) {
					jQuery( 'tr#board-warnings' ).remove();
				} else {
					jQuery( 'tr#board-warnings td.box-table-number' ).html( result );	
				}			
				
				jQuery( '#setting_warnings-and-conflicts' ).load( 
					WPtouchCustom.plugin_url + ' #setting_warnings-and-conflicts fieldset', 
					function() {						
						WPtouchSetupPluginDismiss();
					}
				);
			});					
			
		e.preventDefault();
		});	
	}
}

function WPtouchCookieSetup() {
	/* Top menu tabs */
	jQuery( '#wptouch-top-menu li a' ).live( 'click', function( e ) {
		var tabId = jQuery( this ).attr( "id" );
		
		jQuery.cookie( 'wptouch-tab', tabId );
		
		jQuery( '.pane-content' ).hide();
		jQuery( '#pane-content-' + tabId ).show();
		
		jQuery( '#pane-content-' + tabId + ' .left-area li a:first' ).click();
		
		jQuery( '#wptouch-top-menu li a' ).removeClass( 'active' );
		jQuery( '#wptouch-top-menu li a' ).removeClass( 'round-top-6' );
		
		jQuery( this ).addClass( 'active' ).addClass( 'round-top-6' );

		e.preventDefault();
	});

	/* Left menu tabs */
	jQuery( '#wptouch-admin-form .left-area li a' ).live( 'click', function( e ) {
		var relAttr = jQuery( this ).attr( "rel" );
		
		jQuery.cookie( 'wptouch-list', relAttr );
		jQuery( ".setting-right-section" ).hide();
		jQuery( "#setting-" + relAttr ).show();
		jQuery( '#wptouch-admin-form .left-area li a' ).removeClass( 'active' );
		jQuery( this ).addClass( 'active' );
		
		if ( jQuery( this ).attr( 'id' ) == 'tab-section-backup-restore' ) {
			WPtouchHandleBackupClipboard();
			wptouchClip.show();
		} else {
			if ( wptouchClip ) {
				wptouchClip.hide();
			}
		}
		
		e.preventDefault();
	});
	
	/* Cookie saving for tabs */
	var tabCookie = jQuery.cookie( 'wptouch-tab' );
	if ( tabCookie ) {
		var tabLink = jQuery( "#wptouch-top-menu li a[id='" + tabCookie + "']" ); 
		jQuery( '.pane-content' ).hide();
		jQuery( '#pane-content-' + tabCookie ).show();	
		tabLink.addClass( 'active' ).addClass( 'round-top-6' );
		
		var listCookie = jQuery.cookie( 'wptouch-list' );
		if ( listCookie ) {
			var menuLink = jQuery( "#wptouch-admin-form .left-area li a[rel='" + listCookie + "']");
			jQuery( ".setting-right-section" ).hide();
			jQuery( "#setting-" + listCookie ).show();	
			jQuery( '#wptouch-admin-form .left-area li a' ).removeClass( 'active' );	
			menuLink.click();			
		} else {
			jQuery( "#wptouch-admin-form .left-area li a:first" ).click();
		}
	} else {
		jQuery( '#wptouch-top-menu li a:first' ).click();
	}	
}

function WPtouchReloadThemeArea() {
	jQuery( '#bnc-form' ).load( WPtouchCustom.plugin_url + ' #bnc', function( d ) {		
		jQuery( document ).unbind().die();
		WPtouchProAdminReady();		
		jQuery( '#pane-content-pane-2 .right-area' ).animate( { opacity: 1 } );
	});				
}

function WPtouchSetupActivateThemes() {	
	jQuery( 'a.activate-theme' ).live( 'click', function( e ) {
		jQuery( '#pane-content-pane-2 .right-area' ).animate( { opacity: .5 } );	
		jQuery( '#ajax-saving' ).fadeIn( 200 ); 
		
		var themeLocation = jQuery( this ).parents().find( 'input.theme-location' ).attr( 'value' );
		var themeName = jQuery( this ).parents().find( 'input.theme-name' ).attr( 'value' );
		
		var ajaxParams = {
			name: themeName,
			location: themeLocation
		};
		
		WPtouchAdminAjax( 'activate-theme', ajaxParams, function( result ) {
			setTimeout( function() {  
				jQuery( "#ajax-saving" ).hide();
				jQuery( "#ajax-saved" ).show();
			}, 1000);
			setTimeout( function() {  
				jQuery( '#ajax-saved' ).fadeOut( 200 );
				WPtouchReloadThemeArea();
			}, 2000 );
		});

		e.preventDefault();
	});	
}

function WPtouchSetupCopyThemes() {
	jQuery( 'a.copy-theme' ).live( 'click', function( e ) {
		jQuery( '#ajax-saving' ).fadeIn( 200 );	
		jQuery( '#pane-content-pane-2 .right-area' ).animate( { opacity: .5 } );
		var themeLocation = jQuery( this ).parents().find( 'input.theme-location' ).attr( 'value' );
		var themeName = jQuery( this ).parents().find( 'input.theme-name' ).attr( 'value' );
		
		var ajaxParams = {
			name: themeName,
			location: themeLocation	
		};

		WPtouchAdminAjax( 'copy-theme', ajaxParams, function( result ) {
			setTimeout( function() {
				jQuery( '#ajax-saving' ).hide();
				jQuery( '#ajax-saved' ).show().fadeOut( 200 );
				WPtouchReloadThemeArea();
			}, 200 );
		});

		e.preventDefault();
	});		
	
	jQuery( 'a.make-child-theme' ).live( 'click', function( e ) {
		jQuery( '#ajax-saving' ).fadeIn( 200 );	
		jQuery( '#pane-content-pane-2 .right-area' ).animate( { opacity: .5 } );
		
		var themeLocation = jQuery( this ).parents().find( 'input.theme-location' ).attr( 'value' );
		var themeName = jQuery( this ).parents().find( 'input.theme-name' ).attr( 'value' );
		
		var ajaxParams = {
			name: themeName,
			location: themeLocation	
		};

		WPtouchAdminAjax( 'make-child-theme', ajaxParams, function( result ) {
			setTimeout( function() {
				jQuery( '#ajax-saving' ).hide();
				jQuery( '#ajax-saved' ).show().fadeOut( 200 );
				WPtouchReloadThemeArea();
			}, 500 );
		});		
		
		e.preventDefault();
	});
}

function WPtouchSetupDeleteThemes() {
	jQuery( 'a.delete-theme' ).live( 'click', function( e ) {
		
		var answer = confirm( WPtouchCustom.are_you_sure_delete );
		if ( answer ) {

			// set the x and y offset of the poof animation <div> from cursor's position (in pixels)
			var xOffset = 24;
			var yOffset = 24;
		
			jQuery( '#bnc .poof' ).css( {
				left: e.pageX - xOffset + 'px',
				top: e.pageY - yOffset + 'px'
			} ).show(); // display the poof <div>

			WPtouchAnimatePoof(); // run the sprite animation			
		
			// remove clicked item's parent
			jQuery( this ).parents( '.theme-wrap' ).fadeOut( 350 );

			jQuery( '#ajax-saving' ).fadeIn( 200 );

			var themeLocation = jQuery( this ).parents().find( 'input.theme-location' ).attr( 'value' );
			var themeName = jQuery( this ).parents().find( 'input.theme-name' ).attr( 'value' );
			
			var ajaxParams = {
				name: themeName,
				location: themeLocation	
			};
			
			WPtouchAdminAjax( 'delete-theme', ajaxParams, function( result ) {
				setTimeout( function() {
					jQuery( '#ajax-saving' ).hide();
					jQuery( '#ajax-saved' ).show().fadeOut( 200 );
				}, 750 );
			});			

		}

		e.preventDefault();
	});		
}

function WPtouchCheckApiServer() {
	WPtouchAdminAjax( 'check-api-server', {}, function( result ) {
		jQuery( '#wptouch-api-server-check' ).html( result );
	});	
}

function WPtouchSetupPluginCompat() {
	jQuery( 'a.regenerate-plugin-list' ).live( 'click', function( e ) {
		jQuery( '.section-plugin-compatibility' ).animate( { opacity: 0.5 } );
		
		WPtouchAdminAjax( 'regenerate-plugin-list', {}, function( result ) {
			jQuery( '.section-plugin-compatibility' ).load( WPtouchCustom.plugin_url + " .section-plugin-compatibility fieldset", function( a ) {
				jQuery( '.section-plugin-compatibility' ).animate( { opacity: 1.0 } );
				
				WPtouchSetupPluginCompat();
			});
		});
		e.preventDefault();
	});	
}

function WPtouchSetupTabSwitching() {
	var adminTabSwitchLinks = jQuery( 'a.wptouch-admin-switch' );
	if ( adminTabSwitchLinks.length ) {
		adminTabSwitchLinks.live( 'click', function( e ) {
			var targetTabClass = '';
			var targetTabSection = '';
			var targetArea = jQuery( this ).attr( 'rel' );

			if ( targetArea == 'themes' ) {
				targetTabClass = 'pane-theme-browser';
				targetTabSection = 'tab-section-installed-themes';

			} else if ( targetArea == 'icons' ) {
				targetTabClass = 'pane-menu-icons';
				targetTabSection = 'tab-section-menu-and-icon-setup';

			} else if ( targetArea == 'icon-sets' ) {
				targetTabClass = 'pane-menu-icons';
				targetTabSection = 'tab-section-upload_icons_and_sets';				

			} else if ( targetArea == 'licenses' ) {
				targetTabClass = 'pane-license';
				targetTabSection = 'tab-section-manage-licenses';	

			} else if ( targetArea == 'account' ) {
				targetTabClass = 'pane-license';
				targetTabSection = 'tab-section-bncid';	

			} else if ( targetArea == 'plugin-conflicts' ) {
				targetTabClass = 'pane-general';
				targetTabSection = 'tab-section-compatibility';

			} else if ( targetArea == 'ipad-settings' ) {
				targetTabClass = 'pane-active-theme';
				targetTabSection = 'tab-section-ipad-theme-settings';
			}
			
			jQuery( 'a.' + targetTabClass + ',' + 'a#' + targetTabSection ).click();				
			e.preventDefault();
		});
	}
}

function WPtouchDoManageStatus( header, status, all_done, class_to_add ) {
	setTimeout( 
		function() {
			jQuery( '#manage-status' ).removeClass().addClass( class_to_add );
			
			if ( all_done ) {
				jQuery( '#manage-status h6' ).removeClass().addClass( 'end' ).html( header );
			} else {
				jQuery( '#manage-status h6' ).removeClass().html( header );
			}
			
			jQuery( '#manage-status p.info' ).html( status );		
			
			if ( all_done ) {
				jQuery( '#manage-spinner, #manage-set-upload-name' ).hide();	
			} else {
				jQuery( '#manage-spinner' ).show();	
			}										
		},
		250
	);	
}

function WPtouchDoTreeDisable() {
	jQuery( 'ul.icon-menu input.checkbox' ).attr( 'disabled', false );
	
	var enabledCheckboxes = jQuery( 'ul.icon-menu input.checkbox:not(:checked)' );
	enabledCheckboxes.each( function() {
		var parentItems = jQuery( this ).parents( 'li' );
		jQuery( parentItems.get( 0 ) ).find( 'ul input.checkbox' ).attr( 'disabled', true );
	});
}

function WPtouchSetupIconDragDrag() {
	jQuery( '#wptouch-icon-list img' ).draggable({
		revert: true,
		cursorAt: { top: 0 },
		revertDuration: 150
	});	
	
	jQuery( '#wptouch-icon-menu div.icon-drop-target' ).droppable({
		drop: function( event, ui ) {
			var droppedDiv = jQuery( this );
			var sourceIcon = ui.draggable.attr( 'src' );
			var menuId = jQuery( this ).attr( "title" );
			var parentListItem = jQuery( this ).parent();
			
			var imageHtml = '<img src="' + sourceIcon + '" />';
			
			droppedDiv.html( imageHtml ).addClass( 'noborder' );			
		
			if ( jQuery( '#wptouch-icon-list ul li:first' ).hasClass('dark' ) ) {
				droppedDiv.addClass( 'dark' );
			} else {
				droppedDiv.removeClass( 'dark' );
			}	
			
			var ajaxParams = {
				title: droppedDiv.attr( 'title' ),
				icon: sourceIcon
			};
			
			WPtouchAdminAjax( 'set-menu-icon', ajaxParams, function( result ) {
				
				if ( parentListItem.hasClass( 'default-prototype' ) ) {
					jQuery( 'div.icon-drop-target.default' ).html( imageHtml );
					
					if ( jQuery( '#wptouch-icon-list ul li:first' ).hasClass('dark' ) ) {
						jQuery( 'div.icon-drop-target.default' ).addClass( 'dark' );
					} else {
						jQuery( 'div.icon-drop-target.default' ).removeClass( 'dark' );
					}
				}	
				
				droppedDiv.removeClass( 'default' );
			});
			
			WPtouchSetupIconDragDrag();
		},
		hoverClass: 'active-drop'
	});		
	
	jQuery( '#wptouch-icon-menu div.icon-drop-target' ).draggable({ 
		revert: true,
		cursorAt: { top: 0 },
		revertDuration: 250,
		scope: 'trash'
	});		
	
	jQuery( '#remove-icon-area' ).droppable({
		drop: function( event, ui ) {
			var menuID = ui.draggable.attr( 'title' );
			
			var ajaxParams = {
				title: menuID
			};
			
			WPtouchAdminAjax( 'remove-menu-icon', ajaxParams, function( result ) {
				ui.draggable.html( '<img src="' + result + '" alt="" />' );
				
				jQuery( '#bnc .poof' ).css({
					left: ui.offset.left + 'px',
					top: ui.offset.top + 'px'
				}).show(); // display the poof <div>
				
				WPtouchAnimatePoof();
				
				ui.draggable.addClass( 'default' );
				
				// Update defaults
				var currentDefaultImage = jQuery( 'li.default-prototype div' ).html();
				ui.draggable.html( currentDefaultImage ); 
			});	
		},
		scope: 'trash',
		hoverClass: 'active-trash'
	});
}

function WPtouchAdminAjax( actionName, actionParams, callback ) {	
	var ajaxData = {
		action: 'wptouch_ajax',
		wptouch_action: actionName,
		wptouch_nonce: WPtouchCustom.admin_nonce
	};
	
	for ( name in actionParams ) { ajaxData[name] = actionParams[name]; }

	jQuery.post( ajaxurl, ajaxData, function( result ) {
		callback( result );	
	});	
}

function WPtouchSetupLicenseArea() {		
	jQuery( 'a.wptouch-remove-license' ).live( 'click', function( e ) {
		var siteToRemove = jQuery( this ).attr( 'rel' );
		jQuery( '#wptouch-license-area' ).animate( { opacity: 0.4 } );		
		var ajaxParams = {
			site: siteToRemove	
		};
		WPtouchAdminAjax( 'remove-license', ajaxParams, function( data ) { 
			window.location.reload();
		});
		
		e.preventDefault();
	});
	
	jQuery( 'a.wptouch-add-license' ).bind( 'click', function( e ) {
		jQuery( this ).unbind();
		jQuery( 'a.wptouch-add-license' ).animate( { opacity: 0.5 } ).text( WPtouchCustom.activating_license );
		WPtouchAdminAjax( 'activate-license', {}, function( data ) { 
			window.location.reload();
		});
		e.preventDefault();
	});
	
	jQuery( '#reset-licenses' ).bind( 'click', function( e ) {
		var answer = confirm( WPtouchCustom.reset_license_text );
		if ( answer ) {
			WPtouchAdminAjax( 'reset-all-licenses', {}, function( data ) { 
				if ( data == 'ok' ) {
					window.location.reload();
				} else {
					alert( WPtouchCustom.reset_license_error );	
				}
			});
		}
		e.preventDefault();
	});
}

function WPtouchLoadRSSPanel( id, ajaxName ) {
	var panel = jQuery( id );
	if ( panel.length ) {
		WPtouchAdminAjax( ajaxName, {}, function( result ) { 
			panel.hide().html( result ).fadeIn( 200 );
			panel.parent().find( 'img.ajax-loader' ).remove();
		});		
	}
}

function WPtouchLoadRSS() {	
	WPtouchLoadRSSPanel( '#blog-news-box-ajax', 'wptouch-news' );
	WPtouchLoadRSSPanel( '#support-threads-box-ajax', 'support-posts' );
//	WPtouchLoadRSSPanel( '#knowledge-base-box-ajax', 'knowledge-base' );
}

function WPtouchTooltipSetup() {
	doBncTooltip( 'a.wptouch-tooltip', '#wptouch-tooltip', 10, -40 );
}

function WPtouchAjaxOn() {
//	jQuery( '#bnc' ).append( '<div id="wptouch-saving"></div>' );
	jQuery( '#ajax-loading' ).fadeIn( 200 );
}

function WPtouchAjaxOff() {
//	jQuery( 'body' ).remove( '<div id="wptouch-saving"></div>' );
	jQuery( '#ajax-loading' ).fadeOut( 200 );	
}

function WPtouchAnimatePoof() {
	var bgTop = 0;		// initial background-position for the poof sprite is '0 0'
	var frames = 5;		// number of frames in the sprite animation
	var frameSize = 32; // size of poof <div> in pixels (32 x 32 px in this example)
	var frameRate = 82; // set length of time each frame in the animation will display (in milliseconds)

	// loop through animation frames
	// and display each frame by resetting the background-position of the poof <div>

	for( i=1; i < frames; i++ ) {
		jQuery( '#bnc .poof' ).animate( {
			backgroundPosition: '0 ' + bgTop 
		}, frameRate );
		bgTop -= frameSize; // update bgPosition to reflect the new background-position of our poof <div>
	}
	// wait until the animation completes and then hide the poof <div>
	setTimeout( "jQuery( '#bnc .poof' ).hide();", frames * frameRate );
}

function WPtouchHandleBackupClipboard() {	
	if ( wptouchClip == 0 && jQuery( '#copy-text-button' ).is( ':visible' ) ) {
		wptouchClip = new ZeroClipboard.Client();

		wptouchClip.glue( 'copy-text-button' );
		
		var textToCopy = jQuery( '.type-backup textarea' ).text();
		wptouchClip.setText( textToCopy );

		wptouchClip.addEventListener( 'complete', function( client, text ) {
			alert( WPtouchCustom.copying_text );
		});	
	}
}

function WPtouchSavedOrResetNotice() {
	if ( jQuery( '#bnc-form .saved' ).length ) {
		setTimeout( function() {
			jQuery( '#bnc-form .saved' ).fadeOut( 200 );
		}, 1000 );
	}

	if ( jQuery( '#bnc-form .reset' ).length ) {
		setTimeout( function() {
			jQuery( '#bnc-form .reset' ).fadeOut( 200 );
		}, 1000 );
	}
}

function WPtouchLicenseFeedback() {
	if ( jQuery( '#setting-bncid p.license-valid' ).length ) {
		jQuery( 'input#bncid.text, input#wptouch_license_key.text' ).addClass( 'valid' );
	}
	if ( jQuery( '#setting-bncid p.license-partial' ).length ) {
		jQuery( 'input#bncid.text, input#wptouch_license_key.text' ).addClass( 'partial' );
	}
/* Failed credentials */
	if ( jQuery( 'p.bncid-failed' ).length ) {
		jQuery( 'p.bncid-failed' ).shake( 4, 8, 900 );
	}
}

/* New jQuery function opacityToggle() */
jQuery.fn.opacityToggle = function( speed, easing, callback ) { 
	return this.animate( { opacity: 'toggle' }, speed, easing, callback ); 
}

jQuery( document ).ready( function() { WPtouchProAdminReady(); } );