<div id="modal-edit-user-form" class="popup-basic admin-form mfp-with-anim mfp-hide">

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-plus"></i>Edit User</span>
        </div>
        <!-- end .panel-heading section -->

        <form method="post" action="/" id="edit-user-form">
            
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
                            <input type="text" id="user_birthday" name="user_birthday" class="gui-input" placeholder="Birthday...">
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
                            <input type="checkbox" id="change_password" name="change_password" value="">
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
            /* Widget
            /* ----------------------------------------- */

            $j("#user_birthday").datepicker({
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: false
            });

            /* ----------------------------------------- */
            /* Validation
            /* ----------------------------------------- */

            var form = $j( "#edit-user-form" );

            form.validate({
            
                    /* @validation states + elements 
                    ------------------------------------------- */
                    
                    errorClass: "state-error",
                    validClass: "state-success",
                    errorElement: "em",
                    
                    /* @validation rules 
                    ------------------------------------------ */
                        
                    rules: {
                            user_full_name: {
                                    required: true
                            },            
                            user_email: {
                                    required: true,
                                    email: true
                            },
                            user_phone: {
                                    required: true,
                                    digits: true,
                                    maxlength: 12
                            },
                            user_birthday: {
                                    required: true,
                            },                              
                            user_address: {
                                    required: true
                            },     
                            user_pass:  {
                                    required: true
                            },
                            user_repass:  {
                                    required: true,
                                    equalTo : "#user_pass"
                            }
                    },

                    /* @validation error messages 
                    ---------------------------------------------- */
                        
                    messages:{
                            user_full_name: {
                                    required: 'Enter full name'
                            },
                            user_email: {
                                    required: 'Enter email address',
                                    email: 'Enter a VALID email address'
                            },                  
                            user_phone: {
                                    require_from_group: 'Fill at least a mobile contact',
                                    required: 'Enter phone number'
                            },
                            user_birthday: {
                                    required: 'Enter birthdate'
                            },                                                      
                            user_address: {
                                    required: 'Enter address'
                            },                      
                            user_pass:  {
                                    required: 'Enter new password'
                            },
                            user_pass:  {
                                    required: 'Enter confirm new password',
                                    equalTo: 'Confirm new password is not match'
                            }                                                                  
                    },

                    /* @validation highlighting + error placement  
                    ---------------------------------------------------- */ 
                    
                    highlight: function(element, errorClass, validClass) {
                            $j(element).closest('.field').addClass(errorClass).removeClass(validClass);
                    },
                    unhighlight: function(element, errorClass, validClass) {
                            $j(element).closest('.field').removeClass(errorClass).addClass(validClass);
                    },
                    errorPlacement: function(error, element) {
                       if (element.is(":radio") || element.is(":checkbox")) {
                                element.closest('.option-group').after(error);
                       } else {
                                error.insertAfter(element.parent());
                       }
                    },
                    removehighlights: function() {
                        form.find('.field').removeClass(this.errorClass+' '+this.validClass);
                        form.find('em.'+this.errorClass).remove();
                    }
                            
            }); 

            /* ----------------------------------------- */
            /* Toggle Change Password Form
            /* ----------------------------------------- */

            $j('#change_password').click(function(){
                $j('#edit-password-section').slideToggle();   
            });
        })

    }(jQuery));
    
</script>