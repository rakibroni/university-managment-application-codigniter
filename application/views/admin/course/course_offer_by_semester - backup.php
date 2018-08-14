<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h3>Course Offer By Semester</h3>
    </div>
</div>
<form id="frmCourseOffer">
    <div class="col-lg-4">
        <div class="ibox-content">
            <div class="form-group">
                <label class="control-label">Session</label>

                <div class="form-group">
                    <select class="select2Dropdown form-control required" name="session" id="cmbSession"
                            data-tags="true" data-placeholder="Select Session" data-allow-clear="true">
                        <option value="">Select Session</option>
                        <?php foreach ($session as $row): ?>
                            <option
                                value="<?php echo $row->SES_YEAR_ID; ?>"><?php echo $row->SESSION_NAME . " (" . $row->YEAR_SETUP_TITLE . ")"; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <?php
                if ($ac_type == 2) {

                    foreach ($course_offer as $row) {
                        $faculty_id = $row->FACULTY_ID;
                        $dept_id = $row->DEPT_ID;
                        $program_id = $row->PROGRAM_ID;
                        $semester_id = $row->LKP_NAME;
                    }
                }
                ?>
                <label class="control-label">Faculty</label>

                <div class="form-group">
                    <select class="select2Dropdown form-control required" name="cmbFaculty" id="cmbFaculty"
                            data-tags="true" data-placeholder="Select Faculty" data-allow-clear="true">
                        <option value="">Select Faculty</option>
                        <?php foreach ($faculty as $row): ?>
                            <option value="<?php echo $row->FACULTY_ID; ?>"><?php echo $row->FACULTY_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Department</label>

                <div class="form-group">
                    <select class="select2Dropdown dept_dropdown form-control commonClass required" name="department"
                            id="department" data-tags="true" data-placeholder="Select Department"
                            data-allow-clear="true">

                        <?php if ($ac_type == 2) { ?>
                            <option value="<?php echo $row->DEPT_ID; ?>"><?php echo $row->DEPT_NAME; ?></option>
                        <?php } else { ?>
                            <option value="">Select Department</option>
                        <?php
                        }
                        ?>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Program</label>

                <div class="form-group">
                    <select class="select2Dropdown program_dropdown form-control commonClass required" name="program"
                            id="program" data-tags="true" data-placeholder="Select Program" data-allow-clear="true">

                        <?php if ($ac_type == 2) { ?>
                            <option value="<?php echo $row->PROGRAM_ID; ?>"><?php echo $row->PROGRAM_NAME; ?></option>
                        <?php } else { ?>
                            <option value="">Select Program</option>
                        <?php
                        }
                        ?>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Offer Type</label>

                <div class="form-group">
                    <select class="select2Dropdown form-control required" name="OfferType" id="OfferType"
                            data-tags="true" data-placeholder="Select Offer Type" data-allow-clear="true">
                        <option value="">Select Offer Type</option>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Semester</label>

                <div class="form-group">
                    <select class="select2Dropdown form-control required" name="semester" id="semester" data-tags="true"
                            data-placeholder="Select Semester" data-allow-clear="true">
                        <option value="">Select Semester</option>
                        <?php foreach ($semester as $row): ?>
                            <option value="<?php echo $row->SEMESTER_ID; ?>"><?php echo $row->SEMESTER_NAME; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2">
                    <span class="modal_msg pull-left"></span>
                    <span title="Course Offer" id="btnSubmit" class="btn btn-primary btn-sm">submit</span>
                    <input type="reset" class="btn btn-default btn-sm" value="Reset">

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="ibox float-e-margins">
            <div class="listView"></div>
            <div class="ibox-content" id="courseList">
                <span class="selected_course"></span>

            </div>
        </div>
    </div>
</form>


<script type="text/javascript">
    $(document).ready(function () {

        $('#cmbFaculty').change(function () {
            var selectedValue = $(this).val();
            var url = '<?php echo site_url('course/ajax_get_department') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {selectedValue: selectedValue},
                dataType: 'html',
                success: function (data) {
                    $('#department').html(data);
                }
            });
        });
        $('#cmbDepartment').change(function () {
            var selectedValue = $(this).val();
            var url1 = '<?php echo site_url('course/ajax_get_program') ?>';
            $.ajax({
                type: "POST",
                url: url1,
                data: {selectedValue: selectedValue},
                dataType: 'html',
                success: function (data) {
                    $('#program').html(data);
                }
            });
        });
        $('#department').change(function () {
            var selectedValue = $(this).val();
            var url = '<?php echo site_url('course/ajax_get_program') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {selectedValue: selectedValue},
                dataType: 'html',
                success: function (data) {

                    $('#program').html(data);
                }
            });
        });
        $('#OfferType').change(function () {
            var selectedValue = $('#program').val();
            var OfferType = $(this).val();
            var flag = 1;
            var dept_url = '<?php echo site_url('course/getCourseByProgramFromCourseOffer') ?>';
            $.ajax({
                type: "POST",
                url: dept_url,
                data: {program_id: selectedValue, flag: flag, OfferType: OfferType},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $(".listView").html("<div>").addClass('ibox-title');
                    $(".listView").html("<strong>Course list</strong></div>");
                    $('#courseList').html(data);
                }
            });
        });
        $('#program').change(function () {
            var url = '<?php echo site_url('course/ajax_get_offer_type') ?>';
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'html',
                success: function (data) {

                    $('#OfferType').html(data);
                }
            });
        });
        $('#semester').change(function () {
            var program = $('#program').val();
            var semester = $(this).val();
            var flag = 1;
            var dept_url = '<?php echo site_url('course/getCourseByProSemeFromSemeOffer') ?>';
            /*get courser offer by Program and semester from semestere offer*/
            $.ajax({
                type: "POST",
                url: dept_url,
                data: {program: program, semester: semester, flag: flag},
                dataType: 'html',
                beforeSend: function () {
                    $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $(".listView").html("<div>").addClass('ibox-title');
                    $(".listView").html("<strong>Course list</strong></div>");
                    $('#courseList').html(data);
                }
            });
        });
        $(document).on("click", "#btnSubmit", function () {
            var is_valid = 0;
            var empty_seq = 0;
            $('.required').each(function () {
                $(this).keyup(function () {
                    $(this).css("border", "1px solid #ccc");
                });
                if ($(this).val() == "") {
                    var label = $(this).parent().siblings("label").text();
                    //alert(label + " Is Empty");
                    $(this).siblings(".validation").html(label + " is required");
                    $(this).css("border", "1px solid red");
                    is_valid = 1;
                } else {
                    $(this).css("border", "1px solid #ccc");
                }
            });
            if (!$('#frmCourseOffer input[type="checkbox"]').is(':checked')) {
                alert("Select at least one course !!.");
                is_valid = 1;
            }
            $('#frmCourseOffer input[type="checkbox"]').each(function () {
                if ($(this).is(':checked')) {
                    var id = $(this).val();
                    var sequence = $("#course_id_" + id).val();
                    if (sequence == "") {
                        is_valid = 1;
                        empty_seq = 1;
                    }
                }
            });
            if (empty_seq == 1) {
                alert("Enter sequence no !!");
            }
            if (is_valid == 0) {
                $(".commonModal").modal();
                var frmCourseOffer = $("#frmCourseOffer").serialize();
                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url('course/semesterCoursePreview') ?>',
                    data: frmCourseOffer,
                    beforeSend: function () {
                        $(".modal-title").html("Preview");
                        $(".modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".modal-body").html(data);
                    }
                });
            }

        });
    });


</script>

