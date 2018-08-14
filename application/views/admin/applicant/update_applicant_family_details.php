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
    <?php if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
    <div class="ibox-tools">

        <span data-action="admin/applicantFamillyDetails" id="update_family_cancel_btn"
              class="btn btn-success btn-xs pull-right" applicant-data-id="<?php echo $applicant_id; ?>"
              role="button"><i class="fa fa-mail-reply"></i> Back</span>
    </div>
    <?php  endif; ?>
</div>

<div class="ibox-content">
    <form id="applicant_family_form" class="form-horizontal fContent" method="post"
          enctype="multipart/form-data">
        <div class="">
            <div class="div-background">
                <input type="hidden" name="APP_FATHER_ID" value="<?php echo $fathersInfo->APP_PARENT_ID; ?>">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-5 control-label">Father's Name <span class="red">*</span></label>

                        <div class="col-md-5">
                            <input type="text" name="FATHER_NAME" id="FATHER_NAME"
                                   value="<?php echo $fathersInfo->GURDIAN_NAME; ?>" class="form-control"
                                   placeholder="Father's Name">
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your father's name here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Father's Occupation</label>
                        <div class="col-md-5">
                            <select class="form-control" name="FATHER_OCU" id="FATHER_OCU">
                                <option value="">-Select-</option>
                                <?php foreach ($occupation as $row): ?>
                                    <option value="<?php echo $row->LKP_ID ?>" <?php echo ($fathersInfo->OCCUPATION == $row->LKP_ID) ? 'selected' : set_value('MOTHER_OCU') ?>><?php echo $row->LKP_NAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your Father Occupation here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Father's Mobile </label>

                        <div class="col-md-5">
                            <input type="text" name="FATHER_PHN" id="FATHER_PHN"
                                   value="<?php echo $fathersInfo->MOBILE_NO; ?>"
                                   class="form-control numbersOnly" placeholder="Father's Phone">
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your Father's  mobile no here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Help"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Father's Email </label>

                        <div class="col-md-5">
                            <input type="text" name="FATHER_EMAIL" id="FATHER_EMAIL"
                                   value="<?php echo $fathersInfo->EMAIL_ADRESS; ?>"
                                   class="form-control checkEmail" placeholder="Father's Email">
                            <span class="red father_email_validation"></span>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your father's valid email address here"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Name and address of the work </label>

                        <div class="col-md-5">
                                        <textarea id="FATHER_WORK_ADRESS" class="form-control" rows="5"
                                                  name="FATHER_WORK_ADRESS"><?php echo set_value('FATHER_WORK_ADRESS'); ?><?php echo $fathersInfo->WORKING_ORG; ?></textarea>

                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Enter your local guardian address here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Help"></i>
                        </div>
                    </div>

                </div>


                <input type="hidden" name="APP_MOTHER_ID" value="<?php echo $motherInfo->APP_PARENT_ID; ?>">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-5 control-label">Mother's Name <span class="red">*</span></label>

                        <div class="col-md-5">
                            <input type="text" name="MOTHER_NAME" id="MOTHER_NAME"
                                   value="<?php echo $motherInfo->GURDIAN_NAME; ?>" class="form-control"
                                   placeholder="Mother's Name">
                            <span class="red"><?php echo form_error('MOTHER_NAME'); ?></span>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your mother's name here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Mother's Occupation</label>

                        <div class="col-md-5">
                            <select class="form-control" name="MOTHER_OCU" id="MOTHER_OCU">
                                <option value="">-Select-</option>
                                <?php foreach ($occupation as $row): ?>
                                    <option value="<?php echo $row->LKP_ID ?>" <?php echo ($motherInfo->OCCUPATION == $row->LKP_ID) ? 'selected' : set_value('MOTHER_OCU') ?>><?php echo $row->LKP_NAME ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your mother's occupation here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Mother's Mobile</label>

                        <div class="col-md-5">
                            <input type="text" name="MOTHER_PHN" id="MOTHER_PHN"
                                   value="<?php echo $motherInfo->MOBILE_NO; ?>"
                                   class="form-control numbersOnly" placeholder="Mother's Phone">
                        </div>

                        <div class="col-md-1">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your mother's valid mobile no here"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Mother's Email </label>

                        <div class="col-md-5">
                            <input type="text" name="MOTHER_EMAIL" id="MOTHER_EMAIL"
                                   value="<?php echo $motherInfo->EMAIL_ADRESS; ?>"
                                   class="form-control checkEmail" placeholder="Mother's Email">
                            <span class="red mother_email_validation"></span>
                        </div>

                        <div class="col-md-1">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your mother's valid email address here"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Name and address of the work </label>

                        <div class="col-md-5">
                                    <textarea id="MOTHER_WORK_ADDRESS" class="form-control" rows="5"
                                              name="MOTHER_WORK_ADDRESS"><?php echo $motherInfo->WORKING_ORG; ?></textarea>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Enter your local guardian address here" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Help"></i>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Local Emergency Guardian </label>

                    <div class="col-md-3">
                        <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
                               value="F" <?php echo ($local_guardian->GUARDIAN_TYPE == 'F') ? "checked" : ""; ?> >&nbsp;
                        Father &nbsp;
                        <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
                               value="M" <?php echo ($local_guardian->GUARDIAN_TYPE == 'M') ? "checked" : ""; ?> >&nbsp;
                        Mother &nbsp;
                        <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
                               value="O" <?php echo ($local_guardian->GUARDIAN_TYPE == 'O') ? "checked" : ""; ?> >&nbsp;
                        Others
                    </div>
                    <div class="col-md-2">
                        <i class="fa fa-info-circle pointer2" data-content="Select your local guardian here"
                           data-placement="right" data-toggle="popover" data-container="body"
                           data-original-title="" title="Help"></i>
                    </div>
                </div>


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
                <div class="col-sm-3  pull-right">
                    <input type="button" class="btn btn-primary btn-xs fSubmit pull-right"
                           data-action="admin/updateApplicantFamilyDetails/<?php echo $applicant_id; ?>"
                           data-param="<?php echo $applicant_id; ?>"
                           data-su-action="admin/applicantFamillyDetails" value="Update">
                </div>
            </div>
        </div>
    </form>
</div>

<script>

    $("#applicant_family_form").validate({
        rules: {
            FATHER_NAME: {required: true},
            MOTHER_NAME: {required: true}
        },
        messages: {
            FATHER_NAME: "Required field",
            MOTHER_NAME: "Required field"
        }
    });


   
    $(document).on("click", ".local_emergency_guardian", function () {
        var thisVal = $(this).val();
        if (thisVal == 'O') {
            $(".is_required_o").attr("required", "required");
        } else {
            $(".is_required_o").removeAttr("required");
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
 

    // Cancel Button

    $('#update_family_cancel_btn').click(function () {
        var APPLICANT_ID = $("#APPLICANT_ID").attr('applicant-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url() ?>/" + action_uri,
            data: {APPLICANT_ID: APPLICANT_ID},
            beforeSend: function () {
                $(".profile-content").html("<img src='<?php echo site_url()?>/assets/img/loader.gif' />");
            },
            success: function (data) {
                $('.profile-content').html(data);
            }
        });
    });

</script>
