<style type="text/css">
    /***
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/

    /* Profile container */
    .profile {
        margin: 20px 0;
    }

    /* Profile sidebar */
    .profile-sidebar {
        padding: 20px 0 10px 0;
        background: #fff;
    }

    .profile-userpic img {
        float: none;
        margin: 0 auto;
        width: 50%;
        height: 50%;
        -webkit-border-radius: 50% !important;
        -moz-border-radius: 50% !important;
        border-radius: 50% !important;
    }

    .profile-usertitle {
        text-align: center;
        margin-top: 20px;
    }

    .profile-usertitle-name {
        color: #5a7391;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .profile-usertitle-job {
        text-transform: uppercase;
        color: #5b9bd1;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .profile-userbuttons {
        text-align: center;
        margin-top: 10px;
    }

    .profile-userbuttons .btn {
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 600;
        padding: 6px 15px;
        margin-right: 5px;
    }

    .profile-userbuttons .btn:last-child {
        margin-right: 0px;
    }

    .profile-usermenu {
        margin-top: 30px;
    }

    .profile-usermenu ul li {
        border-bottom: 1px solid #f0f4f7;
    }

    .profile-usermenu ul li:last-child {
        border-bottom: none;
    }

    .profile-usermenu ul li a {
        color: #93a3b5;
        font-size: 14px;
        font-weight: 400;
    }

    .profile-usermenu ul li a i {
        margin-right: 8px;
        font-size: 14px;
    }

    .profile-usermenu ul li a:hover {
        background-color: #fafcfd;
        color: #5b9bd1;
    }

    .profile-usermenu ul li.active {
        border-bottom: none;
    }

    .profile-usermenu ul li.active a {
        color: #5b9bd1;
        background-color: #f6f9fb;
        border-left: 2px solid #5b9bd1;
        margin-left: -2px;
    }

    /* Profile Content */
    .profile-content {
        padding: 20px;
        background: #fff;
        min-height: 460px;
    }

</style>

<?php $this->load->view("student/common/student_common_js"); ?>
<div class="row profile">
    <span type="hidden" id="STUDENT_ID" student-data-id="<?php echo $student_id; ?>"></span>
    <div class="col-md-3">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <?php $photo = ($students_info->PHOTO != '') ? "upload/student/photo/" . $students_info->PHOTO. "?". rand() : 'assets/img/default.png' ?>
                <img id="student_pro_pic" src="<?php echo base_url($photo); ?>" class="img-responsive" alt=""></div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"></div>

            </div>
            <div class="profile-usermenu">
                <ul class="nav" id="navlist">
                    <li class="active">
                        <a id="personal_information" data-action="student/personalDetails/<?php echo $student_id; ?>" href="#"> <i
                                class="glyphicon glyphicon-home"></i>
                            Personal Info
                        </a>
                    </li>
                    <li>
                        <a data-action="student/familyDetails/<?php echo $student_id; ?>" href="#"> <i
                                class="glyphicon glyphicon-user"></i>
                            Family
                        </a>
                    </li>
                    <li>
                        <a data-action="student/addressInfo/<?php echo $student_id; ?>" href="#"> <i
                                class="glyphicon glyphicon-envelope"></i>
                            Postal Address
                        </a>
                    </li>
                    <li>
                        <a data-action="student/academicInfo/<?php echo $student_id; ?>" href="#" target="_blank">
                            <i class="glyphicon glyphicon-book"></i>
                            Academic Info
                        </a>
                    </li>
                    <li>
                        <a data-action="student/otherDetailsInfo/<?php echo $student_id; ?>" href="#" target="_blank">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            Other Details
                        </a>
                    </li>
                    <li>
                        <a data-action="student/instituteInfo/<?php echo $student_id; ?>" href="#" target="_blank">
                            <i class="glyphicon glyphicon-education"></i>
                            Institute Info
                        </a>
                    </li>
                    <li>
                        <a data-action="student/waiverInfo/<?php echo $student_id; ?>" href="#" target="_blank">
                            <i class="glyphicon glyphicon-asterisk"></i>
                            Waiver Info
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="profile-content">
            <!--            <h4 class="green">Personal Information</h4>-->

            <div class="ibox-title">
                <h5>Personal Information</h5>
                <?php //if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
                    <div class="ibox-tools">
                            <span id="update_personalInfo_btn" title="Update Personal Info"
                                  class="btn btn-success btn-xs pull-right"
                                  data-action="student/updateStudentPersonalDetails/<?php echo $student_id;?>"><i class="fa fa-edit"></i> Edit </span>
                    </div>
                <?php //endif; ?>
            </div>
            <div class="ibox-content">
                <div class="table-responsive contentArea">
                    <table class="table table-striped table-bordered table-hover">
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
                            <td><?php  echo ($students_info->WEIGHT_KG != '') ? " $students_info->WEIGHT_KG Kg." : "" ?></td>
                        </tr>
                        <tr>
                            <th>Signature</th>
                            <td>:</td>
                            <td><?php $photo = ($students_info->SIGNATURE_PHOTO != '') ? "upload/student/signature/" . $students_info->SIGNATURE_PHOTO : 'upload/default/default_sign.png' ?>
                                <img style="width: 80px;" src="<?php echo base_url($photo); ?>" class="img-responsive"
                                     alt=""></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#update_personalInfo_btn').click(function () {
        var STUDENT_ID = $("#STUDENT_ID").attr('student-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url(); ?>/" + "/" + action_uri,
            data: {STUDENT_ID: STUDENT_ID},
            beforeSend: function () {
                $(".profile-content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('.profile-content').html(data);
            }
        });
    })
 


    $(document).ready(function () {
        //to show the active menu function
        $('#navlist li').click(function (e) {
            e.preventDefault(); //prevent the link from being followed
            $('#navlist li').removeClass('active');
            $(this).addClass('active');
        });

        $('#navlist li a').click(function () {
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
        });
    });


    $(document).on("change", "#PROGRAM_ID", function () {

        $("#BATCH_ID").val("");
        var program_id = $(this).val();

        //alert(program_id);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/programWiseBatch',
            data: {program_id: program_id},
            success: function (data) {
                $("#BATCH_ID").html(data)
            }
        });
    });


</script>