<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eUMS | Parents Registration</title>

    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
    <style>
        label.valid {
            height: 0px !important;
        }
    </style>


</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div class="row">
            <center>
                <img style=" width:80px; border-radius: 3px;margin-bottom: 10px;padding: 0px ;"
                     src="<?php echo base_url(); ?>assets/img/logo/kyau_web.png">
            </center>
        </div>
        <h3>Register to KYAU</h3>

        <p>Create account to see it in action.</p>

        <div class="msg">
            <?php
            if ($this->session->flashdata('Success') != false) {
                echo '<div role="alert" class="alert alert-success alert-dismissible">';
                echo '<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>';
                echo '<p>' . $this->session->flashdata('Success') . '</p>';
                echo '</div>';
            } elseif ($this->session->flashdata('Error') != false) {
                echo '<div role="alert" class="alert alert-danger alert-dismissible">';
                echo '<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>';
                echo '<p>' . $this->session->flashdata('Error') . '</p>';
                echo '</div>';
            } elseif ($this->session->flashdata('Info') != false) {
                echo '<div role="alert" class="alert alert-info alert-dismissible">';
                echo '<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>';
                echo '<p>' . $this->session->flashdata('Info') . '</p>';
                echo '</div>';
            }
            ?>
        </div>
        <form id="myform">
            <div class="form-group">
                <input type="text" name="PARENTS_NAME" class="form-control" placeholder="Full Name" required="required">
            </div>
            <div class="form-group">
                <input type="text" name="EMAIL" id="EMAIL" class="form-control" placeholder="Email" required="required">
                <span style="color: red" class="email_validation"></span>
            </div>
            <div class="form-group">
                <input type="text" name="MOBILE_NO" class="form-control numbersOnly" placeholder="Mobile"
                       required="required">

            </div>
            <div class="form-group">
                <input type="text" name="STUDENT_ID" class="form-control" placeholder="Student ID" required="required">
            </div>
            <div class="form-group">
                <input type="text" name="USERNAME" class="form-control" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" class="form-control"/>
            </div>
            <div class="form-group">
                <input type="password" id="password_again" name="password_again" placeholder="Confirm Password"
                       class="form-control" required="required"/>
            </div>
            <button class="btn btn-primary block full-width m-b" id="regBtn">Register</button>

            <p class="text-muted text-center">
                <small>Already have an account?</small>
            </p>
            <a class="btn btn-sm btn-white btn-block" href="<?php echo site_url('auth/parentsLogin'); ?>">Login</a>
        </form>

        <p class="m-t">
            <small> © 2013 - <?php echo date('Y'); ?>   All Rights Reserved | <a href="http://www.kyau.edu.bd/">Khwaja
                    Yunus Ali University.</a></small>
        </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url() ?>assets/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>assets/js/plugins/iCheck/icheck.min.js"></script>

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>


<script>
    // just for the demos, avoids form submit
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $("#myform").validate({
        rules: {
            password: "required",
            password_again: {
                equalTo: "#password"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    $('body').on('keyup', '.numbersOnly', function () {
        var val = $(this).val();
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2) {
                val = val.replace(/\.+$/, "");
            }
        }
        $(this).val(val);
    });
    $(document).on('blur', '#EMAIL', function () {
        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str)) {
            $(".email_validation").html('Please enter a valid email address');
        } else {
            $(".email_validation").html('');
        }

    });
    $('#regBtn').on('click', function (e) {
        e.preventDefault();

        var data = $('#myform').serialize();
        $.ajax({
            type: 'POST',
            url: '<?php   echo site_url('parents/parents_registration');?>',
            data: data,
            success: function (data) {
                if (data == 'P') {
                    alert("You are already registered");
                } else if (data == 'S') {
                    alert("This student id already exits");
                } else {
                    window.location.reload(true);
                }

            }
        });
    });

</script>
</body>

</html>
