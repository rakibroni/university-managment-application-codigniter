<form id="existing_student_search">

    <!--    <input type="hidden" name="SESSION_ID" id="SESSION_ID" value="--><?php //echo $SESSION_ID; ?><!--">-->
    <input type="hidden" name="FACULTY_ID" id="FACULTY_ID" value="<?php echo $FACULTY_ID; ?>">
    <input type="hidden" name="DEPT_ID" id="DEPT_ID" value="<?php echo $DEPT_ID; ?>">
    <input type="hidden" name="PROGRAM_ID" id="PROGRAM_ID" value="<?php echo $PROGRAM_ID; ?>">
<!--    <input type="hidden" name="COURSE_ID" id="COURSE_ID" value="--><?php //echo $COURSE_ID; ?><!--">-->
    <input type="hidden" name="BATCH_ID" value="<?php echo $BATCH_ID; ?>">
    <input type="hidden" name="SECTION_ID" value="<?php echo $SECTION_ID; ?>">


    <div class="table-responsive contentArea">

        <div class="col-md-3">
            <select class="form-control required" name="SESSION_ID" id="SESSION_ID">
                <option value="">--- Select Academic Session ---</option>
                <?php foreach ($ins_session as $row) { ?>
                    <option
                            value="<?php echo $row->YSESSION_ID; ?>"><?php echo $row->SESSION_NAME; ?></option>
                <?php } ?>
            </select>
        </div>


        <div class="col-md-3">
            <select class="  form-control required" name="COURSE_ID" id="COURSE_ID"
                    data-tags="true" data-placeholder="Select Course" data-allow-clear="true">
                <option value="">--- Courses ---</option>
            </select>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <input type="button" class="btn btn-warning btn-sm form_submit" id=""
                       data-param="" value="Proceed"
                       data-action="exam/existingStudentMarksInsert"
                       data-su-action="exam/existingStudentList" data-view-div="show_existing_student_list">
            </div>
        </div>

        <div class="row">
            <div id="show_existing_student_list">

            </div>
        </div>


        <div class="clearfix"></div>

    </div>
</form>
<script>

    //    $(document).ready(function () {
    //        $(".gridTable").dataTable();
    //    });

    $(document).on('change', '#SESSION_ID', function () {

        $("#COURSE_ID").val("");
        $("#show_existing_student_list").html("");
        var FACULTY_ID = $('#FACULTY_ID').val();
        var DEPT_ID = $('#DEPT_ID').val();
        var PROGRAM_ID = $('#PROGRAM_ID').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() ?>/common/getOfferedCoursesByProgram',
            data: {FACULTY_ID: FACULTY_ID, DEPT_ID: DEPT_ID, PROGRAM_ID: PROGRAM_ID},
            beforeSend: function () {
                $("#COURSE_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader-small.gif' />");
            },
            success: function (data) {
                $("#COURSE_ID").html(data)
            }
        });

    });


    $('#COURSE_ID').on('change', function () {

        SESSION_ID = $('#SESSION_ID').val();
        FACULTY_ID = $("#FACULTY_ID").val();
        DEPT_ID = $("#DEPT_ID").val();
        PROGRAM_ID = $("#PROGRAM_ID").val();
        COURSE_ID = $("#COURSE_ID").val();
        BATCH_ID = $("#BATCH_ID").val();
        SECTION_ID = $("#SECTION_ID").val();


        $.ajax({
            type: "POST",
            url: '<?php echo site_url('exam/existingStudentList') ?>',
            data: {
                SESSION_ID: SESSION_ID,
                FACULTY_ID: FACULTY_ID,
                DEPT_ID: DEPT_ID,
                PROGRAM_ID: PROGRAM_ID,
                COURSE_ID: COURSE_ID,
                BATCH_ID: BATCH_ID,
                SECTION_ID: SECTION_ID
            },
            beforeSend: function () {
                $("#show_existing_student_list").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $("#show_existing_student_list").html(data);

            }
        });

    });

</script>