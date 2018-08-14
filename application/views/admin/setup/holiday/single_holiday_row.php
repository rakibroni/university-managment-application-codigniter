<?php if ($previlages->READ == 1) { ?>
    <?php
    //$sn = 1;
    if ($row->TYPE == "W")
        $HolidayType = "Weekend";
    else if ($row->TYPE == "G")
        $HolidayType = "Government Holiday";
    else if ($row->TYPE == "F")
        $HolidayType = "Festivale Holiday";
    ?>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><span><?php echo $sn; ?></span><span
            class="hidden" id="eventLoad_<?php echo $row->HOLIDAY_ID; ?>"></span></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $HolidayType; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->HOLIDAY_NAME; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->HOLIDAY_DESC; ?></td>
    <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo date('d-M-Y', strtotime($row->HOLIDAY_DT)); ?></td>
    <td style="width: 140px" <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
        <a class="label label-info openModal" id="<?php echo $row->HOLIDAY_ID; ?>" data-action="setup/eventInfo"
           data-type="edit" title="View Event Information"><i class="fa fa-eye"></i></a>
        <?php if ($previlages->UPDATE == 1) { ?>
            <a class="label label-default openModal" id="<?php echo $row->HOLIDAY_ID; ?>"
               title="Update Holiday Information" data-action="setup/holidayFormUpdate" data-type="edit"><i
                    class="fa fa-pencil"></i></a>
        <?php
        }
        if ($previlages->DELETE == 1) {
            ?>
            <a class="label label-danger deleteItem" id="<?php echo $row->HOLIDAY_ID; ?>" title="Click For Delete"
               data-type="delete" data-field="EVENT_ID" data-tbl="event"><i class="fa fa-times"></i></a>
        <?php
        }

        if ($previlages->STATUS == 1) {
            ?>
            <a class="itemStatus" id="<?php echo $row->HOLIDAY_ID; ?>" data-status="<?php echo $row->ACTIVE_STATUS ?>"
               data-fieldId="HOLIDAY_ID" data-field="ACTIVE_STATUS" data-tbl="holiday_master"
               data-su-url="setup/holidayById">
                <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Active">Active</span>' ?>
            </a>
        <?php
        }
        ?>
    </td>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>