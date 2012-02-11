<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Light House
 * @since Light House 1.0
 */

get_header(); ?>
<div id="maincontent">
<div id="content">
<?php
while (have_posts()) : the_post(); ?>
    <?php

    $currencyunit = get_option("templatesquare_property_currency");
    $areaunit = get_option("templatesquare_property_area_unit");
    $lotunit = get_option("templatesquare_property_lot_unit");

    $prefix = 'ts_';

    $custom = get_post_custom($post->ID);
    $price = (isset($custom[$prefix . "price"][0])) ? $custom[$prefix . "price"][0] : "";
    $listingType = (isset($custom[$prefix . "listingType"][0])) ? $custom[$prefix . "listingType"][0] : "";
    $propertyType = (isset($custom[$prefix . "propertyType"][0])) ? $custom[$prefix . "propertyType"][0] : "";
    $listingTitle = (isset($custom[$prefix . "listingTitle"][0])) ? $custom[$prefix . "listingTitle"][0] : "";
    $listingNote = (isset($custom[$prefix . "listingNote"][0])) ? $custom[$prefix . "listingNote"][0] : "";

    $virtualTourLink = (isset($custom[$prefix . "virtualTourLink"][0])) ? $custom[$prefix . "virtualTourLink"][0] : "";
    $calendarLink = (isset($custom[$prefix . "calendarLink"][0])) ? $custom[$prefix . "calendarLink"][0] : "";

    $address = (isset($custom[$prefix . "address"][0])) ? $custom[$prefix . "address"][0] : "";
    $city = (isset($custom[$prefix . "city"][0])) ? $custom[$prefix . "city"][0] : "";
    $state = (isset($custom[$prefix . "state"][0])) ? $custom[$prefix . "state"][0] : "";
    $zipcode = (isset($custom[$prefix . "zipcode"][0])) ? $custom[$prefix . "zipcode"][0] : "";

    $rates = (isset($custom[$prefix . "rates"][0])) ? $custom[$prefix . "rates"][0] : "";
    $policies = (isset($custom[$prefix . "policies"][0])) ? $custom[$prefix . "policies"][0] : "";
    $beds = (isset($custom[$prefix . "beds"][0])) ? $custom[$prefix . "beds"][0] : "";
    $baths = (isset($custom[$prefix . "baths"][0])) ? $custom[$prefix . "baths"][0] : "";
    $houseSize = (isset($custom[$prefix . "houseSize"][0])) ? $custom[$prefix . "houseSize"][0] : "";
    $lotSize = (isset($custom[$prefix . "lotSize"][0])) ? $custom[$prefix . "lotSize"][0] : "";
    $yearBuilt = (isset($custom[$prefix . "yearBuilt"][0])) ? $custom[$prefix . "yearBuilt"][0] : "";
    $neighborHood = (isset($custom[$prefix . "neighborHood"][0])) ? $custom[$prefix . "neighborHood"][0] : "";
    $style = (isset($custom[$prefix . "style"][0])) ? $custom[$prefix . "style"][0] : "";
    $stories = (isset($custom[$prefix . "stories"][0])) ? $custom[$prefix . "stories"][0] : "";
    $garage = (isset($custom[$prefix . "garage"][0])) ? $custom[$prefix . "garage"][0] : "";
    $propertyFeatures = (isset($custom[$prefix . "propertyFeatures"][0])) ? $custom[$prefix . "propertyFeatures"][0] : "";
    $fireplaceFeatures = (isset($custom[$prefix . "fireplaceFeatures"][0])) ? $custom[$prefix . "fireplaceFeatures"][0] : "";
    $heatingFeatures = (isset($custom[$prefix . "heatingFeatures"][0])) ? $custom[$prefix . "heatingFeatures"][0] : "";
    $externalConstruction = (isset($custom[$prefix . "externalConstruction"][0])) ? $custom[$prefix . "externalConstruction"][0] : "";
    $roofing = (isset($custom[$prefix . "roofing"][0])) ? $custom[$prefix . "roofing"][0] : "";
    $interiorFeatures = (isset($custom[$prefix . "interiorFeatures"][0])) ? $custom[$prefix . "interiorFeatures"][0] : "";
    $exteriorFeatures = (isset($custom[$prefix . "exteriorFeatures"][0])) ? $custom[$prefix . "exteriorFeatures"][0] : "";



    $emailTo = get_the_author_meta('user_email');
    $disableContact = (isset($custom[$prefix . "disableContact"][0])) ? $custom[$prefix . "disableContact"][0] : "";

    ?>
    <?php
    $t = $address . ' ' . $city . ' ' . $state . ' ' . $zipcode;

    if ($listingTitle == "Use address as title") {
        $ltitle = $t;
    } else {
        $ltitle = get_the_title();
    }

    $subjecttitle = $ltitle;

    echo '<h2 class="underline">' . $ltitle . '</h2>';
    ?>

    <?php
    $attachments = get_children(array(
            'post_parent' => $post->ID,
            'post_type' => 'attachment',
            'order' => '',
            'post_mime_type' => 'image')
    );
    ?>

<!--GALLERY PROPERTY IMAGE-->


<div id="container-slider2">

    <div class="ad-gallery">
        <div class="ad-image-wrapper">
        </div>
        <div class="ad-controls">
        </div>
        <div class="ad-nav">
            <div class="ad-thumbs">
                <ul class="ad-thumb-list">
                    <?php foreach ($attachments as $att_id => $attachment) { ?>
                    <li>

                        <?php
                        $getimage = wp_get_attachment_image_src($att_id, 'property-gallery', true);
                        $propertyimage = $getimage[0];
                        $getimageThumb = wp_get_attachment_image_src($att_id, 'property-gallery-thumb', true);
                        $propertyimageThumb = $getimageThumb[0];

                        echo '<a href="' . $propertyimage . '"><img src="' . $propertyimageThumb . '" alt="thumb" /></a>';
                        ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.ad-gallery.js"></script>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                var imgCount = $('.ad-thumb-list li').length;
                var galleries = $('.ad-gallery').adGallery({
                    loader_image:'<?php echo get_template_directory_uri();?>/images/ad-gallery/loader.gif',
                    width:620, // Width of the image, set to false and it will read the CSS width
                    height:360, // Height of the image, set to false and it will read the CSS height
                    thumb_opacity:0.7, // Opacity that the thumbs fades to/from, (1 removes fade effect)
                    // Note that this effect combined with other effects might be resource intensive
                    // and make animations lag
                    start_at_index:0, // Which image should be displayed at first? 0 is the first image
                    description_wrapper:$('#descriptions'), // Either false or a jQuery object, if you want the image descriptions
                    // to be placed somewhere else than on top of the image
                    animate_first_image:false, // Should first image just be displayed, or animated in?
                    animation_speed:400, // Which ever effect is used to switch images, how long should it take?
                    display_next_and_prev:true, // Can you navigate by clicking on the left/right on the image?
                    display_back_and_forward:true, // Are you allowed to scroll the thumb list?
                    scroll_jump:0, // If 0, it jumps the width of the container
                    slideshow:{
                        enable:true,
                        autostart:true,
                        speed:5000,
                        start_label:'Start',
                        stop_label:'Stop',
                        stop_on_scroll:true, // Should the slideshow stop if the user scrolls the thumb list?
                        countdown_prefix:'(', // Wrap around the countdown
                        countdown_sufix:')',
                        onStart:function () {
                            // Do something wild when the slideshow starts
                        },
                        onStop:function () {
                            // Do something wild when the slideshow stops
                        }
                    },
                    effect:'slide-hori', // or 'slide-vert', 'resize', 'fade', 'none' or false
                    enable_keyboard_move:true, // Move to next/previous image with keyboard arrows?
                    cycle:true, // If set to false, you can't go from the last image to the first, and vice versa
                    // All callbacks has the AdGallery objects as 'this' reference
                    callbacks:{
                        // Executes right after the internal init, can be used to choose which images
                        // you want to preload
                        init:function () {
                            // preloadAll uses recursion to preload each image right after one another
                            //this.preloadAll();
                            // Or, just preload the first three
                            this.preloadImage(0);
                            this.preloadImage(1);
                            this.preloadImage(2);
                        },
                        // This gets fired right after the new_image is fully visible
                        afterImageVisible:function () {
                            // For example, preload the next image
                            var context = this;
                            if (this.current_index + 1 < imgCount) {
                                this.loading(true);
                                this.preloadImage(this.current_index + 1,
                                    function () {
                                        // This function gets executed after the image has been loaded
                                        context.loading(false);
                                    }
                                );

                                // Want slide effect for every other image?
                                if (this.current_index % 2 == 0) {
                                    this.settings.effect = 'slide-hori';
                                } else {
                                    this.settings.effect = 'fade';
                                }
                            }
                        },
                        // This gets fired right before old_image is about to go away, and new_image
                        // is about to come in
                        beforeImageVisible:function (new_image, old_image) {
                            // Do something wild!
                        }
                    }
                });

                // Set image description
                //some_img.data('ad-desc', 'This is my description!');

                // Change effect on the fly
                galleries[0].settings.effect = 'fade';
            });
        })(jQuery);
    </script>
</div>

<!--END GALLERY PROPERTY IMAGE-->

<div class="clear"></div><br/><br/>

<h2 class="underline"><?php _e('Property Details', 'templatesquare'); ?></h2>
<div id="property-detail">

    <ul class="box_text">
        <?php

        echo'<li class="bedbath"><span class="label">' . __('Beds', 'templatesquare') . ':</span><span class="text">' . $beds . '</span></li>';

        echo'<li class="bedbath"><span class="label">' . __('Baths', 'templatesquare') . ':</span><span class="text">' . $baths . '</span></li>';

        echo'<li class="rates"><span class="label">' . __('Rates') . ':</span><span class="text">' . nl2br($rates) . '</span></li>';
        ?>
    </ul>

</div>


<div class="clear"></div>

<h4 class="underline">Description</h4>
    <?php the_content(__('Read More', 'templatesquare')); ?>
    <?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'templatesquare'), 'after' => '</div>')); ?>

<div class="clear"></div><br/>

<div class="links">

    <?php
    if ($calendarLink != '') {
        echo '<figure>';
        echo'<a href="' . $calendarLink . '"><img src="' . get_template_directory_uri() . '/images/calendar.png" alt="Calendar" />';
        echo '<figcaption>View Calendar</figcaption></a>';
        echo '</figure>';
    }
    ?>


    <?php
    if ($virtualTourLink != '') {
        echo '<figure>';
        echo'<a href="' . $virtualTourLink . '"><img src="' . get_template_directory_uri() . '/images/virtualtour.png" alt="Virtual Tour" />';
        echo '<figcaption>View Virtual Tour</figcaption></a>';
        echo '</figure>';
    }
    ?>


</div>

    <?php
    if ($propertyFeatures != '') {
        echo '<div class="clear"></div><br/><br/>';
        echo '<h4 class="underline">Amenities</h4>';
        echo '<p>' . nl2br($propertyFeatures) . '</p>';
    }
    ?>
<div class="clear"></div><br/>

    <?php
    if ($policies != '') {
        echo'<h4 class="underline">' . _('Policies') . '</h4>';
        echo'<p class="policies">' . nl2br($policies) . '</p>';
    }
    ?>


    <?php edit_post_link(__('Edit Property'), '<span class="edit-link">', '</span>'); ?>


<div class="clear"></div><br/><br/>

<h2 class="underline"><?php _e('Location', 'templatesquare');?></h2>


    <?php
    $location = $address . ' ' . $city . ' ' . $state . ' ' . $zipcode;
    $addressLocation = urlencode(str_replace(' ', '+', $location));
    ?>

<a href="http://maps.google.com/maps?q=<?php echo $addressLocation;?>" target="googlemaps">
    <address>
        <ul>
            <?php echo '<li>' . $address . '</li>';?>
            <?php echo '<li>' . $city . ', ' . $state . ' ' . $zipcode . '</li>';?>
        </ul>

    </address>
</a>

<a href="http://maps.google.com/maps?q=<?php echo $addressLocation;?>" target="googlemaps">
    <img
        src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $addressLocation;?>&markers=<?php echo $addressLocation;?>&zoom=11&size=620x353&sensor=false">
    <br/>
    <span class="map_caption">View in google maps</span>
</a>
<div class="clear"></div><br/><br/>




    <?php comments_template('', true); ?>
				
			</div><!-- end #content -->

    <?php endwhile; ?>

<div class="sidebar_right">
    <div class="sidebar">
        <ul>

            <li class="widget-container widget_text">
                <h2 class="widget-title"><?php _e('Contact Information'); ?></h2>

                <div class="agent">

                    <?php echo'<div class="alignleft">
						' . get_avatar(get_the_author_meta('user_email'), apply_filters('templatesquare_author_bio_avatar_size', 60)) . '</div>
						<span class="black">' . get_the_author() . '</span><br/>';

                    if (get_the_author_meta('description')) :
                        the_author_meta('description');
                    endif;
                    echo '
						<a href="mailto:' . get_the_author_meta('user_email') . '">' . get_the_author_meta('user_email') . '</a><br/>
						';
                    echo '<a href="http://twitter.com/' . get_the_author_meta('twitter') . '">@' . get_the_author_meta('twitter') . '</a><br/>';
                    ?>
                </div>

            </li>


            <?php

            if ($disableContact != true) {
                ?>
                <!--
					<li class="widget-container widget_search">
						<h2 class="widget-title"><?php _e('Contact Agent', 'templatesquare');?></h2>
						<?php

                    include_once(TEMPLATEPATH . "/includes/property/agentform.php");

                    if (isset($emailSent) && $emailSent == true) {
                        echo '<div id="messageThanks"><strong>' . __("Contact Form Submitted!", "templatesquare") . '</strong><p>' . __("We will be in touch soon.") . '</p><div>';
                    } else {
                        ?>
						<form action="<?php echo get_template_directory_uri(); ?>/includes/property/agentform.php" id="contact-agent" method="post">
							<fieldset>
							<ul>
								<li>
									<label for="contactName"><?php _e('First Name', 'templatesquare'); ?>:</label>
									<input type="text" name="contactName" id="contactName" value="<?php if (isset($_POST['contactName'])) echo $_POST['contactName']; ?>" class="required requiredField" size="21" />
								</li>
								<li>
									<label for="contactName2"><?php _e('Last Name', 'templatesquare'); ?>:</label>
									<input type="text" name="contactName2" id="contactName2" value="<?php if (isset($_POST['contactName2'])) echo $_POST['contactName2']; ?>" class="required requiredField" size="21" />
								</li>
							</ul>
							<label for="email"><?php _e('Email', 'templatesquare'); ?>:</label><br />
							<input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" class="required requiredField email" size="34" /><br />
							<label for="commentsText"><?php _e('Message', 'templatesquare'); ?>:</label><br />
							<textarea name="comments" id="commentsText" rows="3" cols="37" class="required requiredField"><?php if (isset($_POST['comments'])) {
                            if (function_exists('stripslashes')) {
                                echo stripslashes($_POST['comments']);
                            } else {
                                echo $_POST['comments'];
                            }
                        } ?></textarea>
							<input type="submit" name="submit" class="button" value="submit"/>
							<input type="hidden" name="submitted" id="submitted" value="true" />
                            <input type="hidden" name="ltitle" id="ltitle" value="<?php echo trim($subjecttitle); ?>" />
							<input type="hidden" name="emailto" id="emailto" value="<?php echo $emailTo; ?>" />
							</fieldset>
							<div id="validateContainer">
								<span class="error"></span>
								<?php if ($nameError != '') {
                            echo '<span class="error">' . $nameError . '</span>'; ?><?php
                        } ?>
								<?php if ($nameError2 != '') {
                            echo '<span class="error">' . $nameError2 . '</span>'; ?><?php
                        } ?>
								<?php if ($emailError != '') {
                            echo '<span class="error">' . $emailError . '</span>'; ?><?php
                        } ?>
								<?php if ($commentError != '') {
                            echo '<span class="error">' . $commentError . '</span>'; ?><?php
                        } ?>
							</div>
						</form>	
						<?php } ?>
											
					</li>
					-->
                <?php } ?>

            <li class="widget-container widget_text">
                <?php

                function get_related_author_posts()
                {
                    global $authordata, $post;

                    $authors_posts = get_posts(array('author' => $authordata->ID, 'post__not_in' => array($post->ID), 'post_type' => 'property', 'posts_per_page' => 2, 'order' => 'ASC'));

                    $output = '';
                    if (count($authors_posts)) {
                        $output .= '<h2 class="widget-title">' . __('Agent&acute;s Other Listings', 'templatesquare') . '</h2>';
                        $output .= '<div class="property-list">';

                        foreach ($authors_posts as $authors_post) {
                            $output .= '<p>';
                            $prefix = 'ts_';

                            $custom = get_post_custom($authors_post->ID);
                            $listingTitle = (isset($custom[$prefix . "listingTitle"][0])) ? $custom[$prefix . "listingTitle"][0] : "";
                            $price = (isset($custom[$prefix . "price"][0])) ? $custom[$prefix . "price"][0] : "";
                            $beds = (isset($custom[$prefix . "beds"][0])) ? $custom[$prefix . "beds"][0] : "";
                            $baths = (isset($custom[$prefix . "baths"][0])) ? $custom[$prefix . "baths"][0] : "";
                            $houseSize = (isset($custom[$prefix . "houseSize"][0])) ? $custom[$prefix . "houseSize"][0] : "";
                            $address = (isset($custom[$prefix . "address"][0])) ? $custom[$prefix . "address"][0] : "";
                            $city = (isset($custom[$prefix . "city"][0])) ? $custom[$prefix . "city"][0] : "";
                            $state = (isset($custom[$prefix . "state"][0])) ? $custom[$prefix . "state"][0] : "";
                            $zipcode = (isset($custom[$prefix . "zipcode"][0])) ? $custom[$prefix . "zipcode"][0] : "";

                            $t2 = '<span class="title">' . $address . ' ' . $city . '</span><br/> ' . $state . ' ' . $zipcode . '<br/>';
                            $t3 = '<span class="title">' . get_the_title($authors_post->ID) . '</span><br/>';


                            if ($listingTitle == "Use address as title") {
                                $ltitle2 = $t2;
                            } else {
                                $ltitle2 = $t3;
                            }


                            $auth_attachments = get_children(array(
                                    'post_parent' => $authors_post->ID,
                                    'post_type' => 'attachment',
                                    'posts_per_page' => 1,
                                    'order' => '',
                                    'post_mime_type' => 'image')
                            );

                            if (count($auth_attachments) != 0) {

                                // put the image in a array
                                foreach ($auth_attachments as $auth_att_id => $auth_attachment) {

                                    $auth_imageWidget = wp_get_attachment_image_src($auth_att_id, 'property-agent-listing-widget', true);
                                    // the [0] position goes for the image URL
                                    $auth_propertyimageWidget = $auth_imageWidget[0];

                                    $output .= '<img src="' . $auth_propertyimageWidget . '" alt="" />';

                                }

                            } else {

                                $output .= '<img src="' . get_stylesheet_directory_uri() . "/images/nophoto300x178.jpg" . '" alt="" />';
                            }

                            $currencyunit = get_option("templatesquare_property_currency");
                            $areaunit = get_option("templatesquare_property_area_unit");
                            $output .= '
									<a href="' . get_permalink($authors_post->ID) . '">' . $ltitle2 . '</a>
									<span class="black">' . $currencyunit . ' ' . number_format($price, 0, '.', ',') . '</span><br />
									<small>' . $beds . ' beds, ' . $baths . ' baths, ' . $houseSize . ' ' . $areaunit . '</small>
									';

                            $output .= '</p>';

                        }
                        $output .= '</div>';
                    }

                    return $output;
                }

                //echo get_related_author_posts();

                ?>
            </li>
        </ul>
        <?php get_sidebar('property');?>
    </div>
    <!-- end #sidebar -->
</div>
<!-- end #sidebar_right -->
<div class="clear"></div>
</div><!-- end #maincontent -->
<?php get_footer(); ?>
