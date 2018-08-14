<td><?php echo $applicant->ADM_ROLL_NO ?></td>
<td>
    <a class="pull-left applicant_details" type="button"
       data-user-id="<?php echo $applicant->APPLICANT_ID ?>" data-toggle="modal"
       data-target="#applicant_modal">
        <?php echo $applicant->FULL_NAME_EN ?>
    </a>
</td>
<td><?php echo $applicant->APPROVE_REMARKS ?></td>
<td>
    <?php
    if ($applicant->APPROVE_FOR_ADMIT == 1)
        echo "<span style='color: green;'>Approved</span>";
    else if ($applicant->APPROVE_FOR_ADMIT == 2)
        echo "<span style='color: red;'>Rejected</span>";
    else
        echo "";
    ?>
</td>
<td><?php echo $applicant->APPROVE_DT ?></td>
<td><?php

    echo "Remarks: " . $applicant->ELIGIBLE_DEPT_HEAD_REMARKS . "</br>" . "Approved Date: " . $applicant->ELIGIBLE_BY_DEPT_HEAD_DT;

    ?>

</td>
<td class="text-center">
    <a class="label label-primary applicantApprove" data-applicant="<?php echo $applicant->APPLICANT_ID; ?>"
       title="Click For Approved">Approve</a> || <a class="label label-danger applicantReject"
                                                    data-applicant="<?php echo $applicant->APPLICANT_ID; ?>"
                                                    title="Click For Reject">Reject</a>
    <span class="approvedSuccess_<?php echo $applicant->APPLICANT_ID; ?>"></span>
</td>