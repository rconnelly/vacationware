<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Light House
 * @since Light House 1.0
 */

get_header(); ?>

<?php
$pLayout = get_option('templatesquare_property_layout');
$numpost = get_option('templatesquare_property_post');

$prefix = 'ts_';

if ($pLayout == "pgrid") {
    $addclass = "full";
}

$term_exists = term_exists($term, 'propertytag', $parent);

$postproperty = false;
if (isset($_GET['post_type'])) {
    if (stripslashes(trim($_GET['post_type'])) == "property") {
        $postproperty = true;
    }
}

?>

<?php if ($postproperty == true) { ?>

<div id="maincontent">
    <div id="content" class="<?php echo $addclass;?>">

        <h1 class="pagetitle"><?php printf(__('Search Results', 'templatesquare'), '<span>' . get_search_query() . '</span>'); ?></h1>

        <div id="searchresult">
            <?php
            $advcity = (isset($_GET['advcity'])) ? stripslashes(trim($_GET['advcity'])) : "";
            $advstate = (isset($_GET['advstate'])) ? stripslashes(trim($_GET['advstate'])) : "";
            $advzipcode = (isset($_GET['advzipcode'])) ? stripslashes(trim($_GET['advzipcode'])) : "";
            $advprice1 = (isset($_GET['advprice1'])) ? stripslashes(trim($_GET['advprice1'])) : "";
            $advprice2 = (isset($_GET['advprice2'])) ? stripslashes(trim($_GET['advprice2'])) : "";
            $advbed = (isset($_GET['advbed'])) ? stripslashes(trim($_GET['advbed'])) : "";
            $advbath = (isset($_GET['advbath'])) ? stripslashes(trim($_GET['advbath'])) : "";
            $advlisttype = (isset($_GET['advlisttype'])) ? stripslashes(trim($_GET['advlisttype'])) : "";
            $advproptype = (isset($_GET['advproptype'])) ? stripslashes(trim($_GET['advproptype'])) : "";
            $advcompare = (isset($_GET['advcompare'])) ? stripslashes(trim($_GET['advcompare'])) : "";
            $advhousesize = (isset($_GET['advhousesize'])) ? stripslashes(trim($_GET['advhousesize'])) : "";
            $advsleeps = (isset($_GET['advsleeps'])) ? stripslashes(trim($_GET['advsleeps'])) : "";
            $advkeywords = (isset($_GET['advkeywords'])) ? stripslashes(trim($_GET['advkeywords'])) : "";

            $argsearch = array();
            $argsearch["post_type"] = "property";
            $argsearch["paged"] = (isset($paged)) ? $paged : "";
            $argsearch['showposts'] = $numpost;

            if ($advcity != "") {
                if (!isset($argsearch["meta_query"])) {
                    $argsearch["meta_query"] = array();
                }
                $argsearch["meta_query"][] = array(
                    'key' => $prefix . 'city',
                    'value' => $advcity,
                    'compare' => 'LIKE'
                );

            }
            if ($advstate != "") {
                if (!isset($argsearch["meta_query"])) {
                    $argsearch["meta_query"] = array();
                }
                $argsearch["meta_query"][] = array(
                    'key' => $prefix . 'state',
                    'value' => $advstate,
                    'compare' => 'LIKE'
                );

            }
            if ($advzipcode != "") {
                if (!isset($argsearch["meta_query"])) {
                    $argsearch["meta_query"] = array();
                }
                $argsearch["meta_query"][] = array(
                    'key' => $prefix . 'zipcode',
                    'value' => $advzipcode,
                    'compare' => 'LIKE'
                );

            }
            if ($advprice1 != "" && $advprice2 != "") {
                if (!isset($argsearch["meta_query"])) {
                    $argsearch["meta_query"] = array();
                }
                $argsearch["meta_query"][] = array(
                    'key' => $prefix . 'price',
                    'value' => array($advprice1, $advprice2),
                    'type' => 'numeric',
                    'compare' => 'BETWEEN'
                );
            }
            if ($advbed != "") {
                if (!isset($argsearch["meta_query"])) {
                    $argsearch["meta_query"] = array();
                }
                $argsearch["meta_query"][] = array(
                    'key' => $prefix . 'beds',
                    'value' => $advbed,
                    'type' => 'numeric',
                    'compare' => '>='
                );

            }
            if ($advbath != "") {
                if (!isset($argsearch["meta_query"])) {
                    $argsearch["meta_query"] = array();
                }
                $argsearch["meta_query"][] = array(
                    'key' => $prefix . 'baths',
                    'value' => $advbath,
                    'type' => 'numeric',
                    'compare' => '>='
                );

            }
            if ($advsleeps != "") {
                if (!isset($argsearch["meta_query"])) {
                    $argsearch["meta_query"] = array();
                }
                $argsearch["meta_query"][] = array(
                    'key' => $prefix . 'sleeps',
                    'value' => $advsleeps,
                    'type' => 'numeric',
                    'compare' => '>='
                );

            }

            if ($advlisttype != "") {
                if (!isset($argsearch["meta_query"])) {
                    $argsearch["meta_query"] = array();
                }
                $argsearch["meta_query"][] = array(
                    'key' => $prefix . 'listingType',
                    'value' => $advlisttype,
                    'compare' => 'LIKE'
                );

            }
            if ($advproptype != "") {
                if (!isset($argsearch["meta_query"])) {
                    $argsearch["meta_query"] = array();
                }
                $argsearch["meta_query"][] = array(
                    'key' => $prefix . 'propertyType',
                    'value' => $advproptype,
                    'compare' => 'LIKE'
                );
            }


            add_filter('posts_where', 'keyword_search_where');

            function keyword_search_where($where)
            {
                global $advkeywords;
                $keywords = explode(' ', esc_sql($advkeywords));
                if (array_count_values($keywords) > 0) {
                    $where .= "AND ( ";
                    foreach ($keywords as $val)
                    {
                        $where .= "post_content LIKE '%" . $val . "%' OR ";
                    }

                    $where .= "0 = 1)";
                    
                }
                return $where;
            }

            //var_dump($argsearch);
            query_posts($argsearch);
            global $wp_query, $post;


            if (have_posts()
            ) :
                /* Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called loop-search.php and that will be used instead.
                             */ get_template_part('loop', 'property');
                ?>

                <?php else : ?>
                <div id="post-0" class="post no-results not-found">
                    <div class="entry-content">
                        <?php
                        if ($pLayout == "pgrid") {
                            get_template_part('/includes/property/gridsearch');
                        }
                        ?>
                        <h2 class="entry-title"><?php _e('Nothing Found', 'templatesquare'); ?></h2>

                        <p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'templatesquare'); ?></p>
                    </div>
                    <!-- .entry-content -->
                </div><!-- #post-0 -->
                <?php endif; ?>
        </div>
        <!-- end #searchresult -->
    </div>
    <!-- end #content -->

    <?php if ($pLayout == "plist") { ?>
    <div class="sidebar_right">
        <div class="sidebar">
            <?php get_sidebar('property');?>
        </div>
        <!-- end #sidebar -->
    </div><!-- end #sidebar_right -->
    <?php } ?>

    <div class="clear"></div>
</div><!-- end #maincontent -->

<?php } else { ?>

<div id="maincontent">
    <div id="content">

        <h1 class="pagetitle"><?php printf(__('Search Results for: %s', 'templatesquare'), '<span>' . get_search_query() . '</span>'); ?></h1>

        <div id="searchresult">
            <?php if (have_posts()) : ?>
            <?php
            /* Run the loop for the search to output the results.
                            * If you want to overload this in a child theme then include a file
                            * called loop-search.php and that will be used instead.
                            */
            get_template_part('loop', 'search');
            ?>
            <?php else : ?>
            <div id="post-0" class="post no-results not-found">
                <h2 class="entry-title"><?php _e('Nothing Found', 'templatesquare'); ?></h2>

                <div class="entry-content">
                    <p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'templatesquare'); ?></p>

                    <?php
                    get_search_form();
                    ?>
                </div>
                <!-- .entry-content -->
            </div><!-- #post-0 -->
            <?php endif; ?>
        </div>
        <!-- end #searchresult -->
    </div>
    <!-- end #content -->

    <div class="sidebar_right">
        <div class="sidebar">
            <?php get_sidebar();?>
        </div>
        <!-- end #sidebar -->
    </div>
    <!-- end #sidebar_right -->

    <div class="clear"></div>
</div><!-- end #maincontent -->

<?php } ?>
<?php get_footer(); ?>
