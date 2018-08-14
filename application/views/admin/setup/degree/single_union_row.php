<td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"
                                                                                         id="loader_<?php echo $row->UNION_ID; ?>"></span>
</td>
<td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><?php echo $row->UNION_NAME; ?></td>
<td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><?php echo $row->THANA_ENAME; ?></td>
<td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>>
    <a class="label label-default openModal" id="<?php echo $row->UNION_ID; ?>" title="Update Thana Information"
       data-action="setup/unionFormUpdate" data-type="edit"><i class="fa fa-pencil"></i></a>

    <a class="label label-danger deleteItem" id="<?php echo $row->UNION_ID; ?>" title="Click For Delete"
       data-type="delete" data-field="UNION_ID" data-tbl="sa_unions"><i class="fa fa-times"></i></a>

    <a class="itemStatus" id="<?php echo $row->UNION_ID; ?>" data-status="<?php echo $row->ACTIVE_FLAG ?>"
       data-fieldId="UNION_ID" data-field="ACTIVE_FLAG " data-tbl="sa_unions" data-su-url="setup/unionById">
        <?php echo ($row->ACTIVE_FLAG == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?></a>
</td>
