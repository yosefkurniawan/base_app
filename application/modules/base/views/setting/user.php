<div class="row">
    <div class="col-md-12">
        <div class="panel panel-visible" id="spy4">
            <div class="panel-heading">
                <div class="panel-title hidden-xs">
                    <span class="fa fa-gears"></span><?php echo $page_title ?></div>
            </div>
            <div class="panel-body pn">
                <table cellpadding="0" cellspacing="0" border="0" class="table" id="datatable" width="100%">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>        
</div>

<?php echo $this->load->view(strtolower($crud_for).'/editor_new') ?>
<?php echo $this->load->view(strtolower($crud_for).'/editor_edit') ?>
<?php echo $this->load->view(strtolower($crud_for).'/crud_js') ?>

<script>

(function($j){

    $j(document).ready(function() {

        /* ----------------------------------------- */
        /* Validation
        /* ----------------------------------------- */

        var create_form = $j( "#create-form" );
        var update_form = $j( "#update-form" );
        var validation_options = {
            
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
                        },     
                        role_id:  {
                                required: true
                        }
                },

                /* @validation error messages 
                ---------------------------------------------- */
                    
                messages:{
                                                                                        
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
                removehighlights: function(form) {
                    form.find('.field').removeClass(this.errorClass+' '+this.validClass);
                    form.find('em.'+this.errorClass).remove();
                }
                        
        }

        create_form.validate(validation_options); 
        update_form.validate(validation_options); 

        /* ----------------------------------------- */
        /* Widget
        /* ----------------------------------------- */

        $j(".datepicker").datepicker({
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false
        });
        
    });
    
}(jQuery));

</script>