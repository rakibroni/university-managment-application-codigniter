<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">
</html><![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en">
</html><![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"></html><![endif]-->
<!--[if gt IE 8]><!-->
<?php
$organization_info=$this->utilities->findByAttribute('sa_organizations', array('STATUS' => 1));
      $ABBR=$organization_info->ABBR;
      $WEBSITE=$organization_info->WEBSITE;
     $ORG_NAME=$organization_info->ORG_NAME;
     $EMAIL=$organization_info->EMAIL;
     $PHONE=$organization_info->PHONE;
     $org_log= base_url('upload/organization/logo/'.$organization_info->LOGO); 
?>
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <title><?php echo $ABBR; ?> | <?php echo $ORG_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Khwaja Yunus Ali University"/>
    <meta name="author" content="ATI Limited"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/Logo_small.ico">
    <!-- CSS Bootstrap & Custom -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- portal.css -->
    <link href="<?php echo base_url(); ?>assets/css/portal.css" rel="stylesheet">
    <!-- end portal.css -->
    <link href="<?php echo base_url(); ?>assets/css/megamenu/yamm.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/megamenu/demo.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/portal/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen"/>
    <link href="<?php echo base_url(); ?>assets/portal/css/font-awesome.min.css" rel="stylesheet" media="screen"/>
    <link href="<?php echo base_url(); ?>assets/portal/css/animate.css" rel="stylesheet" media="screen"/>
    <link href="<?php echo base_url(); ?>assets/portal/style.css" rel="stylesheet" media="screen"/>
    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?php echo base_url(); ?>assets/portal/images/ico/apple-touch-icon-144-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?php echo base_url(); ?>assets/portal/images/ico/apple-touch-icon-114-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?php echo base_url(); ?>assets/portal/images/ico/apple-touch-icon-72-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed"
          href="<?php echo base_url(); ?>assets/portal/images/ico/apple-touch-icon-57-precomposed.png"/>

    <!-- JavaScripts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url();?>assets/Angular/js/angular/angular.min.js"></script>
    <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode">
            <img src="../../../../storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"
            alt=""/></a>
    </div>
    <![endif]-->
</head>
<body>
<?php $this->load->view('template/responsive_menu'); ?>
<!-- /responsive_navigation -->
<header class="site-header">
    <div class="container">
        <div class="row">
            <div class="col-md-4 header-left">
                <p><i class="fa fa-phone"></i> <?php echo $PHONE ?></p>

                <p><i class="fa fa-envelope"></i> <a href="mailto:email@universe.com"><?php echo $EMAIL ?></a></p>
            </div>
            <!-- /.header-left -->

            <div class="col-md-4">
                <div class="logo">
                    <a href="<?php echo site_url('portal/index'); ?>" title="Universe" rel="home">
                        <img style="width:96px" src="<?php echo $org_log?>"
                             alt="Universe"/>
                    </a>
                </div>
                <!-- /.logo -->
            </div>
            <!-- /.col-md-4 -->

            <div class="col-md-4 header-right">
                <ul class="small-links">
                    <li><a href="<?php echo site_url('auth/studentLogin'); ?>">Student Login</a></li>
                    <li><a href="<?php echo site_url('auth/login'); ?>">Administrative Login</a></li>

                </ul>
                <div class="search-form">
                    <form name="search_form" method="get" action="#" class="search_form"/>
                    <input type="text" name="s" placeholder="Search the site..." title="Search the site..."
                           class="field_search"/>
                    </form>
                </div>
            </div>
            <!-- /.header-right -->
        </div>
    </div>
    <!-- /.container -->
    <?php $this->load->view('template/header'); ?>
    <!-- /.nav-bar-main -->
</header>
<!-- /.site-header -->

<!-- Being Page Title -->
<?php if (!empty($breadcrumbs)): ?>
    <div class="container">
        <div class="page-title clearfix">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    foreach ($breadcrumbs as $key => $value):
                        if ($value != '#'):
                            ?>
                            <h6><a href="<?php echo site_url("$value"); ?>"><?php echo $key; ?></a></h6>
                        <?php else: ?>
                            <h6><span class="page-active"><?php echo $key; ?></span></h6>
                        <?php
                        endif;
                    endforeach;
                    ?>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container">
    <div class="row">
        <?php echo $_content; ?>
    </div>
</div>

<!-- begin The Footer -->
<footer class="site-footer">
    <?php $this->load->view('template/footer'); ?>
    <div class="bottom-footer">
        <div class="row">
            <div class="col-md-5">
                <p class="small-text">&copy; Copyright 2014. <?php echo $ABBR ?> designed by <a href="http://atilimited.net">ATI
                        Ltd.</a></p>
            </div>
            <!-- /.col-md-5 -->
            <div class="col-md-7">
                <ul class="footer-nav">
                    <li><a href="<?php echo site_url('portal/index'); ?>">Home</a></li>
                    <li><a href="#">Courses</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Shortcodes</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <!-- /.col-md-7 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.bottom-footer -->

</div> <!-- /.container -->
</footer>
<!-- /.site-footer -->


<script src="<?php echo base_url(); ?>assets/portal/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/portal/js/plugins.js"></script>
<script src="<?php echo base_url(); ?>assets/portal/js/custom.js"></script>


</body>
</html>