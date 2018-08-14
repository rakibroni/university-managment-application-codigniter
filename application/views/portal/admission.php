<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/jquery-ui.datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/keyboard/keyboard.css" rel="stylesheet">

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

    #foreign {
        display: none;
    }
</style>

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

    .toggle-div1 {
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 10px;
    }
</style>
<style type="text/css">
    /* Admission banner */
    .admisstion_banner {
        padding-top: 80px;
        background-image: url("<?php echo base_url(); ?>assets/img/admission-banner.jpg");
        background-size: 100%;
        padding-bottom: 100px;
    }


</style>
<link href="<?php echo base_url(); ?>assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">

<section class="admisstion_banner"></section>

<section class="features" style="background:#f3f3f4;">
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-2">

            </div>
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="pull-left">
                            <h2>
                                Application Form
                            </h2>
                        </div>
                        <div class="pull-right"><a
                                href="<?php echo base_url(); ?>portal/portalDegree/<?php //echo $degree_id; ?>"
                                class="badge badge-danger"><i class="fa fa-arrow-circle-left"></i> Previous </a></div>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                            <div class="ibox-content">
                                <strong>NOTE : </strong> All <span class="red">*</span> field are required.
                                <h4 style="color:green">Personal Information</h4>

                                <div class="div-background">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Name ( English )<span
                                                    class="red">*</span></label>

                                            <div class="col-md-2">
                                                <input type="text" name="FIRST_NAME" id="FIRST_NAME"
                                                       value="<?php echo set_value('FIRST_NAME') ?>"
                                                       class="form-control" placeholder="First" required>
                                                <span class="red"><?php echo form_error('FIRST_NAME'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="MIDDLE_NAME" id="MIDDLE_NAME"
                                                       value="<?php echo set_value('MIDDLE_NAME') ?>"
                                                       class="form-control" placeholder="Middle">
                                                <span class="red"><?php echo form_error('MIDDLE_NAME'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="LAST_NAME" id="LAST_NAME"
                                                       value="<?php echo set_value('LAST_NAME') ?>" class="form-control"
                                                       placeholder="Last" required>
                                                <span class="red"><?php echo form_error('LAST_NAME'); ?></span>
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
                                                       value="<?php echo set_value('FULL_NAME_BN') ?>"
                                                       class="form-control keyboardInput" placeholder="বাংলা নাম"
                                                       required>
                                                <span class="red"><?php echo form_error('FULL_NAME_BN'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="বাংলায় আপনার  নাম লিখুন" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Date of Birth<span
                                                    class="red">*</span></label>

                                            <div class="col-md-3">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span>
                                                    <input type="text" name="DATH_OF_BIRTH" id="DATH_OF_BIRTH"
                                                           class="form-control datepicker"
                                                           value="<?php echo set_value('DATH_OF_BIRTH'); ?>"
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
                                            <label class="col-md-5 control-label">Place of Birth<span
                                                    class="red">*</span></label>

                                            <div class="col-md-5">
                                                <div class="input-group date">
                                                    <input type="text" name="PLACE_OF_BIRTH" id="PLACE_OF_BIRTH"
                                                           class="form-control"
                                                           value="<?php echo set_value('PLACE_OF_BIRTH'); ?>"
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
                                            <label class="col-md-5 control-label">Blood Group<span class="red">*</span></label>

                                            <div class="col-md-5">
                                                <div class="input-group date">
                                                    <select name="BLOOD_GRP" class="form-control" required>
                                                        <option value="">-Select-</option>
                                                        <?php foreach ($blood_group as $row): ?>
                                                            <option
                                                                value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <span class="red"><?php echo form_error('BLOOD_GRP'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select your blood group" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Gender <span
                                                    class="red">*</span></label>

                                            <div class="col-md-5">
                                                <input type="radio" name="GENDER" value="M" checked>&nbsp; Male &nbsp;
                                                <input type="radio" name="GENDER" value="F"> &nbsp;Female &nbsp; <input
                                                    type="radio" name="GENDER" value="O">&nbsp; Others
                                                <span class="red"><?php echo form_error('GENDER'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please select your gender" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Marital Status<span
                                                    class="red">*</span></label>

                                            <div class="col-md-3">
                                                <select class="form-control" name="MARITAL_STATUS" id="marital_status"
                                                        required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($merital_status as $row): ?>
                                                        <option
                                                            value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="red"><?php echo form_error('MARITAL_STATUS'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please select your merital status"
                                                   data-placement="right" data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div style="display:none" id="spouse_name">
                                            <div class="form-group">
                                                <label class="col-md-5 control-label">Spouse Name <span
                                                        class="red">*</span></label>

                                                <div class="col-md-5">
                                                    <input type="text" class="is_required_s" name="SPOUSE_NAME"
                                                           id="SPOUSE_NAME" placeholder="Spouse Name"
                                                           value="<?php echo set_value('SPOUSE_NAME'); ?>">
                                                    <span class="red"><?php echo form_error('SPOUSE_NAME'); ?></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <i class="fa fa-info-circle pointer2"
                                                       data-content="Please enter your spouse name here"
                                                       data-placement="right" data-toggle="popover"
                                                       data-container="body" data-original-title="" title="Help"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Nationality <span class="red">*</span></label>

                                            <div class="col-md-5">
                                                <select class="form-control" name="NATIONALITY" id="NATIONALITY"
                                                        required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($nationality as $row) { ?>
                                                        <option
                                                            value="<?php echo $row->id ?>" <?php echo ($row->id == 15) ? 'selected' : ''; ?>><?php echo $row->nationality ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="red"><?php echo form_error('NATIONALITY'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select your nationality" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">National ID</label>

                                            <div class="col-md-5">
                                                <input type="text" name="NATIONAL_ID" id="NATIONAL_ID"
                                                       value="<?php echo set_value('NATIONAL_ID'); ?>"
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
                                                <input type="text" name="PASSPORT" id="PASSPORT" value=""
                                                       class="form-control" placeholder="Passport No">
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Enter your Passport No" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Email <span
                                                    class="red">*</span></label>

                                            <div class="col-md-4">
                                                <input type="text" name="EMAIL_ADRESS[]" id="EMAIL"
                                                       value="<?php echo set_value('EMAIL_ADRESS'); ?>"
                                                       class="form-control checkEmail" placeholder="Email" required>
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
                                                   data-placement="right" data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label"></label>

                                            <div class="col-md-4">
                                                <table id="email_list">
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Mobile <span
                                                    class="red">*</span></label>

                                            <div class="col-md-4">
                                                <input type="text" name="MOBILE_NO[]" id="PHONE"
                                                       value="<?php echo set_value('MOBILE_NO'); ?>"
                                                       class="form-control numbersOnly" placeholder="Mobile" required>
                                                <span
                                                    class="red"><?php //echo form_error('MOBILE_NO');                                     ?></span>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-xs btn-info" id="add_mobile"><i
                                                        style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please enter your  mobile no here"
                                                   data-placement="right" data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label"></label>

                                            <div class="col-md-4">
                                                <table id="mobile_list">
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Religion <span
                                                    class="red">*</span></label>

                                            <div class="col-md-3">
                                                <select class="form-control" name="RELIGION_ID" id="RELIGION_ID"
                                                        required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($religion as $row): ?>
                                                        <option
                                                            value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="red"><?php echo form_error('RELIGION'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select your religion" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Height</label>

                                            <div class="col-md-1" style="padding-right: 0;">
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
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Please input your hieght" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Weight</label>

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
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="please input your weight" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="pull-right" style="margin-right: 60px">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <div class="avatar-zone">
                                                        <img id="img_id"
                                                             src="<?php echo base_url('assets/img/default.png'); ?>"
                                                             alt="select photo" style="width: 180px;
                                                 height: 160px;"/>
                                                    </div>
                                                    <div class="overlay-layer">Upload photo</div>
                                                    <input type='file' name="photo" onchange="upload_img(this);"
                                                           class="upload_btn" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <br><br>
                                <h4 style="color:green">Family and Others Information</h4>

                                <div class="div-background">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Father's Name <span
                                                class="red">*</span></label>

                                        <div class="col-md-3">
                                            <input type="text" name="FATHER_NAME" id="FATHER_NAME"
                                                   value="<?php echo set_value('FATHER_NAME'); ?>" class="form-control"
                                                   placeholder="Father's Name" required>
                                            <span class="red"><?php echo form_error('FATHER_NAME'); ?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Please enter your father's name here"
                                               data-placement="right" data-toggle="popover" data-container="body"
                                               data-original-title="" title="Help"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Father's Occupation</label>

                                        <div class="col-md-2">
                                            <select class="form-control" name="FATHER_OCU" id="FATHER_OCU">
                                                <option value="">-Select-</option>
                                                <?php foreach ($occupation as $row) { ?>
                                                    <option
                                                        value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Please enter your Father Occupation here"
                                               data-placement="right" data-toggle="popover" data-container="body"
                                               data-original-title="" title="Help"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Father's Mobile </label>

                                        <div class="col-md-2">
                                            <input type="text" name="FATHER_PHN[]" id="FATHER_PHN" value=""
                                                   class="form-control numbersOnly" placeholder="Father's Phone">
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-xs btn-info" id="add_mobile_f"> <i
                                                    style="cursor:pointer" class="fa fa-plus"></i></span>
                                        </div>

                                        <div class="col-md-1">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Please enter your Father's  mobile no here"
                                               data-placement="right" data-toggle="popover" data-container="body"
                                               data-original-title="" title="Help"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>

                                        <div class="col-md-3">
                                            <table id="mobile_list_f">
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Father's Email </label>

                                        <div class="col-md-2">
                                            <input type="text" name="FATHER_EMAIL[]" id="FATHER_EMAIL"
                                                   value="<?php echo set_value('FATHER_EMAIL'); ?>"
                                                   class="form-control checkEmail" placeholder="Father's Email">
                                            <span class="red father_email_validation"></span>
                                        </div>
                                        <div class="col-md-1">

                                            <span class="btn btn-xs btn-info" id="add_email_f"> <i
                                                    style="cursor:pointer" class="fa fa-plus"></i></span>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Please enter your father's valid email address here"
                                               data-placement="right" data-toggle="popover" data-container="body"
                                               data-original-title="" title="Help"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>

                                        <div class="col-md-3">
                                            <table id="email_list_f">
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Mother's Name<span
                                                class="red">*</span></label>

                                        <div class="col-md-3">
                                            <input type="text" name="MOTHER_NAME" id="MOTHER_NAME"
                                                   value="<?php echo set_value('MOTHER_NAME'); ?>" class="form-control"
                                                   placeholder="Mother's Name" required>
                                            <span class="red"><?php echo form_error('MOTHER_NAME'); ?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Please enter your mother's name here"
                                               data-placement="right" data-toggle="popover" data-container="body"
                                               data-original-title="" title="Help"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Mother's Occupation</label>

                                        <div class="col-md-2">
                                            <select class="form-control" name="MOTHER_OCU" id="MOTHER_OCU">
                                                <option value="">-Select-</option>
                                                <?php foreach ($occupation as $row) { ?>
                                                    <option
                                                        value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Please enter your mother's occupation here"
                                               data-placement="right" data-toggle="popover" data-container="body"
                                               data-original-title="" title="Help"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Mother's Mobile</label>

                                        <div class="col-md-2">
                                            <input type="text" name="MOTHER_PHN[]" id="MOTHER_PHN" value=""
                                                   class="form-control numbersOnly" placeholder="Mother's Phone">
                                        </div>
                                        <div class="col-md-1">

                                            <span class="btn btn-xs btn-info" id="add_mobile_m"> <i
                                                    style="cursor:pointer" class="fa fa-plus"></i></span>
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
                                            <table id="mobile_list_m">
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Mother's Email </label>

                                        <div class="col-md-2">
                                            <input type="text" name="MOTHER_EMAIL[]" id="MOTHER_EMAIL"
                                                   value="<?php echo set_value('MOTHER_EMAIL'); ?>"
                                                   class="form-control checkEmail" placeholder="Mother's Email">
                                            <span class="red mother_email_validation"></span>
                                        </div>
                                        <div class="col-md-1">

                                            <span class="btn btn-xs btn-info" id="add_email_m"> <i
                                                    style="cursor:pointer" class="fa fa-plus"></i></span>
                                        </div>
                                        <div class="col-md-1">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Please enter your mother's valid email address here"
                                               data-placement="right" data-toggle="popover" data-container="body"
                                               data-original-title="" title="Help"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>

                                        <div class="col-md-3">
                                            <table id="email_list_m">
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Present Address <span class="red">*</span></label>

                                        <div class="col-md-1">
                                            <!--                                    <input type="checkbox" name="PRES_ADDRESS" value="" id="PRES_ADDRESS" required>-->

                                        </div>
                                    </div>
                                    <div id="present_address" class="toggle-div1">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Division</label>

                                            <div class="col-md-3">
                                                <select name="DIVISION_ID" id="DIVISION_ID" class="form-control"
                                                        required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($division as $rd) { ?>
                                                        <option
                                                            value="<?php echo $rd->DIVISION_ID ?>"><?php echo $rd->DIVISION_ENAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select division name" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">District</label>

                                            <div class="col-md-3">
                                                <select name="DISTRICT_ID" id="DISTRICT_ID" class="form-control"
                                                        required>
                                                    <option value="">-Select-</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select district name" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Upazila/Thana</label>

                                            <div class="col-md-3">
                                                <select name="THANA_ID" id="THANA_ID" class="form-control" required>
                                                    <option value="">-Select-</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select upazila or thana name" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Police Station</label>

                                            <div class="col-md-3">
                                                <select name="POLICE_STATION_ID" id="POLICE_STATION_ID"
                                                        class="form-control" required>
                                                    <option value="">-Select-</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select police station" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Union/Ward No.</label>

                                            <div class="col-md-3">
                                                <select name="UNION_ID" id="UNION_ID" class="form-control" required>
                                                    <option value="">-Select-</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select ward or union" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Post office</label>

                                            <div class="col-md-3">
                                                <select name="POST_OFFICE_ID" id="POST_OFFICE_ID" class="form-control">
                                                    <option value="">-Select-</option>
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
                                                <input type="text" name="VILLAGE" id="VILLAGE" value=""
                                                       class="form-control" required/>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Enter your village,house or road no here"
                                                   data-placement="right" data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Permanent Address <span
                                                class="red">*</span></label>

                                        <div class="col-md-2"> Same as present address?</div>
                                        <div class="col-md-1">
                                            <input type="radio" class="SAS_PSORPR" name="SAS_PSORPR" value="1"
                                                   id="PARM_ADDRESS_YES" checked>&nbsp; Yes
                                        </div>
                                        <div class="col-md-1">
                                            <input type="radio" class="SAS_PSORPR" name="SAS_PSORPR" value="0"
                                                   id="PARM_ADDRESS_NO">&nbsp; No
                                        </div>
                                        <div class="col-md-1">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Select yes if your present and permanent address are same other wise select no for different address"
                                               data-placement="right" data-toggle="popover" data-container="body"
                                               data-original-title="" title="Help"></i>
                                        </div>
                                    </div>
                                    <div id="permanent_address" class="toggle-div">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Division</label>

                                            <div class="col-md-3">
                                                <select name="P_DIVISION_ID" id="P_DIVISION_ID"
                                                        class="form-control is_required">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($division as $rd) { ?>
                                                        <option
                                                            value="<?php echo $rd->DIVISION_ID ?>"><?php echo $rd->DIVISION_ENAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select division name" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">District</label>

                                            <div class="col-md-3">
                                                <select name="P_DISTRICT_ID" id="P_DISTRICT_ID"
                                                        class="form-control is_required">
                                                    <option value="">-Select-</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select district name" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Upazila/Thana</label>

                                            <div class="col-md-3">
                                                <select name="P_THANA_ID" id="P_THANA_ID"
                                                        class="form-control is_required">
                                                    <option value="">-Select-</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select upazila or thana name" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Police Station</label>

                                            <div class="col-md-3">
                                                <select name="P_POLICE_STATION_ID" id="P_POLICE_STATION_ID"
                                                        class="form-control is_required">
                                                    <option value="">-Select-</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select police station" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Union/Ward No.</label>

                                            <div class="col-md-3">
                                                <select name="P_UNION_ID" id="P_UNION_ID"
                                                        class="form-control is_required">
                                                    <option value="">-Select-</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select ward or union" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Post office</label>

                                            <div class="col-md-3">
                                                <select name="P_POST_OFFICE_ID" id="P_POST_OFFICE_ID"
                                                        class="form-control">
                                                    <option value="">-Select-</option>
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
                                                <input type="text" name="P_VILLAGE" value=""
                                                       class="form-control is_required"/>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Enter your village,house or road no here"
                                                   data-placement="right" data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Local Emergency Guardian </label>

                                        <div class="col-md-4">
                                            <input type="radio" name="local_emergency_guardian"
                                                   class="local_emergency_guardian" value="F" checked>&nbsp; Father
                                            &nbsp;
                                            <input type="radio" name="local_emergency_guardian"
                                                   class="local_emergency_guardian" value="M">&nbsp; Mother &nbsp;
                                            <input type="radio" name="local_emergency_guardian"
                                                   class="local_emergency_guardian" value="O">&nbsp; Others
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Select your local guardian here" data-placement="right"
                                               data-toggle="popover" data-container="body" data-original-title=""
                                               title="Help"></i>
                                        </div>
                                    </div>
                                    <div id="local_guardian" class="toggle-div">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Local Guardian Name</label>

                                            <div class="col-md-3">
                                                <input type="text" name="LOCAL_GAR_NAME" id="LOCAL_GAR_NAME" value=""
                                                       class="form-control is_required_o"
                                                       placeholder="Local Guardian Name">
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Enter your Local Guardian Name" data-placement="right"
                                                   data-toggle="popover" data-container="body" data-original-title=""
                                                   title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Local Guardian Relation</label>

                                            <div class="col-md-2">
                                                <select class="form-control is_required_o" name="LOCAL_GAR_RELATION"
                                                        id="LOCAL_GAR_RELATION">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($relation as $row) { ?>
                                                        <option
                                                            value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Select your Local Guardian relation"
                                                   data-placement="right" data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Local Guardian Address </label>

                                            <div class="col-md-3">
                                                <textarea class="form-control is_required_o"
                                                          name="LOCAL_GAR_ADDRESS"><?php echo set_value('LOCAL_GAR_ADDRESS'); ?></textarea>

                                            </div>
                                            <div class="col-md-3">
                                                <i class="fa fa-info-circle pointer2"
                                                   data-content="Enter your local guardian address here"
                                                   data-placement="right" data-toggle="popover" data-container="body"
                                                   data-original-title="" title="Help"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Local Guardian Mobile</label>

                                            <div class="col-md-2">
                                                <input type="text" name="LOCAL_GAR_PHN[]" id="LOCAL_GAR_PHN" value=""
                                                       class="form-control is_required_o numbersOnly"
                                                       placeholder="Mobile">
                                            </div>
                                            <div class="col-md-1">

                                                <span class="btn btn-xs btn-info" id="add_mobile_lg"> <i
                                                        style="cursor:pointer" class="fa fa-plus"></i></span>
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
                                                    <tbody></tbody>
                                                </table>
                                            </div>
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
                                                    <th width="25%" class="text-center"><span
                                                            class="btn btn-xs btn-primary" id="add_academic"><i
                                                                style="cursor:pointer" class="fa fa-plus"> Add More</i></span>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
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
                                        <?php foreach ($substance as $row): ?>
                                            <tr>
                                                <td><input type="hidden" name="SUBSTANCE[]"
                                                           value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?>
                                                </td>
                                                <td>
                                                    <select name="CURRENTLY_USED[]">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="PREVIOUSLY_USED[]">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="TYPE_AMOUNT_FREQUENCY[]"
                                                           class="form-control"></td>
                                                <td><input type="text" name="DURATION[]" class="form-control"></td>
                                                <td><input type="text" name="STOP_DT[]" class="form-control datepicker">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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
                                            <td><input type="text" id="disease_start_date"
                                                       class="form-control datepicker"></td>
                                            <td><input type="text" id="disease_end_date"
                                                       class="form-control datepicker"></td>
                                            <td><input type="text" id="doctor" class="form-control"></td>
                                            <td>
                                                <span class="btn btn-xs btn-info" id="add_disease"> <i
                                                        style="cursor:pointer" class="fa fa-plus"></i></span>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                                <br><br>
                                <h4 style="color:green">Others Information</h4>

                                <div class="div-background">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Has waiver</label>

                                        <div class="col-sm-1" style="width: 20px;">
                                            <input type="checkbox" name="HAS_WEAVER" id="HAS_WEAVER"/>
                                        </div>
                                        <div class="col-md-1  ">
                                            <input type="text" name="WEAVER_PERCENTAGE" id="WEAVER_PERCENTAGE"
                                                   style="display:none" placeholder="e.g. 5%" value=""
                                                   class="form-control numbersOnly">
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
                                            <input type="text" name="WEAVER_REASON" id="WEAVER_REASON" value=""
                                                   placeholder="waiver reason" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa fa-info-circle pointer2"
                                               data-content="Please enter waiver reson here" data-placement="right"
                                               data-toggle="popover" data-container="body" data-original-title=""
                                               title="Help"></i>
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
                                                        <input id="emergencyCon" name="FMLY_INCOME"
                                                               value="< 1,00,000 BDT" type="radio" checked>&nbsp;
                                                        < 1,00,000 BDT
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input id="emergencyCon" name="FMLY_INCOME"
                                                               value="1,00,000 BDT to 5,00,000 BDT" type="radio">&nbsp;
                                                        1,00,000 BDT to 5,00,000 BDT
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input id="emergencyCon" name="FMLY_INCOME"
                                                               value="5,00,000 BDT to 10,00,000 BDT" type="radio">&nbsp;
                                                        5,00,000 BDT to 10,00,000 BDT
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input id="emergencyCon" name="FMLY_INCOME"
                                                               value="10,00,000 BDT to 20,00,000 BDT" type="radio">&nbsp;
                                                        10,00,000 BDT to 20,00,000 BDT
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input id="emergencyCon" name="FMLY_INCOME"
                                                               value="> 20,00,000 BDT" type="radio">&nbsp;
                                                        > 20,00,000 BDT
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Student's Source of Finance</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input id="source" name="SSOF_FINANC" value="P" type="radio"
                                                               checked>&nbsp;
                                                        Parents
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input id="emergencyCon" name="SSOF_FINANC" value="S"
                                                               type="radio">&nbsp;
                                                        Self
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input id="emergencyCon" name="SSOF_FINANC" value="O"
                                                               type="radio">&nbsp;
                                                        Others
                                                    </div>
                                                    <div id="finance_guardian" style="display:none">
                                                        <div class="col-md-2">
                                                            <input id="emergencyCon" name="SSOF_FINANC" value="G"
                                                                   type="radio">&nbsp;
                                                            Guardian
                                                        </div>
                                                    </div>

                                                    <div id="finance_spouse" style="display:none">
                                                        <div class="col-md-2">
                                                            <input id="emergencyCon" name="SSOF_FINANC" value="SP"
                                                                   type="radio" id="spouse">&nbsp;
                                                            Spouse
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Do you have any siblings currently enrolled at KYAU ?</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input id="siblin" name="SIBLING_EXIST" value="1" type="radio">&nbsp;
                                                    Yes
                                                </div>
                                                <div class="col-md-2">
                                                    <input id="siblin" name="SIBLING_EXIST" value="0" type="radio"
                                                           checked>&nbsp; No
                                                </div>
                                                <div class="col-md-4 sibId" style="display:none;">
                                                    <input id="sibId" name="SBLN_ROLL_NO" type="text"
                                                           class="form-control" placeholder="ID Number of your Sibling">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
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
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    </div>

</section>
<section id="contact" class="gray-section contact">
    <?php $this->load->view("template/footer"); ?>
</section>

<!-- <script src="<?php //echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script> -->
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
    // for applicant mobile
    $(document).on('click', '#add_mobile', function (e) {
        e.preventDefault();
        $("#mobile_list tbody").append('<tr> ' +
        ' <td>' +
        '<input type="text" name="MOBILE_NO[]"   class="form-control numbersOnly" placeholder="Mobile" required>' +
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
        '<input type="text" name="FATHER_PHN[]"   class="form-control numbersOnly" placeholder="Mobile" required>' +
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
        '<input type="text" name="FATHER_EMAIL[]"   class="form-control " placeholder="Father Email" required>' +
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
        '<input type="text" name="MOTHER_PHN[]"   class="form-control numbersOnly" placeholder="Mobile" required>' +
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
        '<input type="text" name="MOTHER_EMAIL[]"   class="form-control" placeholder="Mother Email" required>' +
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
        '<input type="text" name="EMER_PER_PHN[]"   class="form-control numbersOnly" placeholder="Mobile" required>' +
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
        '<input type="text" name="LOCAL_GAR_PHN[]"   class="form-control numbersOnly" placeholder="Mobile" required>' +
        '</td>' +
        ' <td>           ' +
        ' <i style="cursor:pointer" class="fa fa-times btn-xs btn-danger remove"></i>' +
        ' </td> ' +
        '</tr>');

    });

    $(document).on('click', '.remove', function () {
        $(this).closest('tr').remove();
    });
    // append academic info table
    var counter = 0;
    $(document).on('click', '#add_academic', function () {
        counter++;
        $("#academic_list tbody").append(' <tr>' +
            '<td>' +
            '   <select class="form-control" name="EXAM_NAME_' + counter + '" class="EXAM_NAME">' +
            '<option value="">-Select-</option>' +
            <?php foreach ($exam_name as $row) { ?>
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
            '</td>' +
            '<td class="text-center">' +
            '<span class="btn btn-xs btn-danger" id="remove_tr"><i style="cursor:pointer" class="fa fa-times" > Remove</i></span>' +
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
        var url = '<?php echo site_url('admission/departmentByFaculty'); ?>';

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
        var url = '<?php echo site_url('admission/departmentByFaculty'); ?>';

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
            url: '<?php echo site_url('admission/programByDepartment'); ?>',
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
            url: '<?php echo site_url('admission/programByDepartment'); ?>',
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
            url: '<?php echo site_url('admission/getCourseByID'); ?>',
            data: {
                faculty_id: faculty_id,
                department_id: department_id,
                program_id: program_id
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
            url: '<?php echo base_url(); ?>admission/dis_by_div_id',
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
            url: '<?php echo base_url(); ?>admission/up_thana_by_dis_id',
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
            url: '<?php echo base_url(); ?>admission/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/post_office_by_thana_id',
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
            url: '<?php echo base_url(); ?>admission/dis_by_div_id',
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
            url: '<?php echo base_url(); ?>admission/up_thana_by_dis_id',
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
            url: '<?php echo base_url(); ?>admission/union_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_UNION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/police_station_by_thana_id',
            data: {THANA_ID: THANA_ID},
            success: function (data) {
                $("#P_POLICE_STATION_ID").html(data)
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admission/post_office_by_thana_id',
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


</script>
