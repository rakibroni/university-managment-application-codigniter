<div class="ibox-title">
    <h5>Personal Information</h5>
    <?php // if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
    <div class="ibox-tools">
                            <span id="update_personalInfo_btn" title="Update Personal Info"
                                  class="btn btn-success btn-xs pull-right"
                                  data-action="student/updateStudentPersonalDetails/<?php echo $student_id; ?>"><i
                                        class="fa fa-edit"></i> Edit </span>
    </div>
    <?php // endif; ?>
</div>

<span type="hidden" id="STUDENT_ID" student-data-id="<?php echo $student_id; ?>"></span>
<div class="ibox-content">
    <div class="table-responsive contentArea">
        <table class="table table-striped table-bordered table-hover gridTable">
            <tbody>
            <tr>
                <th class="col-md-4">Registration No.</th>
                <td>:</td>
                <td class="col-md-8"><?php echo ($students_info->REGISTRATION_NO != '') ? " $students_info->REGISTRATION_NO " : "" ?></td>
            </tr>
            <tr>
                <th>Name (English)</th>
                <td>:</td>
                <td><?php echo ($students_info->FULL_NAME_EN != '') ? " $students_info->FULL_NAME_EN " : "" ?></td>
            </tr>
            <tr>
                <th>নাম বাংলা</th>
                <td>:</td>
                <td><?php echo ($students_info->FULL_NAME_BN != '') ? " $students_info->FULL_NAME_BN " : "" ?></td>

            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>:</td>
                <td>
                    <?php $dob = date('d-M-Y', strtotime($students_info->DATH_OF_BIRTH));
                    echo ($dob != '') ? " $dob " : "" ?>
                </td>
            </tr>
            <tr>
                <th>Place of Birth</th>
                <td>:</td>
                <td><?php echo ($students_info->PLACE_OF_BIRTH != '') ? " $students_info->PLACE_OF_BIRTH " : "" ?></td>
            </tr>
            <tr>
                <th>Marital Status</th>
                <td>:</td>
                <td><?php echo ($students_info->LKP_MARITAL_STATUS != '') ? " $students_info->LKP_MARITAL_STATUS " : "" ?></td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td>:</td>
                <td><?php echo ($students_info->LKP_NATIONALITY != '') ? " $students_info->LKP_NATIONALITY " : "" ?></td>
            </tr>
            <tr>
                <th>National ID</th>
                <td>:</td>
                <td><?php echo ($students_info->NATIONAL_ID != '') ? " $students_info->NATIONAL_ID " : "" ?></td>
            </tr>
            <tr>
                <th>Blood Group</th>
                <td>:</td>
                <td><?php echo ($students_info->LKP_BLOOD_GROUP != '') ? " $students_info->LKP_BLOOD_GROUP " : "" ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td>:</td>
                <td><?php echo ($students_info->EMAIL_ADRESS != '') ? " $students_info->EMAIL_ADRESS " : "" ?></td>

            </tr>
            <tr>
                <th>Mobile</th>
                <td>:</td>
                <td><?php echo ($students_info->MOBILE_NO != '') ? " $students_info->MOBILE_NO " : "" ?></td>
            </tr>
            <tr>
                <th>Religion</th>
                <td>:</td>
                <td><?php echo ($students_info->LKP_RELIGION != '') ? " $students_info->LKP_RELIGION " : "" ?></td>
            </tr>
            <tr>
                <th>Height</th>
                <td>:</td>
                <td> <?php echo ($students_info->HEIGHT_FEET != '') ? " $students_info->HEIGHT_FEET Feet" : ""; ?></td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>:</td>
                <td><?php echo ($students_info->WEIGHT_KG != '') ? " $students_info->WEIGHT_KG Kg." : "" ?></td>
            </tr>
            <tr>
                <th>Signature</th>
                <td>:</td>
                <td><?php $photo = ($students_info->SIGNATURE_PHOTO != '') ? "upload/student/signature/" . $students_info->SIGNATURE_PHOTO : 'assets/img/default_sign.png' ?>
                    <img style="width: 80px;" src="<?php echo base_url($photo); ?>" class="img-responsive"
                         alt=""></td>
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