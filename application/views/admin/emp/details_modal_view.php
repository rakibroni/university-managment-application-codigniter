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
<div class="row profile">
    <span type="hidden" id="EMP_ID" emp-data-id="<?php echo $emp_info->EMP_ID ?>"></span>
    <div class="col-md-3">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <?php $photo=($emp_info->EMP_IMG !='')? "upload/employee/photo/".$emp_info->EMP_IMG : 'assets/img/default.png' ?>
                <img src="<?php echo base_url($photo); ?>" class="img-responsive" alt=""></div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"></div>

            </div>
<!--            <div class="profile-userbuttons">-->
<!--                <button type="button" class="btn btn-success btn-sm">Email</button>-->
<!--                <button type="button" class="btn btn-danger btn-sm">Message</button>-->
<!--            </div>-->
            <div class="profile-usermenu">
                <ul class="nav" id="navlist">
                    <li class="active">
                        <a id="personal_information" data-action="employee/empPersonalDetails" href="#"> <i
                                class="glyphicon glyphicon-home"></i>
                            Personal Info
                        </a>
                    </li>
                    <li>
                     <a data-action="employee/empDesignationDetails" href="#"> <i
                              class="glyphicon glyphicon-user"></i>
                           Designation 
                     </a>
                   </li>
<!--                    <li>-->
<!--                        <a data-action="admin/applicantAddressInfo" href="#"> <i-->
<!--                                class="glyphicon glyphicon-envelope"></i>-->
<!--                            Postal Address-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a data-action="admin/applicantAcademicInfo" href="#" target="_blank">-->
<!--                            <i class="glyphicon glyphicon-book"></i>-->
<!--                            Academic Info-->
<!--                        </a>-->
<!--                    </li>-->
               
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="profile-content">
            <h4 class="green">Personal Information</h4>
            <div class="ibox-content">
                <div class="table-responsive contentArea">
                    <table class="table table-striped table-bordered table-hover gridTable">
                        <tbody>
                        <tr>

                            <th>Full Name.</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->FULL_ENAME !='')? " $emp_info->FULL_ENAME " :"" ?></td>
                        </tr>
                        <tr>

                            <th>Full Name Bn</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->FULL_BNAME !='')? " $emp_info->FULL_BNAME " :"" ?></td>
                        </tr>
                        <tr>

                            <th>Father Name</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->FATHER_NAME !='')? " $emp_info->FATHER_NAME " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Mother Name</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->MOTHER_NAME !='')? " $emp_info->MOTHER_NAME " :"" ?></td>

                        </tr>
                        <tr>
                            <?php
                            $t = strtotime($emp_info->DOB);
                            $formattedDOB = date('d/m/y',$t);
                            ?>
                            <th>Date of Birth</th>
                            <td>:</td>
                            <td><?php echo ($formattedDOB !='')? " $formattedDOB " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Place of Birth</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->PLACE_OF_BIRTH !='')? " $emp_info->PLACE_OF_BIRTH " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Mobile No.</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->MOBILE !='')? " $emp_info->MOBILE " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->EMAIL !='')? " $emp_info->EMAIL " :"" ?></td>
                        </tr>
                       
                        <tr>
                            <th>Nationality</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->LKP_NATIONALITY !='')? " $emp_info->LKP_NATIONALITY " :"" ?></td>
                        </tr>
                        <tr>
                            <th>National ID</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->NATIONAL_ID !='')? " $emp_info->NATIONAL_ID " :"" ?></td>
                        </tr>
                        <tr>
                            <th>Religion</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->LKP_RELIGION !='')? " $emp_info->LKP_RELIGION " :"" ?></td>
                        </tr>

                        <tr>
                            <th>Blood Group</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->BLOOD_GROUP !='')? " $emp_info->BLOOD_GROUP " :"" ?></td>
                        </tr>

                        <tr>
                            <th>Marital Status</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->MARITAL_STATUS !='')? " $emp_info->MARITAL_STATUS " :"" ?></td>
                        </tr>

                         <tr>
                            <th>Bio-matric ID</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->BIOMETRIC_ID !='')? " $emp_info->BIOMETRIC_ID " :"" ?></td>
                        </tr>
                        
                        <tr>
                            <th>Join Date</th>
                            <td>:</td>
                            <?php
                            $t = strtotime($emp_info->JOIN_DATE);
                            $formattedDOB = date('d/m/y',$t);
                            ?>       
                            <td><?php echo ($formattedDOB !='')? " $formattedDOB " :"" ?></td>
                        </tr>

                        <tr>
                            <th>Height</th>
                            <td>:</td>
                            <td> <?php echo ($emp_info->HEIGHT_FEET !='')? " $emp_info->HEIGHT_FEET Feet" :"";?></td>
                        </tr>
                        <tr>
                            <th>Weight</th>
                            <td>:</td>
                            <td><?php echo ($emp_info->WEIGHT_KG !='')? " $emp_info->WEIGHT_KG Kg." :"" ?></td>
                        </tr>

                         <tr>
                            <th>Signature</th>
                            <td>:</td>
                            <td>
                             <?php $photo="upload/employee/signature/".$emp_info->EMP_SIG ; ?>    
                                <img style="width: 180px; height: 50px;" src="<?php echo base_url($photo); ?>" class="img-responsive" alt="">
                            </td>
                        </tr>

         

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        //to show the active menu function
        $('#navlist li').click(function (e) {
            e.preventDefault(); //prevent the link from being followed               
            $('#navlist li').removeClass('active');
            $(this).addClass('active');
        });

        $('#navlist li a').click(function () {
            var EMP_ID = $("#EMP_ID").attr('emp-data-id');
            var action_uri = $(this).attr('data-action');
            $.ajax({
                type: 'post',
                url: "<?php echo base_url(); ?>/" + action_uri,
                data: {EMP_ID: EMP_ID},
                beforeSend: function () {
                    $(".profile-content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $('.profile-content').html(data);
                }
            });
        });
    });
</script>