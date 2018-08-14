<style type="text/css">
    hr{
        margin-bottom:0px !important ;
        margin-top:10px !important;
    }
    .alert {
        border: 1px solid transparent !important;
        border-radius: 4px !important;
        margin-bottom: 4px !important;
        padding: 6px !important;
    }
</style>
<div class="wrapper wrapper-content">
   <form id="student_enrollment_search"> 
    <div class="col-md-4">
        <div class="ibox-content">

            <div class="form-group">
                <label>Session :</label>
                <select class=" form-control required" name="SESSION_ID" id="SESSION_ID" data-tags="true" data-placeholder="--Select--" data-allow-clear="true">
                    <option value="">--Select--</option>
                    <?php foreach ($session as $row) { ?>
                    <option
                    value="<?php echo $row->YSESSION_ID; ?>"><?php echo $row->SESSION_NAME ;?></option>
                    <?php } ?>
                </select>

            </div>
            <div class="form-group">
                <label>Program :</label>
                <select class=" form-control required" name="PROGRAM_ID" id="PROGRAM_ID" data-tags="true" data-placeholder="--Select--" data-allow-clear="true">
                    <option value="">--Select--</option>
                    <?php foreach ($program as $row) { ?>
                    <option
                    value="<?php echo $row->PROGRAM_ID; ?>"><?php echo $row->PROGRAM_NAME; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Batch :</label>
                <select class=" form-control required" name="BATCH_ID" id="BATCH_ID" data-tags="true" data-placeholder="--Select--" data-allow-clear="true">
                    <option value="">--Select--</option>

                </select>
            </div>
            <div class="form-group">
                <label>Section :</label>
                <select class=" form-control required" name="SECTION_ID" id="SECTION_ID" data-tags="true" data-placeholder="--Select--" data-allow-clear="true">
                    <option value="">--Select--</option>
                    <?php foreach ($section as $row) { ?>
                    <option
                    value="<?php echo $row->SECTION_ID; ?>"><?php echo $row->NAME; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Semester :</label>
                <select class=" form-control required" name="SEMESTER" id="SEMESTER" data-tags="true" data-placeholder="--Select--" data-allow-clear="true">
                    <option value="">--Select--</option>
                    <?php foreach ($semester as $row) { ?>
                    <option
                    value="<?php echo $row->SL_NO; ?>"><?php echo $row->SEMESTER_NAME; ?></option>
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
            <?php if (!empty($student_list)): ?>
                <div class="ibox-title">
                    <h5>Student List</h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive contentArea" id="studentList">
                        <table class="table table-striped table-bordered table-hover gridTable">
                            <thead>
                                <tr>
                                    <th>Roll</th>
                                    <th>Name</th>                                        

                                </tr>
                            </thead>
                            <tbody >
                                <?php
                                $sn = 1;
                                foreach ($student_list as $row):
                                    ?>
                                <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>" >
                                    <td ><?php echo $row->REGISTRATION_NO ?></td>
                                    <td > <?php echo $row->FULL_NAME_EN ?> </td>

                                </tr>
                            <?php  endforeach;  ?>
                        </tbody>

                    </table>
                </div>

            </div>

        <?php else: ?>
            <div class="alert alert-danger"><p class="text-center">No Student Found </p> </div>
        <?php endif; ?>

    </div>

</div>
</form>
<div class="clearfix"></div>
</div>
</div>
<div class="modal inmodal fade" id="applicant_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Applicant Details</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal appModal">
    <div class="modal-dialog">
        <div class="modal-content animated">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span
                    class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                    <small class="font-bold"></small>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-white" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(document).on("change", "#PROGRAM_ID", function () {
            var PROGRAM_ID = $(this).val();
            $.ajax({
                type: 'post',
                url: '<?php echo site_url()?>/common/programWiseBatch',
                data: {program_id: PROGRAM_ID},
                success: function (data) {
                    $("#BATCH_ID").html(data);
                }
            });
        });

        $(document).on("click", ".program_session_wise_student", function () {           

            var SESSION_ID = $("#SESSION_ID").val(); 
            var PROGRAM_ID = $("#PROGRAM_ID").val();
            var BATCH_ID = $("#BATCH_ID").val();            
            var SECTION_ID = $("#SECTION_ID").val();            
            var SEMESTER = $("#SEMESTER").val();

            if(PROGRAM_ID =='' || SESSION_ID=='' || BATCH_ID=='' || SECTION_ID=='' || SEMESTER=='' ){
                alert("Rquired all selection");
            }else{
                $.ajax({
                    type: "POST",
                    data:  $("#student_enrollment_search").serialize(),
                    url: "<?php echo site_url() ?>/teacher/enrollmentStudentList",
                    beforeSend: function () {
                        $("#studentList").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $("#studentList").html(data);
                    }
                });
            }

        });
        $(document).on("click", "#course_enrollment_btn", function () {     

 
            var SESSION_ID = $("#SESSION_ID").val(); 
            var PROGRAM_ID = $("#PROGRAM_ID").val();
            var BATCH_ID = $("#BATCH_ID").val();            
            var SECTION_ID = $("#SECTION_ID").val();            
            var SEMESTER = $("#SEMESTER").val();   
            var checked = $("[name='STUDENT_ID[]']:checked").length;         
            if(checked == 0) 
            {
                alert("Please select any student to proceed.");
                return false;
            }

            $.ajax({
                type: "POST",
                data:  $("#student_enrollment_search").serialize(),
                url: "<?php echo site_url()?>/teacher/saveCourseEnrollment",
                beforeSend: function () {
                    $("#studentList").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    if(data){
                        window.location.replace('<?php echo site_url(); ?>/teacher/courseEnrollment');  
                        setTimeout(function () {
                                    toastr.options = {
                                        closeButton: true,
                                        progressBar: true,
                                        showMethod: 'slideDown',
                                        timeOut: 4000
                                    };

                                    toastr.warning('Successfully Course Enrolled', 'Done');
                                });  
                    }
                    
                }
            });
            

        });


        $(document).on("click", ".applicantApprove", function () {
            var applicantId = $(this).attr("data-applicant");
            $(".appModal").modal();
            $.ajax({
                type: "POST",
                data: {applicantId:applicantId},
                url: "<?php echo site_url(); ?>/admin/approveRemark",
                beforeSend: function () {
                    $(".appModal .modal-title").html("Add Remarks");
                    $(".appModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".appModal .modal-body").html(data);
                    if(data == 'Remarks Create successfully'){

                    }
                }
            });
        });

        $(document).on("click", ".applicantReject", function () {
            var applicantId = $(this).attr("data-applicant");
            $(".appModal").modal();
            $.ajax({
                type: "POST",
                data: {applicantId:applicantId},
                url: "<?php echo site_url()?>admin/rejectRemark",
                beforeSend: function () {
                    $(".appModal .modal-title").html("Add Remarks");
                    $(".appModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".appModal .modal-body").html(data);
                    if(data == 'Remarks Create successfully'){

                    }
                }
            });
        });

        $(document).on("click", ".formApproveSubmit", function () {
            if (confirm("Are You Sure?")) {
                var remarks = $("#remarks").val();
                var applicantId = $("#applicantId").val();

                $.ajax({
                    type: "post",
                    url: '<?php echo site_url('admin/newApplicantApprovedForAdmit') ?>',
                    data:{remarks:remarks,applicantId:applicantId},
                    success: function (data) {
                        $(".frmMsg").html(data);
                        $.ajax({
                            type: "post",
                            data: {applicantId: applicantId},
                            url: "<?php echo site_url(); ?>/admin/applicantForAdmit",
                            success: function (data1) {
                                $("#row_" + applicantId).html(data1);
                            }
                        });
                    }
                });
            } else {
                return false;
            }
        });

        $(document).on("click", ".formRejectSubmit", function () {
            if (confirm("Are You Sure?")) {
                var remarks = $("#remarks").val();

                var applicantId = $("#applicantId").val();
                $.ajax({
                    type: "post",
                    data: {remarks:remarks, applicantId:applicantId},
                    url: '<?php echo site_url('admin/newApplicantRejectForAdmit') ?>/',
                    success: function (data) {
                        $(".frmMsg").html(data);
                        $.ajax({
                            type: "post",
                            data: {applicantId: applicantId},
                            url: "<?php echo site_url(); ?>/admin/applicantForAdmit",
                            success: function (data1) {
                                $("#row_" + applicantId).html(data1);
                            }
                        });


                    }
                });
            } else {
                return false;
            }
        });



        $(document).ready(function () {
            $(".applicant_details").on("click", function () {
                var STUDENT_ID = $(this).attr('data-user-id');

                $.ajax({
                    type: 'post',
                    url: '<?php echo site_url() ?>/admin/applicantModal',
                    data: {STUDENT_ID: STUDENT_ID},
                    success: function (data) {
                        $("#applicant_modal .modal-body").html(data);
                    }
                });
            });
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
                    var session = $("#SESSION_ID").val();

                    var action_url = '<?php echo site_url('admin/searchPassedApplicantList') ?>';
                    $.ajax({
                        type: "POST",
                        url: action_url,
                        data: {
                            faculty: faculty,
                            department: department,
                            program: program,
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