<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Bank Name</th>
        <th>Branch Name</th>
        <th>Address</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sn = 0;
    foreach ($bank_branch as $row) {
        $sn = $sn + 1;
        ?>
        <tr class="gradeX" id="row_<?php echo $row->BANK_BRANCH_ID; ?>">
            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn; ?></span><span
                    class="hidden" id="loader_<?php echo $row->BANK_BRANCH_ID; ?>"></span></td>

            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BANK_NAME; ?></td>
            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BANK_BRANCH_NAME; ?></td>

            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php  echo $row->ADDRESS;  ?></td>

            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                <a class="label label-default openModal" id="<?php echo $row->BANK_BRANCH_ID; ?>"
                   title="Update bank branch Information" data-action="setup/bankBranchFormUpdate" data-type="edit"><i
                        class="fa fa-pencil"></i></a>

                <a class="label label-danger deleteItem" id="<?php echo $row->BANK_BRANCH_ID; ?>" title="Click For Delete"
                   data-type="delete" data-field="BANK_BRANCH_ID" data-tbl="bank_branch"><i class="fa fa-times"></i></a>

                <a class="itemStatus" id="<?php echo $row->BANK_BRANCH_ID; ?>"
                   data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="BANK_BRANCH_ID" data-field="ACTIVE_STATUS"
                   data-tbl="bank_branch" data-su-url="setup/bankBranchById">
                    <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?> </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
