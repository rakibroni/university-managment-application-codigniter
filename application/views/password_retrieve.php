<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eUMS | Forgot Password </title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/Logo_small.ico">
</head>
<?php
     $WEBSITE=$organization_info->WEBSITE;
     $ORG_NAME=$organization_info->ORG_NAME;
     $org_log= base_url('upload/organization/logo/'.$organization_info->LOGO); 
     ?>
<body class="gray-bg">
<div class="loginColumns animated fadeInDown">
    <div class="row">
        <center>
            <img style=" border-radius: 3px;margin-bottom: 50px;padding: 0px ; width: 150px;"
                 src="<?php echo $org_log ?>">
        </center>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3 class="font-bold" style="color: green">Welcome to University Management System</h3>

            <p> Use a valid user name and password to gain access to the administrator back-end.</p>

            <p> This admin panel is only applicable for <?php echo $ORG_NAME ?> administration section. </p>

            <p>
                <small>Please enter your user name and password and click login button to login in here.</small>
            </p>
        </div>
        <div class="col-md-6">
            <h3 class="font-bold" style="color: green">Forgot Password</h3>

            <div class="ibox-content">
                <?php if (validation_errors() != ''): ?>
                    <div class="alert alert-danger">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <form class="m-t" role="form" action="" method="post">
                    <div class="form-group">
                        <input type="email" name="user_email" value="<?php echo set_value('user_email'); ?>"
                               class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" maxlength="4" size="4" name="mobile_digit" value="<?php echo set_value('mobile_digit'); ?>"
                               class="form-control" placeholder="Last 4 digit of phone number" required>
                    </div>
                    <input type="submit" class="btn btn-primary block full-width m-b" value="Submit">
                </form>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong>
                <small> © 2013 - <?php echo date('Y'); ?> All Rights Reserved | <a href="<?php echo $WEBSITE ?>"><?php echo $ORG_NAME ?></a></small>
            </strong>
        </div>
        <div class="col-md-6 text-right">
            <strong>
                <small> Developed By
                    <a target="_blank" href="http://www.atilimited.net">
                        <span style="color: red;">ATI</span>
                        <span style="color: green;">Limited</span>
                    </a>
                </small>
            </strong>
        </div>
    </div>
</div>

</body>

</html>
