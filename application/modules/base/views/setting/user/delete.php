    <div class="pageheader">
      <h2><i class="fa fa-group"></i> Manage User</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>dashboard">Pinaple SAS</a></li>
          <li><a href="<?php echo base_url();?>setting/user">Manage User</a></li>
          <li class="active">Delete User</li>
        </ol>
      </div>
    </div>
        
    <div class="contentpanel">
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">&times;</a>
            <a href="#" class="minimize">&minus;</a>
          </div>
          <h4 class="panel-title">Delete Portal</h4>
          <p>Delete portal area</p>
        </div>
        <div class="panel-body panel-body-nopadding">



        <form class="form-horizontal form-bordered" method="POST" action="<?php echo base_url(); ?>setting/user/delete_process" enctype="multipart/form-data" onsubmit="return confirm('Do you want to delete the following data?')">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
            <input type="hidden" name="users_id" value="<?php echo $result['user_id'] ?>">
            
            <div class="form-group">
              <label class="col-sm-3 control-label">Name</label>
              <div class="col-sm-7">
                <input name="user_name" class="form-control" maxlength="100" type="text" value="<?php echo $result['user_name']; ?>" disabled />
                <!-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">Address</label>
              <div class="col-sm-7">
                <input name="user_email" class="form-control" maxlength="100" type="text" value="<?php echo $result['user_email']; ?>" disabled />
                <!-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Status</label>
              <div class="col-sm-7">
                <input name="user_st" class="form-control" maxlength="100" type="text" value="<?php echo $result['user_st']; ?>" disabled />
                <!-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
              </div>
            </div>
          
        </div><!-- panel-body -->
        
        <div class="panel-footer">
             <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                  <button class="btn btn-warning">Delete</button>&nbsp;
                  <a href="<?php echo base_url() ?>setting/portal" class="btn btn-default">Cancel</a>
                </div>
             </div>
          </div><!-- panel-footer -->

          </form>
        
      </div><!-- panel -->      
    </div><!-- contentpanel -->
    
<script src="<?php echo base_url();?>bracket/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/modernizr.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/toggles.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/retina.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/jquery.cookies.js"></script>

<script src="<?php echo base_url();?>bracket/js/jquery.autogrow-textarea.js"></script>
<script src="<?php echo base_url();?>bracket/js/bootstrap-fileupload.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>bracket/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/dropzone.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/colorpicker.js"></script>


<script src="<?php echo base_url();?>bracket/js/custom.js"></script>
