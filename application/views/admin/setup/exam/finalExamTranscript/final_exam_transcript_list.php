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
    <div class="row">
        <div class="col-md-12">
            <button id="print_grade_sheet_btn" class="btn btn-xs btn-danger pull-right"><i class="fa fa-print"></i>Print
            </button>
        </div>

    </div>
<div id="printablediv" class="contentArea">

    <div class="col-md-12">
        <table class="table table-bordered">
            <tr>
                <td class="text-center"><img width="70" src="<?php echo base_url(); ?>/assets/img/logo/kyau_web.png">
                </td>
            </tr>
            <tr class="text-center">
                <td>
                    <h2><b>KHWAJA YUNUS ALI UNIVERSITY</b></h2>
                    <p>Founder: Dr. Mir Mohammad Amjad Hussain</p>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <b><?php echo 'Final Examination of ' . $academic_session->SESSION_NAME; ?></b>

                </td>
            </tr>

        </table>
    </div>


    <div class="col-md-12">

        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th class="text-center" rowspan="2" style="vertical-align: middle !important;">No.</th>
                <th class="text-center" rowspan="2" style="vertical-align: middle !important;">Regi. No. (ID)</th>
                <th class="text-center" rowspan="2" style="vertical-align: middle !important;">Name</th>
                <th class="text-center" rowspan="2" style="vertical-align: middle !important;">Department</th>
                <th class="text-center" rowspan="2" style="vertical-align: middle !important;">Batch No.</th>
                <th colspan="2" style="vertical-align: middle" class="text-center">RETAKE</th>
                <th colspan="2" style="vertical-align: middle" class="text-center">IMPROVEMENT</th>
                <th class="text-center">Total Credits</th>
                <th class="text-center">Admit Card Number</th>
            </tr>
            <tr>
                <th class="text-center">Course Code</th>
                <th class="text-center">Credit Hours</th>
                <th class="text-center">Course Code</th>
                <th class="text-center">Credit Hours</th>
                <th></th>
                <th></th>
            </tr>

            <?php
            $completed_credit_hrs = 0.00;
            ?>

            <?php $sn = 0;
            foreach ($student_list as $row) : ?>
                <?php $total_credits = 0; ?>
                <?php
                $student_course_info = $this->db->query("SELECT * FROM exam_tabulation_sheet a
                                                              LEFT JOIN aca_course b ON a.COURSE_ID = b.COURSE_ID
                                                                WHERE a.STUDENT_ID = $row->STUDENT_ID
                                                                AND a.SESSION_ID = $row->SESSION_ID")->result();
                ?>

                <tr>
                    <td class="text-center"><?php $sn++;
                        echo $sn; ?></td>
                    <td class="text-center col-md-2"><?php echo $row->REGISTRATION_NO; ?></td>
                    <td class="col-md-2"><?php echo $row->FULL_NAME_EN; ?></td>
                    <td class="text-center"><?php echo $row->DEPT_ABBR; ?></td>
                    <td class="text-center col-md-3"><?php echo $row->ADM_SESSION_NAME . ' ' . $row->BATCH_TITLE; ?></td>

                    <td class="col-md-2" style="vertical-align: middle">
                        <?php $c = 0;
                        foreach ($student_course_info as $c_row) : ?>
                            <?php if ($c_row->COURSE_FOR == 'R') {
                                echo ($c == 0) ? '' : ', ';
                                $c++;
                                echo $c_row->COURSE_CODE;
                            } ?>
                        <?php endforeach; ?>
                    </td>
                    <td class="text-center col-md-2" style="vertical-align: middle">
                        <?php $c = 0;
                        foreach ($student_course_info as $c_row) : ?>
                            <?php if ($c_row->COURSE_FOR == 'R') {
                                echo ($c == 0) ? '' : ' + ';
                                $c++;
                                $total_credits += $c_row->CREDIT;
                                echo $c_row->CREDIT;
                            } ?>
                        <?php endforeach; ?>
                    </td>

                    <td class="col-md-2" style="vertical-align: middle">
                        <?php $c = 0;
                        foreach ($student_course_info as $c_row) : ?>
                            <?php if ($c_row->COURSE_FOR == 'I') {
                                echo ($c == 0) ? '' : ', ';
                                $c++;
                                echo $c_row->COURSE_CODE;
                            } ?>
                        <?php endforeach; ?>
                    </td>
                    <td class="text-center col-md-2" style="vertical-align: middle">
                        <?php $c = 0;
                        foreach ($student_course_info as $c_row) : ?>
                            <?php if ($c_row->COURSE_FOR == 'I') {
                                echo ($c == 0) ? '' : ' + ';
                                $c++;
                                $total_credits += $c_row->CREDIT;
                                echo $c_row->CREDIT;
                            } ?>
                        <?php endforeach; ?>
                    </td>

                    <td class="text-center" style="vertical-align: middle"><?php echo $total_credits; ?></td>
                    <td></td>
                </tr>

            <?php endforeach; ?>

        </table>

    </div>

    <div class="clearfix"></div>

</div>
<script type="text/javascript">
    $(document).ready(function () {


        $("#print_grade_sheet_btn").click(function () {
            $('#printablediv').printThis({
                pageTitle: "",
                loadCSS: "",
                header: "<h1></h1>"
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