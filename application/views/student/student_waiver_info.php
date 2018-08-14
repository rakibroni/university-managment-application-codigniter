
<div class="ibox-title">
    <h5>Waiver Information</h5>
    <?php // if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
    <div class="ibox-tools">
                            <span id="" title="Update Waiver Info"
                                  class="btn btn-success btn-xs pull-right update_waiverInfo_btn"
                                  data-action="student/addWaiverInfo/<?php echo $student_id; ?>"><i
                                        class="glyphicon glyphicon-plus"></i> Add </span>
    </div>
    <?php // endif; ?>
</div>

<span type="hidden" id="STUDENT_ID" student-data-id="<?php echo $student_id; ?>"></span>
<div class="ibox-content">
    <div class="table-responsive contentArea">
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover">
                <tr class="info">
                    <th>Session</th>
                    <th>Waiver Type</th>
                    <th class="text-center">Percentage</th>
                    <th>Status</th>
                    <th class="text-center">ACTION</th>
                </tr>
                <tbody>

                <?php foreach ($student_info as $students_info) : ?>
                    <tr>
                        <td>
                            <span class=""><?php if (!empty($students_info->SESSION_NAME)) {
                                        echo $students_info->SESSION_NAME;
                                    } else {
                                        echo 'Session Name';
                                    } ?></span>
                        </td>
                        <td>
                            <?php if (!empty($students_info->WAIVER_NAME)) {
                                echo $students_info->WAIVER_NAME;
                            } ?>
                        </td>
                        <td class="text-center">
                            <?php if (!empty($students_info->PERCENTAGE)) {
                                echo $students_info->PERCENTAGE . '%';
                            } ?>
                        </td>
                        <td><?php echo ($students_info->ACTIVE_STATUS == '1') ? 'Active' : ''; ?></td>
                        <td class="text-center">
                            <a id="" title="Update Waiver Info" class="label label-default btn-xs update_waiverInfo_btn"
                               data-action="student/updateWaiverInfo/<?php echo $student_id; ?>/<?php echo $students_info->STU_WAIVER_ID; ?>"><i
                                        class="fa fa-pencil"></i> </a>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    $('.update_waiverInfo_btn').click(function () {
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