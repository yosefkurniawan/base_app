<script type="text/javascript">
    /* remove menu */
    function remove_menu(menu_id,elm){
        var r = confirm("Anda yakin akan menghapus?");
        if (r == true) {
            $.ajax({
                url:"<?php echo $submit_editor_url ?>",
                type:"POST",
                data: {'action':'remove', 'id': menu_id},
                dataType: 'json',
                success:function(data){
                    if (data.success) {
                        $(elm).closest('li').remove();
                    }else{
                        globalhelper.show_message(data.message,'shake');
                    }
                },
                error: function() {
                    globalhelper.ajax_error(textStatus);
                }
            });
        }
    }
</script>

<!-- Warning information -->
<ul class="fs14 list-unstyled list-spacing-10 mt30 mb20 pl20 pr20 row">
    <li>
        <div class="col-sm-1">
            <i class="fa fa-exclamation-circle text-warning fa-lg pr10"></i>
        </div>
        <div class="col-sm-10">Level maksimum menu yang akan ditampilkan adalah level 3.</div>
    </li>
</ul>

<!-- add button -->
<div class="col-xs-12 pr20 pl20 pb15">
    <a class="add-menu btn btn-danger btn-gradient btn-alt btn-block item-active" data-form-skin="primary"><i class="fa fa-plus mr5"></i>Tambah Menu</a>
</div>

<!-- menu tree -->
<div id="menu-tree" class="pr20 pl20">
    <h4 class="mt5">Struktur Menu</h4>
    <hr class="mtn mrn mln mb10"/>

    <!-- Start: menu tree -->
    <?php /* Start: menu level 0 */ ?>
    <?php if (count($menu_list_all) > 0): ?>
        <ul id="treeData" style="display: none;">
            <?php //echo "<pre>";print_r($menu); ?>
            <?php foreach ($menu_list_all as $level_0): ?>

                <li id="<?php echo $level_0['menu_id'] ?>">
                    <i class="<?php echo $level_0['menu_icon'] ?>"></i>
                    <?php echo $level_0['menu_name'] ?>
                    <i class="fa fa-trash btn-remove" onclick="remove_menu(<?php echo $level_0['menu_id'] ?>,this)"></i>
                
                    <?php /* Start: menu level 1 */ ?>
                    <?php if (count($level_0['child_level_1']) > 0): ?>
                        <ul>
                            <?php foreach ($level_0['child_level_1'] as $level_1): ?>

                            <li id="<?php echo $level_1['menu_id'] ?>">
                                <i class="<?php echo $level_1['menu_icon'] ?>"></i>
                                <?php echo $level_1['menu_name'] ?>
                                <i class="fa fa-trash btn-remove" onclick="remove_menu(<?php echo $level_1['menu_id'] ?>,this)"></i>

                                <?php /* Start: menu level 2 */ ?>
                                <?php if (count($level_1['child_level_2']) > 0): ?>

                                    <ul>
                                        <?php foreach ($level_1['child_level_2'] as $level_2): ?>

                                        <li id="<?php echo $level_2['menu_id'] ?>">
                                            <i class="glyphicons <?php echo $level_2['menu_icon'] ?>"></i> 
                                            <?php echo $level_2['menu_name'] ?> </a>
                                            <i class="fa fa-trash btn-remove" onclick="remove_menu(<?php echo $level_2['menu_id'] ?>,this)"></i>
                                        </li>
                                        <?php endforeach ?>
                                    </ul>
                                    
                                <?php endif ?>
                                <?php /* End: menu level 2 */ ?>
                            </li>

                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                    <?php /* End: menu level 1 */ ?>

                </li>
            
            <?php endforeach ?>
        </ul>
    <?php endif ?>
<!-- End: menu tree -->

</div>
