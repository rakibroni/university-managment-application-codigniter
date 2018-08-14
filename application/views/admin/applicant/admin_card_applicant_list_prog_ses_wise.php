<?php if (empty($applicant)) {
    echo "Sorry no applicant found !";
} else { ?>

    <table class="table table-striped table-bordered table-hove gridTable">
        <thead>
        <tr>
            <th>Roll</th>
            <th>Name</th>
            <th>Remark</th>
            <th>Status</th>
            <th>Date</th>
            <th>Dept. Head Status</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody id="approveApplicant" class="searchApplicant">
        <?php
        $sn = 1;
        foreach ($applicant as $row):
            ?>
            <tr class=" <?php echo ($row->ELIGIBLE_BY_DEPT_HEAD_STATUS == 1) ? '' : 'danger' ?>" id="row_<?php echo $row->APPLICANT_ID; ?>">

                <td><?php echo $row->ADM_ROLL_NO ?></td>
                <td>
                    <a class="pull-left applicant_details" type="button"
                       data-user-id="<?php echo $row->APPLICANT_ID ?>" data-toggle="modal"
                       data-target="#applicant_modal">
                        <?php echo $row->FULL_NAME_EN ?>
                    </a>
                </td>
                
                <td><?php echo $row->APPROVE_REMARKS ?></td>
                <td>
                    <?php
                    if ($row->APPROVE_FOR_ADMIT == '1')
                        echo "<span style='color: green;'>Approved</span>";
                    else if ($row->APPROVE_FOR_ADMIT == '0')
                        echo "<span style='color: red;'>Rejected</span>";
                    else
                        echo "";
                    ?>
                </td>
                <td><?php echo $row->APPROVE_DT ?></td>
                <td><?php

                    echo "Remarks: " . $row->ELIGIBLE_DEPT_HEAD_REMARKS . "</br>" . "Approved Date: " . $row->ELIGIBLE_BY_DEPT_HEAD_DT;

                    ?>

                </td>
                <td class="text-center">
                    <?php if($row->ELIGIBLE_BY_DEPT_HEAD_STATUS == 1) : ?>
                    <a class="label label-primary applicantApprove" data-applicant="<?php echo $row->APPLICANT_ID; ?>"
                       title="Click For Approved">Approve</a> || <a class="label label-danger applicantReject"
                                                                    data-applicant="<?php echo $row->APPLICANT_ID; ?>"
                                                                    title="Click For Reject">Reject</a>
                    <span class="approvedSuccess_<?php echo $row->APPLICANT_ID; ?>"></span>
                    <?php else: ?>
                        <a class="text-danger"
                           title="Click For Reject"><b>Rejected</b></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function () {
        $(".gridTable").dataTable();
    });
</script>
