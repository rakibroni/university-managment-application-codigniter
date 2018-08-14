<div class="ibox-title">
    <h5>Institute Information</h5>
    <?php  // if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
    <div class="ibox-tools">
                            <span id="update_personalInfo_btn" title="Update Personal Info" class="btn btn-success btn-xs pull-right"
                                  data-action="student/updateInstituteInfo/<?php echo $student_id;?>"><i class="fa fa-edit"></i> Edit </span>
    </div>
    <?php // endif; ?>
</div>

<span type="hidden" id="STUDENT_ID" student-data-id="<?php echo $student_id; ?>"></span>
<div class="ibox-content">
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>
            <tr>
                <th class="col-md-4">Admission Session</th>
                <td>:</td>
                <td class="col-md-8"><?php  echo ($students_info->adm_session_name != '') ? " $students_info->adm_session_name " : "" ?></td>
            </tr>
            <tr>
                <th>Current Session</th>
                <td>:</td>
                <td><?php echo ($students_info->current_session_name != '') ? " $students_info->current_session_name " : "" ?></td>
            </tr>
            <tr>
                <th>Faculty Name</th>
                <td>:</td>
                <td><?php  echo ($students_info->FACULTY_NAME != '') ? " $students_info->FACULTY_NAME " : "" ?></td>
            </tr>
            <tr>
                <th>Department Name</th>
                <td>:</td>
                <td><?php echo ($students_info->DEPT_NAME != '') ? " $students_info->DEPT_NAME " : "" ?></td>
            </tr>
            <tr>
                <th>Program Name</th>
                <td>:</td>
                <td><?php echo ($students_info->PROGRAM_NAME != '') ? " $students_info->PROGRAM_NAME " : "" ?></td>
            </tr>
            <tr>
                <th>Batch Name</th>
                <td>:</td>
                <td><?php echo ($students_info->BATCH_TITLE != '') ? " $students_info->BATCH_TITLE " : "" ?></td>
            </tr>
            <tr>
                <th>Section</th>
                <td>:</td>
                <td><?php echo ($students_info->section_name != '') ? " $students_info->section_name " : "" ?></td>
            </tr>

            </tbody>

        </table>
    </div>
</div>

<script>
    $('#update_personalInfo_btn').click(function () {
        var STUDENT_ID = $("#STUDENT_ID").attr('student-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url(); ?>" + "/" + action_uri,
            data: {STUDENT_ID: STUDENT_ID},
            beforeSend: function () {
                $(".profile-content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('.profile-content').html(data);
            }
        });
    })
</script>