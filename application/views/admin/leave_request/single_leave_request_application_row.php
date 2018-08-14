<td <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
    <span><?php echo $sn++; ?></span><span class="hidden"
                                           id="loader_<?php echo $row->LEAVE_ID; ?>"></span>
</td>
<td <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->FULL_ENAME; ?></td>
<td <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-m-Y', strtotime($row->LEAVE_FORM)); ?></td>
<td <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-m-Y', strtotime($row->LEAVE_TO)); ?></td>
<td <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->LEAVE_REASON; ?></td>
<td <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->EMR_CONTACT; ?></td>
<td <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ADDRESS_DURING_LEAVE; ?></td>
<td style="text-align: center" <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
    <?php if($row->APROVED_STATUS == 1) : ?>
        <span class="label label-success">Approved</span>
    <?php elseif ($row->APROVED_STATUS == 2) : ?>
        <span class="label label-danger">Rejected</span>
    <?php else: ?>
        <span class="label label-warning">Pending</span>
    <?php endif; ?>
</td>
<td <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->APPROVED_REMARKS; ?></td>
<td <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

    <?php if (1) { ?>
        <a class="label label-primary openModal" id="<?php echo $row->LEAVE_ID; ?>"
           title="Approve Remarks" data-action="teacher/approveLeaveRequest"
           data-type="edit">Approve</a>
        <?php
    }
    if (1) {
        ?>
        <a class="label label-danger openModal" id="<?php echo $row->LEAVE_ID; ?>"
           title="Reject Remarks" data-action="teacher/rejectLeaveRequest"
           data-type="edit">Reject</a>
        <?php
    }

    if (1) {
        ?>
        <a class="itemStatus2" id="<?php echo $row->LEAVE_ID; ?>"
           data-status="<?php // echo $row->GRADE_LV_ACTIVE_STATUS ?>" data-fieldId="LEAVE_ID"
           data-field="LV_ACTIVE_STATUS" data-tbl="exam_grade" data-action="exam/statusItem"
           data-su-url="exam/gradeById">
            <?php // echo ($row->GRADE_LV_ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
        </a>
        <?php
    }
    ?>
</td>