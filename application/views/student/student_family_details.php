<div class="ibox-title">
    <h5>Family Information</h5>
    <?php // if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
    <div class="ibox-tools">
                            <span id="update_familyInfo_btn" title="Update Family Info" class="btn btn-success btn-xs pull-right"
                                  data-action="student/updateStudentFamilyDetails/<?php echo $student_id;?>"><i class="fa fa-edit"></i> Edit </span>
    </div>
    <?php // endif; ?>
</div>

<span type="hidden" id="APPLICANT_ID" applicant-data-id="<?php //echo $applicant_id ?>"></span>

<div class="ibox-content">
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>

            <tr>
                <th class="col-md-4">Father Name</th>
                <td>:</td>
                <td class="col-md-8"><?php if(!empty($fathersInfo)) {echo ($fathersInfo->GURDIAN_NAME !='')? " $fathersInfo->GURDIAN_NAME " :"";} ?></td>

            </tr>
            <tr>
                <th>Occupation</th>
                <td>:</td>

                <td><?php if(!empty($fathersInfo)) {echo ($fathersInfo->FATHER_OCCU !='')? " $fathersInfo->FATHER_OCCU " :"";} ?></td>

            </tr>
            <tr>
                <th>Phone</th>
                <td>:</td>

                <td><?php if(!empty($fathersInfo)) {echo ($fathersInfo->MOBILE_NO !='')? " $fathersInfo->MOBILE_NO " :"";} ?>

                </td>


            </tr>
            <tr>
                <th>Email</th>
                <td>:</td>

                <td><?php if(!empty($fathersInfo)) {echo ($fathersInfo->EMAIL_ADRESS !='')? " $fathersInfo->EMAIL_ADRESS " :"";} ?>

                </td>


            </tr>
            <tr>
                <th>Work Address</th>
                <td>:</td>

                <td><?php if(!empty($fathersInfo)) {echo ($fathersInfo->WORKING_ORG !='')? " $fathersInfo->WORKING_ORG " :"";} ?>

                </td>


            </tr>

            </tbody>
        </table>
        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>

            <tr>
                <th class="col-md-4">Mother Name</th>
                <td>:</td>
                <td class="col-md-8"><?php if(!empty($motherInfo)) {echo ($motherInfo->GURDIAN_NAME !='')? " $motherInfo->GURDIAN_NAME " :"";} ?></td>
            </tr>
            <tr>
                <th>Occupation</th>
                <td>:</td>

                <td><?php if(!empty($motherInfo)) {echo ($motherInfo->MOTHER_OCCU !='')? " $motherInfo->MOTHER_OCCU " :"";} ?></td>

            </tr>
            <tr>
                <th>Phone</th>
                <td>:</td>

                <td>
                    <?php if(!empty($motherInfo)) {echo ($motherInfo->MOBILE_NO !='')? " $motherInfo->MOBILE_NO " :"";} ?>
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>:</td>
                <td>
                    <?php if(!empty($motherInfo)) {echo ($motherInfo->EMAIL_ADRESS !='')? " $motherInfo->EMAIL_ADRESS " :"";} ?>
                </td>
            </tr>

            <tr>
                <th>Address</th>
                <td>:</td>

                <td><?php if(!empty($motherInfo)) {echo ($motherInfo->WORKING_ORG !='')? " $motherInfo->WORKING_ORG " :"";} ?>

                </td>
            </tr>

            </tbody>
        </table>

        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>
            <tr>
                <th class="col-md-4">Local Guardian</th>
                <td>:</td>
                <?php if (!empty($local_guardian)) : ?>
                    <?php  if($local_guardian->GUARDIAN_TYPE=='F') : ?>
                        <td class="col-md-8">Father</td>
                    <?php elseif ($local_guardian->GUARDIAN_TYPE=='M') : ?>
                        <td class="col-md-8">Mother</td>
                    <?php else: ?>
                        <td class="col-md-8">Other</td>
                    <?php endif; ?>
                <?php endif; ?>
            </tr>
            </tbody>
        </table>


        <?php if (!empty($local_guardian)) : ?>

        <?php  if($local_guardian->GUARDIAN_TYPE =='O') : ?>

        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>

            <tr>
                <th class="col-md-4">Local Guardian Name</th>
                <td>:</td>
                <td class="col-md-8"><?php echo ($local_guardian->GURDIAN_NAME !='')? " $local_guardian->GURDIAN_NAME " :"" ?></td>
            </tr>
            <tr>
                <th>Local Guardian Relation</th>
                <td>:</td>

                <td><?php echo ($local_guardian->RELATION_WITH_LOCAL_GUARDIAN !='')? " $local_guardian->RELATION_WITH_LOCAL_GUARDIAN " :"" ?></td>

            </tr>
            <tr>
                <th>Local Guardian Address</th>
                <td>:</td>

                <td>
                    <?php echo ($local_guardian->ADDRESS !='')? " $local_guardian->ADDRESS " :"" ?>
                </td>
            </tr>
            <tr>
                <th>Local Guardian Mobile</th>
                <td>:</td>
                <td>
                    <?php echo ($local_guardian->MOBILE_NO !='')? " $local_guardian->MOBILE_NO " :"" ?>
                </td>
            </tr>


            </tbody>
        </table>

        <?php endif; ?>

        <?php endif; ?>

    </div>
</div>


<script>
    $('#update_familyInfo_btn').click(function () {
        var APPLICANT_ID = $("#APPLICANT_ID").attr('applicant-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url(); ?>/" + "/" + action_uri,
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