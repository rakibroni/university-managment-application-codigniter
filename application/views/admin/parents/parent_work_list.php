<link href="<?php echo base_url(); ?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url() ?>assets/css/plugins/dataTables/jquery.dataTables.css">
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url() ?>assets/css/plugins/dataTables/dataTables.responsive.css">
<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        var dataTable = $('#employee-grid').DataTable({
            "responsive": true,   // enable responsive
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url()?>admin/ajaxDatatableParentList", // json datasource
                type: "post",  // method  , by default get
                error: function () {  // error handling
                    $(".employee-grid-error").html("");
                    $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#employee-grid_processing").css("display", "none");
                }
            }
        });
    });
</script>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Parent Login Permission</h5>

            <div class="ibox-tools">

            </div>

    </div>
    <div class="ibox-content">
        <p>Select all &nbsp;<input type="checkbox" id="select-all"> <span style="color:red;margin-left:20px">Before submit please checked those parents  you want to update.</span>
        </p>
        <form id="parents" method="post" action="<?php echo base_url(); ?>admin/approveParent">
            <input type="submit" class="btn btn-primary pull-right" value="Approved">
            <table id="employee-grid" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Parent Information</th>
                    <th>Previous Information</th>
                    <th>Remarks</th>
                    <th>Approve?</th>
                </tr>
                </thead>
            </table>
        </form>
    </div>


<script src="<?php echo base_url(); ?>assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Listen for click on toggle checkbox
        $('#select-all').click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
        $(document).on('submit', '#post_blog', function () {
            if (!$('#post_blog input[type="checkbox"]').is(':checked')) {
                alert("Please cheked the box which you want to update at least one.");
                return false;
            } else {
                if (confirm("Are you sure?")) {
                    return true;
                } else {
                    return false;
                }
            }
        });
        $(document).on('submit', '#parents', function () {

            if (!$('#parents input[type="checkbox"]').is(':checked')) {
                alert("Please cheked the box which you want to update at least one.");
                return false;
            } else {
                if (confirm("Are you sure?")) {
                    return true;
                } else {
                    return false;
                }
            }
        });
    });
</script>