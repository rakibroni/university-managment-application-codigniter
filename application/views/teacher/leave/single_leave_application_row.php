<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
    <span><?php echo $sn++; ?></span><span class="hidden"
                                           id="loader_<?php echo $row->LEAVE_ID; ?>"></span></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-m-Y', strtotime($row->LEAVE_FORM)); ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-m-Y', strtotime($row->LEAVE_TO)); ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->LEAVE_REASON; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->EMR_CONTACT; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ADDRESS_DURING_LEAVE; ?></td>
<td style="text-align: center" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
    <?php if($row->APROVED_STATUS == 1) : ?>
        <span class="label label-success">Approved</span>
    <?php elseif ($row->APROVED_STATUS == 2) : ?>
        <span class="label label-danger">Rejected</span>
    <?php else: ?>
        <span class="label label-warning">Pending</span>
    <?php endif; ?>
</td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->APPROVED_REMARKS; ?></td>

<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

    <?php if ($row->APROVED_STATUS != 1 && $row->APROVED_STATUS != 2) { ?>
        <a class="label label-default openModal" id="<?php echo $row->LEAVE_ID; ?>"
           title="Update Leave Request" data-action="teacher/leaveFormUpdate"
           data-type="edit"><i class="fa fa-pencil"></i></a>
        <?php
    }
    if ($row->APROVED_STATUS != 1 && $row->APROVED_STATUS != 2) {
        ?>
        <a class="label label-danger deleteItem2" id="<?php echo $row->LEAVE_ID; ?>"
           title="Click For Delete" data-type="delete" data-field="LEAVE_ID"
           data-action="teacher/deleteItem"
           data-tbl="hr_leave"><i
                    class="fa fa-times"></i></a>
        <?php
    }

    if (1) {
        ?>
        <!-- <a class="itemStatus2" id="<?php echo $row->LEAVE_ID; ?>"
                       data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="LEAVE_ID"
                       data-field="ACTIVE_STATUS" data-tbl="exam_grade_policy" data-action="exam/statusItem"
                       data-su-url="exam/policyById">
                        <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
                    </a> -->
        <?php
    }
    ?>

</td>