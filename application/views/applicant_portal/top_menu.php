<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

            <div role="search" class="navbar-form-custom" action="search_results.html">
                <div style="padding: 12px">
                    <h4 style="margin:0px !important;padding: 0px !important;"><b><?php echo $pageContentTitle; ?></b></h4>
                    <?php if (!empty($breadcrumbs)): ?>
                        <ul class="breadcrumb">

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
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span
                    class="m-r-sm text-muted welcome-message"></span>
            </li>



            <li>
            
                <a href="<?php echo site_url('Applicant/logout'); ?>">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>

        </ul>

    </nav>
</div>
