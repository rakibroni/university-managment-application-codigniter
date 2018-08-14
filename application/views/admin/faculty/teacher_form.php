<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">

<style>
    .flexy {
        display: block;
        width: 90%;
        border: 1px solid #eee;
        max-height: 200px;
        overflow: auto;
    }

    .avatar-zone {
        width: 140px;
        height: 200px;
        background-color: #CCCCCC;
    }

    .overlay-layer {
        width: 180px;
        height: 40px;
        position: absolute;
        margin-top: -40px;
        opacity: 0.5;
        background-color: #000000;
        z-index: 0;
        font-size: 25px;
        color: #FFFFFF;
        text-align: center;
        line-height: 40px;
    }

    .upload_btn {
        position: absolute;
        width: 200px;
        height: 40px;
        margin-top: -40px;
        z-index: 10;
        opacity: 0;
    }

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
<div class="row">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Teacher Insert form</h5>
            <a href="<?php echo base_url(); ?>admin/teacherList" class="btn btn-sm btn-primary pull-right">Back</a><br>
        </div>
        <form id="teacher_form" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="ibox-content">
                    <strong>NOTE : </strong> All <span class="red">*</span> field are required.
                    <h4 style="color:green">Personal Information</h4>

                    <div class="div-background">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Name ( English ) <span
                                        class="red">*</span></label>

                                <div class="col-md-5">
                                    <input type="text" name="FULL_NAME_EN" id="FULL_NAME_EN" value=""
                                           class="form-control" placeholder="Full Name In English" required>
                                    <span class="red"><?php echo form_error('FULL_NAME_EN'); ?></span>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your name in english latter here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 control-label">Email </label>

                                <div class="col-md-4">
                                    <input type="text" name="EMAIL_ADRESS" id="EMAIL"
                                           value="<?php echo set_value('EMAIL_ADRESS'); ?>"
                                           class="form-control checkEmail" placeholder="Email">
                                    <span class="red email_validation"><?php echo form_error('EMAIL_ADRESS'); ?></span>
                                </div>
                                <div class="col-md-1">
                                    <!--  <span class="btn btn-xs btn-info" id="add_email"><i style="cursor:pointer" class="fa fa-plus" ></i></span> -->
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your valid email address here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Mobile <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="MOBILE_NO" id="PHONE"
                                           value="<?php echo set_value('MOBILE_NO'); ?>"
                                           class="form-control numbersOnly" placeholder="Mobile" required>


                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your  mobile no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <h4 style="color: green">Join Information</h4>

                    <div class="div-background">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Join Date <span class="red">*</span></label>

                            <div class="col-md-2">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" required="required" class="form-control datepicker"
                                           id="JOIN_DATE" name="JOIN_DATE"
                                           value="<?php echo set_value('JOIN_DATE'); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter admission year here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Faculty</label>

                            <div class="col-md-3">
                                <select class="form-control" name="FACULTY" id="FACULTY">
                                    <option value="">-Select-</option>
                                    <?php foreach ($faculty as $row) { ?>
                                        <option
                                            value="<?php echo $row->FACULTY_ID ?>"><?php echo $row->FACULTY_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('FACULTY'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select faculty here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Department <span class="red">*</span></label>

                            <div class="col-md-3">
                                <select class="form-control" name="DEPARTMENT" id="DEPT_ID" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($department as $row) { ?>
                                        <option
                                            value="<?php echo $row->DEPT_ID ?>"><?php echo $row->DEPT_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('DEPARTMENT'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select Department here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Designation <span class="red">*</span></label>

                            <div class="col-md-3">
                                <select class="form-control" name="DESIGNATION" id="DESIGNATION" required>
                                    <option value="">-Select-</option>

                                    <?php foreach ($designation as $row) { ?>
                                        <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                    <?php } ?>

                                </select>
                                <span class="red"><?php echo form_error('DESIGNATION'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select Department here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>
                    <h4 style="color: green">Access Information</h4>

                    <div class="div-background">
                        <div class="form-group">
                            <label class="col-md-3 control-label">User Name</label>

                            <div class="col-md-3">
                                <input type="text" class="form-control" name="teacher_user_name">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Teacher user name"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>

                            <div class="col-md-3">
                                <input type="password" name="teacher_password" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Teacher password"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>


                    <br><br>

                    <div class="form-group">
                        <div class="col-sm-3  pull-right">
                            <input type="submit" class="btn btn-primary" value="Save">
                            <input type="reset" class="btn btn-white" value="Reset">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
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


    $(document).on('click', '#remove_tr', function () {
        if (counter > 0) {
            $(this).closest('tr').remove();
            counter--;
        }
        return false;
    });
    // get department by change faculty
    // get program by change faculty
    $(document).on('change', '#FACULTY_C', function () {
        var faculty_id = $(this).val();
        var url = '<?php echo site_url('common/departmentByFaculty'); ?>';

        $.ajax({
            type: 'POST',
            url: url,
            data: {faculty_id: faculty_id},
            success: function (data) {
                $('#DEPT_ID_C').html(data);
            }
        });

    });
    $(document).on('change', '#FACULTY', function () {
        var faculty_id = $(this).val();
        var url = '<?php echo site_url('common/departmentByFaculty'); ?>';

        $.ajax({
            type: 'POST',
            url: url,
            data: {faculty_id: faculty_id},
            success: function (data) {
                $('#DEPT_ID').html(data);
            }
        });

    });
    $(document).on('submit', '#teacher_form', function () {

        if (confirm("Are you sure?")) {
            return true;
        } else {
            return false;
        }


    });
</script>
