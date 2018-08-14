<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">

<style>
    .red {
        color: red
    }

    .pointer2 {
        cursor: pointer;
    }

    .div-background {
        background-color: #D9E0E7;
        padding: 20px;
        border-radius: 10px
    }

    .toggle-div {
        display: none;
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 10px;
    }

    .toggle-div-course {
        display: none;
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 10px;
        width: 400px;
    }

    .toggle-div1 {
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 10px;
    }
</style>
<link href="<?php echo base_url(); ?>assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Create User</h5>
        <a title="View user information" class="btn btn-primary btn-xs pull-right" href="<?php echo site_url() ?>/admin/userList" target=""> Back</a>
    </div>
    <form id="user_form" class="form-horizontal" method="post">
        <div class="">
            <div class="ibox-content">
                <strong>NOTE : </strong> All <span class="red">*</span> field are required. Duplicate
                Email,Biometric ID ,User name not allow.
              

                <div class="div-background">
                    <span id="user_form_error"></span>
                    <span id="success_msg" style="color:green;"></span>

                    
                    <h4 style="color: green">Access Information</h4>

                    <div class="div-background">
                        <div class="form-group">
                        <label class="col-md-3 control-label">Employee</label>

                            <div class="col-md-3">
                                <select class="form-control select2Dropdown" name="EMP_ID" id="EMP_ID">
                                    <option value="">-Select-</option>
                                    <?php foreach ($emp_list as $row) { ?>
                                    <option
                                    value="<?php echo $row->EMP_ID ?>"><?php echo $row->FULL_ENAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('EMP_ID'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please select employee"
                                data-placement="right" data-toggle="popover" data-container="body"
                                data-original-title="" title="Help"></i>
                            </div>
                        </div>     
                        <div class="form-group">
                            <label class="col-md-3 control-label">User Group</label>

                            <div class="col-md-3">
                                <select class="form-control" name="USERGRP_ID" id="USERGRP_ID">
                                    <option value="">-Select-</option>
                                    <?php foreach ($user_group as $row) { ?>
                                    <option
                                    value="<?php echo $row->USERGRP_ID ?>"><?php echo $row->USERGRP_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('FACULTY'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select user group here"
                                data-placement="right" data-toggle="popover" data-container="body"
                                data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">User Level</label>

                            <div class="col-md-3">
                                <select class="form-control" name="USER_GRP_LVL_ID" id="USER_GRP_LVL_ID">
                                    <option value="">-Select-</option>
                                </select>
                                <span class="red"><?php echo form_error('FACULTY'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select user group level here"
                                data-placement="right" data-toggle="popover" data-container="body"
                                data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">User Name</label>

                            <div class="col-md-3">
                                <input table-name="sa_users" attribute-name="USERNAME" type="text" class="form-control"
                                name="USERNAME" id="USER_EMAIL_ID">
                                <span id="username_error"></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter user name"
                                data-placement="right" data-toggle="popover" data-container="body"
                                data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>

                            <div class="col-md-3">
                                <input type="text" name="USERPW" value="123456" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter password"
                                data-placement="right" data-toggle="popover" data-container="body"
                                data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <div class="col-sm-3  pull-right">

                            <input type="submit" class="btn btn-primary" value="save">
                            <input type="reset" class="btn btn-white" value="Reset">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--<script src="<?php //echo base_url();                                                                                                                                                  ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $(function () {
            $(function () {
                $(".datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1950:+0'
                });
            });
        });


        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true
        });
        $(document).blur('#birth_date', function () {
            var dob = $("#birth_date").val();
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#age').html(age + ' years old');
        });

    //email validation
    $(document).on('keyup', '#EMAIL', function () {
        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str)) {
            $(".email_validation").html('Invalid Email address');
        } else {
            $(".email_validation").html('');
        }

    });


    $("#user_form").on('submit', function (e) {
        e.preventDefault();
        if (confirm("Are you sure?")) {

            var form = $('#user_form');
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('admin/saveUser'); ?>',
                data: form.serialize(),
                success: function (data) {
                    if (data == 'DU') {
                        /* $("#user_form_error").css("color","red");
                        $("#user_form_error").text("This user name already exits. change your user name and save ");*/
                        alert('This user name already exits. change your user name and save');

                    } else if (data == 'DE') {
                        /*$("#user_form_error").css("color","red");
                        $("#user_form_error").text("This email already exits. change your email and save ");*/
                        alert('This email already exits. change your email and save ');
                    } else if (data == "DB") {
                        /* $("#user_form_error").css("color","red");
                        $("#user_form_error").text("This biometric already exits. change your biometric and save ");*/
                        alert('This biometric already exits. change your biometric and save');
                    } else {
                        $("#success_msg").text("Successfully inserted").fadeOut(3000);
                        $('#user_form').trigger("reset");
                        //$(window).attr("location",'<?php echo site_url("admin/createUser") ?>');

                    }
                }
            });
        } else {
            return false;
        }


    });
    // user lavel value on change user group
    $(document).on('change', '#DEPARTMENT_ID', function () {
        var dept_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admin/get_designationByDept'); ?>',
            data: {dept_id: dept_id},
            success: function (data) {
                $('#DESIGNATION_ID').html(data);
            }
        });
    });
     // user lavel value on change user group
     $(document).on('change', '#USERGRP_ID', function () {
        var user_group_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admin/userLavelByGrId'); ?>',
            data: {user_group_id: user_group_id},
            success: function (data) {
                $('#USER_GRP_LVL_ID').html(data);
            }
        });
    });

      // user lavel value on change user group
     $(document).on('change', '#EMP_ID', function () {
        var EMP_ID = $(this).val();
        //alert(EMP_ID);
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admin/userLavelByEmailId'); ?>',
            data: {EMP_ID: EMP_ID},

            success: function (data) {
                //alert(JSON.stringify(data.EMAIL));
                var myObject = JSON.parse(data);
                var email=myObject.EMAIL;

                //$('#USER_EMAIL_ID').html(data);
                 $("input#USER_EMAIL_ID").val(email);
            }
        });
    });

     $(document).on('keyup', '#USERNAME', function () {
        var table_name = $("#USERNAME").attr('table-name');
        var attribute_name = $("#USERNAME").attr('attribute-name');
        var attribute_value = $(this).val();
        if (attribute_value == '') {
            $("#username_error").text("")
        } else {
            $.ajax({
                type: "post",
                url: '<?php echo site_url('common/checkDuplicateByField'); ?>',
                data: {table_name: table_name, attribute_name: attribute_name, attribute_value: attribute_value},
                success: function (data) {
                    if (data == 'Y') {
                        $("#username_error").css("color", "red");
                        $("#username_error").text("This user name already exits. please try another user name");
                    } else {
                        $("#username_error").css("color", "green");
                        $("#username_error").text("This user name is available")
                    }
                }
            });
        }
    });
     $(document).on('change', '.user_type', function () {
        var user_type = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admin/userWiseDepartment');?>',
            data: {user_type: user_type},
            success: function (data) {
                $('#DEPARTMENT_ID').html(data);
            }
        });
    });
</script>
