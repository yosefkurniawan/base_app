<div id="modal-user-form" class="popup-basic admin-form mfp-with-anim mfp-hide">

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-plus"></i>Create New User</span>
        </div>
        <!-- end .panel-heading section -->

        <form method="post" action="/" id="comment">
            
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
                
                <div class="section row">
                    <div class="col-md-6">
                        <label for="email" class="field prepend-icon">
                            <input type="email" name="email" id="email" class="gui-input" placeholder="Email address">
                            <label for="email" class="field-icon"><i class="fa fa-envelope"></i>
                            </label>
                        </label>
                    </div>

                    <div class="col-md-6">
                        <label for="user_birthday" class="field prepend-icon">
                            <input type="text" id="user_birthday" name="user_birthday" class="gui-input hasDatepicker timepicker" placeholder="Birthday...">
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
                        <input type="checkbox" name="user_st" id="user_st" value="user_st" checked="">
                        <label for="user_st" data-on="ON" data-off="OFF"></label>
                        <span>Status</span>
                    </label>
                </div>

                <br/>
                <div class="section-divider mb40">
                    <span>Login Information</span>
                </div>

                <div class="section">
                    <label for="user_name" class="field prepend-icon">
                        <input type="text" name="user_name" id="user_name" class="gui-input" placeholder="Username...">
                        <label for="user_name" class="field-icon"><i class="fa fa-user"></i></label>
                    </label>
                </div>

                <div class="section">
                    <label for="user_pass" class="field prepend-icon">
                        <input type="text" name="user_pass" id="user_pass" class="gui-input" placeholder="Password...">
                        <label for="user_pass" class="field-icon"><i class="fa fa-key"></i></label>
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

            $j("#user_birthday").datepicker({
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                showButtonPanel: false
            });
        })

    }(jQuery));
    
</script>