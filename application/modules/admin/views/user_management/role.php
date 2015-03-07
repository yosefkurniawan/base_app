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
                            <th>Nama Role</th>
                            <th>Deskripsi</th>
                            <th>Portal</th>
                            <th>Default path</th>
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
<?php echo $this->load->view(strtolower($crud_for).'/editor_permission') ?>
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
                        role_name: {
                                required: true
                        },
                        portal_id: {
                                required: true
                        },
                        role_default_url: {
                                required: true,
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

        
    });
    
}(jQuery));

</script>