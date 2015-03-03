<?php
/*
 * CRUD editor for create new data
 *
 * Description:
 * - Parts need to be customized to make it work:
 *      1. form content
 *
 */
?>

<div id="modal-create-form" class="popup-basic admin-form mfp-with-anim mfp-hide">

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-plus"></i>Edit <?php echo $crud_for ?></span>
        </div>
        <!-- end .panel-heading section -->

        <form method="post" action="/" id="create-form">
            <input type="hidden" name="role_id" id="user_id" />
            
            <div class="panel-body p25">

                <?php // Start: customable form content ?>
                <!-- <div class="section-divider mb40">
                    <span><?php echo $crud_for ?> Information</span>
                </div>

                <div class="section">
                    <label for="role_name" class="field prepend-icon">
                        <input type="text" name="role_name" id="role_name" class="gui-input" placeholder="Nama Role...">
                        <label for="role_name" class="field-icon"><i class="glyphicons glyphicons-group"></i></label>
                    </label>
                </div>

                <div class="section">
                    <label for="role_desc" class="field prepend-icon">
                        <textarea class="gui-textarea" id="role_desc" name="role_desc" placeholder="Deskripsi..."></textarea>
                        <label for="role_desc" class="field-icon"><i class="fa fa-info-circle"></i>
                        </label>
                    </label>
                </div>

                <div class="section">
                    <label for="portal_id" class="field prepend-icon">
                        <input type="text" name="portal_id" id="portal_id" class="gui-input" placeholder="Portal...">
                        <label for="portal_id" class="field-icon"><i class="fa fa-flag"></i>
                        </label>
                    </label>
                </div>
                
                <div class="section">
                    <label for="role_default_url" class="field prepend-icon">
                        <input type="text" name="role_default_url" id="role_default_url" class="gui-input" placeholder="Default path...">
                        <label for="role_default_url" class="field-icon"><i class="fa fa-globe"></i>
                        </label>
                    </label>
                </div>

                <div class="section">
                    <label for="role_st" class="block mt15 switch switch-primary">
                        <input type="checkbox" name="role_st" id="role_st" value="1" checked="">
                        <label for="role_st" data-on="ON" data-off="OFF"></label>
                        <span>Status</span>
                    </label>
                </div> -->
                <?php // End: customable form content ?>
                
            </div>
            <!-- end .form-body section -->

            <div class="panel-footer">
                <button type="submit" class="button btn-primary">Save</button>
            </div>
            <!-- end .form-footer section -->
        </form>
    </div>
    <!-- end: .panel -->
</div>

<script type="text/javascript">
    (function($j){
        
        $j(document).ready(function() {


        })

    }(jQuery));
    
</script>