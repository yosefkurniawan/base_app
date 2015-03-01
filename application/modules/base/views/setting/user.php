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

    var table;

    $j(document).ready(function() {

        /* ----------------------------------------- */
        /* Datatables Preparation
        /* ----------------------------------------- */

        table = $j('#core_user').DataTable( {
            "dom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            "ajax": "<?php echo $getdatatables_url ?>",
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
                    }
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
                    var data    = table.row('#row-'+id).data(); 
                    open_edit_form(id,data);
                });

                // bind event "delete" of Delete Button
                $j(this).find('button.btn.delete').click(function(){
                    var id      = $j(this).attr('data-id');
                    var data    = table.row('#row-'+id).data(); 
                    delete_data(id,data);
                });
            }
        } );
    
        /* ----------------------------------------- */
        /* Editor on submit
        /* ----------------------------------------- */

        // create editor on submit
        $j('#create-user-form').submit(function(e){
            e.preventDefault(); //STOP default action
            create_data($j(this));
        })
    
        
        
    });
    
    /* ----------------------------------------- */
    /* Functions
    /* ----------------------------------------- */

    // Fn: Open Create Editor modal
    function open_create_form() {
        $j.magnificPopup.open({
            removalDelay: 500, //delay removal by X to allow out-animation,
            items: {
                src: '#modal-create-user-form'
            },
            callbacks: {
                beforeOpen: function(e) {
                    var Animation = 'mfp-flipInY';
                    this.st.mainClass = Animation;
                },
                beforeClose: function(e) {
                    $j( "#create-user-form" ).validate().settings.removehighlights();
                }
            },
            midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        });
    }

    // Fn: Open Edit Editor modal
    function open_edit_form(id,data) {
        $j.magnificPopup.open({
            removalDelay: 500, //delay removal by X to allow out-animation,
            items: {
                src: '#modal-edit-user-form'
            },
            callbacks: {
                beforeOpen: function(e) {
                    var Animation = 'mfp-flipInY';
                    this.st.mainClass = Animation;
                },
                beforeClose: function(e) {
                    $j( "#edit-user-form" ).validate().settings.removehighlights();
                },
                open: function() {

                    // set current data as default value
                    $j('#user_full_name').val(data.user_full_name);
                    $j('#user_email').val(data.user_email);
                    $j('#user_phone').val(data.user_phone);
                    $j('#user_birthday').val(data.user_birthday);
                    $j('#user_address').val(data.user_address);
                    if (data.user_st == 'active') {
                        $j('#user_st').prop('checked',true);
                    }else{
                        $j('#user_st').prop('checked',false);
                    }
                }
            },
            midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        });
    }

    // Fn: Delete data
    function delete_data(id,data) {
        var r = confirm("Are you sure want to delete user " + data.user_name + " ?");
        if (r) {
            var formURL = '<?php echo base_url()."base/setting/user/submit" ?>';
            var postData = {'action':'remove', 'id':id};
            $j.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR) 
                {
                    console.log('success');
                    console.log(data);
                    table.ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    console.log('fail');
                    console.log(textStatus);
                }
            });
        }
    }

    // Fn: Create data
    function create_data(form) {
        var form = $j(form);
        if (form.valid()) {
                var formURL = '<?php echo base_url()."base/setting/user/submit" ?>';                
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
                    success:function(data, textStatus, jqXHR) 
                    {
                        table.ajax.reload();
                        $j.magnificPopup.close();
                        $j( "#create-user-form" )[0].reset();

                        // form.find("input[type=text], input[type=email], textarea").val("");
                        // form.find("input[type=checkbox]").prop('checked',true);
                    },
                    error: function(jqXHR, textStatus, errorThrown) 
                    {
                        console.log('fail');
                        console.log(textStatus);
                    }
                });
            };
    }


}(jQuery));

</script>
</body>
</html>