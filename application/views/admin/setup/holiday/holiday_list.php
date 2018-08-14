<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Holiday Type</th>
        <th>Name</th>
        <th>Description</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($holiday)): ?>
        <?php $sn = 1; ?>
        <?php foreach ($holiday as $row) { ?>
            <?php
            if ($row->TYPE == "W")
                $HolidayType = "Weekend";
            else if ($row->TYPE == "G")
                $HolidayType = "Government Holiday";
            else if ($row->TYPE == "F")
                $HolidayType = "Festivale Holiday";
            ?>
            <tr class="gradeX" id="row_<?php echo $row->HOLIDAY_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="eventLoad_<?php echo $row->HOLIDAY_ID; ?>"></span></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $HolidayType; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->HOLIDAY_NAME; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->HOLIDAY_DESC; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('l\, jS M Y ', strtotime($row->HOLIDAY_DT)); ?></td>
                <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <a class="label label-info openModal" id="<?php echo $row->HOLIDAY_ID; ?>"
                       data-action="setup/eventInfo" data-type="edit" title="View Event Information"><i
                            class="fa fa-eye"></i></a>
                    <?php if ($previlages->UPDATE == 1) { ?>
                        <a class="label label-default openModal" id="<?php echo $row->HOLIDAY_ID; ?>"
                           title="Update Holiday Information" data-action="setup/holidayFormUpdate" data-type="edit"><i
                                class="fa fa-pencil"></i></a>
                    <?php
                    }
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="label label-danger deleteItem" id="<?php echo $row->HOLIDAY_ID; ?>"
                           title="Click For Delete" data-type="delete" data-field="HOLIDAY_ID"
                           data-tbl="holiday_master"><i class="fa fa-times"></i></a>
                    <?php
                    }

                    if ($previlages->STATUS == 1) {
                        ?>
                        <a class="itemStatus" id="<?php echo $row->HOLIDAY_ID; ?>"
                           data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="HOLIDAY_ID"
                           data-field="ACTIVE_STATUS" data-tbl="holiday_master" data-su-url="setup/holidayById">
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
        <th>Holiday Type</th>
        <th>Name</th>
        <th>Description</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>