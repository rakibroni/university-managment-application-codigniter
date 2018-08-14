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
        width: 180px;
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

    .toggle-div-course-e {
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
<div class="">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Existing Students Update form</h5>

            <div class="ibox-tools">
                <a href="<?php echo base_url(); ?>student/studentDetails"><button class="btn btn-primary btn-xs" type="button"><i class="fa fa-arrow-left"></i> Back</button></a>
            </div>
        </div>
        <form class="form-horizontal" id="existingStu"
              action="<?php echo base_url(); ?>student/updateExistingStu/<?php echo $applicant->STUDENT_ID ?>"
              method="post" enctype="multipart/form-data">
            <div class="">
                <div class="ibox-content">
                    <strong>NOTE : </strong> All <span class="red">*</span> field are required.
                    <h4 style="color:green">Personal Information</h4>
                    <?php if (!empty($applicant)) { ?>
                        <div class="div-background">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Name ( English ) <span
                                            class="red">*</span></label>

                                    <div class="col-md-5">
                                        <input type="text" name="FULL_NAME_EN" id="FULL_NAME_EN"  value="<?php echo $applicant->FULL_NAME_EN ?>" class="form-control" placeholder="Full Name In English" required>

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
                                    <label class="col-md-5 control-label">নাম ( বাংলা ) <span
                                            class="red">*</span></label>

                                    <div class="col-md-5">
                                        <input type="text" name="FULL_NAME_BN" id="FULL_NAME_BN"
                                               value="<?php echo $applicant->FULL_NAME_BN ?>"
                                               class="form-control keyboardInput" placeholder="বাংলা নাম" required>
                                        <span class="red"><?php echo form_error('FULL_NAME_BN'); ?></span>
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2" data-content="বাংলায় আপনার  নাম লিখুন"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Date of Birth <span
                                            class="red">*</span></label>

                                    <div class="col-md-3">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" name="DATH_OF_BIRTH" id="DATH_OF_BIRTH"
                                                   class="form-control datepicker"
                                                   value="<?php echo date('Y-m-d', strtotime($applicant->DATH_OF_BIRTH)); ?>"
                                                   required="required" readonly>

                                        </div>
                                        <span class="red"><?php echo form_error('DATH_OF_BIRTH'); ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <i class="fa fa-info-circle pointer2 "
                                           data-content="Select birth date from calender" data-placement="right"
                                           data-toggle="popover" data-container="body" data-original-title=""
                                           title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Place of Birth <span
                                            class="red">*</span></label>

                                    <div class="col-md-5">
                                        <div class="input-group date">
                                            <input type="text" name="PLACE_OF_BIRTH" id="PLACE_OF_BIRTH"
                                                   class="form-control" value="<?php echo $applicant->PLACE_OF_BIRTH ?>"
                                                   required="required" placeholder="Place of Birth">

                                        </div>
                                        <span class="red"><?php echo form_error('PLACE_OF_BIRTH'); ?></span>
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2"
                                           data-content="Enter the name of place where are you born"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Blood Group</label>

                                    <div class="col-md-5">
                                        <div class="input-group date">
                                            <select name="BLOOD_GRP" class="form-control">
                                                <option value="">-Select-</option>
                                                <?php foreach ($blood_group as $row): ?>
                                                    <option
                                                        value="<?php echo $row->LKP_ID ?>" <?php echo ($row->LKP_ID == $applicant->BLOOD_GROUP) ? 'selected' : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <span class="red"><?php echo form_error('BLOOD_GRP'); ?></span>
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2" data-content="Select your blood group"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Gender <span class="red">*</span></label>

                                    <div class="col-md-5">
                                        <input type="radio" name="GENDER" value="M" <?php
                                        if ($applicant->GENDER == 'M') {
                                            echo 'checked';
                                        } else {
                                            echo "";
                                        }
                                        ?>>&nbsp; Male &nbsp; <input type="radio" name="GENDER" value="F" <?php
                                        if ($applicant->GENDER == 'F') {
                                            echo 'checked';
                                        } else {
                                            echo "";
                                        }
                                        ?>> &nbsp;Female &nbsp; <input type="radio" name="GENDER" value="O" <?php
                                        if ($applicant->GENDER == 'O') {
                                            echo 'checked';
                                        } else {
                                            echo "";
                                        }
                                        ?>>&nbsp; Others
                                        <span class="red"><?php echo form_error('GENDER'); ?></span>
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2" data-content="Please select your gender"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Marital Status <span
                                            class="red">*</span></label>

                                    <div class="col-md-3">
                                        <select class="form-control" name="MARITAL_STATUS" id="marital_status" required>
                                            <option value="">-Select-</option>
                                            <?php foreach ($merital_status as $row): ?>
                                                <option
                                                    value="<?php echo $row->LKP_ID ?>" <?php echo ($row->LKP_ID == $applicant->MARITAL_STATUS) ? 'selected' : '' ?>><?php echo $row->LKP_NAME ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="red"><?php echo form_error('MARITAL_STATUS'); ?></span>
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2"
                                           data-content="Please select your merital status" data-placement="right"
                                           data-toggle="popover" data-container="body" data-original-title=""
                                           title="Help"></i>
                                    </div>
                                </div>
                                <div style="display:<?php
                                if ($applicant->MARITAL_STATUS == '12') {
                                    echo "";
                                } else {
                                    echo "none";
                                }
                                ?>" id="spouse_name">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Spouse Name <span
                                                class="red">*</span></label>

                                        <div class="col-md-5">
                                            <input type="text" class="is_required_s" name="SPOUSE_NAME" id="SPOUSE_NAME"
                                                   placeholder="Spouse Name"
                                                   value="<?php echo $applicant->SPOUSE_NAME ?>">
                                            <span class="red"><?php echo form_error('SPOUSE_NAME'); ?></span>
                                        </div>
                                        <div class="col-md-2">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Please enter your spouse name here" data-placement="right"
                                               data-toggle="popover" data-container="body" data-original-title=""
                                               title="Help"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Nationality <span class="red">*</span></label>

                                    <div class="col-md-5">
                                        <select class="form-control" name="NATIONALITY" id="NATIONALITY" required>
                                            <option value="">-Select-</option>
                                            <?php foreach ($nationality as $row) { ?>
                                                <option
                                                    value="<?php echo $row->id ?>" <?php echo ($row->id == $applicant->NATIONALITY) ? 'selected' : ''; ?>><?php echo $row->nationality ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="red"><?php echo form_error('NATIONALITY'); ?></span>
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2" data-content="Select your nationality"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">National ID</label>

                                    <div class="col-md-5">
                                        <input type="text" name="NATIONAL_ID" id="NATIONAL_ID"
                                               value="<?php echo $applicant->NATIONAL_ID ?>"
                                               class="form-control numbersOnly" placeholder="National ID">
                                        <span class="nationalID_validation red"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2"
                                           data-content="Please enter your natinal indentity number here"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 control-label">Passport No</label>

                                    <div class="col-md-5">
                                        <input type="text" name="PASSPORT_NO" id="PASSPORT"
                                               value="<?php echo $applicant->PASSPORT_NO ?>" class="form-control"
                                               placeholder="Passport No">
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2" data-content="Enter your Passport No"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Email </label>

                                    <div class="col-md-4">
                                        <input type="text" name="EMAIL_ADRESS[]" id="EMAIL"
                                               value="<?php echo set_value('EMAIL_ADRESS'); ?>"
                                               class="form-control checkEmail" placeholder="Email">
                                        <input type="hidden" value="" name="STU_CI_ID[]"/>
                                        <span
                                            class="red email_validation"><?php echo form_error('EMAIL_ADRESS'); ?></span>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-xs btn-info" id="add_email"><i style="cursor:pointer"
                                                                                            class="fa fa-plus"></i></span>
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2"
                                           data-content="Please enter your valid email address here"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label"></label>

                                    <div class="col-md-4">
                                        <table id="email_list">
                                            <tbody>
                                            <?php foreach ($email as $row): ?>
                                                <tr id="row_id_<?php echo $row->STU_CI_ID ?>">
                                                    <td>
                                                        <input type="text" name="EMAIL_ADRESS[]"
                                                               value="<?php echo $row->CONTACTS ?>" id="EMAIL"
                                                               class="form-control " placeholder="Email">
                                                        <input type="hidden" name="STU_CI_ID[]"
                                                               value="<?php echo $row->STU_CI_ID ?>">
                                                    </td>
                                                    <td>
                                                        <i style="cursor:pointer"
                                                           class="fa fa-times btn-xs btn-danger delete_row_data"
                                                           attribute_id="<?php echo $row->STU_CI_ID ?>"
                                                           attribute="STU_CI_ID" table_name="stu_contractinfo"></i>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Mobile <span class="red">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" name="MOBILE_NO[]" id="PHONE"
                                               value="<?php echo set_value('MOBILE_NO'); ?>"
                                               class="form-control numbersOnly" placeholder="Mobile">
                                        <input type="hidden" value="" name="STU_CI_ID_M[]"/>
                                        <span
                                            class="red"><?php //echo form_error('MOBILE_NO');                    ?></span>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-xs btn-info" id="add_mobile"><i style="cursor:pointer"
                                                                                             class="fa fa-plus"></i></span>
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2"
                                           data-content="Please enter your  mobile no here" data-placement="right"
                                           data-toggle="popover" data-container="body" data-original-title=""
                                           title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label"></label>

                                    <div class="col-md-4">
                                        <table id="mobile_list">
                                            <tbody>
                                            <?php foreach ($contact as $row): ?>
                                                <tr id="row_id_<?php echo $row->STU_CI_ID ?>">
                                                    <td>
                                                        <input type="text" name="MOBILE_NO[]"
                                                               value="<?php echo $row->CONTACTS ?>"
                                                               class="form-control numbersOnly" placeholder="Mobile">
                                                        <input type="hidden" name="STU_CI_ID_M[]"
                                                               value="<?php echo $row->STU_CI_ID ?>">
                                                    </td>
                                                    <td>
                                                        <i style="cursor:pointer"
                                                           class="fa fa-times btn-xs btn-danger delete_row_data"
                                                           attribute_id="<?php echo $row->STU_CI_ID ?>"
                                                           attribute="STU_CI_ID" table_name="stu_contractinfo"></i>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Religion <span class="red">*</span></label>

                                    <div class="col-md-3">
                                        <select class="form-control" name="RELIGION_ID" id="RELIGION_ID">
                                            <option value="">-Select-</option>
                                            <?php foreach ($religion as $row): ?>
                                                <option
                                                    value="<?php echo $row->LKP_ID ?>" <?php echo ($applicant->RELIGION_ID == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="red"><?php echo form_error('RELIGION'); ?></span>
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fa fa-info-circle pointer2" data-content="Select your religion"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Height</label>

                                    <div class="col-md-1" style="padding-right: 0;">
                                        <input type="text" name="HEIGHT_FEET" id="HEIGHT_FEET"
                                               value="<?php echo $applicant->HEIGHT_FEET ?>"
                                               class="form-control numbersOnly" placeholder="e.g: 5.8">
                                    </div>
                                    <div class="col-md-1">
                                        Ft.
                                    </div>
                                    <div class="col-md-2" style="padding-right: 0;">
                                        <input type="text" name="HEIGHT_CM" id="HEIGHT_CM"
                                               value="<?php echo $applicant->HEIGHT_CM ?>"
                                               class="form-control numbersOnly" placeholder="e.g: 176.78">
                                    </div>
                                    <div class="col-md-1">
                                        Cm.
                                    </div>
                                    <div class="col-md-1">
                                        <i class="fa fa-info-circle pointer2" data-content="Please input your hieght"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Weight</label>

                                    <div class="col-md-2" style="padding-right: 0;">
                                        <input type="text" name="WEIGHT_KG" id="WEIGHT_KG"
                                               value="<?php echo $applicant->WEIGHT_KG ?>"
                                               class="form-control numbersOnly" placeholder="Weight">
                                    </div>
                                    <div class="col-md-1">
                                        Kg
                                    </div>
                                    <div class="col-md-2" style="padding-right: 0;">
                                        <input type="text" name="WEIGHT_LBS" id="WEIGHT_LBS"
                                               value="<?php echo $applicant->WEIGHT_LBS ?>"
                                               class="form-control numbersOnly" placeholder="Weight">
                                    </div>
                                    <div class="col-md-1">
                                        Pound
                                    </div>
                                    <div class="col-md-1">
                                        <i class="fa fa-info-circle pointer2" data-content="please input your weight"
                                           data-placement="right" data-toggle="popover" data-container="body"
                                           data-original-title="" title="Help"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pull-right" style="margin-right: 60px">
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <div class="avatar-zone">
                                                <img id="img_id"
                                                     src="<?php echo base_url("upload/existing_studnet_photo/$applicant->STUD_PHOTO"); ?>"
                                                     alt="select photo" style="width: 180px;
                                                     height: 160px;"/>
                                            </div>
                                            <div class="overlay-layer">Change</div>
                                            <input type='file' name="photo" onchange="upload_img(this);"
                                                   class="upload_btn">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php } ?>
                    <br><br>
                    <h4 style="color:green">Family and Others Information</h4>

                    <div class="div-background">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Father's Name <span class="red">*</span></label>

                                <div class="col-md-5">
                                    <input type="text" name="FATHER_NAME" id="FATHER_NAME"
                                           value="<?php echo $applicant->FATHER_NAME ?>" class="form-control"
                                           placeholder="Father's Name" required>
                                    <input type="hidden" name="STU_PARENT_ID_F"
                                           value="<?php if (!empty($fathersInfo->STU_PARENT_ID)) echo $fathersInfo->STU_PARENT_ID ?>">
                                    <span class="red"><?php echo form_error('FATHER_NAME'); ?></span>
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

                                <div class="col-md-3">
                                    <select class="form-control" name="FATHER_OCU" id="FATHER_OCU">
                                        <option value="">-Select-</option>
                                        <?php foreach ($occupation as $row) { ?>
                                            <option
                                                value="<?php echo $row->LKP_ID ?>" <?php if (!empty($fathersInfo->OCCUPATION)) echo ($fathersInfo->OCCUPATION == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME ?></option>
                                        <?php } ?>
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

                                <div class="col-md-3">
                                    <input type="text" name="FATHER_PHN[]" id="FATHER_PHN" value=""
                                           class="form-control numbersOnly" placeholder="Father's Phone">
                                    <input type="hidden" name="STU_PGS_ID_F[]" value="">
                                </div>
                                <div class="col-md-2">
                                    <span class="btn btn-xs btn-info" id="add_mobile_f"> <i style="cursor:pointer"
                                                                                            class="fa fa-plus"></i></span>
                                </div>

                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your Father's  mobile no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label"></label>

                                <div class="col-md-3">
                                    <table id="mobile_list_f">
                                        <tbody>
                                        <?php if (!empty($father_contact)): foreach ($father_contact as $row): ?>
                                            <tr id="row_id_<?php echo $row->STU_PGS_ID ?>">
                                                <td>
                                                    <input type="text" name="FATHER_PHN[]"
                                                           value="<?php echo $row->CONTACTS ?>"
                                                           class="form-control numbersOnly" placeholder="Mobile">
                                                    <input type="hidden" name="STU_PGS_ID_F[]"
                                                           value="<?php echo $row->STU_PGS_ID ?>">
                                                </td>
                                                <td>
                                                    <i style="cursor:pointer"
                                                       class="fa fa-times btn-xs btn-danger delete_row_data"
                                                       attribute_id="<?php echo $row->STU_PGS_ID ?>"
                                                       attribute="STU_PGS_ID" table_name="stu_pgscontract"></i>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        endif;
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Father's Email </label>

                                <div class="col-md-3">
                                    <input type="text" name="FATHER_EMAIL[]" id="FATHER_EMAIL"
                                           value="<?php echo set_value('FATHER_EMAIL'); ?>"
                                           class="form-control checkEmail" placeholder="Father's Email">
                                    <input type="hidden" name="STU_PGS_ID_FE[]" value="">
                                    <span class="red father_email_validation"></span>
                                </div>
                                <div class="col-md-1">

                                    <span class="btn btn-xs btn-info" id="add_email_f"> <i style="cursor:pointer"
                                                                                           class="fa fa-plus"></i></span>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your father's valid email address here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label"></label>

                                <div class="col-md-3">
                                    <table id="email_list_f">
                                        <tbody>
                                        <?php if (!empty($father_email)): foreach ($father_email as $row): ?>
                                            <tr id="row_id_<?php echo $row->STU_PGS_ID ?>">
                                                <td>

                                                    <input type="text" name="FATHER_EMAIL[]"
                                                           value="<?php echo $row->CONTACTS ?>" class="form-control "
                                                           placeholder="Father Email">
                                                    <input type="hidden" name="STU_PGS_ID_FE[]"
                                                           value="<?php echo $row->STU_PGS_ID ?>">
                                                </td>
                                                <td>
                                                    <i style="cursor:pointer"
                                                       class="fa fa-times btn-xs btn-danger delete_row_data"
                                                       attribute_id="<?php echo $row->STU_PGS_ID ?>"
                                                       attribute="STU_PGS_ID" table_name="stu_pgscontract"></i>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                        endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pull-right" style="margin-right: 60px">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <div class="avatar-zone">
                                            <?php
                                            $f_p = 'assets/img/default.png';
                                            if (!empty($fathersInfo->PARENT_PHOTO)) {
                                                $recent_f_p = 'upload/existing_studnet_photo/parent/' . $fathersInfo->PARENT_PHOTO;
                                            }
                                            if (!empty($fathersInfo->PARENT_PHOTO)) {
                                                $f_p = $recent_f_p;
                                            }
                                            ?>
                                            <img id="f_img_id" src="<?php echo base_url($f_p) ?>" alt="Empty" style="width: 180px;
                                                 height: 160px;"/>
                                        </div>
                                        <div class="overlay-layer">Father photo</div>
                                        <input type='file' name="father_photo" onchange="upload_father_img(this);"
                                               class="upload_btn">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Mother's Name <span class="red">*</span></label>

                                <div class="col-md-5">
                                    <input type="text" name="MOTHER_NAME" id="MOTHER_NAME"
                                           value="<?php if (!empty($applicant->MOTHER_NAME)) echo $applicant->MOTHER_NAME ?>"
                                           class="form-control" placeholder="Mother's Name" required>
                                    <input type="hidden" name="STU_PARENT_ID_M"
                                           value="<?php if (!empty($motherInfo->STU_PARENT_ID)) echo $motherInfo->STU_PARENT_ID ?>">
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

                                <div class="col-md-3">
                                    <select class="form-control" name="MOTHER_OCU" id="MOTHER_OCU">
                                        <option value="">-Select-</option>
                                        <?php foreach ($occupation as $row) { ?>
                                            <option
                                                value="<?php echo $row->LKP_ID ?>" <?php if (!empty($motherInfo->OCCUPATION)) echo ($motherInfo->OCCUPATION == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME ?></option>
                                        <?php } ?>
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

                                <div class="col-md-3">
                                    <input type="text" name="MOTHER_PHN[]" id="MOTHER_PHN" value=""
                                           class="form-control numbersOnly" placeholder="Mother's Phone">
                                    <input type="hidden" name="STU_PGS_ID_M[]" value="">
                                </div>
                                <div class="col-md-1">

                                    <span class="btn btn-xs btn-info" id="add_mobile_m"> <i style="cursor:pointer"
                                                                                            class="fa fa-plus"></i></span>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your mother's valid mobile no here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label"></label>

                                <div class="col-md-3">
                                    <table id="mobile_list_m">
                                        <tbody>
                                        <?php if (!empty($mother_contact)): foreach ($mother_contact as $row): ?>
                                            <tr id="row_id_<?php echo $row->STU_PGS_ID ?>">
                                                <td>
                                                    <input type="text" name="MOTHER_PHN[]"
                                                           value="<?php echo $row->CONTACTS ?>"
                                                           class="form-control numbersOnly" placeholder="Mobile">
                                                    <input type="hidden" name="STU_PGS_ID_M[]"
                                                           value="<?php echo $row->STU_PGS_ID ?>">
                                                </td>
                                                <td>
                                                    <i style="cursor:pointer"
                                                       class="fa fa-times btn-xs btn-danger delete_row_data"
                                                       attribute_id="<?php echo $row->STU_PGS_ID ?>"
                                                       attribute="STU_PGS_ID" table_name="stu_pgscontract"></i>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                        endif; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Mother's Email </label>

                                <div class="col-md-3">
                                    <input type="text" name="MOTHER_EMAIL[]" id="MOTHER_EMAIL"
                                           value="<?php echo set_value('MOTHER_EMAIL'); ?>"
                                           class="form-control checkEmail" placeholder="Mother's Email">
                                    <input type="hidden" name="STU_PGS_ID_ME[]" value="">
                                    <span class="red mother_email_validation"></span>
                                </div>
                                <div class="col-md-1">

                                    <span class="btn btn-xs btn-info" id="add_email_m"> <i style="cursor:pointer"
                                                                                           class="fa fa-plus"></i></span>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your mother's valid email address here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label"></label>

                                <div class="col-md-3">
                                    <table id="email_list_m">
                                        <tbody>
                                        <?php
                                        if (!empty($mother_email)):
                                            foreach ($mother_email as $row):
                                                ?>
                                                <tr id="row_id_<?php echo $row->STU_PGS_ID ?>">
                                                    <td>
                                                        <input type="text" name="MOTHER_EMAIL[]"
                                                               value="<?php echo $row->CONTACTS ?>" class="form-control"
                                                               placeholder="Mobile">
                                                        <input type="hidden" name="STU_PGS_ID_ME[]"
                                                               value="<?php echo $row->STU_PGS_ID ?>">
                                                    </td>
                                                    <td>
                                                        <i style="cursor:pointer"
                                                           class="fa fa-times btn-xs btn-danger delete_row_data"
                                                           attribute_id="<?php echo $row->STU_PGS_ID ?>"
                                                           attribute="STU_PGS_ID" table_name="stu_pgscontract"></i>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pull-right" style="margin-right: 60px">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <?php
                                        $m_p = 'assets/img/default.png';
                                        if (!empty($motherInfo->PARENT_PHOTO)) {
                                            $recent_m_p = 'upload/existing_studnet_photo/parent/' . $motherInfo->PARENT_PHOTO;
                                        }
                                        if (!empty($motherInfo->PARENT_PHOTO)) {
                                            $m_p = $recent_m_p;
                                        }
                                        ?>
                                        <div class="avatar-zone">
                                            <img id="m_img_id" src="<?php echo base_url($m_p); ?>" alt="select photo"
                                                 style="width: 180px;
                                                 height: 160px;"/>
                                        </div>
                                        <div class="overlay-layer">Mother photo</div>
                                        <input type='file' name="mother_photo" onchange="upload_mother_img(this);"
                                               class="upload_btn">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Present Address <span class="red">*</span></label>

                            <div class="col-md-1">
                                <!--                                    <input type="checkbox" name="PRES_ADDRESS" value="" id="PRES_ADDRESS" required>-->
                                <input type="hidden" name="STU_ADRESS_ID_PS"
                                       value="<?php if (!empty($addrInfo->STU_ADRESS_ID)) echo $addrInfo->STU_ADRESS_ID ?>">

                            </div>
                        </div>
                        <div id="present_address" class="toggle-div1">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Division</label>

                                <div class="col-md-3">
                                    <select name="DIVISION_ID" id="DIVISION_ID" class="form-control"
                                            required="required">
                                        <option value="">-Select-</option>
                                        <?php foreach ($division as $rd) { ?>
                                            <option
                                                value="<?php echo $rd->DIVISION_ID ?>" <?php if (!empty($addrInfo->DIVISION_ID)) echo ($addrInfo->DIVISION_ID == $rd->DIVISION_ID) ? 'selected' : '' ?>><?php echo $rd->DIVISION_ENAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select division name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">District</label>

                                <div class="col-md-3">
                                    <select name="DISTRICT_ID" id="DISTRICT_ID" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($district as $rd) { ?>
                                            <option
                                                value="<?php echo $rd->DISTRICT_ID ?>" <?php if (!empty($addrInfo->DISTRICT_ID)) echo ($addrInfo->DISTRICT_ID == $rd->DISTRICT_ID) ? 'selected' : '' ?>><?php echo $rd->DISTRICT_ENAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select district name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Upazila/Thana</label>

                                <div class="col-md-3">
                                    <select name="THANA_ID" id="THANA_ID" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($thana as $rd) { ?>
                                            <option
                                                value="<?php echo $rd->THANA_ID ?>" <?php if (!empty($addrInfo->THANA_ID)) echo ($addrInfo->THANA_ID == $rd->THANA_ID) ? 'selected' : '' ?>><?php echo $rd->THANA_ENAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select upazila or thana name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Police Station</label>

                                <div class="col-md-3">
                                    <select name="POLICE_STATION_ID" id="POLICE_STATION_ID" class="form-control"
                                            required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($police_station as $rd) { ?>
                                            <option
                                                value="<?php echo $rd->POLICE_STATION_ID ?>" <?php if (!empty($addrInfo->POLICE_STATION_ID)) echo ($addrInfo->POLICE_STATION_ID == $rd->POLICE_STATION_ID) ? 'selected' : '' ?>><?php echo $rd->PS_ENAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select police station"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Union/Ward No.</label>

                                <div class="col-md-3">
                                    <select name="UNION_ID" id="UNION_ID" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($union as $rd) { ?>
                                            <option
                                                value="<?php echo $rd->UNION_ID ?>" <?php if (!empty($addrInfo->UNION_ID)) echo ($addrInfo->UNION_ID == $rd->UNION_ID) ? 'selected' : '' ?>><?php echo $rd->UNION_NAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select ward or union"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Post office</label>

                                <div class="col-md-3">
                                    <select name="POST_OFFICE_ID" id="POST_OFFICE_ID" class="form-control">
                                        <option value="">-Select-</option>
                                        <?php foreach ($post_office as $rd) { ?>
                                            <option
                                                value="<?php echo $rd->POST_OFFICE_ID ?>" <?php if (!empty($addrInfo->POST_OFFICE_ID)) echo ($addrInfo->POST_OFFICE_ID == $rd->POST_OFFICE_ID) ? 'selected' : '' ?>><?php echo $rd->POST_OFFICE_ENAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select post office"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Vill/House no/Road no</label>

                                <div class="col-md-3">
                                    <input type="text" name="VILLAGE" id="VILLAGE"
                                           value="<?php if (!empty($addrInfo->VILLAGE_WARD)) echo $addrInfo->VILLAGE_WARD ?>"
                                           class="form-control" required/>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Enter your village,house or road no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">

                            <label class="col-md-3 control-label">Permanent Address <span class="red">*</span></label>

                            <div class="col-md-2"> Same as present address?</div>
                            <div class="col-md-1">
                                <input type="radio" class="SAS_PSORPR" name="SAS_PSORPR" value="1"
                                       id="PARM_ADDRESS_YES" <?php if (!empty($addrInfo->SAS_PSORPR)) echo ($addrInfo->SAS_PSORPR == 'PS') ? 'checked' : ''; ?>>&nbsp;
                                Yes
                                <input type="hidden" name="STU_ADRESS_ID_PR" value="<?php
                                if (!empty($parAddrInfo)) {
                                    echo $parAddrInfo->STU_ADRESS_ID;
                                }
                                ?>">

                            </div>
                            <div class="col-md-1">
                                <input type="radio" class="SAS_PSORPR" name="SAS_PSORPR" value="0"
                                       id="PARM_ADDRESS_NO" <?php
                                if (!empty($parAddrInfo)) {
                                    echo ($parAddrInfo->ADRESS_TYPE == 'PR') ? 'checked' : '';
                                }
                                ?>>&nbsp; No
                            </div>
                            <div class="col-md-1">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Select yes if your present and permanent address are same other wise select no for different address"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div id="permanent_address" class="toggle-div<?php
                        if (!empty($parAddrInfo)) {
                            echo ($parAddrInfo->ADRESS_TYPE == 'PR') ? '1' : '';
                        }
                        ?>">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Division</label>

                                <div class="col-md-3">
                                    <select name="P_DIVISION_ID" id="P_DIVISION_ID" class="form-control is_required">
                                        <option value="">-Select-</option>
                                        <?php foreach ($division as $rd) { ?>
                                            <option value="<?php echo $rd->DIVISION_ID ?>" <?php
                                            if (!empty($parAddrInfo)) {
                                                echo ($parAddrInfo->DIVISION_ID == $rd->DIVISION_ID) ? 'selected' : '';
                                            }
                                            ?>><?php echo $rd->DIVISION_ENAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select division name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">District</label>

                                <div class="col-md-3">
                                    <select name="P_DISTRICT_ID" id="P_DISTRICT_ID" class="form-control is_required">
                                        <option value="">-Select-</option>
                                        <?php foreach ($district as $rd) { ?>
                                            <option value="<?php echo $rd->DISTRICT_ID ?>" <?php
                                            if (!empty($parAddrInfo)) {
                                                echo ($parAddrInfo->DISTRICT_ID == $rd->DISTRICT_ID) ? 'selected' : '';
                                            }
                                            ?>><?php echo $rd->DISTRICT_ENAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select district name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Upazila/Thana</label>

                                <div class="col-md-3">
                                    <select name="P_THANA_ID" id="P_THANA_ID" class="form-control is_required">
                                        <option value="">-Select-</option>
                                        <?php foreach ($thana as $rd) { ?>
                                            <option value="<?php echo $rd->THANA_ID ?>" <?php
                                            if (!empty($parAddrInfo)) {
                                                echo ($parAddrInfo->THANA_ID == $rd->THANA_ID) ? 'selected' : '';
                                            }
                                            ?>><?php echo $rd->THANA_ENAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select upazila or thana name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Police Station</label>

                                <div class="col-md-3">
                                    <select name="P_POLICE_STATION_ID" id="P_POLICE_STATION_ID"
                                            class="form-control is_required">
                                        <option value="">-Select-</option>
                                        <?php foreach ($police_station as $rd) { ?>
                                            <option value="<?php echo $rd->POLICE_STATION_ID ?>" <?php
                                            if (!empty($parAddrInfo)) {
                                                echo ($parAddrInfo->POLICE_STATION_ID == $rd->POLICE_STATION_ID) ? 'selected' : '';
                                            }
                                            ?>><?php echo $rd->PS_ENAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select police station"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Union/Ward No.</label>

                                <div class="col-md-3">
                                    <select name="P_UNION_ID" id="P_UNION_ID" class="form-control is_required">
                                        <option value="">-Select-</option>
                                        <?php foreach ($union as $rd) { ?>
                                            <option value="<?php echo $rd->UNION_ID ?>" <?php
                                            if (!empty($parAddrInfo)) {
                                                echo ($parAddrInfo->UNION_ID == $rd->UNION_ID) ? 'selected' : '';
                                            }
                                            ?>><?php echo $rd->UNION_NAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select ward or union"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Post office</label>

                                <div class="col-md-3">
                                    <select name="P_POST_OFFICE_ID" id="P_POST_OFFICE_ID" class="form-control">
                                        <option value="">-Select-</option>
                                        <?php foreach ($post_office as $rd) { ?>
                                            <option value="<?php echo $rd->POST_OFFICE_ID ?>" <?php
                                            if (!empty($parAddrInfo)) {
                                                echo ($parAddrInfo->POST_OFFICE_ID == $rd->POST_OFFICE_ID) ? 'selected' : '';
                                            }
                                            ?>><?php echo $rd->POST_OFFICE_ENAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select post office"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Vill/House no/Road no</label>

                                <div class="col-md-3">
                                    <input type="text" name="P_VILLAGE" value="<?php
                                    if (!empty($parAddrInfo)) {
                                        echo $parAddrInfo->VILLAGE_WARD;
                                    }
                                    ?>" class="form-control is_required"/>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Enter your village,house or road no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>

                        </div>
                        <br>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Local Emergency Guardian </label>

                            <div class="col-md-3">
                                <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
                                       value="F"  <?php
                                if (!empty($fathersInfo)) {
                                    echo ($fathersInfo->ECP_FG == 1) ? 'checked' : '';
                                }
                                ?>>&nbsp; Father &nbsp;
                                <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
                                       value="M" <?php
                                if (!empty($motherInfo)) {
                                    echo ($motherInfo->ECP_FG == 1) ? 'checked' : '';
                                }
                                ?>>&nbsp; Mother &nbsp;
                                <input type="radio" name="local_emergency_guardian" class="local_emergency_guardian"
                                       value="O" <?php
                                if (!empty($guardianInfo)) {
                                    echo ($guardianInfo->ECP_FG == 1) ? 'checked' : '';
                                }
                                ?>>&nbsp; Others
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Select your local guardian here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>

                        <div id="local_guardian" class="toggle-div<?php
                        if (!empty($guardianInfo)) {
                            echo ($guardianInfo->ECP_FG == 1) ? '1' : '';
                        }
                        ?>">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Local Guardian Name</label>

                                <div class="col-md-3">
                                    <input type="text" name="LOCAL_GAR_NAME" id="LOCAL_GAR_NAME" value="<?php
                                    if (!empty($guardianInfo)) {
                                        echo $guardianInfo->GFULL_NAME;
                                    }
                                    ?>" class="form-control is_required_o" placeholder="Local Guardian Name">
                                    <input type="hidden" name="STU_GI_ID_LG" value="<?php
                                    if (!empty($guardianInfo)) {
                                        echo $guardianInfo->STU_GI_ID;
                                    }
                                    ?>">
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Enter your Local Guardian Name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Local Guardian Relation</label>

                                <div class="col-md-2">
                                    <select class="form-control is_required_o" name="LOCAL_GAR_RELATION"
                                            id="LOCAL_GAR_RELATION">
                                        <option value="">-Select-</option>
                                        <?php foreach ($relation as $row) { ?>
                                            <option value="<?php echo $row->LKP_ID ?>"  <?php
                                            if (!empty($guardianInfo)) {
                                                echo ($guardianInfo->RELATION_ID == $row->LKP_ID) ? 'selected' : '';
                                            }
                                            ?>><?php echo $row->LKP_NAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Select your Local Guardian relation" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Local Guardian Address </label>

                                <div class="col-md-3">
                                    <textarea class="form-control is_required_o" name="LOCAL_GAR_ADDRESS"><?php
                                        if (!empty($guardianInfo)) {
                                            echo $guardianInfo->ADDRESS;
                                        }
                                        ?></textarea>

                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Enter your local guardian address here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Local Guardian Mobile</label>

                                <div class="col-md-2">
                                    <input type="text" name="LOCAL_GAR_PHN[]" id="LOCAL_GAR_PHN" value=""
                                           class="form-control  numbersOnly" placeholder="Mobile">
                                    <input type="hidden" name="STU_PGS_ID_EP[]">
                                </div>
                                <div class="col-md-1">

                                    <span class="btn btn-xs btn-info" id="add_mobile_lg"> <i style="cursor:pointer"
                                                                                             class="fa fa-plus"></i></span>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your Local Guardian  mobile no here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>

                                <div class="col-md-4">
                                    <table id="mobile_list_lg">
                                        <tbody>
                                        <?php
                                        foreach ($guardian_contact as $row):
                                            ?>
                                            <tr id="row_id_<?php echo $row->STU_PGS_ID ?>">
                                                <td>
                                                    <input type="text" name="LOCAL_GAR_PHN[]"
                                                           value="<?php echo $row->CONTACTS ?>"
                                                           class="form-control numbersOnly" placeholder="Mobile">
                                                    <input type="hidden" name="STU_PGS_ID_EP[]"
                                                           value="<?php echo $row->STU_PGS_ID ?>"
                                                           class="form-control numbersOnly" placeholder="Mobile">
                                                </td>
                                                <td>
                                                    <i style="cursor:pointer"
                                                       class="fa fa-times btn-xs btn-danger delete_row_data"
                                                       attribute_id="<?php echo $row->STU_PGS_ID ?>"
                                                       attribute="STU_PGS_ID" table_name="stu_pgscontract"></i>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Extracurricular Activity</label>

                            <div class="col-md-2">
                                <select class="form-control" name="ACTIVITY_TYPE_ID[]" id="ACTIVITY_TYPE_ID">
                                    <option value="">-Select-</option>
                                    <?php foreach ($extra_activity_type as $row): ?>
                                        <option
                                            value="<?php echo $row->ACTIVITY_TYPE_ID ?>"><?php echo $row->ACTIVITY_NAME ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="col-md-2">
                                <textarea type="text" name="DESCRIPTION[]" id="DESCRIPTION" value=""
                                          class="form-control" placeholder="Description"></textarea>
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-xs btn-info" id="add_ext_act"> <i style="cursor:pointer"
                                                                                       class="fa fa-plus"></i></span>
                            </div>
                            <div class="col-md-1">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Select your Extracurricular activity" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>

                            <div class="col-md-4">
                                <table class="table table-bordered" id="ext_act_list">
                                    <tbody>
                                    <?php if (!empty($extra_activity)): foreach ($extra_activity as $row): ?>
                                        <tr id="row_id_<?php echo $row->STU_EXTRA_ACTIVITIES_ID ?>">
                                            <td><?php echo $row->ACTIVITY_NAME ?></td>
                                            <td><?php echo $row->DESCRIPTION ?></td>
                                            <td><i style="cursor:pointer"
                                                   class="fa fa-times btn-xs btn-danger delete_row_data"
                                                   attribute_id="<?php echo $row->STU_EXTRA_ACTIVITIES_ID ?>"
                                                   attribute="STU_EXTRA_ACTIVITIES_ID"
                                                   table_name="stu_extra_activities"></i></td>

                                        </tr>
                                    <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Hobby</label>

                            <div class="col-md-2">
                                <input type="text" name="HOBBY" id="HOBBY" value="<?php echo $applicant->HOBBY ?>"
                                       class="form-control" placeholder="Hobby">
                            </div>
                            <div class="col-md-1">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter your hobby"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h4 style="color: green">Academic information</h4>

                    <div class="div-background">
                        <div class="form-group">
                            <div class="col-md-12">
                                <table id="academic_list" class="table table-bordered dataTable">
                                    <thead>
                                    <tr>
                                        <th width="15%">Exam Name</th>
                                        <th width="5%">Year</th>
                                        <th width="10%">Board</th>
                                        <th width="15%">Group</th>
                                        <th width="5%">CGPA</th>
                                        <th width="20%">Institute</th>
                                        <th width="15%">Certificate Photo</th>
                                        <th width="25%" class="text-center"><span class="btn btn-xs btn-primary"><i
                                                    style="cursor:pointer" class="fa fa-plus" id="add_academic"> Add
                                                    More</i></span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    if (!empty($academic)) {
                                        foreach ($academic as $ar): $i++;
                                            ?>
                                            <tr id="row_id_<?php echo $ar->STU_AI_ID ?>">
                                                <td>
                                                    <select class="form-control" name="EXAM_NAME_<?php echo $i ?>"
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
                                                           name="PASSING_YEAR_<?php echo $i ?>"
                                                           value="<?php echo $ar->PASSING_YEAR ?>"
                                                           class=" form-control numbersOnly" id="PASSING_YEAR"
                                                           placeholder="Year">
                                                </td>
                                                <td>
                                                    <select class="form-control" name="BOARD_<?php echo $i ?>">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($board_name as $row) { ?>
                                                            <option
                                                                value="<?php echo $row->LKP_ID ?>" <?php echo ($ar->BOARD == $row->LKP_ID) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="GROUP_<?php echo $i ?>">
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($group_name as $row) { ?>
                                                            <option
                                                                value="<?php echo $row->LKP_ID ?>" <?php echo ($ar->MAJOR_GROUP_ID == $row->LKP_ID) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="width: 50px" type="text" name="GPA_<?php echo $i ?>"
                                                           value="<?php echo $ar->RESULT_GRADE ?>"
                                                           class="form-control numbersOnly" placeholder="CGPA">
                                                </td>
                                                <td>
                                                    <input type="text" name="INSTITUTE_<?php echo $i ?>"
                                                           value="<?php echo $ar->INSTITUTION ?>" class="form-control "
                                                           placeholder="Institute Name">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="COUNTER" id="COUNTER"
                                                           value="<?php echo $i; ?>"><input type="file"
                                                                                            name="CERTIFICATE"> <img
                                                        alt="Certificate photo" style="width:100px;height: 50px"
                                                        src="<?php echo base_url(); ?>upload/academin_certificate/<?php echo $ar->ACHIEVEMENT ?>">
                                                    <input type="hidden" name="AC_PK_<?php echo $i; ?>" id="AC_PK"
                                                           value="<?php echo $ar->STU_AI_ID ?>">
                                                </td>
                                                <td class="text-center">
                                                    <span style="cursor:pointer"
                                                          class="btn btn-xs btn-danger delete_row_data"
                                                          attribute_id="<?php echo $ar->STU_AI_ID ?>"
                                                          attribute="STU_AI_ID"
                                                          data-image-name="<?php echo $ar->ACHIEVEMENT ?>"
                                                          table_name="stu_acadimicinfo"><i class="fa fa-times">
                                                            Remove</i></span>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                    } else {
                                        ?>
                                        <input type="hidden" name="COUNTER" id="COUNTER" value="<?php echo $i; ?>">
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h4 style="color: green">Admission Info</h4>

                    <div class="div-background">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Admission Date <span class="red"> *</span></label>

                            <div class="col-md-2">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" readonly="" required="required" class="form-control datepicker"
                                           id="ADMISSION_DATE" name="ADMISSION_DATE"
                                           value="<?php if (!empty($admission->ADMISSION_DATE)) echo $admission->ADMISSION_DATE ?>">
                                    <input type="hidden" name="STU_ADMISSION_ID"
                                           value="<?php if (!empty($admission->STU_ADMISSION_ID)) echo $admission->STU_ADMISSION_ID ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter admission year here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Session <span class="red">*</span></label>

                            <div class="col-md-2">
                                <select class="form-control" name="SESSION" id="SESSION" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($session as $row) { ?>
                                        <option
                                            value="<?php echo $row->SESSION_ID ?>" <?php if (!empty($admission->SESSION_ID)) echo ($admission->SESSION_ID == $row->SESSION_ID) ? 'selected' : ''; ?>><?php echo $row->SESSION_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('SESSION'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select session here"
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
                                            value="<?php echo $row->FACULTY_ID ?>" <?php if (!empty($admission->FACULTY_ID)) echo ($admission->FACULTY_ID == $row->FACULTY_ID) ? 'selected' : ''; ?>><?php echo $row->FACULTY_NAME ?></option>
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
                                <select class="form-control" name="DEPT_ID" id="DEPT_ID" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($department as $row) { ?>
                                        <option
                                            value="<?php echo $row->DEPT_ID ?>" <?php if (!empty($admission->DEPT_ID)) echo ($admission->DEPT_ID == $row->DEPT_ID) ? 'selected' : ''; ?>><?php echo $row->DEPT_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('DEPT_ID'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select Department here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Program <span class="red">*</span></label>

                            <div class="col-md-3">
                                <select class="form-control" name="PROGRAM_ID" id="PROGRAM_ID" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($program as $row) { ?>
                                        <option
                                            value="<?php echo $row->PROGRAM_ID ?>" <?php if (!empty($admission->PROGRAM_ID)) echo ($admission->PROGRAM_ID == $row->PROGRAM_ID) ? 'selected' : ''; ?>><?php echo $row->PROGRAM_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('PROGRAM_ID'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select program here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Semester <span class="red">*</span></label>

                            <div class="col-md-2">
                                <select class="form-control" name="SEMESTER" id="SEMESTER" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($semester as $row) { ?>
                                        <option
                                            value="<?php echo $row->SEMESTER_ID ?>" <?php if (!empty($admission->SEMISTER_ID)) echo ($admission->SEMISTER_ID == $row->SEMESTER_ID) ? 'selected' : ''; ?>><?php echo $row->SEMESTER_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('SEMESTER'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select Semester here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Batch <span class="red">*</span></label>

                            <div class="col-md-2">
                                <select class="form-control" name="BATCH_ID" id="BATCH_ID" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($batch as $row) { ?>
                                        <option
                                            value="<?php echo $row->BATCH_ID ?>" <?php if (!empty($applicant->BATCH_ID)) echo ($applicant->BATCH_ID == $row->BATCH_ID) ? 'selected' : ''; ?>><?php echo $row->BATCH_TITLE ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('SEMESTER'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select Semester here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <h4 style="color: green">Current Course Information</h4>

                    <div class="div-background">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Faculty</label>

                            <div class="col-md-3">
                                <select class="form-control" name="FACULTY_C" id="FACULTY_C">
                                    <option value="">-Select-</option>
                                    <?php foreach ($faculty as $row) { ?>
                                        <option
                                            value="<?php echo $row->FACULTY_ID ?>" <?php if (!empty($current_academic_info->FACULTY_ID)) echo ($current_academic_info->FACULTY_ID == $row->FACULTY_ID) ? 'selected' : ''; ?>><?php echo $row->FACULTY_NAME ?></option>
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
                                <select class="form-control" name="DEPT_ID_C" id="DEPT_ID_C" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($department as $row) { ?>
                                        <option
                                            value="<?php echo $row->DEPT_ID ?>" <?php if (!empty($current_academic_info->DEPT_ID)) echo ($current_academic_info->DEPT_ID == $row->DEPT_ID) ? 'selected' : ''; ?>><?php echo $row->DEPT_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('DEPT_ID'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select Department here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Program <span class="red">*</span></label>

                            <div class="col-md-3">
                                <select class="form-control" name="PROGRAM_ID_C" id="PROGRAM_ID_C" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($program as $row) { ?>
                                        <option
                                            value="<?php echo $row->PROGRAM_ID ?>" <?php if (!empty($current_academic_info->PROGRAM_ID)) echo ($current_academic_info->PROGRAM_ID == $row->PROGRAM_ID) ? 'selected' : ''; ?>><?php echo $row->PROGRAM_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('PROGRAM_ID'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select program here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>

                            <div class="col-md-3">

                                <div id="offer_course_list_div" class="toggle-div-course-e flexy">
                                    <table width="50%" id="offer_course_list" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" name="" id="selecctall"> All</th>
                                            <th>Code</th>
                                            <th>Title</th>
                                            <th>Credit</th>
                                        </tr>
                                        </thead>
                                        <?php

                                        if (!empty($current_academic_info)) {
                                            $courses_list = $this->db->query("SELECT a.*,
                                                                            b.COURSE_ID,
                                                                            b.COURSE_CODE,
                                                                            b.COURSE_TITLE,
                                                                            b.CREDIT
                                                                            FROM aca_semester_course a LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID
                                                                            WHERE a.FACULTY_ID = $current_academic_info->FACULTY_ID AND a.DEPT_ID = $current_academic_info->DEPT_ID AND a.PROGRAM_ID = $current_academic_info->PROGRAM_ID AND a.SEMESTER_ID= $current_academic_info->SEMESTER_ID")->result();
                                         // echo "<pre>"; print_r($current_academic_info); exit; echo "</pre>";
                                            $stu_courses = $this->db->query("SELECT co.COURSE_ID
                                                                        FROM stu_courseinfo c
                                                                        INNER JOIN aca_course_offer co ON c.OFFERED_COURSE_ID = co.OFFERED_COURSE_ID
                                                                        WHERE co.FACULTY_ID = $current_academic_info->FACULTY_ID AND co.DEPT_ID = $current_academic_info->DEPT_ID AND co.PROGRAM_ID =$current_academic_info->PROGRAM_ID AND c.STUDENT_ID = $current_academic_info->STUDENT_ID AND c.IS_CURRENT = 1")->result();
                                        } ?>
                                        <tbody>
                                        <?php
                                        $course_array = array();
                                        if (!empty($stu_courses))
                                            foreach ($stu_courses as $stu_course) {
                                                $course_array[] = $stu_course->COURSE_ID;
                                            }
                                        if (!empty($courses_list))
                                            for ($i = 0; $i < sizeof($courses_list); $i++) {
                                                if (in_array($courses_list[$i]->COURSE_ID, $course_array)) {
                                                    $is_checked = "checked='checked'";
                                                } else {
                                                    $is_checked = "";
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" <?php echo $is_checked; ?>
                                                               name="COURSE_ID[]"
                                                               value="<?php echo $courses_list[$i]->COURSE_ID ?>"
                                                               class="checkbox">
                                                        <input type="hidden" name="OFFERED_COURSE_ID[]"
                                                               value="<?php echo $courses_list[$i]->OFFERED_COURSE_ID; ?>">
                                                    </td>
                                                    <td><?php echo $courses_list[$i]->COURSE_CODE ?></td>
                                                    <td><?php echo $courses_list[$i]->COURSE_TITLE ?></td>
                                                    <td><?php echo $courses_list[$i]->CREDIT ?></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Semester <span class="red">*</span></label>

                            <div class="col-md-2">
                                <select class="form-control" name="SEMISTER_ID_C" id="SEMISTER_ID_C">
                                    <option value="">-Select-</option>
                                    <?php foreach ($semester as $row) { ?>
                                        <option
                                            value="<?php echo $row->SEMESTER_ID ?>" <?php echo (!empty($current_academic_info)) ? ($current_academic_info->SEMESTER_ID == $row->SEMESTER_ID) ? 'selected' : '' : ''; ?>><?php echo $row->SEMESTER_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('SEMESTER'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select Semester here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Session <span class="red">*</span></label>

                            <div class="col-md-2">
                                <select class="form-control" name="SESSION_ID_C" id="SESSION_ID_C">
                                    <option value="">-Select-</option>
                                    <?php foreach ($session as $row) { ?>
                                        <option
                                            value="<?php echo $row->SESSION_ID ?>"  <?php echo (!empty($current_academic_info)) ? ($current_academic_info->SEM_SESSION == $row->SESSION_ID) ? 'selected' : '' : ''; ?>><?php echo $row->SESSION_NAME ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please Select session here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h4 style="color: green">Medical and Others info</h4>

                    <div class="div-background">
                        <table class="table table-bordered ">
                            <thead>
                            <tr>
                                <th width="30%">Substance</th>
                                <th width="10%">Currently Used?</th>
                                <th width="10%">Previously Used?</th>
                                <th width="20%">Type/amount/frequency</th>
                                <th width="10%">How long year?</th>
                                <th width="10%">If stopped when?</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($medical as $rm):
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="SUBSTANCE[]"
                                               value="<?php echo $rm->SUBSTANCE ?>"><?php echo $rm->substances ?>
                                        <input type="hidden" name="STU_MEDI_ID[]"
                                               value="<?php echo $rm->STU_MEDI_ID ?>">
                                    </td>
                                    <td>
                                        <select name="CURRENTLY_USED[]">
                                            <option
                                                value="0" <?php echo ($rm->CURRENTLY_USED == 0) ? 'selected' : '' ?>>No
                                            </option>
                                            <option
                                                value="1" <?php echo ($rm->CURRENTLY_USED == 1) ? 'selected' : '' ?>>Yes
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="PREVIOUSLY_USED[]">
                                            <option
                                                value="0"  <?php echo ($rm->CURRENTLY_USED == 0) ? 'selected' : '' ?>>No
                                            </option>
                                            <option
                                                value="1"  <?php echo ($rm->CURRENTLY_USED == 1) ? 'selected' : '' ?>>
                                                Yes
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="TYPE_AMOUNT_FREQUENCY[]"
                                               value="<?php echo $rm->TYPE_AMOUNT_FREQUENCY ?>" class="form-control">
                                    </td>
                                    <td><input type="text" name="DURATION[]" value="<?php echo $rm->DURATION ?>"
                                               class="form-control"></td>
                                    <td><input type="text" name="STOP_DT[]"
                                               value="<?php echo $this->utilities->formatDate('d-m-Y', $rm->STOP_DT); ?>"
                                               class="form-control datepicker"></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                        <table id="disease_list" class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="50%">Disease Name</th>
                                <th width="10%">Start Date</th>
                                <th width="10%">End Date</th>
                                <th width="25%">Treating Doctor</th>
                                <th width="5"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="text" id="disease_name" class="form-control"></td>
                                <td><input type="text" id="disease_start_date" class="form-control datepicker"></td>
                                <td><input type="text" id="disease_end_date" class="form-control datepicker"></td>
                                <td><input type="text" id="doctor" class="form-control"></td>
                                <td>
                                    <span class="btn btn-xs btn-info" id="add_disease"> <i style="cursor:pointer"
                                                                                           class="fa fa-plus"></i></span>
                                </td>
                            </tr>

                            </tbody>
                            <tfoot>
                            <?php foreach ($disease as $dr): ?>
                                <tr id="row_id_<?php echo $dr->STU_DISEASE_ID ?>">
                                    <td><?php echo $dr->DISEASE_NAME ?></td>
                                    <td><?php echo $this->utilities->formatDate('d-m-Y', $dr->START_DT); ?></td>
                                    <td><?php echo $this->utilities->formatDate('d-m-Y', $dr->END_DT); ?></td>
                                    <td><?php echo $dr->DOCTOR_NAME ?></td>
                                    <td>
                                        <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger delete_row_data"
                                           attribute_id="<?php echo $dr->STU_DISEASE_ID ?>" attribute="STU_DISEASE_ID"
                                           table_name="stu_diseaseinfo"></i>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tfoot>
                        </table>
                    </div>
                    <br><br>
                    <h4 style="color:green">Others Information</h4>

                    <div class="div-background">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Waiver</label>

                            <div class="col-md-1  ">
                                <input type="text" name="WEAVER_PERCENTAGE" id="WEAVER_PERCENTAGE" placeholder="e.g. 5%"
                                       value="<?php
                                       if (!empty($waiver->PERCENTAGE)) {
                                           echo $waiver->PERCENTAGE;
                                       }
                                       ?>" class="form-control numbersOnly">
                            </div>
                            <div class="col-md-1  ">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="If has waiver then check the box and fill the waiver percentage in the field"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">waiver Reason</label>

                            <div class="col-md-2">
                                <input type="text" name="WEAVER_REASON" id="WEAVER_REASON" value="<?php
                                if (!empty($waiver->REASON)) {
                                    echo $waiver->REASON;
                                }
                                ?>" placeholder="waiver reason" class="form-control">
                                <input type="hidden" name="STU_WEAVER_ID" value="<?php
                                if (!empty($waiver->STU_WEAVER_ID)) {
                                    echo $waiver->STU_WEAVER_ID;
                                }
                                ?>">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter waiver reson here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Family Income (Annual)</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input id="emergencyCon" name="FMLY_INCOME" value="< 1,00,000 BDT"
                                                   type="radio" <?php echo ($applicant->FMLY_INCOME == '< 1,00,000 BDT') ? 'checked' : ''; ?>>&nbsp;
                                            < 1,00,000 BDT
                                        </div>
                                        <div class="col-md-12">
                                            <input id="emergencyCon" name="FMLY_INCOME"
                                                   value="1,00,000 BDT to 5,00,000 BDT"
                                                   type="radio" <?php echo ($applicant->FMLY_INCOME == '1,00,000 BDT to 5,00,000 BDT') ? 'checked' : ''; ?>>&nbsp;
                                            1,00,000 BDT to 5,00,000 BDT
                                        </div>
                                        <div class="col-md-12">
                                            <input id="emergencyCon" name="FMLY_INCOME"
                                                   value="5,00,000 BDT to 10,00,000 BDT"
                                                   type="radio" <?php echo ($applicant->FMLY_INCOME == '5,00,000 BDT to 10,00,000 BDT') ? 'checked' : ''; ?>>&nbsp;
                                            5,00,000 BDT to 10,00,000 BDT
                                        </div>
                                        <div class="col-md-12">
                                            <input id="emergencyCon" name="FMLY_INCOME"
                                                   value="10,00,000 BDT to 20,00,000 BDT"
                                                   type="radio" <?php echo ($applicant->FMLY_INCOME == '10,00,000 BDT to 20,00,000 BDT') ? 'checked' : ''; ?>>&nbsp;
                                            10,00,000 BDT to 20,00,000 BDT
                                        </div>
                                        <div class="col-md-12">
                                            <input id="emergencyCon" name="FMLY_INCOME" value="> 20,00,000 BDT"
                                                   type="radio" <?php echo ($applicant->FMLY_INCOME == '> 20,00,000 BDT') ? 'checked' : ''; ?>>&nbsp;
                                            > 20,00,000 BDT
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Student's Source of Finance</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input id="source" name="SSOF_FINANC" value="P"
                                                   type="radio" <?php echo ($applicant->SSOF_FINANC == 'P') ? 'checked' : ''; ?>>&nbsp;
                                            Parents
                                        </div>
                                        <div class="col-md-2">
                                            <input id="emergencyCon" name="SSOF_FINANC" value="S"
                                                   type="radio" <?php echo ($applicant->SSOF_FINANC == 'S') ? 'checked' : ''; ?>>&nbsp;
                                            Self
                                        </div>
                                        <div class="col-md-2">
                                            <input id="emergencyCon" name="SSOF_FINANC" value="O"
                                                   type="radio" <?php echo ($applicant->SSOF_FINANC == 'O') ? 'checked' : ''; ?>>&nbsp;
                                            Others
                                        </div>
                                        <div id="finance_guardian" style="display:none">
                                            <div class="col-md-3">
                                                <input id="emergencyCon" name="SSOF_FINANC" value="G"
                                                       type="radio" <?php echo ($applicant->SSOF_FINANC == 'G') ? 'checked' : ''; ?>>&nbsp;
                                                Guardian
                                            </div>
                                        </div>

                                        <div id="finance_spouse" style="display:none">
                                            <div class="col-md-2">
                                                <input id="emergencyCon" name="SSOF_FINANC" value="SP" type="radio"
                                                       id="spouse" <?php echo ($applicant->SSOF_FINANC == 'SP') ? 'checked' : ''; ?>>&nbsp;
                                                Spouse
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Do you have any siblings currently enrolled at KYAU ?</label>
                                    </div>
                                    <div class="col-md-1">
                                        <input id="siblin" name="SIBLING_EXIST" value="1" type="radio" <?php
                                        if (!empty($sibling)) {
                                            echo 'checked';
                                        }
                                        ?>>&nbsp; Yes
                                    </div>
                                    <div class="col-md-1">
                                        <input id="siblin" name="SIBLING_EXIST" value="0" type="radio" <?php
                                        if (empty($sibling)) {
                                            echo 'checked';
                                        }
                                        ?>>&nbsp; No
                                    </div>
                                    <div class="col-md-4 sibId" style="display:<?php
                                    if (!empty($sibling)) {
                                        echo '';
                                    } else {
                                        echo 'none';
                                    }
                                    ?>;">
                                        <input id="sibId" name="SBLN_ROLL_NO" type="text" class="form-control"
                                               value="<?php
                                               if (!empty($sibling)) {
                                                   echo $sibling->SBLN_ROLL_NO;
                                               }
                                               ?>" placeholder="ID Number of your Sibling">
                                        <input name="STU_SBLN_ID" type="hidden" value="<?php
                                        if (!empty($sibling)) {
                                            echo $sibling->STU_SBLN_ID;
                                        }
                                        ?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <br><br>


                    <div class="form-group">
                        <div class="col-sm-3  pull-right">
                            <input type="submit" class="btn btn-primary" value="Update">

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--<script src="<?php //echo base_url();                                                                                                                                                                 ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/keyboard/keyboard.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
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
</script>
<script>
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

    //This function is use for image preview before upload
    function upload_img(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_id').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    //This function  is use for student father image preview before upload
    function upload_father_img(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#f_img_id').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    //This function  is use for student mother image preview before upload
    function upload_mother_img(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#m_img_id').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // for applicant mobile
    $(document).on('click', '#add_mobile', function (e) {
        e.preventDefault();
        $("#mobile_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="MOBILE_NO[]"   class="form-control numbersOnly" placeholder="Mobile" >' +
        '<input type="hidden" value="" name="STU_CI_ID_M[]"  />' +
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
        '<input type="hidden" value="" name="STU_CI_ID[]"  />' +
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
        '  <input type="hidden" name="STU_PGS_ID_F[]"  value="">' +
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
        '<input type="text" name="FATHER_EMAIL[]"   class="form-control " placeholder="Father Email" >' +
        '<input type="hidden" name="STU_PGS_ID_F[]"  value="">' +
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
        '<input type="text" name="MOTHER_PHN[]"   class="form-control numbersOnly" placeholder="Mobile" >' +
        '<input type="hidden" name="STU_PGS_ID_M[]"  value="">' +
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
        '<input type="text" name="MOTHER_EMAIL[]"   class="form-control" placeholder="Mother Email" >' +
        '<input type="hidden" name="STU_PGS_ID_ME[]"  value="">' +
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
        '<input type="text" name="LOCAL_GAR_PHN[]"   class="form-control numbersOnly" placeholder="Mobile" >' +
        '<input type="hidden" name="STU_PGS_ID_EP[]" value="">' +
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
    // append academic info table
    var counter = $('#COUNTER').val();

    $(document).on('click', '#add_academic', function () {
        counter++;
        $("#academic_list tbody").append(' <tr>' +
            '<td>' +
            '   <select class="form-control" name="EXAM_NAME_' + counter + '" class="EXAM_NAME">' +
            '<option value="">-Select-</option>' +
            <?php
            foreach ($exam_name as $row) {
                ?>
            '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
            <?php } ?>
            '</select> ' +
            '</td>' +
            '<td>' +
            '<input style="width: 50px"  type="text" name="PASSING_YEAR_' + counter + '" class=" form-control numbersOnly" id="PASSING_YEAR" placeholder="Year" >' +
            '</td>' +
            ' <td>' +
            '<select class="form-control" name="BOARD_' + counter + '"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($board_name as $row) { ?>
            '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
            <?php } ?>
            '</select> ' +
            ' </td>' +
            '<td>' +
            '<select class="form-control" name="GROUP_' + counter + '"  >' +
            '<option value="">-Select-</option>' +
            <?php foreach ($group_name as $row) { ?>
            '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
            <?php } ?>
            '</select>' +
            '</td>' +
            '<td>' +
            ' <input style="width: 50px" type="text" name="GPA_' + counter + '"  class="form-control numbersOnly" placeholder="CGPA" >' +
            '</td>' +
            '<td>' +
            '<input type="text" name="INSTITUTE_' + counter + '" class="form-control " placeholder="Institute Name" >' +
            '</td>' +
            '<td>' +
            '<input type="hidden" name="COUNTER" value="' + counter + '" ><input type="file" name="CERTIFICATE_' + counter + '"  >' +
            '<input type="hidden" name="AC_PK_' + counter + '" id="AC_PK" value="" >' +
            '</td>' +
            '<td class="text-center">' +
            '<span class="btn btn-xs btn-danger"><i style="cursor:pointer" class="fa fa-times" id="remove_tr"> Remove</i></span>' +
            '</td>' +
            '</tr>'
        );
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
     // get batch by change program
    $(document).on('change', '#PROGRAM_ID', function () {
        var program_id = $(this).val();
        var session_id = $("#SESSION").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('common/batchByProgramId'); ?>',
            data: {program_id: program_id,session_id:session_id},
            success: function (data) {
                $('#BATCH_ID').html(data);
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
        var semester_id = $('#SEMISTER_ID_C').val();
        var program_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('common/getCourseByID'); ?>',
            data: {
                faculty_id: faculty_id,
                department_id: department_id,
                program_id: program_id,
                semester_id: semester_id
            },
            success: function (data) {

                $('#offer_course_list tbody').html(data);
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
            $(".is_required_s").attr("required", "required");
        } else {
            $('#spouse_name').hide();
            $('#finance_spouse').hide();
            $(".is_required_s").removeAttr("required");
        }
    });
    $(document).on('click', '#add_disease', function () {

        var disease_name = $('#disease_name').val();
        var disease_start_date = $('#disease_start_date').val();
        var disease_end_date = $('#disease_end_date').val();
        var doctor = $('#doctor').val();

        if (disease_name == '' || disease_start_date == '' || disease_end_date == '' || doctor == '') {
            alert("Field are required to append");
        } else {
            $("#disease_list tfoot").append(' <tr>' +
            '<td><input type="hidden" name="DISEASE_NAME[]" value="' + disease_name + '" id="" class="form-control">' + disease_name + '</td>' +
            '<td><input type="hidden" name="START_DT[]" value="' + disease_start_date + '" id="" class="form-control datepicker">' + disease_start_date + '</td>' +
            ' <td><input type="hidden" name="END_DT[]" value="' + disease_end_date + '" id="" class="form-control datepicker">' + disease_end_date + '</td>' +
            '  <td><input type="hidden" name="DOCTOR_NAME[]"  value="' + doctor + '" id=""class="form-control">' + doctor + '</td>' +
            '   <td> <span class="btn btn-xs btn-danger remove"> <i style="cursor:pointer" class="fa fa-times"  ></i></span></td>' +
            '</tr>');
        }
    });


</script>
<script>
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
            $(".is_required").attr("required", "required");
        } else {
            $(".is_required").removeAttr("required");
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
            var image_name = $(this).attr('data-image-name');
            if (image_name != "") {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>common/delImage',
                    data: {
                        image_name: image_name
                    },
                    success: function (data) {

                    }
                });
            }
        }
        return false;
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


</script>
