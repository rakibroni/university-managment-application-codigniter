<?php if ($previlages->READ == 1) { ?>
    <?php foreach ($dept as $row) { ?>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                                   id="loader_<?php echo $row->DEPT_ID; ?>"></span>
        </td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPT_ABBR; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPT_NAME; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->UD_SLNO; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->FACULTY_NAME; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
            <?php if ($previlages->UPDATE == 1) { ?>
                <a class="label label-default openModal" id="<?php echo $row->DEPT_ID; ?>"
                   title="Update Department Information" data-action="setup/departmentFormUpdate" data-type="edit"><i
                        class="fa fa-pencil"></i></a>
            <?php
            }
            if ($previlages->DELETE == 1) {
                ?>
                <a class="label label-danger deleteItem" id="<?php echo $row->DEPT_ID; ?>" title="Click For Delete"
                   data-type="delete" data-field="DEPT_ID" data-tbl="department"><i class="fa fa-times"></i></a>
            <?php
            }

            if ($previlages->STATUS == 1) {
                ?>
                <a class="itemStatus" id="<?php echo $row->DEPT_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
                   data-fieldId="DEPT_ID" data-field="ACTIVE_STATUS" data-tbl="department"
                   data-su-url="setup/departmentById">
                    <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Active</span>' : '<span class="label label-danger" title="Click For Active">Inctive</span>' ?>
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