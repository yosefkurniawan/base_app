<!-- Start: Topbar-Dropdown -->
    <div id="topbar-dropmenu">
        <div class="topbar-menu row">
            <div class="col-xs-4 col-sm-2">
                <a href="#" class="metro-tile bg-success">
                    <span class="metro-icon glyphicons glyphicons-inbox"></span>
                    <p class="metro-title">Messages</p>
                </a>
            </div>
            <div class="col-xs-4 col-sm-2">
                <a href="#" class="metro-tile bg-info">
                    <span class="metro-icon glyphicons glyphicons-parents"></span>
                    <p class="metro-title">Users</p>
                </a>
            </div>
            <div class="col-xs-4 col-sm-2">
                <a href="#" class="metro-tile bg-alert">
                    <span class="metro-icon glyphicons glyphicons-headset"></span>
                    <p class="metro-title">Support</p>
                </a>
            </div>
            <div class="col-xs-4 col-sm-2">
                <a href="#" class="metro-tile bg-primary">
                    <span class="metro-icon glyphicons glyphicons-cogwheels"></span>
                    <p class="metro-title">Settings</p>
                </a>
            </div>
            <div class="col-xs-4 col-sm-2">
                <a href="#" class="metro-tile bg-warning">
                    <span class="metro-icon glyphicons glyphicons-facetime_video"></span>
                    <p class="metro-title">Videos</p>
                </a>
            </div>
            <div class="col-xs-4 col-sm-2">
                <a href="#" class="metro-tile bg-system">
                    <span class="metro-icon glyphicons glyphicons-picture"></span>
                    <p class="metro-title">Pictures</p>
                </a>
            </div>
        </div>
    </div>
    <!-- End: Topbar-Dropdown -->

    <!-- Start: Topbar -->
    <header id="topbar">
        <div class="topbar-left">
            <?php echo $this->load->view('base/page/html/breadcrumbs') ?>
        </div>
        <div class="topbar-right">
            <div class="ib topbar-dropdown">
                <label for="topbar-multiple" class="control-label pr10 fs11 text-muted">Reporting Period</label>
                <select id="topbar-multiple" class="hidden" multiple="multiple">
                    <optgroup label="Filter By:">
                        <option value="1-1">Last 30 Days</option>
                        <option value="1-2" selected="selected">Last 60 Days</option>
                        <option value="1-3">Last Year</option>
                    </optgroup>
                </select>
            </div>
            <div class="ml15 ib va-m" id="toggle_sidemenu_r">
                <a href="#" class="pl5"> <i class="fa fa-sign-in fs22 text-primary"></i>
                    <span class="badge badge-hero badge-danger">3</span>
                </a>
            </div>
        </div>
    </header>
    <!-- End: Topbar -->