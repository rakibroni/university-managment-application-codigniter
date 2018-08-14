<div class="wrapper wrapper-content">
    <div class="">
        <?php //if ($previlages->CREATE == 1) { ?>
        <div class="">
            <div class="ibox-content">
                <?php $this->load->view("common/faculty_dept_program"); ?>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <label class="control-label">Session <span class="text-danger">*</span></label>
                        <select class="select2Dropdown form-control" name="SESSION_ID" id="SESSION_ID" data-tags="true"
                                data-placeholder="Select Session" data-allow-clear="true">
                            <option value="">Select Session</option>
                            <?php foreach ($session as $nn) { ?>
                                <option
                                    value="<?php echo $nn->SESSION_ID; ?>" <?php echo ($nn->IS_CURRENT == 1)? 'selected': '' ?>><?php echo $nn->SESSION_NAME." "; if($nn->IS_CURRENT == 1){ echo '[current session]';} ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-8">
                        <label class="control-label">Semester <span class="text-danger">*</span></label>
                        <select class="select2Dropdown form-control required" name="SEMESTER_ID" id="SEMESTER_ID" data-tags="true"
                                data-placeholder="Select Semester" data-allow-clear="true">
                            <option value="">Select Semester</option>
                            <?php foreach ($semester as $row): ?>
                                <option value="<?php echo $row->LKP_ID ?>"><?php echo $row->LKP_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" style="padding-top: 5px;">
                        <span class="modal_msg pull-left"></span>
                        <input type="button" class="btn btn-primary btn-sm formOffer" value="Search">
                        <input type="reset" class="btn btn-default btn-sm" value="Reset">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php // } ?>
        <div class="">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>View All Students</h5>
                    <span class="loadingImg"></span>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive contentArea" id="applicantList">
                        <?php $this->load->view("admin/applicant/existing_student/applicant_list"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("click", ".formOffer", function () {
            var is_valid = 0;
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
            if (is_valid == 0) {
                var faculty = $("#FACULTY_ID").val();
                var department = $("#DEPT_ID").val();
                var program = $("#PROGRAM_ID").val();
                var semester = $("#SEMESTER_ID").val();
                var session = $("#SESSION_ID").val();

                var action_url = '<?php echo site_url('admin/searchExistingStu') ?>';
                $.ajax({
                    type: "POST",
                    url: action_url,
                    data: {
                        faculty: faculty,
                        department: department,
                        program: program,
                        semester: semester,
                        session: session
                    },
                    dataType: 'html',
                    beforeSend: function () {
                        $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {

                        $(".loadingImg").html("");
                        $('#applicantList').html(data);
                    }
                });
            }

        });


    });


</script>

