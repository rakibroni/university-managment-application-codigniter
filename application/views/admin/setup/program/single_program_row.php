<?php if ($previlages->READ == 1) { ?>
    <?php foreach ($program as $row) { ?>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                                   id="loader_<?php echo $row->PROGRAM_ID; ?>"></span>
        </td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PROGRAM_NAME; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEGREE_NAME; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPT_NAME; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->FACULTY_NAME; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->UD_SLNO; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->TOTAL_SESSION; ?></td>
        <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
            <?php if ($previlages->UPDATE == 1) { ?>
                <a class="label label-default openModal" id="<?php echo $row->PROGRAM_ID; ?>"
                   data-action="setup/programFormUpdate" title="Update Program Information" data-type="edit"><i
                        class="fa fa-pencil"></i></a>
            <?php
            }
            if ($previlages->DELETE == 1) {
                ?>
                <a class="label label-danger deleteItem" id="<?php echo $row->PROGRAM_ID; ?>" data-type="delete"
                   title="Click For Delete" data-field="PROGRAM_ID" data-tbl="ins_program"><i class="fa fa-times"></i></a>
            <?php
            }

            if ($previlages->STATUS == 1) {
                ?>
                <a class="itemStatus" id="<?php echo $row->PROGRAM_ID; ?>"
                   data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="PROGRAM_ID" data-field="ACTIVE_STATUS"
                   data-tbl="ins_program" data-su-url="setup/programById">
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