<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Exam Schedule</h5>
        <a title="Create Exam" class="btn btn-primary btn-xs pull-right"
           href="examScheduleList"> Back </a>
    </div>
    <div class="ibox-content">
        <div class="col-md-7">
            <form class="form-horizontal" id="exam_schedule_form" method="post">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Exam<span style="color: red"> *</span></label>

                    <div class="col-lg-4">
                        <select name="EXAM_ID" id="EXAM_ID" class="form-control select2Dropdown" required="required">
                            <option value="0">-Select-</option>
                            <?php foreach ($exam as $er): ?>
                                <option value="<?php echo $er->EXAM_ID ?>"> <?php echo $er->EX_TITLE ?>
                                    [<?php echo $er->SESSION_NAME ?>]
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Start Date</label>

                    <div class="col-lg-3">
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="form-control datepicker" name="START_DATE"
                                   id="START_DATE">
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Time</label>

                    <div class="col-lg-3">
                        <div class="input-group col-lg-12 clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" name="START_TIME" id="START_TIME" value="" placeholder="Start">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                        <div class="form-control-message"></div>
                    </div>
                    <div class="col-lg-3">
                        <div class="input-group col-lg-12 clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" name="END_TIME" id="END_TIME" value="" placeholder="End">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                        <div class="form-control-message"></div>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Room No<span style="color: red"> *</span></label>

                    <div class="col-lg-4">
                        <select name="BR_ID" id="BR_ID" class="form-control select2Dropdown" required="required">
                            <option value="0">-Select-</option>
                            <?php foreach ($room as $row): ?>
                                <option value="<?php echo $row->BR_ID ?>"> <?php echo $row->BR_NAME ?>
                                    &nbsp;[ <?php echo $row->BR_CODE ?> ]
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Roll No<span style="color: red"> *</span></label>

                    <div class="col-lg-3">
                        <input type="text" name="ROLL_NO_FROM" id="ROLL_NO_FROM" class="form-control"
                               placeholder="From">
                    </div>
                    <div class="col-lg-3">
                        <input type="text" name="ROLL_NO_TO" id="ROLL_NO_TO" class="form-control" placeholder="To">
                    </div>
                </div>


                <div class="hr-line-dashed"></div>
                <?php $this->load->view("common/faculty_dept_program"); ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label"><span>Course</span></label>

                    <div class="col-lg-7">
                        <select class="select2Dropdown  form-control commonClass required" name="COURSE_ID" id="COURSES"
                                data-tags="true" data-placeholder="Select Course" data-allow-clear="true">
                            <option value="">Select Course</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
               <!-- <div class="form-group">
                    <label class="col-lg-4 control-label"><span>Session</span></label>

                    <div class="col-lg-4">
                        <select class="form-control" name="SESSION_ID">
                            <option value="">-Select-</option>
                            <?php /*foreach ($session as $row): */?>
                                <option
                                    value="<?php /*echo $row->SESSION_ID */?>" <?php /*if ($ac_type == "edit") echo ($previous_info->SESSION_ID == $row->SESSION_ID) ? 'selected' : '' */?>><?php /*echo $row->SESSION_NAME */?></option>
                            <?php /*endforeach; */?>
                        </select>
                    </div>
                </div>-->
                <div class="form-group">
                    <label class="col-lg-6 control-label"></label>
                    <input type="reset" value="Reset" class="btn btn-sm btn-default">
                    <input type="button" id="schedule_save_btn" value="Submit" class="btn btn-sm badge-primary">
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div id="ex_pre_schedule"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#schedule_save_btn").on('click', function () {
            var exam_schedule_form = $("#exam_schedule_form").serialize();

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>coe/save_exam_schedule",
                data: exam_schedule_form,
                success: function (data) {
                    if (data == 'Y') {
                        alert("Exam schedule inserted successfully");
                        window.location.replace("<?php echo base_url(); ?>coe/examSchedule");

                    }
                }

            });
        });
        $("#PROGRAM_ID").on('change', function () {
            var PROGRAM_ID = $(this).val();

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('coe/course_by_program'); ?>',
                data: {PROGRAM_ID: PROGRAM_ID},
                success: function (data) {
                    if (data) {
                        $("#COURSES").html(data);

                    }
                }

            });
        });
        $("#START_DATE").on('blur', function () {
            $("#BR_ID").val("0");

        });
        $("#BR_ID").on('change', function () {
            var BR_ID = $(this).val();
            START_DATE = $("#START_DATE").val();
            if (START_DATE == '') {
                alert("Date field required");
                $("#START_DATE").focus();
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('coe/exam_schedule_by_room_id'); ?>',
                    data: {BR_ID: BR_ID, START_DATE: START_DATE},
                    success: function (data) {
                        if (data) {
                            $("#ex_pre_schedule").html(data);

                        } else {
                            $("#ex_pre_schedule").html("No course found");
                        }
                    }

                });
            }

        });


    });
</script>

