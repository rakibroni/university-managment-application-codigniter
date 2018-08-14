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
    <span type="hidden" id="ITEM_ID" emp-data-id="<?php echo $student_details->STUDENT_ID ?>"></span>

    <div class="col-md-12">
        <div class="profile-content">
            <h4 class="green">Library Member Info</h4>
            <div class="ibox-content">
                <div class="table-responsive contentArea">
                    <table class="table table-striped table-bordered table-hover gridTable">

                    <?php //var_dump($item_info);  ?>
                        <tbody>
                        <tr>
                            <th>MEMBER ID</th>
                            <td>:</td>
                            <td><?php echo ($student_details->STUDENT_ID !='')? " $student_details->STUDENT_ID " :"" ?></td>
                        </tr>
                        <tr>
                            <th> NAME</th>
                            <td>:</td>
                            <td><?php echo ($student_details->FULL_NAME_EN !='')? " $student_details->FULL_NAME_EN " :"" ?></td>
                        </tr>
                         <tr>
                            <th>SECTION NAME</th>
                            <td>:</td>
                            <td><?php echo ($student_details->section_name !='')? " $student_details->section_name " :"" ?></td>
                        </tr>
                         <tr>
                            <th>BATCH NAME</th>
                            <td>:</td>
                            <td><?php echo ($student_details->BATCH_TITLE !='')? " $student_details->BATCH_TITLE " :"" ?></td>
                        </tr>
                        <tr>
                            <th>DEPARTMENT</th>
                            <td>:</td>
                            <td><?php echo ($student_details->DEPT_NAME !='')? " $student_details->DEPT_NAME " :"" ?></td>
                        </tr>
                        <tr>
                            <th>PROGRAM</th>
                            <td>:</td>
                            <td><?php echo ($student_details->PROGRAM_NAME !='')? " $student_details->PROGRAM_NAME " :"" ?></td>

                        </tr>

                        <tr>
                            <th>PRESENT ADDRESS</th>
                            <td>:</td>
                            <td><?php echo ($local_present_adddress !='')? "  $local_present_adddress->uni , $local_present_adddress->thn , $local_present_adddress->DIST_NAME  " :"" ?></td>
                        </tr>
                        <tr>
                            <th>PERMANENT ADDRESS</th>
                            <td>:</td>
                            <td><?php echo ($local_permanent_adddress !='')? "                 $local_permanent_adddress->uni , $local_permanent_adddress->thn ,$local_permanent_adddress->DIST_NAME  " :"" ?></td>
                        </tr>
                      
                       
                        <tr>
                            <th>MOBILE</th>
                            <td>:</td>
                            <td><?php echo ($student_details->MOBILE_NO !='')? " $student_details->MOBILE_NO " :"" ?></td>
                        </tr>
                        <tr>
                            <th>EMAIL</th>
                            <td>:</td>
                            <td><?php echo ($student_details->EMAIL_ADRESS !='')? " $student_details->EMAIL_ADRESS " :"" ?></td>
                        </tr>
                        <tr>
                            <th>GENDER </th>
                            <td>:</td>
                            <td><?php echo ($student_details->GENDER !='')? " $student_details->GENDER " :"" ?></td>
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