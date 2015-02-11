                <!-- Main window -->
                <div class="main_container" id="tables_page">

                    <div class="row-fluid">
                        <ul class="breadcrumb">
                            <li><a>Management Role</a> <span class="divider">/</span></li>
                            <li><a href="<?php echo base_url(); ?>setting/role">Role List</a> <span class="divider">/</span></li>
                            <li class="active">Delete</li>
                        </ul>
                    </div>

                    <div class="row-fluid">
                        <div class="widget widget-padding span12">
                            <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>setting/role/delete_process" onsubmit="return confirm('Do you want to delete the following data?')">
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                <input type="hidden" name="role_id" value="<?php echo $result['role_id'] ?>">
                                <div class="widget-header">
                                    <i class="icon-list-alt"></i><h5>Delete Role</h5>
                                    <div class="widget-buttons">
                                        <a data-title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
                                    </div>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-forms clearfix">
                                        <div class="control-group">
                                            <label class="control-label">Name</label>
                                            <div class="controls">
                                                <input name="role_name" class="span5" maxlength="100" type="text" value="<?php echo $result['role_name']; ?>" disabled />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Description</label>
                                            <div class="controls">
                                                <textarea name="role_desc" class="span7" style="height:250px;" disabled ><?php echo $result['role_desc']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Status</label>
                                            <div class="controls">
                                                <input name="role_st" class="span2" maxlength="100" type="text" value="<?php echo $result['role_st']; ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-footer">
                                    <button class="btn btn-warning" type="submit">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /Main window -->

            </div>
            <!--/.fluid-container-->
        </div>
        <!-- wrap ends-->
