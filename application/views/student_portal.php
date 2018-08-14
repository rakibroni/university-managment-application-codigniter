<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $pageTitle; ?></title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Data Tables -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet"/>

    <link href="<?php echo base_url(); ?>assets/css/animate.css?version=1.1" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css?version=1.1" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/Logo_small.ico">
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
    <link href="<?php echo base_url(); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet"/>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>

</head>

<body>
<div id="wrapper">
    <?php $this->load->view("student_portal/navbar"); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view("student_portal/top_menu"); ?>
        <div class="wrapper wrapper-content">
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
            <?php echo $_content; ?>
        </div>
        <div class="footer">
            <div class="pull-right">
                <strong> Developed By
                    <a target="_blank" href="http://www.atilimited.net">
                        <span style="color: red;">ATI</span>
                        <span style="color: green;">Limited</span>
                    </a></strong>
            </div>
            <div>
                <strong>Copyright</strong> KYAU &copy; <?php echo date('Y'); ?>
            </div>
        </div>
    </div>
    <?php $this->load->view("student_portal/theme_settings"); ?>
</div>
<?php $this->load->view("admin/common/js_lib"); ?>
<?php $this->load->view("student/common/student_common_js"); ?>
<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js') ?>"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/clockpicker/clockpicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>
</body>
<script type="text/javascript">
    $(document).ready(function () {
        var path = window.location.href;
        path = path.replace(/\/$/, "");
        path = decodeURIComponent(path);
        $(".sidebar-menu a").each(function () {
            var href = $(this).attr('href');
            if (path === href) {
                $(this).parents('li').addClass('active');
                $(this).parents('ul').addClass('in');
                /*$(this).parents('ul').prev('li').removeClass('collapsed');*/
            }
        });
    });

</script>
</html>

