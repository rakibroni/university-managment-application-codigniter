<style>
    .panel-group .panel-heading + .panel-collapse > .panel-body {
        border: 1px solid #ddd;
    }

    .panel-group,
    .panel-group .panel,
    .panel-group .panel-heading,
    .panel-group .panel-heading a,
    .panel-group .panel-title,
    .panel-group .panel-title a,
    .panel-group .panel-body,
    .panel-group .panel-group .panel-heading + .panel-collapse > .panel-body {
        border-radius: 2px;
        border: 0;
    }

    .panel-group .panel-heading {
        padding: 0;
    }

    .panel-group .panel-heading a {
        display: block;
        background: lightseagreen;
        color: #ffffff;
        padding: 7px 40px;
        text-decoration: none;
        position: relative;
    }

    .panel-group .panel-heading a.collapsed {
        background: #eeeeee;
        color: inherit;
    }

    .panel-group .panel-heading a:after {
        content: '-';
        position: absolute;
        left: 15px;
        top: 2px;
        font-size: 20px;
    }

    .panel-group .panel-heading a.collapsed:after {
        content: '+';
    }

    .panel-group .panel-collapse {
        margin-top: 5px !important;
    }

    .panel-group .panel-body {
        background: #ffffff;
        padding: 15px;
    }

    .panel-group .panel {
        background-color: transparent;
    }

    .panel-group .panel-body p:last-child,
    .panel-group .panel-body ul:last-child,
    .panel-group .panel-body ol:last-child {
        margin-bottom: 0;
    }
</style>

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Your Profile</h5>

        <div class="ibox-tools">

        </div>
    </div>
    <div class="ibox-content" style="display: block;">
        <div class="panel-body">

            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="75"
                     aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <span>40% Complete (success)</span>
                </div>
            </div>
            <div id="accordion" class="panel-group">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#personal_info" data-parent="#accordion" data-toggle="collapse"
                               aria-expanded="false" class="collapsed">Personal Information</a>
                        </h4>
                        <i class="fa fa-check fa-2x pull-right" style="color: green;
                                font-size: 20px;
                                margin: -25px 10px 0 0;">
                        </i>
                    </div>
                    <div class="panel-collapse collapse" id="personal_info" aria-expanded="false"
                         style="height:0px">
                        <form action="<?php echo base_url() ?>teacher/updateTrPersonalInfo" method="post"
                              enctype="multipart/form-data">

                            <div class="panel-body">
                                <div class="div-background">
                                    <div class="col-md-8">
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Name ( English ) <span
                                                    class="red">*</span></label>

                                            <div class="col-md-5">
                                                <input type="text" name="FULL_NAME" id="FULL_NAME"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->FULL_NAME ?>"
                                                       class="form-control" placeholder="Full Name In English"
                                                       required>
                                                <input type="hidden" name="USER_ID"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->USER_ID ?>">
                                                <span class="red"></span>
                                            </div>
                                            <div class="col-md-1">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your name in english latter here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">নাম ( বাংলা ) <span
                                                    class="red">*</span></label>

                                            <div class="col-md-5">
                                                <input type="text" name="FULL_NAME_BN" id="FULL_NAME_BN"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->FULL_NAME_BN ?>"
                                                       class="form-control keyboardInput"
                                                       placeholder="বাংলা নাম" required>
                                                        <span
                                                            class="red"><?php echo form_error('FULL_NAME_BN'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="বাংলায় আপনার  নাম লিখুন" data-placement="right"
                                                   data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group  col-md-12">
                                            <label class="col-md-3 control-label">Date of Birth <span
                                                    class="red">*</span></label>

                                            <div class="col-md-3">
                                                <div class="input-group date">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-calendar"></i></span>
                                                    <input type="text" name="DOB" id="DOB" readonly="readonly"
                                                           class="form-control datepicker"
                                                           value="<?php if (!empty($tcr_personal_info)) echo date('d-M-Y', strtotime($tcr_personal_info->DOB)) ?>"
                                                           required>

                                                </div>
                                                        <span
                                                            class="red"><?php echo form_error('DOB'); ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <i class="fa fa-info-circle pointer2 "
                                                   data-content="Select birth date from calender"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Place of Birth <span
                                                    class="red">*</span></label>

                                            <div class="col-md-5">
                                                <div class="input-group date">
                                                    <input type="text" name="PLACE_OF_BIRTH" id="PLACE_OF_BIRTH"
                                                           class="form-control"
                                                           value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->PLACE_OF_BIRTH ?>"
                                                           required="required" placeholder="Place of Birth">

                                                </div>
                                                        <span
                                                            class="red"><?php echo form_error('PLACE_OF_BIRTH'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Enter the name of place where are you born"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Blood Group</label>

                                            <div class="col-md-5">
                                                <div class="input-group date">
                                                    <select name="BLOOD_GRP" class="form-control">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($blood_group as $row): ?>
                                                            <option
                                                                value="<?php echo $row->LKP_ID ?>" <?php if (!empty($tcr_personal_info))
                                                                if ($tcr_personal_info->BLOOD_GROUP == $row->LKP_ID) {
                                                                    echo "selected";
                                                                } else {
                                                                    echo "";
                                                                }
                                                            ?> ><?php echo $row->LKP_NAME ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <span class="red"><?php echo form_error('BLOOD_GRP'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select your blood group" data-placement="right"
                                                   data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Gender <span
                                                    class="red">*</span></label>

                                            <div class="col-md-5">
                                                <input type="radio" name="GENDER"
                                                       value="M" <?php if (!empty($tcr_personal_info)) {
                                                    if ($tcr_personal_info->GENDER == 'M') {
                                                        echo 'checked';
                                                    } else {
                                                        echo "";
                                                    }
                                                } ?>>&nbsp; Male &nbsp; <input type="radio" name="GENDER"
                                                                               value="F" <?php
                                                if (!empty($tcr_personal_info)) {
                                                    if ($tcr_personal_info->GENDER == 'F') {
                                                        echo 'checked';
                                                    } else {
                                                        echo "";
                                                    }
                                                }
                                                ?>> &nbsp;Female &nbsp; <input type="radio" name="GENDER"
                                                                               value="O" <?php
                                                if (!empty($tcr_personal_info)) {
                                                    if ($tcr_personal_info->GENDER == 'O') {
                                                        echo 'checked';
                                                    } else {
                                                        echo "";
                                                    }
                                                } ?>>&nbsp; Others<span
                                                    class="red"><?php echo form_error('GENDER'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please select your gender"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Marital Status <span
                                                    class="red">*</span></label>

                                            <div class="col-md-5">
                                                <select class="form-control" name="MARITAL_STATUS"
                                                        id="marital_status" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($merital_status as $row): ?>
                                                        <option value="<?php echo $row->LKP_ID ?>" <?php
                                                        if (!empty($tcr_personal_info)) {
                                                            if ($tcr_personal_info->MARITAL_STATUS == $row->LKP_ID) {
                                                                echo "selected";
                                                            } else {
                                                                echo "";
                                                            }
                                                        } ?>><?php echo $row->LKP_NAME ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                        <span
                                                            class="red"><?php echo form_error('MARITAL_STATUS'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please select your merital status"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Spouse Name <span class="red">*</span></label>

                                            <div class="col-md-5">
                                                <input type="text" class="_s form-control" name="SPOUSE_NAME"
                                                       id="SPOUSE_NAME" placeholder="Spouse Name"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->SPOUSE_NAME ?>">
                                                        <span
                                                            class="red"><?php echo form_error('SPOUSE_NAME'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your spouse name here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Nationality <span class="red">*</span></label>

                                            <div class="col-md-5">
                                                <select class="form-control" name="NATIONALITY" id="NATIONALITY"
                                                        required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($nationality as $row) { ?>
                                                        <option
                                                            value="<?php echo $row->id ?>" <?php if (!empty($tcr_personal_info)) echo ($tcr_personal_info->NATIONALITY == $row->id) ? 'selected' : ''; ?>><?php echo $row->nationality ?></option>
                                                    <?php } ?>
                                                </select>
                                                        <span
                                                            class="red"><?php echo form_error('NATIONALITY'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select your nationality" data-placement="right"
                                                   data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">National ID</label>

                                            <div class="col-md-5">
                                                <input type="text" name="NID" id="NID"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->NID ?>"
                                                       class="form-control numbersOnly"
                                                       placeholder="National ID">
                                                <span class="nationalID_validation red"></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your natinal indentity number here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Passport No</label>

                                            <div class="col-md-5">
                                                <input type="text" name="PASSPORT_NO" id="PASSPORT_NO"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->PASSPORT_NO ?>"
                                                       class="form-control" placeholder="Passport No">
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Enter your Passport No" data-placement="right"
                                                   data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Email </label>

                                            <div class="col-md-4">
                                                <input type="text" name="EMAIL_ADRESS[]" id="EMAIL" value=""
                                                       class="form-control checkEmail" placeholder="Email">
                                                <input type="hidden" name="TR_CI_ID[]" value="">
                                                        <span
                                                            class="red email_validation"><?php echo form_error('EMAIL_ADRESS'); ?></span>
                                            </div>
                                            <div class="col-md-1">
                                                        <span class="btn btn-xs btn-info" id="add_email"><i
                                                                style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your valid email address here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label"></label>

                                            <div class="col-md-4">
                                                <table id="email_list">
                                                    <tbody>
                                                    <?php if (!empty($teacher_email)) foreach ($teacher_email as $row): ?>
                                                        <tr id="row_id_<?php echo $row->TR_CI_ID ?>">
                                                            <td>
                                                                <input type="text" name="EMAIL_ADRESS[]"
                                                                       value="<?php echo $row->CONTACTS ?>"
                                                                       id="EMAIL" class="form-control "
                                                                       placeholder="Email">
                                                                <input type="hidden" name="TR_CI_ID[]"
                                                                       value="<?php echo $row->TR_CI_ID ?>">
                                                            </td>
                                                            <td>
                                                                <i style="cursor:pointer"
                                                                   class="fa fa-times btn-xs btn-danger delete_row_data"
                                                                   attribute_id="<?php echo $row->TR_CI_ID ?>"
                                                                   attribute="TR_CI_ID"
                                                                   table_name="teacher_staff_contractinfo"></i>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Mobile <span
                                                    class="red">*</span></label>

                                            <div class="col-md-4">
                                                <input type="text" name="MOBILE_NO[]" id="PHONE" value=""
                                                       class="form-control numbersOnly" placeholder="Mobile">
                                                <input type="hidden" name="TR_CI_ID_M[]" value="">
                                                        <span
                                                            class="red"><?php //echo form_error('MOBILE_NO');                                                                   ?></span>
                                            </div>
                                            <div class="col-md-1">
                                                        <span class="btn btn-xs btn-info" id="add_mobile"><i
                                                                style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your  mobile no here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label"></label>

                                            <div class="col-md-4">
                                                <table id="mobile_list">
                                                    <tbody>
                                                    <?php if (!empty($teacher_contact)) foreach ($teacher_contact as $row): ?>
                                                        <tr id="row_id_<?php echo $row->TR_CI_ID ?>">
                                                            <td>
                                                                <input type="text" name="MOBILE_NO[]"
                                                                       value="<?php echo $row->CONTACTS ?>"
                                                                       class="form-control numbersOnly"
                                                                       placeholder="Mobile">
                                                                <input type="hidden" name="TR_CI_ID_M[]"
                                                                       value="<?php echo $row->TR_CI_ID ?>">
                                                            </td>
                                                            <td>
                                                                <i style="cursor:pointer"
                                                                   class="fa fa-times btn-xs btn-danger delete_row_data"
                                                                   attribute_id="<?php echo $row->TR_CI_ID ?>"
                                                                   attribute="TR_CI_ID"
                                                                   table_name="teacher_staff_contractinfo"></i>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Religion <span
                                                    class="red">*</span></label>

                                            <div class="col-md-3">
                                                <select class="form-control" name="RELIGION" id="RELIGION"
                                                        required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($religion as $row): ?>
                                                        <option
                                                            value="<?php echo $row->LKP_ID ?>" <?php if (!empty($tcr_personal_info)) echo ($tcr_personal_info->RELIGION == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="red"><?php echo form_error('RELIGION'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select your religion" data-placement="right"
                                                   data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Height</label>

                                            <div class="col-md-1" style="padding-right: 0;">
                                                <input type="text" name="HEIGHT_FEET" id="HEIGHT_FEET"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->HEIGHT_FEET ?>"
                                                       class="form-control numbersOnly" placeholder="e.g: 5.8">
                                            </div>
                                            <div class="col-md-1">
                                                Ft.
                                            </div>
                                            <div class="col-md-2" style="padding-right: 0;">
                                                <input type="text" name="HEIGHT_CM" id="HEIGHT_CM"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->HEIGHT_CM ?>"
                                                       class="form-control numbersOnly"
                                                       placeholder="e.g: 176.78">
                                            </div>
                                            <div class="col-md-1">
                                                Cm.
                                            </div>
                                            <div class="col-md-1">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please input your hieght"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Weight</label>

                                            <div class="col-md-2" style="padding-right: 0;">
                                                <input type="text" name="WEIGHT_KG" id="WEIGHT_KG"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->WEIGHT_KG ?>"
                                                       class="form-control numbersOnly" placeholder="Weight">
                                            </div>
                                            <div class="col-md-1">
                                                Kg
                                            </div>
                                            <div class="col-md-2" style="padding-right: 0;">
                                                <input type="text" name="WEIGHT_LBS" id="WEIGHT_LBS"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->WEIGHT_LBS ?>"
                                                       class="form-control numbersOnly" placeholder="Weight">
                                            </div>
                                            <div class="col-md-1">
                                                Pound
                                            </div>
                                            <div class="col-md-1">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="please input your weight"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Hobby</label>

                                            <div class="col-md-2">
                                                <input type="text" name="HOBBY" id="HOBBY"
                                                       value="<?php if (!empty($tcr_personal_info)) echo $tcr_personal_info->HOBBY ?>"
                                                       class="form-control" placeholder="Hobby">
                                            </div>
                                            <div class="col-md-1">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your hobby" data-placement="right"
                                                   data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label"></label>

                                            <div class="col-md-2" style="padding-right: 0;">
                                                <input type="submit" class="btn btn-sm btn-warning"
                                                       value="Update">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="pull-right" style="margin-right: 60px">
                                            <div class="form-group col-md-12">
                                                <div class="col-md-3">
                                                    <div class="avatar-zone">
                                                        <?php
                                                        $t_d_f = 'assets/img/default.png'; //teacher default photo location

                                                        if (!empty($tcr_personal_info->USER_IMG)) {
                                                            $recent_t_p = 'upload/faculty_teacher/' . $tcr_personal_info->USER_IMG; //teacher current photo
                                                            $t_d_f = $recent_t_p;
                                                        }
                                                        ?>
                                                        <img id="img_id" src="<?php echo base_url($t_d_f); ?>"
                                                             alt="select photo" style="width: 180px;
                                                                    height: 160px;" />
                                                    </div>
                                                    <div class="overlay-layer">Upload photo</div>
                                                    <input type='file' id="propic" name="photo"
                                                           onchange="upload_img(this);" class="upload_btn">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                            <span style="color:red;">
                                                                ->Photo format must be .gif, .jpg, .jpeg or .png<br>
                                                                ->Size should not exceed 50KB<br>
                                                                ->Dimension prefarable 300 X 300 px
                                                            </span><br>
                                                For image resize <a href="http://picresize.com/" target="_blank"
                                                                    style="color:#18A689">Click Here</a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#familly_info" data-parent="#accordion" data-toggle="collapse"
                               class="collapsed" aria-expanded="false">Familly and Others</a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="familly_info" aria-expanded="false"
                         style="height: 0px;">
                        <form method="post" action="<?php echo base_url() ?>teacher/updateFamillyAndOthers"
                              enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="div-background">
                                    <div class="col-md-8">
                                        <div class="form-group col-md-12 ">
                                            <label class="col-md-5 control-label">Father's Name <span
                                                    class="red">*</span></label>

                                            <div class="col-md-5">
                                                <input type="text" name="FATHER_NAME" id="FATHER_NAME"
                                                       value="<?php
                                                       if (!empty($fathersInfo)) {
                                                           echo $fathersInfo->PARENT_NAME;
                                                       }
                                                       ?>" class="form-control" placeholder="Father's Name"
                                                       required>
                                                <input type="hidden" name="TR_PARENT_ID_F" value="<?php
                                                if (!empty($fathersInfo)) {
                                                    echo $fathersInfo->TR_PARENT_ID;
                                                }
                                                ?>">
                                                        <span
                                                            class="red"><?php echo form_error('FATHER_NAME'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your father's name here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-5 control-label">Father's Occupation</label>

                                            <div class="col-md-3">
                                                <select class="form-control" name="FATHER_OCU" id="FATHER_OCU">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($occupation as $row) { ?>
                                                        <option value="<?php echo $row->LKP_ID ?>" <?php
                                                        if (!empty($fathersInfo)) {
                                                            echo ($fathersInfo->OCCUPATION == $row->LKP_ID) ? 'Selected' : '';
                                                        }
                                                        ?>><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your Father Occupation here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-5 control-label">Father's Mobile </label>

                                            <div class="col-md-3">
                                                <input type="text" name="FATHER_PHN" id="FATHER_PHN"
                                                       value="<?php if (!empty($fathersInfo)) echo $fathersInfo->MOBILE_NO ?>"
                                                       class="form-control numbersOnly"
                                                       placeholder="Father's Phone">
                                            </div>
                                            <div class="col-md-1">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your Father's  mobile no here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-5 control-label">Father's Email </label>

                                            <div class="col-md-3">
                                                <input type="text" name="FATHER_EMAIL" id="FATHER_EMAIL"
                                                       value="<?php if (!empty($fathersInfo)) echo $fathersInfo->EMAIL_ADRESS ?>"
                                                       class="form-control checkEmail"
                                                       placeholder="Father's Email">

                                            </div>

                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your father's valid email address here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="pull-right" style="margin-right: 60px">
                                            <div class="form-group col-md-12">
                                                <div class="col-md-3">
                                                    <div class="avatar-zone">
                                                        <?php
                                                        $teacher_father_photo = 'assets/img/default.png'; //teacher father default photo location

                                                        if (!empty($fathersInfo->PARENT_PHOTO)) {
                                                            $recent_t_p_f = 'upload/teacher/parents/' . $fathersInfo->PARENT_PHOTO; //teacher father current photo
                                                            $teacher_father_photo = $recent_t_p_f;
                                                        }
                                                        ?>
                                                        <img id="f_img_id"
                                                             src="<?php echo base_url($teacher_father_photo); ?>"
                                                             alt="select photo" style="width: 180px;
                                                                height: 160px;" />
                                                    </div>
                                                    <div class="overlay-layer">Father photo</div>
                                                    <input type='file' id="fatherpic" name="father_photo"
                                                           onchange="upload_father_img(this);"
                                                           class="upload_btn">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group col-md-12">
                                            <label class="col-md-5 control-label">Mother's Name <span
                                                    class="red">*</span></label>

                                            <div class="col-md-5">
                                                <input type="text" name="MOTHER_NAME" id="MOTHER_NAME"
                                                       value="<?php
                                                       if (!empty($motherInfo)) {
                                                           echo $motherInfo->PARENT_NAME;
                                                       }
                                                       ?>" class="form-control" placeholder="Mother's Name"
                                                       required>
                                                <input type="hidden" name="TR_PARENT_ID_M" value="<?php
                                                if (!empty($motherInfo)) {
                                                    echo $motherInfo->TR_PARENT_ID;
                                                }
                                                ?>">
                                                        <span
                                                            class="red"><?php echo form_error('MOTHER_NAME'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your mother's name here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-5 control-label">Mother's Occupation</label>

                                            <div class="col-md-3">
                                                <select class="form-control" name="MOTHER_OCU" id="MOTHER_OCU">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($occupation as $row) { ?>
                                                        <option value="<?php echo $row->LKP_ID ?>" <?php
                                                        if (!empty($motherInfo)) {
                                                            echo ($motherInfo->OCCUPATION == $row->LKP_ID) ? 'Selected' : '';
                                                        }
                                                        ?>><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your mother's occupation here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-5 control-label">Mother's Mobile</label>

                                            <div class="col-md-3">
                                                <input type="text" name="MOTHER_PHN" id="MOTHER_PHN"
                                                       value="<?php
                                                       if (!empty($motherInfo)) {
                                                           echo $motherInfo->MOBILE_NO;
                                                       }
                                                       ?>" class="form-control numbersOnly"
                                                       placeholder="Mother's Phone">
                                            </div>

                                            <div class="col-md-1">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your mother's valid mobile no here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-5 control-label">Mother's Email </label>

                                            <div class="col-md-3">
                                                <input type="text" name="MOTHER_EMAIL" id="MOTHER_EMAIL"
                                                       value="<?php
                                                       if (!empty($motherInfo)) {
                                                           echo $motherInfo->EMAIL_ADRESS;
                                                       }
                                                       ?>" class="form-control checkEmail"
                                                       placeholder="Mother's Email">
                                                <span class="red mother_email_validation"></span>
                                            </div>

                                            <div class="col-md-1">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your mother's valid email address here"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="pull-right" style="margin-right: 60px">
                                            <div class="form-group col-md-12">
                                                <div class="col-md-3">
                                                    <div class="avatar-zone">
                                                        <?php
                                                        $teacher_mother_photo = 'assets/img/default.png'; //teacher mother default photo location

                                                        if (!empty($motherInfo->PARENT_PHOTO)) {
                                                            $recent_t_p_m = 'upload/teacher/parents/' . $motherInfo->PARENT_PHOTO; //teacher mother current photo
                                                            $teacher_mother_photo = $recent_t_p_m;
                                                        }
                                                        ?>
                                                        <img id="m_img_id"
                                                             src="<?php echo base_url($teacher_mother_photo); ?>"
                                                             alt="select photo" style="width: 180px;
                                                                height: 160px;" />
                                                    </div>
                                                    <div class="overlay-layer">Mother photo</div>
                                                    <input type='file' id="motherpic" name="mother_photo"
                                                           onchange="upload_mother_img(this);"
                                                           class="upload_btn">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="col-md-3 control-label">Address Type <span
                                                class="red">*</span></label>

                                        <div class="col-md-1">
                                            <input type="radio" class="ADDRESS_TYPE" name="ADDRESS_TYPE"
                                                   value="L"
                                                   id="LOCAL_ADDRESS" <?php if (!empty($tcr_personal_info->ADDRESS_TYPE)) echo ($tcr_personal_info->ADDRESS_TYPE == 'L') ? 'checked' : '' ?>>&nbsp;
                                            Local
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" class="ADDRESS_TYPE" name="ADDRESS_TYPE"
                                                   value="F"
                                                   id="FOREIGN_ADDRESS" <?php if (!empty($tcr_personal_info->ADDRESS_TYPE)) echo ($tcr_personal_info->ADDRESS_TYPE == 'F') ? 'checked' : '' ?>>&nbsp;
                                            Foreign
                                        </div>
                                        <div class="col-md-1">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Select yes if your present and permanent address are same other wise select no for different address"
                                               data-placement="right" data-toggle="popover"
                                               data-container="body" data-original-title="" title="Help"></i>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>


                                    <div id="local_address_div" class="toggle-div"
                                         style="display:<?php if (!empty($tcr_personal_info->ADDRESS_TYPE)) echo ($tcr_personal_info->ADDRESS_TYPE == 'L') ? 'block' : 'none' ?>">
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Present Address <span
                                                    class="red">*</span></label>

                                            <div class="col-md-1">
                                                <input type="hidden" name="TR_ADRESS_ID_PS"
                                                       value="<?php if (!empty($local_present_adddress->TR_ADRESS_ID)) echo $local_present_adddress->TR_ADRESS_ID ?>">

                                            </div>
                                        </div>
                                        <div id="present_address" class="toggle-div1">
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Division</label>

                                                <div class="col-md-3">
                                                    <select name="DIVISION_ID" id="DIVISION_ID"
                                                            class="form-control">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($division as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->DIVISION_ID ?>" <?php if (!empty($local_present_adddress->DIVISION_ID)) echo ($local_present_adddress->DIVISION_ID == $rd->DIVISION_ID) ? 'selected' : '' ?>><?php echo $rd->DIVISION_ENAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">District</label>

                                                <div class="col-md-3">
                                                    <select name="DISTRICT_ID" id="DISTRICT_ID"
                                                            class="form-control">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($district as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->DISTRICT_ID ?>" <?php if (!empty($local_present_adddress->DISTRICT_ID)) echo ($local_present_adddress->DISTRICT_ID == $rd->DISTRICT_ID) ? 'selected' : '' ?>><?php echo $rd->DISTRICT_ENAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select district name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Upazila/Thana</label>

                                                <div class="col-md-3">
                                                    <select name="THANA_ID" id="THANA_ID" class="form-control">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($thana as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->THANA_ID ?>" <?php if (!empty($local_present_adddress->THANA_ID)) echo ($local_present_adddress->THANA_ID == $rd->THANA_ID) ? 'selected' : '' ?>><?php echo $rd->THANA_ENAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select upazila or thana name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Police Station</label>

                                                <div class="col-md-3">
                                                    <select name="POLICE_STATION_ID" id="POLICE_STATION_ID"
                                                            class="form-control">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($police_station as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->POLICE_STATION_ID ?>" <?php if (!empty($local_present_adddress->POLICE_STATION_ID)) echo ($local_present_adddress->POLICE_STATION_ID == $rd->POLICE_STATION_ID) ? 'selected' : '' ?>><?php echo $rd->PS_ENAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select police station"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Union/Ward No.</label>

                                                <div class="col-md-3">
                                                    <select name="UNION_ID" id="UNION_ID" class="form-control">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($union as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->UNION_ID ?>" <?php if (!empty($local_present_adddress->UNION_ID)) echo ($local_present_adddress->UNION_ID == $rd->UNION_ID) ? 'selected' : '' ?>><?php echo $rd->UNION_NAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select ward or union"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Post office</label>

                                                <div class="col-md-3">
                                                    <select name="POST_OFFICE_ID" id="POST_OFFICE_ID"
                                                            class="form-control">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($post_office as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->POST_OFFICE_ID ?>" <?php if (!empty($local_present_adddress->POST_OFFICE_ID)) echo ($local_present_adddress->POST_OFFICE_ID == $rd->POST_OFFICE_ID) ? 'selected' : '' ?>><?php echo $rd->POST_OFFICE_ENAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select post office" data-placement="right"
                                                       data-toggle="popover" data-container="body"
                                                       data-original-title="" title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Vill/House no/Road
                                                    no</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="VILLAGE" id="VILLAGE"
                                                           value="<?php if (!empty($local_present_adddress->VILLAGE_WARD)) echo $local_present_adddress->VILLAGE_WARD ?>"
                                                           class="form-control" />
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Enter your village,house or road no here"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Permanent Address <span
                                                    class="red">*</span></label>

                                            <div class="col-md-3"> Same as present address?</div>
                                            <div class="col-md-1">
                                                <input type="radio" class="SAS_PSORPR" name="SAS_PSORPR"
                                                       value="1"
                                                       id="PARM_ADDRESS_YES" <?php if (!empty($local_present_adddress->SAS_PSORPR)) echo ($local_present_adddress->SAS_PSORPR == 'PS') ? 'checked' : ''; ?>>&nbsp;
                                                Yes
                                            </div>
                                            <div class="col-md-1">
                                                <input type="radio" class="SAS_PSORPR" name="SAS_PSORPR"
                                                       value="0" id="PARM_ADDRESS_NO" <?php
                                                if (!empty($parAddrInfo)) {
                                                    echo ($parAddrInfo->ADRESS_TYPE == 'PR') ? 'checked' : '';
                                                }
                                                ?>>&nbsp; No
                                            </div>
                                            <div class="col-md-1">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select yes if your present and permanent address are same other wise select no for different address"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                            <input type="hidden" name="TR_ADRESS_ID_PR" value="<?php
                                            if (!empty($parAddrInfo)) {
                                                echo $parAddrInfo->TR_ADRESS_ID;
                                            }
                                            ?>">
                                        </div>
                                        <br><br>

                                        <div id="permanent_address" class="toggle-div<?php
                                        if (!empty($parAddrInfo)) {
                                            echo ($parAddrInfo->ADRESS_TYPE == 'PR') ? '1' : '';
                                        }
                                        ?>">
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Division</label>

                                                <div class="col-md-3">
                                                    <select name="P_DIVISION_ID" id="P_DIVISION_ID"
                                                            class="form-control ">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($division as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->DIVISION_ID ?>" <?php if (!empty($parAddrInfo->DIVISION_ID)) echo ($local_present_adddress->DIVISION_ID == $rd->DIVISION_ID) ? 'selected' : '' ?>><?php echo $rd->DIVISION_ENAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">District</label>

                                                <div class="col-md-3">
                                                    <select name="P_DISTRICT_ID" id="P_DISTRICT_ID"
                                                            class="form-control ">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($district as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->DISTRICT_ID ?>" <?php if (!empty($parAddrInfo->DISTRICT_ID)) echo ($parAddrInfo->DISTRICT_ID == $rd->DISTRICT_ID) ? 'selected' : '' ?>><?php echo $rd->DISTRICT_ENAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select district name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Upazila/Thana</label>

                                                <div class="col-md-3">
                                                    <select name="P_THANA_ID" id="P_THANA_ID"
                                                            class="form-control ">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($thana as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->THANA_ID ?>" <?php if (!empty($parAddrInfo->THANA_ID)) echo ($parAddrInfo->THANA_ID == $rd->THANA_ID) ? 'selected' : '' ?>><?php echo $rd->THANA_ENAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select upazila or thana name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Police Station</label>

                                                <div class="col-md-3">
                                                    <select name="P_POLICE_STATION_ID" id="P_POLICE_STATION_ID"
                                                            class="form-control ">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($police_station as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->POLICE_STATION_ID ?>" <?php if (!empty($parAddrInfo->POLICE_STATION_ID)) echo ($parAddrInfo->POLICE_STATION_ID == $rd->POLICE_STATION_ID) ? 'selected' : '' ?>><?php echo $rd->PS_ENAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select police station"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Union/Ward No.</label>

                                                <div class="col-md-3">
                                                    <select name="P_UNION_ID" id="P_UNION_ID"
                                                            class="form-control ">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($union as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->UNION_ID ?>" <?php if (!empty($parAddrInfo->UNION_ID)) echo ($parAddrInfo->UNION_ID == $rd->UNION_ID) ? 'selected' : '' ?>><?php echo $rd->UNION_NAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select ward or union"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Post office</label>

                                                <div class="col-md-3">
                                                    <select name="P_POST_OFFICE_ID" id="P_POST_OFFICE_ID"
                                                            class="form-control">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($post_office as $rd) { ?>
                                                            <option
                                                                value="<?php echo $rd->POST_OFFICE_ID ?>" <?php if (!empty($parAddrInfo->POST_OFFICE_ID)) echo ($parAddrInfo->POST_OFFICE_ID == $rd->POST_OFFICE_ID) ? 'selected' : '' ?>><?php echo $rd->POST_OFFICE_ENAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select post office" data-placement="right"
                                                       data-toggle="popover" data-container="body"
                                                       data-original-title="" title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Vill/House no/Road
                                                    no</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="P_VILLAGE" value="<?php
                                                    if (!empty($parAddrInfo)) {
                                                        echo $parAddrInfo->VILLAGE_WARD;
                                                    }
                                                    ?>" class="form-control " />
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Enter your village,house or road no here"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <br>
                                    </div>


                                    <div id="foreign_address_div" class="toggle-div"
                                         style="display:<?php if (!empty($tcr_personal_info->ADDRESS_TYPE)) echo ($tcr_personal_info->ADDRESS_TYPE == 'F') ? 'block' : 'none' ?>">
                                        <div class="form-group col-md-12">
                                            <br>
                                            <label class="col-md-3 control-label">Present Address <span
                                                    style="color:red">*</span></label>

                                        </div>
                                        <div id="foreign_present">
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Address Line1</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="ADDRESS_LINE_ONE"
                                                           value="<?php if (!empty($foreign_ps_address->ADDRESS_LINE_ONE)) echo $foreign_ps_address->ADDRESS_LINE_ONE; ?>"
                                                           class="form-control">
                                                    <input type="hidden" name="TR_FOR_ADRESS_ID_PS"
                                                           value="<?php if (!empty($foreign_ps_address->TR_FOR_ADRESS_ID)) echo $foreign_ps_address->TR_FOR_ADRESS_ID; ?>"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Address Line2</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="ADDRESS_LINE_TWO"
                                                           value="<?php if (!empty($foreign_ps_address->ADDRESS_LINE_TWO)) echo $foreign_ps_address->ADDRESS_LINE_TWO; ?>"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">City</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="CITY"
                                                           value="<?php if (!empty($foreign_ps_address->CITY)) echo $foreign_ps_address->CITY; ?>"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label
                                                    class="col-md-3 control-label">Region/State/Province</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="STATE"
                                                           value="<?php if (!empty($foreign_ps_address->STATE)) echo $foreign_ps_address->STATE; ?>"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Zip/Postal Code</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="ZIPCODE"
                                                           value="<?php if (!empty($foreign_ps_address->ZIPCODE)) echo $foreign_ps_address->ZIPCODE; ?>"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Country</label>

                                                <div class="col-md-3">
                                                    <select class="form-control select2Dropdown" name="COUNTRY" id=""
                                                            data-tags="true" data-placeholder="Select Country"
                                                            data-allow-clear="true">

                                                        <option value="">-Select-</option>
                                                        <?php foreach ($nationality as $row) { ?>
                                                            <option
                                                                value="<?php echo $row->id ?>" <?php if (!empty($foreign_ps_address->COUNTRY)) echo ($foreign_ps_address->COUNTRY == $row->id) ? 'selected' : '' ?>><?php echo $row->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-3 control-label">Permanent Address <span
                                                    class="red">*</span></label>

                                            <div class="col-md-3"> Same as present address?</div>
                                            <div class="col-md-1">
                                                <input type="radio" class="F_SAS_PSORPR" name="F_SAS_PSORPR"
                                                       value="1"
                                                       id="F_PARM_ADDRESS_YES" <?php if (!empty($foreign_ps_address->ADRESS_TYPE)) echo ($foreign_ps_address->ADRESS_TYPE == 'PS') ? 'checked' : '' ?>>&nbsp;
                                                Yes
                                            </div>
                                            <div class="col-md-1">
                                                <input type="radio" class="F_SAS_PSORPR" name="F_SAS_PSORPR"
                                                       value="0"
                                                       id="F_PARM_ADDRESS_NO" <?php if (!empty($foreign_pr_address->ADRESS_TYPE)) echo ($foreign_pr_address->ADRESS_TYPE == 'PR') ? 'checked' : '' ?>>&nbsp;
                                                No
                                            </div>
                                            <div class="col-md-1">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select yes if your present and permanent address are same other wise select no for different address"
                                                   data-placement="right" data-toggle="popover"
                                                   data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div id="foreign_permanent"
                                             style="display:<?php if (!empty($foreign_ps_address->SAS_PSORPR)) echo ($foreign_ps_address->SAS_PSORPR == 'PS') ? 'none' : 'block' ?>">
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Address Line1</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="F_ADDRESS_LINE_ONE"
                                                           value="<?php if (!empty($foreign_pr_address->ADDRESS_LINE_ONE)) echo $foreign_pr_address->ADDRESS_LINE_ONE; ?>"
                                                           class="form-control">
                                                    <input type="hidden" name="TR_FOR_ADRESS_ID_PR"
                                                           value="<?php if (!empty($foreign_pr_address->TR_FOR_ADRESS_ID)) echo $foreign_pr_address->TR_FOR_ADRESS_ID; ?>"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Address Line2</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="F_ADDRESS_LINE_TWO"
                                                           value="<?php if (!empty($foreign_pr_address->ADDRESS_LINE_TWO)) echo $foreign_pr_address->ADDRESS_LINE_TWO; ?>"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">City</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="F_CITY"
                                                           value="<?php if (!empty($foreign_pr_address->CITY)) echo $foreign_pr_address->CITY; ?>"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label
                                                    class="col-md-3 control-label">Region/State/Province</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="F_STATE"
                                                           value="<?php if (!empty($foreign_pr_address->STATE)) echo $foreign_pr_address->STATE; ?>"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Zip/Postal Code</label>

                                                <div class="col-md-3">
                                                    <input type="text" name="F_ZIPCODE"
                                                           value="<?php if (!empty($foreign_pr_address->ZIPCODE)) echo $foreign_pr_address->ZIPCODE; ?>"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-md-3 control-label">Country</label>

                                                <div class="col-md-3">
                                                    <select class="form-control" name="F_COUNTRY"
                                                            id="F_COUNTRY">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($nationality as $row) { ?>
                                                            <option
                                                                value="<?php echo $row->id ?>" <?php if (!empty($foreign_pr_address->COUNTRY)) echo ($foreign_pr_address->COUNTRY == $row->id) ? 'selected' : '' ?>><?php echo $row->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Select division name"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title=""
                                                       title="Help"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>


                                    <br>

                                    <div class="form-group col-md-12">
                                        <label class="col-md-3 control-label"></label>

                                        <div class="col-md-2">
                                            <button class="btn btn-sm btn-warning">Update</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#academic_info" data-parent="#accordion" data-toggle="collapse"
                               class="collapsed" aria-expanded="false">Academic Information</a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="academic_info" aria-expanded="false"
                         style="height: 0px;">
                        <form method="post" action="<?php echo base_url(); ?>teacher/updateAcademicInfo"
                              enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="div-background">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <table id="academic_list" class="table-bordered ">
                                                <thead>
                                                <tr>
                                                    <th width="15%">Exam Name</th>
                                                    <th width="5%">Year</th>
                                                    <th width="10%">Board</th>
                                                    <th width="15%">Group</th>
                                                    <th width="5%">CGPA</th>
                                                    <th width="20%">Institute</th>
                                                    <th width="15%">Certificate Photo</th>
                                                    <th width="5%" class="text-center"><span
                                                            class="btn btn-xs btn-primary" id="add_academic"><i
                                                                style="cursor:pointer" class="fa fa-plus"> Add
                                                                More</i></span></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 0;
                                                if (!empty($academic)) {
                                                    foreach ($academic as $ar): $i++;
                                                        ?>
                                                        <tr id="row_id_<?php echo $ar->TR_AI_ID ?>">
                                                            <td>
                                                                <select class="form-control"
                                                                        name="EXAM_NAME[]"
                                                                        class="EXAM_NAME">
                                                                    <option value="">-Select-</option>
                                                                    <?php foreach ($exam_name as $row) { ?>
                                                                        <option
                                                                            value="<?php echo $row->LKP_ID ?>" <?php echo ($ar->EXAM_DEGREE_ID == $row->LKP_ID) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input style="width: 50px" type="text"
                                                                       name="PASSING_YEAR[]"
                                                                       value="<?php echo $ar->PASSING_YEAR ?>"
                                                                       class=" form-control numbersOnly"
                                                                       id="PASSING_YEAR" placeholder="Year">
                                                            </td>
                                                            <td>
                                                                <select class="form-control"
                                                                        name="BOARD[]">
                                                                    <option value="">-Select-</option>
                                                                    <?php foreach ($board_name as $row) { ?>
                                                                        <option
                                                                            value="<?php echo $row->LKP_ID ?>" <?php echo ($ar->BOARD == $row->LKP_ID) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control"
                                                                        name="GROUP[]">
                                                                    <option value="">-Select-</option>
                                                                    <?php foreach ($group_name as $row) { ?>
                                                                        <option
                                                                            value="<?php echo $row->LKP_ID ?>" <?php echo ($ar->MAJOR_GROUP_ID == $row->LKP_ID) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input style="width: 50px" type="text"
                                                                       name="GPA[]"
                                                                       value="<?php echo $ar->RESULT_GRADE ?>"
                                                                       class="form-control numbersOnly"
                                                                       placeholder="CGPA">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       name="INSTITUTE[]"
                                                                       value="<?php echo $ar->INSTITUTION ?>"
                                                                       class="form-control "
                                                                       placeholder="Institute Name">
                                                            </td>
                                                            <td>

                                                                <img alt="Certificate photo"
                                                                     style="width:100px;height: 50px"
                                                                     src="<?php echo base_url(); ?>upload/academin_certificate/<?php echo $ar->ACHIEVEMENT ?>">
                                                                <input type="hidden"
                                                                       name="TR_AI_ID[]"
                                                                       id="TR_AI_ID"
                                                                       value="<?php echo $ar->TR_AI_ID ?>">
                                                                <input type="file" name="CERTIFICATE[]" />
                                                            </td>
                                                            <td class="text-center">
                                                                        <span style="cursor:pointer"
                                                                              class="btn btn-xs btn-danger delete_row_data"
                                                                              attribute_id="<?php echo $ar->TR_AI_ID ?>"
                                                                              attribute="TR_AI_ID"
                                                                              data-image-name="<?php echo $ar->ACHIEVEMENT ?>"
                                                                              table_name="teacher_staff_acadimicinfo"><i
                                                                                class="fa fa-times"> Remove</i></span>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    endforeach;
                                                } else {
                                                    ?>

                                                <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                            <br>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-sm btn-warning pull-right"
                                           value="Update">

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#experience" data-parent="#accordion" data-toggle="collapse"
                               class="collapsed" aria-expanded="false">Experience</a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="experience" aria-expanded="false"
                         style="height: 0px;">
                        <form method="post" action="<?php echo base_url(); ?>teacher/updateTeacherExp">
                            <div class="panel-body">
                                <div class="div-background">
                                    <table class="table-bordered" id="tr_exp_tbl">
                                        <thead>
                                        <tr>
                                            <th width="10%">Exp. Type</th>
                                            <th width="20%">Designation</th>
                                            <th width="20%">Institute</th>
                                            <th width="10%">Start Date</th>
                                            <th width="10%">End Date</th>
                                            <th width="250%">Description</th>
                                            <th width="5%"><span class="btn btn-xs btn-info" id="add_tr_exp"> <i
                                                        style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($teacher_experience)) {
                                            foreach ($teacher_experience as $te):$i++;
                                                ?>
                                                <tr id="row_id_<?php echo $te->TR_RE_ID ?>">
                                                    <td>
                                                        <select name="EXP_TYPE[]"
                                                                class="form-control">
                                                            <option value="">-Select-</option>
                                                            <?php foreach ($teacher_exp as $row) { ?>
                                                                <option
                                                                    value="<?php echo $row->LKP_ID ?>" <?php echo ($te->EXP_TYPE == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </td>
                                                    <td><input type="text" name="DESIGNATION[]"
                                                               value="<?php echo $te->DESIGNATION ?>"
                                                               class="form-control"></td>
                                                    <td><input type="text" name="INSTITUTE[]"
                                                               value="<?php echo $te->INSTITUTE ?>"
                                                               class="form-control"></td>
                                                    <td><input type="text" name="START_DT[]"
                                                               value="<?php echo date('d-M-Y', strtotime($te->START_DT)) ?>"
                                                               class="form-control datepicker"></td>
                                                    <td><input type="text" name="END_DT[]"
                                                               value="<?php echo date('d-M-Y', strtotime($te->END_DT)) ?>"
                                                               class="form-control datepicker"></td>
                                                    <td><input type="text" name="DESCRIPTION[]"
                                                               value="<?php echo $te->DESCRIPTION ?>"
                                                               class="form-control">
                                                        <input type="hidden" name="TR_RE_ID[]"
                                                               id="TR_RE_ID"
                                                               value="<?php echo $te->TR_RE_ID ?>">


                                                    </td>

                                                    <td><span class="btn btn-xs btn-danger delete_row_data"
                                                              attribute_id="<?php echo $te->TR_RE_ID ?>"
                                                              attribute="TR_RE_ID"
                                                              table_name="teacher_staff_experience"> <i
                                                                style="cursor:pointer" class="fa fa-times"></i></span>
                                                    </td>

                                                </tr>

                                            <?php
                                            endforeach;
                                        } else {
                                            ?>

                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                    <br>
                                    <button class="btn btn-sm btn-warning pull-right">Update</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#medical_ohter" data-parent="#accordion" data-toggle="collapse"
                               class="collapsed" aria-expanded="false"> Medical</a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="medical_ohter" aria-expanded="false"
                         style="height: 0px;">
                        <div class="panel-body">
                            <form method="post" action="<?php echo base_url(); ?>teacher/updateTeacherDisease">
                                <div class="div-background">
                                    <br>
                                    <table id="tr_disease_tbl" class="table-bordered" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="50%">Disease Name</th>
                                            <th width="10%">Start Date</th>
                                            <th width="10%">End Date</th>
                                            <th width="25%">Treating Doctor</th>
                                            <th class="text-center"><span class="btn btn-xs btn-info"
                                                                          id="add_disease"> <i
                                                        style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($disease)) {
                                            foreach ($disease as $dr):$i++;
                                                ?>
                                                <tr id="row_id_<?php echo $dr->TR_DISEASE_ID ?>">

                                                    <td><input type="text" name="DISEASE_NAME[]"
                                                               value="<?php echo $dr->DISEASE_NAME ?>"
                                                               class="form-control"></td>

                                                    <td><input type="text" name="START_DT[]"
                                                               value="<?php echo date('d-M-Y', strtotime($dr->START_DT)) ?>"
                                                               class="form-control datepicker"></td>
                                                    <td><input type="text" name="END_DT[]"
                                                               value="<?php echo date('d-M-Y', strtotime($dr->END_DT)) ?>"
                                                               class="form-control datepicker"></td>
                                                    <td><input type="text" name="DOCTOR_NAME[]"
                                                               value="<?php echo $dr->DOCTOR_NAME ?>"
                                                               class="form-control">
                                                        <input type="hidden"
                                                               name="TR_DISEASE_ID[]"
                                                               id="TR_DISEASE_ID"
                                                               value="<?php echo $dr->TR_DISEASE_ID ?>">
                                                         
                                                    </td>

                                                    <td class="text-center"><span
                                                            class="btn btn-xs btn-danger delete_row_data"
                                                            attribute_id="<?php echo $dr->TR_DISEASE_ID ?>"
                                                            attribute="TR_DISEASE_ID"
                                                            table_name="teacher_staff_diseaseinfo"> <i
                                                                style="cursor:pointer" class="fa fa-times"></i></span>
                                                    </td>

                                                </tr>
                                            <?php
                                            endforeach;
                                        } else {
                                            ?>
                                            
                                        <?php
                                        }
                                        ?>

                                        </tbody>

                                    </table>
                                    <br>
                                    <input type="submit" class="btn btn-sm btn-warning pull-right"
                                           value="Update">

                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#awards" data-parent="#accordion" data-toggle="collapse" class="collapsed"
                               aria-expanded="false">Awards</a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="awards" aria-expanded="false" style="height: 0px;">
                        <form method="post" action="<?php echo base_url(); ?>teacher/updateAwardsInfo">
                            <div class="panel-body">
                                <div class="div-background">

                                    <table class="table-bordered" id="tr_awards_tbl" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="40%">Awards Name</th>
                                            <th width="20%">Awards From</th>
                                            <th width="10%">Date</th>
                                            <th width="25%">Description</th>
                                            <th width="5%" class="text-center"><span class="btn btn-xs btn-info"
                                                                                     id="add_awards"> <i
                                                        style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($awards)) {
                                            foreach ($awards as $aw):$i++;
                                                ?>
                                                <tr id="row_id_<?php echo $aw->TR_A_ID ?>">

                                                    <td><input type="text" name="AW_REASON[]"
                                                               value="<?php echo $aw->AW_REASON ?>"
                                                               class="form-control"></td>
                                                    <td><input type="text" name="AW_FROM[]"
                                                               value="<?php echo $aw->AW_FROM ?>"
                                                               class="form-control"></td>
                                                    <td><input type="text" name="AW_DATE[]"
                                                               value="<?php echo date('d-M-Y', strtotime($aw->AW_DATE)) ?>"
                                                               class="form-control datepicker"></td>
                                                    <td><input type="text" name="DESCRIPTION[]"
                                                               value="<?php echo $te->DESCRIPTION ?>"
                                                               class="form-control">
                                                        <input type="hidden" name="TR_A_ID[]"
                                                               id="TR_A_ID" value="<?php echo $aw->TR_A_ID ?>">

                                                    </td>

                                                    <td class="text-center"><span
                                                            class="btn btn-xs btn-danger delete_row_data"
                                                            attribute_id="<?php echo $aw->TR_A_ID ?>"
                                                            attribute="TR_A_ID"
                                                            table_name="teacher_staff_awards"> <i
                                                                style="cursor:pointer" class="fa fa-times"></i></span>
                                                    </td>

                                                </tr>
                                            <?php
                                            endforeach;
                                        } else {
                                            ?>

                                        <?php
                                        }
                                        ?>

                                        </tbody>

                                    </table>
                                    <br>
                                    <input type="submit" class="btn btn-sm btn-warning pull-right"
                                           value="Update">

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#affiliation" data-parent="#accordion" data-toggle="collapse"
                               class="collapsed" aria-expanded="false">Affiliation</a>

                        </h4>

                    </div>
                    <div class="panel-collapse collapse" id="affiliation" aria-expanded="false"
                         style="height: 0px;">
                        <form method="post" action="<?php echo base_url(); ?>teacher/updateTeacherAffiliation">
                            <div class="panel-body">
                                <div class="div-background">

                                    <table class="table-bordered" id="tr_affiliation_tbl" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="50%">Organization Name</th>
                                            <th width="20%">Start Date</th>
                                            <th width="20%">End Date</th>
                                            <th width="5%" class="text-center"><span class="btn btn-xs btn-info"
                                                                                     id="add_affiliation"> <i
                                                        style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($affiliations)) {
                                            foreach ($affiliations as $aff):$i++;
                                                ?>
                                                <tr id="row_id_<?php echo $aff->TR_AF_ID ?>">

                                                    <td><input type="text" name="AF_NAME[]"
                                                               value="<?php echo $aff->AF_NAME ?>"
                                                               class="form-control"></td>

                                                    <td><input type="text" name="START_DT[]"
                                                               value="<?php echo date('d-M-Y', strtotime($aff->START_DT)) ?>"
                                                               class="form-control datepicker"></td>
                                                    <td><input type="text" name="END_DT[]"
                                                               value="<?php echo date('d-M-Y', strtotime($aff->END_DT)) ?>"
                                                               class="form-control datepicker">
                                                        <input type="hidden" name="TR_AF_ID[]"
                                                               id="TR_AF_ID"
                                                               value="<?php echo $aff->TR_AF_ID ?>">
                                                       
                                                    </td>

                                                    <td class="text-center"><span
                                                            class="btn btn-xs btn-danger delete_row_data"
                                                            attribute_id="<?php echo $aff->TR_AF_ID ?>"
                                                            attribute="TR_AF_ID"
                                                            table_name="teacher_staff_affiliations"> <i
                                                                style="cursor:pointer" class="fa fa-times"></i></span>
                                                    </td>

                                                </tr>
                                            <?php
                                            endforeach;
                                        } else {
                                            ?>
                                           
                                        <?php
                                        }
                                        ?>

                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>

                                    <br>
                                    <input type="submit" class="btn btn-sm btn-warning pull-right"
                                           value="Update">

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#skill" data-parent="#accordion" data-toggle="collapse" class="collapsed"
                               aria-expanded="false">Skill</a>

                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="skill" aria-expanded="false" style="height: 0px;">
                        <form method="post" action="<?php echo base_url(); ?>teacher/updateTeacherSkill">
                            <div class="panel-body">
                                <div class="div-background">

                                    <table class="table-bordered" id="tr_skill_tbl" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">Skill Area</th>
                                            <th width="60%">Description</th>
                                            <th width="5%" class="text-center"><span class="btn btn-xs btn-info"
                                                                                     id="add_skill"> <i
                                                        style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($skill)) {
                                            foreach ($skill as $sk):$i++;
                                                ?>
                                                <tr id="row_id_<?php echo $sk->TR_S_ID ?>">
                                                    <td>
                                                        <select name="SKILL_AREA[]" value=""
                                                                class="form-control">
                                                            <option value="">-Select-</option>
                                                            <?php foreach ($skills as $row): ?>
                                                                <option
                                                                    value="<?php echo $row->SKILL_ID ?>"  <?php echo ($row->SKILL_ID == $sk->SKILL_AREA) ? 'selected' : ''; ?>><?php echo $row->NAME ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               name="COM_SKILL_DES[]"
                                                               value="<?php echo $sk->DESCRIPTION ?>"
                                                               class="form-control">
                                                        <input type="hidden" name="TR_S_ID[]"
                                                               id="TR_S_ID" value="<?php echo $sk->TR_S_ID ?>">
                                                        
                                                    </td>

                                                    <td class="text-center"><span
                                                            class="btn btn-xs btn-danger delete_row_data"
                                                            attribute_id="<?php echo $sk->TR_S_ID ?>"
                                                            attribute="TR_S_ID"
                                                            table_name="teacher_staff_skill"> <i
                                                                style="cursor:pointer" class="fa fa-times"></i></span>
                                                    </td>

                                                </tr>
                                            <?php
                                            endforeach;
                                        } else {
                                            ?>
                                            
                                        <?php
                                        }
                                        ?>

                                        </tbody>

                                    </table>
                                    <br>
                                    <input type="submit" class="btn btn-sm btn-warning pull-right"
                                           value="Update">

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#interest" data-parent="#accordion" data-toggle="collapse"
                               class="collapsed" aria-expanded="false">Interest</a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="interest" aria-expanded="false"
                         style="height: 0px;">
                        <form method="post" action="<?php echo base_url(); ?>teacher/updateTeacherInterest">
                            <div class="panel-body">
                                <div class="div-background">
                                    <table class="table-bordered" id="tr_interest_tbl" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">Interest Type</th>
                                            <th width="40%">Interest Subject</th>
                                            <th width="5%" class="text-center"><span class="btn btn-xs btn-info"
                                                                                     id="add_interest"> <i
                                                        style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($interest)) {
                                            foreach ($interest as $ir):$i++;
                                                ?>
                                                <tr id="row_id_<?php echo $ir->TR_INT_ID ?>">

                                                    <td>
                                                        <select class="form-control"
                                                                name="INTEREST_TYPE[]">
                                                            <option value="">-Select-</option>
                                                            <?php foreach ($teacher_interest as $row) { ?>
                                                                <option
                                                                    value="<?php echo $row->LKP_ID ?>" <?php echo ($ir->INTEREST_TYPE == $row->LKP_ID) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               name="INTERESR_SUBJECT[]"
                                                               value="<?php echo $ir->INTERESR_SUBJECT ?>"
                                                               class="form-control">
                                                        <input type="hidden" name="TR_INT_ID[]"
                                                               id="TR_INT_ID"
                                                               value="<?php echo $ir->TR_INT_ID ?>">
                                                        
                                                    </td>
                                                    <td class="text-center"><span
                                                            class="btn btn-xs btn-danger delete_row_data"
                                                            attribute_id="<?php echo $ir->TR_INT_ID ?>"
                                                            attribute="TR_INT_ID"
                                                            table_name="teacher_staff_interests"> <i
                                                                style="cursor:pointer" class="fa fa-times"></i></span>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                        } else {
                                            ?>
                                            
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                    <br>
                                    <input type="submit" class="btn btn-sm btn-warning pull-right"
                                           value="Update">

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#international_tarvel" data-parent="#accordion" data-toggle="collapse"
                               class="collapsed" aria-expanded="false">International Travels</a>
                        </h4><i class="fa fa-check fa-2x pull-right" style="color: green;
                    font-size: 20px;
                    margin: -25px 10px 0 0;"></i>

                    </div>
                    <div class="panel-collapse collapse" id="international_tarvel" aria-expanded="false"
                         style="height: 0px;">
                        <form method="post" action="<?php echo base_url(); ?>teacher/updateTeacherIntTravel">
                            <div class="panel-body">
                                <div class="div-background">
                                    <table class="table-bordered" id="tr_int_travel_tbl" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="20%">Where Traveling</th>
                                            <th width="20%">Start Date</th>
                                            <th width="20%">End Date</th>
                                            <th width="40%">Purpose</th>
                                            <th width="5%" class="text-center"><span class="btn btn-xs btn-info"
                                                                                     id="add_int_travel"><i
                                                        style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($int_travel)) {
                                            foreach ($int_travel as $itr):$i++;
                                                ?>
                                                <tr id="row_id_<?php echo $itr->TR_IR_ID ?>">

                                                    <td><input type="text" name="WHERE[]"
                                                               value="<?php echo $itr->WHERE ?>"
                                                               class="form-control"></td>
                                                    <td><input type="text" name="FROM_DT[]"
                                                               value="<?php echo date('d-M-Y', strtotime($itr->FROM_DT)) ?>"
                                                               class="form-control datepicker"></td>
                                                    <td><input type="text" name="TO_DT[]"
                                                               value="<?php echo date('d-M-Y', strtotime($itr->TO_DT)) ?>"
                                                               class="form-control datepicker"></td>
                                                    <td>
                                                        <input type="text" name="PURPOSE[]"
                                                               value="<?php echo $itr->PURPOSE ?>"
                                                               class="form-control">
                                                        <input type="hidden" name="TR_IR_ID[]"
                                                               id="TR_IR_ID"
                                                               value="<?php echo $itr->TR_IR_ID ?>">

                                                    </td>
                                                    <td class="text-center"><span
                                                            class="btn btn-xs btn-danger delete_row_data"
                                                            attribute_id="<?php echo $itr->TR_IR_ID ?>"
                                                            attribute="TR_IR_ID"
                                                            table_name="teacher_staff_internationa_travels"> <i
                                                                style="cursor:pointer" class="fa fa-times"></i></span>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                        } else {
                                            ?>

                                        <?php
                                        }
                                        ?>

                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                    <br>
                                    <input type="submit" class="btn btn-sm btn-warning pull-right"
                                           value="Update">

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#publication" data-parent="#accordion" data-toggle="collapse"
                               class="collapsed" aria-expanded="false">Publication</a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="publication" aria-expanded="false"
                         style="height: 0px;">
                        <form method="post" action="<?php echo base_url(); ?>teacher/updateTeacherPublication">
                            <div class="panel-body">
                                <div class="div-background">
                                    <table class="table-bordered" id="tr_publication_tbl">
                                        <thead>
                                        <tr>
                                            <th width="20%">Title</th>
                                            <th width="20%">Publisher/Publication</th>
                                            <th width="10%">Publish Date</th>
                                            <th width="20%">Publication Url</th>
                                            <th width="15%">Authors</th>
                                            <th width="10%">Description</th>
                                            <th width="5%"><span class="btn btn-xs btn-info"
                                                                 id="add_publication"> <i style="cursor:pointer"
                                                                                          class="fa fa-plus"></i></span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($publication)) {
                                            foreach ($publication as $pb):$i++;
                                                ?>
                                                <tr id="row_id_<?php echo $pb->TR_PUB_ID ?>">
                                                    <td><input type="text" name="TITLE[]"
                                                               value="<?php echo $pb->TITLE; ?>"
                                                               class="form-control"></td>
                                                    <td><input type="text" name="PUBLISHER[]"
                                                               value="<?php echo $pb->PUBLISHER; ?>"
                                                               class="form-control"></td>
                                                    <td><input type="text" name="PUB_DATE[]"
                                                               value="<?php echo date('d-M-Y', strtotime($pb->PUB_DATE)); ?>"
                                                               class="form-control datepicker"></td>
                                                    <td><input type="text"
                                                               name="PUBLICATION_URL[]"
                                                               value="<?php echo $pb->PUBLICATION_URL; ?>"
                                                               class="form-control"></td>
                                                    <td><input type="text" name="AUTHOR[]"
                                                               value="<?php echo $pb->AUTHOR; ?>"
                                                               class="form-control"></td>
                                                    <td>
                                                                <textarea class="form-control"
                                                                          name="DESCRIPTION[]"><?php echo $pb->DESCRIPTION; ?></textarea>
                                                        <input type="hidden" name="TR_PUB_ID[]"
                                                               id="TR_PUB_ID"
                                                               value="<?php echo $pb->TR_PUB_ID ?>">
                                                         
                                                    </td>
                                                    <td class="text-center "><span
                                                            class="btn btn-xs btn-danger delete_row_data"
                                                            attribute_id="<?php echo $pb->TR_PUB_ID ?>"
                                                            attribute="TR_PUB_ID"
                                                            table_name="teacher_staff_publications"> <i
                                                                style="cursor:pointer" class="fa fa-times"></i></span>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                        } else {
                                            ?>
                                             
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <br>
                                    <button class="btn btn-sm btn-warning pull-right">Update</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
        border-radius: 3px
    }

    .toggle-div {
        display: none;
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 3px;
    }

    .toggle-div-course {
        display: none;
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 3px;
        width: 400px;
    }

    .toggle-div1 {
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 3px;
    }
</style>
<link href="<?php echo base_url(); ?>assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">


<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/keyboard/keyboard.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
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

    $('.scroll_content').slimscroll({
        height: '200px'
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
    // user lavel value on change user group
    $(document).on('change', '#user_group', function () {
        var user_group_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admin/userLavelByGrId'); ?>',
            data: {user_group_id: user_group_id},
            success: function (data) {
                $('#user_group_lavel').html(data);
            }
        });
    });
    //marital statud input field show and hide onclick
    //    $(document).on('click', '#MARITAL_STATUS', function () {
    //        $("#SN").toggle();
    //    });
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
    //email validation
    $(document).on('blur', '#FATHER_EMAIL', function () {
        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str)) {
            $(".father_email_validation").html('Invalid Email address');
        } else {
            $(".father_email_validation").html('');
        }

    });
    //email validation
    $(document).on('blur', '#MOTHER_EMAIL', function () {
        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str)) {
            $(".mother_email_validation").html('Invalid Email address');
        } else {
            $(".mother_email_validation").html('');
        }

    });

    //alternat email validation
    //    $(document).on('blur', '#ALT_EMAIL', function() {
    //
    //        var str = $(this).val();
    //        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //        if (!re.test(str)) {
    //            $(".ALT_EMAIL").html('Invalid Email address');
    //        } else {
    //            $(".ALT_EMAIL").html('');
    //        }
    //
    //    });

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
                        } else if (fsize > 51200) {
                            alert("Size should not exceed 50KB ");
                        } else {
                            $('#img_id').attr('src', e.target.result);
                        }
                    };
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert("This file type does not support");
            }
        }
    }
    //This function  is use for student father image preview before upload
    function upload_father_img(input) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                isSuccess = fileTypes.indexOf(extension) > -1;
            var fsize = $('#fatherpic')[0].files[0].size;
            if (isSuccess) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = reader.result;

                    image.onload = function () {
                        if (image.height > 300 && image.width > 300) {
                            alert("Dimension prefarable 300 X 300 px ");
                        } else if (fsize > 51200) {
                            alert("Size should not exceed 50KB ");
                        } else {
                            $('#f_img_id').attr('src', e.target.result);
                        }
                    };
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert("This file type does not support");
            }
        }
    }
    //This function  is use for student mother image preview before upload
    function upload_mother_img(input) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                isSuccess = fileTypes.indexOf(extension) > -1;
            var fsize = $('#motherpic')[0].files[0].size;
            if (isSuccess) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = reader.result;

                    image.onload = function () {
                        if (image.height > 300 && image.width > 300) {
                            alert("Dimension prefarable 300 X 300 px ");
                        } else if (fsize > 51200) {
                            alert("Size should not exceed 50KB ");
                        } else {
                            $('#m_img_id').attr('src', e.target.result);
                        }
                    };
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert("This file type does not support");
            }
        }

    }

    // append academic info table
 
    $(document).on('click', '#add_academic', function () {
       
        $("#academic_list tbody").append(' <tr>' +
            '<td>' +
            '   <select class="form-control" name="EXAM_NAME[]" class="EXAM_NAME">' +
            '<option value="">-Select-</option>' +
            <?php foreach ($exam_name as $row) { ?>
            '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
            <?php } ?>
            '</select> ' +
            '</td>' +
            '<td>' +
            '<input style="width: 50px"  type="text" name="PASSING_YEAR[]" class=" form-control numbersOnly" id="PASSING_YEAR" placeholder="Year" >' +
            '</td>' +
            ' <td>' +
            '<select class="form-control" name="BOARD[]"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($board_name as $row) { ?>
            '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
            <?php } ?>
            '</select> ' +
            ' </td>' +
            '<td>' +
            '<select class="form-control" name="GROUP[]"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($group_name as $row) { ?>
            '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
            <?php } ?>
            '</select>' +
            '</td>' +
            '<td>' +
            ' <input style="width: 50px" type="text" name="GPA[]"  class="form-control numbersOnly" placeholder="CGPA" >' +
            '</td>' +
            '<td>' +
            '<input type="text" name="INSTITUTE[]" class="form-control " placeholder="Institute Name" >' +
            '</td>' +
            '<td>' +
            '<input type="file" name="CERTIFICATE[]"  >' +
            ' <input type="hidden" name="TR_AI_ID[]" id="TR_AI_ID" value="">' +
            '</td>' +
            '<td class="text-center">' +
            '<span class="btn btn-xs btn-danger remove" ><i style="cursor:pointer" class="fa fa-times" > Remove</i></span>' +
            '</td>' +
            '</tr>'
        );
    });
    // for applicant mobile
    $(document).on('click', '#add_mobile', function (e) {
        e.preventDefault();
        $("#mobile_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="MOBILE_NO[]"   class="form-control numbersOnly" placeholder="Mobile">' +
        '<input type="hidden" name="TR_CI_ID_M[]"  value="" class="form-control numbersOnly" placeholder="Mobile">' +
        '</td>' +
        ' <td>           ' +
        '<i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for applicant email
    $(document).on('click', '#add_email', function (e) {
        e.preventDefault();
        $("#email_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="EMAIL_ADRESS[]"  id="EMAIL" class="form-control " placeholder="Email">' +
        '<input type="hidden" name="TR_CI_ID[]"  value="" id="EMAIL" class="form-control " placeholder="Email">' +
        '</td>' +
        ' <td>           ' +
        '<i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for father mobile
    $(document).on('click', '#add_mobile_f', function (e) {
        e.preventDefault();
        $("#mobile_list_f tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="FATHER_PHN[]"   class="form-control numbersOnly" placeholder="Mobile" >' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for father email
    $(document).on('click', '#add_email_f', function (e) {
        e.preventDefault();
        $("#email_list_f tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="FATHER_EMAIL[]"   class="form-control " placeholder="Father Email">' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for mother mobile
    $(document).on('click', '#add_mobile_m', function (e) {
        e.preventDefault();
        $("#mobile_list_m tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="MOTHER_PHN[]"   class="form-control numbersOnly" placeholder="Mobile">' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for mother email
    $(document).on('click', '#add_email_m', function (e) {
        e.preventDefault();
        $("#email_list_m tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="MOTHER_EMAIL[]"   class="form-control" placeholder="Mother Email">' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for emergency contact mobile
    $(document).on('click', '#add_mobile_ecp', function (e) {
        e.preventDefault();
        $("#mobile_list_ecp tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="EMER_PER_PHN[]"   class="form-control numbersOnly" placeholder="Mobile" >' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });

    // for local gardian contact mobile
    $(document).on('click', '#add_mobile_lg', function (e) {
        e.preventDefault();
        $("#mobile_list_lg tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="LOCAL_GAR_PHN[]"   class="form-control numbersOnly" placeholder="Mobile">' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for extra activities
    $(document).on('click', '#add_ext_act', function (e) {
        e.preventDefault();
        var DESCRIPTION = $("#DESCRIPTION").val();
        var ACTIVITY_TYPE_ID = $("#ACTIVITY_TYPE_ID").val();
        var ACTIVITY_TYPE_ID_TEXT = $("#ACTIVITY_TYPE_ID :selected").text();

        $("#ext_act_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="hidden" name="ACTIVITY_TYPE_ID[]" value="' + ACTIVITY_TYPE_ID + '" >' + ACTIVITY_TYPE_ID_TEXT +
        '</td>' +
        ' <td>' +
        '<input type="hidden" name="DESCRIPTION[]" value="' + DESCRIPTION + '" >' + DESCRIPTION +
        '</td>' +
        ' <td>' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');
        $("#DESCRIPTION").val("");
        $("#ACTIVITY_TYPE_ID").val("");

    });

    $(document).on('click', '.remove', function () {
        $(this).closest('tr').remove();
    });

    $(document).on('click', '.remove_tr', function () {
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
    // get program by change department
    $(document).on('change', '#DEPT_ID', function () {
        var department_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('common/programByDepartment'); ?>',
            data: {department_id: department_id},
            success: function (data) {
                $('#PROGRAM_ID').html(data);
            }
        });
    });
    // get program by change department
    $(document).on('change', '#DEPT_ID_C', function () {
        var department_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('common/programByDepartment'); ?>',
            data: {department_id: department_id},
            success: function (data) {
                $('#PROGRAM_ID_C').html(data);
            }
        });
    });
    // get course list by change faculty,department,program id
    $(document).on('change', '#PROGRAM_ID_C', function () {
        $("#offer_course_list_div").show();
        var faculty_id = $('#FACULTY_C').val();
        var department_id = $('#DEPT_ID_C').val();
        var program_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('common/getCourseByID'); ?>',
            data: {
                faculty_id: faculty_id,
                department_id: department_id,
                program_id: program_id
            },
            success: function (data) {

                $('#offer_course_list').html(data);
            }
        });
    });


    $(document).on("click", "#HAS_WEAVER", function () {
        $("#WEAVER_PERCENTAGE").toggle();
    });

    $(document).on("click", "#PRES_ADDRESS", function () {
        $("#present_address").toggle();
    });
    $(document).on("click", "#PARM_ADDRESS_YES", function () {
        $("#permanent_address").hide();
    });
    $(document).on("click", "#PARM_ADDRESS_NO", function () {
        $("#permanent_address").show();
    });
    $(document).on("click", "#F_PARM_ADDRESS_YES", function () {
        $("#foreign_permanent").hide();
    });
    $(document).on("click", "#F_PARM_ADDRESS_NO", function () {
        $("#foreign_permanent").show();
    });
    $(document).on("click", "#LOCAL_ADDRESS", function () {
        $("#local_address_div").show();
        $("#foreign_address_div").hide();
    });
    $(document).on("click", "#FOREIGN_ADDRESS", function () {
        $("#foreign_address_div").show();
        $("#local_address_div").hide();
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
    $(document).on("click", ".local_emergency_guardian", function () {
        var is_local = $(this).val();
        if (is_local == 'O') {
            $('#local_guardian').show();
            $('#finance_guardian').show();
        } else {
            $('#local_guardian').hide();
            $('#finance_guardian').hide();
        }
    });
    $(document).on("change", "#marital_status", function () {
        if ($("#marital_status option:selected").text() == 'Married') {
            $('#spouse_name').show();
            $('#finance_spouse').show();
            $("._s").attr("required", "required");
        } else {
            $('#spouse_name').hide();
            $('#finance_spouse').hide();
            $("._s").removeAttr("required");
        }
    });


    $(document).on('blur', '#nationalID', function () {
        var str = $(this).val();
        if (str.length == '13' || str.length == '17') {
            $(".nationalID_validation").html('');
        } else {

            $(".nationalID_validation").html('Invalid National ID Number');
        }
    });
    $(document).on('click', '#addExperience', function () {
        var org = $('.orgName').val();
        var desg = $('.desig').val();

        var todate = $('.toDate').val();
        var fromdate = $('.fromDate').val();
        $(".experience-table tbody").append(
            '<tr>'
            + '<td> <input type="hidden" name="organization[]" value="' + org + '">' + org + '</td>'
            + '<td><input type="hidden" name="designation[]" value="' + desg + '">' + desg + '</td>'
            + '<td><input type="hidden" name="ex_start_date[]" value="' + fromdate + '">' + fromdate + '</td>'
            + '<td><input type="hidden" name="ex_end_date[]" value="' + todate + '">' + todate + '</td>'
            + '</tr>'
        );
    });


    $(document).on('click', '#workEx', function () {
        if ($('input[name="workExp"]:checked').val() == "y") {
            $('.workExper').show();
        } else {
            $('.workExper').hide();
        }
    });

    $(document).on('click', '#admiTest', function () {
        if ($('input[name="adTest"]:checked').val() == "y") {
            $('.adRollNo').show();
        } else {
            $('.adRollNo').hide();
        }
    });

    $(document).on('click', '#regist', function () {
        if ($('input[name="registered"]:checked').val() == "y") {
            $('.adIdNo').show();
        } else {
            $('.adIdNo').hide();
        }
    });

    $(document).on('click', '#siblin', function () {
        if ($('input[name="SIBLING_EXIST"]:checked').val() == 1) {
            $('.sibId').show();
        } else {
            $('.sibId').hide();
        }
    });

    $(document).on('click', '#discon', function () {
        if ($('input[name="discontinue"]:checked').val() == "y") {
            $('.disconCoz').show();
        } else {
            $('.disconCoz').hide();
        }
    });

    $(document).on('click', '#suffer', function () {
        if ($('input[name="sufferInf"]:checked').val() == "y") {
            $('.sufferInfo').show();
        } else {
            $('.sufferInfo').hide();
        }
    });

    $(document).on('click', '#disability', function () {
        if ($('input[name="disable"]:checked').val() == "y") {
            $('.disableInfo').show();
        } else {
            $('.disableInfo').hide();
        }
    });

    $(document).on('click', '#offences', function () {
        if ($('input[name="crimOffen"]:checked').val() == "y") {
            $('.offenceInfo').show();
        } else {
            $('.offenceInfo').hide();
        }
    });


    $("#selecctall").change(function () {
        $(".checkbox").prop('checked', $(this).prop("checked"));
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
    $(document).on('blur', '#NATIONAL_ID', function () {
        var str = $(this).val();
        if (str.length == '13' || str.length == '17') {
            $(".nationalID_validation").html('');
        } else {

            $(".nationalID_validation").html('Invalid National ID Number');
        }
    });

    $(document).on("click", ".SAS_PSORPR", function () {
        var thisVal = $(this).val();
        if (thisVal == 0) {
            $(".").attr("required", "required");
        } else {
            $(".").removeAttr("required");
        }
    });
    $(document).on("click", ".local_emergency_guardian", function () {
        var thisVal = $(this).val();
        if (thisVal == 'O') {
            $("._o").attr("required", "required");
        } else {
            $("._o").removeAttr("required");
        }
    });

    $(document).on('submit', '#existingStu', function () {
        if (!$('#existingStu input[type="checkbox"]').is(':checked')) {
            alert("Please Select at least one course.If empty please offer course first");
            return false;
        } else {
            if (confirm("Are you sure?")) {
                return true;
            } else {
                return false;
            }

        }

    });
    $(document).on('click', '.delete_row_data', function () {
        if (confirm("Are you sure?")) {
            var attribute_id = $(this).attr('attribute_id'),
                attribute = $(this).attr('attribute'),
                table_name = $(this).attr('table_name');

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/delRowData',
                data: {
                    attribute_id: attribute_id,
                    attribute: attribute,
                    table_name: table_name
                },
                success: function (data) {
                    if (data == 'Y') {
                        $('#row_id_' + attribute_id).remove();

                    }
                }
            });
        }
        return false;
    });
    // teaher experience append

    $(document).on('click', '#add_tr_exp', function () {

        $("#tr_exp_tbl tbody").append('<tr>' +
        '<td>' +
        '<select name="EXP_TYPE[]" class="form-control">' +
        '<option value="">-Select-</option>' +
        <?php foreach ($teacher_exp as $row) { ?>
        '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
        <?php } ?>

        '</select>' +
        '</td>' +
        '<td><input type="text" name="DESIGNATION[]" class="form-control"></td> ' +
        '<td><input type="text" name="INSTITUTE[]" class="form-control"></td>' +
        '<td><input type="text" name="START_DT[]"  class="form-control datepicker"></td>' +
        '<td><input type="text" name="END_DT[]"  class="form-control datepicker"></td>' +
        '<td><input type="text" name="DESCRIPTION[]"  class="form-control">' +
        ' <input type="hidden" name="TR_RE_ID[]" id="TR_RE_ID" value="" >' +
        '</td>' +

        '<td><span class="btn btn-xs btn-danger remove" > <i style="cursor:pointer" class="fa fa-times"  ></i></span></td>' +

        '</tr>');
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:+0'
        });
    });

    // teahcer awards append 

  
    $(document).on('click', '#add_awards', function () {
       
        $("#tr_awards_tbl tbody").append('<tr>' +
        '<td><input type="text" name="AW_REASON[]" value="" class="form-control"></td>' +
        '<td><input type="text"  name="AW_FROM[]"  value="" class="form-control"></td>' +
        '<td><input type="text"  name="AW_DATE[]"  value="" class="form-control datepicker"></td>' +
        '<td><input type="text"  name="DESCRIPTION[]" value="" class="form-control">' +
        ' <input type="hidden" name="TR_A_ID[]" id="TR_A_ID" value="" >' +
        '</td>' +
        '<td class="text-center">' +
        '<span class="btn btn-xs btn-danger remove"> <i style="cursor:pointer" class="fa fa-times"  ></i></span>' +
        '</td>' +
        '</tr>');

        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:+0'
        });
    });
    // teahcer affiliation append

    
    $(document).on('click', '#add_affiliation', function () {
        
        $("#tr_affiliation_tbl tbody").append('<tr>' +
        '<td><input type="text" name="AF_NAME[]"  value=""  class="form-control"></td>' +
        '<td><input type="text" name="START_DT[]" value=""  class="form-control datepicker"></td>' +
        '<td><input type="text" name="END_DT[]"   value=""  class="form-control datepicker">' +
        ' <input type="hidden" name="TR_AF_ID[]" id="TR_AF_ID" value="" >' +
        '</td>' +
        '<td class="text-center"><span class="btn btn-xs btn-danger remove" id=""><i style="cursor:pointer" class="fa fa-times"></i></span></td>' +
        '</tr>');

        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:+0'
        });
    });
    // teahcer skill append 

    
    $(document).on('click', '#add_skill', function () {
       
        $("#tr_skill_tbl tbody").append('<tr>' +
        '<td> <select name="SKILL_AREA[]" value="" class="form-control">' +
        ' <option value="">-Select-</option>' +
        <?php foreach($skills as $row): ?>
        '       <option value="<?php echo $row->SKILL_ID ?>"><?php echo $row->NAME ?></option>' +
        <?php endforeach; ?>
        ' </select></td>' +
        '<td>' +
        ' <input type="text" name="COM_SKILL_DES[]" value="" class="form-control"> ' +
        '<input type="hidden" name="TR_S_ID[]" id="TR_S_ID" value="" >' +
        '</td>' +
        '<td class="text-center"><span class="btn btn-xs btn-danger remove"> <i style="cursor:pointer" class="fa fa-times"  ></i></span></td> ' +

        '</tr>');


    });
    // teahcer skill append 

    
    $(document).on('click', '#add_interest', function () {
        
        $("#tr_interest_tbl tbody").append('<tr>' +
        '<td>' +
        '<select class="form-control" name="INTEREST_TYPE[]">' +
        '<option value="">-Select-</option>' +
        <?php foreach ($teacher_interest as $row) { ?>
        '<option value="<?php echo $row->LKP_ID ?>" ><?php echo $row->LKP_NAME ?></option>' +
        <?php } ?>
        '</select>' +
        '</td> ' +
        '<td>' +
        '<input type="text" name="INTERESR_SUBJECT[]" value="" class="form-control">' +
        '<input type="hidden" name="TR_INT_ID[]" id="TR_INT_ID" value="" >' +

        '</td>' +
        '<td class="text-center"><span class="btn btn-xs btn-danger remove"> <i style="cursor:pointer" class="fa fa-times"  ></i></span></td>' +
        '</tr>');


    });

    // teahcer international travel append

    
    $(document).on('click', '#add_int_travel', function () {

        $("#tr_int_travel_tbl tbody").append('<tr>' +
        '<td><input type="text" name="WHERE[]"  value=""  class="form-control"></td>' +
        '<td><input type="text" name="FROM_DT[]" value=""  class="form-control datepicker"></td>' +
        '<td><input type="text" name="TO_DT[]"   value=""  class="form-control datepicker">' +
        '<td><input type="text" name="PURPOSE[]"   value=""  class="form-control">' +
        ' <input type="hidden" name="TR_IR_ID[]" id="TR_IR_ID" value="" >' +
        '</td>' +
        '<td class="text-center"><span class="btn btn-xs btn-danger remove" id=""><i style="cursor:pointer" class="fa fa-times"></i></span></td>' +
        '</tr>');

        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:+0'
        });
    });
    // teahcer disease  append


    $(document).on('click', '#add_disease', function () {

        $("#tr_disease_tbl tbody").append('<tr>' +
        '<td><input type="text" name="DISEASE_NAME[]"  value=""  class="form-control"></td>' +
        '<td><input type="text" name="START_DT[]" value=""  class="form-control datepicker"></td>' +
        '<td><input type="text" name="END_DT[]"   value=""  class="form-control datepicker">' +
        '<td><input type="text" name="DOCTOR_NAME[]"   value=""  class="form-control">' +
        ' <input type="hidden" name="TR_DISEASE_ID[]" id="TR_DISEASE_ID" value="" >' +
        '</td>' +
        '<td class="text-center"><span class="btn btn-xs btn-danger remove" id=""><i style="cursor:pointer" class="fa fa-times"></i></span></td>' +
        '</tr>');
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:+0'
        });
    });
    // teahcer publication append
 
    $(document).on('click', '#add_publication', function () {
 
        $("#tr_publication_tbl tbody").append(' <tr>' +
        '<td><input type="text" name="TITLE[]" value="" class="form-control"></td>' +
        ' <td><input type="text" name="PUBLISHER[]" value=" " class="form-control"></td>' +
        '<td><input type="text" name="PUB_DATE[]" value="" class="form-control datepicker"></td>' +
        '<td><input type="text" name="PUBLICATION_URL[]" value="" class="form-control"></td>' +
        '<td><input type="text" name="AUTHOR[]" value="" class="form-control"></td>' +
        '<td>' +
        '<textarea class="form-control" name="DESCRIPTION[]"></textarea>' +
        '<input type="hidden" name="TR_PUB_ID[]" id="TR_PUB_ID" value="" >' +
        '</td>' +
        '<td class="text-center"><span class="btn btn-xs btn-danger remove"> <i style="cursor:pointer" class="fa fa-times"  ></i></span></td> ' +
        '</tr>');
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:+0'
        });

    });
</script>
