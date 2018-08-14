<input type="hidden" name="SESSION_ID" value="<?php echo $SESSION_ID; ?>">
<input type="hidden" name="FACULTY_ID" value="<?php echo $FACULTY_ID; ?>">
<input type="hidden" name="DEPT_ID" value="<?php echo $DEPT_ID; ?>">
<input type="hidden" name="PROGRAM_ID" value="<?php echo $PROGRAM_ID; ?>">
<input type="hidden" name="BATCH_ID" value="<?php echo $BATCH_ID; ?>">
<input type="hidden" name="SECTION_ID" value="<?php echo $SECTION_ID; ?>">

<div class="table-responsive contentArea">

    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SL</th>
            <th>Registration No</th>
            <th>Name</th>
            <th class="text-center col-md-3">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($student_list)): $sn = 1; ?>
            <?php foreach ($student_list as $row) { ?>
                <tr class="gradeX" id=" ">

                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $row->REGISTRATION_NO ?></td>
                    <td><?php echo $row->FULL_NAME_EN ?></td>

                    <td class="text-center col-md-3">

                        <a href="<?php echo site_url('exam/academicTranscript/' . $SESSION_ID . '/' . $FACULTY_ID . '/' . $DEPT_ID . '/' . $PROGRAM_ID . '/' . $BATCH_ID . '/' . $SECTION_ID . '/' . $row->STUDENT_ID); ?>"
                           target="_blank" class="btn btn-xs btn-success"><span
                                    class=""> Transcript </span>
                        </a>
                        <a href="<?php echo site_url('exam/partialAcademicTranscript/' . $SESSION_ID . '/' . $FACULTY_ID . '/' . $DEPT_ID . '/' . $PROGRAM_ID . '/' . $BATCH_ID . '/' . $SECTION_ID . '/' . $row->STUDENT_ID); ?>"
                           target="_blank" class="btn btn-xs btn-info"><span
                                    class=""> Partial Transcript </span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        $(".gridTable").dataTable();
    });
</script>