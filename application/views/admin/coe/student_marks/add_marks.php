<style>
    .select2-container {
        z-index: 999999;
    }

    .pop-width {
        width: 25%;
    }
</style>

<form class="form-horizontal frmContent" id="marks" method="post">
    <div class="block-flat">
        <?php if ($ac_type == "edit") { ?>
            <input type="hidden" name="EX_MARKS_ID" class="rowID" value="<?php echo $student->EX_MARKS_ID; ?>"/>
        <?php } ?>
        <span class="frmMsg"></span>
        <?php $this->load->view("common/faculty_dept_program"); ?>
        <?php $this->load->view("common/semester_session"); ?>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label">Student Id <span class="text-danger">*</span></label>

            <div class="col-lg-5">
                <select class="select2Dropdown form-control required" name="STUDENT_ID" id="STUDENT_ID" data-tags="true"
                        data-placeholder="Select STUDENT ID" data-allow-clear="true">
                    <?php
                    if ($ac_type == "edit"): // if the form action is EDIT
                        ?>
                        <option
                            value="<?php echo $student->STUDENT_ID ?>" <?php echo ($previous_info->STUDENT_ID == $student->STUDENT_ID) ? 'selected' : '' ?>><?php echo $student->STUDENT_ID ?></option>
                    <?php
                    else: // if the form action is VIEW
                        ?>
                        <option value="">Select Student Id</option>
                    <?php endif; ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>
        <?php
        if ($ac_type == "edit"): // if the form action is EDIT
            ?>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-md-4 control-label"><?php echo $student->COURSE_CODE . " " . $student->COURSE_TITLE ?>
                    <span class="text-danger">*</span></label>

                <div class="col-lg-5">
                    <input type="number" class="required" value="<?php echo $student->MARKS; ?>" name="marks"
                           data-duration="marks_<?php echo $student->COURSE_ID; ?>"
                           id="marks_<?php echo $student->COURSE_ID; ?>" style="width:60px ;">
                    <span class="validation"></span>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-9 col-lg-offset-1">
                <span id="courseList"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-md-4 control-label">Active?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $student->ACTIVE_STATUS : '';
                $checked = ($ac_type == "edit") ? (($student->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'status',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">click for active status.</span>
            </div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-10">
            <!--<span class="modal_msg pull-left"></span>-->
            <?php if ($ac_type == "edit") { ?>
                <input type="button" class="btn btn-primary btn-sm btnSubmit" data-action="Coe/updateMarks"
                       data-su-action="Coe/studentMarksById" value="Update">
            <?php } else { ?>
                <input type="button" class="btn btn-primary btn-sm btnSubmit" data-action="Coe/createMarks"
                       data-su-action="Coe/marksList" data-type="list" value="Submit">
            <?php
            }
            ?>
            <input type="reset" class="btn btn-default btn-sm" value="Reset">
            <span class="loadingImg"></span>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);
    });
    $('#SESSION_ID').change(function () {
        var is_valid = 0;
        var reg_period = $("#REG_PERIOD_ID").val();
        var session = $("#SESSION_ID").val();
        var semester = $("#SEMESTER_ID").val();
        var faculty = $("#FACULTY_ID").val();
        var dept = $("#DEPT_ID").val();
        var program = $("#PROGRAM_ID").val();
        if (reg_period == '' || session == '' || semester == '' || faculty == '' || dept == '' || program == '') {
            if (reg_period == '') {
                alert('Registration Period Select !!');
            } else if (faculty == '') {
                alert('Faculty Select !!');
            } else if (dept == '') {
                alert('Department Select !!');
            } else if (program == '') {
                alert('Program Select !!');
            } else if (semester == '') {
                alert('Semester Select !!');
            } else if (session == '') {
                alert('Session Select !!');
            }

        } else {
            var data = $("#marks").serialize();
            var action_url = '<?php echo site_url('Coe/searchSemesterStudent') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: data,
                dataType: 'html',
                success: function (data) {
                    $('#STUDENT_ID').html(data);
                }
            });
        }
    });
    $('#STUDENT_ID').change(function () {
        var is_valid = 0;
        var reg_period = $("#REG_PERIOD_ID").val();
        var session = $("#SESSION_ID").val();
        var semester = $("#SEMESTER_ID").val();
        var faculty = $("#FACULTY_ID").val();
        var dept = $("#DEPT_ID").val();
        var program = $("#PROGRAM_ID").val();
        var student = $("#STUDENT_ID").val();
        if (reg_period == '' || session == '' || semester == '' || faculty == '' || dept == '' || program == '' || student == '') {
            if (reg_period == '') {
                alert('Registration Period Select !!');
            } else if (faculty == '') {
                alert('Faculty Select !!');
            } else if (dept == '') {
                alert('Department Select !!');
            } else if (program == '') {
                alert('Program Select !!');
            } else if (semester == '') {
                alert('Semester Select !!');
            } else if (session == '') {
                alert('Session Select !!');
            } else if (student == '') {
                alert('Session Select !!');
            }

        } else {
            var data = $("#marks").serialize();
            var action_url = '<?php echo site_url('Coe/showCourseList') ?>';
            $.ajax({
                type: "POST",
                url: action_url,
                data: data,
                dataType: 'html',
                success: function (data) {
                    $('#courseList').html(data);
                }
            });
        }
    });
</script>
