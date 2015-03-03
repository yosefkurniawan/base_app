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
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
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


<?php echo $this->load->view('user/crud_js') ?>

<script>

(function($j){

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
        
    });
    
}(jQuery));

</script>