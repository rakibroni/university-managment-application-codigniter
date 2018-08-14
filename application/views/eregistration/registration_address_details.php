<!--<h4 class="green">Address</h4>-->
<div class="ibox-title">
    <h5>Address</h5>
    <?php if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
        <div class="ibox-tools">
                            <span id="update_address_btn" title="Update Postal Address Info"
                                  class="btn btn-primary btn-xs pull-right"
                                  data-action="applicant/updateApplicantAddressInfo"> Edit </span>
        </div>
    <?php endif; ?>
</div>

<span type="hidden" id="APPLICANT_ID" applicant-data-id="<?php echo $applicant_id ?>"></span>
<div class="ibox-content">
    <div class="table-responsive contentArea">

        <table width="50%" class="table table-striped table-bordered table-hover gridTable">
            <tbody>
            <tr>
                <th colspan="2"> Present Address</th>
            </tr>

            <tr>
                <th>Division</th>
                <td><?php if (!empty($local_present_adddress->DIVIS_NAME)) echo $local_present_adddress->DIVIS_NAME ?></td>
            </tr>
            <tr>
                <th>District</th>
                <td><?php if (!empty($local_present_adddress->DIST_NAME)) echo $local_present_adddress->DIST_NAME ?></td>
            </tr>
            <tr>
                <th>Thana/Upazila</th>
                <td><?php if (!empty($local_present_adddress->thn)) echo $local_present_adddress->thn ?></td>
            </tr>
            <tr>
                <th>Police Station</th>
                <td><?php if (!empty($local_present_adddress->PLOSC)) echo $local_present_adddress->PLOSC ?></td>
            </tr>
            <tr>
                <th>Post Office</th>
                <td><?php if (!empty($local_present_adddress->POSTO)) echo $local_present_adddress->POSTO ?></td>
            </tr>
            <tr>
                <th>Union</th>
                <td><?php if (!empty($local_present_adddress->uni)) echo $local_present_adddress->uni ?></td>
            </tr>
            <tr>
                <th>Village/House No/Road No <?php echo $local_present_adddress->SAS_PSORPR ?></th>
                <td><?php if (!empty($local_present_adddress->VILLAGE_WARD)) echo $local_present_adddress->VILLAGE_WARD ?></td>
            </tr>
            </tbody>
        </table>
        <?php if ($local_present_adddress->SAS_PSORPR != 'PS') { ?>
            <table width="50%" class="table table-striped table-bordered table-hover gridTable">
                <tbody>
                <tr>
                    <th colspan="2"> Permanent Address</th>
                </tr>
                <?php if (!empty($local_permanent_adddress)) ?>
                <tr>
                    <th>Division</th>
                    <td><?php if (!empty($local_permanent_adddress->DIVIS_NAME)) echo $local_permanent_adddress->DIVIS_NAME ?></td>
                </tr>
                <tr>
                    <th>District</th>
                    <td><?php if (!empty($local_permanent_adddress->DIST_NAME)) echo $local_permanent_adddress->DIST_NAME ?></td>
                </tr>
                <tr>
                    <th>Thana/Upazila</th>
                    <td><?php if (!empty($local_permanent_adddress->thn)) echo $local_permanent_adddress->thn ?></td>
                </tr>
                <tr>
                    <th>Police Station</th>
                    <td><?php if (!empty($local_permanent_adddress->PLOSC)) echo $local_permanent_adddress->PLOSC ?></td>
                </tr>
                <tr>
                    <th>Post Office</th>
                    <td><?php if (!empty($local_permanent_adddress->POSTO)) echo $local_permanent_adddress->POSTO ?></td>
                </tr>
                <tr>
                    <th>Union</th>
                    <td><?php if (!empty($local_permanent_adddress->uni)) echo $local_permanent_adddress->uni ?></td>
                </tr>
                <tr>
                    <th>Village/House No/Road No</th>
                    <td><?php if (!empty($local_permanent_adddress->VILLAGE_WARD)) echo $local_permanent_adddress->VILLAGE_WARD ?></td>
                </tr>
                </tbody>
            </table>
        <?php } else { ?>
            <table width="50%" class="table table-striped table-bordered table-hover gridTable">
                <tbody>
                <tr>
                    <th colspan="2"> Permanent Address: <?php echo "Same as Present Address"; ?></th>
                </tr>

                </tbody>
            </table>
        <?php } ?>
    </div>
</div>

<script>
    $('#update_address_btn').click(function () {
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