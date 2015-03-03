<div id="modal-create-form" class="popup-basic admin-form mfp-with-anim mfp-hide">

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-plus"></i>Tambah <?php echo $crud_for ?></span>
        </div>
        <!-- end .panel-heading section -->

        <form method="post" action="/" id="create-form">
            <input type="hidden" name="role_id" id="role_id" />
            
            <div class="panel-body p25">

                <div class="section-divider mb40">
                    <span><?php echo $crud_for ?> Information</span>
                </div>

                <div class="section">
                    <label for="portal_name" class="field prepend-icon">
                        <input type="text" name="portal_name" id="portal_name" class="gui-input" placeholder="Nama Portal...">
                        <label for="portal_name" class="field-icon"><i class="fa fa-flag"></i></label>
                    </label>
                </div>

                <div class="section">
                    <label for="portal_slug" class="field prepend-icon">
                        <input type="text" name="portal_slug" id="portal_slug" class="gui-input" placeholder="Slug...">
                        <label for="portal_slug" class="field-icon"><i class="fa fa-globe"></i>
                        </label>
                    </label>
                </div>
                
                <div class="section">
                    <label for="portal_title" class="field prepend-icon">
                        <input type="text" name="portal_title" id="portal_title" class="gui-input" placeholder="Judul Portal...">
                        <label for="portal_title" class="field-icon"><i class="fa fa-tag"></i>
                        </label>
                    </label>
                </div>
                
                <div class="section">
                    <label for="portal_desc" class="field prepend-icon">
                        <textarea class="gui-textarea" id="portal_desc" name="portal_desc" placeholder="Deskripsi..."></textarea>
                        <label for="portal_desc" class="field-icon"><i class="fa fa-info-circle"></i>
                        </label>
                    </label>
                </div>

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