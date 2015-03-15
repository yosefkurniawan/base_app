
<script>

(function($j){

    // CRUD vars
    var datatables;                                             // will be the datatables
    var table_ID        = $j('#datatable');                     // elm table that will be transformed to datatables
    var datatables_url  = '<?php echo $getdatatables_url ?>';   // submit url for CRUD (be one url)
    var submit_url      = '<?php echo $submit_editor_url ?>';   // submit url for CRUD (be one url)
    var modal_create_ID = '#modal-create-form'             // modal Create-Editor ID
    var modal_edit_ID   = '#modal-update-form'             // modal Update-Editor ID
    var create_form     = $j( "#create-form" );            // Create form
    var update_form     = $j( "#update-form" );            // Update form

    // instance helper
    globalhelper = new GlobalHelper();

    $j(document).ready(function() {

        /* ----------------------------------------- */
        /* Datatables Preparation
        /* ----------------------------------------- */

        datatables = table_ID.DataTable( {
            "dom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            "ajax": datatables_url,
            "columns": [
                {
                    "data": "role_name"
                },
                {
                    "data": "role_desc"
                },
                {
                    "data": "portal_name"
                },
                {
                    "data": "role_default_url"
                },
                {   
                    "mDataProp": function(data, type, full) {
                        if (data.role_st=='active')
                            return "<div class='tm-tag tm-tag-success text-center'><i class='fa fa fa-check pr5'></i><b>"+data.role_st+"</b></div>";
                        else if (data.role_st=='deleted')
                            return "<div class='tm-tag tm-tag-danger text-center'><i class='fa fa-times-circle pr5'></i><b>"+data.role_st+"</b></div>";
                        else if (data.role_st=='inactive')
                            return "<div class='tm-tag text-center'><i class='fa fa-minus-circle pr5'></i><b>"+data.role_st+"</b></div>";
                        else 
                            return "<div class='tm-tag text-center'>undefined</div>";
                    }
                },
                {   "sClass": "center", "bSortable": false, "bSearchable": false, "sWidth": "100px","mData": 0,
                    "mDataProp": function(data, type, full) {
                        var id = data.role_id;
                        if (data.role_st!='deleted')
                            return "<div class='btn-group'><button class='permission btn btn-sm btn-default' data-id='"+id+"' id='permission-"+id+"' data-toggle='tooltip' data-placement='top' title='' data-original-title='Permission'><icon class='fa fa-key'></icon></button>"+
                                    "<div class='btn-group'><button class='edit btn btn-sm btn-default' data-id='"+id+"' id='edit-"+id+"' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit'><icon class='fa fa-pencil'></icon></button>"+
                                    "<button class='delete btn btn-sm btn-default' data-id='"+id+"' id='delete-"+id+"' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete'><icon class='fa fa-trash-o'></icon></button></div>";
                        else
                            return "";
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
                $j(nRow).attr('id', 'row-'+aData.role_id);
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

                // bind event "click" of Permission Button
                $j(this).find('button.btn.permission').click(function(){
                    var id      = $j(this).attr('data-id');
                    var data    = datatables.row('#row-'+id).data();
                    open_permission_form(data);
                });

                // init tooltip on button
                table_ID.find('button').tooltip({trigger: 'hover','placement': 'top'});
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

        // Edit-editor on submit
        $j('#permission-form').submit(function(e){
            e.preventDefault(); //STOP default action
            permission_save($j(this));
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
                    $j(create_form).validate().settings.removehighlights($j(create_form));
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
                    $j(update_form).validate().settings.removehighlights($j(update_form));
                    $j(update_form).find('.panel-body > .alert').remove();
                },
                open: function() {

                    // set current data as default value
                    $j(update_form).find('#role_id').val(data.role_id);
                    $j(update_form).find('#role_name').val(data.role_name);
                    $j(update_form).find('#role_desc').val(data.role_desc);
                    $j(update_form).find('#portal_id').val(data.portal_id);
                    $j(update_form).find('#role_default_url').val(data.role_default_url);
                    if (data.role_st == 'active') {
                        $j(update_form).find('#role_st').prop('checked',true);
                    }else{
                        $j(update_form).find('#role_st').prop('checked',false);
                    }

                }
            },
            midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        });
    }

    // Fn: Open Edit Permission modal
    function open_permission_form(data) {
        $j.magnificPopup.open({
            removalDelay: 500, //delay removal by X to allow out-animation,
            items: {
                src: '#modal-permission-form'
            },
            callbacks: {
                beforeOpen: function(e) {
                    var Animation = 'mfp-flipInY';
                    this.st.mainClass = Animation;
                },
                beforeClose: function(e) {
                    $j(update_form).validate().settings.removehighlights($j(update_form));
                    $j(update_form).find('.panel-body > .alert').remove();
                },
                open: function() {

                    $j('#modal-permission-form .panel-title .role-name').text(data.role_name);
                    $j('#permission-form #role_id').val(data.role_id);

                    $j.ajax({
                        url : '<?php echo base_url()."admin/user_management/role/get_permission_by_role" ?>',
                        type: "GET",
                        data : {'role_id':data.role_id},
                        dataType: 'html',
                        success:function(data, textStatus, jqXHR) 
                        {
                            $j('#table-permission tbody').html(data);
                        },
                        error: function(jqXHR, textStatus, errorThrown) 
                        {
                            globalhelper.ajax_error(textStatus);
                        }
                    });

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

            postData.id = data.role_id;
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

    // Fn: save permission
    function permission_save(form) {
        var form = $j(form);
        if (form.valid()) {
            var formURL = '<?php echo base_url()."admin/user_management/role/permission_save" ?>';
            var postData = {};

            // var data = {};
            // $j.each(form.serializeArray(), function() {
            //     data[this.name] = this.value;
            // });

            var data = $j('#permission-form input[name^=permission]').serializeFullArray()

            postData.id = $j('#permission-form #role_id').val();
            postData.data = data.permission;
            console.log(data);

            $j.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                dataType: 'json',
                success:function(data, textStatus, jqXHR) 
                {
                    if (data.success) {
                        $j.magnificPopup.close();
                        form[0].reset();
                        $j('#content > .alert').remove();
                        $j('#content').prepend(data.message);
                        globalhelper.scrollTo($j('body'));
                    }else{
                        $j(form).find('.panel-body > .alert').remove();
                        $j(form).find('.panel-body').prepend(data.message);

                        // animate error entrance
                        var animatedObj = form.find('.panel-body > .alert');
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
        var r = confirm("Are you sure want to delete <?php echo strtolower($crud_for) ?> " + data.role_name + " ?");
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
                    if (data.success) {
                        datatables.ajax.reload();
                    }else{
                        globalhelper.show_message(data.message,'shake');
                    }
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