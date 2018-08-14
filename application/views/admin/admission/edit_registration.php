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
        border-radius: 10px
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
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Photo <span class="red">*</span></label>

                            <div class="col-md-3">
                                <div class="avatar-zone">
                                    <img id="img_id"
                                         src="<?php echo base_url(); ?>upload/<?php echo $previous_info->PHOTO ?>"
                                         alt="select photo" style="width: 180px;
                                         height: 160px;"/>
                                </div>
                                <div class="overlay-layer">Change photo</div>
                                <input type='file' name="photo" onchange="upload_img(this);" class="upload_btn">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="ibox-content">
                        <strong>NOTE : </strong> All <span class="red">*</span> field are required.
                        <h4 style="color:green">General Information</h4>

                        <div class="div-background">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name ( English )<span class="red">*</span></label>

                                <div class="col-md-3">
                                    <input type="text" name="STUDENT_NAME" id="STUDENT_NAME"
                                           value="<?php echo $previous_info->STUDENT_NAME; ?>" class="form-control"
                                           placeholder="Student Name" required>
                                    <input type="hidden" name="REGI_ID" id="REGI_ID"
                                           value="<?php echo $previous_info->REGI_ID; ?>" class="form-control">
                                    <span class="red"><?php echo form_error('STUDENT_NAME'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your first name here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">নাম ( বাংলা )<span class="red">*</span></label>

                                <div class="col-md-3">
                                    <input type="text" name="STUDENT_NAME_BN" id="STUDENT_NAME_BN"
                                           value="<?php echo $previous_info->STUDENT_NAME_BN; ?>" class="form-control"
                                           placeholder="বাংলা নাম" required>
                                    <span class="red"><?php echo form_error('STUDENT_NAME_BN'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your Full name (বাংলা) here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="EMAIL" id="EMAIL"
                                           value="<?php echo $previous_info->EMAIL; ?>" class="form-control checkEmail"
                                           placeholder="Email" required>
                                    <span class="red email_validation"><?php echo form_error('EMAIL'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your valid email address here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mobile <span class="red">*</span></label>

                                <div class="col-md-3">
                                    <input type="text" name="PHONE" id="PHONE"
                                           value="<?php echo $previous_info->PHONE; ?>" class="form-control numbersOnly"
                                           placeholder="+880" required>
                                    <span class="red"><?php echo form_error('PHONE'); ?></span>
                                </div>
                                <div class="col-md-1">
                                    <i style="cursor:pointer" class="fa fa-plus" id="add_mobile"></i>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your valid mobile no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>

                                <div class="col-md-3">
                                    <table id="mobile_list">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">National ID</label>

                                <div class="col-md-3">
                                    <input type="text" name="NID" id="NID" value="<?php echo $previous_info->NID; ?>"
                                           class="form-control" placeholder="National ID">
                                    <span class="red"></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your natinal indentity number here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Birth Date <span class="red">*</span></label>

                                <div class="col-md-3">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="DOB" id="dob"
                                               value="<?php echo date('Y-m-d', strtotime($previous_info->DOB)) ?>"
                                               class="form-control datepicker" value="<?php echo set_value('DOB'); ?>"
                                               required>

                                    </div>
                                    <span class="red"><?php echo form_error('DOB'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select birth date from calender"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Gender <span class="red">*</span></label>

                                <div class="col-md-2">
                                    <select class="form-control" name="GENDER" id="GENDER" required>
                                        <option value="">-Select-</option>
                                        <option value="M"
                                            <?php
                                            if ('M' == $previous_info->GENDER) {
                                                echo "selected";
                                            } else {
                                                echo "";
                                            }
                                            ?>>Male
                                        </option>
                                        <option value="F" <?php
                                        if ('F' == $previous_info->GENDER) {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        }
                                        ?>>Female
                                        </option>
                                        <option value="O" <?php
                                        if ('O' == $previous_info->GENDER) {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        }
                                        ?>>Others
                                        </option>
                                    </select>
                                    <span class="red"><?php echo form_error('GENDER'); ?></span>

                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Please select your gender"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Religion <span class="red">*</span></label>

                                <div class="col-md-2">
                                    <select class="form-control" name="RELIGION" id="RELIGION" required>
                                        <option value="">-Select-</option>
                                        <option value="I" <?php
                                        if ('I' == $previous_info->RELIGION) {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        }
                                        ?>>Islam
                                        </option>
                                        <option value="H" <?php
                                        if ('H' == $previous_info->RELIGION) {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        }
                                        ?>>Hindusm
                                        </option>
                                        <option value="B" <?php
                                        if ('B' == $previous_info->RELIGION) {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        }
                                        ?>>Buddhist
                                        </option>
                                        <option value="C" <?php
                                        if ('C' == $previous_info->RELIGION) {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        }
                                        ?>>Cristian
                                        </option>
                                        <option value="O" <?php
                                        if ('O' == $previous_info->RELIGION) {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        }
                                        ?>>Others
                                        </option>
                                    </select>
                                    <span class="red"><?php echo form_error('RELIGION'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select your religion"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nationality <span class="red">*</span></label>

                                <div class="col-md-3">
                                    <select class="form-control" name="NATIONALITY" id="NATIONALITY" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($nationality as $row) { ?>
                                            <option
                                                value="<?php echo $row->id ?>"<?php echo ($row->id == $previous_info->NATIONALITY) ? 'selected' : ''; ?>><?php echo $row->nationality ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="red"><?php echo form_error('NATIONALITY'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select your nationality"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Passport No</label>

                                <div class="col-md-3">
                                    <input type="text" name="PASSPORT" id="PASSPORT"
                                           value="<?php echo $previous_info->PASSPORT; ?>" class="form-control"
                                           placeholder="Passport No">
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Enter your Passport No"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                        </div>
                        <br><br>

                        <h4 style="color:green">Family and Others Information</h4>

                        <div class="div-background">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Father's Name <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="FATHER" id="FATHER"
                                           value="<?php echo $previous_info->FATHER; ?>" class="form-control"
                                           placeholder="Father's Name" required>
                                    <span class="red"><?php echo form_error('FATHER'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your father's name here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Father's Occupation</label>

                                <div class="col-md-3">
                                    <select class="form-control" name="FATHER_OCU" id="FATHER_OCU">
                                        <option value="">-Select-</option>
                                        <?php foreach ($occupation as $row) { ?>
                                            <option
                                                value="<?php echo $row->LKP_ID ?>"<?php echo ($row->LKP_ID == $previous_info->LKP_NAME) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your Father Occupation here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Father's Mobile </label>

                                <div class="col-md-3">
                                    <input type="text" name="FATHER_PHN" id="FATHER_PHN"
                                           value="<?php echo $previous_info->FATHER_PHN; ?>"
                                           class="form-control numbersOnly" placeholder="+880">
                                </div>
                                <div class="col-md-1">
                                    <i style="cursor:pointer" class="fa fa-plus" id="father_mobile"></i>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your Father valid mobile no here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>

                                <div class="col-md-3">
                                    <table id="fmobile_list">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email </label>

                                <div class="col-md-4">
                                    <input type="text" name="FATHER_EMAIL" id="FATHER_EMAIL"
                                           value="<?php echo $previous_info->FATHER_EMAIL; ?>"
                                           class="form-control checkEmail" placeholder="Father Email">
                                    <span class="red email_validation"></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your father valid email address here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mother's Name<span class="red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="MOTHER" id="MOTHER"
                                           value="<?php echo $previous_info->MOTHER; ?>" class="form-control"
                                           placeholder="Mother's Name" required>
                                    <span class="red"><?php echo form_error('MOTHER'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your mother's name here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mother's Occupation</label>

                                <div class="col-md-3">
                                    <select class="form-control" name="MOTHER_OCU" id="MOTHER_OCU">
                                        <option value="">-Select-</option>
                                        <?php foreach ($occupation as $row) { ?>
                                            <option
                                                value="<?php echo $row->LKP_ID ?>"<?php echo ($row->LKP_ID == $previous_info->LKP_NAME) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your mother's name here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mother's Mobile</label>

                                <div class="col-md-3">
                                    <input type="text" name="MOTHER_PHN" id="MOTHER_PHN"
                                           value="<?php echo $previous_info->MOTHER_PHN; ?>"
                                           class="form-control numbersOnly" placeholder="+880">
                                </div>
                                <div class="col-md-1">
                                    <i style="cursor:pointer" class="fa fa-plus" id="mother_mobile"></i>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your mother's valid mobile no here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>

                                <div class="col-md-3">
                                    <table id="mmobile_list">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mother's Email </label>

                                <div class="col-md-4">
                                    <input type="text" name="MOTHER_EMAIL" id="MOTHER_EMAIL"
                                           value="<?php echo $previous_info->MOTHER_EMAIL; ?>"
                                           class="form-control checkEmail" placeholder="Mother'sEmail">
                                    <span class="red email_validation"></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your mother's valid email address here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Present Address <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <textarea class="form-control" name="PRES_ADDRESS"
                                              required><?php echo $previous_info->PRES_ADDRESS; ?></textarea>
                                    <span class="red"><?php echo form_error('PRES_ADDRESS'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Enter your present address here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Permanent Address <span
                                        class="red">*</span></label>

                                <div class="col-md-4">
                                    <textarea class="form-control" name="PARM_ADDRESS"
                                              required><?php echo $previous_info->PARM_ADDRESS; ?></textarea>
                                    <span class="red"><?php echo form_error('PARM_ADDRESS'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Enter your Permanent address here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Local Guardian Name</label>

                                <div class="col-md-4">
                                    <input type="text" name="LOCAL_GAR_NAME" id="LOCAL_GAR_NAME"
                                           value="<?php echo $previous_info->LOCAL_GAR_NAME; ?>" class="form-control"
                                           placeholder="Local Guardian Name">
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Enter your Local Guardian Name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Local Guardian Relation</label>

                                <div class="col-md-3">
                                    <select class="form-control" name="LOCAL_GAR_RELATION" id="LOCAL_GAR_RELATION">
                                        <option value="">-Select-</option>
                                        <?php foreach ($relation as $row) { ?>
                                            <option
                                                value="<?php echo $row->LKP_ID ?>"<?php echo ($row->LKP_ID == $previous_info->LKP_NAME) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Select your Local Guardian Name"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Local Guardian Address </label>

                                <div class="col-md-4">
                                    <textarea class="form-control"
                                              name="LOCAL_GAR_ADDRESS"><?php echo $previous_info->LOCAL_GAR_ADDRESS; ?></textarea>

                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Enter your Permanent address here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Local Guardian Mobile</label>

                                <div class="col-md-3">
                                    <input type="text" name="LOCAL_GAR_PHN" id="LOCAL_GAR_PHN"
                                           value="<?php echo $previous_info->LOCAL_GAR_PHN; ?>"
                                           class="form-control numbersOnly" placeholder="+880">
                                </div>
                                <div class="col-md-1">
                                    <i style="cursor:pointer" class="fa fa-plus" id="loc_gar_mobile"></i>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your Local Guardian valid mobile no here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>

                                <div class="col-md-3">
                                    <table id="loc_gar_mob_list">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Emergency Contact Person</label>

                                <div class="col-md-4">
                                    <input type="text" name="EMER_PER_NAME" id="EMER_PER_NAME"
                                           value="<?php echo $previous_info->EMER_PER_NAME; ?>" class="form-control"
                                           placeholder="Local Guardian Name">
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Enter your Emergency Contact Person Name" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Emergency Person Relation</label>

                                <div class="col-md-3">
                                    <select class="form-control" name="EMER_PER_RELATION" id="EMER_PER_RELATION">
                                        <option value="">-Select-</option>
                                        <?php foreach ($relation as $row) { ?>
                                            <option
                                                value="<?php echo $row->LKP_ID ?>"<?php echo ($row->LKP_ID == $previous_info->LKP_NAME) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Select Emergency Contact Person  relation" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Emergency Contact Person Address </label>

                                <div class="col-md-4">
                                    <textarea class="form-control"
                                              name="EMER_PER_ADDRESS"><?php echo $previous_info->EMER_PER_ADDRESS; ?></textarea>

                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Enter Emergency Contact Person address here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Emergency Contact Person Mobile</label>

                                <div class="col-md-3">
                                    <input type="text" name="EMER_PER_PHN" id="EMER_PER_PHN"
                                           value="<?php echo $previous_info->EMER_PER_PHN; ?>"
                                           class="form-control numbersOnly" placeholder="+880">
                                </div>
                                <div class="col-md-1">
                                    <i style="cursor:pointer" class="fa fa-plus" id="emerg_mobile"></i>
                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter Emergency Contact Person valid mobile no here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>

                                <div class="col-md-3">
                                    <table id="emerg_mobi_list">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br><br>

                        <h4 style="color: green">Academic information</h4>

                        <div class="div-background">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <table class="table table-bordered dataTable">
                                        <thead>
                                        <tr>
                                            <th>Exam Name<span style="color: red">*</span></th>
                                            <th>Board<span style="color: red">*</span></th>
                                            <th>Group<span style="color: red">*</span></th>
                                            <th>Year<span style="color: red">*</span></th>
                                            <th>GPA<span style="color: red">*</span></th>
                                            <th>Institute<span style="color: red">*</span></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control" name="EXAM_NAME" id="EXAM_NAME" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($exam_name as $row) { ?>
                                                        <option
                                                            value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="BOARD" id="BOARD" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($board_name as $row) { ?>
                                                        <option
                                                            value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="GROUP" id="GROUP" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($group_name as $row) { ?>
                                                        <option
                                                            value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input style="width: 50px" type="text" name="PASSING_YEAR"
                                                       class="numbersOnly" id="PASSING_YEAR" placeholder="Year"
                                                       required>
                                            </td>
                                            <td>
                                                <input style="width: 50px" type="text" name="GPA" id="GPA"
                                                       class="numbersOnly" placeholder="GPA" required>
                                            </td>
                                            <td>
                                                <input type="text" name="INSTITUTE" id="INSTITUTE"
                                                       placeholder="Institute Name" required>
                                            </td>
                                            <td>
                                                <div class="col-md-1">
                                                    <i style="cursor:pointer" class="fa fa-plus" id="add_academic"></i>
                                                </div>
                                                <div class="col-md-1">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="please fill all field with your valid academic info"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title="" title="Help"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table id="academic_list" class="table">
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Attach file</label>

                                    <div class="col-md-3">
                                        <input type="file" name="ATTACHMENT" id="ATTACHMENT">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>

                        <h4 style="color: green">Department</h4>

                        <div class="div-background">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Admission Year<span class="red">*</span></label>

                                <div class="col-md-2">
                                    <input type="text" name="ADMISSION_YEAR" id="ADMISSION_YEAR"
                                           value="<?php echo $previous_info->ADMISSION_YEAR; ?>" placeholder="Year"
                                           class="form-control" required>
                                    <span class="red"><?php echo form_error('ADMISSION_YEAR'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter admission year here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Session<span class="red">*</span></label>

                                <div class="col-md-3">
                                    <select class="form-control" name="SESSION" id="SESSION" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($session as $row) { ?>
                                            <option
                                                value="<?php echo $row->SESSION_ID ?>"<?php echo ($row->SESSION_ID == $previous_info->SESSION_NAME) ? 'selected' : ''; ?>><?php echo $row->SESSION_NAME ?></option>
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
                                <label class="col-md-3 control-label">Faculty<span class="red">*</span></label>

                                <div class="col-md-4">
                                    <select class="form-control" name="FACULTY" id="FACULTY" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($faculty as $row) { ?>
                                            <option
                                                value="<?php echo $row->FACULTY_ID ?>"<?php echo ($row->FACULTY_ID == $previous_info->FACULTY_NAME) ? 'selected' : ''; ?>><?php echo $row->FACULTY_NAME ?></option>
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
                                <label class="col-md-3 control-label">Department<span class="red">*</span></label>

                                <div class="col-md-4">
                                    <select class="form-control" name="DEPT_ID" id="DEPT_ID" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($department as $row) { ?>
                                            <option
                                                value="<?php echo $row->DEPT_ID ?>" <?php echo ($row->DEPT_ID == $previous_info->DEPT_ID) ? 'selected' : ''; ?>><?php echo $row->DEPT_NAME ?></option>
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
                                <label class="col-md-3 control-label">Program<span class="red">*</span></label>

                                <div class="col-md-4">
                                    <select class="form-control" name="PROGRAM_ID" id="PROGRAM_ID" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($program as $row) { ?>
                                            <option
                                                value="<?php echo $row->PROGRAM_ID ?>" <?php echo ($row->PROGRAM_ID == $previous_info->PROGRAM_NAME) ? 'selected' : ''; ?>><?php echo $row->PROGRAM_NAME ?></option>
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
                                <label class="col-md-3 control-label">Semester<span class="red">*</span></label>

                                <div class="col-md-3">
                                    <select class="form-control" name="SEMESTER" id="SEMESTER" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($semester as $row) { ?>
                                            <option
                                                value="<?php echo $row->LKP_ID ?>"<?php echo ($row->LKP_ID == $previous_info->LKP_NAME) ? 'selected' : ''; ?>><?php echo $row->LKP_NAME ?></option>
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

                        <h4 style="color: green">Payment</h4>

                        <div class="div-background">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Bank Receipt No.<span style="color: red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="BANK_RECEIPT" id="BANK_RECEIPT"
                                           value="<?php echo $previous_info->BANK_RECEIPT; ?>"
                                           placeholder="Bank Receipt No" class="form-control" required>
                                    <span class="red"><?php echo form_error('BANK_RECEIPT'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your bank receipt no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                        </div>
                        <br><br>

                        <h4 style="color: green">Other</h4>

                        <div class="div-background">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Guardians Income</label>

                                <div class="col-md-4">
                                    <input type="text" name="GAR_INCOME_STATUS" id="GAR_INCOME_STATUS"
                                           placeholder="Guardian Income"
                                           value="<?php echo $previous_info->GAR_INCOME_STATUS; ?>"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your gurdian income here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Has Weaver</label>

                                <div class="col-md-1">
                                    <div class="pull-left">
                                        <input type="checkbox" name="HAS_WEAVER" id="HAS_WEAVER" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3  ">
                                    <i class="fa fa-info-circle pointer2" data-content="Please Check "
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Weaver Percent</label>

                                <div class="col-md-4">
                                    <input type="text" name="WEAVER_PERCENTAGE" id="WEAVER_PERCENTAGE"
                                           placeholder="weaver percent"
                                           value="<?php echo $previous_info->WEAVER_PERCENTAGE; ?>"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter weaver percent here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Weaver Reason</label>

                                <div class="col-md-4">
                                    <input type="text" name="WEAVER_REASON" id="WEAVER_REASON"
                                           value="<?php echo $previous_info->WEAVER_REASON; ?>"
                                           placeholder="weaver reason" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2" data-content="Please enter weaver reson here"
                                       data-placement="right" data-toggle="popover" data-container="body"
                                       data-original-title="" title="Help"></i>
                                </div>
                            </div>
                        </div>
                        <br><br>

                        <h4 style="color:green">Access Information</h4>

                        <div class="div-background">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Application sl no</label>

                                <div class="col-md-4">
                                    <input type="text" name="APPLICATION_SL" id="APPLICATION_SL"
                                           value="<?php echo $previous_info->APPLICATION_SL; ?>"
                                           placeholder="Application sl no" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter Application sl. no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Existing Reg No.</label>

                                <div class="col-md-4">
                                    <input type="text" name="EXISTING_REG_NO" id="EXISTING_REG_NO"
                                           placeholder="Existing Reg No."
                                           value="<?php echo $previous_info->EXISTING_REG_NO; ?>" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-info-circle pointer2"
                                       data-content="Please enter your existing reg no here" data-placement="right"
                                       data-toggle="popover" data-container="body" data-original-title=""
                                       title="Help"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">User name <span class="red">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" name="USERNAME" id="USERNAME"
                                           value="<?php echo $previous_info->USERNAME; ?>" placeholder="User name"
                                           class="form-control" required>
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

                                <div class="col-md-6">
                                    <input type="text" name="USERPW" id="USERPW"
                                           value="<?php echo $previous_info->USERPW; ?>" placeholder="User Password"
                                           class="form-control" required>
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
                            <div class="col-sm-3  pull-right">
                                <input type="submit" class="btn btn-primary" value="Save">
                                <input type="reset" class="btn btn-white" value="Reset">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!--<script src="<?php //echo base_url();       ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>-->
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
        if (!re.test(str)) {
            $(".email_validation").html('Invalid Email address');
        } else {
            $(".email_validation").html('');
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
    // for applicant mobile
    $(document).on('click', '#add_mobile', function (e) {
        e.preventDefault();
        $("#mobile_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="MOBILE" id="MOBILE" value="" class="form-control numbersOnly" placeholder="+880" required>' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for father mobile
    $(document).on('click', '#father_mobile', function (e) {
        e.preventDefault();
        $("#fmobile_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="MOBILE" id="MOBILE" value="" class="form-control numbersOnly" placeholder="+880" required>' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for mother mobile
    $(document).on('click', '#mother_mobile', function (e) {
        e.preventDefault();
        $("#mmobile_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="MOBILE" id="MOBILE" value="" class="form-control numbersOnly" placeholder="+880" required>' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for Guardian mobile
    $(document).on('click', '#loc_gar_mobile', function (e) {
        e.preventDefault();
        $("#loc_gar_mob_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="MOBILE" id="MOBILE" value="" class="form-control numbersOnly" placeholder="+880" required>' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times remove"></i>' +
        ' </td> ' +
        '</tr>');

    });
    // for Emergency mobile
    $(document).on('click', '#emerg_mobile', function (e) {
        e.preventDefault();
        $("#emerg_mobi_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="MOBILE" id="MOBILE" value="" class="form-control numbersOnly" placeholder="+880" required>' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times remove"></i>' +
        ' </td> ' +
        '</tr>');

    });

    $(document).on('click', '.remove', function () {
        $(this).closest('tr').remove();
    });
    // append academic info table
    $(document).on('click', '#add_academic', function () {
        var EXAM_ID = $('#EXAM_NAME :selected').val();
        var EXAM_NAME = $('#EXAM_NAME :selected').text();
        var BOARD_ID = $('#BOARD :selected').val();
        var BOARD_NAME = $('#BOARD :selected').text();
        var GROUP_ID = $('#GROUP :selected').val();
        var GROUP_NAME = $('#GROUP :selected').text();
        var PASSING_YEAR = $("#PASSING_YEAR").val();
        var GPA = $("#GPA").val();
        var INSTITUTE = $("#INSTITUTE").val();
        var selected_exam = 'N';
        $('.EXAM_NAME').each(function () {
            var selected_exam_value = $(this).val();
            if (selected_exam_value == EXAM_ID) {
                selected_exam = 'Y'
            }
        });
        if (selected_exam == 'Y') {
            alert('already exits');
        } else {
            $("#academic_list tbody").append('<tr> ' +
            ' <td ><input type="hidden" name="EXAM_NAME[]"  value="' + EXAM_ID + '" class="form-control EXAM_NAME">' + EXAM_NAME + '</td>' +
            ' <td><input type="hidden" name="BOARD[]"  value="' + BOARD_ID + '" class="form-control">' + BOARD_NAME + '</td>' +
            ' <td><input type="hidden" name="GROUP[]"  value="' + GROUP_ID + '" class="form-control">' + GROUP_NAME + '</td>' +
            ' <td><input type="hidden" name="PASSING_YEAR[]" value="' + PASSING_YEAR + '" class="form-control">' + PASSING_YEAR + '</td>' +
            ' <td><input type="hidden" name="GPA[]" value="' + GPA + '" class="form-control">' + GPA + ' </td>' +
            ' <td><input type="hidden" name="INSTITUTE[]" value="' + INSTITUTE + '" class="form-control">' + INSTITUTE + '</td>' +
            ' <td><i style="cursor:pointer" class="fa fa-times remove"></i></td>' +
            '</tr>');
            $('#EXAM_NAME').val('');
            $('#BOARD').val('');
            $('#GROUP').val('');
            $("#PASSING_YEAR").val('');
            $("#GPA").val('');

        }
    });
    // get department by change faculty 
    // get program by change faculty
    $(document).on('change', '#FACULTY', function () {
        var faculty_id = $(this).val();
        var url = '<?php echo site_url('admission/departmentByFaculty'); ?>';
        var url1 = '<?php echo site_url('admission/programByFaculty') ?>';
        $.ajax({
            type: 'POST',
            url: url,
            data: {faculty_id: faculty_id},
            success: function (data) {
                $('#DEPT_ID').html(data);
            }
        });
        $.ajax({
            type: 'POST',
            url: url1,
            data: {faculty_id: faculty_id},
            success: function (data) {
                $('#PROGRAM_ID').html(data);
            }
        });
    });
    // get program by change department 
    $(document).on('change', '#DEPT_ID', function () {
        var department_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admission/programByDepartment'); ?>',
            data: {department_id: department_id},
            success: function (data) {
                $('#PROGRAM_ID').html(data);
            }
        });
    });
</script>
