<aside id="sidebar_left" class="nano nano-primary">
    <div class="nano-content">

        <!-- Start: Sidebar Header -->
        <header class="sidebar-header">
            <div class="user-menu">
                <div class="row text-center mbn">
                    <div class="col-xs-4">
                        <a href="dashboard.html" class="text-primary" data-toggle="tooltip" data-placement="top" title="Dashboard">
                            <span class="glyphicons glyphicons-home"></span>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="pages_messages.html" class="text-info" data-toggle="tooltip" data-placement="top" title="Messages">
                            <span class="glyphicons glyphicons-inbox"></span>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="pages_profile.html" class="text-alert" data-toggle="tooltip" data-placement="top" title="Tasks">
                            <span class="glyphicons glyphicons-bell"></span>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="pages_timeline.html" class="text-system" data-toggle="tooltip" data-placement="top" title="Activity">
                            <span class="glyphicons glyphicons-imac"></span>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="pages_profile.html" class="text-danger" data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicons glyphicons-settings"></span>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="pages_gallery.html" class="text-warning" data-toggle="tooltip" data-placement="top" title="Cron Jobs">
                            <span class="glyphicons glyphicons-restart"></span>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <!-- End: Sidebar Header -->

        <!-- sidebar menu -->
        <?php /* Start: menu level 0 */ ?>
        <?php if (count($menu) > 0): ?>
        <ul class="nav sidebar-menu">
            
            <?php foreach ($menu as $level_0): ?>

                <li class="sidebar-label pt20"><?php echo $level_0['menu_name'] ?></li>
                
                <?php /* Start: menu level 1 */ ?>
                <?php if (count($level_0['child_level_1'])): ?>
                    
                    <?php foreach ($level_0['child_level_1'] as $level_1): ?>

                    <?php  
                        // active menu checking
                        
                        $path       = (isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '';
                        $menu_path  = $level_1['menu_url'];

                        if (substr($path, 0, 1) == '/') {
                            $path = substr($path, 1, strlen($path));
                        }

                        if (substr($menu_path, 0, 1) == '/') {
                            $menu_path = substr($menu_path, 1, strlen($menu_path));
                        }

                        if (substr($path, strlen($path)-1, strlen($path)) == '/') {
                            $path = substr($path, 0, strlen($path)-1);
                        }

                        if (substr($menu_path, strlen($menu_path)-1, strlen($menu_path)) == '/') {
                            $menu_path = substr($menu_path, 0, strlen($menu_path)-1);
                        }

                        if ($menu_path == $path) {
                            $activeClass = 'class="active"';
                        }else{
                            $activeClass = '';
                        }
                    ?>

                    <li <?php echo $activeClass ?>>
                        <?php
                            if (!empty($level_1['child_level_2'])) {
                                $menu_class = 'accordion-toggle';
                                $menu_url   = '#';
                                $menu_collapse_icon = '<span class="caret"></span>';
                            }else{
                                $menu_class = '';
                                $menu_url   = base_url().$level_1['menu_url'];
                                $menu_collapse_icon = '';
                            }
                        ?>
                        <a href="<?php echo $menu_url ?>" class="<?php echo $menu_class; ?>">
                            <span class="<?php echo $level_1['menu_icon'] ?>"></span>
                            <span class="sidebar-title"><?php echo $level_1['menu_name'] ?></span>
                            <?php echo $menu_collapse_icon ?>
                        </a>

                        <?php /* Start: menu level 2 */ ?>
                        <?php if (count($level_1['child_level_2'])): ?>

                            <ul class="nav sub-nav">
                                <?php foreach ($level_1['child_level_2'] as $level_2): ?>

                                <?php  
                                    // active menu checking
                                    
                                    $path       = (isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '';
                                    $menu_path  = $level_2['menu_url'];

                                    if (substr($path, 0, 1) == '/') {
                                        $path = substr($path, 1, strlen($path));
                                    }
                                    if (substr($menu_path, 0, 1) == '/') {
                                        $menu_path = substr($menu_path, 1, strlen($menu_path));
                                    }
                                    if (substr($path, strlen($path)-1, strlen($path)) == '/') {
                                        $path = substr($path, 0, strlen($path)-1);
                                    }
                                    if (substr($menu_path, strlen($menu_path)-1, strlen($menu_path)) == '/') {
                                        $menu_path = substr($menu_path, 0, strlen($menu_path)-1);
                                    }

                                    if ($menu_path == $path) {
                                        $activeClass = 'class="active"';
                                    }else{
                                        $activeClass = '';
                                    }
                                ?>

                                <li>
                                    <a href="<?php echo base_url().$level_2['menu_url'] ?>">
                                        <span class="glyphicons <?php echo $level_2['menu_icon'] ?>"></span> <?php echo $level_2['menu_name'] ?> </a>
                                </li>
                                <?php endforeach ?>
                            </ul>
                            
                        <?php endif ?>
                        <?php /* End: menu level 2 */ ?>

                    </li>

                    <?php endforeach ?>

                <?php endif ?>
                <?php /* End: menu level 1 */ ?>
            
            <?php endforeach ?>
        </ul>

        <script type="text/javascript">
            jQuery(document).ready(function() {

                // set parent menu as activer as well while the child is active
                jQuery('ul.sidebar-menu ul.sub-nav > li').each(function() {
                    if(jQuery(this).hasClass('active')) {
                        jQuery(this).parent().parent().addClass('active');
                    }
                })
            })
        </script>

        <?php endif ?>
        <?php /* End: menu level 0 */ ?>

        <div class="sidebar-toggle-mini">
            <a href="#">
                <span class="fa fa-sign-out"></span>
            </a>
        </div>
    </div>
</aside>