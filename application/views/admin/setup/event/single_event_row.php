<?php if ($previlages->READ == 1) { ?>
    <?php //var_dump($row); exit;?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                               id="loader_<?php echo $row->EVENT_ID; ?>"></span><?php echo $row->EVENT_ID; ?>
    </td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->E_TITLE; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->type; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->START_DT)); ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->END_DT)); ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->EVENT_ID; ?>"
               title="Update Event Type Information" data-action="setup/eventFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->EVENT_ID; ?>" title="Click For Delete"
               data-type="delete" data-field="EVENT_ID" data-tbl="event"><i class="fa fa-times"></i></a>
        <?php
        }
        if ($previlages->STATUS == 1) {
            ?>
        <a class="itemStatus" id="<?php echo $row->EVENT_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
           data-fieldId="EVENT_ID" data-field="ACTIVE_STATUS" data-tbl="event" data-su-url="setup/eventById">
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