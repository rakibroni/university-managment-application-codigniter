<?php if ($previlages->READ == 1) { ?>
<?php $sn=""; ?>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn; ?></span><span
    class="hidden" id="loader_<?php echo $row->AUTHOR_ID; ?>"></span></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->AUTHOR_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->AUTHOR_COUNTRY; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->REMARKS; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if ($previlages->UPDATE == 1) { ?>
        <a class="label label-default openModal" id="<?php echo $row->AUTHOR_ID; ?>"
           title="Update Library Author Information" data-action="setup/libAuthorFormUpdate"
           data-type="edit"><i class="fa fa-pencil"></i></a>
           <?php
       }
       if ($previlages->DELETE == 1) {
        ?>
        <a class="label label-danger deleteItem" id="<?php echo $row->AUTHOR_ID; ?>"
           title="Click For Delete" data-type="delete" data-field="AUTHOR_ID" data-tbl="lib_author"><i
           class="fa fa-times"></i></a>
           <?php
       }

       if ($previlages->STATUS == 1) {
        ?>
        <a class="itemStatus" id="<?php echo $row->AUTHOR_ID; ?>"
           data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="AUTHOR_ID"
           data-field="ACTIVE_STATUS" data-tbl="lib_author" data-su-url="setup/libAuthorById">
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