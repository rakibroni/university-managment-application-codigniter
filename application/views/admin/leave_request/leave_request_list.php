<?php if (1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th class="col-md-1">From</th>
            <th class="col-md-1">To</th>
            <th class="col-md-2">Reason</th>
            <th class="">Emergency Contact</th>
            <th class="col-md-2">Address During Leave</th>
            <th class="">Approved Status</th>
            <th class="">Remarks</th>
            <th class="col-md-1">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($leaves)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($leaves as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->LEAVE_ID; ?>">
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
                    <td <?php echo ($row->LV_ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?> class="col-md-2">

                        <?php if (1) { ?>
                         <a class="label label-info openBigModal" id="<?php echo $row->LEAVE_ID; ?>"
                           data-action="teacher/viewLeaveRequestInfo" data-type="edit" title="Leave Request Information"><i
                                class="fa fa-eye"></i> 
                            </a> &nbsp;
                             <?php if($row->APROVED_STATUS != 1) : ?>
                            <a class="label label-primary openModal" id="<?php echo $row->LEAVE_ID; ?>"
                               title="Approve Remarks" data-action="teacher/approveLeaveRequest"
                               data-type="edit">Approve</a>
                              
                            <?php
                            endif;
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
                </tr>
            <?php } ?>
        <?php endif; ?>
        </tbody>
    </table>
    <?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>