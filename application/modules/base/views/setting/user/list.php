<div class="row">
	<div class="col-md-12">
        <div class="panel panel-visible" id="spy4">
            <div class="panel-heading">
                <div class="panel-title hidden-xs">
                    <span class="glyphicon glyphicon-tasks"></span>Datatable Popup Editor</div>
            </div>
            <div class="panel-body pn">
                <table id="example4" class="table fchild-checkbox" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
	                        <th>Full Name</th>
	                        <th>Username</th>
	                        <th>Status</th>
	                        <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
	                	<?php $no = 1; foreach ($rs_user as $result): ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $result['user_full_name']; ?></td>
                                <td><?php echo $result['user_name']; ?></td>
                                <td><?php echo $result['user_st']; ?></td>
                                <td>
                                   <a href="<?php echo base_url(); ?>setting/user/edit_profile/<?php echo $result['user_id']; ?>">
                                    <i class="fa fa-file"></i></a>
                                    &nbsp;&nbsp;
                                   <a href="<?php echo base_url(); ?>setting/user/edit_account/<?php echo $result['user_id']; ?>">
                                    <i class="fa fa-user"></i></a>
                                    &nbsp;&nbsp;	                                                
                                   <a href="<?php echo base_url(); ?>setting/user/edit_password/<?php echo $result['user_id']; ?>">
                                    <i class="fa fa-barcode"></i></a>
                                    &nbsp;&nbsp;
                                   <a href="<?php echo base_url(); ?>setting/user/delete/<?php echo $result['user_id']; ?>">
                                    <i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php $no++; endforeach ; ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>        
</div>

<!-- Datatables -->
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/media/js/jquery.dataTables.js"></script>

<!-- Datatables Tabletools addon -->
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

<!-- Datatables Editor addon - READ LICENSING NOT MIT  -->
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/extensions/Editor/js/dataTables.editor.js"></script>

<!-- Datatables Bootstrap Modifications  -->
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo skin_url() ?>vendor/plugins/datatables/extensions/Editor/js/editor.bootstrap.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
	    
            "use strict";

            // Init Theme Core    
            Core.init();

            // Init Theme Core    
            Demo.init();

            // Init tray navigation smooth scroll
            $('.tray-nav a').smoothScroll({
                offset: -145
            });


            // Custom tray navigation animation
            setTimeout(function() {
                $('.custom-nav-animation li').each(function(i, e) {
                    var This = $(this);
                    var timer = setTimeout(function() {
                        This.addClass('animated zoomIn');
                    }, 100 * i);
                });
            }, 600);

            //////
            // POPUP EDITING EXAMPLE
            //
            var editor4; // use a global for the submit and return data rendering in the examples
            editor4 = new $.fn.dataTable.Editor( {
                ajax: "vendor/plugins/datatables/extensions/Editor/examples/php/staff.php",
                table: "#example4",
                fields: [ {
                        label: "Username:",
                        name: "user_username"
                    }, {
                        label: "Email:",
                        name: "user_email"
                    }, {
                        label: "Password:",
                        name: "user_pass"
                    }, {
                        label: "Reentry Password:",
                        name: "user_repass"
                    }
                ]
            });
         
            $('#example4').on( 'click', 'tbody td', function (e) {
                if ( $(this).index() === 1 ) {
                    editor4.bubble( this, ['first_name', 'last_name'] );
                }
                else if ( $(this).index() > 1 ) {
                    editor4.bubble( this );
                }

                editor4.buttons({ 
                    "label": "Update",
                    "className": "btn btn-primary"
                });

            });
         
            $('#example4').DataTable( {
                dom: '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
                ajax: "vendor/plugins/datatables/extensions/Editor/examples/php/staff.php",
                columns: [
                    { data: null, defaultContent: '', orderable: false },
                    { data: null, render: function ( data, type, row ) {
                        // Combine the first and last names into a single table field
                        return data.first_name+' '+data.last_name;
                    } },
                    { data: "position" },
                    { data: "office" },
                    { data: "start_date" },
                    { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
                ],
                order: [ 1, 'asc' ],
                tableTools: {
                    "sSwfPath": "vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
                    sRowSelect: "os",
                    sRowSelector: 'td:first-child',
                    aButtons: [
                        { sExtends: "editor_create", editor: editor4 },
                        { sExtends: "editor_edit",   editor: editor4 },
                        { sExtends: "editor_remove", editor: editor4 }
                    ]
                }
            });

	})
</script>