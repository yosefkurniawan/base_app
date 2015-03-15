
<div class="panel panel-visible" id="module-conf">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"><i class="fa fa-puzzle-piece"></i><?php echo $page_title ?>
            </span>
        </div>
        <!-- end .form-header section -->

            <div class="panel-body p25 admin-form">
                
                <div class="panel-group accordion" id="module-conf">

                <!-- module list -->
                <?php foreach ($modules_list as $module): ?>
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="col-sm-10">
                                <div class="accordion-toggle accordion-icon link-unstyled" data-toggle="collapse" href="#accord_<?php echo $module['module_id']; ?>" >
                                    <?php echo $module['module_name'] ?>
                                </div>
                            </div>
                            <div class="col-sm-2 text-right">
                                <label for="<?php echo $module['module_id']; ?>" class="block switch switch-primary">
                                    <?php $checked = ($module['module_st'])? 'checked' : '';?>
                                    <input type="checkbox" name="<?php echo $module['module_id']; ?>" id="<?php echo $module['module_id']; ?>" value="1" <?php echo $checked ?>>
                                    <label for="<?php echo $module['module_id']; ?>" data-on="ON" data-off="OFF"></label>
                                </label>
                            </div>
                        </div>
                        <div id="accord_<?php echo $module['module_id']; ?>" class="panel-collapse collapse in">
                            <div class="panel-body list-on-of"> 
                                
                                <!-- sub module list -->
                                <?php foreach ($module['sub_module'] as $sub_module_id => $sub_module): ?>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <label><?php echo $sub_module['module_name'] ?></label>
                                        </div>
                                        <div class="col-sm-2 text-right p0">
                                            <label for="<?php echo $sub_module['module_id']; ?>" class="block switch switch-primary">
                                                <?php $checked = ($sub_module['module_st'])? 'checked' : '';?>
                                                <input type="checkbox" name="<?php echo $sub_module['module_id']; ?>" id="<?php echo $sub_module['module_id']; ?>" value="1" <?php echo $checked ?>>
                                                <label for="<?php echo $sub_module['module_id']; ?>" data-on="ON" data-off="OFF"></label>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                     </div>
                <?php endforeach ?>

              </div>

            </div>
    <!-- end .admin-form section -->
</div>

<script type="text/javascript">
    (function($j){
        
        // instance helper
        globalhelper = new GlobalHelper();

        $j(document).ready(function() {
            $j('#module-conf label.switch label').each(function() {
                $j(this).click(function() {
                    var elm     = $j(this).parent().find('input[type=checkbox]');
                    var id      = elm.attr('name');
                    var checked = elm.is(':checked');

                    if (checked) {
                        var value = 0
                    }else{
                        var value = 1
                    }
                    
                    console.log(value);

                    $j.ajax({
                        url : '<?php echo $submit_url ?>',
                        type: "POST",
                        data : {'id':id,'value':value},
                        dataType: 'json',
                        beforeSend: function() {
                            elm.closest('label.switch').before('<span class="loading" style="margin-right:15px;"><img src="<?php echo skin_url("assets/img/loaders/loader10.gif") ?>" width="15px"/></span>');
                        },
                        success:function(data, textStatus, jqXHR) 
                        {
                            if (!data.success) {
                                globalhelper.show_message(data.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) 
                        {
                            globalhelper.ajax_error(textStatus);
                        },
                        complete: function() {
                            elm.closest('label.switch').parent().find('.loading').remove();
                        }
                    });
                })
            })
        })

    })(jQuery)
</script>