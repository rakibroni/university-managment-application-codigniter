<style type="text/css">

    table#interpretation_tbl {        
        padding: 0px !important;
        background-color: #f1f1c1;
    }


</style>

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Partial Academic Transcript</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-md-12">
                <button id="print_grade_sheet_btn" class="btn btn-xs btn-danger pull-right"><i class="fa fa-print"></i>Print
                </button>
            </div>

        </div>
        <div id="printablediv" class="contentArea">

            <table class="table">
                <tr>
                    <td>
                        <table class="table table-bordered">
                            <tr class="text-center">
                            <td  colspan="4">
                                    <h2><img width="60" src="<?php echo base_url(); ?>/assets/img/logo/kyau_web.png"> &nbsp;<b>KHWAJA YUNUS ALI UNIVERSITY</b></h2>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-center"  colspan="4" style="padding: 0px !important">
                                    <b><?php echo $student_info->PROGRAM_NAME . ' (' . $student_info->PROGRAM_SHORT_NAME . ')'; ?></b>
                                    <p>(Under Semester System)</p>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-center" style="padding: 0px !important"><h3><u>Partial Academic Transcript</u></h3></th>
                            </tr>
                            <tr>
                                <th>Name of the Student:</th>
                                <td><?php echo $student_info->FULL_NAME_EN ?></td>
                                <th>Registration No:</th>
                                <td><?php echo $student_info->REGISTRATION_NO ?></td>
                            </tr>
                            <tr>
                                <th>Department:</th>
                                <td><?php echo $student_info->DEPT_NAME ?></td>
                                <th>Faculty:</th>
                                <td><?php echo $student_info->FACULTY_NAME ?></td>
                            </tr>
                            <tr>
                                <th>Session:</th>
                                <td><?php echo $student_info->adm_session_name ?></td>
                                <th>Batch:</th>
                                <td><?php echo $batch->BATCH_TITLE; ?></td>
                            </tr>

                        </table>
                    </td>
                    <td>
                        <table id="interpretation_tbl" class="table-bordered" >
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
                </td>
            </tr>

        </table>






        <br>





        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th class="text-center" rowspan="2" style="vertical-align: middle !important;">Course Code and
                    Title
                </th>
                <th colspan="6" class="text-center">RESULTS</th>
            </tr>
            <tr>
                <th class="text-center">Credit<br>Hours</th>
                <th class="text-center">Grade<br>Point</th>
                <th class="text-center">Letter<br>Grade</th>
                <th class="text-center">Points<br>Secured</th>
            </tr>

            <?php

            $completed_credit_hrs = 0.00;

            $total_credit_hrs = $this->db->query("SELECT SUM(b.CREDIT) AS TOTAL_CREDIT  FROM aca_semester_course a 
                LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID
                WHERE a.SESSION_ID = $SESSION_ID AND a.FACULTY_ID = $FACULTY_ID
                AND a.DEPT_ID = $DEPT_ID AND a.PROGRAM_ID = $PROGRAM_ID GROUP BY a.SESSION_ID")->result();

                foreach ($count_row as $c_row) : ?>

                <?php

                $transcript_data = $this->db->query("SELECT * FROM exam_tabulation_sheet a
                  LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID
                  WHERE a.STUDENT_ID = $STUDENT_ID AND a.SESSION_ID = $c_row->SESSION_ID")->result();
                  ?>

                  <?php foreach ($transcript_data as $row) : ?>

                    <tr>
                        <td><?php echo $row->COURSE_CODE . ':' . ' ' . $row->COURSE_TITLE; ?></td>
                        <td class="text-center"><?php $completed_credit_hrs += $row->CREDIT;
                            echo $row->CREDIT; ?></td>
                            <td class="text-center"><?php echo $row->GRADE_POINT; ?></td>
                            <td class="text-center"><?php echo $row->GRADE_LETTER; ?></td>
                            <td class="text-center"><?php echo $row->POINTS_SEQURED; ?></td>
                        </tr>

                    <?php endforeach; ?>

                <?php endforeach; ?>


            </table>
            <div class="col-md-12 text-center">
                <p colspan="7"><b>GPA</b>=&#931;Points Secured for a Semester/&#931;Credits Earned for a Semester.
                    <b>CGPA</b>=&#931;Points
                    Secured for all Semester/&#931;Credits Earned for all Semester.</p>
                </div> 
                <br><br> 
                <div class="col-md-12">
                    <p><b><?php echo 'Required Credit Hours: ' . $total_credit_hrs[0]->TOTAL_CREDIT;; ?></b></p>
                    <p><b><?php echo 'Completed Credit Hours: ' . $completed_credit_hrs; ?></b></p>
                </div> 
                <br><br>

                <table class="table">

                    <tr>
                        <td><b>Administration Office</b><br>Enayetpur, Sirajgonj</td>
                        <td>Verified by: ______________________</td>
                        <td><b>Controller of Examinations</b><br>Khwaja Yunus Ali University</td>
                    </tr>

                </table> 
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/printThis.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {


            $("#print_grade_sheet_btn").click(function () {
                $('#printablediv').printThis({
                    pageTitle: "",
                    loadCSS: "",
                    header: "<h1>Partial Academic Transcript</h1>"
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

            var total_mark = $("#total_marks_" + stu_id).text();
            var grade_point = $("#grade_point_" + stu_id).text();
            var grade_letter = $("#grade_letter_" + stu_id).text();
            var ex_marks_id = $("#ex_marks_id_" + stu_id).val();


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
                    ex_marks_id: ex_marks_id
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