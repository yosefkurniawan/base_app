<div class="row">
    <div class="col-md-12">
        <div class="panel panel-visible" id="spy4">
            <div class="panel-heading">
                <div class="panel-title hidden-xs">
                    <span class="fa fa-gears"></span>User Management</div>
            </div>
            <div class="panel-body pn">
                <table cellpadding="0" cellspacing="0" border="0" class="table" id="core_user" width="100%">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>        
</div>

<?php echo $this->load->view('user/editor_new') ?>
<?php echo $this->load->view('user/editor_edit') ?>

<!-- Page Plugins -->
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo skin_url() ?>assets/admin-tools/admin-forms/js/advanced/steps/jquery.steps.js"></script>
<script type="text/javascript" src="<?php echo skin_url() ?>assets/admin-tools/admin-forms/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo skin_url() ?>assets/admin-tools/admin-forms/js/additional-methods.min.js"></script>

<script>

(function($j){

    // CRUD vars
    var datatables;                                             // will be the datatables
    var table_ID        = $j('#core_user');                     // elm table that will be transformed to datatables
    var datatables_url  = '<?php echo $getdatatables_url ?>';   // submit url for CRUD (be one url)
    var submit_url      = '<?php echo $submit_editor_url ?>';   // submit url for CRUD (be one url)
    var modal_create_ID = '#modal-create-user-form'             // modal Create-Editor ID
    var modal_edit_ID   = '#modal-update-user-form'             // modal Update-Editor ID
    var create_form     = $j( "#create-user-form" );            // Create form
    var update_form     = $j( "#update-user-form" );            // Update form

    // instance helper
    globalhelper = new GlobalHelper();

    $j(document).ready(function() {

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

        /* ----------------------------------------- */
        /* Datatables Preparation
        /* ----------------------------------------- */

        datatables = table_ID.DataTable( {
            "dom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            "ajax": datatables_url,
            "columns": [
                {
                    "data": "user_name"
                },
                {
                    "data": "user_email"
                },
                {
                    "data": "user_full_name"
                },
                {   
                    "mDataProp": function(data, type, full) {
                        if (data.user_st=='active')
                            return "<div class='tm-tag tm-tag-success text-center'><i class='fa fa fa-check pr5'></i><b>"+data.user_st+"</b></div>";
                        else if (data.user_st=='deleted')
                            return "<div class='tm-tag tm-tag-danger text-center'><i class='fa fa-times-circle pr5'></i><b>"+data.user_st+"</b></div>";
                        else if (data.user_st=='inactive')
                            return "<div class='tm-tag text-center'><i class='fa fa-minus-circle pr5'></i><b>"+data.user_st+"</b></div>";
                        else 
                            return "<div class='tm-tag text-center'>undefined</div>";
                    }
                },
                {   "sClass": "center", "bSortable": false, "bSearchable": false, "sWidth": "100px","mData": 0,
                    "mDataProp": function(data, type, full) {
                        return "<div class='btn-group'><button class='edit btn btn-sm btn-default' data-id='"+data.user_id+"' id='edit-"+data.user_id+"'><icon class='fa fa-pencil'></icon></button><button class='delete btn btn-sm btn-default' data-id='"+data.user_id+"' id='delete-"+data.user_id+"'><icon class='fa fa-trash-o'></icon></button></div>";
                    }
                }
            ],
            "tableTools": {
                "sRowSelect": "os",
                "aButtons": [
                    {
                        "sExtends": "text",
                        "sButtonText": "Add",
                        "fnClick": function ( nButton, oConfig, oFlash ) {
                            open_create_form();
                        }
                    },
                    "print",
                    {
                        "sExtends":    "collection",
                        "sButtonText": "Export",
                        "aButtons":    [ "csv", "xls", "pdf" ]
                    },
                    {
                        "sExtends": "text",
                        "sButtonText": "Delete",
                        "sButtonClass": "multiple_del_btn",
                        "fnClick": function ( nButton, oConfig, oFlash ) {
                            delete_selected_rows();
                        }
                    },
                ]
            },
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                $j(nRow).attr('id', 'row-'+aData.user_id);
            },
            "iDisplayLength": 20,
            "drawCallback": function() {
                
                // bind event "click" of Edit Button
                $j(this).find('button.btn.edit').click(function(){
                    var id      = $j(this).attr('data-id');
                    var data    = datatables.row('#row-'+id).data(); 
                    open_edit_form(data);
                });

                // bind event "delete" of Delete Button
                $j(this).find('button.btn.delete').click(function(){
                    var id      = $j(this).attr('data-id');
                    var data    = datatables.row('#row-'+id).data(); 
                    delete_data(id,data);
                });
            }
        } );
    
        /* ----------------------------------------- */
        /* Editor on submit
        /* ----------------------------------------- */

        // Create-editor on submit
        $j(create_form).submit(function(e){
            e.preventDefault(); //STOP default action
            create_data($j(this));
        })

        // Edit-editor on submit
        $j(update_form).submit(function(e){
            e.preventDefault(); //STOP default action
            edit_data($j(this));
        })

        /* ----------------------------------------- */
        /* Multiple select
        /* ----------------------------------------- */

        // show/hide delete btn
        table_ID.on('click', function(event) {
            var count_selected = $j(this).find('tbody tr.active').length;
            if (count_selected > 0) 
                $j(this).parent().find('.dt-panelmenu .DTTT .multiple_del_btn').show();
            else
                $j(this).parent().find('.dt-panelmenu .DTTT .multiple_del_btn').hide();
        });
        
    });
    
    /* ----------------------------------------- */
    /* Functions
    /* ----------------------------------------- */

    // Fn: Open Create Editor modal
    function open_create_form() {
        $j.magnificPopup.open({
            removalDelay: 500, //delay removal by X to allow out-animation,
            items: {
                src: modal_create_ID
            },
            callbacks: {
                beforeOpen: function(e) {
                    var Animation = 'mfp-flipInY';
                    this.st.mainClass = Animation;
                },
                beforeClose: function(e) {
                    $j(create_form).validate().settings.removehighlights();
                    $j(create_form).find('.panel-body > .alert').remove();
                }
            },
            midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        });
    }

    // Fn: Open Edit Editor modal
    function open_edit_form(data) {
        $j.magnificPopup.open({
            removalDelay: 500, //delay removal by X to allow out-animation,
            items: {
                src: modal_edit_ID
            },
            callbacks: {
                beforeOpen: function(e) {
                    var Animation = 'mfp-flipInY';
                    this.st.mainClass = Animation;
                },
                beforeClose: function(e) {
                    $j(update_form).validate().settings.removehighlights();
                    $j(update_form).find('.panel-body > .alert').remove();
                },
                open: function() {

                    // set current data as default value
                    $j(update_form).find('#user_id').val(data.user_id);
                    $j(update_form).find('#user_full_name').val(data.user_full_name);
                    $j(update_form).find('#user_email').val(data.user_email);
                    $j(update_form).find('#user_phone').val(data.user_phone);
                    $j(update_form).find('#user_birthday').val(data.user_birthday);
                    $j(update_form).find('#user_address').val(data.user_address);
                    if (data.user_st == 'active') {
                        $j(update_form).find('#user_st').prop('checked',true);
                    }else{
                        $j(update_form).find('#user_st').prop('checked',false);
                    }

                    // hide edit password form
                    $j('#edit-password-section').hide();   
                }
            },
            midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        });
    }

    // Fn: Create data
    function create_data(form) {
        var form = $j(form);
        if (form.valid()) {
            var formURL = submit_url;
            var postData = {};

            var data = {};
            $j.each(form.serializeArray(), function() {
                data[this.name] = this.value;
            });

            postData.data = data;
            postData.action = 'create';

            $j.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                dataType: 'json',
                success:function(data, textStatus, jqXHR) 
                {
                    if (data.success) {
                        datatables.ajax.reload();
                        $j.magnificPopup.close();
                        $j(create_form)[0].reset();
                    }else{
                        $j(create_form).find('.panel-body > .alert').remove();
                        $j(create_form).find('.panel-body').prepend(data.message);

                        // animate error entrance
                        var animatedObj = $j(create_form).find('.panel-body > .alert');
                        var x = 'bounceIn';
                        globalhelper.animation(x,animatedObj);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    globalhelper.ajax_error(textStatus);
                }
            });
        };
    }

    // Fn: Edit data
    function edit_data(form) {
        var form = $j(form);
        if (form.valid()) {
            var formURL = submit_url;
            var postData = {};

            var data = {};
            $j.each(form.serializeArray(), function() {
                data[this.name] = this.value;
            });

            postData.id = data.user_id;
            postData.data = data;
            postData.action = 'edit';

            $j.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                dataType: 'json',
                success:function(data, textStatus, jqXHR) 
                {
                    if (data.success) {
                        datatables.ajax.reload();
                        $j.magnificPopup.close();
                        update_form[0].reset();
                    }else{
                        $j(update_form).find('.panel-body > .alert').remove();
                        $j(update_form).find('.panel-body').prepend(data.message);

                        // animate error entrance
                        var animatedObj = update_form.find('.panel-body > .alert');
                        var x = 'bounceIn';
                        globalhelper.animation(x,animatedObj);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    globalhelper.ajax_error(textStatus);
                }
            });
        };
    }

    // Fn: Delete data
    function delete_data(id,data) {
        var r = confirm("Are you sure want to delete user " + data.user_name + " ?");
        if (r) {
            var formURL = submit_url;
            var postData = {'action':'remove', 'id':id};
            $j.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                dataType: 'json',
                success:function(data, textStatus, jqXHR) 
                {
                    datatables.ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    globalhelper.ajax_error(textStatus);
                }
            });
        }
    }

    // Fn: Delete data
    function delete_selected_rows() {
        var count_selected = table_ID.find('tbody tr.active').length;
        var ids = {};

        $j.each(table_ID.find('tbody tr.active'), function(i) {
            var id = $j(this).attr('id').replace('row-','');
            ids[i] = id;
        })

        var r = confirm("Are you sure want to delete " + count_selected + " rows ?");
        if (r) {
            var formURL = submit_url;
            var postData = {'action':'remove', 'id':ids};
            $j.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                dataType: 'json',
                success:function(data, textStatus, jqXHR) 
                {
                    datatables.ajax.reload();
                    table_ID.parent().find('.dt-panelmenu .DTTT .multiple_del_btn').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    globalhelper.ajax_error(textStatus);
                }
            });
        }
    }


}(jQuery));

</script>