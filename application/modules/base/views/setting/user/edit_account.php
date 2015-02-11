    <div class="pageheader">
      <h2><i class="fa fa-group"></i> Manage Portal</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>dashboard">Pinaple SAS</a></li>
          <li><a href="<?php echo base_url();?>setting/user">Manage User</a></li>
          <li class="active">Edit User Account</li>
        </ol>
      </div>
    </div>


<form id="sasPanel" class="form-horizontal form-bordered" method="POST" action="<?php echo base_url(); ?>setting/user/edit_account_process" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
    <input type="hidden" name="users_id" value="<?php echo $result['user_id'] ?>">
    <input type="hidden" name="old_user_name" value="<?php echo $result['user_name'] ?>">
    <input type="hidden" name="old_user_email" value="<?php echo $result['user_email'] ?>">
    <input type="hidden" name="old_role_id" value="<?php echo $result['role_id'] ?>">
        
    <div class="contentpanel">

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">&times;</a>
            <a href="#" class="minimize">&minus;</a>
          </div>
          <h4 class="panel-title">Edit Account</h4>
          <p>Edit user account information area</p>
        </div>

        <div class="panel-body panel-body-nopadding">
          
          
            <div class="form-group">
              <label class="col-sm-3 control-label">Role *</label>
              <div class="col-sm-5">
                <select class="form-control input-sm mb15" name="role_id" required>
                    <?php foreach ($rs_role as $data) : ?>
                        <option value="<?php echo $data['role_id']; ?>" <?php ($result['role_id'] == $data['role_id']) ? print "selected='selected'" : "" ; ?>><?php echo $data['role_name']; ?></option>
                    <?php endforeach ; ?>
                </select>
              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">Username *</label>
              <div class="col-sm-7">
                <input name="user_name" class="form-control" maxlength="100" type="text" value="<?php echo $result['user_name']; ?>" required />
                <!-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Email *</label>
              <div class="col-sm-7">
                <input name="user_email" class="form-control" maxlength="100" type="text" value="<?php echo $result['user_email']; ?>" required />
                <!-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Status *</label>
              <div class="col-sm-5">
                <select class="form-control input-sm mb15" name="user_st" required>
                    <option value="unlock" <?php ($result['user_st'] == "unlock") ? print "selected='selected'" : "" ; ?>>Unlock</option>
                    <option value="lock" <?php ($result['user_st'] == "lock") ? print "selected='selected'" : "" ; ?>>Lock</option>
                </select>
              </div>
            </div>
          
        </div><!-- panel-body -->
        <div class="panel-footer">
             <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                  <button class="btn btn-primary">Submit</button>&nbsp;
                  <button class="btn btn-default">Cancel</button>
                </div>
             </div>
        </div><!-- panel-footer -->
                
    </div><!-- panel -->      
    </div><!-- panel -->      

          </form>
    
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

<script src="<?php echo base_url();?>bracket/js/jquery.validate.min.js"></script>

<script src="<?php echo base_url();?>bracket/js/custom.js"></script>

<script type="text/javascript">
jQuery("#sasPanel").validate({
  messages: {
    role_id : "User Role is required.",    
    user_name : "User Username is required."
    user_pass : "User Password is required."
    user_email : "User Email is required."
    user_st : "User Status is required."
  },
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    }  
});
</script>


<script>
jQuery(document).ready(function(){
    
  // Chosen Select
  jQuery(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});
  
  // Tags Input
  jQuery('#tags').tagsInput({width:'auto'});
   
  // Textarea Autogrow
  jQuery('#autoResizeTA').autogrow();
  
  // Color Picker
  if(jQuery('#colorpicker').length > 0) {
     jQuery('#colorSelector').ColorPicker({
            onShow: function (colpkr) {
                jQuery(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
                jQuery('#colorpicker').val('#'+hex);
            }
     });
  }
  
  // Color Picker Flat Mode
    jQuery('#colorpickerholder').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            jQuery('#colorpicker3').val('#'+hex);
        }
    });
   
  // Date Picker
  jQuery('#datepicker').datepicker();
  
  jQuery('#datepicker-inline').datepicker();
  
  jQuery('#datepicker-multiple').datepicker({
    numberOfMonths: 3,
    showButtonPanel: true
  });
  
  // Spinner
  var spinner = jQuery('#spinner').spinner();
  spinner.spinner('value', 0);
  
  // Input Masks
  jQuery("#date").mask("99/99/9999");
  jQuery("#phone").mask("(999) 999-9999");
  jQuery("#ssn").mask("999-99-9999");
  
  // Time Picker
  jQuery('#timepicker').timepicker({defaultTIme: false});
  jQuery('#timepicker2').timepicker({showMeridian: false});
  jQuery('#timepicker3').timepicker({minuteStep: 15});

  
});
</script>
