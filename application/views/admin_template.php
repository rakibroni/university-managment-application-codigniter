<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- ################################################################################## -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables2/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables2/buttons.bootstrap.min.css">

    
    <!-- ################################################################################## -->


     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/jQueryUI/jquery-ui.css">
    <link href="<?php echo base_url(); ?>assets/css/animate.css?version=1.1" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css?version=1.1" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet" />

    <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet"/>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/Logo_small.ico">
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<!-- Jquery ui datepicker date selected color --> 
<style type="text/css">

    .ui-state-active, .ui-widget-content .ui-state-active {
  /*any CSS styles you want overriden i.e.*/
  border: 1px solid #999999;
  background-color: #FFFA97;
}
</style>
</head>
<body>
    <div id="wrapper">
        <?php $this->load->view("admin/admin_template/navbar"); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php $this->load->view("admin/admin_template/top_menu"); ?>
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

            
            </div>

            <?php $this->load->view("admin/admin_template/theme_settings"); ?>
            
        </div>
        
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.4.0/metisMenu.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!--        <script src="--><?php //echo base_url('assets/datatables/js/jquery.dataTables.min.js')?><!--"></script>-->
<!--        <script src="--><?php //echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?><!--"></script>-->


    <!-- ################################################################################# -->

<!--    <script src="--><?php //echo base_url(); ?><!--assets/datatables2/jquery-1.12.4.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/datatables2/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables2/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables2/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables2/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables2/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables2/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables2/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables2/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables2/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables2/buttons.colVis.min.js"></script>

    <!-- ################################################################################# -->

    <script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/clockpicker/clockpicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Sweet alert -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/toastr/toastr.min.js"></script>

<?php $this->load->view("admin/common/js_lib"); ?>
    </body>
    </html>
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
$('.reportFormSubmit').on('submit', function (e) {
if (e.isDefaultPrevented()) {
e.preventDefault();
// handle the invalid form...
} else {
// everything looks good!
var postUrl = $(this).attr('action');
var formData = new FormData(this);
e.preventDefault();
//var formData = $( "form.modaFormSubmit" ).serialize()+'&_token='+CSRF_TOKEN;
  $.ajax({
    type: "POST",
    url: postUrl,
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    //dataType: "json",
    success: function (data) {
      //alert(data);
      $("div.reportResult").html(data);
  }

});
}
})


$(document).on("click", ".printButton", function () {
  Popup($("#printablediv").html());
});
function Popup(data)
{
  var currentdate = new Date();
  var datetime = "File: " + currentdate.getDate() + ""
                + (currentdate.getMonth()+1)  + ""
                + currentdate.getFullYear() + ""
                + currentdate.getHours() + ""
                + currentdate.getMinutes() + ""
                + currentdate.getSeconds();

  var mywindow = window.open('',datetime, 'height=800,width=1024');
  mywindow.document.write('<html><head><title>'+datetime+'</title>');
  /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
  mywindow.document.write('</head><body >');
  mywindow.document.write(data);
  mywindow.document.write('</body></html>');
  mywindow.print();
  mywindow.close();

  return true;
}
    </script>


