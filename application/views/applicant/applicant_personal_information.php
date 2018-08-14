<div class="ibox-title">
    <h5>Personal Information</h5>
   <!--  <?php if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
        <div class="ibox-tools">
                            <span id="update_personalInfo_btn" title="Update Personal Info"
                                  class="btn btn-success btn-xs pull-right"
                                  data-action="applicant/updateApplicantPersonalDetails"><i class="fa fa-edit"></i> Edit </span>
        </div>
    <?php endif; ?> -->
</div>

<span type="hidden" id="APPLICANT_ID" applicant-data-id="<?php echo $applicant_id ?>"></span>

<div class="ibox-content">
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover">
            <tbody>
            <tr>
                <th class="col-md-4">Roll No.</th>
                <td>:</td>
                <td class="col-md-8"><?php echo ($applicant_info->ADM_ROLL_NO != '') ? " $applicant_info->ADM_ROLL_NO " : "" ?></td>
            </tr>
            <tr>
                <th>Faculty Name</th>
                <td>:</td>
                <td><?php echo ($applicant_info->FACULTY_NAME != '') ? " $applicant_info->FACULTY_NAME " : "" ?></td>
            </tr>
            <tr>
                <th>Department Name</th>
                <td>:</td>
                <td><?php echo ($applicant_info->DEPT_NAME != '') ? " $applicant_info->DEPT_NAME " : "" ?></td>
            </tr>
            <tr>

                <th>Program</th>
                <td>:</td>
                <td><?php echo ($applicant_info->PROGRAM_NAME != '') ? " $applicant_info->PROGRAM_NAME " : "" ?></td>
            </tr>
            <tr>

                <th>Name (English)</th>
                <td>:</td>
                <td><?php echo ($applicant_info->FULL_NAME_EN != '') ? " $applicant_info->FULL_NAME_EN " : "" ?></td>
            </tr>
            <tr>
                <th>নাম বাংলা</th>
                <td>:</td>
                <td><?php echo ($applicant_info->FULL_NAME_BN != '') ? " $applicant_info->FULL_NAME_BN " : "" ?></td>

            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>:</td>
                <td>
                    <?php $dob = date('d-M-Y', strtotime($applicant_info->DATH_OF_BIRTH));
                    echo ($dob != '') ? " $dob " : "" ?>
                </td>
            </tr>
            <tr>
                <th>Place of Birth</th>
                <td>:</td>
                <td><?php echo ($applicant_info->PLACE_OF_BIRTH != '') ? " $applicant_info->PLACE_OF_BIRTH " : "" ?></td>
            </tr>
            <tr>
                <th>Marital Status</th>
                <td>:</td>
                <td><?php echo ($applicant_info->LKP_MARITAL_STATUS != '') ? " $applicant_info->LKP_MARITAL_STATUS " : "" ?></td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td>:</td>
                <td><?php echo ($applicant_info->LKP_NATIONALITY != '') ? " $applicant_info->LKP_NATIONALITY " : "" ?></td>
            </tr>
            <tr>
                <th>National ID</th>
                <td>:</td>
                <td><?php echo ($applicant_info->NATIONAL_ID != '') ? " $applicant_info->NATIONAL_ID " : "" ?></td>
            </tr>
            <tr>
                <th>Blood Group</th>
                <td>:</td>
                <td><?php echo ($applicant_info->LKP_BLOOD_GROUP != '') ? " $applicant_info->LKP_BLOOD_GROUP " : "" ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td>:</td>
                <td><?php echo ($applicant_info->EMAIL_ADRESS != '') ? " $applicant_info->EMAIL_ADRESS " : "" ?></td>

            </tr>
            <tr>
                <th>Mobile</th>
                <td>:</td>
                <td><?php echo ($applicant_info->MOBILE_NO != '') ? " $applicant_info->MOBILE_NO " : "" ?></td>
            </tr>
            <tr>
                <th>Religion</th>
                <td>:</td>
                <td><?php echo ($applicant_info->LKP_RELIGION != '') ? " $applicant_info->LKP_RELIGION " : "" ?></td>
            </tr>
            <tr>
                <th>Height</th>
                <td>:</td>
                <td> <?php echo ($applicant_info->HEIGHT_FEET != '') ? " $applicant_info->HEIGHT_FEET Feet" : ""; ?></td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>:</td>
                <td><?php echo ($applicant_info->WEIGHT_KG != '') ? " $applicant_info->WEIGHT_KG Kg." : "" ?></td>
            </tr>
            <tr>
                <th>Signature</th>
                <td>:</td>
                <td><?php $photo = ($applicant_info->SIGNATURE_PHOTO != '') ? "upload/applicant/signature/" . $applicant_info->SIGNATURE_PHOTO : 'upload/applicant/signature/default_sign.png' ?>
                    <img style="width: 80px;" src="<?php echo base_url($photo); ?>" class="img-responsive"
                         alt=""></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#update_personalInfo_btn').click(function () {
        var APPLICANT_ID = $("#APPLICANT_ID").attr('applicant-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url(); ?>/" + action_uri,
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