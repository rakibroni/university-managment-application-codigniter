<?php
$d = 1;
$i = 1;
$checked = "";
$dayNames = array('SAT' => 'Saturday', 'SUN' => 'Sunday', 'MON' => 'Monday', 'TUE' => 'Tuesday', 'WED' => 'Wednesday', 'THU' => 'Thursday', 'FRI' => 'Friday');
foreach ($dayNames as $key => $day) {
    ?>
    <div class="checkbox checkbox-success">
        <div class="col-lg-4">
            <?php
            $st = $key . "_ST_TIME";
            $end = $key . "_END_TIME";
            if (!empty($checkRoomSchedule)) {
                if ($checkRoomSchedule->$key == 1) {
                    ?>
                    <input class="week_day_dr_down" id="checkbox<?php echo $d; ?>" name="chkDay<?php echo $d; ?>"
                           type="checkbox" checked value="<?php echo $key; ?>"/>
                    <label for="checkbox<?php echo $d; ?>" class="text-danger" data-placement="left"
                           data-toggle="tooltip"
                           title="Class room not empty on <?php echo $day; ?>"><?php echo $day; ?></label>
                <?php
                } else {
                    ?>
                    <input class="week_day_dr_down" id="checkbox<?php echo $d; ?>" name="chkDay<?php echo $d; ?>"
                           type="checkbox" value="<?php echo $key; ?>"/>
                    <label for="checkbox<?php echo $d; ?>"><?php echo $day; ?></label>
                <?php
                }
            } else {
                ?>
                <input class="week_day_dr_down" id="checkbox<?php echo $d; ?>" name="chkDay<?php echo $d; ?>"
                       type="checkbox" value="<?php echo $key; ?>"/>
                <label for="checkbox<?php echo $d; ?>"><?php echo $day; ?></label>
            <?php
            }
            ?>
        </div>
        <div class="col-md-4">
            <div class="input-group col-md-12 clockpicker" data-autoclose="true">
                <input type="text" class="form-control" name="CUS_START_TIME<?php echo $i; ?>"
                       id="START_TIME<?php echo $i; ?>"
                       value="<?php echo !empty($checkRoomSchedule) ? ($checkRoomSchedule->$st) : ''; ?>"
                       placeholder="Start"/>
                <span class="input-group-addon">
                    <span class="fa fa-clock-o"></span>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group col-md-12 clockpicker" data-autoclose="true">
                <input type="text" class="form-control" name="CUS_END_TIME<?php echo $i; ?>"
                       id="END_TIME<?php echo $i; ?>"
                       value="<?php echo !empty($checkRoomSchedule) ? ($checkRoomSchedule->$end) : ''; ?>"
                       placeholder="End"/>
                <span class="input-group-addon">
                    <span class="fa fa-clock-o"></span>
                </span>
            </div>
        </div>
    </div>
    <?php
    $d++;
    $i++;
}
?>