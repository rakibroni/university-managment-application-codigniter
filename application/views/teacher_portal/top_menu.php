<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

            <div class="navbar-form-custom">
                <h2><?php echo $pageContentTitle; ?></h2>
                <?php if (!empty($breadcrumbs)): ?>
                    <ul class="breadcrumb">
                        <li>You are here</li>
                        <?php
                        foreach ($breadcrumbs as $key => $value):
                            if ($value != '#'):
                                ?>
                                <li><a href="<?php echo site_url("$value"); ?>"><?php echo $key; ?></a></li>
                            <?php else: ?>
                                <li class="active"><?php echo $key; ?></li>
                            <?php
                            endif;
                        endforeach;
                        ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Welcome to KYAU Faculty Portal.</span>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url('auth/trLogout'); ?>">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>

        </ul>

    </nav>
</div>