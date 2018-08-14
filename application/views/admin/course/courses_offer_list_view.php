
    <form class="frmContent" id="courseOffer" method="post">

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4 b-r">
                            <div class="form-group">

                                <label class="control-label">Faculty</label>

                                <div class="form-group">
                                    <?php echo form_dropdown("cmbFaculty", $faculty, '', "class='form-control required' id='cmbFaculty'") ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 b-r">
                            <div class="form-group">
                                <label class="control-label">Department</label>

                                <div class="form-group">
                                    <select class="select2_demo_1 form-control " name="department" id="department">

                                        <option value="">Select Department</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Program</label>

                                <div class="form-group">
                                    <select class="select2_demo_1 form-control " name="program" id="program">
                                        <option value="">Select Program</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Offer Type</label>
                                <div class="form-group">
                                    <select class="select2_demo_1 form-control required" name="OfferType" id="OfferType">
                                        <option>Select Offer Type</option>
                                        <option value="O">Open Credit</option>
                                        <option value="F">Fixed Credit</option>
                                    </select>
                                    <span class="validation"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"></br>
                        <div class="form-group ">
                            <div class="col-md-5">
                                <span class="modal_msg pull-left"></span>
                                <input type="button" id="courseOffer" class="btn btn-primary btn-sm formOffer text-left"
                                       value="Search">
                                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                            </div>
                        </div>
                    </div>
                </div>

            <div class="col-md-8"></div>

                <div class="ibox float-e-margins">
                    <div class="ibox-content" id="courseList">
                        <span class="contentArea"></span>

                    </div>
                </div>


    </form>
    <br clear="all"/>

<style>
    .commonCourseModal {
        z-index: 999999999 !important;
    }
    .commonModal {
        z-index: 999999 !important;
    }
    .bigModal {
        overflow-y: scroll;
    }
    .commonModal {
        overflow-y: scroll;
    }

</style>
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
                    $('#program').html("<option value=''>Select Program</option>");
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
        $('#program').change(function () {
            var selectedValue = $(this).val();
            var dept_url = '<?php echo site_url('course/getCourseOfferByDeptProSemester') ?>';
            $.ajax({
                type: "POST",
                url: dept_url,
                data: {selectedValue: selectedValue},
                success: function (data) {
                    $('').html(data);
                }
            });
        });

        $(document).on("click", ".formOffer", function () {
            var faculty = $("#cmbFaculty").val();
            var department = $("#department").val();
            var program = $("#program").val();
            var offer_type = $("#OfferType").val();
            if (faculty == '') {
                alert('Please Select Faculty');
            } else {

                var action_url = '<?php echo site_url('course/searchCourseOffer') ?>';
                $.ajax({
                    type: "POST",
                    url: action_url,
                    data: {faculty: faculty, department: department, program: program, update: 0,offer_type:offer_type},
                    dataType: 'html',
                    beforeSend: function () {
                        $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".loadingImg").html("");
                        $('#courseList').html(data);
                    }
                });
            }
        });
        $(document).on("click", ".openOfferModal", function () {
            $(".bigModal").modal();
            var action_uri = $(this).attr("data-action");
            var title = $(this).attr("title");
            //var param_value = $('#frmCourseOffer').serialize();
            var faculty_value = $(this).attr("data-faculty");
            var dept_value = $(this).attr("data-dept");
            var program_value = $(this).attr("data-program");
            var offerType = $(this).attr("data-offer-type");

            $.ajax({
                type: "post",
                url: "<?php echo site_url(); ?>/" + action_uri,
                data: {faculty: faculty_value, dept: dept_value, program: program_value, offerType: offerType},
                beforeSend: function () {
                    $(".bigModal .modal-title").html(title);
                    $(".bigModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".bigModal .modal-body").html(data);
                }
            });
        });

        $(document).on("click", ".openPreModal", function () {
            $(".commonModal").modal();
            var action_uri = $(this).attr("data-action");
            var title = $(this).attr("title");
            var faculty = $(this).attr("faculty");
            var dept = $(this).attr("dept");
            var program = $(this).attr("program");
            var course = $(this).attr("course");
            $.ajax({
                type: "post",
                url: "<?php echo site_url(); ?>/" + action_uri,
                data: {faculty: faculty, dept: dept, program: program, course: course},
                beforeSend: function () {
                    $(".commonModal .modal-title").html(title);
                    $(".commonModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".commonModal .modal-body").html(data);
                }
            });
        });
    });
    $(document).ready(function () {

        $(document).on("click", "#btnSubmitAdd", function () {

            if (!$('#frmCourseOffer1 input[type="checkbox"]').is(':checked')) {
                alert("Please Select at least one course.");
                return false;
            }
            else {
                if (confirm("Are You Sure?")) {
                    $(".bigModel").modal();
                    var faculty = $("#cmbFaculty").val();
                    var department = $("#dept").val();
                    var program = $("#prog").val();
                    var courseType = $("#courseType").val();
                    var course = [];
                    $("input[name='course[]']:checked").each(function () {
                        course.push(parseInt($(this).val()));
                    });

                    $.ajax({
                        type: "POST",
                        url: '<?php echo site_url('course/courseOfferUpdate') ?>',
                        data: {
                            cmbFaculty: faculty,
                            department: department,
                            program: program,
                            courseType: courseType,
                            course: course,
                            update: 1
                        },
                        beforeSend: function () {
                            $(".modal-title").html("Preview");
                            $(".modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            $(".modal-body").html(data);
                        }
                    });
                } else {
                    return false;
                }
            }
        });
    });

    $(document).on("click", ".deletePrerequisiteCourse", function () {

        if (confirm("Are You Sure?")) {
            var thisValue = $(this);
            var item_id = $(this).attr("id");
            var data_field = $(this).attr("data-field");
            var data_tbl = $(this).attr("data-tbl");

            $.ajax({
                type: "post",
                url: "<?php echo site_url('course/deleteCourseOffered'); ?>/",
                data: {item_id: item_id, data_field: data_field, data_tbl: data_tbl},
                beforeSend: function () {
                    $("#courseLoad_" + item_id).html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    if (data == "Y") {
                        //$("#courseViews").load();
                        thisValue.parent().parent().remove();
                        var credit = [];
                        credit = $(".creditPre").text();
                        var n = $(".creditPre").text().length;
                        var i, Num, sum = 0;
                        for (i = 0; i < n; i++) {
                            sum += parseInt(credit[i]);
                        }
                        $(".totalCreditPre").remove();
                        $("#newPreSum").html("<span class='badge badge-primary'>" + sum + "</span");

                    } else {
                        alert("Row Delete Failed");
                    }
                }
            });
        } else {
            return false;
        }
    });
    $(document).on("click", ".deleteCourseOffered", function () {

        if (confirm("Are You Sure?")) {
            var thisValue = $(this);
            var item_id = $(this).attr("id");
            var data_field = $(this).attr("data-field");
            var data_tbl = $(this).attr("data-tbl");

            $.ajax({
                type: "post",
                url: "<?php echo site_url('course/deleteCourseOffered'); ?>/",
                data: {item_id: item_id, data_field: data_field, data_tbl: data_tbl},
                beforeSend: function () {
                    $("#courseLoad_" + item_id).html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    if (data == "Y") {
                        //$("#courseViews").load();
                        thisValue.parent().parent().remove();
                        var credit = [];
                        credit = $(".credit").text();
                        var n = $(".credit").text().length;
                        var i, Num, sum = 0;
                        for (i = 0; i < n; i++) {
                            sum += parseInt(credit[i]);
                        }
                        $(".totalCredit").remove();
                        $("#newSum").html("<span class='badge badge-primary'>" + sum + "</span");

                    } else {
                        alert("Row Delete Failed");
                    }
                }
            });
        } else {
            return false;
        }
    });

</script>
