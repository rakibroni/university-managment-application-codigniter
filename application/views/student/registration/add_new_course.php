<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<div class="block-flat">
    <form class="form-horizontal frmContent" id="new_course_enrollment" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtnewCourse_typeId" value="<?php echo $exam_type->EXAM_MARKS_TYPE_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <input type="hidden" name="STUDENT_ID" value="<?php echo $student_id; ?>">
        <input type="hidden" name="SESSION_ID" value="<?php echo $session_id; ?>">
        <input type="hidden" name="PROGRAM_ID" value="<?php echo $program_id; ?>">

        <div class="form-group"><label class="col-lg-4 control-label">Course List<span
                    class="text-danger">*</span></label>

            <div class="col-lg-6">
                <select class="Degrees_dropdown form-control required" name="COURSE_ID" id="COURSE_ID"
                        data-tags="true" data-placeholder="Select Course" data-allow-clear="true">

                        <option value="">--- Select Course ---</option>
                        <?php
                        foreach ($course_list as $row):
                            ?>
                            <option value="<?php echo $row->COURSE_ID ?>"> <?php echo '[ '.$row->COURSE_CODE.'] '.$row->COURSE_TITLE.' ['.$row->CREDIT.']'; ?></option>
                            <?php
                        endforeach;
                        ?>
                </select>
                <span class="validation"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Course For<span
                        class="text-danger">*</span></label>

            <div class="col-lg-6">
                <select class="Degrees_dropdown form-control required" name="COURSE_FOR" id="COURSE_FOR"
                        data-tags="true" data-placeholder="Select Course For" data-allow-clear="true">

                    <option value="">--- Select Course ---</option>
                    <option value="F">Final</option>
                    <option value="I">Improved</option>
                    <option value="R">Retake</option>
                </select>
                <span class="validation"></span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="exam/updateExamType"
                           data-su-action="exam/examTypeById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm courseFormSubmit" data-action="teacher/enrolledNewCourse"
                           data-su-action="teacher/newEnrolledCourseList" data-type="list" value="submit">
                    <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>

<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script>
    $(document).on('click', '#status', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>