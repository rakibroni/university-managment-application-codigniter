<?php if ($previlages->READ == 1) { ?>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span
    class="hidden" id="loader_<?php echo $row->STOCK_ID; ?>"></span></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ITEM_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->OPENING; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if ($previlages->UPDATE == 1) { ?>
        <a class="label label-default openModal" id="<?php echo $row->STOCK_ID; ?>"
           title="Update Opening Balance Information" data-action="inventory/openingBlnFormUpdate" data-type="edit"><i
           class="fa fa-pencil"></i></a>
           <?php
       }
       if ($previlages->DELETE == 1) {
        ?>
        <a class="label label-danger deleteItem" id="<?php echo $row->STOCK_ID; ?>" title="Click For Delete"
           data-type="delete" data-field="STOCK_ID" data-tbl="inv_stock"><i class="fa fa-times"></i></a>
           <?php
       }
       if ($previlages->STATUS == 1) {
        ?>
        <a class="itemStatus" id="<?php echo $row->STOCK_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
           data-fieldId="STOCK_ID" data-field="ACTIVE_STATUS" data-tbl="inv_stock" data-su-url="inventory/openingBlnById">
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