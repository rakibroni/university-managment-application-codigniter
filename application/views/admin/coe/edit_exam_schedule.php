<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Exam Schedule</h5>
        <a   href="<?php echo base_url()?>coe/examScheduleList" class="btn btn-primary btn-sm pull-right"> Back </a>
    </div>
    <div class="ibox-content">
        <div class="col-md-8">
            <form class="form-horizontal" id="exam_schedule_form" method="post">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Exam<span style="color: red"> *</span></label>

                    <div class="col-lg-7">
                        <input type="hidden" name="EX_SC_ID" id="EX_SC_ID" value="<?php echo $previous_info->EX_SC_ID ?>">
                        <select name="EXAM_ID" id="EXAM_ID" class="form-control" required="required">
                            <option value="0">-Select-</option>
                            <?php foreach ($exam as $er): ?>
                                <option value="<?php echo $er->EXAM_ID ?>" <?php echo ($er->EXAM_ID == $previous_info->EXAM_ID)?"selected":"" ?> > <?php echo $er->EX_TITLE ?>
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
                            <input type="text" value="<?php echo $previous_info->START_DT ?>" class="form-control datepicker" name="START_DATE"
                                   id="START_DATE">
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Start Time</label>

                    <div class="col-lg-6">
                        <div class="input-group col-lg-3 clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" name="START_TIME" id="START_TIME" value="<?php echo $previous_info->START_TIME ?>">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                        <div class="form-control-message"></div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">End Time</label>

                    <div class="col-lg-6">
                        <div class="input-group col-lg-3 clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" name="END_TIME" id="END_TIME" value="<?php echo $previous_info->END_TIME ?>">
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

                    <div class="col-lg-7">
                        <select name="BR_ID" id="BR_ID" class="form-control" required="required">
                            <option value="0">-Select-</option>
                            <?php foreach ($room as $row): ?>
                                <option value="<?php echo $row->BR_ID ?>" <?php echo ($row->BR_ID == $previous_info->BR_ID)?"selected":"" ?>> <?php echo $row->BR_NAME ?>
                                    &nbsp;[ <?php echo $row->BR_CODE ?> ]
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Roll No From<span style="color: red"> *</span></label>

                    <div class="col-lg-6">
                        <input type="text" name="ROLL_NO_FROM" id="ROLL_NO_FROM" class="form-control" value="<?php echo $previous_info->ROLL_NO_FROM ?>">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Roll No To<span style="color: red"> *</span></label>

                    <div class="col-lg-6">
                        <input type="text" name="ROLL_NO_TO" id="ROLL_NO_TO" value="<?php echo $previous_info->ROLL_NO_TO ?>" class="form-control">
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
                            <?php foreach($course as $row): ?>
                            <option value="<?php echo $row->COURSE_ID ?>" <?php echo  ($row->COURSE_ID == $previous_info->COURSE_ID)?"selected":""?>><?php echo $row->COURSE_TITLE ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-4 control-label"><span>Session</span></label>

                    <div class="col-lg-4">
                        <select class="form-control" name="SESSION_ID">
                            <option value="">-Select-</option>
                            <?php foreach ($session as $row): ?>
                                <option
                                    value="<?php echo $row->SESSION_ID ?>" <?php echo ($row->SESSION_ID == $previous_info->SESSION_ID)?"selected":"" ?>><?php echo $row->SESSION_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-6 control-label"></label>
                    <input type="reset" value="Reset" class="btn btn-sm btn-default">
                    <input type="button" id="schedule_update_btn" value="Update" class="btn btn-sm badge-primary">
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div id="ex_pre_schedule">

                <?php  if(!empty($schedule)) { ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <td>Course</td>
                            <td>Start Time</td>
                            <td>End Time</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($schedule as $row): ?>
                            <tr>
                                <td><?php echo $row->COURSE_TITLE ?></td>
                                <td><?php echo $row->START_TIME ?></td>
                                <td><?php echo $row->END_TIME ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php  }else{ echo '<span style="color:red"><b>No Exam Schedule Found</b></span>';} ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#schedule_update_btn").on('click', function () {
            var exam_schedule_form = $("#exam_schedule_form").serialize();
            EX_SC_ID=$("#EX_SC_ID").val();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>coe/updateExamSchedule",
                data: exam_schedule_form,
                success: function (data) {
                    if (data == 'Y') {
                        alert("Exam schedule updated successfully");
                        window.location.replace("<?php echo base_url(); ?>coe/examScheduleEdit/"+EX_SC_ID);

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

