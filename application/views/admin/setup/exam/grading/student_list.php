<style type="text/css">
    hr {
        margin-bottom: 0px !important;
        margin-top: 10px !important;
    }

    .alert {
        border: 1px solid transparent !important;
        border-radius: 4px !important;
        margin-bottom: 4px !important;
        padding: 6px !important;
    }

</style>

<?php $this->load->view("student/common/student_common_js"); ?>

<div class="wrapper wrapper-content">
    <form id="student_search">
        <div class="col-md-4">
            <div class="ibox-content">

                <input type="hidden" name="INS_SESSION_ID" id="INS_SESSION_ID" value="<?php echo $session; ?>">
                <input type="hidden" name="EMP_ID" id="EMP_ID" value="<?php echo $emp_id; ?>">
                <input type="hidden" name="DEPT_ID" id="DEPT_ID" value="<?php echo $dept_id; ?>">
                <div class="form-group">
                    <label>Program :</label>
                    <select class="  form-control required p_id" name="PROGRAM_ID" id="PROGRAM_ID"
                            data-tags="true" data-placeholder="Select Program" data-allow-clear="true">
                        <option value="">-- Select --</option>
                        <?php foreach ($program as $row) { ?>
                            <option value="<?php echo $row->PROGRAM_ID; ?>">
                                <?php echo $row->PROGRAM_NAME; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Course :</label>
                    <select class="  form-control required" name="COURSE_ID" id="COURSE_ID"
                            data-tags="true" data-placeholder="Select Course" data-allow-clear="true">
                        <option value="">-- Select --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Batch :</label>
                    <select class="  form-control required" name="BATCH_ID" id="BATCH_ID"
                            data-tags="true" data-placeholder="Select Batch" data-allow-clear="true">
                        <option value="">-- Select --</option>
                    </select>
                </div>


                <div class="form-group">
                    <label>Section :</label>
                    <select class="  form-control required" name="SECTION_ID" id="SECTION_ID"
                            data-tags="true" data-placeholder="Select Section" data-allow-clear="true">
                        <option value="">-- Select --</option>
                        <?php foreach ($section as $row) { ?>
                            <option
                                    value="<?php echo $row->SECTION_ID; ?>"><?php echo $row->NAME; ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="form-group">
                    <label>Mark Type :</label>
                    <select class="  form-control required" name="MARK_TYPE_ID" id="MARK_TYPE_ID"
                            data-tags="true" data-placeholder="Select Mark Type" data-allow-clear="true">
                        <option value="">-- Select --</option>
                        <?php foreach ($mark_type as $row) { ?>
                            <option data-percentage="<?php echo $row->MARKS_PER; ?>"
                                    value="<?php echo $row->EXAM_MARKS_TYPE_ID; ?>"><?php echo $row->MARKS_TITLE.' ('.$row->MARKS_PER.'%)'; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group pull-right">
                    <input type="button" class="btn btn-primary btn-sm program_session_wise_student" value="Search">
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-content" id="studentList">
                </div>

            </div>
    </form>
    <div class="clearfix"></div>
</div>

</form>
</div>

<script type="text/javascript">
    $("#existing_to_student_form").validate({
        rules: {

            ADA_SESSION_ID: {required: true},
            INS_SESSION_ID: {required: true},
            PROGRAM_ID: {required: true},
            BATCH_ID: {required: true},
            SECTION_ID: {required: true},
            "STUDENT_ID[]": {required: true},

        },
        messages: {
            ADA_SESSION_ID: "Required",
            INS_SESSION_ID: "Required",
            PROGRAM_ID: "Required",
            BATCH_ID: "Required",
            SECTION_ID: "Required",
            "STUDENT_ID[]": "Required one",

        }

    });

    $(document).on("change", "#DEPT_ID", function () {

        $("#PROGRAM_ID").val("");
        var dept_id = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() ?>/common/programByDepartment',
            data: {department_id: dept_id},
            success: function (data) {
                $("#PROGRAM_ID").html(data)
            }
        });
    });

    $(document).on("change", "#PROGRAM_ID", function () {

        $("#BATCH_ID").val("");
        var program_id = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() ?>/common/programWiseBatch',
            data: {program_id: program_id},
            success: function (data) {
                $("#BATCH_ID").html(data)
            }
        });
    });

    $(document).on("change", ".p_id", function () {

        $("#COURSE_ID").val("");
        var program_id = $("#PROGRAM_ID").val();
        var session_id = $("#INS_SESSION_ID").val();
        var emp_id = $("#EMP_ID").val();
        //alert(program_id);

        //alert(program_id);

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() ?>/common/programWiseCourse',
            data: {program_id: program_id, session_id: session_id, emp_id: emp_id},
            success: function (data) {
                $("#COURSE_ID").html(data)
            }
        });
    });


    $("#checkAll").click(function () {
        $('.STUDENT_ID').prop('checked', this.checked);
    });

    $(document).on("click", ".program_session_wise_student", function () {

        var INS_SESSION_ID = $("#INS_SESSION_ID").val();
        var PROGRAM_ID = $("#PROGRAM_ID").val();
        var BATCH_ID = $("#BATCH_ID").val();
        var SECTION_ID = $("#SECTION_ID").val();
        var COURSE_ID = $("#COURSE_ID").val();
        var MARK_TYPE_ID = $("#MARK_TYPE_ID").val();
        var PERCENTAGE_VAL = $("#MARK_TYPE_ID option:selected").attr('data-percentage');


        if (PROGRAM_ID == '' || BATCH_ID == '' || SECTION_ID == '' || COURSE_ID == '' || MARK_TYPE_ID == '') {
            alert("Rquired all selection");
        } else {
            $.ajax({
                type: "POST",
                data: $("#student_search").serialize() + '&PERCENTAGE_VAL=' + PERCENTAGE_VAL,
                url: "<?php echo site_url() ?>/exam/studentList",
                beforeSend: function () {
                    $("#studentList").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $("#studentList").html(data);
                }
            });
        }

    });
</script>
