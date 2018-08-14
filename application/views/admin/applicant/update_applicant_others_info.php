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
    <h5>Other Details</h5>
    <?php // if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
    <div class="ibox-tools">
        <span data-action="admin/applicantOtherDetailsInfo" id="update_othersInfo_cancel_btn" class="btn btn-success btn-xs pull-right" applicant-data-id="<?php echo $applicant_info->APPLICANT_ID; ?>" role="button"><i class="fa fa-mail-reply"></i> Back</span>
    </div>
    <?php // endif; ?>
</div>

<form id="applicant_others_info_form" class="form-horizontal fContent" method="post">

    <div class="div-background"  >

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">1. Annual Income of Parent/Parents or guardian <span class="red">*</span></label>
            </div>
            <div class="col-md-4">
                <input type="text" name="ANNUAL_INCOME" id="ANNUAL_INCOME" value="<?php echo $applicant_info->ANNUAL_INCOME; ?>" class="form-control">
            </div>
            <div class="col-md-2">
                <i class="fa fa-info-circle pointer2" data-content="Please Select Semester here"
                   data-placement="right" data-toggle="popover" data-container="body"
                   data-original-title="" title="Help"></i>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-5">
                    <label>2. Scholarships receive in the past ?</label>
                </div>
                <div class="col-md-1">
                    <input id="scholarship_id" class="SCHOLARSHIP" name="SCHOLARSHIP" value="YES" <?php echo ($applicant_info->SCHOLARSHIP == 'YES') ?  "checked" : "" ;  ?> type="radio">&nbsp; Yes
                </div>
                <div class="col-md-1">
                    <input id="scholarship_id" class="SCHOLARSHIP" name="SCHOLARSHIP" value="NO" <?php echo ($applicant_info->SCHOLARSHIP == 'NO') ?  "checked" : "" ;  ?> type="radio">&nbsp; No
                </div>

            </div>
            <div class="form-group">
                <div class="col-md-4 scholarships" style="display:<?php echo ($applicant_info->SCHOLARSHIP == 'YES') ?  "" : 'none'; ?>;">
                    <input id="SCHOLARSHIP_DESC" name="SCHOLARSHIP_DESC" value="<?php echo $applicant_info->SCHOLARSHIP_DESC; ?>"  type="text" class="form-control"
                           placeholder="">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-5">
                    <label>3. Were you expelled from any instituition before ?</label>
                </div>
                <div class="col-md-1">
                    <input id="expelled_id" class="EXPELLED" name="EXPELLED" value="YES" <?php echo ($applicant_info->EXPELLED == 'YES') ?  "checked" : "" ;  ?> type="radio">&nbsp; Yes
                </div>
                <div class="col-md-1">
                    <input id="expelled_id" class="EXPELLED" name="EXPELLED" value="NO" <?php echo ($applicant_info->EXPELLED == 'NO') ?  "checked" : "" ;  ?> type="radio">&nbsp; No
                </div>

            </div>
            <div class="form-group expelled_div" style="display: <?php echo ($applicant_info->EXPELLED == 'YES') ?  "" : 'none'; ?>">
                <div class="col-md-6">
             <textarea id="EXPELLED_DESC" name="EXPELLED_DESC" rows="6" type="text" class="form-control"
                       placeholder=""><?php echo $applicant_info->EXPELLED_DESC; ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-5">
                    <label>4. Were you ever arrested by law enforcement agency ?</label>
                </div>
                <div class="col-md-1">
                    <input id="arrested_id" class="ARRESTED" name="ARRESTED" value="YES" <?php echo ($applicant_info->ARRESTED == 'YES') ?  "checked" : "" ;  ?> type="radio">&nbsp; Yes
                </div>
                <div class="col-md-1">
                    <input id="arrested_id" class="ARRESTED" name="ARRESTED" value="NO" <?php echo ($applicant_info->ARRESTED == 'NO') ?  "checked" : "" ;  ?> type="radio">&nbsp; No
                </div>

            </div>
            <div class="form-group arrested_div" style="display:<?php echo ($applicant_info->EXPELLED == 'YES') ?  "" : 'none'; ?>;">
                <div class="col-md-6" >
            <textarea id="ARRESTED_DESC" name="ARRESTED_DESC" rows="6"  class="form-control"
                      placeholder=""><?php echo $applicant_info->ARRESTED; ?></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-5">
                        <label>5. Were you ever convicted by any court in bangladesh of any other country ?</label>
                    </div>
                    <div class="col-md-1">
                        <input id="convicted_id" class="CONVICTED" name="CONVICTED" value="YES" <?php echo ($applicant_info->CONVICTED == 'YES') ?  "checked" : "" ;  ?> type="radio">&nbsp; Yes
                    </div>
                    <div class="col-md-1">
                        <input id="convicted_id" class="CONVICTED" name="CONVICTED" value="NO" <?php echo ($applicant_info->CONVICTED == 'NO') ?  "checked" : "" ;  ?> type="radio">&nbsp; No
                    </div>

                </div>
                <div class="form-group convicted_div" style="display:<?php echo ($applicant_info->CONVICTED == 'YES') ?  "" : 'none'; ?>;">
                    <div class="col-md-6" >
                        <textarea id="CONVICTED_DESC" name="CONVICTED_DESC" rows="6" class="form-control"><?php echo $applicant_info->CONVICTED_DESC; ?></textarea>
                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-5">
                        <label>6. Did you apply Khwaja Yunus Ali University Before ?</label>
                    </div>
                    <div class="col-md-1">
                        <input id="apply_before_id" class="APPLY_BEFORE" name="APPLY_BEFORE" value="YES" <?php echo ($applicant_info->APPLY_BEFORE == 'YES') ?  "checked" : "" ;  ?> type="radio">&nbsp; Yes
                    </div>
                    <div class="col-md-1">
                        <input id="apply_before_id" class="APPLY_BEFORE" name="APPLY_BEFORE" value="NO" <?php echo ($applicant_info->APPLY_BEFORE == 'NO') ?  "checked" : "" ;  ?> type="radio">&nbsp; No
                    </div>

                </div>
                <div class="form-group apply_before_div" style="display:<?php echo ($applicant_info->EXPELLED == 'YES') ?  "" : 'none'; ?>;">
                    <div class="col-md-2" >
                        <input id="APPLY_SEMESTER" name="APPLY_SEMESTER" value="<?php echo $applicant_info->APPLY_SEMESTER; ?>" type="text" class="form-control"
                               placeholder="Semester">
                    </div>
                    <div class="col-md-2" >
                        <input id="APPLY_YEAR" name="APPLY_YEAR" value="<?php echo $applicant_info->APPLY_YEAR; ?>" type="text" class="form-control"
                               placeholder="Year">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-5">
                        <label>7. Do you have any siblings currently enrolled at KYAU ?</label>
                    </div>
                    <div class="col-md-1">
                        <input id="siblin" class="SIBLING_EXIST" name="SIBLING_EXIST" value="YES" <?php echo ($applicant_info->SIBLING_EXIST == 'YES') ?  "checked" : "" ;  ?> type="radio">&nbsp; Yes
                    </div>
                    <div class="col-md-1">
                        <input id="siblin" class="SIBLING_EXIST" name="SIBLING_EXIST" value="NO" <?php echo ($applicant_info->SIBLING_EXIST == 'NO') ?  "checked" : "" ;  ?> type="radio">&nbsp; No
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-md-4 sibId" style="display:<?php echo ($applicant_info->SIBLING_EXIST == 'YES') ?  "" : 'none'; ?>;">
                        <input id="SBLN_ROLL_NO" name="SBLN_ROLL_NO" value="<?php echo $applicant_info->SBLN_ROLL_NO; ?>" type="text" class="form-control"
                               placeholder="ID Number of your Sibling">
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>

    <br>
    <div class="form-group">
        <div class="col-sm-3  pull-right">
            <input type="button" class="btn btn-primary btn-xs fSubmit pull-right" data-action="admin/updateApplicantOtherDetailsInfo/<?php echo $applicant_info->APPLICANT_ID; ?>"
                   data-param="<?php echo $applicant_info->APPLICANT_ID; ?>"
                   data-su-action="admin/applicantOtherDetailsInfo" value="Update">

        </div>
    </div>

</form>

<script>
    $(document).on('click', '#siblin', function () {
        if ($('input[name="SIBLING_EXIST"]:checked').val() == "YES") {
            $('.sibId').show();
        } else {
            $('.sibId').hide();
        }
    });
    $(document).on('click', '#scholarship_id', function () {
        if ($('input[name="SCHOLARSHIP"]:checked').val() == "YES") {
            $('.scholarships').show();
        } else {
            $('.scholarships').hide();
        }
    });
    $(document).on('click', '#expelled_id', function () {
        if ($('input[name="EXPELLED"]:checked').val() == "YES") {
            $('.expelled_div').show();
        } else {
            $('.expelled_div').hide();
        }
    });
    $(document).on('click', '#arrested_id', function () {
        if ($('input[name="ARRESTED"]:checked').val() == "YES") {
            $('.arrested_div').show();
        } else {
            $('.arrested_div').hide();
        }
    });
    $(document).on('click', '#convicted_id', function () {
        if ($('input[name="CONVICTED"]:checked').val() == "YES") {
            $('.convicted_div').show();
        } else {
            $('.convicted_div').hide();
        }
    });
    $(document).on('click', '#apply_before_id', function () {
        if ($('input[name="APPLY_BEFORE"]:checked').val() == "YES") {
            $('.apply_before_div').show();
        } else {
            $('.apply_before_div').hide();
        }
    });


    //Applicant personal info validation
    $("#applicant_others_info_form").validate({

        rules: {
            ANNUAL_INCOME: {number:true,required:true},
            SCHOLARSHIP_DESC: {required:true},
            EXPELLED_DESC: {required:true},
            ARRESTED_DESC: {required:true},
            CONVICTED_DESC: {required:true},
            APPLY_SEMESTER: {required:true},
            APPLY_YEAR: {number:true,required:true},
            SBLN_ROLL_NO: {number:true,required:true}
        },

        messages: {

        }
    });


    // Cancel Button

    $('#update_othersInfo_cancel_btn').click(function () {
        var APPLICANT_ID = $("#APPLICANT_ID").attr('applicant-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url() ?>/" + action_uri,
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