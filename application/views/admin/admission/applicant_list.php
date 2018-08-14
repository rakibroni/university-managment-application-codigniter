<form id="frmCourseOffer">
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SN</th>
            <th><input type="checkbox" id="checkAll" class="check" name="selectAll"> Check All</th>
            <th>Applicant ID</th>
            <th>Applicant Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($applicants)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($applicants as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->REGI_ID; ?>">
                    <td><span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->REGI_ID; ?>"></span></td>
                    <td><input type="checkbox" value="<?php echo $row->REGI_ID ?>" class="checkbox-primary check"
                               id="chkCourses" name="chkCourses[]"/></td>
                    <td><?php echo $row->APPLICATION_SL; ?></td>
                    <td><?php echo $row->STUDENT_NAME; ?></td>
                    <td>
                        <a class="label label-info userModal" id="<?php echo $row->REGI_ID; ?>"
                           data-action="admission/applicant_details" data-type="edit" title="View Course Information"><i
                                class="fa fa-eye"></i></a>
                        <a class="label label-info formSubmit" id="btnSubmit" data-action="admission/applicantReg"
                           data-su-action="admission/applicantReg" title="Applicant Registration">Ok</a>
                    </td>
                </tr>
            <?php } ?>
        <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <th>SN</th>
            <th>Check All</th>
            <th>Applicant ID</th>
            <th>Applicant Name</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</form>
<script>
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
    $(document).on("click", "#btnSubmit", function () {
        var frmCourseOffer = $("#frmCourseOffer").serialize();
        $.ajax({
            type: "POST",
            url: '<?php echo site_url('admission/applicantReg') ?>',
            data: frmCourseOffer,
        });

    });
</script>

<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title"></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on("click", ".userModal", function () {
        $("#myModal5").modal();
        var param_value = "";
        var action_type = $(this).attr("data-type");
        var action_uri = $(this).attr("data-action");
        var title = $(this).attr("title");
        if (action_type == "edit") {
            param_value = $(this).attr("id");
        }
        $.ajax({
            type: "post",
            url: "<?php echo site_url(); ?>/" + action_uri,
            data: {param: param_value},
            beforeSend: function () {
                $(".modal-title").html(title);
                $(".modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
    });
</script>
