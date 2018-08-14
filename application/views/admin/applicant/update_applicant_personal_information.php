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
    <h5>Personal Information</h5>
    <?php // if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
    <div class="ibox-tools">

            <span data-action="admin/applicantPersonalDetails" id="update_personal_cancel_btn"
                  class="btn btn-success btn-xs pull-right"
                  applicant-data-id="<?php echo $applicant_info->APPLICANT_ID; ?>"
                  role="button"><i class="fa fa-mail-reply"></i> Back</span>
    </div>
    <?php // endif; ?>
</div>

<div class="ibox-content">
    <form id="applicant_personal_form" class="form-horizontal fContent" method="post"
          enctype="multipart/form-data">
        <div class="">
            <div class="div-background">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="FULL_NAME_BN" class="col-md-5 control-label">নাম ( বাংলা ) <span
                                    class="red">*</span></label>

                        <div class="col-md-5">
                            <input type="text" name="FULL_NAME_BN" id="FULL_NAME_BN"
                                   value="<?php echo $applicant_info->FULL_NAME_BN; ?>"
                                   class="form-control keyboardInput" placeholder="বাংলা নাম">
                            <!--                <span class="red">-->
                            <?php //echo form_error('FULL_NAME_BN'); ?><!--</span>-->
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2" data-content="বাংলায় আপনার  নাম লিখুন"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title=""></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="PLACE_OF_BIRTH" class="col-md-5 control-label">Place of Birth <span
                                    class="red">*</span></label>

                        <div class="col-md-5">
                            <input type="text" name="PLACE_OF_BIRTH" id="PLACE_OF_BIRTH"
                                   class="form-control" value="<?php echo $applicant_info->PLACE_OF_BIRTH; ?>"
                                   placeholder="Place of Birth">
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Enter the name of place where are you born" data-placement="right"
                               data-toggle="popover" data-container="body" data-original-title=""
                               title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="BLOOD_GRP" class="col-md-5 control-label">Blood Group :</label>
                        <div class="col-md-5">

                            <select id="BLOOD_GRP" name="BLOOD_GRP" class="form-control">
                                <option value="">-Select-</option>
                                <?php foreach ($blood_group as $row): ?>
                                    <option value="<?php echo $row->LKP_ID ?>" <?php echo ($applicant_info->BLOOD_GROUP == $row->LKP_ID) ? 'selected' : set_value('BLOOD_GRP') ?>><?php echo $row->LKP_NAME ?></option>
                                <?php endforeach; ?>
                            </select>

                            <span class="red"><?php echo form_error('BLOOD_GRP'); ?></span>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2" data-content="Select your blood group"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Marital Status <span class="red">*</span></label>

                        <div class="col-md-5">
                            <select class="form-control" name="MARITAL_STATUS" id="MARITAL_STATUS">
                                <option value="">-Select-</option>
                                <?php foreach ($merital_status as $row): ?>
                                    <option value="<?php echo $row->LKP_ID ?>" <?php echo ($applicant_info->MARITAL_STATUS == $row->LKP_ID) ? 'selected' : set_value('MARITAL_STATUS') ?>><?php echo $row->LKP_NAME ?></option>
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

                    <div class="form-group">
                        <label class="col-md-5 control-label">Nationality <span class="red">*</span></label>

                        <div class="col-md-5">
                            <select class="form-control" name="NATIONALITY" id="NATIONALITY">
                                <option value="">-Select-</option>
                                <?php foreach ($nationality as $row): ?>
                                    <option value="<?php echo $row->id ?>" <?php echo ($applicant_info->NATIONALITY == $row->id) ? 'selected' : set_value('NATIONALITY') ?>><?php echo $row->nationality ?></option>
                                <?php endforeach; ?>
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
                                   value="<?php echo $applicant_info->NATIONAL_ID; ?>"
                                   class="form-control numbersOnly" placeholder="National ID">
                            <span class="red"><?php echo form_error('NATIONAL_ID'); ?></span>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your natinal indentity number here"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Birth Certificate</label>

                        <div class="col-md-5">
                            <input type="text" name="BIRTH_CERTIFICATE" id="BIRTH_CERTIFICATE"
                                   value="<?php echo $applicant_info->BIRTH_CERTIFICATE; ?>"
                                   class="form-control numbersOnly" placeholder="Birth Certificate">
                            <span class="red"><?php echo form_error('BIRTH_CERTIFICATE'); ?></span>
                        </div>
                        <div class="col-md-2">
                            <i class="fa fa-info-circle pointer2"
                               data-content="Please enter your natinal indentity number here"
                               data-placement="right" data-toggle="popover" data-container="body"
                               data-original-title="" title="Help"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Religion <span class="red">*</span></label>
                        <div class="col-md-5">
                            <select class="form-control" name="RELIGION_ID" id="RELIGION_ID">
                                <option value="">-Select-</option>
                                <?php foreach ($religion as $row): ?>
                                    <option value="<?php echo $row->LKP_ID ?>" <?php echo ($applicant_info->RELIGION_ID == $row->LKP_ID) ? 'selected' : set_value('RELIGION_ID') ?>><?php echo $row->LKP_NAME ?></option>
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
                                   value="<?php echo $applicant_info->HEIGHT_FEET; ?>" class="form-control numbersOnly"
                                   placeholder="e.g: 5.8">
                        </div>
                        <div class="col-md-1">
                            Ft.
                        </div>
                        <div class="col-md-1" style="padding-right: 0;">
                            <input type="text" name="HEIGHT_CM" id="HEIGHT_CM"
                                   value="<?php echo $applicant_info->HEIGHT_CM; ?>" class="form-control numbersOnly"
                                   placeholder="e.g: 176.78">
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

                        <div class="col-md-1" style="padding-right: 0;">
                            <input type="text" name="WEIGHT_KG" id="WEIGHT_KG"
                                   value="<?php echo $applicant_info->WEIGHT_KG; ?>"
                                   class="form-control numbersOnly" placeholder="Weight">
                        </div>
                        <div class="col-md-1">
                            Kg
                        </div>
                        <div class="col-md-2" style="padding-right: 0;">
                            <input type="text" name="WEIGHT_LBS" id="WEIGHT_LBS"
                                   value="<?php echo $applicant_info->WEIGHT_LBS; ?>"
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
                <div class="col-md-5">
                    <div class="pull-right" style="margin-right: 60px">
                        <div class="form-group col-md-12">
                            <label class="control-label">Your Photo</label>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-3">
                                <div class="avatar-zone">

                                    <!-- rand() function using for remove browser cache -->

                                    <?php $photo = ($applicant_info->PHOTO != '') ? "upload/applicant/photo/" . $applicant_info->PHOTO. "?". rand() : 'upload/default/default_pic.png' ?>
                                    <img id="img_id" src="<?php echo base_url($photo); ?>" alt="select photo" style="width: 180px;
                                        height: 160px;">
                                </div>
                                <div class="overlay-layer">Choose File</div>
                                <input type='file' style="cursor: pointer;" name="photo" id="propic"
                                       onchange="upload_img(this);" class="upload_btn"
                                >
                            </div>
                        </div>

                    </div>
                    <div class="pull-right" style="margin-right: 60px">
                        <div class="form-group col-md-12">
                            <label class="control-label">Your Signature</label>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-3">
                                <div class="avatar-zone-sig">
                                    <?php $sign = ($applicant_info->SIGNATURE_PHOTO != '') ? "upload/applicant/signature/" . $applicant_info->SIGNATURE_PHOTO : 'upload/default/default_sign.png' ?>
                                    <img id="sig_id" src="<?php echo base_url($sign); ?>"
                                         alt="select photo" style="width: 180px;
                                        height: 50px;"/>
                                </div>
                                <div class="overlay-layer-sig">Choose File</div>
                                <input type='file' style="cursor: pointer;" name="signature" id="sigpic"
                                       onchange="upload_img_sig(this);" class="upload_btn"
                                >
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <b>Instruction:</b><br>
                            <span class="text-info">
                                            ->Your Photo, Signature Photo format must be .gif, .jpg, .jpeg or .png<br>
                                            ->Size should not exceed 100 KB for Photo and 60 KB for Signature<br>
                                            ->Dimension prefarable 300 X 300 px for Photo and 300 X 80 px for Signature
                                        </span><br>
                            For image resize <a href="http://picresize.com/" target="_blank"
                                                style="color:#18A689">Click Here</a>

                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <br>
            <div class="form-group">
                <div class="col-sm-3  pull-right">
                    <input type="button" class="btn btn-primary btn-xs fSubmit pull-right"
                           data-action="admin/updateApplicantPersonalDetails/<?php echo $applicant_info->APPLICANT_ID; ?>"
                           data-param="<?php echo $applicant_info->APPLICANT_ID; ?>"
                           data-su-action="admin/applicantPersonalDetails" value="Update">
                </div>
            </div>
        </div>
    </form>
</div>


<script>

    $.validator.addMethod("isNIDValid", function(value) {
        var NidValid = false;
        var UserNID = value;
        if (UserNID.length == 0 || UserNID.length == 13 || UserNID.length == 17)
        {
            NidValid = true;
        }
        return NidValid;
    }, 'National ID Not Valid');
    $.validator.addMethod("isMoblieValid", function(value) {
        var MobileValid = false;
        var UserMobile = value;
        if (UserMobile.length == 0 || UserMobile.length == 11)
        {
            MobileValid = true;
        }
        return MobileValid;
    }, 'Mobile number not valid');

    $("#applicant_personal_form").validate({
        rules: {
            FULL_NAME_BN: {required:true},
            PLACE_OF_BIRTH: {required:true},
            NATIONALITY: {required:true},
            MARITAL_STATUS: {required:true},
            RELIGION_ID: {required:true},
            NATIONAL_ID: {number:true, isNIDValid:true}
        },

        messages: {
            FULL_NAME_BN: "Bangla name required",
            PLACE_OF_BIRTH: "Place of birth field is required",
            NATIONALITY: "Nationality required",
            MARITAL_STATUS: "Marital status required",
            RELIGION_ID: "Religion required",
            NATIONAL_ID: "Required valid national ID",
        }
    });


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
                            $('#applicant_profile_picture').attr('src', e.target.result);

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

    // Cancel Button

    $('#update_personal_cancel_btn').click(function () {
        var APPLICANT_ID = $("#APPLICANT_ID").attr('applicant-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url()?>/" + action_uri,
            data: {APPLICANT_ID: APPLICANT_ID},
            beforeSend: function () {
                $(".profile-content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('.profile-content').html(data);
            }
        });
    });


</script>


