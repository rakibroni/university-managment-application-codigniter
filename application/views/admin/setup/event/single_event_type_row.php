<?php if ($previlages->READ == 1) { ?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                               id="loader_<?php echo $row->E_TYPE_ID; ?>"></span><?php echo $row->E_TYPE_ID; ?>
    </td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->E_TYPE_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->E_TYPE_ID; ?>"
               title="Update Event Type Information" data-action="setup/eventTypeFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->E_TYPE_ID; ?>" title="Click For Delete"
               data-type="delete" data-field="E_TYPE_ID" data-tbl="event_type"><i class="fa fa-times"></i></a>
        <?php
        }
        if ($previlages->STATUS == 1) {
            ?>
        <a class="itemStatus" id="<?php echo $row->E_TYPE_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
           data-fieldId="E_TYPE_ID" data-field="ACTIVE_STATUS" data-tbl="event_type" data-su-url="setup/eventTypeById">
            <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
            </a><?php
        }
        ?>
    </td>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>