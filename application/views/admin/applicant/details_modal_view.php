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

<?php $this->load->view("applicant/common/applicant_common_js"); ?>
<div class="row profile">
    <span type="hidden" id="APPLICANT_ID" applicant-data-id="<?php echo $applicant_info->APPLICANT_ID ?>"></span>
    <div class="col-md-3">
        <div class="profile-sidebar">
            <div class="profile-userpic">

                <!-- rand() function using for remove browser cache -->

                <?php $photo=($applicant_info->PHOTO !='')? "upload/applicant/photo/".$applicant_info->PHOTO: 'upload/default/default_pic.png' ?>
                <img id="applicant_profile_picture" src="<?php echo base_url($photo); ?>" class="img-responsive" alt=""></div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"></div>

            </div>
            <div class="profile-usermenu">
                <ul class="nav" id="navlist">
                    <li class="active">
                        <a id="personal_information" data-action="admin/applicantPersonalDetails" href="#"> <i
                                class="glyphicon glyphicon-home"></i>
                            Personal Info
                        </a>
                    </li>
                    <li>
                        <a data-action="admin/applicantFamillyDetails" href="#"> <i
                                class="glyphicon glyphicon-user"></i>
                            Family
                        </a>
                    </li>
                    <li>
                        <a data-action="admin/applicantAddressInfo" href="#"> <i
                                class="glyphicon glyphicon-envelope"></i>
                            Postal Address
                        </a>
                    </li>
                    <li>
                        <a data-action="admin/applicantAcademicInfo" href="#" target="_blank">
                            <i class="glyphicon glyphicon-book"></i>
                            Academic Info
                        </a>
                    </li>
                    <li>
                        <a data-action="admin/applicantOtherDetailsInfo" href="#" target="_blank">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            Other Details
                        </a>
                    </li>
               
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="profile-content">

            <div class="ibox-title alert-info">
                <h5>Personal Information</h5>
                <?php if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
                <div class="ibox-tools">
                            <span id="update_personalInfo_btn" title="Update Personal Info"
                                  class="btn btn-success btn-xs pull-right"
                                  data-action="admin/updateApplicantPersonalDetails/<?php echo $applicant_id; ?>"><i class="fa fa-edit"></i> Edit </span>
                </div>
            <?php endif; ?>
            </div>

            <div class="ibox-content">
                <div class="table-responsive contentArea">
                    <table class="table table-striped table-bordered table-hover gridTable">
                        <tbody>
                        <tr>
                            <th class="col-md-4">Roll No.</th>
                            <td>:</td>
                            <td class="col-md-8"><?php echo ($applicant_info->ADM_ROLL_NO !='')? " $applicant_info->ADM_ROLL_NO " :"" ?></td>
                        </tr>
                        <tr>

                            <th>Faculty Name</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->FACULTY_NAME !='')? " $applicant_info->FACULTY_NAME " :"" ?></td>
                        </tr>
                        <tr>

                            <th>Department Name</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->DEPT_NAME !='')? " $applicant_info->DEPT_NAME " :"" ?></td>
                        </tr>
                        <tr>

                            <th>Program</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->PROGRAM_NAME !='')? " $applicant_info->PROGRAM_NAME " :"" ?></td>
                        </tr>
                        <tr>

                            <th>Name (English)</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->FULL_NAME_EN !='')? " $applicant_info->FULL_NAME_EN " :"" ?></td>
                        </tr>
                        <tr>
                            <th>নাম বাংলা</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->FULL_NAME_BN !='')? " $applicant_info->FULL_NAME_BN " :"" ?></td>

                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>:</td>
<!--                            <td>--><?php //echo ($applicant_info->DATH_OF_BIRTH !='')? " $applicant_info->DATH_OF_BIRTH " :"" ?><!--</td>-->
                            <td><?php $dob= date('d-M-Y',strtotime($applicant_info->DATH_OF_BIRTH)); echo ($dob !='')? " $dob " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Place of Birth</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->PLACE_OF_BIRTH !='')? " $applicant_info->PLACE_OF_BIRTH " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Birth Certificate</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->BIRTH_CERTIFICATE !='')? " $applicant_info->BIRTH_CERTIFICATE " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Marital Status</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->LKP_MARITAL_STATUS !='')? " $applicant_info->LKP_MARITAL_STATUS " :"" ?></td>
                        </tr>
<!--                        <tr>-->
<!--                            <th>Spouse Name</th>-->
<!--                            <td>:</td>-->
<!--                            <td>--><?php ////echo ($applicant_info->SPOUSE_NAME !='')? " $applicant_info->SPOUSE_NAME " :"" ?><!--</td>-->
<!--                        </tr>-->
                        <tr>
                            <th>Nationality</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->LKP_NATIONALITY !='')? " $applicant_info->LKP_NATIONALITY " :"" ?></td>
                        </tr>
                        <tr>
                            <th>National ID</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->NATIONAL_ID !='')? " $applicant_info->NATIONAL_ID " :"" ?></td>
                        </tr>
<!--                        <tr>-->
<!--                            <th>Passport No.</th>-->
<!--                            <td>:</td>-->
<!--                            <td>--><?php //echo ($applicant_info->PASSPORT_NO !='')? " $applicant_info->PASSPORT_NO " :"" ?><!--</td>-->
<!--                        </tr>-->
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->EMAIL_ADRESS !='')? " $applicant_info->EMAIL_ADRESS " :"" ?></td>

                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->MOBILE_NO !='')? " $applicant_info->MOBILE_NO " :"" ?></td>
                        </tr>

                        <tr>
                            <th>Blood Group</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->LKP_BLOOD_GROUP !='')? " $applicant_info->LKP_BLOOD_GROUP " :"" ?></td>
                        </tr>

                        <tr>
                            <th>Height</th>
                            <td>:</td>
                            <td> <?php echo ($applicant_info->HEIGHT_FEET !='')? " $applicant_info->HEIGHT_FEET Feet" :"";?></td>
                        </tr>
                        <tr>
                            <th>Weight</th>
                            <td>:</td>
                            <td><?php echo ($applicant_info->WEIGHT_KG !='')? " $applicant_info->WEIGHT_KG Kg." :"" ?></td>
                        </tr>
                        <tr>
                            <th>Signature</th>
                            <td>:</td>
                            <td><?php $photo=($applicant_info->SIGNATURE_PHOTO !='')? "upload/applicant/signature/".$applicant_info->SIGNATURE_PHOTO : 'upload/applicant/signature/default_sign.png' ?>
                                <img style="width: 80px;" src="<?php echo base_url($photo); ?>" class="img-responsive" alt=""></td>
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
        var STUDENT_ID = $("#STUDENT_ID").attr('');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url()?>/" + action_uri,
            data: {STUDENT_ID: STUDENT_ID},
            beforeSend: function () {
                $(".profile-content").html("<img src='<?php echo base_url();?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('.profile-content').html(data);
            }
        });
    });



    $(document).ready(function () {
        //to show the active menu function
        $('#navlist li').click(function (e) {
            e.preventDefault(); //prevent the link from being followed               
            $('#navlist li').removeClass('active');
            $(this).addClass('active');
        });

        $('#navlist li a').click(function () {
            var APPLICANT_ID = $("#APPLICANT_ID").attr('applicant-data-id');
            var action_uri = $(this).attr('data-action');
            $.ajax({
                type: 'post',
                url: "<?php echo site_url()?>/" + action_uri,
                data: {APPLICANT_ID: APPLICANT_ID},
                beforeSend: function () {
                    $(".profile-content").html("<img src='<?php echo base_url();?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $('.profile-content').html(data);
                }
            });
        });
    });
</script>