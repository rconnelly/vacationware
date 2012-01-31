
<?php global $userMeta; ?>

<div class="wrap">
    <div id="icon-options-general" class="icon32 icon32-posts-page"><br /></div>  
    <h2>User Meta Settings</h2>   
    <?php do_action( 'um_admin_notice' ); ?>
    <div id="dashboard-widgets-wrap">
        <div class="metabox-holder">
            <div id="um_admin_content">
                <?php $userMeta->renderPro("settings", $settings); ?>
            </div>
            
            <div id="um_admin_sidebar">                            
                <?php
                echo $userMeta->metaBox( '3 steps to getting started',  $userMeta->boxHowToUse());               
                if( !@$userMeta->isPro )
                    echo $userMeta->metaBox( 'User Meta Pro',   $userMeta->boxGetPro());
                echo $userMeta->metaBox( 'Shortcode',   $userMeta->boxShortcodesDocs());
                ?>
            </div>
        </div>
    </div>     
</div>