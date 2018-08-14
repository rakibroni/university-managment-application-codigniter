<?php if ($previlages->READ == 1) { ?>
    <table class="table table-striped table-bordered table-hover gridTable">
        <thead>
        <tr>
            <th>SN</th>
            <th>Charge Name</th>
            <th>Application Fee</th>
            <th>Tuition Fee</th>
            <th>Redundant Fee</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($charges)): ?>
            <?php $sn = 1; ?>
            <?php foreach ($charges as $row) { ?>
                <tr class="gradeX" id="row_<?php echo $row->CHARGE_ID; ?>">
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <span><?php echo $sn++; ?></span><span class="hidden"
                                                               id="loader_<?php echo $row->CHARGE_ID; ?>"></span></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CHARGE_NAME; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->IS_APP_FEE) ? 'Yes' : 'No'; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->IS_TUTOIN_FEE == 1) ? 'Yes' : 'No'; ?></td>
                    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->REDUNDENT == 1) ? 'Yes' : 'No'; ?></td>
                    <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                        <?php if ($previlages->UPDATE == 1) { ?>
                            <a class="label label-default openModal" id="<?php echo $row->CHARGE_ID; ?>"
                               title="Update Charge Information" data-action="setup/chargeFormUpdate"
                               data-type="edit"><i class="fa fa-pencil"></i></a>
                        <?php }
                        if ($previlages->DELETE == 1) { ?>
                            <a class="label label-danger deleteItem" id="<?php echo $row->CHARGE_ID; ?>"
                               title="Click For Delete" data-action="setup/deleteDegree" data-type="delete"
                               data-field="CHARGE_ID" data-tbl="ac_academic_charge"><i class="fa fa-times"></i></a>
                        <?php }
                        if ($previlages->STATUS == 1) { ?>
                            <a class="itemStatus" id="<?php echo $row->CHARGE_ID; ?>"
                               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="CHARGE_ID"
                               data-field="ACTIVE_STATUS" data-tbl="ac_academic_charge" data-su-url="setup/chargeById">
                                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <th>SN</th>
            <th>Charge Name</th>
            <th>Application Fee</th>
            <th>Tuition Fee</th>
            <th>Redundant Fee</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>