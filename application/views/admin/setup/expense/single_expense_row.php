<?php if ($previlages->READ == 1) { ?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                               id="loader_<?php echo $row->RATE_ID; ?>"></span>
    </td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CHARGE_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo number_format($row->AMOUNT, 2) ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date("d/m/Y", strtotime($row->START_DATE)); ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date("d/m/Y", strtotime($row->END_DATE)); ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SEMESTER; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PROGRAM; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <a class="label label-info openModal" id="<?php echo $row->RATE_ID; ?>" data-action="setup/expenseInfo"
           data-type="edit" title="View Expense Information"><i class="fa fa-eye"></i></a>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->RATE_ID; ?>"
               title="Update Expense Information" data-action="setup/expenseFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->RATE_ID; ?>" title="Click For Delete"
               data-action="setup/deleteDegree" data-type="delete" data-field="RATE_ID"
               data-tbl="ac_academic_charge_rate"><i class="fa fa-times"></i></a>
        <?php
        }
        if ($previlages->STATUS == 1) {
            ?>
            <a class="itemStatus" id="<?php echo $row->RATE_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
               data-fieldId="RATE_ID" data-field="ACTIVE_STATUS" data-tbl="ac_academic_charge_rate"
               data-su-url="setup/expanseById">
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
