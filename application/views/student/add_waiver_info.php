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
    <h5>Waiver Information</h5>
    <div class="ibox-tools">
        <span data-action="student/waiverInfo" id="update_institute_cancel_btn" title="Back to previous"
              class="btn btn-success btn-xs pull-right" student-data-id="<?php echo $student_id; ?>"
              role="button"><i class="fa fa-mail-reply"></i> Back</span>
    </div>
</div>

<form id="student_waiver_add" class="form-horizontal fContent" method="post" enctype="multipart/form-data">
    <!--<span type="hidden" name="s_id" value="<?php /*echo $student_id; */ ?>"></span>-->
    <div class="">
        <div class="div-background">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="SESSION_ID" class="col-md-5 control-label">Session :</label>
                    <div class="col-md-5">

                        <select id="SESSION_ID" name="SESSION_ID" class="form-control">
                            <option value="">-Select-</option>
                            <?php foreach ($ins_session as $row): ?>
                                <option value="<?php echo $row->SESSION_ID ?>"><?php echo $row->SESSION_NAME ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="col-md-2">
                        <i class="fa fa-info-circle pointer2" data-content="Select your institute session"
                           data-placement="right" data-toggle="popover" data-container="body"
                           data-original-title="" title="Select Session Name"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="WAIVER_ID" class="col-md-5 control-label">Waiver Type :</label>
                    <div class="col-md-5">

                        <select id="WAIVER_ID" name="WAIVER_ID" class="form-control">
                            <option value="">-Select-</option>
                            <?php foreach ($waiver_type as $row): ?>
                                <option value="<?php echo $row->WAIVER_ID ?>"><?php echo $row->WAIVER_NAME ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="col-md-2">
                        <i class="fa fa-info-circle pointer2" data-content="Select your academic session"
                           data-placement="right" data-toggle="popover" data-container="body"
                           data-original-title="" title="Waiver Type"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="PERCENTAGE" class="col-md-5 control-label">Waiver Percentage :</label>
                    <div class="col-md-5">

                        <input id="" type="text" name="PERCENTAGE" id="PERCENTAGE"
                               class="form-control"
                               placeholder="Waiver Percentage">

                    </div>
                    <div class="col-md-2">
                        <i class="fa fa-info-circle pointer2" data-content="Select your academic session"
                           data-placement="right" data-toggle="popover" data-container="body"
                           data-original-title="" title="Waiver Percentage"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="PERCENTAGE" class="col-md-5 control-label">Active</label>
                    <div class="col-md-5">
                        <input type="checkbox" name="is_active" value="1">
                    </div>

                </div>

            </div>

            <div class="clearfix"></div>
        </div>

        <br>
        <div class="form-group">
            <div class="col-md-4  pull-right">
                <input type="button" class="btn btn-primary btn-sm fSubmit pull-right"
                       data-action="student/addWaiverInfo"
                       data-su-action="student/waiverInfo" data-param="<?php echo $student_id; ?>" value="Update">
            </div>
        </div>
    </div>
</form>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>

<script>

    $("#student_waiver_add").validate({
        rules: {
            SESSION_ID: {required: true},
            WAIVER_ID: {required: true},
            PERCENTAGE: {required: true},
        },
        messages: {
            SESSION_ID: "Required field",
            WAIVER_ID: "Required field",
            PERCENTAGE: "Required field",
        }
    });

    // Cancel Button

    $('#update_institute_cancel_btn').click(function () {
        var STUDENT_ID = $(this).attr('student-data-id');
        var action_uri = $(this).attr('data-action');

        $.ajax({
            type: 'post',
            url: "<?php echo site_url(); ?>" + "/" + action_uri + '/' + STUDENT_ID,
            data: {STUDENT_ID: STUDENT_ID},
            beforeSend: function () {
                $(".profile-content").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('.profile-content').html(data);
            }
        });
    });

</script>


