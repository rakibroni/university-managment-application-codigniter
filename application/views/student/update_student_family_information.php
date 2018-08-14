<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/keyboard/keyboard.css" rel="stylesheet">

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

    }

    .overlay-layer {
        width: 180px;
        height: 40px;
        position: absolute;
        margin-top: -40px;
        opacity: 0.5;
        background-color: #000000;
        z-index: 0;
        font-size: 15px;
        color: #FFFFFF;
        text-align: center;
        line-height: 40px;

    }

    .avatar-zone-sig {
        width: 140px;
        height: 92px;

    }

    .overlay-layer-sig {
        width: 180px;
        height: 40px;
        position: absolute;
        margin-top: -40px;
        opacity: 0.5;
        background-color: #000000;
        z-index: 0;
        font-size: 15px;
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

<div class="ibox-title">
    <h5>Family Information</h5>
    <div class="ibox-tools">
        <span data-action="student/familyDetails" id="update_family_cancel_btn" title="Back to previous"
              class="btn btn-success btn-xs pull-right" student-data-id="<?php echo $student_id; ?>"
              role="button"><i class="fa fa-mail-reply"></i> Back</span>
    </div>
</div>

<div class="ibox-content">
    <form id="student_family_form" class="form-horizontal fContent" method="post">
        <div class="">
            <div class="div-background">
                <input type="hidden" name="APP_FATHER_ID" value="<?php if (!empty($fathersInfo)) {
                    echo $fathersInfo->STU_PARENT_ID;
                } ?>">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-5 control-label">Father's Name <span class="red">*</span></label>

                        <div class="col-md-5">
                            <input type="text" name="FATHER_NAME" id="FATHER_NAME"
                                   value="<?php if (!empty($fathersInfo)) {
                                       echo $fathersInfo->GURDIAN_NAME;
                                   } ?>" class="form-control"
                                   placeholder="Father's Name">
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your father's name here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Enter father's name"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Father's Occupation</label>
                        <div class="col-md-5">
                            <select class="form-control" name="FATHER_OCU" id="FATHER_OCU">
                                <option value="">-Select-</option>
                                <?php foreach ($occupation as $row): ?>
                                    <option value="<?php echo $row->LKP_ID ?>" <?php if (!empty($fathersInfo)) {
                                        echo ($fathersInfo->OCCUPATION == $row->LKP_ID) ? 'selected' : set_value('FATHER_OCU');
                                    } ?>><?php echo $row->LKP_NAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your Father Occupation here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Select father's occupation"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Father's Mobile </label>

                        <div class="col-md-5">
                            <input type="text" name="FATHER_PHN" id="FATHER_PHN"
                                   value="<?php if (!empty($fathersInfo)) {
                                       echo $fathersInfo->MOBILE_NO;
                                   } ?>"
                                   class="form-control numbersOnly" placeholder="Father's Phone">
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your Father's  mobile no here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Enter father's mobile no."></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Father's Email </label>

                        <div class="col-md-5">
                            <input type="text" name="FATHER_EMAIL" id="FATHER_EMAIL"
                                   value="<?php if (!empty($fathersInfo)) {
                                       echo $fathersInfo->EMAIL_ADRESS;
                                   } ?>"
                                   class="form-control checkEmail" placeholder="Father's Email">
                            <span class="red father_email_validation"></span>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your father's valid email address here"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Enter father's email address"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Name and address of the work </label>

                        <div class="col-md-5">
                            <textarea id="FATHER_WORK_ADRESS" class="form-control" rows="4"
                                      name="FATHER_WORK_ADRESS"><?php if (!empty($fathersInfo)) {
                                    echo $fathersInfo->WORKING_ORG;
                                } ?></textarea>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Enter your local guardian address here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Enter name and address of work"></i>
                        </div>
                    </div>

                </div>


                <input type="hidden" name="APP_MOTHER_ID" value="<?php if (!empty($motherInfo)) {
                    echo $motherInfo->STU_PARENT_ID;
                } ?>">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-5 control-label">Mother's Name <span class="red">*</span></label>

                        <div class="col-md-5">
                            <input type="text" name="MOTHER_NAME" id="MOTHER_NAME"
                                   value="<?php if (!empty($motherInfo)) {
                                       echo $motherInfo->GURDIAN_NAME;
                                   } ?>" class="form-control"
                                   placeholder="Mother's Name">
                            <span class="red"><?php //echo form_error('MOTHER_NAME'); ?></span>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your mother's name here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Enter mother's name"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Mother's Occupation</label>

                        <div class="col-md-5">
                            <select class="form-control" name="MOTHER_OCU" id="MOTHER_OCU">
                                <option value="">-Select-</option>
                                <?php foreach ($occupation as $row): ?>
                                    <option value="<?php echo $row->LKP_ID ?>" <?php if (!empty($motherInfo)) {
                                        echo ($motherInfo->OCCUPATION == $row->LKP_ID) ? 'selected' : set_value('MOTHER_OCU');
                                    } ?>><?php echo $row->LKP_NAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your mother's occupation here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Select mother's occupation"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Mother's Mobile</label>

                        <div class="col-md-5">
                            <input type="text" name="MOTHER_PHN" id="MOTHER_PHN"
                                   value="<?php if (!empty($motherInfo)) {
                                       echo $motherInfo->MOBILE_NO;
                                   } ?>"
                                   class="form-control numbersOnly" placeholder="Mother's Phone">
                        </div>

                        <div class="col-md-1">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your mother's valid mobile no here"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Enter mother's mobile no."></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Mother's Email </label>

                        <div class="col-md-5">
                            <input type="text" name="MOTHER_EMAIL" id="MOTHER_EMAIL"
                                   value="<?php if (!empty($motherInfo)) {
                                       echo $motherInfo->EMAIL_ADRESS;
                                   } ?>"
                                   class="form-control checkEmail" placeholder="Mother's Email">
                            <span class="red mother_email_validation"></span>
                        </div>

                        <div class="col-md-1">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your mother's valid email address here"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Enter mother's email address"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Name and address of the work </label>

                        <div class="col-md-5">
                            <textarea id="MOTHER_WORK_ADDRESS" class="form-control" rows="4"
                                      name="MOTHER_WORK_ADDRESS"><?php if (!empty($motherInfo)) {
                                    echo $motherInfo->WORKING_ORG;
                                } ?></textarea>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Enter your local guardian address here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Enter name and address of work"></i>
                        </div>
                    </div>

                </div>

                <br>
                <div class="form-group">
                    <label class="col-md-3 control-label">Local Emergency Guardian </label>

                    <div class="col-md-4">
                        <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
                               value="F" <?php if (!empty($local_guardian)) {
                            echo ($local_guardian->GUARDIAN_TYPE == 'F') ? "checked" : "";
                        } ?> >&nbsp;
                        Father &nbsp;
                        <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
                               value="M" <?php if (!empty($local_guardian)) {
                            echo ($local_guardian->GUARDIAN_TYPE == 'M') ? "checked" : "";
                        } ?> >&nbsp;
                        Mother &nbsp;
                        <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
                               value="O" <?php if (!empty($local_guardian)) {
                            echo ($local_guardian->GUARDIAN_TYPE == 'O') ? "checked" : "";
                        } ?> >&nbsp;
                        Others
                    </div>
                    <div class="col-md-2">
                        <i class="fa fa-info-circle pointer2" data-content="Select your local guardian here"
                           data-placement="right" data-toggle="popover" data-container="body"
                           data-original-title="" title="Select local emergency guardan"></i>
                    </div>
                </div>


                <!-- Local Emergency guardian other -->

                <?php if (!empty($local_Other_guardian)) : ?>

                    <div id="local_guardian"
                         class="<?php if (!empty($local_Other_guardian)) {
                             echo ($local_guardian->GUARDIAN_TYPE == 'O') ? "toggle-div1" : "toggle-div";
                         } ?>">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Local Guardian Name</label>

                            <div class="col-md-3">
                                <input type="text" name="LOCAL_GAR_NAME" id="LOCAL_GAR_NAME"
                                       value="<?php if (!empty($local_Other_guardian)) {
                                           echo $local_Other_guardian->GURDIAN_NAME;
                                       } ?>"
                                       class="form-control" placeholder="Local Guardian Name">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Local Guardian Name"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Enter local guardian name"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Local Guardian Relation</label>

                            <div class="col-md-3">
                                <select class="form-control " id="LOCAL_GAR_RELATION" name="LOCAL_GAR_RELATION"
                                        id="LOCAL_GAR_RELATION">
                                    <option value="">-Select-</option>
                                    <?php foreach ($relation as $row): ?>
                                        <option value="<?php echo $row->LKP_ID ?>" <?php if (!empty($local_Other_guardian)) {
                                            echo ($local_Other_guardian->GUARDIAN_RELATION == $row->LKP_ID) ? 'selected' : set_value('LOCAL_GAR_RELATION');
                                        } ?>><?php echo $row->LKP_NAME ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Select your Local Guardian relation" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title=""
                                   title="Select relationship"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Local Guardian Address </label>

                            <div class="col-md-3">
            <textarea class="form-control " id="LOCAL_GAR_ADDRESS"
                      name="LOCAL_GAR_ADDRESS"><?php if (!empty($local_Other_guardian)) {
                    echo $local_Other_guardian->ADDRESS;
                } ?></textarea>

                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Enter your local guardian address here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title=""
                                   title="Enter local guardian address"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Local Guardian Mobile</label>

                            <div class="col-md-3">
                                <input type="text" name="LOCAL_GAR_PHN" id="LOCAL_GAR_PHN"
                                       value="<?php if (!empty($local_Other_guardian)) {
                                           echo $local_Other_guardian->MOBILE_NO;
                                       } ?>"
                                       class="form-control  numbersOnly" placeholder="Mobile">
                            </div>

                            <div class="col-md-1">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your Local Guardian  mobile no here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Enter local guardian mobile no."></i>
                            </div>
                        </div>
                    </div>

                <?php else: ?>

                    <div id="local_guardian" style="display: none;"
                         class="<?php if (!empty($local_guardian)) {
                             echo ($local_guardian->GUARDIAN_TYPE == 'O') ? "toggle-div1" : "toggle-div";
                         } ?>">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Local Guardian Name</label>

                            <div class="col-md-3">
                                <input type="text" name="LOCAL_GAR_NAME" id="LOCAL_GAR_NAME"
                                       class="form-control" placeholder="Local Guardian Name">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Local Guardian Name"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Enter local guardian name"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Local Guardian Relation</label>

                            <div class="col-md-3">
                                <select class="form-control " id="LOCAL_GAR_RELATION" name="LOCAL_GAR_RELATION"
                                        id="LOCAL_GAR_RELATION">
                                    <option value="">-Select-</option>
                                    <?php foreach ($relation as $row): ?>
                                        <option value="<?php echo $row->LKP_ID ?>" <?php // if(!empty($local_guardian)) {echo ($local_guardian->GUARDIAN_RELATION == $row->LKP_ID) ? 'selected' : set_value('LOCAL_GAR_RELATION');} ?>><?php echo $row->LKP_NAME ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Select your Local Guardian relation" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title=""
                                   title="Select relationship"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Local Guardian Address </label>

                            <div class="col-md-3">

                            <textarea class="form-control " id="LOCAL_GAR_ADDRESS"
                                      name="LOCAL_GAR_ADDRESS"></textarea>

                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Enter your local guardian address here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title=""
                                   title="Enter local guardian address"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Local Guardian Mobile</label>

                            <div class="col-md-3">
                                <input type="text" name="LOCAL_GAR_PHN" id="LOCAL_GAR_PHN"
                                       class="form-control  numbersOnly" placeholder="Mobile">
                            </div>

                            <div class="col-md-1">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your Local Guardian  mobile no here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Enter local guardian mobile no."></i>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                <?php endif; ?>


            </div>

            <br>
            <div class="form-group">
                <div class="col-md-4  pull-right">
                    <input type="button" class="btn btn-primary btn-sm fSubmit pull-right"
                           data-action="student/updateStudentFamilyDetails"
                           data-su-action="student/familyDetails" data-param="<?php echo $student_id; ?>"
                           value="Update">
                </div>
            </div>
        </div>
    </form>
</div>

<script>

    $("#student_family_form").validate({
        rules: {
            FATHER_NAME: {required: true},
            MOTHER_NAME: {required: true}
        },
        messages: {
            FATHER_NAME: "Father Name required",
            MOTHER_NAME: "Mother name required"
        }
    });


    $(document).on("click", ".local_emergency_guardian", function () {

        var is_local = $(this).val();

        if (is_local == 'O') {
            $('#local_guardian').show();

        } else {
            $('#local_guardian').hide();
        }
    });


    //This function  is use for student image preview before upload
    function upload_img(input) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                isSuccess = fileTypes.indexOf(extension) > -1;
            var fsize = $('#propic')[0].files[0].size;
            if (isSuccess) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = reader.result;

                    image.onload = function () {
                        if (image.height > 300 && image.width > 300) {
                            alert("Dimension prefarable 300 X 300 px ");
                        } else if (fsize > 102400) {
                            alert("Size should not exceed 100 KB ");
                        } else {
                            $('#img_id').attr('src', e.target.result);
                            $('#p_img_id').attr('src', e.target.result);

                        }
                    };
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert("This file type does not support");
            }
        }
    }
    //This function  is use for student image preview before upload
    function upload_img_sig(input) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                isSuccess = fileTypes.indexOf(extension) > -1;
            var fsize = $('#sigpic')[0].files[0].size;
            if (isSuccess) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = reader.result;

                    image.onload = function () {
                        if (image.height > 80 && image.width > 300) {
                            alert("Dimension prefarable 300 X 80 px ");
                        } else if (fsize > 61440) {
                            alert("Size should not exceed 60 KB ");
                        } else {
                            $('#sig_id').attr('src', e.target.result);
                            $('#p_sig_id').attr('src', e.target.result);
                        }
                    };
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert("This file type does not support");
            }
        }
    }

    $(document).on("click", ".same_as_present", function () {
        var same_as_present = $('input[name=same_as_present]:checked').val();

        if (same_as_present == 'YES') {
            $('#permanent_address').find('input, textarea, button, select').attr('disabled', true);
        } else {
            $('#permanent_address').find('input, textarea, button, select').attr('disabled', false);
        }

    });
    $(document).on("change", "#DIVISION_ID", function () {
        $("#THANA_ID").val("");
        $("#POLICE_STATION_ID").val("");
        $("#POST_OFFICE_ID").val("");
        $("#UNION_ID").val("");
        var DIVISION_ID = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/dis_by_div_id',
            data: {DIVISION_ID: DIVISION_ID},
            success: function (data) {
                $("#DISTRICT_ID").html(data)
            }
        });
    });
    $(document).on("change", "#DISTRICT_ID", function () {
        $("#THANA_ID").val("");
        $("#POLICE_STATION_ID").val("");
        $("#POST_OFFICE_ID").val("");
        $("#UNION_ID").val("");
        var DISTRICT_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/up_thana_by_dis_id',
            data: {DISTRICT_ID: DISTRICT_ID},
            success: function (data) {
                $("#THANA_ID").html(data)
            }
        });

    });
    $(document).on("change", "#THANA_ID", function () {
        var THANA_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/post_office_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#POST_OFFICE_ID").html(data)
            }
        });
    });
    $(document).on("change", "#P_DIVISION_ID", function () {
        $("#P_THANA_ID").val("");
        $("#P_POLICE_STATION_ID").val("");
        $("#P_POST_OFFICE_ID").val("");
        $("#P_UNION_ID").val("");
        var DIVISION_ID = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/dis_by_div_id',
            data: {DIVISION_ID: DIVISION_ID},
            success: function (data) {
                $("#P_DISTRICT_ID").html(data)
            }
        });
    });
    $(document).on("change", "#P_DISTRICT_ID", function () {
        $("#P_THANA_ID").val("");
        $("#P_POLICE_STATION_ID").val("");
        $("#P_POST_OFFICE_ID").val("");
        $("#P_UNION_ID").val("");
        var DISTRICT_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/up_thana_by_dis_id',
            data: {DISTRICT_ID: DISTRICT_ID},
            success: function (data) {
                $("#P_THANA_ID").html(data)
            }
        });

    });
    $(document).on("change", "#P_THANA_ID", function () {
        var THANA_ID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>common/post_office_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_POST_OFFICE_ID").html(data)
            }
        });
    });


    $(document).on('click', '#siblin', function () {
        if ($('input[name="SIBLING_EXIST"]:checked').val() == "YES") {
            $('.sibId').show();
        } else {
            $('.sibId').hide();
        }
    });
    $(document).on('click', '#scholarship_id', function () {
        if ($('input[name="SCHOLARSHIP"]:checked').val() == "YES") {
            $('.scholarships').show();
        } else {
            $('.scholarships').hide();
        }
    });
    $(document).on('click', '#expelled_id', function () {
        if ($('input[name="EXPELLED"]:checked').val() == "YES") {
            $('.expelled_div').show();
        } else {
            $('.expelled_div').hide();
        }
    });
    $(document).on('click', '#arrested_id', function () {
        if ($('input[name="ARRESTED"]:checked').val() == "YES") {
            $('.arrested_div').show();
        } else {
            $('.arrested_div').hide();
        }
    });
    $(document).on('click', '#convicted_id', function () {
        if ($('input[name="CONVICTED"]:checked').val() == "YES") {
            $('.convicted_div').show();
        } else {
            $('.convicted_div').hide();
        }
    });
    $(document).on('click', '#apply_before_id', function () {
        if ($('input[name="APPLY_BEFORE"]:checked').val() == "YES") {
            $('.apply_before_div').show();
        } else {
            $('.apply_before_div').hide();
        }
    });

    $('#WEIGHT_KG').on('keyup', function () {
        var pound = parseFloat("2.20462");
        var total = ($(this).val() * pound);
        var n = total.toFixed(2);
        $("#WEIGHT_LBS").val(n);

    });
    $('#WEIGHT_LBS').on('keyup', function () {
        var kg = parseFloat("0.453592");
        var total = ($(this).val() * kg);
        var n = total.toFixed(2);
        $("#WEIGHT_KG").val(n)
    });
    $('#HEIGHT_FEET').on('keyup', function () {
        var cm = parseFloat("30.48");
        var total = ($(this).val() * cm);
        var n = total.toFixed(2);
        $("#HEIGHT_CM").val(n);

    });
    $('#HEIGHT_CM').on('keyup', function () {
        var ft = parseFloat("0.0328084");
        var total = ($(this).val() * ft);
        var n = total.toFixed(2);
        $("#HEIGHT_FEET").val(n)
    });

    // get batch by change program
    $(document).on('change', '#PROGRAM_ID', function () {
        var program_id = $(this).val();
        var session_id = $("#SESSION").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('common/batchByProgramId'); ?>',
            data: {program_id: program_id, session_id: session_id},
            success: function (data) {
                $('#BATCH_ID').html(data);
            }
        });
    });


    // Cancel Button

    $('#update_family_cancel_btn').click(function () {
        var STUDENT_ID = $(this).attr('student-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url(); ?>/" + "/" + action_uri + '/' + STUDENT_ID,
            data: {STUDENT_ID: STUDENT_ID},
            beforeSend: function () {
                $(".profile-content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('.profile-content').html(data);
            }
        });
    });

</script>
