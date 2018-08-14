<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Applicant Approve</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <form id="applicant">
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control required" name="PROGRAM_ID" id="PROGRAM_ID"
                                data-tags="true" data-placeholder="Select Program" data-allow-clear="true">
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
                        <select class="form-control required" name="YSESSION_ID" id="YSESSION_ID"
                                data-tags="true" data-placeholder="Select Admission Session" data-allow-clear="true">
                            <option value="">Select Session</option>
                            <?php foreach ($session as $row) { ?>
                                <option
                                        value="<?php echo $row->YSESSION_ID; ?>"><?php echo $row->SESSION_NAME; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="button" class="btn btn-primary btn-sm program_session_wise_adm_approv_applicant "
                               value="Search">
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <?php if (!empty($applicant)): ?>
                <div class="table-responsive contentArea" id="applicantList">
                    <table class="table table-striped table-bordered table-hover gridTable">
                        <thead>
                        <tr>
                            <th>Roll</th>
                            <th>Name</th>
                            <th>Remark</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Admission Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="approveApplicant" class="searchApplicant">
                        <?php
                        $sn = 1;
                        foreach ($applicant as $row):
                            ?>
                            <tr class="gradeX" id="row_<?php echo $row->APPLICANT_ID; ?>">

                                <td><?php echo $row->ADM_ROLL_NO ?></td>
                                <td>
                                    <a class="pull-left applicant_details" type="button"
                                       data-user-id="<?php echo $row->APPLICANT_ID ?>" data-toggle="modal"
                                       data-target="#applicant_modal">
                                        <?php echo $row->FULL_NAME_EN ?>
                                    </a>
                                </td>
                                <td><?php echo $row->ELIGIBLE_DEPT_HEAD_REMARKS ?></td>
                                <td>
                                    <?php
                                    if ($row->ELIGIBLE_BY_DEPT_HEAD_STATUS == '1')
                                        echo "<span style='color: green;'>Approved</span>";
                                    else if ($row->ELIGIBLE_BY_DEPT_HEAD_STATUS == '0')
                                        echo "<span style='color: red;'>Rejected</span>";
                                    else
                                        echo "";
                                    ?>
                                </td>
                                <td><?php echo $row->ELIGIBLE_BY_DEPT_HEAD_DT ?></td>
                                <td><?php

                                    echo "Remarks: " . $row->ELIGIBLE_ADM_REMARKS . "</br>" . "Approved Date: " . $row->ELIGIBLE_ADDMISSION_DEPT_DT;

                                    ?>

                                </td>
                                <td>
                                    <a class="label label-primary applicantApprove"
                                       data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Approved">Approve</a>
                                    || <a class="label label-danger applicantReject"
                                          data-applicant="<?php echo $row->APPLICANT_ID; ?>" title="Click For Reject">Reject</a>
                                    <span class="approvedSuccess_<?php echo $row->APPLICANT_ID; ?>"></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-danger"><p class="text-center">No record found.</p></div>
            <?php endif; ?>
        </div>


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
            url: '<?php echo site_url() ?>/Admin/applicantModal',
            data: {APPLICANT_ID: APPLICANT_ID},
            success: function (data) {
                $("#applicant_modal .modal-body").html(data);
            }
        });
    });

    $(document).on("click", ".applicantApprove", function () {
        var applicantId = $(this).attr("data-applicant");
        $(".appModal").modal();
        $.ajax({
            type: "POST",
            data: {applicantId: applicantId},
            url: "<?php echo site_url()?>/Admin/approveRemark",
            beforeSend: function () {
                $(".appModal .modal-title").html("Add Remarks");
                $(".appModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".appModal .modal-body").html(data);
                if (data == 'Remarks Create successfully') {

                }
            }
        });
    });

    $(document).on("click", ".applicantReject", function () {
        var applicantId = $(this).attr("data-applicant");
        $(".appModal").modal();
        $.ajax({
            type: "POST",
            data: {applicantId: applicantId},
            url: "<?php echo site_url() ?>/Admin/rejectRemark",
            beforeSend: function () {
                $(".appModal .modal-title").html("Add Remarks");
                $(".appModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".appModal .modal-body").html(data);
                if (data == 'Remarks Create successfully') {

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
                url: '<?php echo site_url('admin/newApplicantApprovedByHead') ?>',
                data: {remarks: remarks, applicantId: applicantId},
                success: function (data) {
                    $(".frmMsg").html(data);
                    $.ajax({
                        type: "post",
                        data: {applicantId: applicantId},
                        url: "<?php echo site_url(); ?>/admin/applicantByIdHead",
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
                data: {remarks: remarks, applicantId: applicantId},
                url: '<?php echo site_url('admin/newApplicantRejectByHead') ?>/',
                success: function (data) {
                    $(".frmMsg").html(data);
                    $.ajax({
                        type: "post",
                        data: {applicantId: applicantId},
                        url: "<?php echo site_url(); ?>/admin/applicantByIdHead",
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
                url: '<?php echo site_url()?>admin/applicantModal',
                data: {APPLICANT_ID: APPLICANT_ID},
                success: function (data) {
                    $("#applicant_modal .modal-body").html(data);
                }
            });
        });
        $(document).on("click", ".program_session_wise_adm_approv_applicant", function () {
            var PROGRAM_ID = $("#PROGRAM_ID").val();
            var YSESSION_ID = $("#YSESSION_ID").val();
            if (PROGRAM_ID == '' || YSESSION_ID == '') {
                alert("Please select program and admission session");
            } else {
                $.ajax({
                    type: "POST",
                    data: {PROGRAM_ID: PROGRAM_ID, YSESSION_ID: YSESSION_ID},
                    url: "<?php echo site_url()?>/Admin/newApplicantAdmissonApproveProSesWise",
                    beforeSend: function () {
                        $("#applicantList").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $("#applicantList").html(data);
                    }
                });
            }

        });
    });
</script>