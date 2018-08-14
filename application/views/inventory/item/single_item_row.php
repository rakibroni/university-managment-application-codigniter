<?php if (1) { ?>
   <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span
                class="hidden" id="loader_<?php echo $row->ITEM_ID; ?>"></span></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ITEM_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->CATEGORY_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->UNIT_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DESC; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if (1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->ITEM_ID; ?>"
               title="Update Item Information" data-action="inventory/itemFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if (1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->ITEM_ID; ?>" title="Click For Delete"
               data-type="delete" data-field="ITEM_ID" data-tbl="inv_item"><i class="fa fa-times"></i></a>
        <?php
        }
        if (1) {
            ?>
            <a class="itemStatus" id="<?php echo $row->ITEM_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
               data-fieldId="ITEM_ID" data-field="ACTIVE_STATUS" data-tbl="inv_item" data-su-url="inventory/itemById">
                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
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