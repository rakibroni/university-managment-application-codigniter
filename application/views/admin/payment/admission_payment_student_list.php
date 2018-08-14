<div class="wrapper wrapper-content animated">
    <div class="">
        <?php //if ($previlages->CREATE == 1) { ?>
        <div class="">
            <div class="ibox-content">
                <div class="col-md-4">
                    <label class="col-md-12">Faculty <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <select class="select2Dropdown faculty_dropdown form-control commonClass" name="FACULTY_ID" id="FACULTY_ID" data-tags="true" data-placeholder="Select Faculty" data-allow-clear="true">
                            <option value="">Select Faculty</option>
                            <?php foreach ($faculty as $row): ?>
                                <option value="<?php echo $row->FACULTY_ID; ?>"><?php echo $row->FACULTY_NAME; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="col-md-12">Department <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <select class="select2Dropdown dept_dropdown form-control commonClass" name="DEPT_ID" id="DEPT_ID" data-tags="true" data-placeholder="Select Department" data-allow-clear="true">
                            <option value="">Select Department</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="col-md-12">Program <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <select class="select2Dropdown program_dropdown form-control commonClass" name="PROGRAM_ID" id="PROGRAM_ID" data-tags="true" data-placeholder="Select Program" data-allow-clear="true">
                            <option value="">Select Program</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <label class="control-label">Session <span class="text-danger">*</span></label>
                        <select class="select2Dropdown form-control" name="SESSION_ID" id="SESSION_ID" data-tags="true" data-placeholder="Select Session" data-allow-clear="true">
                            <option value="">Select Session</option>
                            <?php foreach ($session as $nn) { ?>
                                <option value="<?php echo $nn->SESSION_ID; ?>" <?php echo ($nn->IS_CURRENT == 1) ? 'selected' : '' ?>><?php echo ($nn->IS_CURRENT == 1) ? $nn->SESSION_NAME . ' [current session]' : $nn->SESSION_NAME ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-8">
                        <label class="control-label">Semester <span class="text-danger">*</span></label>
                        <select class="select2Dropdown form-control required" name="SEMESTER_ID" id="SEMESTER_ID" data-tags="true" data-placeholder="Select Semester" data-allow-clear="true">
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
        <?php // }  ?>
        <div class="">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Student List</h5>
                    <span class="loadingImg"></span>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive contentArea" id="applicantList">
                        <?php $this->load->view("admin/payment/get_admitted_student_list");  ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".formOffer", function() {
            var is_valid = 0;
            $('.required').each(function() {
                $(this).keyup(function() {
                    $(this).css("border", "1px solid #ccc");
                });
                if ($(this).val() == "") {
                    var label = $(this).parent().siblings("label").text();
                    alert(label + " Is Empty");
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
                var action_url = '<?php echo site_url('admin/searchApplicant') ?>';
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
                    beforeSend: function() {
                        $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function(data) {
                        $(".loadingImg").html("");
                        $('#applicantList').html(data);
                    }
                });
            }
        });
    });
</script>


























<!--<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Student List</h5>        
    </div>
    <div class="ibox-content">
        <div class="col-lg-12"> 
            <div class="form-group col-lg-3">
                <label class="control-label">Faculty</label>
                <div class="form-group">
                    <select class="form-control faculty_dropdown" name="FACULTY_ID" id="FACULTY_ID">
                        <option value="">--Select--</option>
<?php foreach ($faculty as $row): ?>
                                    <option value="<?php echo $row->FACULTY_ID; ?>"><?php echo $row->FACULTY_NAME; ?></option>
<?php endforeach; ?>
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group col-lg-3">
                <label class="control-label">Department</label>
                <div class="form-group">
                    <select class="dept_dropdown form-control" name="DEPT_ID" id="DEPT_ID" >
                        <option value="">--Select--</option>                       
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group col-lg-3">
                <label class="control-label">Program</label>
                <div class="form-group">
                    <select class=" program_dropdown form-control" name="PROGRAM_ID" id="PROGRAM_ID">
                        <option value="">--Select--</option>                        
                    </select>
                    <span class="validation"></span>
                </div>
            </div>
            <div class="form-group col-lg-1">
                <label class="control-label"></label>
                <input type="button" class="btn btn-primary pull-right" id="search_offer_template" value="Search">
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="text-align: center;"><i class="fa fa-search" aria-hidden="true"></i> Search Student</h2>
            <span class="loadingImg"></span>
        </div>
        <div class="ibox-content" id="studentTable">
<?php $this->load->view('admin/payment/get_admitted_student_list'); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", "#search_offer_template", function() {
            var FACULTY_ID = $("#FACULTY_ID").val();
            var DEPT_ID = $("#DEPT_ID").val();
            var PROGRAM_ID = $("#PROGRAM_ID").val();
            if (FACULTY_ID === '' || DEPT_ID === '' || PROGRAM_ID === '') {
                alert("Must be select all !! ");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('finance/getAdmittedStudent') ?>",
                    data: {FACULTY_ID: FACULTY_ID, DEPT_ID: DEPT_ID, PROGRAM_ID: PROGRAM_ID},
                    dataType: 'html',
                    beforeSend: function() {
                        $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function(data) {
                        $(".loadingImg").html("");
                        $('#studentTable').html(data);
                    }
                });
            }
        });
    });
</script>-->