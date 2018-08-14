<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Room No</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($rooms)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($rooms as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->BR_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="courseLoad_<?php echo $row->BR_ID; ?>"></span></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BR_CODE; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BR_NAME; ?></td>

                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>

                    <a class="label label-default openModal" id="<?php echo $row->BR_ID; ?>"
                       title="Update Room Information" data-action="setup/editRoom" data-type="edit"><i
                            class="fa fa-pencil"></i></a>

                    <a class="label label-danger deleteItem" id="<?php echo $row->BR_ID; ?>" title="Click For Delete"
                       data-type="delete" data-field="BR_ID" data-tbl="sc_building_room"><i class="fa fa-times"></i></a>

                    <a class="" id="<?php echo $row->BR_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
                       data-fieldId="BR_ID" data-field="ACTIVE_STATUS" data-tbl="sc_br_type" data-su-url="">
                        <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
                    </a>

                </td>
            </tr>
        <?php } ?>
    <?php endif; ?>
    </tbody>
    <tfoot>
    <tr>
        <th>SN</th>
        <th>Room No</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>                       