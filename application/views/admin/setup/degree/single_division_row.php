<td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                         id="loader_<?php echo $row->DIVISION_ID; ?>"></span>
</td>

<td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DIVISION_ENAME; ?></td>

<td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>>

    <a class="label label-default openModal" id="<?php echo $row->DIVISION_ID; ?>" title="Update Division Information"
       data-action="setup/divisionFormUpdate" data-type="edit"><i class="fa fa-pencil"></i></a>


    <a class="label label-danger deleteItem" id="<?php echo $row->DIVISION_ID; ?>" title="Click For Delete"
       data-type="delete" data-field="DIVISION_ID" data-tbl="division"><i class="fa fa-times"></i></a>

    <a class="itemStatus" id="<?php echo $row->DIVISION_ID; ?>" data-status="<?php echo $row->ACTIVE_FLAG ?>"
       data-fieldId="DIVISION_ID" data-field="ACTIVE_FLAG" data-tbl="division" data-su-url="setup/divisionById">
        <?php echo ($row->ACTIVE_FLAG == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
    </a>
</td>