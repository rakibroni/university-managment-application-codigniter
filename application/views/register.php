<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Register</title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/Logo_small.ico">
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">IN+</h1>

        </div>
        <h3>Register to IN+</h3>

        <p>Create account to see it in action.</p>

        <form class="m-t" role="form" action="" method="post">
            <div class="form-group">
                <input type="text" name="user_name" value="<?php echo set_value('user_name'); ?>" class="form-control"
                       placeholder="Name">
                <span style="color: red"><?php echo form_error('user_name'); ?></span>
            </div>
            <div class="form-group">
                <input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control"
                       placeholder="Email">
                <span style="color: red"><?php echo form_error('email'); ?></span>
            </div>
            <div class="form-group">
                <input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control"
                       placeholder="Password">
                <span style="color: red"><?php echo form_error('password'); ?></span>
            </div>
            <div class="form-group">
                <div class="checkbox"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
            </div>
            <input type="submit" class="btn btn-primary block full-width m-b" value="Register">

            <p class="text-muted text-center">
                <small>Already have an account?</small>
            </p>
            <a class="btn btn-sm btn-white btn-block" href="<?php echo base_url(); ?>auth/login">Login</a>
        </form>
        <p class="m-t">
            <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
        </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    });
</script>
</body>

</html>
