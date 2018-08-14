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
<div class="wrapper wrapper-content">

    <?php $this->load->view("student/common/student_common_js"); ?>

    <form id="student_enrollment_search" method="post">
        <div class="ibox float-e-margins">
            <?php if (!empty($session)): ?>
            <div class="ibox-title">
                <h5>Student List</h5>
            </div>
            <div class="ibox-content">

                <div class="col-md-2">
                    <div class="form-group">
                        <select class="  form-control required" name="PROGRAM_ID" id="PROGRAM_ID"
                                data-tags="true" data-placeholder="Select Program" data-allow-clear="true">
                            <option value="">--- Select Program ---</option>
                            <?php foreach ($program as $row) { ?>
                                <option
                                    value="<?php echo $row->PROGRAM_ID; ?>"><?php echo $row->PROGRAM_NAME; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <select class="  form-control required SESSION_ID" name="INS_SESSION_ID" id="INS_SESSION_ID"
                                data-tags="true" data-placeholder="Select Institute Session" data-allow-clear="true">
                            <option value="">--- Select Academic Session ---</option>
                            <?php foreach ($session as $row) { ?>
                                <option
                                    value="<?php echo $row->YSESSION_ID; ?>"><?php echo $row->SESSION_NAME; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <select class="  form-control required" name="COURSE_ID" id="COURSE_ID"
                                data-tags="true" data-placeholder="Select Course" data-allow-clear="true">
                            <option value="">--- Select Course ---</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <select class="  form-control required" name="BATCH_ID" id="BATCH_ID"
                                data-tags="true" data-placeholder="Select Batch" data-allow-clear="true">
                            <option value="">--- Select Batch ---</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <select class="  form-control required" name="SECTION_ID" id="SECTION_ID"
                                data-tags="true" data-placeholder="Select Section" data-allow-clear="true">
                            <option value="">--- Select Section ---</option>
                            <?php foreach ($section as $row) { ?>
                                <option
                                    value="<?php echo $row->SECTION_ID; ?>"><?php echo $row->NAME; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <input type="button" class="btn btn-warning btn-sm program_session_wise_student" id=""
                               data-param="" value="Search">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div id="show"></div>

            <div class="ibox-content" id="studentList">


            </div>

        </div>
        <?php else: ?>
            <div class="alert alert-danger"><p class="text-center">No Student Found </p></div>
        <?php endif; ?>
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


    $(document).on("change", "#PROGRAM_ID", function () {

        $("#BATCH_ID").val("");
        var program_id = $(this).val();

        //alert(program_id);

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() ?>/common/programWiseBatch',
            data: {program_id: program_id},
            success: function (data) {
                $("#BATCH_ID").html(data)
            }
        });
    });

    $(document).on("change", ".SESSION_ID", function () {

        $("#COURSE_ID").val("");
        var program_id = $("#PROGRAM_ID").val();
        var session_id = $("#INS_SESSION_ID").val();
        //alert(program_id);

        //alert(program_id);

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() ?>/common/programWiseCourse',
            data: {program_id: program_id, session_id: session_id},
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

        //alert(COURSE_ID);

        if (PROGRAM_ID == '' || INS_SESSION_ID == '' || BATCH_ID == '' || SECTION_ID == '' || COURSE_ID == '') {
            alert("Rquired all selection");
        } else {
            $.ajax({
                type: "POST",
                data: $("#student_enrollment_search").serialize(),
                url: "<?php echo site_url() ?>/exam/resultList",
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
