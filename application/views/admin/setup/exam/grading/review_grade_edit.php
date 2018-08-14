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
                <input type="text" readonly name="REG_NO" class="form-control  required"
                value="<?php echo ($ac_type == 2) ? $student_info->REGISTRATION_NO : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>


        <div class="form-group"><label class="col-lg-4 control-label">Name<span
            class="text-danger">*</span></label>
            <div class="col-lg-6">
                <input type="text" readonly name="STU_FULL_NAME" class="form-control  required"
                value="<?php echo ($ac_type == 2) ? $student_info->FULL_NAME_EN : '' ?>">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <div class="col-lg-12">
                <div id="charge_table">
                    <center>
                        <table style="width: 80%"
                        class="table table-bordered table-striped table-hover table-responsive">
                        <tr class="info">
                            <td class="col-md-3"><b>Marks Type</b></td>
                            <td class="col-md-1 text-center"><b>Allocation Mark</b></td>
                            <td class="col-md-1 text-center"><b>Obtain Mark</b></td>
                            <td class="col-md-1 text-center"><b>Grace Mark</b></td>
                        </tr>

                        <?php $total = 0;
                        foreach ($stu_mark_info as $row): ?>
                        <input type="hidden" name="EX_MARKS_ID[]" value="<?php echo $row->EX_MARKS_ID; ?>">
                        <input type="hidden" name="ALLOCATION_MARKS[]" value="<?php echo $row->ALLOCATION_MARKS; ?>">
                        <input type="hidden" name="MARKS_PER[]" value="<?php echo $row->MARKS_PER; ?>">
                        <tr>
                            <input name="MARK_TYPE_ID[]" type="hidden"
                            value="<?php echo $row->EXAM_MARKS_TYPE_ID ?>">
                            <td><?php echo $row->MARKS_TITLE.' ('.$row->MARKS_PER.'%) ';  ?></td>
                            <td class="text-center">
                                <?php echo $row->ALLOCATION_MARKS; ?>
                            </td>
                            <td>
                                <input type="number" id="OBTAIN_MARKS" name="OBTAIN_MARKS[]"
                                class="form-control text-center marks" value="<?php echo $row->OBTAIN_MARKS; ?>"
                                placeholder="">
                                <input type="hidden" name="totalMark"
                                value="<?php echo $total += $row->MARKS; ?>">
                            </td>
                            <td>
                                <input type="number" id="GRACE_MARKS" name="GRACE_MARKS[]"
                                class="form-control text-center marks" value="<?php echo $row->GRACE_MARKS; ?>"
                                placeholder="">
                                <input type="hidden" name="totalMark"
                                value="<?php echo $total += $row->MARKS; ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
<!--                    <tr>-->
<!--                        <td   colspan="4"><b class="pull-right">Total: </b></td>-->
<!---->
<!--                        <td class="text-center" id="total_marks"><b></b></td>-->
<!--                    </tr>-->
                </table>
            </center>
        </div>
        <span class="validation"></span>
    </div>
</div>

<div class="form-group">
    <div class="col-lg-offset-4 col-lg-8">
        <span class="modal_msg pull-left"></span>
        <?php if ($ac_type == 2) { ?>
        <input type="button" class="btn btn-primary btn-sm form_submit" data-action="exam/updateReviewGrade"
        data-view-div="reviewGradeSheet" data-su-action="exam/reviewResultGradeSheet"
        data-type="list" value="submit">
        <?php } else { ?>
        <input type="button" class="btn btn-primary btn-sm form_submit" data-action="exam/createGradeSheet"
        data-view-div="reviewGradeSheet" data-su-action="exam/gradeSheetList" data-type="list"
        value="submit">

        <input type="button" class="btn btn-primary btn-sm form_submit " data-view-div="reviewGradeSheet"
        data-action="course/createCourseMap"
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


<script>

    $(document).on('click', '#status', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });

    $("#checkAll").click(function () {
        $('.checked').not(this).prop('checked', this.checked);
    });


    // Total Marks Calculation

    $(document).ready(function () {

        calculateExamTotalMarks();

        $('.total_per_marks').on('keyup', function () {
            calculateExamTotalMarks();
        });

        function calculateExamTotalMarks() {
            var sum = 0;
            $('.total_per_marks').each(function () {
                var thisVal = (($(this).val().length === 0)) ? 0 : $(this).val();
                sum += parseFloat(thisVal);
            });
            $('#total_marks').html(sum);
        }

    });


</script>