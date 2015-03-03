<div id="modal-update-form" class="popup-basic admin-form mfp-with-anim mfp-hide">

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-plus"></i>Edit <?php echo $crud_for ?></span>
        </div>
        <!-- end .panel-heading section -->

        <form method="post" action="/" id="update-form">
            <input type="hidden" name="user_id" id="user_id" />
            
            <div class="panel-body p25">

                <div class="section-divider mb40">
                    <span>Account Information</span>
                </div>

                <div class="section">
                    <label for="user_full_name" class="field prepend-icon">
                        <input type="text" name="user_full_name" id="user_full_name" class="gui-input" placeholder="Full Name...">
                        <label for="user_full_name" class="field-icon"><i class="fa fa-user"></i></label>
                    </label>
                </div>

                <div class="section">
                    <label for="user_email" class="field prepend-icon">
                        <input type="email" name="user_email" id="user_email" class="gui-input" placeholder="Email address...">
                        <label for="user_email" class="field-icon"><i class="fa fa-envelope"></i>
                        </label>
                    </label>
                </div>
                
                <div class="section row">
                    <div class="col-md-6">
                        <label for="user_phone" class="field prepend-icon">
                            <input type="text" name="user_phone" id="user_phone" class="gui-input" placeholder="Phone...">
                            <label for="user_phone" class="field-icon"><i class="fa fa-phone"></i>
                            </label>
                        </label>
                    </div>

                    <div class="col-md-6">
                        <label for="user_birthday" class="field prepend-icon">
                            <input type="text" id="user_birthday" name="user_birthday" class="gui-input datepicker" placeholder="Birthday...">
                            <label for="user_birthday" class="field-icon"><i class="fa fa-calendar-o"></i>
                            </label>
                        </label>
                    </div>
                </div>

                <div class="section">
                    <label for="user_address" class="field prepend-icon">
                        <textarea class="gui-textarea" id="user_address" name="user_address" placeholder="Address..."></textarea>
                        <label for="user_address" class="field-icon"><i class="fa fa-home"></i>
                        </label>
                    </label>
                </div>

                <div class="section">
                    <label for="user_st" class="block mt15 switch switch-primary">
                        <input type="checkbox" name="user_st" id="user_st" value="1" checked="">
                        <label for="user_st" data-on="ON" data-off="OFF"></label>
                        <span>Status</span>
                    </label>
                </div>
                <div class="section">
                    <div class="option-group field">
                        <label class="option option-primary">
                            <input type="checkbox" id="change_password" name="change_password" value="1">
                            <span class="checkbox"></span>Change password
                        </label>
                    </div>
                    <!-- end .option-group section -->
                </div>

                <br/>

                <div id="edit-password-section" style="display:none;">
                    <div class="section-divider mb40">
                        <span>Change Password</span>
                    </div>

                    <div class="section">
                        <label for="user_pass" class="field prepend-icon">
                            <input type="password" name="user_pass" id="user_pass" class="gui-input" placeholder="Password...">
                            <label for="user_pass" class="field-icon"><i class="fa fa-lock"></i></label>
                        </label>
                    </div>

                    <div class="section">
                        <label for="user_repass" class="field prepend-icon">
                            <input type="password" name="user_repass" id="user_repass" class="gui-input" placeholder="Confirm Password...">
                            <label for="user_pass" class="field-icon"><i class="fa fa-lock"></i></label>
                        </label>
                    </div>
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

            /* ----------------------------------------- */
            /* Toggle Change Password Form
            /* ----------------------------------------- */

            $j('#change_password').click(function(){
                $j('#edit-password-section').slideToggle();   
            });
        })

    }(jQuery));
    
</script>