    <div class="pageheader">
      <h2><i class="fa fa-group"></i> Manage Portal</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>dashboard">Pinaple SAS</a></li>
          <li><a href="<?php echo base_url();?>setting/role">Manage Role</a></li>
          <li class="active">Delete Role</li>
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
          <h4 class="panel-title">Delete Role</h4>
          <p>Are u sure to delete this role ? There will be no way to undo </p>
        </div>
        <form id="sasPanel" class="form-horizontal form-bordered" method="POST" action="<?php echo base_url(); ?>setting/role/delete_process">
        <div class="panel-body panel-body-nopadding">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
            <input type="hidden" name="role_id" value="<?php echo $result['role_id'] ?>">
     
            <div class="form-group">
              <label class="col-sm-3 control-label">Portal Name</label>
              <div class="col-sm-5">
                <select class="form-control input-sm mb15" name="portal_id" disabled>
                    <option value="">-- SELECT --</option>
                    <?php foreach ($rs_portal as $data) : ?>
                        <option value="<?php echo $data['portal_id']; ?>" <?php ($result['portal_id'] == $data['portal_id']) ? print "selected='selected'" : "" ; ?>><?php echo $data['portal_name']; ?></option>
                    <?php endforeach ; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Name *</label>
              <div class="col-sm-7">
                <input name="role_name" class="form-control" maxlength="100" type="text" value="<?php echo $result['role_name']; ?>" disabled />
                <!-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
              </div>
            </div>

           <div class="form-group">
              <label class="col-sm-3 control-label">Description</label>
              <div class="col-sm-7">
                <textarea name="role_desc" class="form-control" rows="5" disabled><?php echo $result['role_desc']; ?></textarea>
                <!-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
              </div>
            </div>

           <div class="form-group">
              <label class="col-sm-3 control-label">Default Url *</label>
              <div class="col-sm-7">
                <input name="role_default_url" class="form-control" maxlength="100" type="text" value="<?php echo $result['role_default_url']; ?>" disabled />
                <!-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
              </div>
            </div>

      <div class="form-group">
              <label class="col-sm-3 control-label">Portal Status</label>
              <div class="col-sm-5">
                <select class="form-control input-sm mb15" name="role_st" disabled>
                    <option value="unlock" <?php ($result['role_st'] == "unlock") ? print "selected='selected'": ""; ?>>Unlock</option>
                    <option value="lock" <?php ($result['role_st'] == "lock") ? print "selected='selected'": ""; ?>>Lock</option>
                </select>
              </div>
            </div>
          
        </div><!-- panel-body -->
        
        <div class="panel-footer">
             <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                  <button class="btn btn-primary">Delete</button>&nbsp;
                  <a href="<?=base_url()?>setting/role" class="btn btn-default">Cancel</a>
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

<script src="<?php echo base_url();?>bracket/js/jquery.validate.min.js"></script>

<script src="<?php echo base_url();?>bracket/js/custom.js"></script>

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