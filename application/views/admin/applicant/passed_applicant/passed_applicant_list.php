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
    <div class=" ">
        <div class="ibox-content">
            <form id="applicant">

                <div class="col-md-6">
                    <div class="form-group">
                        <select class="select2Dropdown form-control required" name="PROGRAM_ID" id="PROGRAM_ID" data-tags="true" data-placeholder="Select Program" data-allow-clear="true">
                            <option value="">Select Program</option>
                            <?php foreach ($program as $row) { ?>
                                <option
                                    value="<?php echo $row->PROGRAM_ID; ?>"><?php echo $row->PROGRAM_NAME; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="select2Dropdown form-control required" name="YSESSION_ID" id="YSESSION_ID" data-tags="true" data-placeholder="Select Session" data-allow-clear="true">
                            <option value="">Select Session</option>
                            <?php foreach ($session as $row) { ?>
                                <option
                                    value="<?php echo $row->YSESSION_ID; ?>"><?php echo $row->SESSION_NAME ;?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="button" class="btn btn-primary btn-sm program_session_wise_applicant " value="Search">
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
        <div class="">
            <div class="ibox float-e-margins">
                <?php if (!empty($applicant)): ?>
                    <div class="ibox-title">
                        <h5>Passed Applicant List</h5>
                    </div>
                    <div class="ibox-content">
                        <form id="frmContent" method="post">
                            <div class="table-responsive contentArea" id="applicantList">
                                <table class="table table-striped table-bordered table-hover gridTable">
                                    <thead>
                                    <tr>
                                        <th>Roll</th>
                                        <th>Name</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Dept. Head Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="approveApplicant" class="searchApplicant">
                                    <?php
                                    $sn = 1;
                                    foreach ($applicant as $row):
                                        ?>
                                        <tr class="gradeX" id="row_<?php echo $row->APPLICANT_ID; ?>" >

                                            <td ><?php echo $row->ADM_ROLL_NO ?></td>
                                            <td >
                                                <a class="pull-left applicant_details"    type="button"
                                                   data-user-id="<?php echo $row->APPLICANT_ID ?>" data-toggle="modal"
                                                   data-target="#applicant_modal">
                                                    <?php echo $row->FULL_NAME_EN ?>
                                                </a>
                                            </td>
                                            <td><?php echo $row->APPROVE_REMARKS ?></td>
                                            <td>
                                                <?php
                                                if($row->APPROVE_FOR_ADMIT == '1')
                                                    echo "<span style='color: green;'>Approved</span>";
                                                else if($row->APPROVE_FOR_ADMIT == '0')
                                                    echo "<span style='color: red;'>Rejected</span>";
                                                else
                                                    echo "";
                                                ?>
                                            </td>
                                            <td><?php echo $row->APPROVE_DT ?></td>
                                            <td><?php

                                                echo  "Remarks: ".$row->ELIGIBLE_DEPT_HEAD_REMARKS."</br>"."Approved Date: ".$row->ELIGIBLE_BY_DEPT_HEAD_DT;

                                                ?>

                                            </td>
                                            <td >
                                                <a class="label label-primary applicantApprove" data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Approved">Approve</a> || <a class="label label-danger applicantReject" data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Reject">Reject</a>
                                                <span class="approvedSuccess_<?php echo $row->APPLICANT_ID; ?>"></span>
                                            </td>
                                        </tr>
                                    <?php  endforeach;  ?>
                                    </tbody>

                                </table>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger"><p class="text-center">No Applicant Found </p> </div>
                <?php endif; ?>
            </div>

        </div>
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
    $(document).on("click", ".applicant_details", function () {
        var APPLICANT_ID = $(this).attr('data-user-id');

        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>admin/applicantModal',
            data: {APPLICANT_ID: APPLICANT_ID},
            success: function (data) {
                $("#applicant_modal .modal-body").html(data);
            }
        });
    });

    $(document).on("click", ".program_session_wise_applicant", function () {
        var PROGRAM_ID = $("#PROGRAM_ID").val();
        var YSESSION_ID = $("#YSESSION_ID").val();
        if(PROGRAM_ID =='' || YSESSION_ID=='' ){
            alert("Please select program and admission session");
        }else{
            $.ajax({
                type: "POST",
                data: {PROGRAM_ID:PROGRAM_ID,YSESSION_ID:YSESSION_ID},
                url: "<?php echo base_url(); ?>Admin/applicant_list_admit_card_prg_ses_wise",
                beforeSend: function () {
                    $("#applicantList").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $("#applicantList").html(data);
                }
            });
        }

    });


    $(document).on("click", ".applicantApprove", function () {
        var applicantId = $(this).attr("data-applicant");
        $(".appModal").modal();
        $.ajax({
            type: "POST",
            data: {applicantId:applicantId},
            url: "<?php echo base_url(); ?>Admin/approveRemark",
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
            url: "<?php echo base_url(); ?>Admin/rejectRemark",
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
            var APPLICANT_ID = $(this).attr('data-user-id');

            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>admin/applicantModal',
                data: {APPLICANT_ID: APPLICANT_ID},
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