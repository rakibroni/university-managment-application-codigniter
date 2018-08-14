<?php if ($previlages->READ == 1) { ?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                               id="loader_<?php echo $row->P_PARTICULAR_ID; ?>"></span>
    </td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->FACULTY; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DEPARTMENT; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PROGRAM; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->SEMESTER; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PARTICULER; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->PARTICULAR_AMOUNT; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->P_PARTICULAR_ID; ?>"
               title="Update Particular Information" data-action="setup/particularFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php }
        if ($previlages->DELETE == 1) { ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->P_PARTICULAR_ID; ?>" title="Click For Delete"
               data-action="setup/deleteDegree" data-type="delete" data-field="P_PARTICULAR_ID"
               data-tbl="ac_program_particulars"><i class="fa fa-times"></i></a>
        <?php }
        if ($previlages->STATUS == 1) { ?>
            <a class="itemStatus" id="<?php echo $row->P_PARTICULAR_ID; ?>"
               data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="P_PARTICULAR_ID" data-field="ACTIVE_STATUS"
               data-tbl="ac_program_particulars" data-su-url="setup/particulerById">
                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
            </a>
        <?php } ?>
    </td>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>
