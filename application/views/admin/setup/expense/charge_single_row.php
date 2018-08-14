<?php if ($previlages->READ == 1) { ?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                               id="loader_<?php echo $row->CHARGE_ID; ?>"></span>
    </td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CHARGE_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->IS_APP_FEE) ? 'Yes' : 'No'; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->IS_TUTOIN_FEE == 1) ? 'Yes' : 'No'; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo ($row->REDUNDENT == 1) ? 'Yes' : 'No'; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->CHARGE_ID; ?>"
               title="Update Charge Information" data-action="setup/chargeFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php }
        if ($previlages->DELETE == 1) { ?>
            <a class="label label-danger deleteItem2" id="<?php echo $row->CHARGE_ID; ?>" title="Click For Delete"
                data-type="delete" data-field="CHARGE_ID" data-tbl="ac_academic_charge" data-action="setup/deleteItem"><i
                    class="fa fa-times"></i></a>
        <?php }
        if ($previlages->STATUS == 1) { ?>
            <a class="itemStatus2" id="<?php echo $row->CHARGE_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
               data-fieldId="CHARGE_ID" data-field="ACTIVE_STATUS" data-tbl="ac_academic_charge" data-action="setup/statusItem"
               data-su-url="setup/chargeById">
                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
            </a>
        <?php } ?>
    </td>

<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>