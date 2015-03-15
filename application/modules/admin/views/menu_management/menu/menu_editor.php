<?php //echo '<pre>';print_r($menu_list_all); ?>
<div class="admin-form panel panel-danger panel-border top mb30" id="form-menu-panel" style="display:none;">
    <form method="post" id="form-menu" action="<?php echo $submit_editor_url ?>">
        <input type="hidden" name="action" id="action" value="create" />
        <input type="hidden" name="menu_id" id="menu_id" value="" />
        
        <div class="panel-heading">
            <span class="panel-title"></i>Editor Menu</span>
        </div>

        <div class="panel-body bg-light">
                        
                <div class="section">
                    <label for="menu_name" class="field-label">Nama Menu <em>*</em></label>
                    <label for="menu_name" class="field prepend-icon">
                        <input type="text" name="menu_name" id="menu_name" class="gui-input" placeholder="Nama Menu...">
                        <label for="menu_name" class="field-icon"><i class="fa fa-tag"></i></label>
                    </label>
                </div>

                <div class="section">
                    <label for="parent_id" class="field-label">Menu Induk <em>*</em></label>
                    <label for="parent_id" class="field prepend-icon select">
                        <select name="parent_id" id="parent_id" class="gui-input">
                            <option value="">-- Pilih Induk Menu --</option>
                            <option value="0">Akar menu</option>
                            <?php foreach ($menu_list_all as $key => $value): ?>
                                <option value="<?php echo $value['menu_id'] ?>"><?php echo $value['menu_name'] ?></option>
                                <?php if (isset($value['child_level_1']) && !empty($value['child_level_1'])): ?>
                                    <?php foreach ($value['child_level_1'] as $key2 => $value2): ?>
                                        <option value="<?php echo $value2['menu_id'] ?>">- <?php echo $value2['menu_name'] ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <i class="arrow"></i>
                        <label for="parent_id" class="field-icon"><i class="fa fa-sitemap"></i>
                        </label>
                    </label>
                </div>

                <div class="section">
                    <label for="portal_id" class="field-label">Portal <em>*</em></label>
                    <label for="portal_id" class="field prepend-icon select">
                        <select name="portal_id" id="portal_id" class="gui-input">
                            <option value="">-- Pilih Portal --</option>
                            <?php foreach ($portal_list as $key => $value): ?>
                                <option value="<?php echo $value['portal_id'] ?>"><?php echo $value['portal_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <i class="arrow"></i>
                        <label for="portal_id" class="field-icon"><i class="fa fa-flag"></i>
                        </label>
                    </label>
                </div>

                <div class="section">
                    <label for="menu_desc" class="field-label">Deskripsi <em>*</em></label>
                    <label for="menu_desc" class="field prepend-icon">
                        <textarea class="gui-textarea" id="menu_desc" name="menu_desc" placeholder="Deskripsi..."></textarea>
                        <label for="menu_desc" class="field-icon"><i class="fa fa-info-circle"></i>
                        </label>
                    </label>
                </div>

                <div class="section">
                    <label for="menu_url" class="field-label">Url</label>
                    <label for="menu_url" class="field prepend-icon">
                        <input type="text" name="menu_url" id="menu_url" class="gui-input" placeholder="Url Menu...">
                        <label for="menu_url" class="field-icon"><i class="fa fa-chain"></i></label>
                    </label>
                </div>

                <div class="section">
                    <label for="menu_icon" class="field-label">Ikon</label>
                    <label for="menu_icon" class="field prepend-icon">
                        <input type="text" name="menu_icon" id="menu_icon" class="gui-input" placeholder="Class Ikon...">
                        <label for="menu_icon" class="field-icon"><i class="fa fa-smile-o"></i></label>
                    </label>
                </div>

                <div class="section">
                    <label for="menu_st" class="field-label">Status <em>*</em></label>
                    <label for="menu_st" class="block mt15 switch switch-primary">
                        <input type="hidden" name="menu_st" id="menu_st_alt" value="inactive">
                        <input type="checkbox" name="menu_st" id="menu_st" value="active">
                        <label for="menu_st" data-on="ON" data-off="OFF"></label>
                    </label>
                </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="button btn-primary">Simpan</button>
            <span class="loading p10 invisible"><img src="<?php echo skin_url('assets/img/loaders/loader9.gif') ?>"/></span>
        </div>
    </form>
</div>