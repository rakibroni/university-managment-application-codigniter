<table class="table table-striped table-bordered  gridTable responsive">
    <thead>
    <tr>
        <th class="all">SN</th>
        <th class="all">Name</th>
        <th>Event Type</th>
        <th>Start</th>
        <th>End</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($event)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($event as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->EVENT_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="eventLoad_<?php echo $row->EVENT_ID; ?>"></span></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->E_TITLE; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->type; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->START_DT)); ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->END_DT)); ?></td>
                <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <a class="label label-info openModal" id="<?php echo $row->EVENT_ID; ?>"
                       data-action="setup/eventInfo" data-type="edit" title="View Event Information"><i
                            class="fa fa-eye"></i></a>
                    <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->EVENT_ID; ?>"
                           title="Update Event Information" data-action="setup/eventFormUpdate" data-type="edit"><i
                                class="fa fa-pencil"></i></a>
                    <?php
                    }
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->EVENT_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="EVENT_ID" data-tbl="event"><i
                                class="fa fa-times"></i></a>
                    <?php
                    }

                    if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus" id="<?php echo $row->EVENT_ID; ?>"
                           data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="EVENT_ID"
                           data-field="ACTIVE_STATUS" data-tbl="event" data-su-url="setup/eventById">
                            <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
                        </a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    <?php endif; ?>
    </tbody>
    <tfoot>
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Event Type</th>
        <th>Start</th>
        <th>End</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>