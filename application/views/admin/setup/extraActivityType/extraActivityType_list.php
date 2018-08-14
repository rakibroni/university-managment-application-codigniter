<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Extra Activity</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sn = 0;
    foreach ($extraActivityType as $row) {
        $sn = $sn + 1;
        ?>
        <tr class="gradeX" id="row_<?php echo $row->ACTIVITY_TYPE_ID; ?>">
            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn; ?></span><span
                    class="hidden" id="loader_<?php echo $row->ACTIVITY_TYPE_ID; ?>"></span></td>

            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->ACTIVITY_NAME; ?></td>

            <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                <a class="label label-default openModal" id="<?php echo $row->ACTIVITY_TYPE_ID; ?>"
                   title="Update Extra Activity Information" data-action="setup/extraActivityTypeFormUpdate"
                   data-type="edit"><i class="fa fa-pencil"></i></a>

                <a class="label label-danger deleteItem" id="<?php echo $row->ACTIVITY_TYPE_ID; ?>"
                   title="Click For Delete" data-type="delete" data-field="ACTIVITY_TYPE_ID "
                   data-tbl="extra_activity_type"><i class="fa fa-times"></i></a>

                <a class="itemStatus" id="<?php echo $row->ACTIVITY_TYPE_ID; ?>"
                   data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="ACTIVITY_TYPE_ID "
                   data-field="ACTIVE_STATUS" data-tbl="extra_activity_type" data-su-url="setup/extraActivityById">

                    <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
                </a>

            </td>

        </tr>
    <?php } ?>
    </tbody>

    <tfoot>
    <tr>
        <th>SN</th>
        <th>Extra Activity</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>