    <div class="pageheader">
      <h2><i class="fa fa-group"></i> Manage Permission</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>dashboard">Pinaple SAS</a></li>
          <li><a href="<?php echo base_url();?>setting/permission">Manage Permission</a></li>
          <li class="active">Edit Permission</li>
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
          <h4 class="panel-title">Edit Permission</h4>
          <p>Edit permission area</p>
        </div>
        <div class="panel-body panel-body-nopadding">

        <form class="form-horizontal bordered" method="POST" action="<?php echo base_url(); ?>setting/permission/edit_process">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
            <input type="hidden" name="role_id" value="<?php echo $result['role_id'] ?>">
            
<div class="col-md-12">
          <div class="table-responsive">
          <table class="table table-striped mb30">
            <thead>
              <tr>
                <th style="width:30%">Menu</th>
                <th style="width:10%">Create</th>
                <th style="width:10%">Read</th>
                <th style="width:10%">Update</th>
                <th style="width:10%">Delete</th>
              </tr>
            </thead> 
            <tbody>
                <?php foreach ($rs_menu as $data) : ?>
                <tr>
                    <td>
                        <label style="text-align:left;" class="control-label"><b><input type="checkbox" class="all" value="<?php echo $data['menu_id']; ?>" style="margin-top:-2px;" <?php ($data['permission'] != "") ? print "checked='checked'" : "" ; ?> hidden /> + <?php echo $data['menu_name']; ?></b></label>
                    </td>
                    <td>
                        <label style="text-align:center;" class="control-label"><input name="permission[<?php echo $data['menu_id']; ?>][1]" class="menu<?php echo $data['menu_id']; ?>" type="checkbox" <?php (substr($data['permission'], 0, 1) == "1") ? print "checked='checked'" : "" ; ?> /></label>
                    </td>
                    <td>
                        <label style="text-align:center;" class="control-label"><input name="permission[<?php echo $data['menu_id']; ?>][2]" class="menu<?php echo $data['menu_id']; ?>" type="checkbox" <?php (substr($data['permission'], 1, 1) == "1") ? print "checked='checked'" : "" ; ?> /></label>
                    </td>
                    <td>
                        <label style="text-align:center;" class="control-label"><input name="permission[<?php echo $data['menu_id']; ?>][3]" class="menu<?php echo $data['menu_id']; ?>" type="checkbox" <?php (substr($data['permission'], 2, 1) == "1") ? print "checked='checked'" : "" ; ?> /></label>
                    </td>
                    <td>
                        <label style="text-align:center;" class="control-label"><input name="permission[<?php echo $data['menu_id']; ?>][4]" class="menu<?php echo $data['menu_id']; ?>" type="checkbox" <?php (substr($data['permission'], 3, 1) == "1") ? print "checked='checked'" : "" ; ?> /></label>
                    </td>
                </tr>
                    <?php if (!empty($data['detail'])) : foreach ($data['detail'] as $value) : ?>
                    <tr>
                        <td>
                            <label style="text-align:left;" class="control-label"><b><input type="checkbox" class="sub" value="<?php echo $value['menu_id']; ?>" style="margin-top:-2px;" <?php ($value['permission'] != "") ? print "checked='checked'" : "" ; ?> /> &nbsp;&nbsp;&nbsp;- <?php echo $value['menu_name']; ?></b></label>
                        </td>
                        <td>
                            <label style="text-align:center;" class="control-label"><input name="permission[<?php echo $value['menu_id']; ?>][1]" class="menu<?php echo $value['menu_id']; ?>" type="checkbox" <?php (substr($value['permission'], 0, 1) == "1") ? print "checked='checked'" : "" ; ?> /></label>
                        </td>
                        <td>
                            <label style="text-align:center;" class="control-label"><input name="permission[<?php echo $value['menu_id']; ?>][2]" class="menu<?php echo $value['menu_id']; ?>" type="checkbox" <?php (substr($value['permission'], 1, 1) == "1") ? print "checked='checked'" : "" ; ?> /></label>
                        </td>
                        <td>
                            <label style="text-align:center;" class="control-label"><input name="permission[<?php echo $value['menu_id']; ?>][3]" class="menu<?php echo $value['menu_id']; ?>" type="checkbox" <?php (substr($value['permission'], 2, 1) == "1") ? print "checked='checked'" : "" ; ?> /></label>
                        </td>
                        <td>
                            <label style="text-align:center;" class="control-label"><input name="permission[<?php echo $value['menu_id']; ?>][4]" class="menu<?php echo $value['menu_id']; ?>" type="checkbox" <?php (substr($value['permission'], 3, 1) == "1") ? print "checked='checked'" : "" ; ?> /></label>
                        </td>
                    </tr>
                    <?php endforeach ; endif ; ?>
                <?php endforeach ; ?>

            </tbody>
          </table>
          </div><!-- table-responsive -->
        </div>
          
        </div><!-- panel-body -->
        
        <div class="panel-footer">
             <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                  <button class="btn btn-primary">Submit</button>&nbsp;
                  <a class="btn btn-default" href="<?=base_url()?>setting/permission">Cancel</a>
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

<script type="text/javascript">
jQuery("#sasPanel").validate({
  messages: {
    portal_name : "Portal Name is required.",
    portal_title : "Portal Title is required.",    
    portal_desc : "Portal Description is required."
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

