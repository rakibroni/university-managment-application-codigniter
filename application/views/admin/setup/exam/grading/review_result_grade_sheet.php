<style type="text/css">

    table#interpretation_tbl {
        width: 100%;
        padding: 0px !important;
        background-color: #f1f1c1;
    }

    table#interpretation_tbl th, td {
        padding: 1px !important;

    }
</style>


<div id="reviewGradeSheet" class="contentArea">
    <div class="row">
        <div class="col-md-12">
            <button id="print_grade_sheet_btn" class="btn btn-xs btn-danger pull-right"><i class="fa fa-print"></i>Print
            </button>
        </div>

    </div>

    <div class="row ">

        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <td class="text-center"><img width="70"
                                                 src="<?php echo base_url(); ?>/assets/img/logo/kyau_web.png"></td>
                </tr>
                <tr>
                    <td class="text-center"><h4><b>KHWAJA YUNUS ALI UNIVERSITY<br>Grade Sheet</b></h4></td>
                </tr>

            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Department:</th>
                    <td><?php echo $ins_dept->DEPT_ABBR ?></td>
                    <th>Batch No:</th>
                    <td><?php echo $aca_batch->BATCH_TITLE ?></td>
                </tr>
                <tr>
                    <th>Program:</th>
                    <td><?php echo $ins_program->PROGRAM_SHORT_NAME ?></td>
                    <th>Examination:</th>
                    <td><?php echo $session->SESSION_NAME ?></td>
                </tr>
                <tr>
                    <th>Course Code:</th>
                    <td><?php echo $aca_course->COURSE_CODE ?></td>
                    <th>Credit:</th>
                    <td><?php echo $aca_course->CREDIT ?></td>
                </tr>
                <tr>
                    <th>Course Title:</th>
                    <td><?php echo $aca_course->COURSE_TITLE ?></td>
                    <th>Section:</th>
                    <td><?php echo $aca_section->NAME ?></td>
                </tr>
                <tr>
                    <th>Course Teacher:</th>
                    <td><?php echo $employe->FULL_ENAME ?></td>
                    <th>Date of Submission:</th>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            <table id="interpretation_tbl" class="table table-bordered" style="">
                <tr>
                    <th colspan="3" class="text-center">INTERPRETATION OF GRADE</th>
                </tr>
                <tr>
                    <th class="text-center">Range of Marks</th>
                    <th class="text-center">Grade Points</th>
                    <th class="text-center">Letter Grade</th>
                </tr>
                <?php if (!empty($exam_grade)): foreach ($exam_grade as $roweg): ?>
                    <tr>
                        <td class="text-center"
                            colspan="<?php if ($roweg->GR_LETTER == 'I' || $roweg->GR_LETTER == 'W') {
                                echo "2";
                            } ?> ">
                            <?php
                            if ($roweg->GR_LETTER == 'I') {
                                echo "Incomplete";
                            } elseif ($roweg->GR_LETTER == 'W') {
                                echo "Withdrawal";
                            } else {
                                echo $roweg->GR_MARKS_FROM . '% - ' . $roweg->GR_MARKS_TO . '%';
                            }

                            ?>

                        </td>
                        <?php if ($roweg->GR_LETTER == 'I' || $roweg->GR_LETTER == 'W') { ?>

                        <?php } else { ?>
                            <td class="text-center"><?php echo $roweg->GRADE_POINT; ?></td>
                        <?php } ?>
                        <td class="text-center"><?php echo $roweg->GR_LETTER; ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered table-hover">
                <tr>
                    <th class="text-center">Sl. No.</th>
                    <th>Registration No. (ID)</th>
                    <th>Name of the student</th>
                    <?php
                    $mark_type_id = array();
                    if (!empty($exam_grade_sheet)) {
                        foreach ($exam_grade_sheet as $row) {
                            $mark_type_id [] = $row->EXAM_MARKS_TYPE_ID;
                            ?>
                            <th><?php echo $row->MARKS_TITLE . ' (' . $row->MARKS_PER . ')'; ?></th>
                        <?php }
                    } ?>

                    <th>Total Marks(100)</th>
                    <th>Grade point(GP)</th>
                    <th>Letter Grade(LG)</th>
                    <th>Remarks</th>
                    <th class="col-md-1">Action</th>
                </tr>
                <?php
                if (!empty($course_student)) {
                    $sl = 1;
                    foreach ($course_student as $row) {
                        ?>
                        <tr class=" <?php echo ($row->REVIEW_STATUS == 0) ? '' : 'success' ?>">
                            <td class="text-center"><?php echo $sl++; ?></td>
                            <td><?php echo $row->REGISTRATION_NO; ?></td>
                            <td><?php echo $row->FULL_NAME_EN; ?></td>


                            <?php $total_marks = 0;
                            $total_obtain_per = 0;
                            $total_grace_per = 0;
                            foreach ($mark_type_id as $key => $value) { ?>
                                <td class="text-center">
                                    <?php
                                    $student_mark = $this->exam_model->getCourseMarkByStudent($row->PROGRAM_ID, $row->BATCH_ID, $row->SECTION_ID, $row->SESSION_ID, $row->COURSE_ID, $row->STUDENT_ID, $value);

                                    if (!empty($student_mark)):
                                        $total_obtain_per += $student_mark->MARKS;

                                        $total_grace_per += $student_mark->GRACE_MARKS_PER;
                                        $marks_with_grace = $student_mark->MARKS + $student_mark->GRACE_MARKS_PER;
                                        $total_marks += $marks_with_grace;
                                        echo $marks_with_grace;
                                    endif;
                                    // echo $value;
                                    ?></td>
                            <?php } ?>

                            <input type="hidden" id="total_obtain_per_<?php echo $row->STUDENT_ID; ?>"
                                   value="<?php echo $total_obtain_per; ?>">
                            <input type="hidden" id="total_grace_per_<?php echo $row->STUDENT_ID; ?>"
                                   value="<?php echo $total_grace_per; ?>">
                            <input type="hidden" id="ex_marks_id_<?php echo $row->STUDENT_ID; ?>"
                                   value="<?php echo $row->EX_MARKS_ID; ?>">
                            <td class="text-center"
                                id="total_marks_<?php echo $row->STUDENT_ID; ?>"><?php echo $total_marks; ?></td>
                            <td class="text-center"
                                id="grade_point_<?php echo $row->STUDENT_ID; ?>"><?php echo $this->exam_model->gradePointLetter($total_marks)->GRADE_POINT; ?></td>
                            <td class="text-center"
                                id="grade_letter_<?php echo $row->STUDENT_ID; ?>"><?php echo $this->exam_model->gradePointLetter($total_marks)->GR_LETTER; ?></td>
                            <td></td>
                            <td class="text-center">
                                <div style="display: inline">

                                    <?php if ($row->REVIEW_STATUS != 1) : ?>

                                        <a class="label label-success openMarkReviewModal"
                                           data-stu-id="<?php echo $row->STUDENT_ID; ?>"
                                           data-session-id="<?php echo $SESSION_ID; ?>"
                                           data-dept-id="<?php echo $DEPT_ID; ?>"
                                           data-program-id="<?php echo $PROGRAM_ID; ?>"
                                           data-batch-id="<?php echo $BATCH_ID; ?>"
                                           data-section-id="<?php echo $SECTION_ID; ?>"
                                           data-course-id="<?php echo $COURSE_ID; ?>"
                                           data-faculty-id="<?php echo $FACULTY_ID; ?>"
                                           data-teacher-id="<?php echo $TEACHER_ID; ?>"
                                           title="Update Exam Marks" data-action="exam/reviewMarkFormUpdate"
                                           data-type="edit"><i class="fa fa-pencil"></i></a>

                                        <a class="label label-primary openMarkReviewModal"
                                           data-stu-id="<?php echo $row->STUDENT_ID; ?>"
                                           data-session-id="<?php echo $SESSION_ID; ?>"
                                           data-dept-id="<?php echo $DEPT_ID; ?>"
                                           data-program-id="<?php echo $PROGRAM_ID; ?>"
                                           data-batch-id="<?php echo $BATCH_ID; ?>"
                                           data-section-id="<?php echo $SECTION_ID; ?>"
                                           data-course-id="<?php echo $COURSE_ID; ?>"
                                           data-faculty-id="<?php echo $FACULTY_ID; ?>"
                                           data-teacher-id="<?php echo $TEACHER_ID; ?>"
                                           title="Confirm Mark Review" data-action="exam/gradeSheetReview"
                                           data-type="edit"><i class="fa fa-check"></i></a>

                                    <?php endif; ?>
                                </div>


                            </td>

                        </tr>

                    <?php }
                } ?>
            </table>
            <?php //print_r($mark_type_id); ?>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-4">
            <table>
                <tr>
                    <td>..................................................<br>Signature of Course Teacher</td>
                </tr>
                <tr>
                    <td>Date:........................................</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            <center>
                <table>
                    <tr>
                        <td>..................................................<br>Signature of Scrutinizer</td>
                    </tr>
                    <tr>
                        <td>Date:........................................</td>
                    </tr>
                </table>
            </center>

        </div>
        <div class="col-md-4">
            <table class="pull-right">
                <tr>
                    <td>..................................................<br>Signature of Head With Seal</td>
                </tr>
                <tr>
                    <td>Date:........................................</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {


        $("#print_grade_sheet_btn").click(function () {
            $('#printablediv').printThis({
                pageTitle: "Grade Sheet",
                loadCSS: "",
                header: "<h1>Grade Sheet</h1>"
            });
        });

    });


    $(document).on("click", ".openMarkReviewModal", function () {
        $(".commonModal").modal();
        var param_value = "";
        var action_type = $(this).attr("data-type");
        var action_uri = $(this).attr("data-action");

        var stu_id = $(this).attr("data-stu-id");
        var session_id = $(this).attr("data-session-id");
        var dept_id = $(this).attr("data-dept-id");
        var program_id = $(this).attr("data-program-id");
        var batch_id = $(this).attr("data-batch-id");
        var section_id = $(this).attr("data-section-id");
        var course_id = $(this).attr("data-course-id");
        var faculty_id = $(this).attr("data-faculty-id");
        var teacher_id = $(this).attr("data-teacher-id");

        var total_obtain_per = $("#total_obtain_per_" + stu_id).val();
        var total_grace_per = $("#total_grace_per_" + stu_id).val();


        var total_mark = $("#total_marks_" + stu_id).text();
        var grade_point = $("#grade_point_" + stu_id).text();
        var grade_letter = $("#grade_letter_" + stu_id).text();
        var ex_marks_id = $("#ex_marks_id_" + stu_id).val();

        //alert(total_mark + grade_point + grade_letter);
        //alert(ex_marks_id);


        var title = $(this).attr("title");
        if (action_type == "edit") {
            param_value = $(this).attr("id");
        }
        if (action_type == "delete") {
            param_value = $(this).attr("id");
        }
        $.ajax({
            type: "post",
            url: "<?php echo site_url(); ?>/" + action_uri,
            data: {
                stu_id: stu_id,
                session_id: session_id,
                dept_id: dept_id,
                program_id: program_id,
                batch_id: batch_id,
                section_id: section_id,
                course_id: course_id,
                faculty_id: faculty_id,
                teacher_id: teacher_id,
                total_mark: total_mark,
                grade_point: grade_point,
                grade_letter: grade_letter,
                ex_marks_id: ex_marks_id,
                total_obtain_per: total_obtain_per,
                total_grace_per: total_grace_per
            },
            beforeSend: function () {
                $(".commonModal .modal-title").html(title);
                $(".commonModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".commonModal .modal-body").html(data);
                $(".select2Dropdown").select2();
            }
        });
    });

</script>