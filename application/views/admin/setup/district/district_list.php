<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>District Name</th>
        <th>Division Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sn = 0;
    foreach ($district as $row) {
        $sn = $sn + 1;
        ?>
        <tr class="gradeX" id="row_<?php echo $row->DISTRICT_ID; ?>">
            <td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn; ?></span><span
                    class="hidden" id="loader_<?php echo $row->DISTRICT_ID; ?>"></span></td>

            <td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DISTRICT_ENAME; ?></td>

            <td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>><?php echo $row->DIVISION_ENAME; ?></td>

            <td <?php echo ($row->ACTIVE_FLAG == 1) ? "" : "class='inactive'"; ?>>

                <a class="label label-default openModal" id="<?php echo $row->DISTRICT_ID; ?>"
                   title="Update District Information" data-action="setup/districtFormUpdate" data-type="edit"><i
                        class="fa fa-pencil"></i></a>

                <a class="label label-danger deleteItem" id="<?php echo $row->DISTRICT_ID; ?>" title="Click For Delete"
                   data-type="delete" data-field="DISTRICT_ID" data-tbl="sa_districts"><i class="fa fa-times"></i></a>

                <a class="itemStatus" id="<?php echo $row->DISTRICT_ID; ?>"
                   data-status="<?php echo $row->ACTIVE_FLAG ?>" data-fieldId="DISTRICT_ID" data-field="ACTIVE_FLAG"
                   data-tbl="sa_districts" data-su-url="setup/districtById">
                    <?php echo ($row->ACTIVE_FLAG == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?> </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
