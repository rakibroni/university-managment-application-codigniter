<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/plugins/steps/jquery.steps.css" rel="stylesheet">
<style>
    .wizard > .content > .body {
        position: relative;
        width: 100% !important; 
    }
    
    .wizard > .steps > ul > li {
        width: 20% !important;
    }
    
    .row {
        padding-left: 10px;
    }
    
    .hr-class {
        border-style: solid none none;
        border-color: #C1CEE1;
        margin-bottom: 5px !important;
        margin-top: 9px !important;
    }
    
    #ui-datepicker-div {
        z-index: 2147483647 !important;
    }
    
    .help-icon-issue {
        float: right;
        margin-right: 18px;
        top: -25px;
    }
    
    .unit {
        top: 6px;
    }
    
    .input-group-addon {
        background-color: #EEEEEE !important;
    }
    
    .payment-padding {
        padding-bottom: 7px !important;
    }
    .fileUpload{
        margin-left: 11% !important;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <h2>
                    
                    </h2>

                    <form id="form" class="wizard-big" action="" enctype="multipart/form-data">
                        <h1>Personal Info</h1>
                        <fieldset>
                            <h2>Personal Information</h2>

                            <div class="row">
                                <div class="col-sm-9 col-md-9">
                                    <div class="row" style="padding-left: 10px;">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label>নাম (বাংলা) <span class="text-danger">*</span></label>
                                                <div class="col-xs-11 col-md-11 help-padding">
                                                    <input name="BanglaName" id="BanglaName" type="text" class="form-control login-form required" placeholder="বাংলা নাম লিখুন" value="<?php echo ($PersonalInfo != '') ? $PersonalInfo->FULL_NAME_BN : ''; ?>">
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="বাংলায় আপনার  নাম লিখুন"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label>Blood Group <span class="text-danger">*</span></label>

                                                <div class="col-xs-11 col-md-11 help-padding">
                                                    <select class="select2Dropdown form-control login-form required" name="blood_group" id="blood_group" data-tags="true" data-placeholder="Select Blood Group" data-allow-clear="true">
                                                        <option value="">Select Blood Group</option>
                                                        <?php foreach ($blood_group as $row): ?>
                                                            <option
                                                                value="<?php echo $row->LKP_ID ?>" <?php echo ($PersonalInfo->BLOOD_GROUP == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Enter your blood group"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label>Religion <span class="text-danger">*</span></label>

                                                <div class="col-xs-11 col-md-11 help-padding">
                                                    <select class="select2Dropdown form-control login-form required" name="RELIGION" id="RELIGION" data-tags="true" data-placeholder="Select Religion" data-allow-clear="true">
                                                        <option value="">Select Religion</option>
                                                        <?php foreach ($religion as $row): ?>
                                                            <option
                                                                value="<?php echo $row->LKP_ID ?>" <?php echo ($PersonalInfo->RELIGION_ID == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Select your religion"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-left: 10px;">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label>Marital Status <span class="text-danger">*</span></label>

                                                <div class="col-xs-11 col-md-11 help-padding">
                                                    <select class="select2Dropdown form-control login-form required" name="MARITAL_STATUS" id="MARITAL_STATUS" data-tags="true" data-placeholder="Select Merital Status" data-allow-clear="true">
                                                        <option value="">Select Merital Status</option>
                                                        <?php foreach ($merital_status as $row): ?>
                                                            <option
                                                                value="<?php echo $row->LKP_ID ?>" <?php echo ($PersonalInfo->MARITAL_STATUS == $row->LKP_ID) ? 'selected' : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Select your maritial status"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display:none" id="spouse_name">
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Spouse Name</label>

                                                    <div class="col-xs-11 col-md-11 help-padding">
                                                        <input name="SPOUSE_NAME" style="height: 28px; width: 100%;" id="SPOUSE_NAME" type="text" placeholder="Spouse Name" value="<?php echo ($PersonalInfo != '') ? $PersonalInfo->SPOUSE_NAME : ''; ?>">
                                                    </div>
                                                    <div class="col-xs-1 col-md-1 help-icon">
                                                        <a><i class="fa fa-info-circle pointer2 text-navy"
                                                              data-content="Enter spouse name"
                                                              data-placement="right" data-toggle="popover"
                                                              data-container="body"
                                                              data-original-title="" title="Help"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label>Nationality <span class="text-danger">*</span></label>

                                                <div class="col-xs-11 col-md-11 help-padding">
                                                    <select class="select2Dropdown form-control login-form  required" name="NATIONALITY" id="NATIONALITY" data-tags="true" data-placeholder="Select Nationality" data-allow-clear="true">
                                                        <option value="">Select Merital Status</option>
                                                        <?php foreach ($nationality as $row): ?>
                                                            <option
                                                                value="<?php echo $row->id ?>" <?php echo ($row->id == 15) ? 'selected' : ''; ?>><?php echo $row->nationality ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Select your nationality"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label>Place of Birth <span class="text-danger">*</span></label>

                                                <div class="col-xs-11 col-md-11 help-padding">
                                                    <input type="text" name="PlaceOfBirth" id="PlaceOfBirth" class="form-control login-form required" value="<?php echo ($PersonalInfo != '') ? $PersonalInfo->PLACE_OF_BIRTH : ''; ?>" placeholder="Enter place of birth" />
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Enter the name of place where are you born"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label>National ID </label>

                                                <div class="col-xs-11 col-md-11 help-padding">
                                                    <input type="text" name="NationalId" id="NationalId" class="form-control login-form" value="<?php echo ($PersonalInfo != '') ? $PersonalInfo->NATIONAL_ID : ''; ?>" placeholder="Enter National Id" /><span id="spnNationIdStatus"></span>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Enter your valid natinal indentity number"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="hr-class">
                                    <div class="row" style="padding-left: 10px;">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label>Passport No </label>

                                                <div class="col-xs-11 col-md-11 help-padding">
                                                    <input type="text" name="PassportNo" id="PassportNo" class="form-control login-form" value="<?php echo ($PersonalInfo != '') ? $PersonalInfo->PASSPORT_NO : ''; ?>" placeholder="Enter passport no" />
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Enter passport no"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <label>Issue Date </label>

                                            <div class="col-xs-10 input-group col-md-10 help-padding">
                                                <input type="text" name="issueDate" id="issueDate" class="form-control form-size datePicker" value="<?php echo ($PersonalInfo != '') ? '':date('d/m/Y', strtotime($PersonalInfo->ISSUE_DATE));  ?>" placeholder="dd/mm/yyyy">
                                            </div>
                                            <div class="col-xs-1 col-md-1 help-icon-issue">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Enter passport issue date" data-placement="right"
                                                      data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <label>Expire Date </label>

                                            <div class="col-xs-10 input-group col-md-10 help-padding">
                                                <input type="text" name="expireDate" id="expireDate" class="form-control form-size datePicker " value="<?php echo ($PersonalInfo != '') ? '':date('d/m/Y', strtotime($PersonalInfo->EXPIRE_DATE)); ?>" placeholder="dd/mm/yyyy">
                                            </div>
                                            <div class="col-xs-1 col-md-1 help-icon-issue">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Enter passport expire date"
                                                      data-placement="right" data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="hr-class">
                                    <div class="row" style="padding-left: 10px;">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Weight </label></br>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <label class="col-sm-8 col-md-9" style="padding-right: 0px;">
                                                        <input type="text" name="WEIGHT_KG" id="WEIGHT_KG"
                                                               value="<?php echo ($PersonalInfo != '') ? $PersonalInfo->WEIGHT_KG : ''; ?>"
                                                               class="form-control login-form"
                                                               placeholder="Weight"><span class="errmsg"></span>
                                                    </label>
                                                    <span class="col-sm-4 col-md-3 unit">Kg.</span>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <label class="col-sm-8 col-md-9" style="padding-right: 0px;">
                                                        <input type="text" name="WEIGHT_LBS" id="WEIGHT_LBS"
                                                               value="<?php echo ($PersonalInfo != '') ? $PersonalInfo->WEIGHT_LBS : ''; ?>"
                                                               class="form-control login-form"
                                                               placeholder="Weight"><span class="errmsg"></span>
                                                    </label>
                                                    <span class="col-sm-4 col-md-3 unit">Pound.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Height </label></br>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <label class="col-sm-8 col-md-9" style="padding-right: 0px;">
                                                        <input type="text" name="HEIGHT_FEET" id="HEIGHT_FEET"
                                                               value="<?php echo ($PersonalInfo != '') ? $PersonalInfo->HEIGHT_FEET : ''; ?>"
                                                               class="form-control login-form"
                                                               placeholder="e.g: 5.8"><span id="errmsg"></span>
                                                    </label>
                                                    <span class="col-sm-4 col-md-3 unit">ft.</span>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <label class="col-sm-8 col-md-9" style="padding-right: 0px;">
                                                        <input type="text" name="HEIGHT_CM" id="HEIGHT_CM"
                                                               value="<?php echo ($PersonalInfo != '') ? $PersonalInfo->HEIGHT_CM : ''; ?>"
                                                               class="form-control login-form"
                                                               placeholder="e.g: 176.78"><span id="errmsg"></span>
                                                    </label>
                                                    <span class="col-sm-4 col-md-3 unit">cm.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-sm-12 col-md-12 col-lg-12 stuImg">
                                        <?php if ($PersonalInfo->STUD_PHOTO != ''): ?>
                                        <img style="width:120px; border:1px solid #f9f9f9; margin-top: 24px;margin-bottom: 20px;margin-left: 5%;" id="stdPhoto" class="" src="<?php echo base_url() . 'upload/applicant_photo/' . $PersonalInfo->STUD_PHOTO; ?>" alt="" />
                                        <?php else: ?>
                                        <img style="width:120px; border:1px solid #f9f9f9; margin-top: 24px;margin-bottom: 20px;margin-left: 5%;" id="stdPhoto" class="" src="<?php echo base_url(); ?>assets/img/default.png" alt="" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="fileUpload btn btn-primary btn-xs">
                                        <span>Upload Photo <span class="text-danger">*</span></span>
                                        <?php if ($PersonalInfo->STUD_PHOTO != ''): ?>
                                            <input id="STD_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="STD_PHOTO" value="" onchange="StudentImg(this);" class="upload col-sm-12 " />
                                        <?php else: ?>
                                            <input id="STD_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="STD_PHOTO" value="" onchange="StudentImg(this);" class="upload col-sm-12 required" />
                                        <?php endif; ?>
                                        <span id="STD_PHOTOS"></span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 appSignature">
                                        <?php if ($PersonalInfo->SIGNATURE_PHOTO != ''): ?>
                                        <img style="width:120px; border:1px solid #f9f9f9; margin-top: 24px;margin-bottom: 20px;margin-left: 5%;" id="signaturePhoto" class="" src="<?php echo base_url() . 'upload/applicant_photo/' . $PersonalInfo->SIGNATURE_PHOTO; ?>" alt="" />
                                        <?php else: ?>
                                        <img style="width:120px; border:1px solid #f9f9f9; margin-top: 24px;margin-bottom: 20px;margin-left: 5%;" id="signaturePhoto" class="" src="<?php echo base_url(); ?>assets/img/default_photo.png" alt="" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="fileUpload btn btn-primary btn-xs">
                                        <span>Upload Signature <span class="text-danger">*</span></span>
                                        <?php if ($PersonalInfo->SIGNATURE_PHOTO != ''): ?>
                                            <input id="SIG_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="SIG_PHOTO" value="" onchange="signatureImg(this);" class="upload col-sm-12 " />
                                        <?php else: ?>
                                            <input id="SIG_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="SIG_PHOTO" value="" onchange="signatureImg(this);" class="upload col-sm-12 required" />
                                        <?php endif; ?>
                                        <span id="SIG_PHOTOS"></span>
                                    </div>

                                </div>
                            </div>
                        </fieldset>
                        <h1>Family Info </h1>
                        <fieldset>
                            <h2>Family Information</h2>

                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Father's Name <span class="text-danger">*</span></label>
                                            <div class="col-xs-11 col-sm-11 col-md-11 help-padding">
                                                <input type="text" name="FATHER_NAME" class="form-control login-form required" id="FATHER_NAME" value="<?php echo ($fatherInfo != '') ? $fatherInfo->GURDIAN_NAME : ''; ?>" placeholder="Enter father's name" />
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Enter the name of place where are you born"
                                                      data-placement="right" data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div><label>Occupation<span class="text-danger">*</span></label></div>
                                            <div class="F_Occupation">
                                                <div class="col-xs-11 col-sm-11 col-md-11 help-padding">
                                                    <select class="select2Dropdown form-control login-form F_occ required" name="F_Occupation" id="F_Occupation" data-tags="true" data-placeholder="Select Occupation" data-allow-clear="true">
                                                        <option value="">Select Occupation</option>
                                                        <?php foreach ($occupation as $row): ?>

                                                            <option
                                                                value="<?php echo $row->LKP_ID ?>" <?php echo ($fatherInfo != '') ? (($fatherInfo->OCCUPATION == $row->LKP_ID) ? 'selected' : '') : ''; ?>><?php echo $row->LKP_NAME ?></option>

                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-1 col-sm-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Enter the name of place where are you born"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile No <span class="text-danger">*</span></label>

                                            <?php if ($fatherMobiles == "edit"): ?>
                                            <div class="row">
                                                <?php foreach ($fatherMobileInfo as $row): ?>
                                                <div class="col-xs-10 col-sm-10 col-md-8 ">
                                                    <input type="text" name="FATHER_PHN[]" id="F_Mobile" class="F_Mobile form-control login-form numberYear col-md-8 required" value="<?php echo $row->CONTACTS; ?>" placeholder="Enter Mobile No" maxlength="11" />
                                                    <span id="errmsg"></span>
                                                </div>
                                                <?php endforeach; ?>
                                                <div class="col-xs-1 col-sm-1 col-md-1">
                                                    <span class="btn btn-xs btn-info" id="add_mobile_f"><i
                                                                style="cursor:pointer" class="fa fa-plus"></i></span>
                                                </div>
                                                <div class="col-xs-1 col-sm-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                              data-content="Enter the name of place where are you born"
                                                              data-placement="right" data-toggle="popover"
                                                              data-container="body"
                                                              data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <div class="row">
                                                <div class="col-xs-10 col-sm-10 col-md-8 ">
                                                    <input type="text" name="FATHER_PHN[]" id="F_Mobile" class="F_Mobile form-control login-form required numberYear col-md-8" value="<?php echo ($fatherInfo != '') ? $fatherInfo->MOBILE_NO : ''; ?>" placeholder="Enter Mobile No" maxlength="11" />
                                                    <span id="errmsg"></span>
                                                </div>
                                                <div class="col-xs-1 col-sm-1 col-md-1">
                                                    <span class="btn btn-xs btn-info" id="add_mobile_f"><i
                                                                style="cursor:pointer" class="fa fa-plus"></i></span>
                                                </div>
                                                <div class="col-xs-1 col-sm-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                              data-content="Enter the name of place where are you born"
                                                              data-placement="right" data-toggle="popover"
                                                              data-container="body"
                                                              data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <div class="row">
                                                <div class="col-xs-11 form-group col-sm-11 col-md-9">
                                                    <table id="mobile_list_f" class="col-xs-12 col-sm-12 col-md-12">
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <?php if ($fatherEmails == "edit"): ?>
                                            <div class="row">
                                                <label>Email </label><br>
                                                <?php foreach ($fatherEmailInfo as $row): ?>
                                                <div class="col-xs-10 col-md-10 help-padding">
                                                    <input type="text" name="FATHER_EMAIL[]" id="F_Email" class="F_Email form-control login-form" value="<?php echo $row->CONTACTS ?>" placeholder="Enter Email Address" />
                                                </div>
                                                <?php endforeach; ?>
                                                <div class="col-xs-1 col-md-1">
                                                    <span class="btn btn-xs btn-info" id="add_email_f"><i
                                                                style="cursor:pointer" class="fa fa-plus"></i></span>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                              data-content="Enter the name of place where are you born"
                                                              data-placement="right" data-toggle="popover"
                                                              data-container="body"
                                                              data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <div class="row">
                                                <label>Email </label><br>

                                                <div class="col-xs-10 col-md-10 help-padding">
                                                    <input type="text" name="FATHER_EMAIL[]" id="F_Email" class="F_Email form-control login-form" value="<?php echo ($fatherInfo != '') ? $fatherInfo->EMAIL_ADRESS : ''; ?>" placeholder="Enter Email Address" />
                                                </div>
                                                <div class="col-xs-1 col-md-1">
                                                    <span class="btn btn-xs btn-info" id="add_email_f"><i
                                                                style="cursor:pointer" class="fa fa-plus"></i></span>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                              data-content="Enter the name of place where are you born"
                                                              data-placement="right" data-toggle="popover"
                                                              data-container="body"
                                                              data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <div class="row">
                                                <div class="col-xs-11 form-group col-md-11 ">
                                                    <table id="email_list_f" class="col-xs-12 col-md-12">
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-xs-12 col-md-12">
                                            <?php if ($fatherInfo != ''): ?>
                                            <img style="width:120px; border:1px solid #f9f9f9; margin-bottom: 20px;" id="fatherPhoto" class="" src="<?php echo base_url() . 'upload/applicant_photo/parents_photo/' . $fatherInfo->PARENT_PHOTO; ?>" alt="" />
                                            <?php else: ?>
                                            <img style="width:120px; border:1px solid #f9f9f9; margin-bottom: 20px;" id="fatherPhoto" class="" src="<?php echo base_url(); ?>assets/img/default.png" alt="" />
                                            <?php endif; ?>

                                        </div>
                                        <div class="fileUpload f-m-photo btn btn-primary btn-xs f-">
                                            <span>Upload Father's Photo<span class="text-danger">*</span></span>
                                            <?php if ($fatherInfo != ''): ?>
                                                <input id="father_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="father_PHOTO" onchange="FatherImg(this);" class="upload col-sm-12" />
                                            <?php else: ?>
                                                <input id="father_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="father_PHOTO" onchange="FatherImg(this);" class="upload col-sm-12 required" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Mother's Name <span class="text-danger">*</span></label>

                                            <div class="col-xs-11 col-md-11 help-padding">

                                                <input type="text" name="MOTHER_NAME" class="form-control login-form required" id="MOTHER_NAME" value="<?php echo ($motherInfo != '') ? $motherInfo->GURDIAN_NAME : ''; ?>" placeholder="Enter mother's name" />

                                            </div>
                                            <div class="col-xs-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Enter the name of place where are you born"
                                                      data-placement="right" data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div><label>Occupation <span class="text-danger">*</span></label></div>
                                            <div class="M_Occupation">
                                                <div class="col-xs-11 col-md-11 help-padding">

                                                    <select class="select2Dropdown form-control login-form F_occ required" name="M_Occupation" id="M_Occupation" data-tags="true" data-placeholder="Select Occupation" data-allow-clear="true">
                                                        <option value="">Select Occupation</option>
                                                        <?php foreach ($occupation as $row): ?>
                                                            <option
                                                                value="<?php echo $row->LKP_ID ?>"<?php echo ($motherInfo != '') ? (($motherInfo->OCCUPATION == $row->LKP_ID) ? 'selected' : '') : '' ?>><?php echo $row->LKP_NAME ?></option>

                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Enter the name of place where are you born"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">


                                            <label>Mobile No </label>
                                            <?php if ($motherMobiles == "edit"): ?>
                                            <div class="row">
                                                <?php foreach ($motherMobileInfo as $row): ?>
                                                <div class="col-xs-10 col-md-8 help-padding">
                                                    <input type="text" name="MOTHER_PHN[]" id="M_Mobile" class="M_Mobile form-control login-form numericOnly col-md-8" value="<?php echo $row->CONTACTS; ?>" placeholder="Enter Mobile No" maxlength="11" />
                                                    <span id="errmsg"></span>
                                                </div>
                                                <?php endforeach; ?>
                                                <div class="col-xs-1 col-md-1">
                                                    <span class="btn btn-xs btn-info" id="add_mobile_m"><i
                                                                style="cursor:pointer" class="fa fa-plus"></i></span>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                              data-content="Enter the name of place where are you born"
                                                              data-placement="right" data-toggle="popover"
                                                              data-container="body"
                                                              data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <div class="row">
                                                <div class="col-xs-10 col-md-8 help-padding">
                                                    <input type="text" name="MOTHER_PHN[]" id="M_Mobile" class="M_Mobile form-control login-form numericOnly col-md-8" value="<?php echo ($motherInfo != '') ? $motherInfo->MOBILE_NO : ''; ?>" placeholder="Enter Mobile No" maxlength="11" />
                                                    <span id="errmsg"></span>
                                                </div>
                                                <div class="col-xs-1 col-md-1">
                                                    <span class="btn btn-xs btn-info" id="add_mobile_m"><i
                                                                style="cursor:pointer" class="fa fa-plus"></i></span>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                              data-content="Enter the name of place where are you born"
                                                              data-placement="right" data-toggle="popover"
                                                              data-container="body"
                                                              data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <div class="row">
                                                <div class="col-xs-12 form-group col-md-10">
                                                    <table id="mobile_list_m" class="col-xs-12 col-md-12">
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <?php if ($motherEmails == "edit"): ?>
                                            <div class="row">
                                                <label>Email </label><br>
                                                <?php foreach ($motherEmailInfo as $row): ?>
                                                <div class="col-xs-10 col-md-10 help-padding">
                                                    <input type="text" name="MOTHER_EMAIL[]" id="M_Email" class="M_Email form-control login-form" value="<?php echo $row->CONTACTS; ?>" placeholder="Enter Email Address" />

                                                </div>
                                                <?php endforeach; ?>
                                                <div class="col-xs-1 col-md-1">
                                                    <span class="btn btn-xs btn-info" id="add_email_m"><i
                                                                style="cursor:pointer" class="fa fa-plus"></i></span>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                              data-content="Enter the name of place where are you born"
                                                              data-placement="right" data-toggle="popover"
                                                              data-container="body"
                                                              data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <div class="row">
                                                <label>Email </label><br>

                                                <div class="col-xs-10 col-md-10 help-padding">
                                                    <input type="text" name="MOTHER_EMAIL[]" id="M_Email" class="M_Email form-control login-form" value="<?php echo ($motherInfo != '') ? $motherInfo->EMAIL_ADRESS : ''; ?>" placeholder="Enter Email Address" />

                                                </div>
                                                <div class="col-xs-1 col-md-1">
                                                    <span class="btn btn-xs btn-info" id="add_email_m"><i
                                                                style="cursor:pointer" class="fa fa-plus"></i></span>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                              data-content="Enter the name of place where are you born"
                                                              data-placement="right" data-toggle="popover"
                                                              data-container="body"
                                                              data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <div class="row">
                                                <div class="form-group col-xs-12 col-md-12 ">
                                                    <table id="email_list_m" class="col-xs-12 col-md-12">
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-sm-12 col-md-12 col-xs-12">

                                            <?php if ($motherInfo != ''): ?>
                                            <img style="width:120px; border:1px solid #f9f9f9; margin-bottom: 20px;" id="motherPhoto" class="" src="<?php echo base_url() . 'upload/applicant_photo/parents_photo/' . $motherInfo->PARENT_PHOTO; ?>" alt="" />
                                            <?php else: ?>
                                            <img style="width:120px; border:1px solid #f9f9f9; margin-bottom: 20px;" id="motherPhoto" class="" src="<?php echo base_url(); ?>assets/img/default.png" alt="" />
                                            <?php endif; ?>

                                        </div>
                                        <div class="fileUpload f-m-photo btn btn-primary btn-xs f-">
                                            <span>Upload Mother's Photo<span class="text-danger">*</span></span>
                                            <?php if ($motherInfo != ''): ?>
                                                <input id="mother_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="mother_PHOTO" onchange="MotherImg(this);" class="upload col-sm-12" />
                                            <?php else: ?>
                                                <input id="mother_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="mother_PHOTO" onchange="MotherImg(this);" class="upload col-sm-12 required" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-class">
                            <h2><u>Others Information </u></h2>

                            <div class="row" style="margin-left:0;  padding-bottom: 30px;">
                                <div class="col-sm-3 col-md-3"><label> Family Income (Annual) <span class="text-danger">*</span></label></div>
                                <div class="col-sm-9 col-md-9" style="padding-bottom:-25px !important; margin-bottom:-25px !important;">
                                    <div class="form-group">
                                        <div class="col-md-1">
                                            <input class="emergencyCon" name="FMLY_INCOME" value="< 1,00,000 BDT" type="radio" <?php echo  ($PersonalInfo->FMLY_INCOME != '') ? (($PersonalInfo->FMLY_INCOME == '< 1,00,000 BDT') ? 'checked' : '') : 'checked'; ?>>
                                        </div>
                                        <div class="col-md-11">
                                            < 1,00,000 BDT </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-1">
                                                <input class="emergencyCon" name="FMLY_INCOME" value="1,00,000 BDT to 5,00,000 BDT" type="radio" <?php echo  ($PersonalInfo != '') ? (($PersonalInfo->FMLY_INCOME == '1,00,000 BDT to 5,00,000 BDT') ? 'checked' : '') : ''; ?>>
                                            </div>
                                            <div class="col-md-11"> 1,00,000 BDT to 5,00,000 BDT</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-1">
                                                <input class="emergencyCon" name="FMLY_INCOME" value="5,00,000 BDT to 10,00,000 BDT" type="radio" <?php echo  ($PersonalInfo != '') ? (($PersonalInfo->FMLY_INCOME == '5,00,000 BDT to 10,00,000 BDT') ? 'checked' : '') : ''; ?>>
                                            </div>
                                            <div class="col-md-11"> 5,00,000 BDT to 10,00,000 BDT</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-1">
                                                <input class="emergencyCon" name="FMLY_INCOME" value="10,00,000 BDT to 20,00,000 BDT" type="radio" <?php echo  ($PersonalInfo != '') ? (($PersonalInfo->FMLY_INCOME == '10,00,000 BDT to 20,00,000 BDT') ? 'checked' : '') : ''; ?>>
                                            </div>
                                            <div class="col-md-11"> 10,00,000 BDT to 20,00,000 BDT</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-1">
                                                <input class="emergencyCon" name="FMLY_INCOME" value="> 20,00,000 BDT" type="radio" <?php echo  ($PersonalInfo != '') ? (($PersonalInfo->FMLY_INCOME == '> 20,00,000 BDT') ? 'checked' : '') : ''; ?>>
                                            </div>
                                            <div class="col-md-11"> > 20,00,000 BDT</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-left:0;  padding-bottom: 5px;">
                                    <div class="col-sm-3 col-md-3"><label> Student's Source of Finance <span class="text-danger">*</span></label></div>
                                    <div class="col-sm-9 col-md-9" style="padding-bottom:-25px !important; margin-bottom:-25px !important;">
                                        <div class="col-xs-4 col-sm-2 col-md-2">
                                            <label>
                                            <input class="emergencyCon" name="SSOF_FINANC" value="P" type="radio" <?php echo  ($PersonalInfo->SSOF_FINANC != '') ? (($PersonalInfo->SSOF_FINANC == 'P') ? 'checked' : '') : 'checked'; ?>>
                                            <span class="yesNo">Parents</span>
                                        </label>
                                        </div>
                                        <div class="col-xs-4 col-sm-2 col-md-2">
                                            <label>
                                            <input class="emergencyCon" name="SSOF_FINANC" value="S" type="radio" <?php echo  ($PersonalInfo != '') ? (($PersonalInfo->SSOF_FINANC == 'S') ? 'checked' : '') : ''; ?>>
                                            <span class="yesNo">Self</span>
                                        </label>
                                        </div>
                                        <div class="col-xs-4 col-sm-2 col-md-2">
                                            <label>
                                            <input class="emergencyCon" name="SSOF_FINANC" value="O" type="radio" <?php echo  ($PersonalInfo != '') ? (($PersonalInfo->SSOF_FINANC == 'O') ? 'checked' : '') : ''; ?>>
                                            <span class="yesNo">Others</span>
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-left:0;  padding-bottom: 5px;">
                                    <div class="col-sm-5 col-md-5"><label> Do you have any siblings currently enrolled at KYAU ?<span class="text-danger">*</span></label></div>
                                    <div class="col-sm-6 col-md-6" style="padding-bottom:-25px !important; margin-bottom:-25px !important;">
                                        <div class="col-xs-4 col-sm-2 col-md-2">
                                            <label>
                                            <input id="siblin" name="SIBLING_EXIST" value="1" type="radio" <?php echo  ($PersonalInfo != '') ? (($PersonalInfo->SIBLING_EXIST == 1) ? 'checked' : '') : ''; ?>>
                                            <span class="yesNo">Yes</span>
                                        </label>
                                        </div>
                                        <div class="col-xs-4 col-sm-2 col-md-2">
                                            <label>
                                            <input id="siblin" name="SIBLING_EXIST" value="0" type="radio" <?php echo  ($PersonalInfo != '') ? (($PersonalInfo->SIBLING_EXIST == 0) ? 'checked' : '') : 'checked'; ?>>
                                            <span class="yesNo">No</span>
                                        </label>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 sibId" <?php echo  ($PersonalInfo != '') ? (($PersonalInfo->SIBLING_EXIST == 1) ? 'style="display:block !important;"' : '') : ''; ?> style="display:none;">
                                            <input id="sibId" name="SBLN_ROLL_NO" type="text" class="form-control" value="<?php echo  ($PersonalInfo != '')? ((!empty($siblingsInfo))? $siblingsInfo->SBLN_ROLL_NO :''):''; ?>" placeholder="ID Number of your Sibling">
                                        </div>
                                    </div>
                                </div>
                        </fieldset>
                        <h1>Mailing Address</h1>
                        <fieldset>

                            <h3><u>Present Address</u> <span class="text-danger">*</span></h3>

                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="DIVISION">Division <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="DIVISION" id="DIVISION" data-tags="true" data-placeholder="Select Division" data-allow-clear="true">
                                                <option value="">Select Division</option>
                                                <?php foreach ($division as $row): ?>

                                                    <option
                                                        value="<?php echo $row->DIVISION_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->DIVISION_ID == $row->DIVISION_ID) ? 'selected' : '') : '' ?>><?php echo $row->DIVISION_ENAME ?></option>

                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select division name e.g DHAKA"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="UPZILLA">District<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="DISTRICT" id="DISTRICT" data-tags="true" data-placeholder="Select District" data-allow-clear="true">

                                                <?php
                                                if ($ac_type == "edit"): // if the form action is EDIT
                                                    foreach ($district as $row):
                                                        if ($row->DIVISION_ID == $presentAddress->DIVISION_ID):
                                                            ?>
                                                            <option
                                                                value="<?php echo $row->DISTRICT_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->DISTRICT_ID == $row->DISTRICT_ID) ? 'selected' : '') : '' ?>><?php echo $row->DISTRICT_ENAME ?></option>
                                                        <?php
                                                        endif;
                                                    endforeach;
                                                else: // if the form action is VIEW
                                                    ?>
                                                    <option value="">Select District</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select District name e.g DHAKA"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="UPZILLA">Upazila/Thana<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="UPZILLA" id="UPZILLA" data-tags="true" data-placeholder="Select Upazila/Thana" data-allow-clear="true">

                                                <?php
                                                if ($ac_type == "edit"): // if the form action is EDIT
                                                    foreach ($thana as $row):
                                                        if ($row->DISTRICT_ID == $presentAddress->DISTRICT_ID):
                                                            ?>
                                                            <option
                                                                value="<?php echo $row->THANA_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->THANA_ID == $row->THANA_ID) ? 'selected' : '') : '' ?>><?php echo $row->THANA_ENAME ?></option>
                                                        <?php
                                                        endif;
                                                    endforeach;
                                                else: // if the form action is VIEW
                                                    ?>
                                                    <option value="">Select Upazila/Thana</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select Upazilla/Thana name e.g PALTAN"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="POLISH_STATION">Police Station <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="POLISH_STATION" id="POLISH_STATION" data-tags="true" data-placeholder="Select Police Station" data-allow-clear="true">

                                                <?php
                                                if ($ac_type == "edit"): // if the form action is EDIT
                                                    foreach ($policeStation as $row):
                                                        if ($row->THANA_ID == $presentAddress->THANA_ID):
                                                            ?>
                                                            <option
                                                                value="<?php echo $row->POLICE_STATION_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->POLICE_STATION_ID == $row->POLICE_STATION_ID) ? 'selected' : '') : '' ?>><?php echo $row->PS_ENAME ?></option>
                                                        <?php
                                                        endif;
                                                    endforeach;
                                                else: // if the form action is VIEW
                                                    ?>
                                                    <option value="">Select Police Station</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select Polish Station name e.g PALTAN"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="POST_OFFICE">Post office <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="POST_OFFICE" id="POST_OFFICE" data-tags="true" data-placeholder="Select Post office" data-allow-clear="true">

                                                <?php
                                                if ($ac_type == "edit"): // if the form action is EDIT
                                                    foreach ($postOffice as $row):
                                                        if ($row->THANA_ID == $presentAddress->THANA_ID):
                                                            ?>
                                                            <option
                                                                value="<?php echo $row->POST_OFFICE_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->POST_OFFICE_ID == $row->POST_OFFICE_ID) ? 'selected' : '') : '' ?>><?php echo $row->POST_OFFICE_ENAME . "[" . $row->POST_CODE . "]" ?></option>
                                                        <?php
                                                        endif;
                                                    endforeach;
                                                else: // if the form action is VIEW
                                                    ?>
                                                    <option value="">Select Post office</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select Post office name e.g DHAKA GPO[1001]"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="UNION">Union/Ward No. <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="UNION" id="UNION" data-tags="true" data-placeholder="Select Union/Ward No" data-allow-clear="true">

                                                <?php
                                                if ($ac_type == "edit"): // if the form action is EDIT
                                                    foreach ($union as $row):
                                                        if ($row->THANA_ID == $presentAddress->THANA_ID):
                                                            ?>
                                                            <option
                                                                value="<?php echo $row->UNION_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->UNION_ID == $row->UNION_ID) ? 'selected' : '') : '' ?>><?php echo $row->UNION_NAME ?></option>
                                                        <?php
                                                        endif;
                                                    endforeach;
                                                else: // if the form action is VIEW
                                                    ?>
                                                    <option value="">Select Union/Ward No</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select Union/Ward no e.g WORD NO 36"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>

                                            <label class="control-label " for="VILLAGE">Vill/House no/Road no<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <input type="text" name="VILLAGE" class="form-control login-form required" id="VILLAGE" value="<?php echo ($a_type == "edit") ? (($presentAddress != '') ? $presentAddress->VILLAGE_WARD : '') : ''; ?>" placeholder="Vill/House no/Road no" />

                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Enter vill/house no/Road no e.g house no #05"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-class">
                            <h3><u>Permanent Address </u> <span class="text-danger">*</span></h3>

                            <div class="row" style="margin-left:0;  padding-bottom: 5px;">
                                <div class="col-sm-3 col-md-3">
                                    <p>Same as present address?</p>
                                </div>
                                <div class="col-xs-4 col-sm-1 col-md-1" style="padding-bottom:-25px !important; margin-bottom:-25px !important;">
                                    <label>
                                        <input type="radio" class="SAS_PSORPR" name="SAS_PSORPR" value="1"
                                               id="PARM_ADDRESS_YES" checked><span class="yesNo">Yes</span>
                                    </label>
                                </div>
                                <div class="col-xs-4 col-sm-1 col-md-1" style="padding-bottom:-25px !important; margin-bottom:-25px !important;">
                                    <label>

                                        <input type="radio" class="SAS_PSORPR" name="SAS_PSORPR" value="0"
                                               id="PARM_ADDRESS_NO" <?php echo ($notSame == 1) ? 'checked' : ''; ?>><span
                                            class="yesNo">No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row" <?php echo ($a_type=="edit" ) ? (($notSame==1 ) ? 'style="display:block !important;"' : '') : '' ?>
                                style="display:none; background-color:#FCF8E3; padding: 7px 7px 10px;" id="permanent_address">

                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="DIVISION">Division <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="P_DIVISION" id="P_DIVISION" data-tags="true" data-placeholder="Select Division" data-allow-clear="true">
                                                <option value="">Select Division</option>
                                                <?php foreach ($division as $row): ?>
                                                    <option
                                                        value="<?php echo $row->DIVISION_ID ?>" <?php echo ($notSame == 1) ? (($permanentAddress->DIVISION_ID == $row->DIVISION_ID) ? 'selected' : '') : '' ?>><?php echo $row->DIVISION_ENAME ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select division name e.g DHAKA"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="UPZILLA">District<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="P_DISTRICT" id="P_DISTRICT" data-tags="true" data-placeholder="Select District" data-allow-clear="true">

                                                <?php
                                                if ($notSame == 1):
                                                    if ($ac_type == "edit"): // if the form action is EDIT
                                                        foreach ($district as $row):
                                                            if ($row->DIVISION_ID == $permanentAddress->DIVISION_ID):
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row->DISTRICT_ID ?>" <?php echo ($permanentAddress->DISTRICT_ID == $row->DISTRICT_ID) ? 'selected' : '' ?>><?php echo $row->DISTRICT_ENAME ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    else: // if the form action is VIEW
                                                        ?>
                                                        <option value="">Select District</option>
                                                    <?php endif;
                                                else: // if the form action is VIEW
                                                    ?>
                                                    <option value="">Select District</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select District name e.g DHAKA"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="UPZILLA">Upazila/Thana<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="P_UPZILLA" id="P_UPZILLA" data-tags="true" data-placeholder="Select Upazila/Thana" data-allow-clear="true">

                                                <?php
                                                if ($notSame == 1):
                                                    if ($ac_type == "edit"): // if the form action is EDIT
                                                        foreach ($thana as $row):
                                                            if ($row->DISTRICT_ID == $permanentAddress->DISTRICT_ID):
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row->THANA_ID ?>" <?php echo ($permanentAddress->THANA_ID == $row->THANA_ID) ? 'selected' : '' ?>><?php echo $row->THANA_ENAME ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    else: // if the form action is VIEW
                                                        ?>
                                                        <option value="">Select Upazila/Thana</option>
                                                    <?php endif;
                                                else: // if the form action is VIEW
                                                    ?>
                                                    <option value="">Select Upazila/Thana</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select Upzila/Thana name e.g PALTAN"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="POLISH_STATION">Police Station <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="P_POLISH_STATION" id="P_POLISH_STATION" data-tags="true" data-placeholder="Select Police Station" data-allow-clear="true">

                                                <?php
                                                if ($notSame == 1):
                                                    if ($ac_type == "edit"): // if the form action is EDIT
                                                        foreach ($policeStation as $row):
                                                            if ($row->THANA_ID == $permanentAddress->THANA_ID):
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row->POLICE_STATION_ID ?>" <?php echo ($permanentAddress->POLICE_STATION_ID == $row->POLICE_STATION_ID) ? 'selected' : '' ?>><?php echo $row->PS_ENAME ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    else: // if the form action is VIEW
                                                        ?>
                                                        <option value="">Select Police Station</option>
                                                    <?php endif;
                                                else: // if the form action is VIEW
                                                    ?>
                                                    <option value="">Select Police Station</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select Polise Station e.g PALTAN"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="POST_OFFICE">Post office <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="P_POST_OFFICE" id="P_POST_OFFICE" data-tags="true" data-placeholder="Select Post office" data-allow-clear="true">

                                                <?php
                                                if ($notSame == 1):
                                                    if ($ac_type == "edit"): // if the form action is EDIT
                                                        foreach ($postOffice as $row):
                                                            if ($row->THANA_ID == $permanentAddress->THANA_ID):
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row->POST_OFFICE_ID ?>" <?php echo ($permanentAddress->POST_OFFICE_ID == $row->POST_OFFICE_ID) ? 'selected' : '' ?>><?php echo $row->POST_OFFICE_ENAME . "[" . $row->POST_CODE . "]" ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    else: // if the form action is VIEW
                                                        ?>
                                                        <option value="">Select Post office</option>
                                                    <?php endif;
                                                else: // if the form action is VIEW
                                                    ?>
                                                    <option value="">Select Post office</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select Post Office e.g DHAKA GPO [1000]"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="control-label " for="UNION">Union/Ward No. <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <select class="select2Dropdown form-control login-form required" name="P_UNION" id="P_UNION" data-tags="true" data-placeholder="Select Union/Ward No" data-allow-clear="true">

                                                <?php
                                                if ($notSame == 1):
                                                    if ($ac_type == "edit"): // if the form action is EDIT
                                                        foreach ($union as $row):
                                                            if ($row->THANA_ID == $permanentAddress->THANA_ID):
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row->UNION_ID ?>" <?php echo ($permanentAddress->UNION_ID == $row->UNION_ID) ? 'selected' : '' ?>><?php echo $row->UNION_NAME ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    else: // if the form action is VIEW
                                                        ?>
                                                        <option value="">Select Union/Ward No</option>
                                                    <?php endif;
                                                else: // if the form action is VIEW
                                                    ?>
                                                    <option value="">Select Union/Ward No</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Select Union/Ward No. e.g WORD NO# 05"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div>

                                            <label class="control-label " for="P_VILLAGE">Vill/House no/Road no<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 help-padding">
                                            <input type="text" name="P_VILLAGE" class="form-control login-form required" id="P_VILLAGE" value="<?php echo ($a_type == " edit ") ? (($notSame == 1) ? $permanentAddress->VILLAGE_WARD : '') : ''; ?>" placeholder="Vill/House no/Road no" />

                                        </div>
                                        <div class="col-xs-1 col-md-1 help-icon">
                                            <a><i class="fa fa-info-circle pointer2 text-navy"
                                                  data-content="Enter Vill/House no/Road no e.g House no# 05"
                                                  data-placement="right" data-toggle="popover" data-container="body"
                                                  data-original-title="" title="Help"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr class="hr-class">
                            <div class="row" style="margin-left:0; padding-top: 10px;">
                                <div class="col-sm-3 col-md-3">
                                    <p> Local Emergency Guardian<span class="text-danger">*</span></p>
                                </div>

                                <?php if ($g_type == "edit"): ?>
                                <div class="col-xs-4 col-sm-1 col-md-1">
                                    <label>
                                            <input type="radio" class="local_emergency_guardian"
                                                   name="local_emergency_guardian"
                                                   value="F" <?php echo ($gurdianInfo->GARDIAN_TYPE == 'F') ? 'checked' : ''; ?>><span
                                                class="yesNo">Father</span>
                                        </label>
                                </div>
                                <div class="col-xs-4 col-sm-1 col-md-1">
                                    <label>
                                            <input type="radio" class="local_emergency_guardian"
                                                   name="local_emergency_guardian"
                                                   value="M" <?php echo ($gurdianInfo->GARDIAN_TYPE == 'M') ? 'checked' : ''; ?>><span
                                                class="yesNo">Mother</span>
                                        </label>
                                </div>
                                <div class="col-xs-4 col-sm-1 col-md-1">
                                    <label>
                                            <input type="radio" class="local_emergency_guardian"
                                                   name="local_emergency_guardian"
                                                   value="O" <?php echo ($gurdianInfo->GARDIAN_TYPE == 'O') ? 'checked' : ''; ?>><span
                                                class="yesNo">Others</span>
                                        </label>
                                </div>
                                <?php else: ?>
                                <div class="col-xs-4 col-sm-1 col-md-1">
                                    <label>
                                            <input type="radio" class="local_emergency_guardian"
                                                   name="local_emergency_guardian" value="F" checked><span
                                                class="yesNo">Father</span>
                                        </label>
                                </div>
                                <div class="col-xs-4 col-sm-1 col-md-1">
                                    <label>
                                            <input type="radio" class="local_emergency_guardian"
                                                   name="local_emergency_guardian" value="M"><span
                                                class="yesNo">Mother</span>
                                        </label>
                                </div>
                                <div class="col-xs-4 col-sm-1 col-md-1">
                                    <label>
                                            <input type="radio" class="local_emergency_guardian"
                                                   name="local_emergency_guardian" value="O"><span
                                                class="yesNo">Others</span>
                                        </label>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div id="local_guardian" <?php echo ($g_type=="edit" ) ? (($gurdianInfo->GARDIAN_TYPE == 'O') ? 'style="display:block !important; background-color:#FCF8E3;padding: 7px;"' : '') : ''; ?> style="display:none; background-color:#FCF8E3; padding: 7px;">

                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Local Guardian Name<span
                                                    class="text-danger">*</span></label>

                                            <div class="col-md-6">
                                                <div class="col-xs-11 col-md-11 help-padding">

                                                    <input type="text" name="LOCAL_GAR_NAME" id="LOCAL_GAR_NAME" value="<?php echo ($g_type == "edit") ? (($gurdianInfo->GARDIAN_TYPE == 'O') ? $gurdianInfo->GURDIAN_NAME : '') : ''; ?>" class="form-control login-form required" placeholder="Local Guardian Name">

                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Select division name e.g DHAKA"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Local Guardian Relation<span
                                                    class="text-danger">*</span></label>

                                            <div class="col-md-6">
                                                <div class="col-xs-11 col-md-11 help-padding">
                                                    <select class="select2Dropdown form-control login-form required" name="LOCAL_GAR_RELATION" id="LOCAL_GAR_RELATION" data-tags="true" data-placeholder="Select Relation" data-allow-clear="true">
                                                        <option value="">Select Relation</option>
                                                        <?php foreach ($relation as $row): ?>

                                                            <option
                                                                value="<?php echo $row->LKP_ID ?>" <?php echo ($g_type == "edit") ? (($gurdianInfo->GARDIAN_RELATION == $row->LKP_ID) ? 'selected' : '') : ''; ?>><?php echo $row->LKP_NAME ?></option>

                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Select division name e.g DHAKA"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-md-6" style="padding-top: 10px;">
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Local Guardian Mobile</label>

                                            <div class="col-md-6">
                                                <div class="col-xs-10 col-md-10 help-padding">
                                                    <input type="text" name="LOCAL_GAR_PHN[]" id="LOCAL_GAR_PHN" value="" class="LOCAL_GAR_PHN form-control login-form number required" placeholder="Mobile">
                                                </div>
                                                <div class="col-xs-1 col-md-1">
                                                    <span class="btn btn-xs btn-info" id="add_mobile_lg"><i
                                                            style="cursor:pointer" class="fa fa-plus"></i></span>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Local gardian mobile number"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-6 control-label"></label>

                                            <div class="col-md-6">
                                                <table id="mobile_list_lg">
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6" style="padding-top: 10px;">
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Local Guardian Email</label>

                                            <div class="col-md-6">
                                                <div class="col-xs-10 col-md-10 help-padding">
                                                    <input type="text" name="LOCAL_GAR_EMAIL[]" id="LOCAL_GAR_EMAIL" value="" class="LOCAL_GAR_EMAIL form-control login-form required" placeholder="Email address">
                                                </div>
                                                <div class="col-xs-1 col-md-1">
                                                    <span class="btn btn-xs btn-info" id="add_email_lg"><i
                                                            style="cursor:pointer" class="fa fa-plus"></i></span>
                                                </div>
                                                <div class="col-xs-1 col-md-1 help-icon">
                                                    <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Local gardian email id"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-6 control-label"></label>

                                            <div class="col-md-6">
                                                <table id="email_list_lg">
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"><label><u>Local Guardian Address :</u></label></div>
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label " for="LG_DIVISION">Division <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-xs-11 col-md-11 help-padding">
                                                <select class="select2Dropdown form-control login-form required" name="LG_DIVISION" id="LG_DIVISION" data-tags="true" data-placeholder="Select Division" data-allow-clear="true">
                                                    <option value="">Select Division</option>
                                                    <?php foreach ($division as $row): ?>

                                                        <option
                                                            value="<?php echo $row->DIVISION_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->DIVISION_ID == $row->DIVISION_ID) ? 'selected' : '') : '' ?>><?php echo $row->DIVISION_ENAME ?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Select division name e.g DHAKA"
                                                      data-placement="right" data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label " for="LG_DISTRICT">District<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-xs-11 col-md-11 help-padding">
                                                <select class="select2Dropdown form-control login-form required" name="LG_DISTRICT" id="LG_DISTRICT" data-tags="true" data-placeholder="Select District" data-allow-clear="true">

                                                    <?php
                                                    if ($ac_type == "edit"): // if the form action is EDIT
                                                        foreach ($district as $row):
                                                            if ($row->DIVISION_ID == $presentAddress->DIVISION_ID):
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row->DISTRICT_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->DISTRICT_ID == $row->DISTRICT_ID) ? 'selected' : '') : '' ?>><?php echo $row->DISTRICT_ENAME ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    else: // if the form action is VIEW
                                                        ?>
                                                        <option value="">Select District</option>
                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                            <div class="col-xs-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Select District name e.g DHAKA"
                                                      data-placement="right" data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label " for="LG_UPZILLA">Upazila/Thana<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-xs-11 col-md-11 help-padding">
                                                <select class="select2Dropdown form-control login-form required" name="LG_UPZILLA" id="LG_UPZILLA" data-tags="true" data-placeholder="Select Upazila/Thana" data-allow-clear="true">

                                                    <?php
                                                    if ($ac_type == "edit"): // if the form action is EDIT
                                                        foreach ($thana as $row):
                                                            if ($row->DISTRICT_ID == $presentAddress->DISTRICT_ID):
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row->THANA_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->THANA_ID == $row->THANA_ID) ? 'selected' : '') : '' ?>><?php echo $row->THANA_ENAME ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    else: // if the form action is VIEW
                                                        ?>
                                                        <option value="">Select Upazila/Thana</option>
                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                            <div class="col-xs-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Select Upazilla/Thana name e.g PALTAN"
                                                      data-placement="right" data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label " for="LG_POLISH_STATION">Police Station <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-xs-11 col-md-11 help-padding">
                                                <select class="select2Dropdown form-control login-form required" name="LG_POLISH_STATION" id="LG_POLISH_STATION" data-tags="true" data-placeholder="Select Police Station" data-allow-clear="true">

                                                    <?php
                                                    if ($ac_type == "edit"): // if the form action is EDIT
                                                        foreach ($policeStation as $row):
                                                            if ($row->THANA_ID == $presentAddress->THANA_ID):
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row->POLICE_STATION_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->POLICE_STATION_ID == $row->POLICE_STATION_ID) ? 'selected' : '') : '' ?>><?php echo $row->PS_ENAME ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    else: // if the form action is VIEW
                                                        ?>
                                                        <option value="">Select Police Station</option>
                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                            <div class="col-xs-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Select Polish Station name e.g PALTAN"
                                                      data-placement="right" data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label " for="LG_POST_OFFICE">Post office <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-xs-11 col-md-11 help-padding">
                                                <select class="select2Dropdown form-control login-form required" name="LG_POST_OFFICE" id="LG_POST_OFFICE" data-tags="true" data-placeholder="Select Post office" data-allow-clear="true">

                                                    <?php
                                                    if ($ac_type == "edit"): // if the form action is EDIT
                                                        foreach ($postOffice as $row):
                                                            if ($row->THANA_ID == $presentAddress->THANA_ID):
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row->POST_OFFICE_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->POST_OFFICE_ID == $row->POST_OFFICE_ID) ? 'selected' : '') : '' ?>><?php echo $row->POST_OFFICE_ENAME . "[" . $row->POST_CODE . "]" ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    else: // if the form action is VIEW
                                                        ?>
                                                        <option value="">Select Post office</option>
                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                            <div class="col-xs-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Select Post office name e.g DHAKA GPO[1001]"
                                                      data-placement="right" data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <div>
                                                <label class="control-label " for="LG_UNION">Union/Ward No. <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-xs-11 col-md-11 help-padding">
                                                <select class="select2Dropdown form-control login-form required" name="LG_UNION" id="LG_UNION" data-tags="true" data-placeholder="Select Union/Ward No" data-allow-clear="true">

                                                    <?php
                                                    if ($ac_type == "edit"): // if the form action is EDIT
                                                        foreach ($union as $row):
                                                            if ($row->THANA_ID == $presentAddress->THANA_ID):
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row->UNION_ID ?>" <?php echo ($a_type == "edit") ? (($presentAddress->UNION_ID == $row->UNION_ID) ? 'selected' : '') : '' ?>><?php echo $row->UNION_NAME ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    else: // if the form action is VIEW
                                                        ?>
                                                        <option value="">Select Union/Ward No</option>
                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                            <div class="col-xs-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Select Union/Ward no e.g WORD NO 36"
                                                      data-placement="right" data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <div>

                                                <label class="control-label " for="LG_VILLAGE">Vill/House no/Road no<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-xs-11 col-md-11 help-padding">
                                                <input type="text" name="LG_VILLAGE" class="form-control login-form required" id="LG_VILLAGE" value="<?php echo ($a_type == "edit") ? (($presentAddress != '') ? $presentAddress->VILLAGE_WARD : '') : ''; ?>" placeholder="Vill/House no/Road no" />

                                            </div>
                                            <div class="col-xs-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                      data-content="Enter vill/house no/Road no e.g house no #05"
                                                      data-placement="right" data-toggle="popover" data-container="body"
                                                      data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <h1>Academic Information</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12" id="facademic_info">
                                    <legend>Academic Information</legend>
                                    <input type="hidden" value="<?php echo $deg->DEGREE_ID; ?>" name="degreeId" id="degreeId">
                                    <input type="hidden" value="<?php echo $applicant_info['APPLICANT_ID']; ?>" name="APPLICANT_ID" id="applicantId">

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="academic_list" class="table table-bordered dataTable">
                                                <thead>
                                                    <tr>
                                                        <th width="12%">Exam Type</th>
                                                        <th width="15%">Institute</th>
                                                        <th width="10%">Passing Year</th>
                                                        <th width="10%">Board/University</th>
                                                        <th width="12%">Group</th>
                                                        <th width="10%">CGPA</th>
                                                        <th width="5%">Certificate Photo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <select class="form-control login-form required" name="EXAM_TYPE_SSC" id="EXAM_TYPE_SSC" class="EXAM_NAME">
                                                                <option value="">-Select-</option>
                                                                <?php foreach ($exam_name as $row) { ?>
                                                                    <option
                                                                        value="<?php echo $row->LKP_ID ?>"<?php echo ($ssc_type == "edit") ? (($sscInfo->EXAM_DEGREE_ID == $row->LKP_ID) ? 'selected' : '') : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Select Exam Type e.g S.S.C"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <input type="text" name="INSTITUTE_SSC" value="<?php echo ($ssc_type == "edit") ? $sscInfo->INSTITUTION : ''; ?>" id="INSTITUTE_SSC" class="form-control login-form required" placeholder="Institute Name">
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Enter your institute name e.g Uttoray high school"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-10 help-padding">
                                                                <input type="text" name="PASSING_YEAR_SSC" value="<?php echo ($ssc_type == "edit") ? $sscInfo->PASSING_YEAR : ''; ?>" id="PASSING_YEAR_SSC" maxlength="4" class=" form-control login-form numberYear required" placeholder="Year">
                                                            </div>
                                                            <div class="col-md-1 help-icon">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Enter passing year e.g 2010"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <select class="form-control login-form required" name="BOARD_SSC" id="BOARD_SSC">
                                                                <option value="">-Select-</option>
                                                                <?php foreach ($board_name as $row) { ?>
                                                                    <option
                                                                        value="<?php echo $row->LKP_ID ?>" <?php echo ($ssc_type == "edit") ? (($sscInfo->BOARD == $row->LKP_ID) ? 'selected' : '') : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Select Board name e.g DHAKA"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <select class="form-control login-form required" name="GROUP_SSC" id="GROUP_SSC">
                                                                <option value="">-Select-</option>
                                                                <?php foreach ($group_name as $row) { ?>
                                                                    <option
                                                                        value="<?php echo $row->LKP_ID ?>" <?php echo ($ssc_type == "edit") ? (($sscInfo->MAJOR_GROUP_ID == $row->LKP_ID) ? 'selected' : '') : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Select group name e.g Science"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-9 help-padding">
                                                                <div class="input-group">
                                                                    <select class="form-control login-form" name="" id="ssc_grade_type">
                                                                        <option value="grade">Grade</option>
                                                                        <option value="division">Division</option>
                                                                    </select>
                                                                    <span id="ssc_grade"><input type="text" name="GPA_SSC"  value="<?php echo ($ssc_type == "edit") ? $sscInfo->RESULT_GRADE : ''; ?>" id="GPA_SSC" class="form-control login-form number required" maxlength="4" placeholder="GPA"></span>
                                                                    <span id="ssc_division" style="display:none"><input type="text" name="GPA_SSC" value="<?php echo ($ssc_type == "edit") ? $sscInfo->RESULT_GRADE : ''; ?>" id="GPA_SSC" class="form-control login-form required" placeholder="Division"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1 help-icon">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Select grade or division type"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>  
                                                            <div class="col-sm-12 col-md-12">
                                                                <?php if($ssc_type == "edit"): ?>
                                                                    <?php if ($sscInfo->ACHIEVEMENT != ''): ?>
                                                                        <img style="width:100%; border:1px solid #f9f9f9; margin-top: 0px;margin-bottom: 1px;" id="sscPhoto" src="<?php echo base_url() . 'upload/applicant_photo/' . $sscInfo->ACHIEVEMENT; ?>"  alt="" />
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <img style="width:100%; border:1px solid #f9f9f9; margin-top: 0px;margin-bottom: 1px;" id="sscPhoto" class=""  alt="" />
                                                                <?php endif; ?>
                                                            </div> 
                                                            <div class="fileUpload btn btn-primary btn-xs">
                                                                <span>Upload<span class="text-danger">*</span></span>
                                                                <input id="ssc_certificate" type="file" accept="jpg,jpeg,png,gif" name="SSC_CERTIFICATE" value="" onchange="SSCImg(this);" class="upload col-sm-12 required" />
                                                                <span id="ssc_certificate"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <select class="form-control login-form required" name="EXAM_TYPE_HSC" id="EXAM_TYPE_HSC" class="EXAM_NAME">
                                                                <option value="">-Select-</option>
                                                                <?php foreach ($exam_name as $row) { ?>
                                                                    <option
                                                                        value="<?php echo $row->LKP_ID ?>" <?php echo ($hsc_type == "edit") ? (($sscInfo->EXAM_DEGREE_ID == $row->LKP_ID) ? 'selected' : '') : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Select Exam Type e.g H.S.C"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <input type="text" name="INSTITUTE_HSC" value="<?php echo ($hsc_type == "edit") ? $sscInfo->INSTITUTION : ''; ?>" id="INSTITUTE_HSC" class="form-control login-form required" placeholder="Institute Name">
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Enter your institute name e.g Uttaray College school"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-10 help-padding">
                                                                <input type="text" name="PASSING_YEAR_HSC" value="<?php echo ($hsc_type == "edit") ? $sscInfo->PASSING_YEAR : ''; ?>" id="PASSING_YEAR_HSC" maxlength="4" class="required form-control login-form numberYear"  placeholder="Year">
                                                            </div>
                                                            <div class="col-md-1 help-icon">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Enter passing year e.g 2012"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <select class="form-control login-form required" name="BOARD_HSC" id="BOARD_HSC">
                                                                <option value="">-Select-</option>
                                                                <?php foreach ($board_name as $row) { ?>
                                                                    <option
                                                                        value="<?php echo $row->LKP_ID ?>" <?php echo ($hsc_type == "edit") ? (($sscInfo->BOARD == $row->LKP_ID) ? 'selected' : '') : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Select Board name e.g DHAKA"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <select class="form-control login-form required" name="GROUP_HSC" id="GROUP_HSC">
                                                                <option value="">-Select-</option>
                                                                <?php foreach ($group_name as $row) { ?>
                                                                    <option
                                                                        value="<?php echo $row->LKP_ID ?>" <?php echo ($hsc_type == "edit") ? (($sscInfo->MAJOR_GROUP_ID == $row->LKP_ID) ? 'selected' : '') : '' ?>><?php echo $row->LKP_NAME ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Select group name e.g Science"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-9 help-padding">
                                                                <select class="form-control login-form required" name="" id="hsc_gd_type">
                                                                    <option value="grade">Grade</option>
                                                                    <option value="division">Division</option>
                                                                </select>
                                                                <span id="hsc_grade"><input type="text" name="GPA_HSC" value="<?php echo ($ssc_type == "edit") ? $sscInfo->RESULT_GRADE : ''; ?>" id="GPA_HSC" class="form-control login-form number" maxlength="4" placeholder="GPA"></span>
                                                                <span id="hsc_division" style="display:none"><input type="text" name="GPA_HSC" value="<?php echo ($ssc_type == "edit") ? $sscInfo->RESULT_GRADE : ''; ?>" id="GPA_HSC" class="form-control login-form" placeholder="Division"></span>                                                                
                                                            </div>
                                                            <div class="col-md-1 help-ico-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                  data-content="Select grade or division type"
                                                                  data-placement="right" data-toggle="popover"
                                                                  data-container="body"
                                                                  data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12 col-md-12">
                                                                <?php if($hsc_type == "edit"): ?>
                                                                    <?php if ($hscInfo->ACHIEVEMENT != ''): ?>
                                                                        <img style="width:100%; border:1px solid #f9f9f9; margin-top: 0px;margin-bottom: 1px;" id="hscPhoto" src="<?php echo base_url() . 'upload/applicant_photo/' . $hscInfo->ACHIEVEMENT; ?>"  alt="" />
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <img style="width:100%; border:1px solid #f9f9f9; margin-top: 0px;margin-bottom: 1px;" id="hscPhoto" class=""  alt="" />
                                                                <?php endif; ?>                                                                
                                                            </div> 
                                                            <div class="fileUpload btn btn-primary btn-xs">
                                                                <span>Upload<span class="text-danger">*</span></span>
                                                                <input id="hsc_certificate" type="file" accept="jpg,jpeg,png,gif" name="HSC_CERTIFICATE" value="" onchange="HSCImg(this);" class="upload col-sm-12 required" />
                                                                <span id="hsc_certificate"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php if ($deg->DEGREE_ID == 61): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <select class="form-control login-form" name="EXAM_NAME_HONS" id="EXAM_NAME_HONS" class="EXAM_NAME">
                                                                    <option value="">-Select-</option>
                                                                    <?php foreach ($exam_name as $row) { ?>
                                                                        <option
                                                                            value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                      data-content="Select Exam Type e.g B.Sc(Hons)"
                                                                      data-placement="right" data-toggle="popover"
                                                                      data-container="body"
                                                                      data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-10 help-padding">
                                                                <input type="text" name="PASSING_YEAR_HONS" id="PASSING_YEAR_HONS" maxlength="4" class=" form-control login-form numberYear" placeholder="Year">
                                                            </div>
                                                            <div class="col-md-1 help-icon">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                      data-content="Enter passing year e.g 2014"
                                                                      data-placement="right" data-toggle="popover"
                                                                      data-container="body"
                                                                      data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <input type="text" name="UniversityName" id="UniversityName" class="form-control login-form " placeholder="University name">
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                      data-content="Select Board name e.g DHAKA"
                                                                      data-placement="right" data-toggle="popover"
                                                                      data-container="body"
                                                                      data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-11 help-padding">
                                                                <input type="text" name="DeptName" id="DeptName" class="form-control login-form" placeholder="Department Name">
                                                            </div>
                                                            <div class="col-md-1 help-icon-2">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                      data-content="Select Department e.g English"
                                                                      data-placement="right" data-toggle="popover"
                                                                      data-container="body"
                                                                      data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-9 help-padding">
                                                                <input type="text" name="GPA_HONS" id="GPA_HONS" class="form-control login-form number" maxlength="4" placeholder="CGPA">
                                                            </div>
                                                            <div class="col-md-1 help-icon">
                                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                                      data-content="Enter your GPA e.g 3.75"
                                                                      data-placement="right" data-toggle="popover"
                                                                      data-container="body"
                                                                      data-original-title="" title="Help"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <h1>Payment</h1>
                        <fieldset>
                            <div class="row">
                                <?php if ($policy->POLICY_NAME == 'ADMISSION PAYMENT BY BANK'): ?>
                                <div class="col-sm-8 col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4  control-label"> Payment Mode <span
                                                    class="text-danger">*</span></label>

                                        <div class="col-md-6 payment-padding">
                                            <div class="col-xs-11 col-sm-11 col-md-11 help-padding">
                                                <select class="select2Dropdown form-control login-form required" name="paymentMode" id="paymentMode" data-tags="true" data-placeholder="Select Payment Type" data-allow-clear="true">
                                                        <option value="">Select Payment Mode</option>
                                                        <?php foreach ($paymentMode as $row): ?>
                                                            <option
                                                                value="<?php echo $row->PAYMENT_ID ?>"><?php echo $row->PAYMENT_TYPE; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Select Payment Mode"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4  control-label">Bank Name <span class="text-danger">*</span></label>
                                        <div class="col-md-6 payment-padding">
                                            <div class="col-xs-11 col-sm-11 col-md-11 help-padding">
                                                <select class="select2Dropdown form-control login-form required" name="branchName" id="branchName" data-tags="true" data-placeholder="Select Bank Name" data-allow-clear="true">
                                                        <option value="">Select Bank Name</option>
                                                        <?php foreach ($bank as $row): ?>
                                                            <option
                                                                value="<?php echo $row->BANK_BRANCH_ID ?>"><?php echo $row->BANK_NAME . " (" . $row->BANK_BRANCH_NAME . ")"; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Select Bank Name"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4  control-label">Bank Reciept No/Scroll No <span
                                                    class="text-danger">*</span></label>

                                        <div class="col-md-6 payment-padding">
                                            <div class="col-xs-11 col-sm-11 col-md-11 help-padding">
                                                <input type="text" name="receiptNo" class="form-control login-form required" id="receiptNo" value="" placeholder="eg. 2543621432452 " />
                                                <span id="checkReceipt"></span>
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1 help-icon">
                                                <a><i class="fa fa-info-circle pointer2 text-navy"
                                                          data-content="Enter Bank Reciept No/ Scroll No"
                                                          data-placement="right" data-toggle="popover"
                                                          data-container="body"
                                                          data-original-title="" title="Help"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Upload Reciept Copy<span
                                                    class="text-danger">*</span></label>

                                        <div class="col-md-8 payment-padding">
                                            <div class="col-xs-12 col-md-12">
                                                <img style="width:270px;  height: 115px; border:1px solid #f9f9f9; margin-bottom: 20px;" id="recieptImage" class="" src="<?php echo base_url(); ?>assets/img/default_photo.png" alt="" />

                                            </div>
                                            <div class="fileUpload f-m-photo btn btn-primary btn-xs f-">
                                                <span>Upload <span class="text-danger">*</span></span>
                                                <input id="Reciept_copy" type="file" accept="jpg,jpeg,png,gif" name="Reciept_copy" onchange="RecieptImg(this);" class="upload col-sm-12 required" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php elseif ($policy->POLICY_NAME == 'ADMISSION PAYMENT BY CASH'): ?>

                                <?php elseif ($policy->POLICY_NAME == 'ADMISSION PAYMENT BY ONLINE'): ?>

                                <?php endif; ?>
                            </div>
                        </fieldset>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/staps/jquery.steps.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/validate/jquery.validate.min.js"></script>

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
    $(document).ready(function () {
        //$("#wizard").steps();
        $("#form").steps({
            bodyTag: "fieldset",
            startIndex: <?php echo ($stepFlag == 1)? $currentIndex + 1 : $currentIndex; ?>,
            onStepChanging: function (event, currentIndex, newIndex) {
                // Always allow going backward even if the current step contains invalid fields!
                if (currentIndex > newIndex) {
                    return true;
                }

                // Forbid suppressing "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age").val()) < 18) {
                    return false;
                }

                var form = $(this);

                // Clean up if user went backward before
                if (currentIndex < newIndex) {
                    // To remove error styles
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }

                // Disable validation on fields that are disabled or hidden.
                form.validate().settings.ignore = ":disabled,:hidden";

                // Start validation; Prevent going forward if false
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                // Suppress (skip) "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                    $(this).steps("next");
                }

                // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3) {
                    $(this).steps("previous");
                }
                if (priorIndex == 0) {
                    var APPLICANT_ID = $("#applicantId").val();
                    var BanglaName = $("#BanglaName").val();
                    var blood_group = $("#blood_group").val();
                    var RELIGION = $("#RELIGION").val();
                    var MARITAL_STATUS = $("#MARITAL_STATUS").val();
                    var SPOUSE_NAME = $("#SPOUSE_NAME").val();
                    var NATIONALITY = $("#NATIONALITY").val();
                    var PlaceOfBirth = $("#PlaceOfBirth").val();
                    var NationalId = $("#NationalId").val();
                    var PassportNo = $("#PassportNo").val();
                    var issueDate = $("#issueDate").val();
                    var expireDate = $("#expireDate").val();
                    var WEIGHT_KG = $("#WEIGHT_KG").val();
                    var WEIGHT_LBS = $("#WEIGHT_LBS").val();
                    var HEIGHT_FEET = $("#HEIGHT_FEET").val();
                    var HEIGHT_CM = $("#HEIGHT_CM").val();
                    var STD_PHOTO = $("#STD_PHOTO").text();
                    var APP_SIG = $("#SIG_PHOTO").text();
                    data1 = {
                        APPLICANT_ID: APPLICANT_ID,
                        BanglaName: BanglaName,
                        blood_group: blood_group,
                        RELIGION: RELIGION,
                        MARITAL_STATUS: MARITAL_STATUS,
                        NATIONALITY: NATIONALITY,
                        NationalId: NationalId,
                        PlaceOfBirth: PlaceOfBirth,
                        PassportNo: PassportNo,
                        issueDate: issueDate,
                        expireDate: expireDate,
                        WEIGHT_KG: WEIGHT_KG,
                        WEIGHT_LBS: WEIGHT_LBS,
                        HEIGHT_FEET: HEIGHT_FEET,
                        HEIGHT_CM: HEIGHT_CM,
                        STD_PHOTO: STD_PHOTO,
                        APP_SIG: APP_SIG,
                        priorIndex: priorIndex
                    };
                    data2 = {
                        APPLICANT_ID: APPLICANT_ID,
                        BanglaName: BanglaName,
                        blood_group: blood_group,
                        RELIGION: RELIGION,
                        MARITAL_STATUS: MARITAL_STATUS,
                        SPOUSE_NAME: SPOUSE_NAME,
                        NATIONALITY: NATIONALITY,
                        NationalId: NationalId,
                        PlaceOfBirth: PlaceOfBirth,
                        PassportNo: PassportNo,
                        issueDate: issueDate,
                        expireDate: expireDate,
                        WEIGHT_KG: WEIGHT_KG,
                        WEIGHT_LBS: WEIGHT_LBS,
                        HEIGHT_FEET: HEIGHT_FEET,
                        HEIGHT_CM: HEIGHT_CM,
                        STD_PHOTO: STD_PHOTO,
                        APP_SIG: APP_SIG,
                        priorIndex: priorIndex
                    };
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url(); ?>/portal/applicantPersonalInfo",
                        data: (MARITAL_STATUS == 12 ? data2 : data1), /*12 is equal to Married*/
                        beforeSend: function () {
                            $("#load").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            $("#load").html(data);
                        }
                    });
                } else if (priorIndex == 1) {
                    var APPLICANT_ID = $("#applicantId").val();
                    var FATHER_NAME = $("#FATHER_NAME").val();
                    var F_Occupation = $("#F_Occupation").val();
                    var father_PHOTO = $("#father_PHOTO").text();
                    var MOTHER_NAME = $("#MOTHER_NAME").val();
                    var M_Occupation = $("#M_Occupation").val();
                    var mother_PHOTO = $("#mother_PHOTO").text();
                    var SIBLING_ID = '';
                    /*others information*/
                    var FMLY_INCOME = $('input[name="FMLY_INCOME"]:checked').val();
                    var SSOF_FINANC = $('input[name="SSOF_FINANC"]:checked').val();
                    var SIBLING_EXIST = $('input[name="SIBLING_EXIST"]:checked').val();
                    if(SIBLING_EXIST == 1){
                        SIBLING_ID = $("#sibId").val();
                    }

                    var F_Mobile = new Array();
                    $("input.F_Mobile:text").each(function () {
                        F_Mobile.push($(this).val());
                    });
                    var F_Email = new Array();
                    $("input.F_Email:text").each(function () {
                        F_Email.push($(this).val());
                    });
                    var M_Mobile = new Array();
                    $("input.M_Mobile:text").each(function () {
                        M_Mobile.push($(this).val());
                    });
                    var M_Email = new Array();
                    $("input.M_Email:text").each(function () {
                        M_Email.push($(this).val());
                    });

                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url(); ?>/portal/applicantFamilyInfo",
                        data: {
                            APPLICANT_ID: APPLICANT_ID,
                            FATHER_NAME: FATHER_NAME,
                            F_Occupation: F_Occupation,
                            F_Mobile: F_Mobile,
                            F_Email: F_Email,
                            father_PHOTO: father_PHOTO,
                            MOTHER_NAME: MOTHER_NAME,
                            M_Occupation: M_Occupation,
                            M_Mobile: M_Mobile,
                            M_Email: M_Email,
                            mother_PHOTO: mother_PHOTO,
                            priorIndex: priorIndex,
                            FMLY_INCOME: FMLY_INCOME,
                            SSOF_FINANC: SSOF_FINANC,
                            SIBLING_EXIST: SIBLING_EXIST,
                            SIBLING_ID: SIBLING_ID,
                        },
                        beforeSend: function () {
                            $("#load").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            $("#load").html(data);
                        }
                    });
                } else if (priorIndex == 2) {

                    var APPLICANT_ID = $("#applicantId").val();
                    var DIVISION = $("#DIVISION").val();
                    var DISTRICT = $("#DISTRICT").val();
                    var UPZILLA = $("#UPZILLA").val();
                    var POLISH_STATION = $("#POLISH_STATION").val();
                    var POST_OFFICE = $("#POST_OFFICE").val();
                    var UNION = $("#UNION").val();
                    var VILLAGE = $("#VILLAGE").val();
                    var SAS_PSORPR = $('input[name="SAS_PSORPR"]:checked').val();
                    var P_DIVISION = $("#P_DIVISION").val();
                    var P_DISTRICT = $("#P_DISTRICT").val();
                    var P_UPZILLA = $("#P_UPZILLA").val();
                    var P_POLISH_STATION = $("#P_POLISH_STATION").val();
                    var P_POST_OFFICE = $("#P_POST_OFFICE").val();
                    var P_UNION = $("#P_UNION").val();
                    var P_VILLAGE = $("#P_VILLAGE").val();
                    var local_emergency_guardian = $('input[name="local_emergency_guardian"]:checked').val();
                    var LOCAL_GAR_NAME = $("#LOCAL_GAR_NAME").val();
                    var LOCAL_GAR_RELATION = $("#LOCAL_GAR_RELATION").val();
                    var LG_DIVISION = $("#LG_DIVISION").val();
                    var LG_DISTRICT = $("#LG_DISTRICT").val();
                    var LG_UPZILLA = $("#LG_UPZILLA").val();
                    var LG_POLISH_STATION = $("#LG_POLISH_STATION").val();
                    var LG_POST_OFFICE = $("#LG_POST_OFFICE").val();
                    var LG_UNION = $("#LG_UNION").val();
                    var LG_VILLAGE = $("#LG_VILLAGE").val();

                    var LOCAL_GAR_PHN = new Array();
                    $("input.LOCAL_GAR_PHN:text").each(function () {
                        LOCAL_GAR_PHN.push($(this).val());
                    })
                    var LOCAL_GAR_EMAIL = new Array();
                    $("input.LOCAL_GAR_EMAIL:text").each(function () {
                        LOCAL_GAR_EMAIL.push($(this).val());
                    })

                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url(); ?>/portal/applicantMailingInfo",

                        data: {
                            APPLICANT_ID: APPLICANT_ID,
                            DIVISION: DIVISION,
                            DISTRICT: DISTRICT,
                            UPZILLA: UPZILLA,
                            POLISH_STATION: POLISH_STATION,
                            POST_OFFICE: POST_OFFICE,
                            UNION: UNION,
                            VILLAGE: VILLAGE,
                            SAS_PSORPR: SAS_PSORPR,
                            P_DIVISION: P_DIVISION,
                            P_DISTRICT: P_DISTRICT,
                            P_UPZILLA: P_UPZILLA,
                            P_POLISH_STATION: P_POLISH_STATION,
                            P_POST_OFFICE: P_POST_OFFICE,
                            P_UNION: P_UNION,
                            P_VILLAGE: P_VILLAGE,
                            local_emergency_guardian: local_emergency_guardian,
                            LOCAL_GAR_NAME: LOCAL_GAR_NAME,
                            LOCAL_GAR_RELATION: LOCAL_GAR_RELATION,
                            LG_DIVISION: LG_DIVISION,
                            LG_DISTRICT: LG_DISTRICT,
                            LG_UPZILLA: LG_UPZILLA,
                            LG_POLISH_STATION: LG_POLISH_STATION,
                            LG_POST_OFFICE: LG_POST_OFFICE,
                            LG_UNION: LG_UNION,
                            LG_VILLAGE: LG_VILLAGE,
                            LOCAL_GAR_PHN: LOCAL_GAR_PHN,
                            LOCAL_GAR_EMAIL: LOCAL_GAR_EMAIL,
                            priorIndex: priorIndex
                        },

                        beforeSend: function () {
                            $("#load").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            $("#load").html(data);
                        }
                    });
                } else if (priorIndex == 3) {
                    var APPLICANT_ID = $("#applicantId").val();
                    var EXAM_TYPE_SSC = $("#EXAM_TYPE_SSC").val();
                    var INSTITUTE_SSC = $("#INSTITUTE_SSC").val();
                    var PASSING_YEAR_SSC = $("#PASSING_YEAR_SSC").val();
                    var BOARD_SSC = $("#BOARD_SSC").val();
                    var GROUP_SSC = $("#GROUP_SSC").val();
                    var GPA_SSC = $("#GPA_SSC").val();
                    var ssc_certificate = $("#ssc_certificate").val();
                    var EXAM_TYPE_HSC = $("#EXAM_TYPE_HSC").val();
                    var INSTITUTE_HSC = $("#INSTITUTE_HSC").val();
                    var PASSING_YEAR_HSC = $("#PASSING_YEAR_HSC").val();
                    var BOARD_HSC = $("#BOARD_HSC").val();
                    var GROUP_HSC = $("#GROUP_HSC").val();
                    var GPA_HSC = $("#GPA_HSC").val();
                    var hsc_certificate = $("#hsc_certificate").val();
                    var EXAM_NAME_HONS = $("#EXAM_NAME_HONS").val();
                    var PASSING_YEAR_HONS = $("#PASSING_YEAR_HONS").val();
                    var UniversityName = $("#UniversityName").val();
                    var DeptName = $("#DeptName").val();
                    var GPA_HONS = $("#GPA_HONS").val();
                    var degreeId = $("#degreeId").val();

                    data1 = {
                        APPLICANT_ID: APPLICANT_ID,
                        EXAM_TYPE_SSC: EXAM_TYPE_SSC,
                        INSTITUTE_SSC: INSTITUTE_SSC,
                        PASSING_YEAR_SSC: PASSING_YEAR_SSC,
                        BOARD_SSC: BOARD_SSC,
                        GROUP_SSC: GROUP_SSC,
                        GPA_SSC: GPA_SSC,
                        ssc_certificate: ssc_certificate,
                        EXAM_TYPE_HSC: EXAM_TYPE_HSC,
                        INSTITUTE_HSC: INSTITUTE_HSC,
                        PASSING_YEAR_HSC: PASSING_YEAR_HSC,
                        BOARD_HSC: BOARD_HSC,
                        GROUP_HSC: GROUP_HSC,
                        GPA_HSC: GPA_HSC,
                        hsc_certificate: hsc_certificate,
                        EXAM_NAME_HONS: EXAM_NAME_HONS,
                        PASSING_YEAR_HONS: PASSING_YEAR_HONS,
                        UniversityName: UniversityName,
                        DeptName: DeptName,
                        GPA_HONS: GPA_HONS,
                        degreeId: degreeId,
                        priorIndex: priorIndex
                    };
                    data2 = {
                        APPLICANT_ID: APPLICANT_ID,
                        EXAM_TYPE_SSC: EXAM_TYPE_SSC,
                        INSTITUTE_SSC: INSTITUTE_SSC,
                        PASSING_YEAR_SSC: PASSING_YEAR_SSC,
                        BOARD_SSC: BOARD_SSC,
                        GROUP_SSC: GROUP_SSC,
                        GPA_SSC: GPA_SSC,
                        ssc_certificate: ssc_certificate,
                        EXAM_TYPE_HSC: EXAM_TYPE_HSC,
                        INSTITUTE_HSC: INSTITUTE_HSC,
                        PASSING_YEAR_HSC: PASSING_YEAR_HSC,
                        BOARD_HSC: BOARD_HSC,
                        GROUP_HSC: GROUP_HSC,
                        GPA_HSC: GPA_HSC,
                        hsc_certificate: hsc_certificate,
                        degreeId: degreeId,
                        priorIndex: priorIndex
                    };
                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url(); ?>/portal/applicantAcademicInfo",

                        data: (degreeId == 61 ? data1 : data2),
                        beforeSend: function () {
                            $("#load").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            $("#load").html(data);
                        }
                    });
                }
            },
            onFinishing: function (event, currentIndex) {
                //alert('hi');
                if (currentIndex == 4) {
                    var APPLICANT_ID = $("#applicantId").val();
                    var paymentMode = $("#paymentMode").val();
                    var branchName = $("#branchName").val();
                    var receiptNo = $("#receiptNo").val();
                    var recieptImage = $("#Reciept_copy").text();
                    var checkReceipt = $("#checkReceipt").text();

                    if (checkReceipt == '') {
                        $.ajax({
                            type: "post",
                            url: "<?php echo site_url(); ?>/portal/applicantPayment",
                            data: {
                                APPLICANT_ID: APPLICANT_ID,
                                branchName: branchName,
                                paymentMode: paymentMode,
                                receiptNo: receiptNo,
                                recieptImage: recieptImage,
                                priorIndex: currentIndex
                            },
                            beforeSend: function () {
                                $("#load").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                            },
                            success: function (data) {
                                if (data == 0) {
                                    window.location.replace("<?php echo site_url(); ?>/Applicant/applicant_admid_card/" + APPLICANT_ID);
                                } else {
                                    window.location.replace("<?php echo site_url(); ?>/Applicant/registrationSuccess/" + APPLICANT_ID);
                                }
                            }
                        });
                    } else {
                        alert('No Receipt No. Found. Please enter valid receipt no.');
                    }
                }
                var form = $(this);
                // Disable validation on fields that are disabled.
                // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                form.validate().settings.ignore = ":disabled";

                // Start validation; Prevent form submission if false
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
               
            }
        }).validate({
            errorPlacement: function (error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });

        /*Mailing Address using ajax*/
        $(document).on('change', '#DIVISION', function () {
            var DIVISION_ID = $(this).val();
            var action_url = '<?php echo site_url('Common/dis_by_div_id') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: {DIVISION_ID: DIVISION_ID},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#DISTRICT').html(data);
                }
            });
        });
        $(document).on('change', '#DISTRICT', function () {
            var DISTRICT_ID = $(this).val();
            var action_url = '<?php echo site_url('Common/up_thana_by_dis_id') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: {DISTRICT_ID: DISTRICT_ID},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#UPZILLA').html(data);
                }
            });
        });
        $(document).on('change', '#UPZILLA', function () {
            var THANA_ID = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/union_by_thana_id',
                data: {THANA_ID: THANA_ID},
                success: function (data) {
                    $("#UNION").html(data)
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/police_station_by_thana_id',
                data: {THANA_ID: THANA_ID},
                success: function (data) {
                    $("#POLISH_STATION").html(data)
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/post_office_by_thana_id',
                data: {THANA_ID: THANA_ID},
                success: function (data) {
                    $("#POST_OFFICE").html(data)
                }
            });

        });
         $(document).on('change', '#LG_DIVISION', function () {
            var DIVISION_ID = $(this).val();
            var action_url = '<?php echo site_url('Common/dis_by_div_id') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: {DIVISION_ID: DIVISION_ID},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#LG_DISTRICT').html(data);
                }
            });
        });
        $(document).on('change', '#LG_DISTRICT', function () {
            var DISTRICT_ID = $(this).val();
            var action_url = '<?php echo site_url('Common/up_thana_by_dis_id') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: {DISTRICT_ID: DISTRICT_ID},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#LG_UPZILLA').html(data);
                }
            });
        });
        $(document).on('change', '#LG_UPZILLA', function () {
            var THANA_ID = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/union_by_thana_id',
                data: {THANA_ID: THANA_ID},
                success: function (data) {
                    $("#LG_UNION").html(data)
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/police_station_by_thana_id',
                data: {THANA_ID: THANA_ID},
                success: function (data) {
                    $("#LG_POLISH_STATION").html(data)
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/post_office_by_thana_id',
                data: {THANA_ID: THANA_ID},
                success: function (data) {
                    $("#LG_POST_OFFICE").html(data)
                }
            });

        });

        $(document).on('change', '#P_DIVISION', function () {
            var DIVISION_ID = $(this).val();
            var action_url = '<?php echo site_url('Common/dis_by_div_id') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: {DIVISION_ID: DIVISION_ID},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#P_DISTRICT').html(data);
                }
            });
        });
        $(document).on('change', '#P_DISTRICT', function () {
            var DISTRICT_ID = $(this).val();
            var action_url = '<?php echo site_url('Common/up_thana_by_dis_id') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: {DISTRICT_ID: DISTRICT_ID},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#P_UPZILLA').html(data);
                }
            });
        });
        $(document).on('change', '#P_UPZILLA', function () {
            var THANA_ID = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/union_by_thana_id',
                data: {THANA_ID: THANA_ID},
                success: function (data) {
                    $("#P_UNION").html(data)
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/police_station_by_thana_id',
                data: {THANA_ID: THANA_ID},
                success: function (data) {
                    $("#P_POLISH_STATION").html(data)
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/post_office_by_thana_id',
                data: {THANA_ID: THANA_ID},
                success: function (data) {
                    $("#P_POST_OFFICE").html(data)
                }
            });

        });

        /*End mailing Address using ajax*/
        var counter = 2;
        var flag = 0, pFlag = 0;
        $(document).on('change', '#DEGREE', function () {
            var degree_id = $(this).val();
            var action_url = '<?php echo site_url('Common/programByDegree') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: {degree_id: degree_id},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#PROGRAM').html(data);
                }
            });
            if (degree_id == 61) {
                $("#academic_list tbody").append(' <tr>' +
                    '<td>' +
                    '<select class="form-control login-form" name="EXAM_NAME_' + counter + '" class="EXAM_NAME">' +
                    '<option value="">-Select-</option>' +
                    <?php foreach ($exam_name as $row) { ?>
                    '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
                    <?php } ?>
                    '</select> ' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="INSTITUTE_' + counter + '" class="form-control login-form " placeholder="Institute Name" >' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="PASSING_YEAR_' + counter + '" class=" form-control login-form number" id="PASSING_YEAR" placeholder="Year" >' +
                    '</td>' +
                    ' <td>' +
                    '<select class="form-control login-form" name="BOARD_' + counter + '"  >' +
                    '<option value="">-Select-</option>' +
                    <?php foreach ($board_name as $row) { ?>
                    '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
                    <?php } ?>
                    '</select> ' +
                    ' </td>' +
                    '<td>' +
                    '<select class="form-control login-form" name="GROUP_' + counter + '"  >' +
                    '<option value="">-Select-</option>' +
                    <?php foreach ($group_name as $row) { ?>
                    '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
                    <?php } ?>
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    ' <input type="text" name="GPA_' + counter + '"  class="form-control login-form number" placeholder="CGPA" >' +
                    '</td>' +
                    '</tr>'
                );
                pFlag = 1;
            } else {
                if (flag == 1) {
                    $("tr:last").remove();
                    pFlag = 0;
                }
            }
            flag = pFlag;
        });

        $('body').on('keyup', '.numericOnly', function () {
            var val = $(this).val();
            $(this).val(val.replace(/[^\d]/g, ''));
        });

        /*$('body').on('keyup', '.numbersOnly', function () {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2) {
                    val = val.replace(/\.+$/, "");
                }
            }
            $(this).val(val);
        });*/

        $('.datePicker').datepicker({
            dateFormat: 'dd/mm/yy',
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
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
        $(".numbersOnly").keypress(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode
            if (
                (charCode != 45 || $(this).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
                (charCode != 46 || $(this).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
                (charCode < 48 || charCode > 57)
            )
                return false;
            return true;
        });
        $('#NationalId').blur(function (e) {
            if (validateCheck('NationalId')) {
                var n = $("#NationalId").val();
                var len = n.length;
                if (len == 13 || len == 17) {
                    $('#spnNationIdStatus').html('');
                    $('#NationalId').css('border-color', 'green');
                } else {
                    $('#spnNationIdStatus').html('Only 13 or 17 digits');
                    $('#spnNationIdStatus').css('color', 'red');
                }
            } else {
                $('#spnNationIdStatus').html('Invalid National ID !!');
                $('#spnNationIdStatus').css('color', 'red');
                $('#NationalId').css('border-color', 'red');
            }
        });
        /*Receipt No check */
        $('#receiptNo').blur(function (e) {
            var receiptNo = $(this).val();
            $.ajax({
                url: "<?php echo site_url(); ?>/portal/checkReceipt",
                type: "POST",
                data: {receiptNo: receiptNo},
                beforeSend: function () {
                    $("#load").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $("#checkReceipt").html(data);
                }
            });
        });
        /*SSC GPA Instruction check */
        $('#GPA_SSC').blur(function (e) {
            var APPLICANT_ID = $("#applicantId").val();
            var SSCGPA = $(this).val();
            $.ajax({
                url: "<?php echo site_url(); ?>/portal/checkGPASSC",
                type: "POST",
                data: {SSCGPA: SSCGPA, APPLICANT_ID:APPLICANT_ID},
                beforeSend: function () {
                    $("#load").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    if(SSCGPA < data){
                        alert("Your GPA is less then program conditional GPA");
                        $('#GPA_SSC').val('');
                    }
                }
            });
        });
        /*HSC GPA Instruction check */
        $('#GPA_HSC').blur(function (e) {
            var APPLICANT_ID = $("#applicantId").val();
            var SSCGPA = $(this).val();
            $.ajax({
                url: "<?php echo site_url(); ?>/portal/checkGPAHSC",
                type: "POST",
                data: {SSCGPA: SSCGPA, APPLICANT_ID:APPLICANT_ID},
                beforeSend: function () {
                    $("#load").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    if(SSCGPA < data){
                        alert("Your GPA is less then program conditional GPA");
                        $('#GPA_HSC').val('');
                    }
                }
            });
        });
        $('.number').keypress(function(event) {

            if(event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
                return true;
            else if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
                event.preventDefault();
        });
        $('.numberYear').keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    });
    function StudentImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#stdPhoto')
                    .attr('src', e.target.result)
                    .width(120);
            };

            reader.readAsDataURL(input.files[0]);
            /*upload photo specifit directory*/
            var input = document.getElementById("STD_PHOTO");
            file = input.files[0];
            if (file != undefined) {
                formData = new FormData();
                if (!!file.type.match(/image.*/)) {
                    formData.append("image", file);
                    $.ajax({
                        url: "<?php echo site_url(); ?>/portal/studentImagUpload",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $("#STD_PHOTO").text(data).val();
                        }
                    });
                } else {
                    alert('Not a valid image!');
                }
            } else {
                alert('Input something!');
            }
        }
    }
    function signatureImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#signaturePhoto')
                    .attr('src', e.target.result)
                    .width(120);
            };
            reader.readAsDataURL(input.files[0]);
            /*upload photo specifit directory*/
            var input = document.getElementById("SIG_PHOTO");
            file = input.files[0];
            if (file != undefined) {
                formData = new FormData();
                if (!!file.type.match(/image.*/)) {
                    formData.append("image", file);
                    $.ajax({
                        url: "<?php echo site_url(); ?>/portal/studentImagUpload",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $("#SIG_PHOTO").text(data).val();
                        }
                    });
                } else {
                    alert('Not a valid image!');
                }
            } else {
                alert('Input something!');
            }
        }
    }      
    function FatherImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#fatherPhoto')
                    .attr('src', e.target.result)
                    .width(120);
            };

            reader.readAsDataURL(input.files[0]);
            /*upload photo specifit directory*/
            var input = document.getElementById("father_PHOTO");
            file = input.files[0];
            if (file != undefined) {
                formData = new FormData();
                if (!!file.type.match(/image.*/)) {
                    formData.append("image", file);
                    $.ajax({
                        url: "<?php echo site_url(); ?>/portal/parentImagUpload",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $("#father_PHOTO").text(data).val();
                        }
                    });
                } else {
                    alert('Not a valid image!');
                }
            } else {
                alert('Input something!');
            }
        }
    }
    function MotherImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#motherPhoto')
                    .attr('src', e.target.result)
                    .width(120);
            };

            reader.readAsDataURL(input.files[0]);
            /*upload photo specifit directory*/
            var input = document.getElementById("mother_PHOTO");
            file = input.files[0];
            if (file != undefined) {
                formData = new FormData();
                if (!!file.type.match(/image.*/)) {
                    formData.append("image", file);
                    $.ajax({
                        url: "<?php echo site_url(); ?>/portal/parentImagUpload",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $("#mother_PHOTO").text(data).val();
                        }
                    });
                } else {
                    alert('Not a valid image!');
                }
            } else {
                alert('Input something!');
            }
        }
    }
    function SSCImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#sscPhoto')
                    .attr('src', e.target.result)
                    .width(80);
            };

            reader.readAsDataURL(input.files[0]);
            /*upload photo specifit directory*/
            var input = document.getElementById("ssc_certificate");
            file = input.files[0];
            if (file != undefined) {
                formData = new FormData();
                if (!!file.type.match(/image.*/)) {
                    formData.append("image", file);
                    $.ajax({
                        url: "<?php echo site_url(); ?>/portal/studentImagUpload",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $("#ssc_certificate").text(data).val();
                        }
                    });
                } else {
                    alert('Not a valid image!');
                }
            } else {
                alert('Input something!');
            }
        }
    }
    function HSCImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#hscPhoto')
                    .attr('src', e.target.result)
                    .width(80);
            };

            reader.readAsDataURL(input.files[0]);
            /*upload photo specifit directory*/
            var input = document.getElementById("hsc_certificate");
            file = input.files[0];
            if (file != undefined) {
                formData = new FormData();
                if (!!file.type.match(/image.*/)) {
                    formData.append("image", file);
                    $.ajax({
                        url: "<?php echo site_url(); ?>/portal/studentImagUpload",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $("#hsc_certificate").text(data).val();
                        }
                    });
                } else {
                    alert('Not a valid image!');
                }
            } else {
                alert('Input something!');
            }
        }
    }
    function RecieptImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#recieptImage')
                    .attr('src', e.target.result)
                    .width(270);
            };

            reader.readAsDataURL(input.files[0]);
            /*upload photo specifit directory*/
            var input = document.getElementById("Reciept_copy");
            file = input.files[0];
            if (file != undefined) {
                formData = new FormData();
                if (!!file.type.match(/image.*/)) {
                    formData.append("image", file);
                    $.ajax({
                        url: "<?php echo site_url(); ?>/portal/RecieptImagUpload",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $("#Reciept_copy").text(data).val();
                        }
                    });
                } else {
                    alert('Not a valid image!');
                }
            } else {
                alert('Input something!');
            }
        }
    }


    
    function validateCheck(txtDigit) {
        var a = document.getElementById(txtDigit).value;
        var filter = /^[0-9-+]+$/;
        if (filter.test(a)) {
            return true;
        }
        else {
            return false;
        }
    }
    $(document).on("click", "#PARM_ADDRESS_YES", function () {
        $("#permanent_address").hide();
    });
    $(document).on("click", "#PARM_ADDRESS_NO", function () {
        $("#permanent_address").show();
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
    $(document).on("click", ".local_emergency_guardian", function () {
        var thisVal = $(this).val();
        if (thisVal == 'O') {
            $(".is_required_o").attr("required", "required");
        } else {
            $(".is_required_o").removeAttr("required");
        }
    });

    // for father mobile
    $(document).on('click', '#add_mobile_f', function (e) {
        e.preventDefault();
        $("#mobile_list_f tbody").append('<tr> ' +
        ' <td class= appendClass>' +
        '<input type="text" name="FATHER_PHN[]"   class="F_Mobile form-control login-form numbersOnly" placeholder="Enter Mobile No" >' +
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
        ' <td class= appendClass>' +
        '<input type="text" name="FATHER_EMAIL[]"   class="F_Email form-control login-form " placeholder="Enter Another Email">' +
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
        ' <td class= appendRightClass>' +
        '<input type="text" name="MOTHER_PHN[]"   class="M_Mobile form-control login-form numbersOnly" placeholder="Enter Mobile No">' +
        '</td>' +
        ' <td >           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for mother email
    $(document).on('click', '#add_email_m', function (e) {
        e.preventDefault();
        $("#email_list_m tbody").append('<tr> ' +
        ' <td class= appendClass>' +
        '<input type="text" name="MOTHER_EMAIL[]"   class="M_Email form-control login-form" placeholder="Enter Another Email">' +
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
        '<input type="text" name="LOCAL_GAR_PHN[]"   class=" LOCAL_GAR_PHN form-control numbersOnly" placeholder="Mobile">' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });// for local gardian email
    $(document).on('click', '#add_email_lg', function (e) {
        e.preventDefault();
        $("#email_list_lg tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="LOCAL_GAR_EMAIL[]"   class=" LOCAL_GAR_EMAIL form-control" placeholder="Email address">' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    $(document).on('click', '.remove', function () {
        $(this).closest('tr').remove();
    });
    $(document).on("change", "#MARITAL_STATUS", function () {
        if ($("#MARITAL_STATUS option:selected").text() == 'Married') {
            $('#spouse_name').show();
            $('#finance_spouse').show();
            $(".is_required_s").attr("required", "required");
        } else {
            $('#spouse_name').hide();
            $('#finance_spouse').hide();
            $(".is_required_s").removeAttr("required");
        }
    });
    $(document).on('click', '#siblin', function () {
        if ($('input[name="SIBLING_EXIST"]:checked').val() == 1) {
            $('.sibId').show();
        } else {
            $('.sibId').hide();
        }
    });
    $(document).on("change", "#ssc_grade_type", function () {
        if ($("#ssc_grade_type option:selected").text() == "Grade") {
            $('#ssc_grade').show();
            $('#ssc_division').hide();
            $(".is_required_s").attr("required", "required");
        } else {
            $('#ssc_grade').hide();
            $('#ssc_division').show();
            $(".is_required_s").removeAttr("required");
        }
    });
    $(document).on("change", "#hsc_gd_type", function () {
        if ($("#hsc_gd_type option:selected").text() == 'Grade') {
            $('#hsc_grade').show();
            $('#hsc_division').hide();
            $(".is_required_s").attr("required", "required");
        } else {
            $('#hsc_grade').hide();
            $('#hsc_division').show();
            $(".is_required_s").removeAttr("required");
        }
    });
</script>