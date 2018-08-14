<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Committee Name</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sn = 0;
    foreach ($com_type as $row) {
        $sn = $sn + 1;
        ?>
        <tr class="gradeX" id="row_<?php echo $row->COM_ID; ?>">
            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn; ?></span><span
                    class="hidden" id="loader_<?php echo $row->COM_ID; ?>"></span></td>

            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COM_TITLE; ?></td>
            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->COM_DESC; ?></td>



            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                <a class="label label-default openModal" id="<?php echo $row->COM_ID; ?>"
                   title="Update Committee Information" data-action="setup/committeeTypeFormUpdate" data-type="edit"><i
                        class="fa fa-pencil"></i></a>

                <a class="label label-danger deleteItem" id="<?php echo $row->COM_ID; ?>" title="Click For Delete"
                   data-type="delete" data-field="COM_ID" data-tbl="committee"><i class="fa fa-times"></i></a>

                <a class="itemStatus" id="<?php echo $row->COM_ID; ?>"
                   data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="COM_ID" data-field="ACTIVE_STATUS"
                   data-tbl="committee" data-su-url="setup/committeeTypeById">
                    <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?> </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
