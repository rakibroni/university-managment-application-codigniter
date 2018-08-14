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
                url: "<?php echo base_url()?>teacher/ajaxDatatable", // json datasource
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


<div class="row" style="margin-left:5px !important">
    <div class="col-lg-10">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

            </div>

            <table id="employee-grid" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                <thead>
                <tr>
                    <th>Roll</th>
                    <th>Name</th>
                    <th>Department</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
		 
	 