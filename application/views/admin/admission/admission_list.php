<form id="frmCourseOffer">
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th><input type="checkbox" id="checkAll" class="check clickcheck" name="selectAll"></th>
            <th>SN</th>
            <th>Applicant ID</th>
            <th>Applicant Name</th>
            <th>Program</th>
            <th>Exam Name</th>
            <th>Group</th>
            <th>GPA</th>
            <th>Board</th>
            <th>Passing Year</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($applicants)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($applicants as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->ADMISSION_ID; ?>">
                    <td><input type="checkbox" value="<?php echo $row->ADMISSION_ID ?>"
                               class="checkbox-primary check clickcheck" id="chkCourses" name="chkCourses[]"/></td>
                    <td><span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->ADMISSION_ID; ?>"></span>
                    </td>
                    <td><?php echo $row->APPLICANT_ID; ?></td>
                    <td><?php echo $row->APPLICANT_NAME; ?></td>
                    <td><?php echo $row->PROGRAM_ID; ?></td>
                    <td><?php echo $row->EXAM_NAME; ?></td>
                    <td><?php echo $row->GROUP; ?></td>
                    <td><?php echo $row->GPA; ?></td>
                    <td><?php echo $row->BOARD; ?></td>
                    <td><?php echo $row->PASSING_YEAR; ?></td>
                    <td>
                        <a class="label label-primary formSubmit" id="btnSubmit1" name="btnSubmit1[]"
                           data-action="admission/applicantReg" data-su-action="admission/applicantReg"
                           title="Applicant Registration">Ok</a>

                    </td>
                </tr>
            <?php } ?>
        <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <th><input type="checkbox"></th>
            <th>SN</th>
            <th>Applicant ID</th>
            <th>Applicant Name</th>
            <th>Program Name</th>
            <th>Exam Name</th>
            <th>Group</th>
            <th>GPA</th>
            <th>Board</th>
            <th>Passing Year</th>
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
    $(document).on("click", ".clickcheck", function () {
        var numberOfChecked = $('input[name="chkCourses[]"]:checked').length;
        alert(numberOfChecked);
        if (numberOfChecked > 1) {
            $("#btnSubmit").css("display", "block");
            $("#btnSubmit1").css("display", "none");
        } else {
            $("#btnSubmit").css("display", "none");
            $("#btnSubmit1").css("display", "block");
        }
    });
</script>
