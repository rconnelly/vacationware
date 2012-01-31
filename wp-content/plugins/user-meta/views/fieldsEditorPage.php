
<?php global $userMeta; ?>

<div class="wrap">
    <div id="icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>  
    <h2>Fields Editor</h2>  
    <?php do_action( 'um_admin_notice' ); ?>
    <p>Click field from right side panel for creating new field</p> 
    <div id="dashboard-widgets-wrap">
        <div class="metabox-holder">
            <div id="um_admin_content">
                <form id="um_fields_form" action="" method="post" onsubmit="umUpdateField(this); return false;" >
                    <?php echo $userMeta->createInput( 'save_field', 'submit', array('value'=>'Save Changes', 'class'=>'button-primary pf_save_button' ) ); ?>                 
                    <br /><br />
                    <div id="um_fields_container">                 
                        <?php
                        if( $fields ){
                            $n = 0;
                            foreach( $fields as $fieldID => $fieldData ){
                                $n++;
                                $fieldData['id'] = $fieldID;
                                $fieldData['n']  = $n;
                                $userMeta->render( 'field', $fieldData );
                            }
                        }   
                        ?>                                     
                    </div>
                    <?php echo $userMeta->createInput( 'save_field', 'submit', array('value'=>'Save Changes', 'class'=>'button-primary pf_save_button' ) ); ?>                 
                </form>
                <?php $maxKey      = $userMeta->maxKey( $fields ); ?>
                <?php $last_id     = $maxKey ? $maxKey : 0 ?>
                <input type="hidden" id="last_id" value="<?php echo $last_id; ?>"/>
            </div>
            

            <?php
            $fieldSelection = $userMeta->renderPro( 'fieldSelector' );
            ?>
            
            <div id="um_admin_sidebar">                            
                <?php 
                echo $userMeta->metaBox( 'WordPress Default Fields',  $fieldSelection['wp_default'] );
                echo $userMeta->metaBox( 'Extra Fields',              $fieldSelection['standard'] );
                echo $userMeta->metaBox( 'Formating Fields',          $fieldSelection['formatting'] );
                if( !@$userMeta->isPro )
                    echo $userMeta->metaBox( 'User Meta Pro',   $userMeta->boxGetPro());
                echo $userMeta->metaBox( '3 steps to getting started',  $userMeta->boxHowToUse());
                echo $userMeta->metaBox( 'Shortcode',   $userMeta->boxShortcodesDocs(), false, false);
                ?>
            </div>
        </div>
    </div>     
</div>


<script>
jQuery(function() {

    jQuery('#um_fields_container').sortable({
        connectWith: '#um_fields_container',
        cursor: 'pointer'
    }).droppable({
        accept: '.um_field_selecor',
        activeClass: 'um_highlight',
        drop: function(event, ui) {
            var $li = jQuery('<div>').html('List ' + ui.draggable.html());
            $li.appendTo(this);
        }
    });  
   
    jQuery( "#um_admin_sidebar" ).sortable();
});
</script>   
