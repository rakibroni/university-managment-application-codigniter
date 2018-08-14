<?php if ($previlages->READ == 1) { ?>

<table class="table table-bordered gridTable"  table-title="Unit List" table-msg="All Unit list">
    <thead>
        <tr>
            <th>SN</th>
            <th>Leave Type</th>
            <th>Description</th>
            <th>Total Days</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($leaveType)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($leaveType as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->LEAVE_TYPE_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                    id="loader_<?php echo $row->LEAVE_TYPE_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->TYPE_NAME; ?></td>
                     <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->LEAVE_DESC; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->TOTAL_DAYS; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                         <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->LEAVE_TYPE_ID; ?>"
                         title="Update Leave Type Information" data-action="teacher/leaveTypeFormUpdate"
                         data-type="edit"><i class="fa fa-pencil"></i></a>
                         <?php
                     }
                     if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->LEAVE_TYPE_ID; ?>"
                         title="Click For Delete" data-type="delete" data-field="LEAVE_TYPE_ID" data-tbl="hr_leave_type"><i
                         class="fa fa-times"></i></a>
                        <?php
                     }

                     if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus" id="<?php echo $row->LEAVE_TYPE_ID; ?>"
                         data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="LEAVE_TYPE_ID"
                         data-field="ACTIVE_STATUS" data-tbl="hr_leave_type" data-su-url="teacher/leaveTypeById">
                         <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
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