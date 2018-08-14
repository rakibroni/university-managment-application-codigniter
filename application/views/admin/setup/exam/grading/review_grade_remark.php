<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<div class="block-flat">
    <form class="form-horizontal frmContent" id="review_mark" method="post">

        <input type="hidden" name="SESSION_ID" value="<?php echo $session_id; ?>">
        <input type="hidden" name="DEPT_ID" value="<?php echo $dept_id; ?>">
        <input type="hidden" name="PROGRAM_ID" value="<?php echo $program_id; ?>">
        <input type="hidden" name="BATCH_ID" value="<?php echo $batch_id; ?>">
        <input type="hidden" name="SECTION_ID" value="<?php echo $section_id; ?>">
        <input type="hidden" name="COURSE_ID" value="<?php echo $course_id; ?>">
        <input type="hidden" name="FACULTY_ID" value="<?php echo $faculty_id; ?>">
        <input type="hidden" name="TEACHER_ID" value="<?php echo $teacher_id; ?>">

        <input type="hidden" name="TOTAL_MARK" value="<?php echo $total_mark; ?>">
        <input type="hidden" name="GRADE_POINT" value="<?php echo $grade_point; ?>">
        <input type="hidden" name="GRADE_LETTER" value="<?php echo $grade_letter; ?>">
        <input type="hidden" name="EX_MARKS_ID" value="<?php echo $ex_marks_id; ?>">

        <input type="hidden" name="MARKS" value="<?php echo $total_obtain_per; ?>">
        <input type="hidden" name="TOTAL_GRACE_MARKS" value="<?php echo $total_grace_per; ?>">

        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="STU_ID" value="<?php echo $student_info->STUDENT_ID; ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-4 control-label">Registration No:<span
                    class="text-danger">*</span></label>

            <div class="col-lg-6">
                <input type="text" readonly name="REG_NO" class="form-control  required" value="<?php echo ($ac_type == 2) ? $student_info->REGISTRATION_NO  : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>


        <div class="form-group"><label class="col-lg-4 control-label">Name<span
                    class="text-danger">*</span></label>
            <div class="col-lg-6">
                <input type="text" readonly name="STU_FULL_NAME" class="form-control  required" value="<?php echo ($ac_type == 2) ? $student_info->FULL_NAME_EN  : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-lg-4 control-label">Remark<span
                    class="text-danger"></span></label>

            <div class="col-lg-6">
                <textarea id="" name="REMARK" class="form-control"
                          placeholder="Remark"><?php // echo ($ac_type == 2) ?  $grade_policy->GR_POLICY_DESC : '' ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- </span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>


        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <span class="modal_msg pull-left"></span>
                <?php if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm form_submit" data-action="exam/gradeSheetReviewInsert"
                           data-view-div="reviewGradeSheet"  data-su-action="exam/reviewResultGradeSheet" data-type="list" value="submit">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm form_submit" data-action="exam/createGradeSheet"
                           data-view-div="reviewGradeSheet"  data-su-action="exam/gradeSheetList" data-type="list" value="submit">

                    <input type="button" class="btn btn-primary btn-sm form_submit " data-view-div="reviewGradeSheet" data-action="course/createCourseMap"
                           data-su-action="course/teacheSessionWiseCourseMap"
                           data-type="list" value="Submit" aria-invalid="false">
                    <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>

<!--<script src="--><?php //echo base_url(); ?><!--assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>-->
<script>
    //    $(function () {
    //        $(".datepicker").datepicker({
    //            changeMonth: true,
    //            changeYear: true,
    //            dateFormat: 'dd-mm-yy',
    //            yearRange: "-50:+0",
    //            autoclose: true,
    //            startDate: '-0d',
    //        });
    //    });

    $(document).on('click', '#status', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });

    $("#checkAll").click(function(){
        $('.checked').not(this).prop('checked', this.checked);
    });

</script>