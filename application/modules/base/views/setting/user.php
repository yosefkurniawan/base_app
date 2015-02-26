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
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>        
</div>

<?php echo $this->load->view('user/editor_new') ?>

<!-- Datatables -->
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/media/js/jquery.dataTables.js"></script>
<!-- Datatables Tabletools addon -->
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

<!-- Datatables Bootstrap Modifications  -->
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/media/js/dataTables.bootstrap.js"></script>

<script>

(function($j){

    /* ============================================================ */
    /* Datatables script                                            
    /* ============================================================ */

    $j(document).ready(function() {

        var table = $j('#core_user').DataTable( {
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
                {   "sClass": "center", "bSortable": false, "bSearchable": false, "sWidth": "100px","mData": 0,
                    "mDataProp": function(data, type, full) {
                        return "<div class='btn-group'><button class='edit btn btn-sm btn-default' id='"+data.user_id+"'><icon class='fa fa-pencil'></icon></button><button class='delete btn btn-sm btn-default'id='"+data.user_id+"'><icon class='fa fa-trash-o'></icon></button></div>";
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
                            
                            // Open editor modal
                            $j.magnificPopup.open({
                                removalDelay: 500, //delay removal by X to allow out-animation,
                                items: {
                                    src: '#modal-user-form'
                                },
                                callbacks: {
                                    beforeOpen: function(e) {
                                        var Animation = 'mfp-flipInY';
                                        this.st.mainClass = Animation;
                                    }
                                },
                                midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
                            });
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
                $j(nRow).attr('id', aData.user_id);
            },
            "iDisplayLength": 20
        } );
        
    });

}(jQuery));

</script>
</body>
</html>