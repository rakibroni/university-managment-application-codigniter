<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eUMS |Student Forgot Password </title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/Logo_small.ico">

</head>

<body class="gray-bg">

<div class="loginColumns animated fadeInDown">
    <div class="row">
        <center>
            <img style=" border-radius: 3px;margin-bottom: 50px;padding: 0px ;"
                 src="<?php echo base_url(); ?>assets/img/logo/kyau_web.png">
        </center>

    </div>
    <div class="row">
        <div class="col-md-6">
            <h3 class="font-bold" style="color: green">Welcome to KYAU</h3>


            <p>
                Sign in with your organizational id number.
            </p>

            <p>
                This student panel is only applicable for Khawaja Yunus Ali University students.
            </p>

            <p>
                <small>Please enter your user name and password and click login button to login in here.</small>
            </p>

        </div>
        <div class="col-md-6">
            <h3 class="font-bold" style="color: green">Student Forgot Password</h3>

            <div class="ibox-content">
                <?php if (validation_errors() != ''): ?>
                    <div class="alert alert-danger">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <form class="m-t" role="form" action="" method="post">
                    <div class="form-group">
                        <input type="text" name="stu_reg_no" value="<?php echo set_value('stu_reg_no'); ?>"
                               class="form-control" placeholder="Registration No." required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="stu_user_email" value="<?php echo set_value('stu_user_email'); ?>"
                               class="form-control" placeholder="Email" required="">
                    </div>
                    <div class="form-group">
                        <input type="text" maxlength="4" size="4" name="stu_mobile" value="<?php echo set_value('stu_mobile'); ?>"
                               class="form-control" placeholder="Last 4 digit of phone number" required>
                    </div>
                    <input type="submit" class="btn btn-primary block full-width m-b" value="Submit">
<!--                    <a href="#">-->
<!--                        <small>Forgot password?</small>-->
<!--                    </a>-->
                </form>

            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong>
                <small> © 2013 - <?php echo date('Y'); ?>   All Rights Reserved | <a href="http://www.kyau.edu.bd/">Khwaja
                        Yunus Ali University.</a></small>
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
