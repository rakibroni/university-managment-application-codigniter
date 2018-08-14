<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span></span><span class="hidden"

                                                                                         id="loader_<?php echo $row->COM_MEMBER_ID; ?>"></span>
</td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COM_TITLE; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->FULL_NAME; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DESIGNATION; ?></td>
<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->EX_COM_DESC; ?></td>


<td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
    <a class="label label-default openModal" id="<?php echo $row->COM_MEMBER_ID; ?>" title="Update Committee member Information"
       data-action="setup/comMemFormUpdate" data-type="edit"><i class="fa fa-pencil"></i></a>
    <a class="label label-danger deleteItem" id="<?php echo $row->COM_MEMBER_ID; ?>" title="Click For Delete"
       data-type="delete" data-field="COM_MEMBER_ID" data-tbl="committee_member"><i class="fa fa-times"></i></a>
    <a class="itemStatus" id="<?php echo $row->COM_MEMBER_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
       data-fieldId="COM_MEMBER_ID" data-field="ACTIVE_STATUS " data-tbl="committee_member" data-su-url="setup/comMemById">
        <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?></a>
</td>
