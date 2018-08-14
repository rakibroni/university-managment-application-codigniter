<?php if (1) { ?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn; ?></span><span
                class="hidden" id="loader_<?php echo $row->CHARGE_ID; ?>"></span></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CHARGE_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

        <?php if (1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->CHARGE_ID; ?>"
               title="Update Finance Information" data-action="finance/financeFormUpdate"
               data-type="edit"><i class="fa fa-pencil"></i></a>
            <?php
        }
        if (1) {
            ?>
            <a class="label label-danger deleteItemFinance" id="<?php echo $row->CHARGE_ID; ?>"
               title="Click For Delete" data-type="delete" data-field="CHARGE_ID" data-tbl="ac_academic_charge"><i
                        class="fa fa-times"></i></a>
            <?php
        }

        if (1) {
            ?>
            <a class="itemStatusFinance" id="<?php echo $row->CHARGE_ID; ?>"
               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="CHARGE_ID"
               data-field="ACTIVE_STATUS" data-tbl="ac_academic_charge" data-su-url="finance/financeById">
                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
            </a>
            <?php
        }
        ?>
    </td>
    <?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>