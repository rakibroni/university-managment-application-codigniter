<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eUMS | Parents Registration</title>
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
    <style>
        label.valid {
            height: 0px !important;
        }
    </style>
</head>
<body class="gray-bg">
<div class="pull-right" style="padding: 20px">
    <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>auth/parentsLogout">Logout</a>
</div>
<div class="middle-box text-center loginscreen   animated fadeInDown">

    <div class="row">
        <center>
            <img style=" width:80px; border-radius: 3px;margin-bottom: 10px;padding: 0px ;"
                 src="<?php echo base_url(); ?>assets/img/logo/kyau_web.png">
        </center>
    </div>
    <h3>Your Student List</h3>

    <p>Please select a student to view details</p>

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
    <?php foreach ($student as $row): ?>
        <div class="col-md-12 selectChild" data-std-id="<?php echo $row->STUDENT_ID ?>">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class=" ">
                        <div class="feed-element">
                                    <span class="pull-left" href="#">
                                        <img src="<?php echo base_url(); ?>assets/img/a2.jpg" class="img-circle"
                                             alt="image">
                                    </span>

                            <div class="media-body" style="float:left">
                                <small class="pull-right"></small>
                                <strong>Md.Rakib Mostofa</strong> <br>
                                <small style="float:left">B.sc in CSE.</small>
                                <br>
                                <small style="float:left">ID : <?php echo $row->STUDENT_ID ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <p class="m-t">
        <small> © 2013 - <?php echo date('Y'); ?>   All Rights Reserved | <a href="http://www.kyau.edu.bd/">Khwaja
                Yunus Ali University.</a></small>
    </p>
</div>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on("click", ".selectChild", function () {
            var childId = $(this).attr("data-std-id");
            $.ajax({
                type: "post",
                url: "<?php echo site_url('parents/ActivateChild');?>",
                data: {childId: childId},
                success: function () {
                    window.location.replace("<?php echo site_url('parents/student_details');?>");
                }
            });
        });
    });
</script>
</body>
</html>
