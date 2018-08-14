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
</style>

<link href="<?php echo base_url(); ?>assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">

<div class="row">
    <div class="col-md-9">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Create a new user</h5>

                <div class="ibox-tools">
                    <a href="<?php echo base_url(); ?>admin/users">
                        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-arrow-left"></i> Back
                        </button>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal" action="<?php echo base_url(); ?>admin/addUser" method="post"
                      enctype="multipart/form-data">
                    <h4 style="color:green">General Information</h4>

                    <div class="div-background">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Applicant SL. NO <span class="red">*</span></label>

                            <div class="col-md-6">
                                <input type="text" name="APPLICATION_SL" id="APPLICATION_SL"
                                       value="<?php echo set_value('APPLICATION_SL') ?>" class="form-control"
                                       placeholder="Applicant SL" required>
                                <span class="red"><?php echo form_error('APPLICATION_SL'); ?></span>
                            </div>

                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your applicant serial no here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Registration No. <span class="red">*</span></label>

                            <div class="col-md-6">
                                <input type="text" name="REGI_NO" id="REGI_NO"
                                       value="<?php echo set_value('REGI_NO') ?>" class="form-control"
                                       placeholder="Registration No" required>
                                <span class="red"><?php echo form_error('REGI_NO'); ?></span>
                            </div>

                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your registration no here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Existing Registration No. <span
                                    class="red">*</span></label>

                            <div class="col-md-6">
                                <input type="text" name="EXISTING_REG_NO" id="EXISTING_REG_NO"
                                       value="<?php echo set_value('EXISTING_REG_NO') ?>" class="form-control"
                                       placeholder="Existing Registration No" required>
                                <span class="red"><?php echo form_error('EXISTING_REG_NO'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your existing registration no here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Registration Date <span class="red">*</span></label>

                            <div class="col-md-3">
                                <input type="text" name="REGI_DT" id="REGI_DT"
                                       value="<?php echo set_value('REGI_DT') ?>" class="form-control datepicker"
                                       placeholder="Registration Date" required>
                                <span class="red"><?php echo form_error('REGI_DT'); ?></span>
                            </div>

                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your registration date here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email <span class="red">*</span></label>

                            <div class="col-md-6">
                                <input type="text" name="EMAIL" id="EMAIL" value="<?php echo set_value('EMAIL'); ?>"
                                       class="form-control checkEmail" placeholder="Email" required>
                                <span class="red email_validation"><?php echo form_error('EMAIL'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your valid email address here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Alternative Email</label>

                            <div class="col-md-6">
                                <input type="text" name="ALT_EMAIL" id="ALT_EMAIL" value=""
                                       class="form-control checkEmail" placeholder="Alternative Email">
                                <span class="ALT_EMAIL red"></span>
                            </div>

                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your valid alternative email address here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">National ID <span class="red">*</span></label>

                            <div class="col-md-6">
                                <input type="text" name="NID" id="NID" value="<?php echo set_value('NID'); ?>"
                                       class="form-control" placeholder="National ID" required>
                                <span class="red"><?php echo form_error('NID'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your natinal indentity number here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Birth Date <span class="red">*</span></label>

                            <div class="col-md-6">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input
                                        type="text" name="DOB" id="dob" class="form-control datepicker"
                                        value="<?php echo set_value('DOB'); ?>" required>

                                </div>
                                <span class="red"><?php echo form_error('DOB'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Select birth date from calender"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Age</label>

                            <div class="col-md-6">
                                <input type="text" name="AGE" id="age" value="" class="form-control numbersOnly"
                                       placeholder="Age">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="After select age is auto calculated"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Blood Group</label>

                            <div class="col-md-6">
                                <select class="form-control" name="BLOOD_GROUP" id="BLOOD_GROUP">
                                    <option value="">-Select-</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="B+">B+</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="After select age is auto calculated"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Height</label>

                            <div class="col-md-5">
                                <input type="text" name="HIGHT" id="HIGHT" value="" class="form-control numbersOnly"
                                       placeholder="Height">
                            </div>
                            <div class="col-md-1">
                                CM
                            </div>

                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter your height"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Weight</label>

                            <div class="col-md-5">
                                <input type="text" name="WEIGHT" id="WEIGHT" value="" class="form-control numbersOnly"
                                       placeholder="Weight">
                            </div>
                            <div class="col-md-1">
                                Kg.
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter your weight"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Gender <span class="red">*</span></label>

                            <div class="col-md-6">
                                <select class="form-control" name="GENDER" id="GENDER" required>
                                    <option value="">-Select-</option>
                                    <option value="M"
                                        <?php
                                        if ('M' == set_value('GENDER')) {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        }
                                        ?>>Male
                                    </option>
                                    <option value="F" <?php
                                    if ('F' == set_value('GENDER')) {
                                        echo "selected";
                                    } else {
                                        echo "";
                                    }
                                    ?>>Female
                                    </option>
                                    <option value="O" <?php
                                    if ('O' == set_value('GENDER')) {
                                        echo "selected";
                                    } else {
                                        echo "";
                                    }
                                    ?>>Others
                                    </option>
                                </select>
                                <span class="red"><?php echo form_error('GENDER'); ?></span>

                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Please select your gender"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Religion <span class="red">*</span></label>

                            <div class="col-md-6">
                                <select class="form-control" name="RELIGION" id="RELIGION" required>
                                    <option value="">-Select-</option>
                                    <option value="I" <?php
                                    if ('I' == set_value('RELIGION')) {
                                        echo "selected";
                                    } else {
                                        echo "";
                                    }
                                    ?>>Islam
                                    </option>
                                    <option value="H" <?php
                                    if ('H' == set_value('RELIGION')) {
                                        echo "selected";
                                    } else {
                                        echo "";
                                    }
                                    ?>>Hindusm
                                    </option>
                                    <option value="B" <?php
                                    if ('B' == set_value('RELIGION')) {
                                        echo "selected";
                                    } else {
                                        echo "";
                                    }
                                    ?>>Buddhist
                                    </option>
                                    <option value="C" <?php
                                    if ('C' == set_value('RELIGION')) {
                                        echo "selected";
                                    } else {
                                        echo "";
                                    }
                                    ?>>Cristian
                                    </option>
                                    <option value="O" <?php
                                    if ('O' == set_value('RELIGION')) {
                                        echo "selected";
                                    } else {
                                        echo "";
                                    }
                                    ?>>Others
                                    </option>
                                </select>
                                <span class="red"><?php echo form_error('RELIGION'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Select your religion"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nationality <span class="red">*</span></label>

                            <div class="col-md-6">
                                <select class="form-control" name="NATIONALITY" id="NATIONALITY" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($nationality as $row) { ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->nationality ?></option>
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
                            <label class="col-md-2 control-label">Hire Date <span class="red">*</span></label>

                            <div class="col-md-6">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="HIRE_DATE"
                                           id="HIRE_DATE" <?php echo set_value('HIRE_DATE'); ?>
                                           class="form-control datepicker" value="" required>
                                </div>
                                <span class="red"><?php echo form_error('HIRE_DATE'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Select hire date from calender"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Photo <span class="red">*</span></label>

                            <div class="col-md-3">
                                <input type='file' name="photo" onchange="upload_img(this);" required>

                                <span class="red"><?php //echo form_error('photo');     ?></span>
                            </div>
                            <div class="col-md-3">
                                <img id="img_id" src="#" alt="your image" style="height:100px;width: 150px"/>

                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Select hire date from calender"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h4 style="color:green">Family and Others Information</h4>

                    <div class="div-background">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Father's Name</label>

                            <div class="col-md-6">
                                <input type="text" name="FATHERS_NAME" id="FATHERS_NAME" value="" class="form-control"
                                       placeholder="Father's Name">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your father's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Mother's Name</label>

                            <div class="col-md-6">
                                <input type="text" name="MOTHERS_NAME" id="MOTHERS_NAME" value="" class="form-control"
                                       placeholder="Mother's Name">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your mother's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Home Phone</label>

                            <div class="col-md-6">
                                <input type="text" name="HOME_PHONE" id="HOME_PHONE" value=""
                                       class="form-control numbersOnly" placeholder="Home Phone">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your home phone no here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Mobile <span class="red">*</span></label>

                            <div class="col-md-6">
                                <input type="text" name="MOBILE" id="MOBILE" value="" class="form-control numbersOnly"
                                       placeholder="Mobile" required>
                                <span class="red"><?php echo form_error('MOBILE'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your valid mobile no here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Marital status</label>

                            <div class="col-md-1">
                                <input type="checkbox" name="MARITAL_STATUS" id="MARITAL_STATUS" class="form-control"/>
                            </div>
                            <div class="col-md-5">
                                <div id="SN" style="display:none">
                                    <input type="text" name="SPOUSE_NAME" id="SPOUSE_NAME" value="" class="form-control"
                                           placeholder="Spouse Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please select your marital ststus from here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Place of Birth</label>

                            <div class="col-md-6">
                                <input type="text" name="PLACE_OF_BIRTH" id="PLACE_OF_BIRTH" value=""
                                       class="form-control" placeholder="Place of Birth">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Enter your place name where are you born" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Passport No</label>

                            <div class="col-md-6">
                                <input type="text" name="PASSPORT_NO" id="PASSPORT_NO" value="" class="form-control"
                                       placeholder="Passport No">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Passport No"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Passport Issue Date</label>

                            <div class="col-md-6">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" id="DATE_OF_ISSUE" name="DATE_OF_ISSUE"
                                           class="form-control datepicker" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Select Passport Issue Date from calender" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group data_1">
                            <label class="col-md-2 control-label">Passport Expire Date</label>

                            <div class="col-md-6">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" id="EXPIRE_DATE" name="EXPIRE_DATE"
                                           class="form-control datepicker" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Select Passport Expire Date from calender" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Passport Issue Place</label>

                            <div class="col-md-6">
                                <input type="text" name="PLACE_OF_ISSUE" id="PLACE_OF_ISSUE" value=""
                                       class="form-control" placeholder="Passport Issue Place">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Passport Issue place"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Present Address <span class="red">*</span></label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="PRE_ADDRESS"
                                          required><?php echo set_value('PRE_ADDRESS'); ?></textarea>
                                <span class="red"><?php echo form_error('PRE_ADDRESS'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your present address here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Permanent Address <span class="red">*</span></label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="PER_ADDRESS"
                                          required><?php echo set_value('PER_ADDRESS'); ?></textarea>
                                <span class="red"><?php echo form_error('PER_ADDRESS'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Permanent address here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Contact Person</label>

                            <div class="col-md-6">
                                <input type="text" name="CONTACT_PERSON" id="CONTACT_PERSON" value=""
                                       class="form-control" placeholder="Contact Person">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Contact Person name"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Contact Person Address</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="CONTACT_PERSON_ADD"></textarea>

                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your present address here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Contact Person Mobile</label>

                            <div class="col-md-6">
                                <input type="text" name="CONTACT_PERSON_PHN" id="CONTACT_PERSON_PHN" value=""
                                       class=" numbersOnly form-control" placeholder="Contact Person Mobile">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Enter your Contact Person Mobile"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Relation</label>

                            <div class="col-md-6">
                                <input type="text" name="RELATION" id="RELATION" value="" class="form-control"
                                       placeholder="Relation">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Relation with contact person"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h4 style="color:green">Access Information</h4>

                    <div class="div-background">

                        <div class="form-group">
                            <label class="col-md-2 control-label">User Group <span class="red">*</span></label>

                            <div class="col-md-6">
                                <select name="user_group" id="user_group" class="form-control" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($user_group as $row) { ?>
                                        <option
                                            value="<?php echo $row->USERGRP_ID ?>"><?php echo $row->USERGRP_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('user_group'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your father's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">User Level<span class="red">*</span></label>

                            <div class="col-md-6">
                                <select name="user_group_lavel" id="user_group_lavel" class="form-control">
                                    <option value="">-Select-</option>
                                </select>

                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your father's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Faculty <span class="red">*</span></label>

                            <div class="col-md-6">
                                <select name="FACULTY_ID" id="FACULTY_ID" class="form-control" required>
                                    <option value="">-Select-</option>
                                    <?php foreach ($faculty as $row) { ?>
                                        <option
                                            value="<?php echo $row->FACULTY_ID ?>"><?php echo $row->FACULTY_NAME ?></option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('FACULTY_ID'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your father's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Department <span class="red">*</span></label>

                            <div class="col-md-6">
                                <select name="DEPT_ID" id="DEPT_ID" class="form-control" required>
                                    <option value="">-Select-</option>

                                </select>
                                <span class="red"><?php echo form_error('DEPT_ID'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your father's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Designation</label>

                            <div class="col-md-6">
                                <select name="designation" id="designation" class="form-control">
                                    <option value="">-Select-</option>
                                    <?php foreach ($designations as $row) { ?>
                                        <option
                                            value="<?php echo $row->DESIGNATION_ID ?>"><?php echo $row->DESIGNATION ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your father's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Bio-matric ID</label>

                            <div class="col-md-6">
                                <input type="text" name="BIOMETRIC_ID" id="BIOMETRIC_ID" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your father's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Office Phone</label>

                            <div class="col-md-6">
                                <input type="text" name="OFFICIAL_PHONE_NO" id="OFFICIAL_PHONE_NO"
                                       class="form-control numbersOnly">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter office phone no here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Office Phone Extension</label>

                            <div class="col-md-6">
                                <input type="text" name="OFFICIAL_PHONE_EXTENSION" id="OFFICIAL_PHONE_EXTENSION"
                                       class="form-control numbersOnly">
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter office phone no ex here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">User name <span class="red">*</span></label>

                            <div class="col-md-6">
                                <input type="text" name="USERNAME" id="USERNAME"
                                       value="<?php echo set_value('USERNAME'); ?>" class="form-control" required>
                                <span class="red"><?php echo form_error('USERNAME'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter user name here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">User Password <span class="red">*</span></label>

                            <div class="col-md-6">
                                <input type="text" name="USERPW" id="USERPW" value="<?php echo set_value('USERPW'); ?>"
                                       class="form-control" required>
                                <span class="red"><?php echo form_error('USERPW'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-info-circle pointer2" data-content="Please enter user password here"
                                   data-placement="right" data-toggle="popover" data-container="body"
                                   data-original-title="" title="Help"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Is Admin ?</label>

                            <div class="col-md-6">
                                <div class="pull-left">
                                    <input type="checkbox" name="IS_ADMIN" id="IS_ADMIN" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4  ">
                                <i class="fa fa-info-circle pointer2"
                                   data-content="Please enter your father's name here" data-placement="right"
                                   data-toggle="popover" data-container="body" data-original-title="" title="Help"></i>
                            </div>
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="reset" class="btn btn-white" value="Reset">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!--<script src="<?php //echo base_url();         ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>-->
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
</script>
<script>
    //    $('.data_1 .input-group.date').datepicker({
    //        todayBtn: "linked",
    //        keyboardNavigation: false,
    //        forceParse: false,
    //        calendarWeeks: true,
    //        autoclose: true
    //    });

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
    $(document).on('click', '#MARITAL_STATUS', function () {
        $("#SN").toggle();
    });
    //email validation 
    $(document).on('blur', '#EMAIL', function () {
        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str))
            $(".email_validation").html('Invalid Email address');
    });

    //alternat email validation 
    $(document).on('blur', '#ALT_EMAIL', function () {

        var str = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str))
            $(".ALT_EMAIL").html('Invalid Email address');
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


</script>