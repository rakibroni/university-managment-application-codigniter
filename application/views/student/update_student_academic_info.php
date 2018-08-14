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
    <div class="ibox-tools">
        <span data-action="student/academicInfo" id="update_academic_cancel_btn" title="Back to previous"
              class="btn btn-success btn-xs pull-right"
              student-data-id="<?php echo $student_id; ?>" role="button"><i class="fa fa-mail-reply"></i> Back</span>
    </div>
</div>

<div class="ibox-content">
    <form id="student_academic_form" class="form-horizontal fContent" method="post">
        <div class="">
            <div class="">
                <div class="form-group">
                    <div class="col-md-12">
                        <table id="academic_list" class="table table-bordered dataTable">
                            <tr class="info">
                                <th>Exam</th>
                                <th>Year</th>
                                <th>Board</th>
                                <th>Group</th>
                                <th>Institute</th>
                                <th>Result</th>
                                <th>Result W/A</th>
                            </tr>
                            <tbody>

                            <?php if (empty($academic)) : ?>

                                <?php for ($i = 0; $i < 2; $i++) { ?>

                                    <tr>
                                        <td>
                                            <select class="form-control" name="EXAM_NAME[<?php echo $i+1; ?>]" class="EXAM_NAME"
                                                    id="EXAM_NAME_S<?php echo $i+1; ?>">
                                                <option value="">-Select-</option>
                                                <?php foreach ($exam_name as $row): ?>
                                                    <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input style="width: 50px" type="text" name="PASSING_YEAR[<?php echo $i+1; ?>]"
                                                   id="PASSING_YEAR_S<?php echo $i+1;
                                                   ?>"
                                                   value="<?php // echo $applicant_row->PASSING_YEAR; ?>"
                                                   class=" form-control numbersOnly" id="PASSING_YEAR"
                                                   placeholder="Year">
                                        </td>
                                        <td>
                                            <select class="form-control" name="BOARD[<?php echo $i+1; ?>]" id="BOARD_S<?php echo $i+1; ?>">
                                                <option value="">-Select-</option>
                                                <?php foreach ($board_name as $row): ?>
                                                    <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="GROUP[<?php echo $i+1; ?>]" id="GROUP_S<?php echo $i+1; ?>">
                                                <option value="">-Select-</option>
                                                <?php foreach ($group_name as $row): ?>
                                                    <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="INSTITUTE[<?php echo $i+1; ?>]" value="" class="form-control"
                                                   id="INSTITUTE_S<?php echo $i+1; ?>" placeholder="Institute Name">
                                        </td>
                                        <td>
                                            <input style="width: 60px" type="text" name="GPA[<?php echo $i+1; ?>]" value="" id="GPA_S<?php echo $i+1; ?>"
                                                   class="form-control numbersOnly" placeholder="CGPA">
                                        </td>
                                        <td>
                                            <input style="width: 60px" type="text" name="GPAWA[<?php echo $i+1; ?>]" value="" id="GPAWA_S<?php echo $i+1; ?>"
                                                   class="form-control numbersOnly" placeholder="CGPA">
                                        </td>
                                    </tr>

                                <?php } ?>

                            <?php else: ?>

                                <?php $j =1; foreach ($academic as $applicant_row) : ?>
                                    <input type="hidden" name="STU_AI_ID[]"
                                           value="<?php echo $applicant_row->STU_AI_ID; ?>">
                                    <tr>
                                        <td>
                                            <select class="form-control" name="EXAM_NAME[<?php echo $j++; ?>]" class="EXAM_NAME"
                                                    id="EXAM_NAME_S">
                                                <option value="">-Select-</option>
                                                <?php foreach ($exam_name as $row): ?>
                                                    <option value="<?php echo $row->LKP_ID ?>" <?php echo ($applicant_row->EXAM_DEGREE_ID == $row->LKP_ID) ? 'selected' : set_value('EXAM_NAME[]') ?>><?php echo $row->LKP_NAME ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input style="width: 50px" type="text" name="PASSING_YEAR[]"
                                                   id="PASSING_YEAR_S"
                                                   value="<?php echo $applicant_row->PASSING_YEAR; ?>"
                                                   class=" form-control numbersOnly" id="PASSING_YEAR"
                                                   placeholder="Year">
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
                                            <input type="text" name="INSTITUTE[]"
                                                   value="<?php echo $applicant_row->INSTITUTION; ?>"
                                                   class="form-control" id="INSTITUTE_S" placeholder="Institute Name">
                                        </td>
                                        <td>
                                            <input style="width: 60px" type="text" name="GPA[]"
                                                   value="<?php echo $applicant_row->RESULT_GRADE; ?>" id="GPA_S"
                                                   class="form-control numbersOnly" placeholder="CGPA">
                                        </td>
                                        <td>
                                            <input style="width: 60px" type="text" name="GPAWA[]"
                                                   value="<?php echo $applicant_row->RESULT_GRADE_WA; ?>" id="GPAWA_S"
                                                   class="form-control numbersOnly" placeholder="CGPA">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
                <div class="clearfix"></div>
            </div>

            <br>
            <div class="form-group">
                <div class="col-md-4  pull-right">
                    <input type="button" class="btn btn-primary btn-sm fSubmit pull-right" data-action="student/updateStudentAcademicInfo"
                           data-su-action="student/academicInfo" data-param="<?php echo $student_id; ?>" value="Update">
                </div>
            </div>
        </div>
    </form>
</div>

<script>

    //Applicant academic info validation
    $("#student_academic_form").validate({
        rules: {

            'EXAM_NAME[1]': {required:true},
            'PASSING_YEAR[1]': {number:true,required:true},
            'BOARD[1]': {required:true},
            'GROUP[1]': {required:true},
            'GPA[1]': {number:true,required:true},
            'GPAWA[1]': {number:true,required:true},
            'INSTITUTE[1]': {required:true},

            'EXAM_NAME[2]': {required:true},
            'PASSING_YEAR[2]': {number:true,required:true},
            'BOARD[2]': {required:true},
            'GROUP[2]': {required:true},
            'GPA[2]': {number:true,required:true},
            'GPAWA[2]': {number:true,required:true},
            'INSTITUTE[2]': {required:true},

            'EXAM_NAME[3]': {required:true},
            'PASSING_YEAR[3]': {number:true,required:true},
            'BOARD[3]': {required:true},
            'GROUP[3]': {required:true},
            'GPA[3]': {number:true,required:true},
            'GPAWA[3]': {number:true,required:true},
            'INSTITUTE[3]': {required:true}
        },
        messages: {

            'EXAM_NAME[1]': "Required",
            'PASSING_YEAR[1]': "Required",
            'BOARD[1]': "Required",
            'GROUP[1]': "Required",
            'GPA[1]': "Required",
            'GPAWA[1]': "Required",
            'INSTITUTE[1]': "Required",

            'EXAM_NAME[2]': "Required",
            'PASSING_YEAR[2]': "Required",
            'BOARD[2]': "Required",
            'GROUP[2]': "Required",
            'GPA[2]': "Required",
            'GPAWA[2]': "Required",
            'INSTITUTE[2]': "Required",

            'EXAM_NAME[3]': "Required",
            'PASSING_YEAR[3]': "Required",
            'BOARD[3]': "Required",
            'GROUP[3]': "Required",
            'GPA[3]': "Required",
            'GPAWA[3]': "Required",
            'INSTITUTE[3]': "Required"
        }
    });

    // Cancel Button

    $('#update_academic_cancel_btn').click(function () {
        var STUDENT_ID = $(this).attr('student-data-id');
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: 'post',
            url: "<?php echo site_url(); ?>/" + "/" + action_uri + '/' + STUDENT_ID,
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