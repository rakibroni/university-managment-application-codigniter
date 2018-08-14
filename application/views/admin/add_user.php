<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">
<style>
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
        border-radius: 10px;
    }
</style>
<link href="<?php echo base_url(); ?>assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
<div class="row">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Create a new user</h5>

            <div class="ibox-tools">
                <a href="<?php echo base_url(); ?>admin/users">
                    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                </a>
            </div>
        </div>

        <form class="form-horizontal" action="<?php echo base_url(); ?>admin/addUser" method="post"
              enctype="multipart/form-data">

            <div class="col-md-10">
                <div class="ibox-content">
                    <strong>NOTE : </strong> All <span class="red">*</span> field are required.
                    <h4 style="color:green">Personal Information</h4>

                    <div class="div-background">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="col-md-4 control-label">First Name <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="FIRST_NAME" id="FIRST_NAME"
                                           value="<?php echo set_value('FIRST_NAME') ?>" class="form-control"
                                           placeholder="First Name" required>
                                    <span class="red"><?php echo form_error('FIRST_NAME'); ?></span>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your first name here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Middle Name</label>

                                <div class="col-md-4">
                                    <input type="text" name="MIDDLE_NAME" id="MIDDLE_NAME" value="" class="form-control"
                                           placeholder="Middle Name">
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your middle name here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Last Name <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="LAST_NAME" id="LAST_NAME"
                                           value="<?php echo set_value('LAST_NAME'); ?>" class="form-control"
                                           placeholder="Last Name" required>
                                    <span class="red"><?php echo form_error('LAST_NAME'); ?></span>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your last name here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Birth Date <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input
                                            type="text" name="DOB" id="dob" class="form-control dob"
                                            value="<?php echo set_value('DOB'); ?>" required="required" readonly>
                                    </div>
                                    <span class="red"><?php echo form_error('DOB'); ?></span>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2" data-content="Select birth date from calender"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Age</label>

                                <div class="col-md-2">
                                    <input type="text" name="AGE" id="age" value="" class="form-control numbersOnly"
                                           placeholder="Age" readonly>
                                </div>
                                <div class="col-md-2">Years old</div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="After select birth day age is auto calculate"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Blood Group</label>

                                <div class="col-md-2">
                                    <select class="form-control" name="BLOOD_GROUP" id="BLOOD_GROUP">
                                        <option value="">-Select-</option>
                                        <?php foreach ($blood_group as $row): ?>
                                            <option
                                                value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please select blood group from here " data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Gender <span class="red">*</span></label>

                                <div class="col-md-5">
                                    <input type="radio" name="GENDER" value="M" checked>&nbsp; Male &nbsp; <input
                                        type="radio" name="GENDER" value="F"> &nbsp;Female &nbsp; <input type="radio"
                                                                                                         name="GENDER"
                                                                                                         value="O">&nbsp;
                                    Others

                                    <span class="red"><?php echo form_error('GENDER'); ?></span>

                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2" data-content="Please select your gender"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nationality <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <select class="form-control" name="NATIONALITY" id="NATIONALITY" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($nationality as $row) { ?>
                                            <option
                                                value="<?php echo $row->id ?>" <?php echo ($row->id == 15) ? 'selected' : ''; ?>><?php echo $row->nationality ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="red"><?php echo form_error('NATIONALITY'); ?></span>
                                </div>
                                <div class="col-md-4">
                                    <i class="fa fa-info-circle pointer2" data-content="Select your nationality"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mobile <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="MOBILE" id="MOBILE" value=""
                                           class="form-control numbersOnly" placeholder="Mobile" required>
                                    <span class="red"><?php echo form_error('MOBILE'); ?></span>
                                </div>
                                <div class="col-md-1">
                                    <i style="cursor:pointer" class="fa fa-plus btn-xs btn-primary"
                                       id="add_mobbile"></i>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your valid mobile no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>

                                <div class="col-md-4">
                                    <table id="mobile_list">
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Email <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="EMAIL" id="EMAIL" value="<?php echo set_value('EMAIL'); ?>"
                                           class="form-control checkEmail" placeholder="Email" required>
                                    <span class="red email_validation"><?php echo form_error('EMAIL'); ?></span>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your valid email address here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Alternative Email</label>

                                <div class="col-md-4">
                                    <input type="text" name="ALT_EMAIL" id="ALT_EMAIL" value=""
                                           class="form-control checkEmail" placeholder="Alternative Email">
                                    <span class="ALT_EMAIL red"></span>
                                </div>

                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your valid alternative email address here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">National ID <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="NID" id="NID" value="<?php echo set_value('NID'); ?>"
                                           class="form-control numbersOnly" placeholder="National ID" required>
                                    <span class="red nationalID_validation"><?php echo form_error('NID'); ?></span>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your National identity number here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Height</label>

                                <div class="col-md-2" style="padding-right: 0;">
                                    <input type="text" name="HEIGHT_FEET" id="HEIGHT_FEET" value=""
                                           class="form-control numbersOnly" placeholder="e.g: 5.8">
                                </div>
                                <div class="col-md-1">
                                    Ft.
                                </div>
                                <div class="col-md-2" style="padding-right: 0;">
                                    <input type="text" name="HEIGHT_CM" id="HEIGHT_CM" value=""
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
                                <label class="col-md-4 control-label">Weight</label>

                                <div class="col-md-2" style="padding-right: 0;">
                                    <input type="text" name="WEIGHT_KG" id="WEIGHT_KG" value=""
                                           class="form-control numbersOnly" placeholder="Weight">
                                </div>
                                <div class="col-md-1">
                                    Kg
                                </div>
                                <div class="col-md-2" style="padding-right: 0;">
                                    <input type="text" name="WEIGHT_LBS" id="WEIGHT_LBS" value=""
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

                            <div class="form-group">
                                <label class="col-md-4 control-label">Religion <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <select class="form-control" name="RELIGION" id="RELIGION" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($religion as $row): ?>
                                            <option
                                                value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="red"><?php echo form_error('RELIGION'); ?></span>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2" data-content="Select your religion"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Photo <span class="red">*</span></label>

                                <div class="col-md-3">
                                    <div class="avatar-zone">
                                        <img id="img_id" src="<?php echo base_url('assets/img/default.png'); ?>"
                                             alt="select photo" style="width: 180px;
                                             height: 160px;"/>
                                    </div>
                                    <div class="overlay-layer">Upload photo</div>
                                    <input type='file' name="photo" onchange="upload_img(this);" class="upload_btn"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <br><br>
                    <h4 style="color:green">Family and Others Information</h4>

                    <div class="div-background">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Father's Name</label>

                            <div class="col-md-4">
                                <input type="text" name="FATHERS_NAME" id="FATHERS_NAME" value="" class="form-control"
                                       placeholder="Father's Name">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your father's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mother's Name</label>

                            <div class="col-md-4">
                                <input type="text" name="MOTHERS_NAME" id="MOTHERS_NAME" value="" class="form-control"
                                       placeholder="Mother's Name">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your mother's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Home Phone</label>

                            <div class="col-md-3">
                                <input type="text" name="HOME_PHONE" id="HOME_PHONE" value=""
                                       class="form-control numbersOnly" placeholder="Home Phone">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your home phone no here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Marital status</label>

                            <div class="col-md-1" style="width:15px">
                                <input type="checkbox" name="MARITAL_STATUS" id="MARITAL_STATUS" class="form-control"/>
                            </div>
                            <div class="col-md-3">
                                <div id="SN" style="display:none">
                                    <input type="text" name="SPOUSE_NAME" id="SPOUSE_NAME" value="" class="form-control"
                                           placeholder="Spouse Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please select your marital status and enter your spouse name"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Place of Birth</label>

                            <div class="col-md-2">
                                <input type="text" name="PLACE_OF_BIRTH" id="PLACE_OF_BIRTH" value=""
                                       class="form-control" placeholder="Place of Birth">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Enter your place name where are you born" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Passport No</label>

                            <div class="col-md-3">
                                <input type="text" name="PASSPORT_NO" id="PASSPORT_NO" value="" class="form-control"
                                       placeholder="Passport No">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Passport No"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Passport Issue Date</label>

                            <div class="col-md-3">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" id="DATE_OF_ISSUE" name="DATE_OF_ISSUE"
                                           class="form-control datepicker" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Select Passport Issue Date from calender" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group data_1">
                            <label class="col-md-3 control-label">Passport Expire Date</label>

                            <div class="col-md-3">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" id="EXPIRE_DATE" name="EXPIRE_DATE"
                                           class="form-control datepicker" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Select Passport Expire Date from calender" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Passport Issue Place</label>

                            <div class="col-md-3">
                                <input type="text" name="PLACE_OF_ISSUE" id="PLACE_OF_ISSUE" value=""
                                       class="form-control" placeholder="Passport Issue Place">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Passport Issue place"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Present Address <span class="red">*</span></label>

                            <div class="col-md-4">
                                <textarea class="form-control" name="PRE_ADDRESS"
                                          required><?php echo set_value('PRE_ADDRESS'); ?></textarea>
                                <span class="red"><?php echo form_error('PRE_ADDRESS'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your present address here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Permanent Address <span class="red">*</span></label>

                            <div class="col-md-4">
                                <textarea class="form-control" name="PER_ADDRESS"
                                          required><?php echo set_value('PER_ADDRESS'); ?></textarea>
                                <span class="red"><?php echo form_error('PER_ADDRESS'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Permanent address here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Person</label>

                            <div class="col-md-4">
                                <input type="text" name="CONTACT_PERSON" id="CONTACT_PERSON" value=""
                                       class="form-control" placeholder="Contact Person">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Contact Person name"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Person Address</label>

                            <div class="col-md-4">
                                <textarea class="form-control" name="CONTACT_PERSON_ADD"></textarea>

                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your present address here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Person Mobile</label>

                            <div class="col-md-3">
                                <input type="text" name="CONTACT_PERSON_PHN" id="CONTACT_PERSON_PHN" value=""
                                       class=" numbersOnly form-control" placeholder="Contact Person Mobile">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Contact Person Mobile"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Relation</label>

                            <div class="col-md-3">
                                <input type="text" name="RELATION" id="RELATION" value="" class="form-control"
                                       placeholder="Relation">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Relation with contact person"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h4 style="color:green">Department Information</h4>

                    <div class="div-background">

                        <div id="faculty" class="form-group">
                            <label class="col-md-3 control-label">Administration <span class="red">*</span></label>

                            <div class="col-md-4">
                                <select name="FACULTY_ID" id="FACULTY_ID" class="form-control">
                                    <option value="">-Select-</option>
                                    <?php foreach ($faculty as $row) { ?>
                                        <option
                                            value="<?php echo $row->FACULTY_ID ?>"><?php echo $row->FACULTY_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('FACULTY_ID'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please select your Faculty name hear" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Department <span class="red">*</span></label>

                            <div class="col-md-4">
                                <select name="DEPT_ID" id="DEPT_ID" class="form-control" required>
                                    <option value="">-Select-</option>

                                </select>
                                <span class="red"><?php echo form_error('DEPT_ID'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please select your Department  name hear" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Designation</label>

                            <div class="col-md-4">
                                <select name="designation" id="designation" class="form-control">
                                    <option value="">-Select-</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please select your Designation  name hear" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Bio-matric ID</label>

                            <div class="col-md-4">
                                <input type="text" name="BIOMETRIC_ID" id="BIOMETRIC_ID" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your Bio-matric ID name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Office Phone</label>

                            <div class="col-md-3">
                                <input type="text" name="OFFICIAL_PHONE_NO" id="OFFICIAL_PHONE_NO"
                                       class="form-control numbersOnly">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter office phone no here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Office Phone Extension</label>

                            <div class="col-md-2">
                                <input type="text" name="OFFICIAL_PHONE_EXTENSION" id="OFFICIAL_PHONE_EXTENSION"
                                       class="form-control numbersOnly">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter office phone no ex here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Hire Date <span class="red">*</span></label>

                            <div class="col-md-3">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="HIRE_DATE"
                                           id="HIRE_DATE" <?php echo set_value('HIRE_DATE'); ?>
                                           class="form-control datepicker" value="" required="required" readonly>
                                </div>
                                <span class="red"><?php echo form_error('HIRE_DATE'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Select hire date from calender"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h4 style="color:green">Access Information</h4>

                    <div class="div-background">

                        <div class="form-group">
                            <label class="col-md-3 control-label">User Group <span class="red">*</span></label>

                            <div class="col-md-3">
                                <select name="user_group" id="user_group" class="form-control" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($user_group as $row) { ?>
                                        <option
                                            value="<?php echo $row->USERGRP_ID ?>"><?php echo $row->USERGRP_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('user_group'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please select your User Group here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">User Level<span class="red">*</span></label>

                            <div class="col-md-3">
                                <select name="user_group_lavel" id="user_group_lavel" class="form-control">
                                    <option value="">-Select-</option>
                                </select>

                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please select your User Level here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">User name <span class="red">*</span></label>

                            <div class="col-md-4">
                                <input type="text" name="USERNAME" id="USERNAME"
                                       value="<?php echo set_value('USERNAME'); ?>" class="form-control" required>
                                <span class="red"><?php echo form_error('USERNAME'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter user name here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">User Password <span class="red">*</span></label>

                            <div class="col-md-4">
                                <input type="password" name="USERPW" id="USERPW"
                                       value="<?php echo set_value('USERPW'); ?>" class="form-control" required>
                                <span class="red"><?php echo form_error('USERPW'); ?></span>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter user password here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>

                    </div>
                    <br><br>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>

                        <div class="col-md-5 ">

                            <input type="submit" class="btn btn-primary" value="Save">
                            <input type="reset" class="btn btn-white" value="Reset">
                        </div>
                    </div>
                </div>


            </div>

        </form>

    </div>
</div>

<!--<script src="<?php //echo base_url();                                                                 ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $(function () {
        $(function () {
            $(".datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:+0',
                dateFormat: 'd/m/y'

            });
            $(".dob").datepicker({
                onSelect: function (value, ui) {
                    var today = new Date();
                    var format = value.split("/");
                    var dob = new Date(format[2], format[1], format[0]);
                    var diff = (today - dob);
                    var age = Math.floor(diff / 31536000000);

                    $('#age').val(age);
                },
                dateFormat: 'dd/mm/yy',
                maxDate: '+0d',
                yearRange: '1960:2010',
                changeMonth: true,
                changeYear: true
            });
        });

    });
</script>
<script>


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
    $(document).on('click', '#MARITAL_STATUS', function () {
        $("#SN").toggle();
    });
    //email validation
    $(document).on('blur', '#EMAIL', function () {
        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str)) {
            $(".email_validation").html('Invalid Email address');
        } else {
            $(".email_validation").html('');
        }

    });

    //alternat email validation
    $(document).on('blur', '#ALT_EMAIL', function () {

        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str)) {
            $(".ALT_EMAIL").html('Invalid Email address');
        } else {
            $(".ALT_EMAIL").html('');
        }

    });

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

    // get department by change faculty
    $(document).on('change', '#FACULTY_ID', function () {
        var faculty_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admin/departmentByFaculty'); ?>',
            data: {faculty_id: faculty_id},
            success: function (data) {
                $('#DEPT_ID').html(data);
            }
        });
    });
    // get department by change faculty
    $(document).on('change', '#DEPT_ID', function () {
        var dept_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admin/ajax_get_designaion'); ?>',
            data: {dept_id: dept_id},
            success: function (data) {
                $('#designation').html(data);
            }
        });
    });
    $(document).on('click', '#add_mobbile', function (e) {
        e.preventDefault();
        $("#mobile_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="ALT_MOBILE[]" id="MOBILE" value="" class="form-control numbersOnly" placeholder="Mobile" required>' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    $(document).on('click', '.remove', function () {
        $(this).closest('tr').remove();
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
    $(document).on('blur', '#NID', function () {
        var str = $(this).val();
        if (str.length == '13' || str.length == '17') {
            $(".nationalID_validation").html('');
        } else {

            $(".nationalID_validation").html('Invalid National ID Number');
        }
    });

</script>