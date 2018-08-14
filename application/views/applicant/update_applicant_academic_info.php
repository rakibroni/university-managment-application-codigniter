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
    <h5>Academic information</h5>
    <?php // if ($applicant_info->ELIGIBLE_BY_ADDMISSION_DEPT_STATUS != 1) : ?>
    <div class="ibox-tools">
        <span data-action="applicant/applicantAcademicInfo" id="update_academic_cancel_btn"
              class="btn btn-success btn-xs pull-right" applicant-data-id="<?php echo $APPLICANT_ID; ?>"
              role="button"><i class="fa fa-mail-reply"></i> Back</span>
    </div>
    <?php // endif; ?>
</div>

<form id="applicant_academic_form" class="form-horizontal fContent" method="post">
    <div class="">
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
                            <th width="5%">GPA With out additional</th>
                            <th width="45%">Institute</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($academic as $applicant_row) : ?>
                            <input type="hidden" name="APP_AI_ID[]" value="<?php echo $applicant_row->APP_AI_ID; ?>">
                            <tr>
                                <td>
                                    <select class="form-control" name="EXAM_NAME[]" class="EXAM_NAME" id="EXAM_NAME_S">
                                        <option value="">-Select-</option>
                                        <?php foreach ($exam_name as $row): ?>
                                            <option value="<?php echo $row->LKP_ID ?>" <?php echo ($applicant_row->EXAM_DEGREE_ID == $row->LKP_ID) ? 'selected' : set_value('EXAM_NAME[]') ?>><?php echo $row->LKP_NAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input style="width: 50px" type="text" name="PASSING_YEAR[]" id="PASSING_YEAR_S"
                                           value="<?php echo $applicant_row->PASSING_YEAR; ?>"
                                           class=" form-control numbersOnly" id="PASSING_YEAR" placeholder="Year">
                                </td>
                                <td>
                                    <select class="form-control" name="BOARD[]" id="BOARD_S">
                                        <option value="">-Select-</option>
                                        <?php foreach ($board_name as $row): ?>
                                            <option value="<?php echo $row->LKP_ID ?>" <?php echo ($applicant_row->br == $row->LKP_NAME) ? 'selected' : set_value('BOARD[]') ?>><?php echo $row->LKP_NAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="GROUP[]" id="GROUP_S">
                                        <option value="">-Select-</option>
                                        <?php foreach ($group_name as $row): ?>
                                            <option value="<?php echo $row->LKP_ID ?>" <?php echo ($applicant_row->mg == $row->LKP_NAME) ? 'selected' : set_value('GROUP[]') ?>><?php echo $row->LKP_NAME ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input style="width: 50px" type="text" name="GPA[]"
                                           value="<?php echo $applicant_row->RESULT_GRADE; ?>" id="GPA_S"
                                           class="form-control numbersOnly" placeholder="CGPA">
                                </td>
                                <td>
                                    <input style="width: 50px" type="text" name="GPAWA[]"
                                           value="<?php echo $applicant_row->RESULT_GRADE_WA; ?>" id="GPAWA_S"
                                           class="form-control numbersOnly" placeholder="CGPA">
                                </td>
                                <td>
                                    <input type="text" name="INSTITUTE[]"
                                           value="<?php echo $applicant_row->INSTITUTION; ?>" class="form-control"
                                           id="INSTITUTE_S" placeholder="Institute Name">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
            <div class="clearfix"></div>
        </div>

        <br>
        <div class="form-group">
            <div class="col-sm-3  pull-right">
                <input type="button" class="btn btn-primary btn-xs fSubmit pull-right"
                       data-action="applicant/updateApplicantAcademicInfo"
                       data-su-action="applicant/applicantAcademicInfo" value="Update">

            </div>
        </div>
    </div>
</form>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>

<script>
    //Applicant academic info validation
    $("#applicant_academic_form").validate({
        rules: {

            EXAM_NAME: {required: true}
        },
        messages: {
            EXAM_NAME: "Exam Name required"
        }
    });


    // Cancel Button

    $('#update_academic_cancel_btn').click(function () {
        var APPLICANT_ID = $("#APPLICANT_ID").attr('applicant-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo base_url(); ?>/" + action_uri,
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