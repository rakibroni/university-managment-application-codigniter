
<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<style>
    .required {
        color: red;
    }

    .regiColumns {
        margin: 0 auto;
        max-width: 650px;
        padding: 50px 20px 20px;

    }
    .fileUpload {
        margin-left: 32px;
        overflow: hidden;
        position: relative;
    }
    .fileUpload input.upload {
        cursor: pointer;
        font-size: 20px;
        margin: 0;
        opacity: 0;
        padding: 0;
        position: absolute;
        right: 0;
        top: 0;
    }
    .form-inline{
         margin-bottom: 8px;
    }
    .form-control {
        height: 30px !important;
    }
    #GENDER {
      margin: 5px;
      width: 164px !important;
    }
    .commonClass{
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    legend {
        color: #F37E24;
        font-size: 14px;
        font-weight: 100;
        margin-left: 14px;
        padding: 2px;
        width: 99% !important;
    }
    .f-m-photo{
        margin-left: 10px !important;
    }
</style>
<?php
$gender = array(
    '' => 'Select Gender',
    'M' => 'Male',
    'F' => 'Female',
    'O' => 'Others'
);
?>


<div class="col-md-12">
    <div class="widget-main">
        <div class="widget-inner shortcode-typo">
            <div class="row">


                <div class="ibox-header">
                    <p>&nbsp;</p>
                    <h1 style="text-align: center;">Online Application</h1>
                </div>

                <div class="ibox-content">
                    <?php if (validation_errors() != ''): ?>
                        <div class="alert alert-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open_multipart('', 'id=""') ?>
                    <input type="hidden" name="AC_YEAR" value=""/>

                    <div class="row">
                        <div class="col-md-10" id="student_info">
                            <legend>Personal Details </legend>
                            <div class="col-md-12">
                                <div class="col-md-4 form-group">
                                    <label class="col-md-4 control-label commonClass" for="FIRST_NAME">First Name <span
                                            class="required">*</span></label>

                                    <div class="col-md-8 commonClass">
                                        <div class="fg-line">
                                            <input type="text" name="FIRST_NAME" class="form-control" id="FIRST_NAME" value="<?php echo set_value('FIRST_NAME'); ?>" required placeholder="Enter first name"/>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="col-md-5 control-label commonClass" for="MIDDLE_NAME">Middle Name</label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <input type="text" name="MIDDLE_NAME" class="form-control" id="MIDDLE_NAME" value="<?php echo set_value('MIDDLE_NAME'); ?>" placeholder="Enter middle name"/>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="col-md-5 control-label commonClass" for="LAST_NAME">Last Name</label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <input type="text" name="LAST_NAME" class="form-control" id="LAST_NAME" value="<?php echo set_value('LAST_NAME'); ?>" placeholder="Enter last name"/>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-8 form-group">
                                    <label class="col-md-2 control-label commonClass" for="BanglaName">নাম (বাংলা) <span
                                        class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <input type="text" name="BanglaName" id="BanglaName" class="form-control " required value="<?php echo set_value('BanglaName'); ?>" placeholder="বাংলা নাম লিখুন" />
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="GENDER">Gender<span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <?php echo form_dropdown('GENDER', $gender, set_value('GENDER'), 'class="form-control" id="GENDER" required '); ?>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="RELIGION">Religion <span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control " name="RELIGION" id="RELIGION" data-tags="true" data-placeholder="Select Religion" data-allow-clear="true">
                                                <option value="">Select Religion</option>
                                                <?php foreach ($religion as $row): ?>
                                                    <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="DATH_OF_BIRTH">Date of Birth <span class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line input-group date ">
                                            <input type="text" name="DATH_OF_BIRTH" id="DATH_OF_BIRTH"
                                                   class="form-control datePicker"
                                                   value="<?php echo set_value('DATH_OF_BIRTH'); ?>"
                                                   placeholder="dd/mm/yyyy"><label class="input-group-addon" for="BIRTH_DATE"><i
                                                    class="fa fa-calendar"></i></label>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="DATH_OF_BIRTH">Place of Birth <span class="required">*</span></label>
                                    <div class="col-md-6 commonClass">
                                        <div class="fg-line input-group date ">
                                            <input type="text" name="PlaceOfBirth" id="PlaceOfBirth" class="form-control" required value="<?php echo set_value('PlaceOfBirth'); ?>" placeholder="Enter place of birth"/>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="MARITAL_STATUS">Marital Status <span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control " name="MARITAL_STATUS" id="MARITAL_STATUS" data-tags="true" data-placeholder="Select Merital Status" data-allow-clear="true">
                                                <option value="">Select Merital Status</option>
                                                <?php foreach ($merital_status as $row): ?>
                                                    <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="NATIONALITY">Nationality <span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control " name="NATIONALITY" id="NATIONALITY" data-tags="true" data-placeholder="Select Nationality" data-allow-clear="true">
                                                <option value="">Select Merital Status</option>
                                                <?php foreach ($nationality as $row): ?>
                                                    <option value="<?php echo $row->id ?>" <?php echo ($row->id == 15) ? 'selected' : ''; ?>><?php echo $row->nationality ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="MOBILE_NO">Mobile No<span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <input type="text" name="MOBILE_NO" id="MOBILE_NO" class="form-control numericOnly" required value="<?php echo set_value('MOBILE_NO'); ?>" placeholder="Enter Mobile No" maxlength="11"/>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="EMAIL_ADDRESS">Email <span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">EMAIL_ADDRESS
                                        <input type="Email" name="EMAIL_ADDRESS" id="EMAIL_ADDRESS" class="form-control" required value="<?php echo set_value('EMAIL_ADDRESS'); ?>" placeholder="Enter Email"/>
                                    </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="">Student Type <span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <input type="radio" name="STD_TYPE" class="" id="STD_TYPE"
                                                   value="L" <?php echo set_radio('STD_TYPE', 'L'); ?> required/> Local
                                            &nbsp;&nbsp;
                                            <input type="radio" name="STD_TYPE" class="" id="STD_TYPE"
                                                   value="F" <?php echo set_radio('STD_TYPE', 'F'); ?> required/> Foreign
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div> -->

                        </div>
                        <div class="col-md-2">
                            <legend>Photo</legend>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <img style="width:120px; border:1px solid #000000; margin-bottom: 20px;" id="stdPhoto" class=""
                                     src="<?php echo base_url(); ?>assets/img/default.png" alt=""/>
                            </div>
                            <div class="fileUpload btn btn-primary btn-xs">
                                <span>Upload Photo</span>
                                <input id="STD_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="STD_PHOTO" required
                                       onchange="StudentImg(this);" class="upload col-sm-12" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="family_info">
                            <legend>Family Details </legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-8">
                                        <div class="col-md-12 form-group">
                                            <label class="col-md-5 control-label commonClass" for="FATHER_NAME">Father's Name <span
                                                    class="required">*</span></label>

                                            <div class="col-md-7 commonClass">
                                                <div class="fg-line">
                                                    <input type="text" name="FATHER_NAME" class="form-control" id="FATHER_NAME" value="<?php echo set_value('FIRST_NAME'); ?>" required placeholder="Enter father's name"/>
                                                </div>
                                            </div>
                                            <br clear="all"/>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="col-md-5 control-label commonClass" for="F_Occupation">Occupation<span
                                            class="required">*</span></label>
                                            <div class="col-md-7 commonClass">
                                                <div class="fg-line">
                                                    <select class="select2Dropdown form-control " name="F_Occupation" id="F_Occupation" data-tags="true" data-placeholder="Select Occupation" data-allow-clear="true">
                                                        <option value="">Select Occupation</option>
                                                        <?php foreach ($occupation as $row): ?>
                                                            <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br clear="all"/>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="col-md-5 control-label commonClass" for="F_Mobile">Mobile No<span
                                            class="required">*</span></label>
                                            <div class="col-md-7 commonClass">
                                                <div class="fg-line">
                                                    <input type="text" name="F_Mobile" id="F_Mobile" class="form-control numericOnly" required value="<?php echo set_value('MOBILE_NO'); ?>" placeholder="Enter Mobile No" maxlength="11"/>
                                                </div>
                                            </div>
                                            <br clear="all"/>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="col-md-5 control-label commonClass" for="F_Email">Email<span
                                            class="required">*</span></label>
                                            <div class="col-md-7 commonClass">
                                                <div class="fg-line">
                                                    <input type="email" name="F_Email" id="F_Email" class="form-control" required value="<?php echo set_value('F_Email'); ?>" placeholder="Enter Mobile No"/>
                                                </div>
                                            </div>
                                            <br clear="all"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <img style="width:120px; border:1px solid #000000; margin-bottom: 20px;" id="fatherPhoto" class=""
                                                 src="<?php echo base_url(); ?>assets/img/default.png" alt=""/>
                                        </div>
                                        <div class="fileUpload f-m-photo btn btn-primary btn-xs">
                                            <span>Upload Father's Photo</span>
                                            <input id="father_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="father_PHOTO" required
                                                   onchange="FatherImg(this);" class="upload col-sm-12"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-8">
                                        <div class="col-md-12 form-group">
                                            <label class="col-md-5 control-label commonClass" for="MOTHER_NAME">Mother's Name <span
                                                    class="required">*</span></label>

                                            <div class="col-md-7 commonClass">
                                                <div class="fg-line">
                                                    <input type="text" name="MOTHER_NAME" class="form-control" id="MOTHER_NAME"
                                                           value="<?php echo set_value('MOTHER_NAME'); ?>" required
                                                           placeholder="Enter mother's name"/>
                                                </div>
                                            </div>
                                            <br clear="all"/>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="col-md-5 control-label commonClass" for="M_Occupation">Occupation<span
                                            class="required">*</span></label>
                                            <div class="col-md-7 commonClass">
                                                <div class="fg-line">
                                                    <select class="select2Dropdown form-control " name="M_Occupation" id="M_Occupation" data-tags="true" data-placeholder="Select Occupation" data-allow-clear="true">
                                                        <option value="">Select Occupation</option>
                                                        <?php foreach ($occupation as $row): ?>
                                                            <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br clear="all"/>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="col-md-5 control-label commonClass" for="M_Mobile">Mobile No<span
                                            class="required">*</span></label>
                                            <div class="col-md-7 commonClass">
                                                <div class="fg-line">
                                                    <input type="text" name="M_Mobile" id="M_Mobile" class="form-control numericOnly" required value="<?php echo set_value('M_Mobile'); ?>" placeholder="Enter Mobile No" maxlength="11"/>
                                                </div>
                                            </div>
                                            <br clear="all"/>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="col-md-5 control-label commonClass" for="M_Email">Email<span
                                            class="required">*</span></label>
                                            <div class="col-md-7 commonClass">
                                                <div class="fg-line">
                                                    <input type="email" name="M_Email" id="M_Email" class="form-control" required  value="<?php echo set_value('M_Email'); ?>" placeholder="Enter Email" />
                                                </div>
                                            </div>
                                            <br clear="all"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <img style="width:120px; border:1px solid #000000; margin-bottom: 20px;" id="motherPhoto" class=""
                                                 src="<?php echo base_url(); ?>assets/img/default-women.png" alt=""/>
                                        </div>
                                        <div class="fileUpload f-m-photo btn btn-primary btn-xs">
                                            <span>Upload Mother's Photo</span>
                                            <input id="mother_PHOTO" type="file" accept="jpg,jpeg,png,gif" name="mother_PHOTO" required
                                                   onchange="MotherImg(this);" class="upload col-sm-12"/>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12" id="mailing_address">
                            <legend>Mailing Address </legend>
                            <div class="col-md-12">
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="DIVISION">Division <span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control " name="DIVISION" id="DIVISION" data-tags="true" data-placeholder="Select Division" data-allow-clear="true">
                                                <option value="">Select Division</option>
                                                <?php foreach ($division as $row): ?>
                                                    <option value="<?php echo $row->DIVISION_ID ?>"><?php echo $row->DIVISION_ENAME ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="DISTRICT">District <span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control " name="DISTRICT" id="DISTRICT" data-tags="true" data-placeholder="Select District" data-allow-clear="true">
                                                <option value="">Select District</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="UPZILLA">Upazila/Thana<span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control " name="UPZILLA" id="UPZILLA" data-tags="true" data-placeholder="Select Upazila/Thana" data-allow-clear="true">
                                                <option value="">Select Upazila/Thana</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="POLISH_STATION">Police Station <span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control " name="POLISH_STATION" id="POLISH_STATION" data-tags="true" data-placeholder="Select Police Station" data-allow-clear="true">
                                                <option value="">Select Police Station</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="UNION">Union/Ward No. <span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control " name="UNION" id="UNION" data-tags="true" data-placeholder="Select Union/Ward No" data-allow-clear="true">
                                                <option value="">Select Union/Ward No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label class="col-md-4 control-label commonClass" for="POST_OFFICE">Post office <span
                                            class="required">*</span></label>
                                    <div class="col-md-7 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control " name="POST_OFFICE" id="POST_OFFICE" data-tags="true" data-placeholder="Select Post office" data-allow-clear="true">
                                                <option value="">Select Post office</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 form-group">
                                    <label class="col-md-4 control-label commonClass" for="Village">Vill/House no/Road no<span
                                            class="required">*</span></label>
                                    <div class="col-md-5 commonClass">
                                        <div class="fg-line">
                                            <input type="text" name="Village" class="form-control" id="Village"
                                                           value="<?php echo set_value('FIRST_NAME'); ?>" required
                                                           placeholder="Vill/House no/Road no"/>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="application_program">
                            <legend>Application Program</legend>
                            <div class="col-md-12">
                                <div class="col-md-8 form-group">
                                    <label class="col-md-4 control-label commonClass" for="DEGREE">Applying Level <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control" name="DEGREE" id="DEGREE" data-tags="true" data-placeholder="Select Degree" data-allow-clear="true">
                                                <option value="">Select Appling Level</option>
                                                <?php foreach ($degree as $row): ?>
                                                    <option value="<?php echo $row->DEGREE_ID ?>"><?php echo $row->DEGREE_NAME ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-8 form-group">
                                    <label class="col-md-4 control-label commonClass" for="PROGRAM">Program<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 commonClass">
                                        <div class="fg-line">
                                            <select class="select2Dropdown form-control" name="PROGRAM" id="PROGRAM" data-tags="true" data-placeholder="Select Program" data-allow-clear="true">
                                                <option value="">Select Program</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br clear="all"/>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="facademic_info">
                            <legend>Academic Information</legend>
                            <div class="col-md-12">
                                <table id="academic_list" class="table table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <th width="12%">Exam Type </th>
                                            <th width="15%">Institute </th>
                                            <th width="8%">Passing Year</th>
                                            <th width="10%">Board/University</th>
                                            <th width="12%">Group </th>
                                            <th width="5%">CGPA </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control" name="EXAM_NAME_  counter  " class="EXAM_NAME">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($exam_name as $row) { ?>
                                                        <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="INSTITUTE_  counter  " class="form-control " placeholder="Institute Name" >
                                            </td>
                                            <td>
                                                <input type="text" name="PASSING_YEAR_  counter  " class=" form-control numbersOnly" id="PASSING_YEAR" placeholder="Year" >
                                            </td>
                                            <td>
                                                <select class="form-control" name="BOARD_  counter  "  >
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($board_name as $row) { ?>
                                                        <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="GROUP_  counter  "  >
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($group_name as $row) { ?>
                                                        <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="GPA_  counter  "  class="form-control numbersOnly" placeholder="CGPA" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-control" name="EXAM_NAME_  counter  " class="EXAM_NAME">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($exam_name as $row) { ?>
                                                        <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="INSTITUTE_  counter  " class="form-control " placeholder="Institute Name" >
                                            </td>
                                            <td>
                                                <input type="text" name="PASSING_YEAR_  counter  " class=" form-control numbersOnly" id="PASSING_YEAR" placeholder="Year" >
                                            </td>
                                            <td>
                                                <select class="form-control" name="BOARD_  counter  "  >
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($board_name as $row) { ?>
                                                        <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="GROUP_  counter  "  >
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($group_name as $row) { ?>
                                                        <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="GPA_  counter  "  class="form-control numbersOnly" placeholder="CGPA" >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="term_condition">
                            <legend>Term & Condition</legend>
                            <div class="col-md-12">
                                <p class="agreement">
                                    <input type="checkbox" disabled="disabled" value="" checked="checked">
                                    <label>* I accept the <a target="_blank" href="terms.php"> University Terms and Conditions</a></label>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p>&nbsp;</p>
                            <a style="float: left" href="<?php echo site_url(); ?>/auth/studentLogin">
                                <small>Continue with Tracking Number</small>
                            </a>
                            <input style="float: right; margin-left: 5px;" type="submit" class="btn btn-sm btn-primary"
                                   value="Next"/>
                            <input style="float: right" type="reset" class="btn btn-sm btn-default" value="Cancel"/>

                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-6">
                    <strong>
                        <small> © 2013 - <?php echo date('Y'); ?>   All Rights Reserved | <a
                                href="http://www.atilimited.net/">ATI limited.</a></small>
                    </strong>
                </div>
                <div class="col-md-6 text-right">
                    <strong>
                        <small> Developed By
                            <a target="_blank" href="http://www.atilimited.net">
                                <span style="color: red;">ATI</span>
                                <span style="color: green;">Limited</span>
                            </a>
                        </small>
                    </strong>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        /*Mailing Address using ajax*/
        $(document).on('change', '#DIVISION', function(){
            var DIVISION_ID = $(this).val();
            var action_url = '<?php echo site_url('Common/dis_by_div_id') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: {DIVISION_ID:DIVISION_ID},
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
        $(document).on('change', '#DISTRICT', function(){
            var DISTRICT_ID = $(this).val();
            var action_url = '<?php echo site_url('Common/up_thana_by_dis_id') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: {DISTRICT_ID:DISTRICT_ID},
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
        $(document).on('change', '#UPZILLA', function(){
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

        /*End mailing Address using ajax*/
        var counter = 2;
        var flag = 0, pFlag = 0;
        $(document).on('change', '#DEGREE', function(){
            var degree_id = $(this).val();
            var action_url = '<?php echo site_url('Common/programByDegree') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: {degree_id:degree_id},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $('#PROGRAM').html(data);
                }
            });
            if(degree_id == 61){
                $("#academic_list tbody").append(' <tr>' +
                    '<td>' +
                        '<select class="form-control" name="EXAM_NAME_' + counter + '" class="EXAM_NAME">' +
                            '<option value="">-Select-</option>' +
                            <?php foreach ($exam_name as $row) { ?>
                            '<option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>' +
                            <?php } ?>
                        '</select> ' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="INSTITUTE_' + counter + '" class="form-control " placeholder="Institute Name" >' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="PASSING_YEAR_' + counter + '" class=" form-control numbersOnly" id="PASSING_YEAR" placeholder="Year" >' +
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
                        ' <input type="text" name="GPA_' + counter + '"  class="form-control numbersOnly" placeholder="CGPA" >' +
                    '</td>' +
                '</tr>'
                );
                pFlag = 1;
            }else{
                if(flag == 1){
                    $( "tr:last").remove();
                     pFlag = 0;
                }
            }
            flag = pFlag;
        });

        $('body').on('keyup', '.numericOnly', function () {
            var val = $(this).val();
            $(this).val(val.replace(/[^\d]/g, ''));
        });

        $('body').on('keyup', '.numbersOnly', function () {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2) {
                    val = val.replace(/\.+$/, "");
                }
            }
            $(this).val(val);
        });

        $('.datePicker').datepicker({
            dateFormat: 'dd/mm/yy',
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
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
        }
    }function MotherImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#motherPhoto')
                    .attr('src', e.target.result)
                    .width(120);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>