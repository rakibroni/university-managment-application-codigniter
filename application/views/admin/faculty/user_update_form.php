<link href="<?php echo base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
    .activeClass {
        background: #32cd32;
    }
    .select2-container {
        z-index: 999999;
    }
    .pop-width {
        width: 25% !important;
    }
    .red {
        color: red
    }
</style>
<form id="user_form" class="form-horizontal frmContent" method="post" >

    <input type="hidden" class="rowID" name="user_id" value="<?php echo $user->USER_ID ?>"/>

    <div class="">
        <div class="ibox-content">

            <div class="div-background">
                <span id="user_form_error"></span>
                <span id="success_msg" style="color:green;"></span>

                <div class="div-background">
                    <div class="form-group">
<!--                        <label class="col-md-3 control-label">Employee</label>-->
                        <input type="hidden" name="EMP_ID" id="EMP_ID" value="<?php echo $user->EMP_ID; ?>">

                    </div>
<!--                    <div class="form-group">-->
<!--                        <label class="col-md-3 control-label">Employee</label>-->
<!---->
<!--                        <div class="col-md-7">-->
<!--                            <input type="text" name="EMP_NAME" id="EMP_NAME" value="--><?php //echo $user->USERNAME; ?><!--" readonly>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Group</label>

                        <div class="col-md-7">
                            <select class="form-control" name="USERGRP_ID" id="USERGRP_ID">
                                <option value="">-Select-</option>
                                <?php foreach ($user_group as $row): ?>
                                    <option value="<?php echo $row->USERGRP_ID ?>" <?php echo ( $user->USERGRP_ID == $row->USERGRP_ID) ? 'selected' : set_value('USERGRP_ID') ?>><?php echo $row->USERGRP_NAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Level</label>

                        <div class="col-md-7">
                            <select class="form-control" name="USER_GRP_LVL_ID" id="USER_GRP_LVL_ID">
                                <option value="">-Select-</option>
                                <?php foreach ($user_lv as $row): ?>
                                    <option value="<?php echo $row->UG_LEVEL_ID ?>" <?php echo ( $user->USERLVL_ID == $row->UG_LEVEL_ID) ? 'selected' : set_value('USER_GRP_LVL_ID') ?>><?php echo $row->UGLEVE_NAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">User Name</label>

                        <div class="col-md-7">
                            <input table-name="sa_users" attribute-name="USERNAME" type="text" class="form-control"
                                   name="USERNAME" value="<?php echo $user->USERNAME ;  ?>" id="USERNAME">
                            <span id="username_error"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password</label>

                        <div class="col-md-7">
                            <input type="password" name="USERPW" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">User Status</label>

                                <?php
                   
                                $ACTIVE_STATUS = $user->ACTIVE_STATUS;
                              
                                $checked =  ($user->ACTIVE_STATUS== '1') ? TRUE : FALSE;
                             
                                ?>
                                <label class="control-label">
                                    <?php
                                    $data = array(
                                        'name' => 'ACTIVE_STATUS',
                                        'id' => 'ACTIVE_STATUS',
                                        'class' => 'checkBoxStatus',
                                        'value' => $ACTIVE_STATUS,
                                        'checked' => $checked,
                                    );
                                    
                                    echo form_checkbox($data);

                                    ?>
                                </label>

                        </div>

                        <?php $sub=$user->USERPW; ?>
                </div>
                <br><br>

<!--                <div class="form-group">-->
<!--                    <div class="col-sm-3  pull-right">-->
<!---->
<!--                        <input type="submit" class="btn btn-primary" value="save">-->
<!--                        <input type="reset" class="btn btn-white" value="Reset">-->
<!--                    </div>-->
<!--                </div>-->

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-8">
                        <span class="modal_msg pull-left"></span>

                            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="admin/editUserLevel"
                                   data-su-action="admin/userById" value="Update">

                        <input type="reset" class="btn btn-default btn-sm" value="Reset">
                        <span class="loadingImg"></span>
                    </div>
                </div>


            </div>
        </div>
</form>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>
<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/multiselect.min.js"></script>
<script type="text/javascript">
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
    $(document).on('change', '#USER_TYPE', function () {
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

    $(document).ready(function () {
        $('.clockpicker').clockpicker();

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    });

     $(document).on('click', '.checkBoxStatus', function () {
        var ACTIVE_STATUS = ($(this).is(':checked')) ? 1 : 0;
        $("#ACTIVE_STATUS").val(ACTIVE_STATUS);
    });
</script>

