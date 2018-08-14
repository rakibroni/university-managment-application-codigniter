<div class="ibox-title">
    <h5>Academic Information</h5>
    <!-- <?php if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
        <div class="ibox-tools">
                            <span id="update_academic_btn" title="Update Academic Info"
                                  class="btn btn-success btn-xs pull-right"
                                  data-action="applicant/updateApplicantAcademicInfo"><i
                                        class="fa fa-edit"></i> Edit </span>
        </div>
    <?php endif; ?> -->
</div>


<span type="hidden" id="APPLICANT_ID" applicant-data-id="<?php echo $applicant_id ?>"></span>
<div class="ibox-content">
    <?php if (!empty($academic)) { ?>
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover">
                <tr class="info">
                    <th>SL</th>
                    <th>Exam</th>
                    <th>Year</th>
                    <th>Board</th>
                    <th>Group</th>
                    <th>Institute</th>
                    <th>Result</th>
                    <th>Result W/A</th>
                </tr>
                <tbody>
                <?php $sl = 0;
                foreach ($academic as $row): $sl++; ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $row->ed; ?></td>
                        <td><?php echo $row->PASSING_YEAR; ?></td>
                        <td><?php echo $row->br; ?></td>
                        <td><?php echo $row->mg; ?></td>
                        <td><?php echo $row->INSTITUTION; ?></td>
                        <td><?php echo $row->RESULT_GRADE; ?></td>
                        <td><?php echo $row->RESULT_GRADE_WA; ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php } else {
        echo "No data found";
    } ?>
</div>

<script>
    $('#update_academic_btn').click(function () {
        var APPLICANT_ID = $("#APPLICANT_ID").attr('applicant-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo base_url(); ?>/" + action_uri,
            data: {APPLICANT_ID: APPLICANT_ID},
            beforeSend: function () {
                $(".profile-content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('.profile-content').html(data);
            }
        });
    })
</script>