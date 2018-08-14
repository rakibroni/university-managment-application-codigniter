<?php if ($previlages->READ == 1) { ?>
    <?php foreach ($assignment as $row) { ?>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?> style="width:80%;">
            <span class="hidden" id="loader_<?php echo $row->ASSIGN_ID; ?>"></span>

            <div class="forum-item active">
                <a class="forum-item-title"><?php echo $row->ASSIGN_TITLE; ?></a>

                <div class="forum-sub-title"><?php echo $row->ASSIGN_DESC; ?></div>
                <i><?php echo $row->TOPIC_TITLE; ?></i>
                <?php if ($row->TOPIC_TITLE != '') {
                    echo ", ";
                }
                ?>
                <b><?php echo $row->COURSE_TITLE . " (" . $row->COURSE_CODE . ")"; ?></b>
            </div>
        </td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
            <a class="btn btn-success btn-xs openModal" type="button" id="<?php echo $row->ASSIGN_ID; ?>"
               title="Assignment Distribute" data-action="setup/assignmentDistribute" data-type="edit">
                <i class="fa fa-gears"></i>
                <span class="bold">Distribute</span>
            </a>
        </td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
            <?php if ($previlages->UPDATE == 1) { ?>
                <a class="label label-default openModal" id="<?php echo $row->ASSIGN_ID; ?>" title="Update Assignment"
                   data-action="setup/assignmentFormUpdate" data-type="edit"><i class="fa fa-pencil"></i></a>
            <?php
            }
            if ($previlages->DELETE == 1) {
                ?>
                <a class="label label-danger deleteItem" id="<?php echo $row->ASSIGN_ID; ?>" title="Click For Delete"
                   data-type="delete" data-field="ASSIGN_ID" data-tbl="aca_assignment"><i class="fa fa-times"></i></a>
            <?php
            }

            if ($previlages->STATUS == 1) {
                ?>
                <a class="itemStatus" id="<?php echo $row->ASSIGN_ID; ?>"
                   data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="ASSIGN_ID" data-field="ACTIVE_STATUS"
                   data-tbl="aca_assignment" data-su-url="setup/assignmentById">
                    <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
                </a>
            <?php
            }
            ?>
        </td>
    <?php } ?>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>