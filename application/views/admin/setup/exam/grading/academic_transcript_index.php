<style type="text/css">

    table#grade_sheet_search_tbl {
        width: 100%;
        padding: 0px !important;
        background-color: #f1f1c1;
    }

    table#interpretation_tbl th, td {
        padding: 3px !important;

    }
</style>

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Exam Grade Sheet</h5>
    </div>
    <div class="ibox-content">
        <table id="grade_sheet_search_tbl" style="width: 100%;" cellpadding="5">
            <tr>
                <td class="col-md-3">
                    <select class="form-control" name="SESSION_ID" id="SESSION_ID">
                        <option value="">--Session--</option>
                        <?php foreach ($aca_ses_list as $row) { ?>
                            <option value="<?php echo $row->YSESSION_ID ?>"><?php echo $row->SESSION_NAME ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td class="col-md-3">
                    <select class="form-control faculty_dropdown" name="FACULTY_ID" id="FACULTY_ID">
                        <option value="">--Faculty--</option>
                        <?php foreach ($faculty as $row) { ?>
                            <option value="<?php echo $row->FACULTY_ID ?>"><?php echo $row->FACULTY_NAME ?></option>
                        <?php } ?>

                    </select>
                </td>
                <td class="col-md-3">
                    <select class="form-control dept_dropdown" name="DEPT_ID" id="DEPT_ID">
                        <option value="">--Department--</option>
                    </select>
                </td>
                <td class="col-md-3">
                    <select class="form-control program_dropdown " name="PROGRAM_ID" id="PROGRAM_ID">
                        <option value="">--Program--</option>
                    </select>
                </td>


            </tr>
            <tr>
                <td class="col-md-3">
                    <select class="form-control" name="BATCH_ID" id="BATCH_ID">
                        <option value="">--Batch--</option>
                    </select>
                </td>
                <td class="col-md-3">
                    <select class="form-control" name="SECTION_ID" id="SECTION_ID">
                        <option value="">--Section--</option>
                        <?php foreach ($section as $row) { ?>
                            <option value="<?php echo $row->SECTION_ID ?>"><?php echo $row->NAME ?></option>
                        <?php } ?>
                    </select>
                </td>


                <td class="text-center">
                    <button class="btn btn-xs btn-primary" id="grade_sheet_search_btn2"><i class="fa fa-search"></i>
                        Search
                    </button>
                </td>
            </tr>
        </table>
    </div>
    <div class="ibox-content">
        <div id="academic_transcript_div"></div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/printThis.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#DEPT_ID', function () {
            dept_id = $(this).val();
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('common/deptWiseTeacherList') ?>',
                data: {dept_id: dept_id},
                beforeSend: function () {
                    $("#TEACHER_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $("#TEACHER_ID").html(data);

                }
            });
        });
        $(document).on('change', '#PROGRAM_ID', function () {
            program_id = $(this).val();

            $.ajax({
                type: "POST",
                url: '<?php echo site_url('common/programWiseBatch') ?>',
                data: {program_id: program_id},
                beforeSend: function () {
                    $("#BATCH_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $("#BATCH_ID").html(data);

                }
            });

        });

        $(document).on('change', '#SECTION_ID', function () {

            SESSION_ID = $("#SESSION_ID").val();
            FACULTY_ID = $("#FACULTY_ID").val();
            DEPT_ID = $("#DEPT_ID").val();
            PROGRAM_ID = $("#PROGRAM_ID").val();
            TEACHER_ID = $("#TEACHER_ID").val();
            COURSE_ID = $("#COURSE_ID").val();
            BATCH_ID = $("#BATCH_ID").val();
            SECTION_ID = $("#SECTION_ID").val();

            $.ajax({
                type: "POST",
                url: '<?php echo site_url('common/studentListByThisAttribute') ?>',
                data: {
                    FACULTY_ID: FACULTY_ID,
                    DEPT_ID: DEPT_ID,
                    PROGRAM_ID: PROGRAM_ID,
                    BATCH_ID: BATCH_ID,
                    SECTION_ID: SECTION_ID
                },
                beforeSend: function () {
                    $("#STUDENT_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $("#STUDENT_ID").html(data);

                }
            });

        });

        $(document).on('change', '#TEACHER_ID', function () {

            var TEACHER_ID = $(this).val();
            SESSION_ID = $("#SESSION_ID").val();


            $.ajax({
                type: "POST",
                url: '<?php echo site_url('course/teacheSessionWiseCourseMapDropdown') ?>',
                data: {SESSION_ID: SESSION_ID, TEACHER_ID: TEACHER_ID},
                beforeSend: function () {
                    $("#COURSE_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {

                    $("#COURSE_ID").html(data);

                }
            });
        });


        $(document).on('click', '#grade_sheet_search_btn2', function () {

            SESSION_ID = $("#SESSION_ID").val();
            FACULTY_ID = $("#FACULTY_ID").val();
            DEPT_ID = $("#DEPT_ID").val();
            PROGRAM_ID = $("#PROGRAM_ID").val();
            TEACHER_ID = $("#TEACHER_ID").val();
            COURSE_ID = $("#COURSE_ID").val();
            BATCH_ID = $("#BATCH_ID").val();
            SECTION_ID = $("#SECTION_ID").val();

            if(SESSION_ID == '' || FACULTY_ID == '' || DEPT_ID == '' || PROGRAM_ID == '' ||  BATCH_ID == '' || SECTION_ID == '')
            {
                swal({
                    title: "Please select all",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#F8AC59",
                    confirmButtonText: "Okay",
                    closeOnConfirm: false,
                    allowOutsideClick: true
                });
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url('exam/studentListByThisAttribute') ?>',
                    data: {
                        SESSION_ID: SESSION_ID,
                        FACULTY_ID: FACULTY_ID,
                        DEPT_ID: DEPT_ID,
                        PROGRAM_ID: PROGRAM_ID,
                        BATCH_ID: BATCH_ID,
                        SECTION_ID: SECTION_ID
                    },
                    beforeSend: function () {
                        $("#academic_transcript_div").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $("#academic_transcript_div").html(data);

                    }
                });
            }



        })


    });

</script>