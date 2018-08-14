<div class="ibox-title alert-info">
    <h5>Other Details</h5>
<?php if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
    <div class="ibox-tools">
                            <span id="update_othersInfo_btn" title="Update Personal Info"
                                  class="btn btn-success btn-xs pull-right"
                                  data-action="admin/updateApplicantOtherDetailsInfo/<?php echo $applicant_id;?>"><i class="fa fa-edit"></i> Edit </span>
    </div>
<?php endif; ?>
</div>
<div class="ibox-content">
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>
            <tr>

                <th>Annual Income of Parent/Parents or guardian</th>
                <td>:</td>
                <td><?php echo ($applicant_info->ANNUAL_INCOME !='')? " $applicant_info->ANNUAL_INCOME " :"" ?></td>
            </tr>
            <tr>
                <th>Scholarships receive in the past ?</th>
                <td>:</td>
                <td><?php echo ($applicant_info->SCHOLARSHIP !='NO')? " $applicant_info->SCHOLARSHIP_DESC " : "NO" ?></td>
            </tr>
            <tr>
                <th>Were you expelled from any instituition before ?</th>
                <td>:</td>
                <td><?php echo ($applicant_info->EXPELLED !='NO')? " $applicant_info->EXPELLED_DESC " : "NO" ?></td>
            </tr>
            <tr>
                <th>Were you ever arrested by law enforcement agency ?</th>
                <td>:</td>
                <td><?php echo ($applicant_info->ARRESTED !='NO')? " $applicant_info->ARRESTED_DESC " :"NO" ?></td>
            </tr>
            <tr>
                <th>Were you ever convicted by any court in bangladesh of any other country ?</th>
                <td>:</td>
                <td><?php echo ($applicant_info->CONVICTED !='NO')? " $applicant_info->CONVICTED_DESC " :"NO" ?></td>
            </tr>
            <tr>
                <th>Did you apply Khwaja Yunus Ali University Before ?</th>
                <td>:</td>
                <td><?php echo ($applicant_info->APPLY_BEFORE !='NO')? " $applicant_info->APPLY_SEMESTER ".' '." $applicant_info->APPLY_YEAR " :"NO" ?></td>

            </tr>
            <tr>
                <th>Do you have any siblings currently enrolled at KYAU ?</th>
                <td>:</td>
                <td><?php echo ($applicant_info->SIBLING_EXIST !='NO')? " $applicant_info->SBLN_ROLL_NO " :"NO" ?></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>

<script>
    $('#update_othersInfo_btn').click(function () {
        var STUDENT_ID = $("#STUDENT_ID").attr('');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url()?>/" + action_uri,
            data: {STUDENT_ID: STUDENT_ID},
            beforeSend: function () {
                $(".profile-content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('.profile-content').html(data);
            }
        });
    });
</script>